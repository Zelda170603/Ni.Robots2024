document.addEventListener('DOMContentLoaded', function() {
    const chatInput = document.getElementById('chat');
    const sendButton = document.getElementById('sendButton');

    chatInput.addEventListener('input', function() {
        if (chatInput.value.trim() !== '') {
            sendButton.disabled = false;
        } else {
            sendButton.disabled = true;
        }
    });

    sendButton.addEventListener('click', function() {
        const message = chatInput.value.trim();
        const receiverId = document.getElementById('UserReceive').value; // ID del usuario con el que se está chateando
        
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '/mensajes/send-message', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onload = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Mensaje enviado exitosamente
                        console.log('Message sent:', xhr.responseText);
                        chatInput.value = ''; // Limpiar el campo de entrada
                        sendButton.disabled = true; // Deshabilitar el botón de enviar
                    } else {
                        console.error('Request failed with status:', xhr.status);
                    }
                }
            };
            xhr.onerror = function() {
                console.error('Request failed');
            };
            const data = {
                message: message,
                receiver_id: receiverId
            };
            xhr.send(JSON.stringify(data));
    });
});