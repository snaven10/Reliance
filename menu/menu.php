<?php
@session_start();
if (!isset($_SESSION['Id']) && !isset($_SESSION['Nivel'])) {
	header('location: ../');
}
 ?>
<!DOCTYPE html>
<html lang='es'>

<head>
    <title>vendedor</title>
    <meta charset='UTF-8'>
    <meta name=description content=''>
    <meta name=viewport content='width=device-width, initial-scale=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href='../css/bootstrap.min.css' rel='stylesheet'>
    <link href='../css/style_cont.css' rel='stylesheet'>
    <link rel='stylesheet' type='text/css' href='../css/dataTables.bootstrap.min.css'>
    <!-- This is what you need -->
    <script type="text/javascript" src="../js/sweetalert.all.js"></script>
    <link rel="stylesheet" href="../css/sweetalert.css">
    <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/moment.min.js"></script>
    <script src="../js/bootstrap-datetimepicker.min.js"></script>
    <script src="../js/bootstrap-datetimepicker.es.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/addpedido.js"></script>
    <script type="text/javascript" language="javascript" src="../js/funciones.js"></script>
    <script type="text/javascript" language="javascript" src="../js/funciones_nuevas.js"></script>
    <script type="text/javascript" language="javascript" src="../js/bootstrap-select.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/bootstrap-datepicker.min.js"></script>
    <!--axios js-->
    <script type="text/javascript" language="javascript" src="../js/axios.js"></script>
    <!--vue js-->
    <script type="text/javascript" language="javascript" src="../js/vue.js"></script>
</head>

<body>
    <nav class='navbar navbar-inverse navbar-fixed-top' ng-controller='HeaderController' role='navigation'
        style='border-radius:0px;'>
        <div class='navbar-header'>
            <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-ex1-collapse'>
                <span class='sr-only'>Menu</span>
                <span class='glyphicon glyphicon-plus' style='color: #fff;'></span>
            </button>
            <a class='navbar-brand' style="cursor: pointer;" href="view_producto.php">Reliance <?= $_SESSION['Sucursal'] ?></a>
        </div>
        <div class='collapse navbar-collapse navbar-ex1-collapse'>
            <ul class='nav navbar-nav'>
                <?php if (isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] ==2 || $_SESSION['Nivel'] ==3) { ?>
                <li>
                    <a class="" type="button" data-toggle="dropdown" style="cursor: pointer;">Inventario<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="view_producto.php">Producto</a></li>
                        <li><a href="view_proveedor.php">Proveedores</a></li>
                        <li><a href="view_ubicacion.php">Ubicacion</a></li>
                    </ul>
                </li>
                <li>
                    <a class="" type="button" data-toggle="dropdown" style="cursor: pointer;">Usuarios<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="view_usuario.php" style="cursor: pointer;">Vista Usuarios</a></li>
                        <li><a href="add_usuario.php" style="cursor: pointer;">Agregar Usuario</a></li>
                    </ul>
                </li>
                <li>
                    <a class="" type="button" data-toggle="dropdown" style="cursor: pointer;">Comisiones<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="view_vendedor.php" style="cursor: pointer;">Vendedor</a></li>
                        <li><a href="view_mecanico.php" style="cursor: pointer;">Mecanico</a></li>
                        <li><a href="view_comicion.php" style="cursor: pointer;">Agregar Comision</a></li>
                    </ul>
                </li>
                <li>
                    <a class="" type="button" data-toggle="dropdown" style="cursor: pointer;">Clientes<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="view_cliente.php" style="cursor: pointer;">Vista Clientes</a></li>
                        <li><a href="add_cliente.php" style="cursor: pointer;">Agregar Clientes</a></li>
                    </ul>
                </li>
                <li><a href="view_sucursales.php" style="cursor: pointer;">Sucursales</a></li>
                <li>
                    <a class="" type="button" data-toggle="dropdown" style="cursor: pointer;">Factura<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="add_factura.php?tipo=1" style="cursor: pointer;">CCF</a>
                        </li>
                        <li>
                            <a href="add_factura.php?tipo=0" style="cursor: pointer;">FACTURA</a>
                        </li>
                        <li>
                            <a href="view_factura.php?tipo=1" style="cursor: pointer;">Vista ccf o Factura</a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#Modal_anular_factura">Anular Factura</a>
                        </li>
                        <li>
                            <a href="abonos_factura.php" style="cursor: pointer;">Facturas al Credito</a>
                        </li>
                        <li>
                            <a href="clientes_credito.php" style="cursor: pointer;">Clientes Creditos</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <li>
                    <a class="" type="button" data-toggle="dropdown" style="cursor: pointer;">Movimientos<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="entradas.php" style="cursor: pointer;">Agregar Entradas</a></li>
                        <li><a href="traslados_s.php" style="cursor: pointer;">Agregar Traslados</a></li>
                        <li><a href="traslados_e.php" style="cursor: pointer;">Recibir Traslados</a></li>
                        <?php if (isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] ==2 || $_SESSION['Nivel'] ==3) { ?>
                        <li><a href="salidas.php" style="cursor: pointer;">Agregar Salidas</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if (isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] ==2 || $_SESSION['Nivel'] ==3) { ?>
                <li>
                    <a class="" type="button" data-toggle="dropdown" style="cursor: pointer;">Efectivo<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" onclick="modal_depositos()">Depositos</a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#Modal_gastos">Gastos</a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#Modal_egresos">Egresos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="" type="button" data-toggle="dropdown" style="cursor: pointer;">Reportes<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="reporte_ventas.php" style="cursor: pointer;">Reporte venta</a></li>
                        <li><a href="inventario.php">Reporte de inventario</a></li>
                        <li><a href="inventario_cost.php">Reporte de inventario costo</a></li>
                        <li><a href="total_inventario.php">Total Inventario</a></li>
                        <li><a href="reporte_comision.php" style="cursor: pointer;">Reporte Comision Mecanico</a></li>
                        <li><a href="reporte_vendedor.php" style="cursor: pointer;">Reporte venta vendedor</a></li>
                        <li><a href="buscar_reportes_entradas.php" style="cursor: pointer;">Reporte de Entradas</a></li>
                        <li><a href="buscar_reportes_salidas.php" style="cursor: pointer;">Reporte de Salidas</a></li>
                        <!--reportes nuevos-->
                        <li><a href="buscar_reporte_abonos_creditos.php" style="cursor: pointer;">Reporte Abonos
                                Creditos</a></li>
                        <li><a href="buscar_reportes_traslados.php" style="cursor: pointer;">Reporte de Traslados</a>
                        </li>
                        <li><a href="buscar_reportes_trs.php" style="cursor: pointer;">Reporte de Salida traslados</a>
                        </li>
                        <li><a href="reporte_depositos.php" style="cursor: pointer;">Reporte de Depositos</a></li>
                        <li><a href="reporte_gastos.php" style="cursor: pointer;">Reporte de Gastos</a></li>
                        <li><a href="reporte_egresos.php" style="cursor: pointer;">Reporte de Egresos</a></li>
                    </ul>
                </li>

                <li>
                    <a class="" type="button" data-toggle="dropdown" style="cursor: pointer;">Cierres<span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="cierre_caja.php" style="cursor: pointer;">Cerrar Caja</a>
                        </li>
                        <li>
                            <a href="view_cirres.php" style="cursor: pointer;">Vista Cierres</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <?php if (isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] ==1) { ?>
                <li><a href="reporte_ventas.php" style="cursor: pointer;">Reporte venta</a></li>
                <li><a href="cierre_caja.php" style="cursor: pointer;">Cerrar Caja</a></li>
                <?php } ?>
                <li><a href="salir.php" style="cursor: pointer;">Salir</a></li>
            </ul>
            <?php if(isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] ==1){ ?>
            <ul class="nav navbar-nav pull-right">
                <li class="active">
                    <a href="#" id="vp" style="cursor: pointer;">
                        <span class="glyphicon glyphicon-car-shop" aria-hidden="true"></span> Pedido</a>
                    <a href="#" id="xp" style="display:none;"><span class="glyphicon glyphicon-remove"
                            aria-hidden="true"></span></a>
                </li>
            </ul>
            <?php } ?>
        </div>

    </nav>

    <?php if(isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] ==1){ ?>
    <div class="contP">
        <div class="list-group cnBody">
            <div class="list-group-item active">

                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        Codigo
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        Nombre
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        Cantidad
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        Precio
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        Opciones
                    </div>
                </div>

            </div>
            <div id="dp" style="overflow: scroll; max-height: 400px !important ">
                <div class="list-group-item">Aun no se ha realizado ningun pedido...</div>
            </div>
            <?php if (isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] ==2 || $_SESSION['Nivel'] ==3) { ?>

            <?php }else if(isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] ==1){ ?>
            <a href='#' onclick="modal_fac();" class="list-group-item active text-center">Facturar Pedido</a>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <div class='container-fluid' style='margin-top: 5%;' ng-view id='contenido'>