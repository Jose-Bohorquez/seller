document.addEventListener('DOMContentLoaded', () => {
    // Capturar clic en los botones "Agregar al carrito"
    document.querySelectorAll('.agregar-al-carrito').forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-id');
            const cantidad = 1; // Por defecto 1, puedes cambiar esto según tu lógica

            fetch('index.php?c=Products&a=manage_cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'add_to_cart',
                    id: productId,
                    cantidad: cantidad
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Producto agregado al carrito');
                    actualizarContenidoCarrito(data.carrito, data.total);
                } else {
                    alert(data.message || 'Error al agregar el producto al carrito.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});



function actualizarContenidoCarrito(carrito, total) {
    const contenidoCarrito = document.getElementById('contenido-carrito');
    const totalCarritoModal = document.getElementById('total-carrito-modal');
    const totalCarritoNav = document.getElementById('total-carrito');

    contenidoCarrito.innerHTML = '';

    for (const id in carrito) {
        const producto = carrito[id];
        contenidoCarrito.innerHTML += `
            <tr>
                <td><img src="${producto.imagen}" alt="${producto.nombre}" style="width: 50px;"></td>
                <td>${producto.nombre}</td>
                <td>${producto.cantidad}</td>
                <td>$${producto.precio}</td>
                <td>$${(producto.precio * producto.cantidad).toFixed(2)}</td>
                <td>
                    <button class="btn btn-danger btn-sm eliminar-producto" data-id="${id}">Eliminar</button>
                </td>
            </tr>
        `;
    }

    totalCarritoModal.textContent = `$${total.toFixed(2)}`;
    totalCarritoNav.textContent = `$${total.toFixed(2)}`;

    // Agregar eventos a los botones "Eliminar"
    document.querySelectorAll('.eliminar-producto').forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-id');
            const confirmDelete = confirm('¿Seguro que deseas eliminar este producto del carrito?');

            if (confirmDelete) {
                fetch('index.php?c=Products&a=manage_cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'remove_one',
                        id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        actualizarContenidoCarrito(data.carrito, data.total);
                    } else {
                        alert('Error al eliminar el producto.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });

}






document.addEventListener('DOMContentLoaded', () => {
    const vaciarCarritoBtn = document.getElementById('vaciar-carrito');
    if (vaciarCarritoBtn) {
        vaciarCarritoBtn.addEventListener('click', () => {
            fetch('index.php?c=Products&a=manage_cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'empty_cart'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('El carrito ha sido vaciado.');
                    actualizarContenidoCarrito(data.carrito, data.total);
                } else {
                    alert('Error al vaciar el carrito.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
