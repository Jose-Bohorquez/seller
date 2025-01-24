
    <!-- Modal del carrito -->
    <!-- Modal del carrito -->
    <div class="modal fade" id="modalCarrito" tabindex="-1" aria-labelledby="modalCarritoLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCarritoLabel">Tu Carrito</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody id="contenido-carrito">
                  <!-- Productos cargados dinámicamente -->
                </tbody>
              </table>
            </div>
            <div class="text-end">
              <h5>Total:<span id="modal-total-carrito">0.00</span></h5>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-danger" id="vaciar-carrito">Vaciar carrito</button>
            <button type="button" class="btn btn-success" id="pagar-carrito">Pagar</button>
          </div>

        </div>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const modalCarrito = document.querySelector("#modalCarrito");
        modalCarrito.addEventListener("show.bs.modal", function () {
          fetch("?c=CartController&a=showCart")
            .then(response => response.json())
            .then(data => {
              const tbody = document.querySelector("#contenido-carrito");
              const totalCarrito = document.querySelector("#total-carrito");
              tbody.innerHTML = "";
              let total = 0;

              if (data.carrito) {
                for (let producto of Object.values(data.carrito)) {
                  total += producto.subtotal;
                  tbody.innerHTML += `
                            <tr>
                                <td>${producto.nombre}</td>
                                <td>${producto.cantidad}</td>
                                <td>$${producto.precio.toFixed(2)}</td>
                                <td>$${producto.subtotal.toFixed(2)}</td>
                            </tr>
                        `;
                }
              }
              totalCarrito.textContent = total.toFixed(2);
            });
        });
        document.querySelector("#vaciar-carrito").addEventListener("click", function () {
          fetch("?c=CartController&a=clearCart", {
              method: "POST"
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                document.querySelector("#contenido-carrito").innerHTML = "";
                document.querySelector("#total-carrito").textContent = "0.00";
              }
            });
        });
      });
    </script>
    <?php
#session_start();
//agregar al carrito
if (isset($_POST['id'])) {
    $productId = $_POST['id'];

    // Conectar a la base de datos y obtener la información del producto
    // Asegúrate de tener una clase de productos para obtener los datos (como Product::get_product_by_id($productId))
    $producto = new Product();
    $productoInfo = $producto->get_product_by_id($productId);

    // Verifica si ya existe el carrito
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Verifica si el producto ya está en el carrito
    if (isset($_SESSION['carrito'][$productId])) {
        // Si el producto ya está en el carrito, aumentamos la cantidad
        $_SESSION['carrito'][$productId]['cantidad']++;
    } else {
        // Si no está en el carrito, lo agregamos
        $_SESSION['carrito'][$productId] = [
            'id' => $productoInfo->get_id(),
            'nombre' => $productoInfo->get_name(),
            'precio' => $productoInfo->get_price(),
            'cantidad' => 1,
            'imagen' => $productoInfo->get_image(),
        ];
    }

    echo "Producto agregado al carrito!";
}
?>
    <br>