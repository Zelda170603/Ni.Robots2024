document.addEventListener('DOMContentLoaded', (event) => {
    const paths = document.querySelectorAll('path');
    let selectedPath = null;
    const pathInfoDiv = document.getElementById('pathInfo');
    const pathNameElement = document.getElementById('pathName');

    paths.forEach(path => {
        path.addEventListener('mouseover', () => {
            if (path !== selectedPath) {
                path.classList.add('fill-yellow-500');
                path.classList.remove('fill-[#124474]');
            }
        });

        path.addEventListener('mouseout', () => {
            if (path !== selectedPath) {
                path.classList.remove('fill-yellow-500');
                path.classList.add('fill-[#124474]');
            }
        });

        path.addEventListener('click', () => {
            // Remover estilos del path previamente seleccionado
            if (selectedPath) {
                selectedPath.classList.remove('fill-yellow-500');
                selectedPath.classList.add('fill-[#124474]');
            }

            // Aplicar estilos al path actual seleccionado
            selectedPath = path;
            selectedPath.classList.add('fill-yellow-500');
            selectedPath.classList.remove('fill-[#124474]');

            // Mostrar el panel de información
            pathInfoDiv.classList.remove('hidden');
            pathInfoDiv.classList.add('block');

            // Actualizar el contenido del panel con el título del path seleccionado
            const ciudad = path.getAttribute('title');
            pathNameElement.textContent =
                `Centros de atencion ubicados en la ciudad de ${ciudad}`;

            // Llamar a la función para obtener los centros de atención por ciudad
            getCentros(ciudad);
        });
    });

    function getCentros(ciudad) {
        const content = document.getElementById('content');
        const errorContainer = document.getElementById(
            'error-container'); // Asume que tienes un contenedor para errores
        fetch(`/Centro_atencion/${ciudad}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            }
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(error => {
                        throw new Error(error.error ||
                            'Ocurrió un error al obtener los centros de atención.');
                    });
                }
                return response.json();
            })
            .then(data => {
                // Manejar la respuesta del servidor
                console.log(data); // Aquí puedes ver los datos recibidos del servidor
                content.innerHTML = data.html;
            })
            .catch(error => {
                console.error('Error en la solicitud fetch:', error);
                if (errorContainer) {
                    errorContainer.innerText = `Error: ${error.message}`;
                    errorContainer.classList.remove(
                        'hidden'); // Asegúrate de que el contenedor de errores esté visible
                }
            });
    }

});