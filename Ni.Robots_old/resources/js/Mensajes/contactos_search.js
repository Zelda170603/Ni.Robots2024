

const contactlist = document.getElementById('contact-list'),
        searchBar = document.getElementById('search-bar'),
        searchBar_Users = document.getElementById('search-bar-users'),
        Userlist = document.getElementById('user-list');

document.addEventListener('DOMContentLoaded', function(){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/mensajes/get-contactlist", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = JSON.parse(xhr.response);
                contactlist.innerHTML = data; // Actualiza el contenido del contenedor con el HTML recibido
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        }
    }
    xhr.onerror = function () {
        console.error('Request failed');
    };
    xhr.send();
});

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value.trim(); // Obtén el valor del campo de búsqueda y elimina espacios en blanco al inicio y al final
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/mensajes/searchByName", true); // Asegúrate de usar la ruta correcta
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhr.onload = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = JSON.parse(xhr.responseText);
                contactlist.innerHTML = data.html; // Actualiza el contenido del contenedor con el HTML recibido
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    xhr.onerror = function () {
        console.error('Request failed');
    };

    xhr.send(JSON.stringify({ searchTerm: searchTerm }));
};

searchBar_Users.onkeyup = () => {
    let searchTerm = searchBar_Users.value.trim(); // Obtén el valor del campo de búsqueda y elimina espacios en blanco al inicio y al final
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/mensajes/get_users", true); // Asegúrate de usar la ruta correcta
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhr.onload = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = JSON.parse(xhr.responseText);
                Userlist.innerHTML = data.html; // Actualiza el contenido del contenedor con el HTML recibido
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        }
    };

    xhr.onerror = function () {
        console.error('Request failed');
    };

    xhr.send(JSON.stringify({ searchTerm: searchTerm }));
};

