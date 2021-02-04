<?php
				include '../menu/menu.php';
				/*if (!isset($_POST['validacion'])) {
					if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
						header('location: ../admin');
					}
				}*/
				if (!empty($_GET['id'])) {
					include '../clases/clase_usuario.php';
					$usuario = new usuario();
					$data = $usuario->get_id_usuario($_GET['id']);
							
							$nvl = 0;
							foreach ($data as $row){
								$nvl += 1;
							}
				}?>

			<form action='' method='POST' role='form' class='col-xs-12 col-sm-12 col-md-6 col-lg-6' enctype='multipart/form-data'>
				<legend>usuario</legend>
					<div class='form-group'>
					<input type='text' name='Nombre' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[1];}else{if(!empty($_POST['Nombre'])){echo $_POST['Nombre'];}}?>' placeholder='Nombre' required><br>
					<input type='text' name='Usuario' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[2];}else{if(!empty($_POST['Usuario'])){echo $_POST['Usuario'];}}?>' placeholder='Usuario' required><br>
					<input type='password' name='Password' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[3];}else{if(!empty($_POST['Password'])){echo $_POST['Password'];}}?>' placeholder='Password' required><br>
					<select name='Nivel' class="form-control" required="">
                        <option value="0">Seleccione Tipo Usuario</option>
                        <option value="1">Usuario</option>
                        <option value="2">Administrador</option>
                    </select><br>
					</div>											
				<button type='submit' name='add' class='btn btn-success'>Guardar</button>
			</form>
<?php
include '../pie/pie.php'; 
				if (isset($_POST['add'])) {
					if (!empty($_GET['id'])) {
						if (!empty($_POST['Nombre']) &&!empty($_POST['Usuario']) &&!empty($_POST['Password']) &&!empty($_POST['Nivel']) &&!empty($_POST['Estado'])) {
						if ($usuario->edit_usuario($_GET['id'],$_POST['Nombre'],$_POST['Usuario'],$_POST['Password'],$_POST['Nivel'],$_POST['Estado']) == 0) { ?>

							<script>alert('Se ha editado un registro con exito');location.href='view_usuario.php';</script>
						<?php }else{ ?>
							<script>alert('Ocurrio un error!');location.href='view_usuario.php';</script>
							
						<?php }
					}
					}else{
					if (!empty($_POST['Nombre']) &&!empty($_POST['Usuario']) &&!empty($_POST['Password']) && $_POST['Nivel'] >0) {
						include '../clases/clase_usuario.php';
						$usuario = new usuario();
						if ($usuario->add_usuario($_POST['Nombre'],$_POST['Usuario'],md5($_POST['Password']),$_POST['Nivel'],1) == 0) { ?>

							<script>
								swal
									({
									  position: 'center',
									  type: 'success',
									  title: 'Se agrego con exito',
									  showConfirmButton: false,
									  timer: 1500
									});
									setTimeout ("location.href='view_usuario.php';", 1500); //tiempo expresado en milisegundos	
							</script>
							
						<?php }else{ ?>
							<script>
								swal
									({
									  position: 'center',
									  type: 'error',
									  title: 'Ocurrio un error!',
									  showConfirmButton: false,
									  timer: 1500
									});
							</script>
							 
						<?php }

					}
				}
				}
			?>