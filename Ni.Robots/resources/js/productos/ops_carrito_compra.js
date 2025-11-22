import Swal from 'sweetalert2';

const cartlist = document.getElementById("product-list");

// Función para eliminar un producto del carrito
function deleteProductFromCart(productId) {
    // SweetAlert de confirmación antes de eliminar
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        background: '#fff',
        iconColor: '#eab308',
        customClass: {
            confirmButton: 'swal2-confirm',
            cancelButton: 'swal2-cancel'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceder con la eliminación
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
                    
                    // Eliminar el elemento del DOM si existe
                    const cartItem = document.getElementById(`cart-item-${productId}`);
                    if (cartItem) {
                        cartItem.remove();
                    }
                    
                    // SweetAlert de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Eliminado!',
                        text: data.message || 'Producto eliminado del carrito correctamente.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        background: '#f0fdf4',
                        iconColor: '#16a34a',
                        customClass: {
                            popup: 'swal2-toast'
                        }
                    });
                } else {
                    // SweetAlert de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Hubo un problema al eliminar el producto del carrito.',
                        confirmButtonText: 'Entendido',
                        confirmButtonColor: '#dc2626',
                        background: '#fef2f2'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo conectar con el servidor. Inténtalo de nuevo.',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#dc2626'
                });
            });
        }
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
        
        if (tax) subtotal.innerText = `$${data.subtotal.toFixed(2)}`;
        if (subtotal) tax.innerText = `$${data.tax.toFixed(2)}`;
        if (total) total.innerText = `$${data.total.toFixed(2)}`;
    })
    .catch(error => {
        console.error('Error:', error);
        // Opcional: mostrar alerta de error al actualizar el total
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo actualizar el total del carrito.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
    });
}

// Inicializar el total del carrito al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    updateCartTotal();
});

// Si necesitas llamar a updateCartTotal() inmediatamente (fuera del DOMContentLoaded)
// asegúrate de que el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', updateCartTotal);
} else {
    updateCartTotal();
}

// Hacer las funciones disponibles globalmente si es necesario
window.deleteProductFromCart = deleteProductFromCart;
window.updateCartTotal = updateCartTotal;