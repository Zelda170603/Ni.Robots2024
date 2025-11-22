import Swal from 'sweetalert2';

var total = document.getElementById('total-cart').value;

paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: total  // Asegúrate de que este valor sea una cadena
                }
            }],
        });
    },
    onApprove: function(data, actions) {
        // Mostrar loading mientras se procesa el pago
        Swal.fire({
            title: 'Procesando pago...',
            text: 'Por favor espera un momento',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        return fetch('/compra/process/' + data.orderID)
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => {
                        throw new Error(errorData.error || 'Network response was not ok');
                    });
                }
                return response.json();
            })
            .then(orderData => {
                if (orderData.error) {
                    throw new Error(orderData.error);
                }
                
                // Cerrar el loading
                Swal.close();
                
                // SweetAlert de éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Pago exitoso!',
                    html: `Transacción completada con ID de compra: <strong>${orderData.compra_id}</strong>`,
                    confirmButtonText: 'Continuar',
                    confirmButtonColor: '#16a34a',
                    background: '#f0fdf4',
                    iconColor: '#059669'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/compras';
                    }
                });
                
                // Redirigir automáticamente después de 3 segundos
                setTimeout(() => {
                    window.location.href = '/compras';
                }, 3000);
            })
            .catch(error => {
                console.error('There was an error processing the order:', error);
                
                // SweetAlert de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error en el pago',
                    text: 'Ha ocurrido un error al realizar el pago: ' + error.message,
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#dc2626',
                    background: '#fef2f2',
                    iconColor: '#dc2626'
                });
            });
    },
    onError: function(err) {
        console.log(err);
        
        // SweetAlert de error genérico
        Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'Ha ocurrido un error al realizar el pago, intenta más tarde',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#dc2626',
            background: '#fef2f2'
        });
    },
    onClick: function() {
        // SweetAlert de confirmación antes de iniciar el pago (opcional)
        /* Swal.fire({
            title: '¿Proceder con el pago?',
            text: 'Serás redirigido a PayPal para completar tu compra',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#6b7280'
        }); */
    }
}).render('#paypal-button-container');

// Código para formulario de tarjeta de crédito (comentado)
/*
const creditCardButton = document.getElementById('credit-card-button');
const creditCardForm = document.getElementById('credit-card-form');

if (creditCardButton && creditCardForm) {
    creditCardButton.addEventListener('click', function() {
        creditCardForm.classList.toggle('hidden');
    });
}
*/