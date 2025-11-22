import Swal from 'sweetalert2';
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
            .then(response => response.text())
            .then(data => {
                updateCartTotal();
                console.log('Raw response:', data);
                try {
                    const jsonData = JSON.parse(data);
                    if (jsonData.html) {
                        // SweetAlert de éxito
                        Swal.fire({
                            icon: 'success',
                            title: '¡Producto añadido!',
                            text: 'El producto se ha añadido al carrito',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            background: '#f0fdf4',
                            iconColor: '#16a34a'
                        });
                    } else {
                        // SweetAlert de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al añadir el producto al carrito.',
                            confirmButtonText: 'Entendido',
                            confirmButtonColor: '#dc2626'
                        });
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al procesar la respuesta del servidor.',
                        confirmButtonText: 'Entendido'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo conectar con el servidor.',
                    confirmButtonText: 'Entendido'
                });
            });
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
                    cartlist.innerHTML = data.html;
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
            // SweetAlert para stock insuficiente
            Swal.fire({
                icon: 'warning',
                title: 'Stock insuficiente',
                text: 'No hay suficientes existencias disponibles.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#fffbeb',
                iconColor: '#d97706'
            });
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
        
        priceElement.innerText = '$' + (productPrice * newQuantity).toFixed(2);
        
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
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo actualizar la cantidad.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        })
        .catch(error => {
            console.error('Error updating quantity:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar la cantidad.',
                confirmButtonText: 'Entendido'
            });
        });
    }

    document.querySelectorAll('.delete-from-cart').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            let productId = this.getAttribute('data-product-id');
            
            // SweetAlert de confirmación antes de eliminar
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteProductFromCart(productId);
                }
            });
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
                updateCartTotal();
                
                // Eliminar el elemento del DOM
                const cartItem = document.getElementById(`cart-item-${productId}`);
                if (cartItem) {
                    cartItem.remove();
                }
                
                // SweetAlert de éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Eliminado!',
                    text: data.message || 'Producto eliminado del carrito.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#fef2f2',
                    iconColor: '#dc2626'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al eliminar el producto del carrito.',
                    confirmButtonText: 'Entendido'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al eliminar el producto.',
                confirmButtonText: 'Entendido'
            });
        });
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
    
    // Expose functions to the global scope
    window.incrementQuantity = incrementQuantity;
    window.decrementQuantity = decrementQuantity;
    window.deleteProductFromCart = deleteProductFromCart;
});