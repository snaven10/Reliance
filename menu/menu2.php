<?php
@session_start();
if (!isset($_SESSION['Id']) && !isset($_SESSION['Nivel'])) {
	header('location: ../');
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Fixed top navbar example · Bootstrap v5.0</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/navbar-top-fixed.css" rel="stylesheet">
    <link rel="icon" href="assets/brand/bootstrap-logo-white.svg">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid menu">
            <a class="navbar-brand" href="#">Reliance</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                    <li class="nav-item dropdown" v-if="Nivel == 2 || Nivel == 3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Inventario
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Producto</a></li>
                            <li><a class="dropdown-item" href="#">Proveedores</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Ubicacion</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" v-if="Nivel == 2 || Nivel == 3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Usuarios
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Vista Usuarios</a></li>
                            <li><a class="dropdown-item" href="#">Agregar Usuario</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" v-if="Nivel == 2 || Nivel == 3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Comisiones
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Vendedor</a></li>
                            <li><a class="dropdown-item" href="#">Mecanico</a></li>
                            <li><a class="dropdown-item" href="#">Agregar Comision</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" v-if="Nivel == 2 || Nivel == 3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Clientes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Vista Clientes</a></li>
                            <li><a class="dropdown-item" href="#">Agregar Clientes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" v-if="Nivel == 2 || Nivel == 3">
                        <a class="nav-link" href="#">Sucursales</a>
                    </li>
                    <li class="nav-item dropdown" v-if="Nivel == 2 || Nivel == 3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Factura
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">CCF</a></li>
                            <li><a class="dropdown-item" href="#">FACTURA</a></li>
                            <li><a class="dropdown-item" href="#">Vista ccf o Factura</a></li>
                            <li><a class="dropdown-item" href="#">Anular Factura</a></li>
                            <li><a class="dropdown-item" href="#">Facturas al Credito</a></li>
                            <li><a class="dropdown-item" href="#">Clientes Creditos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Movimientos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Agregar Entradas</a></li>
                            <li><a class="dropdown-item" href="#">Agregar Traslados</a></li>
                            <li><a class="dropdown-item" v-if="Nivel == 2 || Nivel == 3" href="#">Agregar Salidas</a></li>
                            <li><a class="dropdown-item" v-if="Nivel == 2 || Nivel == 3" href="#">Salida Traslado</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" v-if="Nivel == 2 || Nivel == 3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Efectivo
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Depositos</a></li>
                            <li><a class="dropdown-item" href="#">Gastos</a></li>
                            <li><a class="dropdown-item" href="#">Egresos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" v-if="Nivel == 2 || Nivel == 3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Reportes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Reporte venta</a></li>
                            <li><a class="dropdown-item" href="#">Reporte Comision Mecanico</a></li>
                            <li><a class="dropdown-item" href="#">Reporte venta vendedor</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Reporte de inventario</a></li>
                            <li><a class="dropdown-item" href="#">Reporte de inventario costo</a></li>
                            <li><a class="dropdown-item" href="#">Total Inventario</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Reporte de Entradas</a></li>
                            <li><a class="dropdown-item" href="#">Reporte de Salidas</a></li>
                            <li><a class="dropdown-item" href="#">Reporte de Traslados</a></li>
                            <li><a class="dropdown-item" href="#">Reporte de Salida traslados</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Reporte Abonos</a></li>
                            <li><a class="dropdown-item" href="#">Reporte de Depositos</a></li>
                            <li><a class="dropdown-item" href="#">Reporte de Gastos</a></li>
                            <li><a class="dropdown-item" href="#">Reporte de Egresos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" v-if="Nivel == 2 || Nivel == 3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cierres
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Cerrar Caja</a></li>
                            <li><a class="dropdown-item" href="#">Vista Cierres</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" v-if="Nivel == 1">
                        <a class="nav-link" href="#">Reporte venta</a>
                    </li>
                    <li class="nav-item" v-if="Nivel == 1">
                        <a class="nav-link" href="#">Cerrar Caja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container-fluid">