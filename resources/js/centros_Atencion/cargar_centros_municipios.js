
const municipioSelect = document.getElementById('municipio');
municipioSelect.addEventListener('change', (event) => {
    const municipioId = event.target.value;
    console.log('Municipio ID seleccionado:', municipioId); // Log para verificar el municipio seleccionado
    if (municipioId) {
        // Llamar a la función para obtener los centros de atención por municipio
        getCentrosPorMunicipio(municipioId);
    }
});

function getCentrosPorMunicipio(municipioId) {
    const content = document.getElementById('content');
    const errorContainer = document.getElementById('error-container'); // Contenedor para errores

    fetch(`/Centro_atencion_municipio/${municipioId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Respuesta de error del servidor:', text);
                    throw new Error('Ocurrió un error al obtener los centros de atención.');
                });
            }
            return response.json(); // Procesar la respuesta JSON si es válida
        })
        .then(data => {
            const centros = data.centros;
            if (centros && centros.length > 0) {
                // Extraer las coordenadas de cada centro
                const coordenadas = centros.map(centro => centro.google_map_direction).filter(
                    Boolean); // Filtrar valores nulos o undefined

                if (coordenadas.length > 0) {
                    const primeraCoordenada = coordenadas[0].split(',').map(Number);

                    if (primeraCoordenada.length === 2 && !isNaN(primeraCoordenada[0]) && !isNaN(
                        primeraCoordenada[1])) {
                        initMap(primeraCoordenada, coordenadas); // Enviar todas las coordenadas
                    } else {
                        console.error('Las coordenadas iniciales no son válidas.');
                    }
                } else {
                    console.error('No se encontraron coordenadas válidas.');
                }
            } else {
                console.error('No se encontraron centros de atención.');
            }
        })
        .catch(error => {
            console.error('Error en la solicitud fetch:', error);
            if (errorContainer) {
                errorContainer.innerText = `Error: ${error.message}`;
                errorContainer.classList.remove('hidden'); // Mostrar el error
            }
        });
}

function initMap(centerCoordinates, allCoordinates) {
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: {
            lat: centerCoordinates[0],
            lng: centerCoordinates[1]
        },
        styles: [{
            "stylers": [{
                "grayscale": 1
            }, {
                "contrast": 1.2
            }, {
                "opacity": 0.16
            }]
        }]
    });

    allCoordinates.forEach(coordString => {
        if (coordString) { // Verificar si existe el valor
            const coordinates = coordString.split(',').map(Number);
            if (coordinates.length === 2 && !isNaN(coordinates[0]) && !isNaN(coordinates[1])) {
                new google.maps.Marker({
                    position: {
                        lat: coordinates[0],
                        lng: coordinates[1],
                    },
                    map: map
                });
            } else {
                console.error('Coordenadas no válidas:', coordString);
            }
        }
    });
}