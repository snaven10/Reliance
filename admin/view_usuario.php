<?php
include '../menu/menu.php';
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
    <div class="panel-body datos">
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
				<?php foreach ($data as $row): ?>
					<?php if($row['Estado'] == 0 && $_SESSION['Nivel'] == 3): ?>
						<tr
							class="<?= ($row['Estado']==1) ? 'success' : (($row['Estado']==2) ? 'warning' : (($row['Estado']==0) ? 'danger' : '')); ?>">
							<td><?php echo $row['Nombre'] ?></td>
							<td><?php echo $row['Usuario'] ?></td>
							<td><?= ($row['Nivel'] == 1) ? 'Vendedor' : (($row['Nivel'] == 2) ? 'Administrador' : (($row['Nivel'] == 3) ? 'Super Administrador' : '')); ?>
							</td>
							<td>
								<?php if ($row['Id_sucursal'] > 0): ?>
									<?= $row['Sucursal'] ?>
								<?php else: ?>
									<select class="form-control">
										<option value="0">Seleccione una sucursal</option>
										<?php foreach($sucu as $row_sucu): ?>
										<option value="<?= $row_sucu['Id_sucursales'] ?>"
											<?= ($row['Id_sucursal'] == $row_sucu['Id_sucursales']) ? 'selected' : '' ; ?>
											@click="sucursal(<?= $row[0] ?>,<?= $row_sucu['Id_sucursales'] ?>)"
											>
											<?= $row_sucu['Sucursal'] ?>
										</option>
										<?php endforeach ?>
									</select>
								<?php endif ?>
							</td>
							<td><?= ($row['Estado']==1) ? 'Activo' : (($row['Estado']==2) ? 'En proceso' : (($row['Estado']==0) ? 'Inactivo' : '')); ?>
							</td>
							<td>
								<a href='#'
									@click="activar(<?php echo $row[0] ?>)"
									class='btn btn-success'>
										Reactivar
								</a>
							</td>
						</tr>
					<?php elseif($row['Estado'] > 0): ?>
						<tr
							class="<?= ($row['Estado']==1) ? 'success' : (($row['Estado']==2) ? 'warning' : (($row['Estado']==0) ? 'danger' : '')); ?>">
							<td><?php echo $row['Nombre'] ?></td>
							<td><?php echo $row['Usuario'] ?></td>
							<td><?= ($row['Nivel'] == 1) ? 'Vendedor' : (($row['Nivel'] == 2) ? 'Administrador' : (($row['Nivel'] == 3) ? 'Super Administrador' : '')); ?>
							</td>
							<td>
							<?php if ($row['Id_sucursal'] > 0): ?>
								<?= $row['Sucursal'] ?>
							<?php else: ?>
								<select class="form-control">
									<option value="0">Seleccione una sucursal</option>
									<?php foreach($sucu as $row_sucu): ?>
									<option value="<?= $row_sucu['Id_sucursales'] ?>"
										<?= ($row['Id_sucursal'] == $row_sucu['Id_sucursales']) ? 'selected' : '' ; ?>
										@click="sucursal(<?= $row[0] ?>,<?= $row_sucu['Id_sucursales'] ?>)"
										>
										<?= $row_sucu['Sucursal'] ?>
									</option>
									<?php endforeach ?>
								</select>
							<?php endif ?>
							</td>
							<td><?= ($row['Estado']==1) ? 'Activo' : (($row['Estado']==2) ? 'En proceso' : (($row['Estado']==0) ? 'Inactivo' : '')); ?>
							</td>
							<td>
								<a href='add_usuario.php?id=<?php echo $row[0] ?>'
									class='btn btn-info'>Editar</a>&nbsp;&nbsp;&nbsp;
									<?php if($row['Estado'] != 2): ?>
										<a href='#' @click="borrar(<?php echo $row[0] ?>)" class='btn btn-danger'>Eliminar</a>
									<?php endif ?>
								</td>
						</tr>
					<?php endif ?>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
<?php include '../pie/pie.php';  ?>
<script language='javascript'>
new Vue({
	el:'.datos',
	data:{
		user: []
	},
	methods:{
		activar:function(id){
			url = 'axios/user/reactivar_user.php';
			param = {
				id: id
			};
			this.api(url,param)
		},
		sucursal:function(id_user,id_sucursal){
			url = 'axios/user/asignar_user_sucursal.php';
			param = {
				id_user: id_user,
				id_sucursal: id_sucursal
			};
			this.api(url,param)
		},
		api:function(url, param){
			axios.post(url, param)
			.then(response => {
				mesag = response.data.split(',');
				swal
				({
					position: 'center',
					type: mesag[0],
					title: mesag[1],
					showConfirmButton: false,
					timer: 1500
				}).then((result) => {
					window.location.href = 'view_usuario.php';
				});
			}).catch(e => {
				console.log(e);
			});
		},
		borrar:function(id){
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
				if (result.value) {
					location.href = 'del_usuario.php?id=' + id;
				}
			});
		},
	}
	})
</script>