const filterform = document.getElementById('filterForm'),
    searchBar = document.getElementById('search-bar'),
    resultContainer = document.getElementById('search-result');

filterform.addEventListener('submit', function (event) {
    const elements = this.elements;
    for (let i = 0; i < elements.length; i++) {
        const element = elements[i];
        if ((element.tagName === 'SELECT' || element.tagName === 'INPUT') && element.value === '') {
            element.disabled = true;
        }
    }
});

resultContainer.style.display = "none";
searchBar.onkeyup = () => {
    let searchTerm = searchBar.value.trim(); // Obtén el valor del campo de búsqueda y elimina espacios en blanco al inicio y al final
    
    // Verifica si el término de búsqueda no está vacío
    if (searchTerm.length === 0) {
        resultContainer.style.display = "none"; // Oculta el contenedor de resultados si no hay término de búsqueda
        return; // Sal de la función sin enviar la solicitud AJAX
    }

    resultContainer.style.display = "block";
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/productos/searchByName", true); // Asegúrate de usar la ruta correcta
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    xhr.onload = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = JSON.parse(xhr.responseText);
                resultContainer.innerHTML = data.html; // Actualiza el contenido del contenedor con el HTML recibido
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        }
    };
    
    xhr.onerror = function() {
        console.error('Request failed');
    };
    
    xhr.send(JSON.stringify({ searchTerm: searchTerm }));
};
