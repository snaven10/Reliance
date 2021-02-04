<?php
				include '../menu/menu.php';
				/*if (!isset($_POST['validacion'])) {
					if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
						header('location: ../admin');
					}
				}*/
				if (!empty($_GET['id'])) {
					include '../clases/clase_mecanico.php';
					$mecanico = new mecanico();
					$data = $mecanico->get_id_mecanico($_GET['id']);

							$nvl = 0;
							foreach ($data as $row){
								$nvl += 1;
							}
				}?>

			<form action='' method='POST' role='form' class='col-xs-12 col-sm-12 col-md-6 col-lg-6' enctype='multipart/form-data'>
				<legend>mecanico</legend>
					<div class='form-group'>
						<input type='text' name='Nombre' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[2];}else{if(!empty($_POST['Nombre'])){echo $_POST['Nombre'];}}?>' placeholder='Nombre' required><br>
						<input type='text' name='Nit' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[3];}else{if(!empty($_POST['Nit'])){echo $_POST['Nit'];}}?>' placeholder='Nit' required><br>
						<input type='text' name='Direccion' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[4];}else{if(!empty($_POST['Direccion'])){echo $_POST['Direccion'];}}?>' placeholder='Direccion' required><br>
						<input type='text' name='Telefono' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[5];}else{if(!empty($_POST['Telefono'])){echo $_POST['Telefono'];}}?>' placeholder='Telefono' required><br>
					</div>
				<button type='submit' name='add' class='btn btn-success'>Guardar</button>
			</form>
<?php
include '../pie/pie.php';
				if (isset($_POST['add'])) {
					if (!empty($_GET['id'])) {
						if (!empty($_POST['Nombre']) &&!empty($_POST['Nit']) &&!empty($_POST['Direccion']) &&!empty($_POST['Telefono'])) {
						if ($mecanico->edit_mecanico($_GET['id'],$_POST['Nombre'],$_POST['Nit'],$_POST['Direccion'],$_POST['Telefono'],1) == 0) { ?>

							<script>alert('Se ha editado un registro con exito');location.href='view_mecanico.php';</script>
						<?php }else{ ?>
							<script>alert('Ocurrio un error!');location.href='view_mecanico.php';</script>

						<?php }
					}
					}else{
					if (!empty($_POST['Nombre']) &&!empty($_POST['Nit']) &&!empty($_POST['Direccion']) &&!empty($_POST['Telefono'])) {
						include '../clases/clase_mecanico.php';
						$mecanico = new mecanico();
						$ultimo = $mecanico->ultimo_m();
				        if (count($ultimo[0][0]) == 0) {
				            $cod = 1;
				        }elseif ($ultimo[0][0]>0) {
				            $cod = ($ultimo[0][0]+1);
				        }
				        $mecanico = null;
				        $mecanico = new mecanico();
						if ($mecanico->add_mecanico($cod,$_POST['Nombre'],$_POST['Nit'],$_POST['Direccion'],$_POST['Telefono'],1) == 0) { ?>

							<script>alert('Se agrego con exito el Cod mecanico: <?php echo $cod; ?>');location.href='view_mecanico.php';</script>

						<?php }else{ ?>
							<script>alert('Ocurrio un error!');location.href='view_mecanico.php';</script>

						<?php }

					}
				}
				}
			?>
