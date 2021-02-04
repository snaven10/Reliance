<?php 
include '../clases/clase_producto.php';
$producto = new producto();		
$data = $producto->consulta('CAJ',3);
foreach ($data as $row) {
	$producto->modificar($row['Id_producto'],5);
	echo $row['Id_producto'].'<br>';
	$producto = null;
	$producto = new producto();		
}
?>