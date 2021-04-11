<?php
include '../menu/menu.php';
/*if (!isset($_POST['validacion'])) {
					if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
						header('location: ../admin');
					}
				}*/
if (!empty($_GET['id'])) {
	include '../clases/clase_factura.php';
	$factura = new factura();
	$data = $factura->get_id_factura($_GET['id']);

	$nvl = 0;
	foreach ($data as $row) {
		$nvl += 1;
	}
} ?>

<form action='' method='POST' role='form' class='col-xs-12 col-sm-12 col-md-6 col-lg-6' enctype='multipart/form-data'>
	<?php if (!empty($_GET['tipo']) == 1 || !empty($row[3]) == 1) {
		echo "<legend>CCF</legend>";
	} elseif (!empty($_GET['tipo']) == 0 || !empty($row[3]) == 0) {
		echo "<legend>FACTURA</legend>";
	} {
	} ?>
	<div class='form-group'>
		<input type='text'
			name='Serie'
			class='form-control'
			value='<?php if (!empty($_GET['id'])) {
						echo $row[1];
					} else {
						if (!empty($_POST['Serie'])) {
							echo $_POST['Serie'];
						}
					} ?>'
			placeholder='Serie'
			required>
		<br>
		<input type='number'
			name='Numero_factura'
			class='form-control'
			value='<?php if (!empty($_GET['id'])) {
						echo $row[2];
					} else {
						if (!empty($_POST['Numero_factura'])) {
							echo $_POST['Numero_factura'];
						}
					} ?>'
			placeholder='Numero_factura'
			required>
		<br>
		<input type="hidden" name="ccf" value="<?php echo $_GET['tipo']; ?>">
	</div>
	<button type='submit' name='add' class='btn btn-success'>Guardar</button>
</form>
<?php
include '../pie/pie.php';
if (isset($_POST['add'])) {
	if (!empty($_GET['id'])) {
		if (!empty($_POST['Serie'])) {
			if ($factura->edit_factura($_GET['id'], $_POST['Serie'], $_POST['Numero_factura'], 1) == 0) { ?>

				<script>
					alert('Se ha editado un registro con exito');
					location.href = 'view_factura.php';
				</script>
			<?php } else { ?>
				<script>
					alert('Ocurrio un error!');
					location.href = 'view_factura.php';
				</script>

			<?php }
		}
	} else {
		if (!empty($_POST['Serie'])) {
			include '../clases/clase_factura.php';
			$factura = new factura();
			if ($factura->add_factura($_POST['Serie'], $_POST['Numero_factura'], $_POST['ccf'], 1,$_SESSION['Id_sucursal']) == 0) { ?>

				<script>
					alert('Se agrego con exito');
					location.href = 'view_factura.php';
				</script>

			<?php } else { ?>
				<script>
					alert('Ocurrio un error!');
					location.href = 'view_factura.php';
				</script>

<?php }
		}
	}
}
?>