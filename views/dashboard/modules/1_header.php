<?php
// Iniciamos la sesión al inicio de la vista
#session_start();

// Verificar si la sesión está activa y si el rol del usuario es 'Admin'
#if (!isset($_SESSION['id_user']) || $_SESSION['rol'] != 1) {    // Si no existe sesión o el rol no es 'Admin', redirigir al login o a otra página
#    header("Location: ?c=Roles&a=validate");
#    exit();
#}

// Si pasa la validación, continuar con la carga del dashboard del admin
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Home</title>

	<!-- Normalize V8.0.1 -->
	<link rel="stylesheet" href="assets/plantilla/dashboard/css/normalize.css">

	<!-- Bootstrap V4.3 -->
	<link rel="stylesheet" href="assets/plantilla/dashboard/css/bootstrap.min.css">

	<!-- Bootstrap Material Design V4.0 -->
	<link rel="stylesheet" href="assets/plantilla/dashboard/css/bootstrap-material-design.min.css">

	<!-- Font Awesome V5.9.0 -->
	<link rel="stylesheet" href="assets/plantilla/dashboard/css/all.css">

	<!-- Sweet Alerts V8.13.0 CSS file -->
	<link rel="stylesheet" href="assets/plantilla/dashboard/css/sweetalert2.min.css">

	<!-- Sweet Alert V8.13.0 JS file-->
	<script src="assets/plantilla/dashboard/js/sweetalert2.min.js" ></script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<link rel="stylesheet" href="assets/plantilla/dashboard/css/jquery.mCustomScrollbar.css">
	
	<!-- General Styles -->
	<link rel="stylesheet" href="assets/plantilla/dashboard/css/style.css">

	<!-- CSS de DataTables -->
	<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

	<!--=============================================
	=            Include JavaScript files           =
	==============================================-->
	<!-- jQuery V3.4.1 -->
	<script src="assets/plantilla/dashboard/js/jquery-3.4.1.min.js" ></script>

	<!-- popper -->
	<script src="assets/plantilla/dashboard/js/popper.min.js" ></script>

	<!-- Bootstrap V4.3 -->
	<script src="assets/plantilla/dashboard/js/bootstrap.min.js" ></script>

	<!-- jQuery Custom Content Scroller V3.1.5 -->
	<script src="assets/plantilla/dashboard/js/jquery.mCustomScrollbar.concat.min.js" ></script>

	<!-- Bootstrap Material Design V4.0 -->
	<script src="assets/plantilla/dashboard/js/bootstrap-material-design.min.js" ></script>
	<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

	<!-- js personalizado -->
	<script src="assets/plantilla/dashboard/js/main.js" ></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- JS de DataTables -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



</head>
<body>

	<!-- Main container -->
	<main class="full-box main-container">