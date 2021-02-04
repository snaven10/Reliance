<?php
include '../menu/menu.php';
/*if (!isset($_POST['validacion'])) {
	if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
		header('location: ../admin');
	}
}*/
include '../clases/clase_usuario.php';
$usuario = new usuario();
include '../clases/clase_sucursales.php';
$sucursal = new sucursales();
$sucu = $sucursal->get_sucursales();

if ($_SESSION['Nivel'] == 3 && isset($_SESSION['Id']) && isset($_SESSION['Nivel'])) {
	$data = $usuario->get_usuario_ad();
}else{
	$data = $usuario->get_usuario();
}
?>
<ol class="breadcrumb">
	<li><a onclick="contenido('view_producto.php');">Reliance</a></li>
	<li class="active">usuario</li>
</ol>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h1 class='text-center'>usuario</h1>
	</div>
	<div class="panel-body">
		<a href='add_usuario.php' class='btn btn-info'>Nuevo usuario</a><br><br>
		<div class='table-responsive'>
			<table class='table table-striped table-bordered' id='tabla_datos'>
				<thead>
					<tr>
						<td>Nombre</td>
						<td>Usuario</td>
						<td>Nivel</td>
						<td>Sucursal</td>
						<td>Estado</td>
						<td class='text-center'><b>Opciones</b></td>
					</tr>
				</thead>
				<?php
				foreach ($data as $row) {?>
				<tr class="<?= ($row['Estado']==1) ? 'success' : (($row['Estado']==2) ? 'warning' : (($row['Estado']==0) ? 'danger' : '')); ?>">
					<td><?php echo $row['Nombre'] ?></td>
					<td><?php echo $row['Usuario'] ?></td>
					<td><?= ($row['Nivel'] == 1) ? 'Vendedor' : (($row['Nivel'] == 2) ? 'Administrador' : (($row['Nivel'] == 3) ? 'Super Administrador' : '')); ?></td>
					<td>
						<select class="form-control">
							<option value="0">Seleccione una sucursal</option>
							<?php foreach($sucu as $row_sucu): ?>
								<option value="<?= $row_sucu['Id_sucursales'] ?>" <?= ($row['Id_sucursal'] == $row_sucu['Id_sucursales']) ? 'selected' : '' ; ?>><?= $row_sucu['Sucursal'] ?></option>
							<?php endforeach ?>
						</select>
					</td>
					<td><?= ($row['Estado']==1) ? 'Activo' : (($row['Estado']==2) ? 'En proceso' : (($row['Estado']==0) ? 'Inactivo' : '')); ?></td>
					<td><a href='add_usuario.php?id=<?php echo $row[0] ?>' class='btn btn-info'>Editar</a>&nbsp;&nbsp;&nbsp;<a href='#' onclick='javascript:borrar(<?php echo $row[0] ?>);' class='btn btn-danger'>Eliminar</a></td>
				</tr>
				<?php }?>
			</table>
		</div>
	</div>
</div>
<?php include '../pie/pie.php';  ?>
<script language='javascript'>
	function borrar(id)
	{
		swal
		({
			title: '¿Seguro que desea eliminar este registro?',
			text: "¡No podras revertir esto!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, ¡Deseo Borrarlo!'
		}).then((result) => {
		if (result.value)
		{
			location.href='del_usuario.php?id='+id;
		}
		});
	}
</script>