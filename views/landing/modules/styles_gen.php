<?php /*
    <!-- usu fontawesome xenito3010@evnft.com pwd abc.123. -->
    <!-- <link rel ="stylesheet" href="assets/css/registro.css" type="text/css">
    <link rel ="stylesheet" href="assets/css/categoria.css" type="text/css"> -->
    */ ?>
  <style>
    /* Estilos generales para los íconos y elementos */
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    /* Estilo para el primer botón (botón base violeta) */
    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    /* Estilo para el segundo botón (botón base naranja) */
    .btn-bd-primary-v2 {
      --bd-orange-bg: #fe6902;
      --bd-orange-rgb: 254, 105, 2;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-orange-bg);
      /* Color base */
      --bs-btn-border-color: var(--bd-orange-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #f64d00;
      /* Un tono más oscuro de naranja para el hover */
      --bs-btn-hover-border-color: #f64d00;
      /* Borde del hover */
      --bs-btn-focus-shadow-rgb: var(--bd-orange-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #e64a00;
      /* Un color aún más oscuro para el estado activo */
      --bs-btn-active-border-color: #e64a00;

      background: linear-gradient(45deg, #fe6902, #f64d00);
      /* Degradado de naranja */
      border: 2px solid #fe6902;
    }

    .btn-bd-primary-v2:hover {
      background: linear-gradient(45deg, #f64d00, #fe6902);
      /* Degradado invertido para el hover */
      border-color: #f64d00;
    }

    .btn-bd-primary-v2:active {
      background: linear-gradient(45deg, #e64a00, #f64d00);
      /* Degradado para el estado activo */
      border-color: #e64a00;
    }

    /* **Estilo para el botón de cambiar tema (ahora a la derecha)** */
    .bd-mode-toggle {
      z-index: 1500;
      position: fixed;
      bottom: 20px;
      /* Ubicación en la parte inferior */
      right: 20px;
      /* Botón a la derecha */
    }

    /* **Resaltar el ícono de estado activo del tema** */
    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }

    /* **Estilo para el botón de subir al inicio (ahora a la izquierda)** */
    #scrollToTopBtn {
      z-index: 1500;
      position: fixed;
      bottom: 20px;
      /* Ubicación en la parte inferior */
      left: 20px;
      /* Botón a la izquierda */
      opacity: 0;
      /* Por defecto el botón está oculto */
      transition: opacity 0.3s ease;
      /* Transición suave al aparecer */
    }

    /* **Mostrar el botón de subir al inicio cuando se hace scroll** */
    #scrollToTopBtn.show {
      opacity: 1;
      /* El botón aparece cuando se activa la clase 'show' */
    }

    /* **Estilo del ícono dentro del botón de subir** */
    #scrollToTopBtn svg {
      width: 1em;
      height: 1em;
      fill: currentColor;
    }

    /* Estilo por defecto para el logo */
    #logo-servitel {
      transition: opacity 0.3s ease-in-out;
    }

    /* Logo para el tema oscuro */
    body[data-bs-theme="dark"] #logo-servitel {
      content: url('assets/imagenes/landing/logo_servitel_dark.png');
      /* Ruta del logo oscuro */
      opacity: 1;
      /* Asegurarse de que sea completamente visible */
    }

    /* Logo para el tema claro (opcional, si tienes una imagen diferente para el claro) */
    body[data-bs-theme="light"] #logo-servitel {
      content: url('assets/imagenes/landing/logo_servitel.png');
      /* Ruta del logo claro */
      opacity: 1;
      /* Asegurarse de que sea completamente visible */
    }

    /*estilos para el carrousel*/
    #ground {
      width: 900px;
      height: 900px;
      position: absolute;
      top: 100%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%) rotateX(90deg);
      transform: translate(-50%, 50%) rotatex(90deg);
      background: -webkit-radial-gradient(center center, farthest-side, #9993, transparent);

    }

    @-webkit-keyframes spin {
      from {
        -webkit-transform: rotateY(0deg);
        transform: rotateY(0deg);
      }

      to {
        -webkit-transform: rotateY(360deg);
        transform: rotateY(360deg);
      }
    }

    @keyframes spin {
      from {
        -webkit-transform: rotateY(0deg);
        transform: rotateY(0deg);
      }

      to {
        -webkit-transform: rotateY(360deg);
        transform: rotateY(360deg);
      }
    }

    @-webkit-keyframes spinRevert {
      from {
        -webkit-transform: rotateY(360deg);
        transform: rotateY(360deg);
      }

      to {
        -webkit-transform: rotateY(0deg);
        transform: rotateY(0deg);
      }
    }

    @keyframes spinRevert {
      from {
        -webkit-transform: rotateY(360deg);
        transform: rotateY(360deg);
      }

      to {
        -webkit-transform: rotateY(0deg);
        transform: rotateY(0deg);
      }
    }

    #drag-container,
    #spin-container {
      position: relative;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      margin: auto;
      -webkit-transform-style: preserve-3d;
      transform-style: preserve-3d;
      -webkit-transform: rotateX(-10deg);
      transform: rotateX('-10deg');
    }

    #drag-container img,
    #drag-container video {
      -webkit-transform-style: preserve-3d;
      transform-style: preserve-3d;
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      line-height: 200px;
      font-size: 50px;
      text-align: center;
      -webkit-box-shadow: 0 0 8px #fff;
      box-shadow: 0 0 #fff;
      -webkit-box-reflect: below 10px linear-gradient(transparent, transparent, #0005);
    }

    #drag-container img:hover,
    #drag-container video:hover {
      -webkit-box-shadow: 0 0 15px #fff;
      box-shadow: 0 0 15px #fff;
      -webkit-box-reflect: below 10px linear-gradient(transparent, transparent, #0006);

    }

    #drag-container p {
      font-family: serif;
      position: absolute;
      padding-top: 100%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%) rotateX(90deg);
      transform: translate(-50%, -50%) rotateX(90deg);
      color: #000;

    }
  </style>