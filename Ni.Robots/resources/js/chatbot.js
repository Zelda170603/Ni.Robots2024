const chatbotToggler = document.getElementById("chatbot-toggler");
const closeBtn = document.getElementById("close-btn");
const chatbox = document.getElementById("chatbot");
const chatWindow = document.getElementById("chatWindow");
const chatInput = document.getElementById("chat-input");
const sendChatBtn = document.getElementById("send-btn");

// Función para agregar un mensaje al chat
function appendMessage(message, side) {
    const messageDiv = document.createElement('div');

    // Si el mensaje es del usuario, solo muestra el contenido sin el avatar
    if (side === 'right') {
        messageDiv.classList.add('flex', 'justify-end');
        messageDiv.innerHTML = `
            <div
                class="flex flex-col leading-3 max-w-36 p-2 border-gray-200 bg-gray-200 rounded dark:bg-gray-700">
                
                <p class="text-sm flex font-normal py-2.5 text-gray-900 dark:text-white leading-normal">
                    ${message}</p>
            </div>
        `;
    } else {
        // Mensaje del asistente
        messageDiv.classList.add('flex', 'gap-1', 'justify-start');
        messageDiv.innerHTML = `
            <div class="w-8 h-8 object-cover rounded-full">
                <svg class="size-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
                </svg>
            </div>
            <div class="flex flex-col leading-3 max-w-28 p-2 border-gray-200 bg-gray-200 rounded dark:bg-gray-700">
                <p class="text-sm flex font-normal py-2.5 text-gray-900 dark:text-white leading-normal">
                ${message}</p>
            </div>
        `;
    }

    chatWindow.appendChild(messageDiv);
    chatWindow.scrollTop = chatWindow.scrollHeight; // Desplaza el chat hacia abajo
}


// Función para enviar un mensaje
function sendMessage() {
    const message = chatInput.value.trim();
    if (message === "") return;

    // Agregar el mensaje del usuario al chatbox
    appendMessage("" + message, "right");

    // Enviar mensaje al servidor
    fetch('/chatbot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ message })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.error) {
            appendMessage(data.error, "left");
            
        } else {
            appendMessage(data.reply, "left");
        }
    })
    .catch(error => console.error('Error:', error));

    // Limpiar el campo de entrada
    chatInput.value = "";
}

// Agregar evento al botón de enviar
sendChatBtn.addEventListener('click', sendMessage);

// También puedes permitir enviar mensajes al presionar 'Enter'
chatInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

// Cerrar chatbot
closeBtn.addEventListener("click", () => {
    chatbox.classList.add("opacity-0", "pointer-events-none", "scale-50");
});

// Alternar visibilidad del chatbot
chatbotToggler.addEventListener("click", () => {
    if (chatbox.classList.contains("opacity-0")) {
        chatbox.classList.remove("opacity-0", "pointer-events-none", "scale-50");
    } else {
        chatbox.classList.add("opacity-0", "pointer-events-none", "scale-50");
    }
});
