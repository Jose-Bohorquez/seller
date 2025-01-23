document.addEventListener('DOMContentLoaded', () => {
    const modalCarrito = document.querySelector('#modalCarrito');
    const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');
    const pagarCarritoBtn = document.querySelector('#pagar-carrito');
    const totalCarritoNav = document.querySelector('#total-carrito'); // Total en el navbar
    const cartCount = document.querySelector('#cart-count'); // Contador de productos en el carrito

    // Función para actualizar el contenido del carrito
    function actualizarCarrito() {
        fetch('index.php?c=CartController&a=showCart')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                const contenidoCarrito = document.querySelector('#contenido-carrito');
                const totalCarritoModal = document.querySelector('#modal-total-carrito'); // Total en el modal
                contenidoCarrito.innerHTML = '';
                let total = 0;
                let cantidadTotal = 0;

                if (data.carrito && Object.keys(data.carrito).length > 0) {
                    for (const id in data.carrito) {
                        const producto = data.carrito[id];

                        // Validar valores antes de usarlos
                        const nombre = producto.nombre || 'Producto desconocido';
                        const cantidad = parseInt(producto.cantidad) || 0;
                        const precio = parseFloat(producto.precio) || 0;
                        const subtotal = cantidad * precio;

                        total += subtotal;
                        cantidadTotal += cantidad;

                        contenidoCarrito.innerHTML += `
                            <tr>
                                <td>${nombre}</td>
                                <td>${cantidad}</td>
                                <td>$${precio.toFixed(2)}</td>
                                <td>$${subtotal.toFixed(2)}</td>
                            </tr>
                        `;
                    }
                } else {
                    contenidoCarrito.innerHTML = `
                        <tr>
                            <td colspan="4" class="text-center">No hay productos en el carrito.</td>
                        </tr>`;
                }

                // Actualizar el total en el modal
                if (totalCarritoModal) {
                    totalCarritoModal.textContent = `$${total.toFixed(2)}`;
                }

                // Actualizar el total en el navbar
                if (totalCarritoNav) {
                    totalCarritoNav.textContent = `$${total.toFixed(2)}`;
                }

                // Actualizar el contador de productos en el carrito
                if (cartCount) {
                    cartCount.textContent = cantidadTotal > 0 ? cantidadTotal : '';
                    cartCount.style.display = cantidadTotal > 0 ? 'inline-block' : 'none';
                }
            })
            .catch(error => {
                console.error('Error al cargar el carrito:', error);
                Swal.fire('Error', 'Hubo un problema al cargar el carrito. Inténtalo nuevamente.', 'error');
            });
    }

    // Función para añadir productos al carrito
    document.querySelectorAll('.agregar-al-carrito').forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-id');

            fetch('index.php?c=CartController&a=addToCart', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${productId}&cantidad=1`
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al añadir el producto al carrito');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire('Producto Agregado', 'El producto fue añadido al carrito.', 'success');
                        actualizarCarrito();
                    } else {
                        Swal.fire('Error', data.message || 'No se pudo añadir el producto.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error al agregar producto al carrito:', error);
                    Swal.fire('Error', 'Hubo un problema al añadir el producto. Inténtalo nuevamente.', 'error');
                });
        });
    });

    // Función para vaciar el carrito
    if (vaciarCarritoBtn) {
        vaciarCarritoBtn.addEventListener('click', () => {
            fetch('index.php?c=CartController&a=clearCart', { method: 'POST' })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al vaciar el carrito');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire('Carrito Vacío', 'El carrito se ha vaciado correctamente.', 'success');
                        actualizarCarrito();
                    } else {
                        Swal.fire('Error', 'No se pudo vaciar el carrito.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error al vaciar el carrito:', error);
                    Swal.fire('Error', 'Hubo un problema al vaciar el carrito. Inténtalo nuevamente.', 'error');
                });
        });
    }

    // Función para pagar el carrito
    if (pagarCarritoBtn) {
        pagarCarritoBtn.addEventListener('click', () => {
            window.location.href = 'index.php?c=PaymentController&a=showPaymentPage';
        });
    }

    // Cargar contenido del carrito al abrir el modal
    if (modalCarrito) {
        modalCarrito.addEventListener('show.bs.modal', actualizarCarrito);
    }

    // Actualizar el carrito al cargar la página
    actualizarCarrito();
});
