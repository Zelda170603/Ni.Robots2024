// ==================== CHAT (compatible con tus rutas actuales) ====================
document.addEventListener('DOMContentLoaded', function () {
  const chatInput   = document.getElementById('chat');
  const sendButton  = document.getElementById('sendButton');
  const chatWindow  = document.getElementById('chatWindow');
  const userReceive = document.getElementById('UserReceive');

  let shouldStickToBottom = true;   // autoscroll inteligente
  let refreshInterval     = null;

  if (!chatWindow || !chatInput || !sendButton || !userReceive) {
    console.warn('Chat no disponible en esta vista. Script detenido.');
    return;
  }

  const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';

  function isNearBottom(el, threshold = 80) {
    return el.scrollHeight - el.scrollTop - el.clientHeight < threshold;
  }

  function scrollToBottom(el) {
    el.scrollTop = el.scrollHeight;
  }

  function getReceiverId() {
    return userReceive.value ? String(userReceive.value) : '';
  }

  // Habilitar / deshabilitar botón
  function toggleSendBtn() {
    sendButton.disabled = (chatInput.value.trim() === '');
  }
  chatInput.addEventListener('input', toggleSendBtn);

  // Enviar con Enter (sin Shift)
  chatInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      if (!sendButton.disabled) sendMessage();
    }
  });

  // Enviar con click
  sendButton.addEventListener('click', sendMessage);

  // Detectar si el usuario está scrolleando cerca del final
  chatWindow.addEventListener('scroll', () => {
    shouldStickToBottom = isNearBottom(chatWindow, 10);
  });

  async function loadMessages({ forceScroll = false } = {}) {
    const receiverId = getReceiverId();
    if (!receiverId) return;

    // Mantener auto-scroll si ya estamos abajo o si forzamos
    const keepBottom = forceScroll || shouldStickToBottom;

    try {
      // ⬇️ RUTA: /mensajes/get-messages/{receiver_id}
      const res = await fetch(`/mensajes/get-messages/${receiverId}`, {
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      const data = await res.json();

      if (data?.html !== undefined) {
        chatWindow.innerHTML = data.html;
        if (keepBottom) scrollToBottom(chatWindow);
      }
    } catch (err) {
      console.error('Error al cargar mensajes:', err);
    }
  }

  async function sendMessage() {
    const message = chatInput.value.trim();
    const receiverId = getReceiverId();
    if (!message || !receiverId) return;

    sendButton.disabled = true;

    try {
      // ⬇️ RUTA: /mensajes/send-message
      const res = await fetch('/mensajes/send-message', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ message, receiver_id: receiverId })
      });
      if (!res.ok) throw new Error(`HTTP ${res.status}`);

      const data = await res.json();
      if (data?.status !== 'Mensaje enviado') {
        console.warn('Respuesta inesperada al enviar:', data);
      }

      chatInput.value = '';
      toggleSendBtn();
      await loadMessages({ forceScroll: true });
    } catch (err) {
      console.error('Error al enviar mensaje:', err);
    } finally {
      toggleSendBtn();
    }
  }

  // Primera carga + polling
  toggleSendBtn();
  loadMessages({ forceScroll: true });

  // Polling cada 1s, solo si el nodo sigue en DOM y la pestaña está visible
  refreshInterval = setInterval(() => {
    if (!document.body.contains(chatWindow)) {
      clearInterval(refreshInterval);
      return;
    }
    if (!document.hidden) loadMessages();
  }, 1000);

  // Si vuelves a la pestaña, refresca
  document.addEventListener('visibilitychange', () => {
    if (!document.hidden) loadMessages();
  });

  // Limpieza
  window.addEventListener('beforeunload', () => {
    if (refreshInterval) clearInterval(refreshInterval);
  });
});


// ==================== VIDEOCALL FUNCTIONALITY (AGORA + POLLING con flujo controlado) ====================
// ==================== VIDEOCALL FUNCTIONALITY (AGORA + POLLING con flujo controlado) ====================

let AgoraRTC = null;
let rtcClient = null;
let localAudioTrack = null;
let localVideoTrack = null;
let remoteUsers = {};

let currentCallType = "";
let currentCallId = null;

// --- State Machine simple para evitar “trucos” ---
const CallState = {
  IDLE: "idle",
  RINGING_OUTGOING: "ringing_outgoing",
  RINGING_INCOMING: "ringing_incoming",
  IN_CALL: "in_call",
};
let callState = CallState.IDLE;

// Helpers
function getCSRF() {
  return document.querySelector('meta[name="csrf-token"]')?.content || "";
}
function getReceiverId() {
  const el = document.getElementById("UserReceive");
  return el ? String(el.value) : "";
}
function toast(msg, type = "info") {
  const bg =
    type === "error"
      ? "bg-red-100 border-red-400 text-red-700"
      : type === "success"
      ? "bg-green-100 border-green-400 text-green-700"
      : "bg-blue-100 border-blue-400 text-blue-700";
  const el = document.createElement("div");
  el.className = `fixed top-4 left-1/2 -translate-x-1/2 z-[100] ${bg} border px-4 py-2 rounded shadow`;
  el.textContent = msg;
  document.body.appendChild(el);
  setTimeout(() => el.remove(), 2500);
}

// ========== Polling de llamadas entrantes ==========
async function checkForIncomingCalls() {
  const receiverId = getReceiverId();
  if (!receiverId || callState !== CallState.IDLE) return;

  try {
    const response = await fetch('/mensajes/check-video-call-status', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCSRF() },
      body: JSON.stringify({ receiver_id: receiverId })
    });
    const data = await response.json();

    if (data.success && data.call && data.call.is_incoming && data.call.status === 'ringing') {
      showIncomingCallModal(data.call); // NO nos unimos aquí, solo UI
    }
  } catch (error) {
    console.error('Error checking call status:', error);
  }
}

function showIncomingCallModal(callData) {
  if (callState === CallState.IN_CALL) return;
  if (callState === CallState.RINGING_INCOMING && currentCallId === callData.id) return;

  currentCallId = callData.id;
  currentCallType = callData.call_type;
  callState = CallState.RINGING_INCOMING;

  setupCallInterface(callData.call_type, true);
  document.getElementById("videoCallModal")?.classList.remove("hidden");

  document.getElementById("acceptCall")?.classList.remove("hidden");
  document.getElementById("declineCall")?.classList.remove("hidden");
  document.getElementById("endCall")?.classList.add("hidden");
}

// ========== Aceptar / Rechazar ==========
async function acceptIncomingCall() {
  if (!currentCallId || callState !== CallState.RINGING_INCOMING) return;
  try {
    const response = await fetch('/mensajes/accept-video-call', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCSRF() },
      body: JSON.stringify({ call_id: currentCallId })
    });
    const data = await response.json();

    if (!data.success) throw new Error(data.message || 'No se pudo aceptar');

    // recién aquí nos unimos, con el UID del backend
    callState = CallState.IN_CALL;
    document.getElementById("acceptCall")?.classList.add("hidden");
    document.getElementById("declineCall")?.classList.add("hidden");
    document.getElementById("endCall")?.classList.remove("hidden");

    await joinAgoraCall(
      data.channel_name,
      data.agora_token,
      currentCallType,
      true,
      data.uid // <-- UID de sesión desde el backend
    );
  } catch (error) {
    console.error('Error accepting call:', error);
    toast(error.message || "Error al aceptar la llamada", "error");
    await declineIncomingCall(); // fallback
  }
}

async function declineIncomingCall() {
  try {
    if (currentCallId) {
      await fetch('/mensajes/decline-video-call', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCSRF() },
        body: JSON.stringify({ call_id: currentCallId })
      });
    }
  } catch {}
  document.getElementById("videoCallModal")?.classList.add("hidden");
  currentCallId = null;
  currentCallType = "";
  if (callState !== CallState.IN_CALL) callState = CallState.IDLE;
}

// ========== Iniciar llamada (caller) ==========
async function startAgoraCall(callType) {
  const receiverId = getReceiverId();
  if (!receiverId) return toast("No se encontró el ID del receptor", "error");
  if (callState !== CallState.IDLE) return;

  try {
    const response = await fetch('/mensajes/start-video-call', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCSRF() },
      body: JSON.stringify({ receiver_id: receiverId, call_type: callType })
    });
    const data = await response.json();

    if (data.success) {
      currentCallId = data.call_id;
      currentCallType = callType;
      callState = CallState.RINGING_OUTGOING;

      setupCallInterface(callType, false);
      document.getElementById("videoCallModal")?.classList.remove("hidden");
      document.getElementById("acceptCall")?.classList.add("hidden");
      document.getElementById("declineCall")?.classList.add("hidden");
      document.getElementById("endCall")?.classList.remove("hidden");

      // el caller también se une ya, con el UID del backend
      await joinAgoraCall(
        data.channel_name,
        data.agora_token,
        callType,
        false,
        data.uid // <-- UID de sesión desde el backend
      );
    } else {
      toast(data.message || "Error al iniciar llamada", "error");
    }
  } catch (error) {
    console.error('Error starting call:', error);
    toast("Error al iniciar la llamada", "error");
  }
}

// ========== Unirse a Agora con token y UID del backend ==========
async function joinAgoraCall(channelName, token, callType, isIncoming = false, uidFromServer) {
  const appId = window.AGORA_APP_ID || (import.meta && import.meta.env && import.meta.env.VITE_AGORA_APP_ID);
  if (!appId) return toast("Falta AGORA_APP_ID", "error");
  if (uidFromServer == null) return toast("Falta UID de Agora del backend", "error");

  try {
    await ensureAgoraLoaded();

    // crear cliente
    rtcClient = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

    // listeners ANTES de join/publish
    rtcClient.on("user-published", async (user, mediaType) => {
      await rtcClient.subscribe(user, mediaType);
      if (mediaType === "video") {
        remoteUsers[user.uid] = user;
        const remoteDiv = document.getElementById("remoteVideo");
        if (remoteDiv) {
          remoteDiv.innerHTML = "";
          const container = document.createElement("div");
          container.style.width = "100%";
          container.style.height = "100%";
          remoteDiv.appendChild(container);
          user.videoTrack?.play(container);
        }
      }
      if (mediaType === "audio") user.audioTrack?.play();
    });

    rtcClient.on("user-unpublished", (user, mediaType) => {
      if (mediaType === "video") {
        delete remoteUsers[user.uid];
        const remoteDiv = document.getElementById("remoteVideo");
        if (remoteDiv) remoteDiv.innerHTML = "";
      }
    });

    rtcClient.on("user-left", () => {
      const remoteDiv = document.getElementById("remoteVideo");
      if (remoteDiv) remoteDiv.innerHTML = "";
      toast("El usuario salió de la llamada", "info");
      endVideoCall(); // cierra todo
    });

    // ÚNETE CON EL UID QUE TE DIO EL BACKEND
    const uid = Number(uidFromServer);
    await rtcClient.join(appId, channelName, token, uid);

    // tracks locales
    [localAudioTrack, localVideoTrack] = await AgoraRTC.createMicrophoneAndCameraTracks();

    // preview local
    const localDiv = document.getElementById("localVideo");
    if (localDiv) {
      localDiv.innerHTML = "";
      const container = document.createElement("div");
      container.style.width = "100%";
      container.style.height = "100%";
      localDiv.appendChild(container);
      await localVideoTrack.play(container);
    }

    // publicar
    await rtcClient.publish([localAudioTrack, localVideoTrack]);
    callState = CallState.IN_CALL;

    toast("Conectado a la llamada", "success");
  } catch (e) {
    console.error("Agora error:", e);
    toast(e.message || "Error al unirse a la videollamada", "error");
    await endVideoCall();
  }
}

// ========== Finalizar llamada ==========
async function endVideoCall() {
  try {
    if (currentCallId) {
      await fetch('/mensajes/end-video-call', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': getCSRF() },
        body: JSON.stringify({ call_id: currentCallId })
      });
    }

    if (localAudioTrack) { try { localAudioTrack.stop(); localAudioTrack.close(); } catch {} localAudioTrack = null; }
    if (localVideoTrack) { try { localVideoTrack.stop(); localVideoTrack.close(); } catch {} localVideoTrack = null; }
    if (rtcClient) { try { await rtcClient.leave(); } catch {} rtcClient = null; }

    ["localVideo","remoteVideo"].forEach(id => { const el = document.getElementById(id); if (el) el.innerHTML=""; });

    document.getElementById("videoCallModal")?.classList.add("hidden");

  } finally {
    remoteUsers = {};
    currentCallId = null;
    currentCallType = "";
    callState = CallState.IDLE;
    toast("Llamada finalizada", "info");
  }
}

// ========== UI / SDK ==========
function setupCallInterface(callType, isIncoming = false) {
  const receiverName = (document.querySelector("[data-receiver-name]")?.dataset?.receiverName) || "Usuario";
  const callTypeText = document.getElementById("callTypeText");
  const title = document.getElementById("videoCallTitle");

  if (title) {
    title.textContent = callType === "presential"
      ? `Videollamada Presencial - ${receiverName}`
      : `Telehealth - ${receiverName}`;
  }
  if (callTypeText) {
    callTypeText.textContent = isIncoming
      ? (callType === "presential"
          ? "📅 Llamada entrante - Coordinación presencial"
          : "💻 Llamada entrante - Consulta telehealth")
      : (callType === "presential"
          ? "📞 Llamando... (cita presencial)"
          : "💻 Llamando... (telehealth)");
  }
}

async function ensureAgoraLoaded() {
  if (window.AgoraRTC) {
    AgoraRTC = window.AgoraRTC;
    return;
  }
  if (!AgoraRTC) throw new Error("Agora SDK no cargado");
}

// ========== Botones / Wiring ==========
(function wireVideoButtons() {
  const btnPresential = document.getElementById("startPresentialCall");
  const btnTelehealth = document.getElementById("startTelehealthCall");
  const btnClose = document.getElementById("closeVideoCall");
  const btnEnd = document.getElementById("endCall");
  const btnAccept = document.getElementById("acceptCall");
  const btnDecline = document.getElementById("declineCall");
  const btnMute = document.getElementById("toggleAudio");
  const btnCam = document.getElementById("toggleVideo");

  btnPresential && btnPresential.addEventListener("click", () => startAgoraCall("presential"));
  btnTelehealth && btnTelehealth.addEventListener("click", () => startAgoraCall("telehealth"));
  btnClose && btnClose.addEventListener("click", endVideoCall);
  btnEnd && btnEnd.addEventListener("click", endVideoCall);
  btnAccept && btnAccept.addEventListener("click", acceptIncomingCall);
  btnDecline && btnDecline.addEventListener("click", declineIncomingCall);

  btnMute && btnMute.addEventListener("click", async () => {
    if (!localAudioTrack) return;
    const enabled = !localAudioTrack.isEnabled;
    await localAudioTrack.setEnabled(enabled);
    btnMute.classList.toggle("bg-red-200", !enabled);
    btnMute.classList.toggle("dark:bg-red-800", !enabled);
  });

  btnCam && btnCam.addEventListener("click", async () => {
    if (!localVideoTrack) return;
    const enabled = !localVideoTrack.isEnabled;
    await localVideoTrack.setEnabled(enabled);
    btnCam.classList.toggle("bg-red-200", !enabled);
    btnCam.classList.toggle("dark:bg-red-800", !enabled);
  });

  // Polling cada 2s SOLO si estoy libre
  const interval = setInterval(checkForIncomingCalls, 2000);
  window.addEventListener('beforeunload', () => clearInterval(interval));

  // Esc para cerrar modal si estoy en llamada
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !document.getElementById("videoCallModal")?.classList.contains("hidden")) {
      endVideoCall();
    }
  });
})();
