<!DOCTYPE html>
<html>
<head>
<title>menu-p</title>
<meta charset="UTF-8">
<link rel ="stylesheet" href="assets/css/registro.css" type="text/css">
<link rel ="stylesheet" href="assets/css/categoria.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
</style>
</head>
<body>

    <header class="header">
        <div class="menu container">
            <a href="#" class="logo">logo </a>
            <input type="checkbox" id="menu"/>
            <label for="menu">
                <img  src="img/menu.png" class="menu-icono" alt="menu">
            </label>
            <nav  class="navbar">
                <ul>
                    <li><a href="#">inicio</a></li>
                    <li><a href="#">servicios</a></li>
                    <li><a href="#">categoria</a></li>
                    <li><a href="#">contacto</a></li>
                    <li><a href="?c=Roles&a=validar" >inicio sesion / registrarse</a></li>
                    <!-- <li><a href="?c=Roles&a=mostrarFormularioRol" >registrar</a></li> -->
                    
                </ul>
                <div class="botons">

                    

                    

                </div>
            </nav>
            
            <div>
                <ul>
                    <li class="submenu">
                        <img id="img-carrito" src="img/car.svg" alt="car">
                        <div id="carrito">
                            <table id="lista-carrito">
                                <thead>
                                    <tr>
                                        <th>imagen</th>
                                        <th>nombre</th>
                                        <th>precio</th>
                                        <th>cantidad</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <a href="#" id="vaciar-carrito" class="btn-3">vaciar carrito</a>
                            

                        </div>
                        <div id="total-carrito">$0.00</div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="header-content container">
            <div class="header-txt">
                <span> bienvenido a nuestra tienda</span>
                <h1>ofertas especiales</h1>
                <h4>Paquete de Alimentación Saludable:</h4><br>
                <li>
                    <ul>Incluye una selección de alimentos premium para perros o gatos.
</ul>
                </li>
                <div class="botons">
                    <a href="#" class="btn-1">informacion</a>
                    <a href="#" class="btn-1">leer mas</a>
                </div>
            </div>
            <div id="drag-container">
                <div id="spin-container">
                    <?php
                    require_once "controllers/oferta.php";
                    
                    $oferta = new Oferta(); // Crear una instancia de la clase Oferta
                    $imagenesOfertas = $oferta->obtenerImagenesOfertas(); // Llamar a la función
                    
                    foreach ($imagenesOfertas as $imagen) {
                        echo "<img src='" . $imagen . "' alt='Oferta'>";
                    }
                    ?>
                </div>
                <div id="ground"></div>
            </div>
        </div>
    </header>