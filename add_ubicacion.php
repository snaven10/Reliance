<?php
				include '../menu/menu.php';
				/*if (!isset($_POST['validacion'])) {
					if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
						header('location: ../admin');
					}
				}*/
				if (!empty($_GET['id'])) {
					include '../clases/clase_ubicacion.php';
					$ubicacion = new ubicacion();
					$data = $ubicacion->get_id_ubicacion($_GET['id']);
							
							$nvl = 0;
							foreach ($data as $row){
								$nvl += 1;
							}
				}?>

			<form action='' method='POST' role='form' class='col-xs-12 col-sm-12 col-md-6 col-lg-6' enctype='multipart/form-data'>
				<legend>ubicacion</legend>
					<div class='form-group'>
						<input type='text' name='Estante' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[1];}else{if(!empty($_POST['Estante'])){echo $_POST['Estante'];}}?>' placeholder='Estante' required><br>
					</div>											
				<button type='submit' name='add' class='btn btn-success'>Guardar</button>
			</form>
<?php
include '../pie/pie.php'; 
				if (isset($_POST['add'])) {
					if (!empty($_GET['id'])) {
						if (!empty($_POST['Estante'])) {
						if ($ubicacion->edit_ubicacion($_GET['id'],$_POST['Estante'],1) == 0) { ?>

							<script>alert('Se ha editado un registro con exito');location.href='view_ubicacion.php';</script>
						<?php }else{ ?>
							<script>alert('Ocurrio un error!');location.href='view_ubicacion.php';</script>
							
						<?php }
					}
					}else{
					if (!empty($_POST['Estante'])) {
						include '../clases/clase_ubicacion.php';
						$ubicacion = new ubicacion();
						if ($ubicacion->add_ubicacion($_POST['Estante'],1) == 0) { ?>

							<script>alert('Se agrego con exito');location.href='view_ubicacion.php';</script>
							
						<?php }else{ ?>
							<script>alert('Ocurrio un error!');location.href='view_ubicacion.php';</script>
							 
						<?php }

					}
				}
				}
			?>