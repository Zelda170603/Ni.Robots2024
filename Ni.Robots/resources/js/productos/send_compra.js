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
                alert('Transaction completed with Compra ID: ' + orderData.compra_id);
                setTimeout(() => {
                    window.location.href = '/compras'; // Replace with your target URL
                }, 2000);
            })
            .catch(error => {
                console.error('There was an error processing the order:', error);
                alert('Ha ocurrido un error al realizar el pago: ' + error.message);
            });
    },
    onError: function(err) {
        console.log(err);
        alert("Ha ocurrido un error al realizar el pago, intentar más tarde");
    }
}).render('#paypal-button-container');
/* Obtener referencias a los elementos
const creditCardButton = document.getElementById('credit-card-button');
const creditCardForm = document.getElementById('credit-card-form');

// Añadir un evento para mostrar el formulario de tarjeta de crédito al hacer clic en el botón
creditCardButton.addEventListener('click', function() {
    creditCardForm.classList.toggle('hidden');
});*/