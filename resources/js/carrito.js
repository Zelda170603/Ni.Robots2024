document.addEventListener('DOMContentLoaded', () => {
    const openCartButton = document.getElementById('openCartButton');
    const closeCartButton = document.getElementById('closeCartButton');
    const cartDrawer = document.getElementById('cart-content');
    const overlay = document.getElementById('overlay');

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
});

const buttons = document.querySelectorAll('.add-to-cart')
        productList = document.getElementById('product-list');
buttons.forEach(button => {
    button.addEventListener('click', function () {
        let productId = this.getAttribute('data-product-id');
        
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.responseText);
                    productList.innerHTML = data.html; // Actualiza el contenido del contenedor con el HTML recibido
                } else {
                    console.error('Request failed with status:', xhr.status);
                }
            }
        }
        xhr.onerror = function () {
            console.error('Request failed');
        };
    
        xhr.send(JSON.stringify({ productId: productId}));
    });
});

