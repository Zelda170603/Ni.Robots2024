const contactlist = document.getElementById('contact-list');
const searchBar = document.getElementById('search-bar');
const searchBarUsers = document.getElementById('search-bar-users');
const userList = document.getElementById('user-list');

document.addEventListener('DOMContentLoaded', function() {
    // Función para cargar la lista de contactos
    function loadContactList() {
        fetch('/mensajes/get-contactlist', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                contactlist.innerHTML = data.html;
                console.log('Contactos cargados:', data.count);
            } else {
                contactlist.innerHTML = data.html;
                console.error('Error del servidor:', data.error);
            }
        })
        .catch(error => {
            console.error('Error loading contact list:', error);
            contactlist.innerHTML = '<p class="text-red-500">Error al cargar contactos</p>';
        });
    }

    // Función para buscar contactos por nombre
    function searchContacts(searchTerm) {
        fetch('/mensajes/searchByName', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ searchTerm: searchTerm })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.html) {
                contactlist.innerHTML = data.html;
            } else if (data.html) {
                contactlist.innerHTML = data.html;
            }
        })
        .catch(error => {
            console.error('Error searching contacts:', error);
        });
    }

    // Función para buscar usuarios
    function searchUsers(searchTerm) {
        fetch('/mensajes/get_users', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ searchTerm: searchTerm })
        })
        .then(response => response.json())
        .then(data => {
            if (data.html) {
                userList.innerHTML = data.html;
            }
        })
        .catch(error => {
            console.error('Error searching users:', error);
        });
    }

    // Cargar lista inicial de contactos
    loadContactList();

    // Recargar contactos cada 30 segundos
    setInterval(loadContactList, 30000);

    // Event listener para búsqueda de contactos
    if (searchBar) {
        searchBar.addEventListener('input', function() {
            const searchTerm = this.value.trim();
            
            if (searchTerm.length >= 2) {
                searchContacts(searchTerm);
            } else if (searchTerm.length === 0) {
                loadContactList();
            }
        });
    }

    // Event listener para búsqueda de usuarios
    if (searchBarUsers) {
        searchBarUsers.addEventListener('input', function() {
            const searchTerm = this.value.trim();
            
            if (searchTerm.length >= 2) {
                searchUsers(searchTerm);
            } else if (searchTerm.length === 0) {
                userList.innerHTML = '';
            }
        });
    }
});