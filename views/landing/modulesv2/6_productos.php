
<div class="container my-5 product-section">
      <div class="d-flex align-items-center mb-4">
        <h2 class="text-start mb-0 position-relative">
          Estrena Celular con Descuentos al Piso
          <span
            style="position: absolute; bottom: -5px; left: 0; height: 4px; width: 100%; background-color: red;"></span>
        </h2>
      </div>
      <br>
      <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6 g-3">
        <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
        <div class="col">
          <div class="card text-center position-relative">
            <!-- Listón de oferta -->
            <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1 fw-bold"
              style="clip-path: polygon(0 0, 100% 0, 80% 100%, 0% 100%); font-size: 0.9em;">
              Oferta
            </div>
            <!-- Imagen del producto -->
            <img src="<?= $product->get_image(); ?>" class="card-img-top"
              alt="<?= htmlspecialchars($product->get_name()); ?>" style="height: 150px; object-fit: contain;">
            <!-- Información del producto -->
            <div class="card-body">
              <h5><?= htmlspecialchars($product->get_name()); ?></h5>
              <p class="text-muted text-decoration-line-through">$<?= number_format($product->get_price() * 1.2, 2); ?>
              </p>
              <p class="text-primary fw-bold">$<?= number_format($product->get_price(), 2); ?></p>
              <!-- <a href="#" class="btn btn-primary btn-sm">Comprar</a> -->

              <button class="btn btn-primary agregar-al-carrito" data-id="<?= $product->get_id(); ?>">Añadir al
                carrito</button>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-center">No hay productos disponibles.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const loadMoreButton = document.getElementById("loadMore");
      const productCards = document.querySelectorAll(".product-card");
      let visibleCards = 4;
      if (loadMoreButton) {
        loadMoreButton.addEventListener("click", function () {
          const totalCards = productCards.length;
          const nextVisibleCards = visibleCards + 4;

          for (let i = visibleCards; i < nextVisibleCards && i < totalCards; i++) {
            productCards[i].style.display = "block";
          }
          visibleCards = nextVisibleCards;
          // Ocultar el botón si se muestran todos los productos
          if (visibleCards >= totalCards) {
            loadMoreButton.style.display = "none";
          }
        });
      }
    });
  </script>