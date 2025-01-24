

<div class="container ">
    <footer class="py-5">
      <div class="row text-center text-md-start">
        <div class="col-12 col-md-3 mb-3">
          <h5>Atención al cliente</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Política de devolución y
                reembolso</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Política de propiedad
                intelectual</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Política de envíos</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Reportar actividad
                sospechosa</a></li>
          </ul>
        </div>
        <div class="col-12 col-md-3 mb-3">
          <h5>Ayuda</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Centro de ayuda y preguntas
                frecuentes</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Centro de seguridad</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Protección de compras de
                seller</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Asóciate a seller</a></li>
          </ul>
        </div>
        <div class="col-12 col-md-6 mb-3">
          <form>
            <h5>Suscríbete a nuestro boletín</h5>
            <p>Resumen mensual de lo nuevo y emocionante de nuestra parte.</p>
            <div class="d-flex flex-column flex-sm-row w-100 gap-2 justify-content-center">
              <label for="newsletter1" class="visually-hidden">Dirección de correo electrónico</label>
              <input id="newsletter1" type="text" class="form-control" placeholder="Dirección de correo electrónico">
              <button class="btn btn-primary" type="button">Suscribirse</button>
            </div>
          </form>
        </div>
      </div>
      <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top align-items-center">
        <p class="mb-0 text-center">&copy; 2025 Servitelecomunicaciones SAS. Todos los derechos reservados.</p>
        <ul class="list-unstyled d-flex justify-content-center mb-0">
          <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="48" height="48">
                <use xlink:href="#twitter" /></svg></a></li>
          <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="48" height="48">
                <use xlink:href="#instagram" /></svg></a></li>
          <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="48" height="48">
                <use xlink:href="#facebook" /></svg></a></li>
        </ul>
      </div>
    </footer>
  </div>
  <div class="container">
    <div class="row">
      <div class="col">
        <h6>DISEÑO: <a href="https://www.canva.com/design/DAGcey64300/qIvq-KDkmEY8ug5nYEBF7A/edit"><span>aqui</span></a>
        </h6>
      </div>
    </div>
  </div>
  <br>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Incluye la librería de SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    // Función para obtener parámetros de la URL
    function getQueryParam(param) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }

    // Detectar si 'm=loginOk' está presente en la URL
    if (getQueryParam('m') === 'loginOk') {
      // Mostrar SweetAlert2
      Swal.fire({
        title: '¡Ingreso Éxitoso!',
        text: 'ya puedes comprar.',
        icon: 'success',
        timer: 3000, // 3 segundos
        timerProgressBar: true,
        showCloseButton: true, // Habilitar botón de cerrar (X)
        showConfirmButton: false, // Ocultar botón de confirmación
        closeButtonHtml: '&times;', // Personalizar el botón de cerrar
      });
    }
  </script>
  <script src="assets/js/carrito.js"></script>
</body>
</html>