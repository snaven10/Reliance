<?php
if (isset($_POST['id']) && $_POST['tipo'] == 1) {
	include '../clases/clase_reporte_entrada.php';
	$reporte_entrada = new reporte_entrada();
	include '../clases/clase_producto.php';
	$producto = new producto();
	include '../clases/clase_traslados.php';
	$traslados = new traslados();
	$data = $traslados->get_id_entradas_traslads_repor($_POST['id']);
	$traslados = new traslados();
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="$('#Modal_reportes').hide();">&times;</button>
		<h4 class="modal-title">Reporte de traslados</h4>
	</div>
	<div class="modal-body">
		<div class='table-responsive'>
			<table class='table table-striped table-bordered' id='tabla_datoss'>
				<thead>
					<tr>
						<td>Numero Reporte</td>
						<td>Cantidad</td>
						<td>Precio_compra</td>
						<td>Precio_venta</td>
						<td>Descuento</td>
						<td>Nombre producto</td>
					</tr>
				</thead>
				<?php
				foreach ($data as $row) {?>
				<tr>
					<td><?php $traslados1 = $traslados->get_id_entradas_traslads($row['Id_entrada_traslados']); echo "Reporte N ".$traslados1[0][2] ?></td>
					<td><?php echo $row['Cantidad'] ?></td>
					<td><?php echo $row['Precio_compra'] ?></td>
					<td><?php echo $row['Precio_venta'] ?></td>
					<td><?php echo $row['Descuento'] ?></td>
					<td><?php $producto1 = $producto->get_id_producto($row['Id_producto']); echo $producto1[0][3] ?></td>
				</tr>
				<?php }?>
			</table>
		</div>
	</div>
	<div class="modal-footer">
        <a href='reporte_entradas_traslados.php?imp=<?php echo $_POST['id']; ?>&ubicacion=0' class='btn btn-success'>Imprimir</a>
        <a href="#" class="btn btn-danger" data-dismiss="modal" onclick="$('#Modal_reportes').hide();">Cerrar</a>
    </div>
	<?php
	exit;
}elseif ($_GET['imp']) {
include '../clases/clase_producto.php';
$producto = new producto();
	include '../clases/clase_traslados.php';
	$traslados = new traslados();
	$data = $traslados->get_id_entradas_traslads_repor($_GET['imp']);
	?>
<link href='../css/bootstrap.min.css' rel='stylesheet'>
<div class="container" style='width:189mm; height:10mm; text-align: center;' id='imp_rep'>
	<div style='width:189mm; height:15mm; text-align: center; float:left;'>
		<h2>Reporte Entradas de traslado N <?php $traslados1 = $traslados->get_id_entradas_traslads($_GET['imp']); echo $traslados1[0][3]." ".$traslados1[0][2] ?></h2><br><br><br>
	</div>
	<div style='width:189mm; text-align: center; float:left; margin-top: 30'>
		<div style="width:39mm; height:10mm; border: 1px solid #000; float:left;"><b>Cod producto</b></div>
		<div style="width:114mm; height:10mm; border: 1px solid #000; float:left;"><b>Nombre de Producto</b></div>
		<div style="width:36mm; height:10mm; border: 1px solid #000; float:right;"><b>Cantidad</b></div>
	</div>
	<div style='width:189mm; height:5mm; text-align: center; float:left;'>
		<?php
		foreach ($data as $row) {?>
			<div style='width:189mm; min-height:5mm; text-align: center; float:left;'>
				<div style="width:39mm; height:auto; border: 1px solid #000; float:left;"><?php $producto2 = $producto->get_id_producto($row['Id_producto']); echo $producto2[0][1]; $producto = null; $producto = new producto(); ?></div>
				<div style="width:114mm; height:auto; border: 1px solid #000; float:left;"><?php $producto1 = $producto->get_id_producto($row['Id_producto']); echo $producto1[0][3] ?></div>
				<div style="width:36mm; height:auto; border: 1px solid #000; float:right;"><?php echo $row['Cantidad'] ?></div>
			</div>
		<?php } ?>
	</div>
</div>
<script type="text/javascript">
	var contenido= document.getElementById('imp_rep').innerHTML;
    var contenidoOriginal= document.body.innerHTML;
    document.body.innerHTML = contenido;
    window.print();
    document.body.innerHTML = contenidoOriginal;
    <?php if ($_GET['ubicacion']==0) {
		echo "location.href='buscar_reportes_traslados.php';";
	}elseif ($_GET['ubicacion']==1) {
		echo "location.href='traslados_e.php';";
	} ?>
</script>
<?php
}
?>

