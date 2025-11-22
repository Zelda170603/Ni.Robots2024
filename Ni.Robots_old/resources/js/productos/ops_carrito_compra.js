
cartlist = document.getElementById("product-list");

// Función para eliminar un producto del carrito
function deleteProductFromCart(productId) {
    fetch(`/carrito/delete/${productId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartTotal()
                alert(data.message);
                // Eliminar el elemento del DOM si es necesario
                document.getElementById(`cart-item-${productId}`).remove();
            } else {
                alert('Hubo un problema al eliminar el producto del carrito.');
            }
        })
        .catch(error => console.error('Error:', error));
}

function updateCartTotal() {
    fetch('/carrito/total', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => response.json())
        .then(data => {
            let tax = document.getElementById("cart-tax");
            let subtotal = document.getElementById("cart-originalprice");
            let total = document.getElementById('cart-total');
            subtotal.innerText = `$${data.subtotal.toFixed(2)}`;
            tax.innerText = `$${data.tax.toFixed(2)}`;
            total.innerText = `$${data.total.toFixed(2)}`;
        })
        .catch(error => console.error('Error:', error));
}
updateCartTotal();