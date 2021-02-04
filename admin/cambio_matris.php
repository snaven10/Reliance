<?php 
include '../clases/clase_sucursales.php';
$sucursales = new sucursales();		
$data = $sucursales->desactivar_matris($_POST['Dato']);
?>