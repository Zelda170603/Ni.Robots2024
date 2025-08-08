
// Existing code for handling product ID and rating
document.querySelectorAll('[data-modal-toggle="crud-modal"]').forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.getAttribute('data-product-id');
        document.getElementById("id_prod").value = productId;
    });
});

const stars = document.querySelectorAll('.stars');
const input = document.getElementById("calificacion");
let clicked = false;

stars.forEach(function (star) {
    star.addEventListener('mouseover', function () {
        const selectedId = parseInt(star.id);
        stars.forEach(function (s) {
            if (!clicked && parseInt(s.id) <= selectedId) {
                s.classList.remove('text-gray-300');
                s.classList.add('text-yellow-300');
            }
        });
    });

    star.addEventListener('mouseout', function () {
        if (!clicked) {
            stars.forEach(function (s) {
                s.classList.remove('text-yellow-300');
                s.classList.add('text-gray-300');
            });
        }
    });

    star.addEventListener('click', function () {
        clicked = true;
        const selectedId = parseInt(star.id);
        input.value = selectedId;

        stars.forEach(function (s) {
            if (parseInt(s.id) <= selectedId) {
                s.classList.add('text-yellow-300');
                s.classList.remove('text-gray-300');
            } else {
                s.classList.remove('text-yellow-300');
                s.classList.add('text-gray-300');
            }
        });
    });
});


document.getElementById("envio").addEventListener("click", function (event) {
    event.preventDefault();

    const formData = {
        puntuacion: document.getElementById("calificacion").value,
        comentario: document.getElementById("description").value,
        id_prod: document.getElementById("id_prod").value,
    };
    console.log(formData);

    fetch('/productos/rate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    }).then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Error en la solicitud');
                });
            }
            return response.json();
        }).then(data => {
            console.log('Operación exitosa:', data.message);

            alert("Tu reseña se ha enviado correctamente");
            // Optionally, reset the form fields if needed
            document.getElementById("description").value = ''; // Clear comment field
            document.getElementById("calificacion").value = ''; // Clear rating field
        });
});
