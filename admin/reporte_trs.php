<?php
if (isset($_POST['id']) && $_POST['tipo'] == 1) {
	include '../clases/clase_reporte_entrada.php';
	$reporte_entrada = new reporte_entrada();
	include '../clases/clase_producto.php';
	$producto = new producto();
	include '../clases/clase_traslados.php';
	$traslados = new traslados();
	$data = $traslados->get_id_reporte_trs($_POST['id']);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="$('#Modal_reportes').hide();">&times;</button>
		<h4 class="modal-title">Reporte de salidas Traslados</h4>
	</div>
	<div class="modal-body">
		<div class='table-responsive'>
			<table class='table table-striped table-bordered' id='tabla_datoss'>
				<thead>
					<tr>
						<th>Cod Producto</th>
						<th>Nombre</th>
						<th>Cantidad</th>
						<th>Descripcion</th>
					</tr>
				</thead>
				<tbody class="result" id='mostrar-salidas'>
					<?php
					foreach ($data as $row) {?>
						<tr>	
							<td><?php $producto2 = $producto->get_id_producto($row['Id_producto']); echo $producto2[0][1]; $producto = null; $producto = new producto(); ?></td>
							<td><?php $producto1 = $producto->get_id_producto($row['Id_producto']); echo $producto1[0][3] ?></td>
							<td><?php echo $row['Cantidad'] ?></td>
							<td><?php echo $row['Descripcion'] ?></td>
						</tr>	
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="modal-footer">
        <a href='reporte_trs.php?imp=<?php echo $_POST['id']; ?>&ubicacion=0' class='btn btn-success'>Imprimir</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal" onclick="$('#Modal_reportes').hide();">Cerrar</a>
    </div>
	<?php
	exit;
}elseif ($_GET['imp']) {
include '../clases/clase_reporte_entrada.php';
$reporte_entrada = new reporte_entrada();
include '../clases/clase_producto.php';
$producto = new producto();
include '../clases/clase_traslados.php';
$traslados = new traslados();
$data = $traslados->get_id_reporte_trs($_GET['imp']);
	?>
<link href='../css/bootstrap.min.css' rel='stylesheet'>
<div class="container" style='width:189mm; height:10mm; text-align: center;' id='imp_rep'>
	<table class='table table-striped table-bordered' id='tabla_datos'>
		<CENTER><h3>REPORTE DE SALIDA TRASLADO DE PRODUCTO N <?php $entradas1 = $traslados->get_id_trs($_GET['imp']); echo $entradas1[0][2]." ".$entradas1[0][1] ?></h3></CENTER>
		<thead>
			<tr>
				<th>Cod Producto</th>
				<th>Nombre</th>
				<th>Cantidad</th>
				<th>Descripcion</th>
			</tr>
		</thead>
		<tbody class="result" id='mostrar-salidas'>
			<?php
			foreach ($data as $row) {?>
				<tr>	
					<td><?php $producto2 = $producto->get_id_producto($row['Id_producto']); echo $producto2[0][1]; $producto = null; $producto = new producto(); ?></td>
					<td><?php $producto1 = $producto->get_id_producto($row['Id_producto']); echo $producto1[0][3] ?></td>
					<td><?php echo $row['Cantidad'] ?></td>
					<td><?php echo $row['Descripcion'] ?></td>
				</tr>	
			<?php } ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	var contenido= document.getElementById('imp_rep').innerHTML;
    var contenidoOriginal= document.body.innerHTML;
    document.body.innerHTML = contenido;
    window.print();
    document.body.innerHTML = contenidoOriginal;
    <?php if ($_GET['ubicacion']==0) {
		echo "location.href='buscar_reportes_trs.php';";
	}elseif ($_GET['ubicacion']==1) {
		echo "location.href='traslados_s.php';";
	} ?>
</script>
<?php
}
?>

