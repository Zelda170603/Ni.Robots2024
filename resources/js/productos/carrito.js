document.addEventListener("DOMContentLoaded", function () {
    const openCartButton = document.getElementById('openCartButton'),
        closeCartButton = document.getElementById('closeCartButton'),
        cartDrawer = document.getElementById('cart-content'),
        overlay = document.getElementById('overlay'),
        cartlist = document.getElementById("product-list");

    openCartButton.addEventListener('click', () => {
        cartDrawer.classList.remove('translate-x-full');
        overlay.classList.remove('opacity-0', 'pointer-events-none');
    });

    closeCartButton.addEventListener('click', () => {
        cartDrawer.classList.add('translate-x-full');
        overlay.classList.add('opacity-0', 'pointer-events-none');
    });

    overlay.addEventListener('click', () => {
        cartDrawer.classList.add('translate-x-full');
        overlay.classList.add('opacity-0', 'pointer-events-none');
    });

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            let productId = this.getAttribute('data-product-id');
    
            fetch(`/carrito/store/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.text()) // Cambiar a .text() para depurar
            .then(data => {
                updateCartTotal();
                console.log('Raw response:', data); // Log de la respuesta cruda
                try {
                    const jsonData = JSON.parse(data); // Intentar parsear la respuesta
                    if (jsonData.html) {
                        alert(jsonData.html);
                    } else {
                        alert('Hubo un problema al añadir el producto al carrito.');
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '/carrito', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.responseText);
                    cartlist.innerHTML = data.html; // Actualiza el contenido del contenedor con el HTML recibido
                } else {
                    console.error('Request failed with status:', xhr.status);
                }
            }
        };
        xhr.onerror = function () {
            console.error('Request failed');
        };
        xhr.send();
    }, 2000);

    function incrementQuantity(productId) {
        const input = document.getElementById('counter-input-' + productId);
        let currentValue = parseInt(input.value);
        const maxStock = parseInt(input.getAttribute('data-stock'));
    
        if (currentValue < maxStock) {
            input.value = currentValue + 1;
            updateQuantity(productId, input.value);
        } else {
            alert('No hay suficientes existencias disponibles.');
        }
    }
    
    function decrementQuantity(productId) {
        const input = document.getElementById('counter-input-' + productId);
        let currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            updateQuantity(productId, input.value);
        }
    }
    
    function updateQuantity(productId, newQuantity) {
        const input = document.getElementById('counter-input-' + productId);
        const priceElement = document.getElementById('price-' + productId);
        let productPrice = parseFloat(priceElement.getAttribute('data-price'));
        input.value = newQuantity;
        // Update the total price displayed for the product
        priceElement.innerText = '$' + (productPrice * newQuantity).toFixed(2);
        // Update the quantity in the backend
        fetch('/carrito/update', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                productoId: productId,
                cantidad: newQuantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartTotal();
                console.log('Quantity updated successfully');
            } else {
                console.error('Failed to update quantity');
            }
        })
        .catch(error => {
            console.error('Error updating quantity:', error);
        });
    }

    document.querySelectorAll('.delete-from-cart').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            let productId = this.getAttribute('data-product-id');
            deleteProductFromCart(productId);
        });
    });

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
            method: 'GET', headers: { 'Content-Type': 'application/json', 
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
    
    
    // Expose functions to the global scope
    window.incrementQuantity = incrementQuantity;
    window.decrementQuantity = decrementQuantity;
    window.deleteProductFromCart = deleteProductFromCart;
});


