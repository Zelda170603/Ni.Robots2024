document.addEventListener('DOMContentLoaded', function () {
    const chatInput = document.getElementById('chat');
    const sendButton = document.getElementById('sendButton');
    const chat = document.getElementById('chatWindow');
    let shouldScrollToBottom = true;

    chatInput.addEventListener('input', function () {
        if (chatInput.value.trim() !== '') {
            sendButton.disabled = false;
        } else {
            sendButton.disabled = true;
        }
    });

    sendButton.addEventListener('click', function () {
        const message = chatInput.value.trim();
        const receiverId = document.getElementById('UserReceive').value;

        if (message && receiverId) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '/mensajes/send-message', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            xhr.onload = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Message sent:', xhr.responseText);
                        chatInput.value = ''; // Limpiar el campo de entrada
                        sendButton.disabled = true; // Deshabilitar el botón de enviar
                    } else {
                        console.error('Request failed with status:', xhr.status);
                    }
                }
            };

            xhr.onerror = function () {
                console.error('Request failed');
            };

            const data = {
                message: message,
                receiver_id: receiverId
            };
            xhr.send(JSON.stringify(data));
        } else {
            console.error('Message or receiverId is missing.');
        }
    });

    setInterval(() => {
        const receiverId = document.getElementById('UserReceive').value;
        let xhr = new XMLHttpRequest();
        xhr.open("GET", `/mensajes/get-messages/${receiverId}`, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.responseText);
                    chat.innerHTML = data; // Actualiza el contenido del contenedor con el HTML recibido
                    // Mantener el scroll en la parte inferior solo si ya estaba allí o si no hay scroll (altura total igual a la altura visible)
                    if (shouldScrollToBottom || chat.scrollTop + chat.clientHeight >= chat.scrollHeight - 10) {
                        chat.scrollTop = chat.scrollHeight;
                    }
                } else {
                    console.error('Request failed with status:', xhr.status);
                }
            }
        };
        xhr.onerror = function () {
            console.error('Request failed');
        };
    
        xhr.send();
    }, 1000);

    chat.addEventListener('scroll', () => {
        // Si el usuario está en el punto más bajo del scroll, activa el scroll automático hacia abajo
        shouldScrollToBottom = (chat.scrollTop + chat.clientHeight >= chat.scrollHeight - 10);
    });
    
});