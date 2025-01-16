<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="assets/plantilla/bootstrap_5.3.3/assets/js/color-modes.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors modified: Jose bohorquez">
  <meta name="generator" content="Hugo 0.122.0">
  <title>Seller-login</title>
  <link rel="icon" href="assets/imagenes/landing/logo_servitel.ico" type="image/x-icon">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/footers/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="assets/plantilla/bootstrap_5.3.3/assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/b3a2e83ff1.js" crossorigin="anonymous"></script>
  <style>
    /* Estilos para el contenedor del login */
    .login-container {
      background-image: url("assets/imagenes/login/fondo1.webp");
      background-size: cover;
      /* Ajusta la imagen para que quepa dentro del contenedor */
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .form-signin {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .btn-bd-primary-v2 {
      --bs-btn-bg: #fe6902;
      --bs-btn-border-color: #fe6902;
      background: linear-gradient(45deg, #fe6902, #f64d00);
      border: 2px solid #fe6902;
    }

    .btn-bd-primary-v2:hover {
      background: linear-gradient(45deg, #f64d00, #fe6902);
      border-color: #f64d00;
    }

    .btn-bd-primary-v2:active {
      background: linear-gradient(45deg, #e64a00, #f64d00);
      border-color: #e64a00;
    }

    .bd-mode-toggle {
      z-index: 1500;
      position: fixed;
      bottom: 20px;
      right: 20px;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }

    #scrollToTopBtn {
      z-index: 1500;
      position: fixed;
      bottom: 20px;
      left: 20px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    #scrollToTopBtn.show {
      opacity: 1;
    }

    #scrollToTopBtn svg {
      width: 1em;
      height: 1em;
      fill: currentColor;
    }

    .form-signin {
      display: flex;
      min-height: 100vh;
      align-items: center;
      justify-content: center;
    }

    .card {
      /* Usamos clases de Bootstrap para el fondo y el borde */
      background-color: var(--bs-body-bg);
      border: 2px solid var(--bs-body-color);
      box-shadow: 0px 0px 50px rgba(255, 105, 2, 0.5);
      backdrop-filter: blur(10px);
    }

    /* Usamos text-body para el color del texto */
    .form-floating label,
    .form-check-label,
    a,
    .form-control {
      color: var(--bs-text-color);
    }
  </style>
</head>

<body class="login-container">
  <div class="dropdown bd-mode-toggle">
    <button class="btn btn-sm btn-bd-primary-v2 py-2 dropdown-toggle d-flex align-items-center" id="bd-theme"
      type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Cambiar tema (automático)">
      <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
        <use href="#circle-half"></use>
      </svg>
      <span class="visually-hidden" id="bd-theme-text">Cambiar tema</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50" width="1em" height="1em">
            <use href="#sun-fill"></use>
          </svg>
          Claro
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50" width="1em" height="1em">
            <use href="#moon-stars-fill"></use>
          </svg>
          Oscuro
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
          aria-pressed="true">
          <svg class="bi me-2 opacity-50" width="1em" height="1em">
            <use href="#circle-half"></use>
          </svg>
          Automático
        </button>
      </li>
    </ul>
  </div>
  <button id="scrollToTopBtn" class="btn btn-sm btn-bd-primary-v2 py-2">
    <i class="fa-solid fa-angles-up"></i>
    <span class="visually-hidden">Subir al inicio</span>
  </button>
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path
        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path
        d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
      <path
        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path
        d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
    </symbol>
  </svg>
  <script>
    // Mostrar el botón de subir al inicio cuando el usuario baja
    window.onscroll = function () {
      var scrollToTopBtn = document.getElementById("scrollToTopBtn");
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        scrollToTopBtn.classList.add("show");
      } else {
        scrollToTopBtn.classList.remove("show");
      }
    };

    // Función para ir al inicio al hacer click en el botón
    document.getElementById("scrollToTopBtn").addEventListener("click", function () {
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });
  </script>
  
  <main class="form-signin text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-5 col-lg-5"> <!-- Ajuste el ancho aquí -->
          <div class="card p-4">
            <a href="index.php">
              <img class="img-fluid mb-3 py-5" src="assets/imagenes/landing/logo_servitel.png">
            </a>
            <form method="POST">
              <h1 class="h3 mb-3 fw-normal">Inicio de Sesión</h1>
              <div class="form-floating mb-3">
                <input name="correo" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required autofocus>
                <label for="floatingInput">Ingrese su correo</label>
              </div>
              <div class="form-floating mb-3">
                <input name="passCorreo" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Ingrese su contraseña</label>
              </div>
              <?php echo isset($_GET['m']) && $_GET['m'] === 'loginFailed' ? '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-circle"></i> Error: Inicio de sesión fallido. <br> Inténtalo de nuevo.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>' : '';              ?>
              <button class="btn btn-primary w-100" type="submit">Iniciar Sesión</button>
              <p class="mt-3 mb-0">
                ¿No tienes cuenta? <a href="?c=Registry">Regístrate</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="assets/plantilla/bootstrap_5.3.3/assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/carrusel.js"></script>
</body>

</html>