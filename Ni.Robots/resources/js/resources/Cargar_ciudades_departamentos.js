document.addEventListener('DOMContentLoaded', function() {
    const departamentoSelect = document.getElementById('departamento');
    const municipioSelect = document.getElementById('municipio');

    // Función para cargar los departamentos
    function loadDepartamentos() {
        fetch('/departamentos')
            .then(response => response.json())
            .then(data => {
                departamentoSelect.innerHTML = ''; // Limpiar el select actual

                // Añadir un elemento de selección vacía
                const defaultOption = document.createElement('option');
                defaultOption.textContent = 'Seleccione un departamento';
                defaultOption.value = '';
                departamentoSelect.appendChild(defaultOption);

                // Añadir los departamentos recibidos
                Object.entries(data).forEach(([id, nombre]) => {
                    const option = document.createElement('option');
                    option.value = id;
                    option.textContent = nombre;
                    departamentoSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al obtener departamentos:', error));
    }

    // Función para cargar municipios según el departamento seleccionado
    function loadMunicipios(departamentoId) {
        fetch(`/municipios/${departamentoId}`)
            .then(response => response.json())
            .then(data => {
                municipioSelect.innerHTML = '<option value="">Selecciona un municipio</option>';
                Object.entries(data).forEach(([id, nombre]) => {
                    const option = document.createElement('option');
                    option.value = id;
                    option.textContent = nombre;
                    municipioSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al obtener municipios:', error);
                municipioSelect.innerHTML = '<option value="">Selecciona un municipio</option>';
            });
    }

    // Cargar los departamentos al iniciar
    loadDepartamentos();

    // Añadir evento al cambio de departamento
    departamentoSelect.addEventListener('change', function() {
        const departamentoId = this.value;
        if (departamentoId) {
            loadMunicipios(departamentoId);
        } else {
            municipioSelect.innerHTML = '<option value="">Selecciona un municipio</option>';
        }
    });
});