document.addEventListener('DOMContentLoaded', function() {
    const categoriaSelect = document.getElementById('tipo_afectacion');
    const tipoSelect = document.getElementById('nivel_afectacion');

    // Función para cargar las categorías de afectación
    function loadCategoriasAfectacion() {
        fetch('/categorias-afectacion')
            .then(response => response.json())
            .then(data => {
                categoriaSelect.innerHTML = '<option value="">Seleccione una categoría</option>';
                Object.entries(data).forEach(([id, nombre]) => {
                    const option = document.createElement('option');
                    option.value = id;
                    option.textContent = nombre;
                    categoriaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al obtener categorías de afectación:', error));
    }

    // Función para cargar los tipos de afectación según la categoría seleccionada
    function loadTiposAfectacion(categoriaId) {
        fetch(`/tipos-afectacion/${categoriaId}`)
            .then(response => response.json())
            .then(data => {
                tipoSelect.innerHTML = '<option value="">Seleccione un tipo de afectación</option>';
                Object.entries(data).forEach(([id, tipo]) => {
                    const option = document.createElement('option');
                    option.value = id;
                    option.textContent = tipo;
                    tipoSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al obtener tipos de afectación:', error);
                tipoSelect.innerHTML = '<option value="">Seleccione un tipo de afectación</option>';
            });
    }

    // Cargar las categorías al iniciar
    loadCategoriasAfectacion();

    // Añadir evento al cambio de categoría
    categoriaSelect.addEventListener('change', function() {
        const categoriaId = this.value;
        if (categoriaId) {
            loadTiposAfectacion(categoriaId);
        } else {
            tipoSelect.innerHTML = '<option value="">Seleccione un tipo de afectación</option>';
        }
    });
});