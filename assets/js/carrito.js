document.addEventListener('DOMContentLoaded', () => {
    const modalCarrito = document.querySelector('#modalCarrito');
    const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');
    const pagarCarritoBtn = document.querySelector('#pagar-carrito'); // Botón Pagar del modal
    const totalCarritoNav = document.querySelector('#total-carrito'); // Total en el navbar
    const cartCount = document.querySelector('#cart-count'); // Contador de productos en el carrito
    const cartItemsList = document.querySelector('#cart-items'); // Lista de productos en el checkout
    const cartTotalCheckout = document.querySelector('#cart-total'); // Total en el checkout

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

                        // Si estamos en el checkout, actualizamos la lista
                        if (cartItemsList) {
                            cartItemsList.innerHTML += `
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">${nombre}</h6>
                                        <small class="text-muted">Cantidad: ${cantidad}</small>
                                    </div>
                                    <span class="text-muted">$${subtotal.toFixed(2)}</span>
                                </li>`;
                        }
                    }
                } else {
                    contenidoCarrito.innerHTML = `
                        <tr>
                            <td colspan="4" class="text-center">No hay productos en el carrito.</td>
                        </tr>`;

                    // Si estamos en el checkout
                    if (cartItemsList) {
                        cartItemsList.innerHTML = `
                            <li class="list-group-item text-center">
                                Tu carrito está vacío.
                            </li>`;
                    }
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

                // Actualizar el total en el checkout
                if (cartTotalCheckout) {
                    cartTotalCheckout.textContent = `$${total.toFixed(2)}`;
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
            const disponiblesElement = button.parentElement.querySelector('.disponibles'); // Buscar el campo "Disponibles"

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
                        // Actualizar dinámicamente los disponibles
                        if (disponiblesElement) {
                            const disponibles = parseInt(disponiblesElement.textContent.split(': ')[1]); // Leer el número
                            if (disponibles > 0) {
                                disponiblesElement.textContent = `Disponibles: ${disponibles - 1}`;
                            }
                        }
                        // Mostrar SweetAlert para notificar al usuario y recargar la página al cerrarlo
                        Swal.fire({
                            title: 'Producto Agregado',
                            text: 'El producto fue añadido al carrito.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'index.php?c=Landing&a=main'; // Recargar a la vista deseada
                        });
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
                        location.reload();
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

    // Función para redirigir al checkout al presionar "Pagar"
    if (pagarCarritoBtn) {
        pagarCarritoBtn.addEventListener('click', () => {
            window.location.href = 'index.php?c=Landing&a=checkout'; // Redirigir al checkout
        });
    }

    // Cargar contenido del carrito al abrir el modal
    if (modalCarrito) {
        modalCarrito.addEventListener('show.bs.modal', actualizarCarrito);
    }

    // Actualizar el carrito al cargar la página
    actualizarCarrito();
});
