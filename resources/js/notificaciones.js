

document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('notifications-container');
       // ,icon = document.getElementById('dropdownNotificationButton');
        
    function fetchNotifications() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "/notifications", true);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let notificationsHTML = JSON.parse(xhr.responseText);
                    container.innerHTML = notificationsHTML; // Actualiza el contenedor con el HTML recibido\
                   // icon.innerHTML = notificationsHTML.badgeHTML;
                } else {
                    console.error('Request failed with status:', xhr.status);
                }
            }
        };
        xhr.onerror = function () {
            console.error('Request failed');
        };
        xhr.send();
    }

    // Llamar a fetchNotifications inicialmente para cargar las notificaciones
    fetchNotifications();

    // Configurar un intervalo para actualizar las notificaciones cada 3 segundos (3000 milisegundos)
    setInterval(fetchNotifications, 3000);
});
