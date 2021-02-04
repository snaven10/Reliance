<?php
				include '../menu/menu.php';
				/*if (!isset($_POST['validacion'])) {
					if (basename($_SERVER["PHP_SELF"]) != 'index.php') {
						header('location: ../admin');
					}
				}*/
				if (!empty($_GET['id'])) {
					include '../clases/clase_proveedor.php';
					$proveedor = new proveedor();
					$data = $proveedor->get_id_proveedor($_GET['id']);
							
							$nvl = 0;
							foreach ($data as $row){
								$nvl += 1;
							}
				}?>

			<form action='' method='POST' role='form' class='col-xs-12 col-sm-12 col-md-6 col-lg-6' enctype='multipart/form-data'>
				<legend>proveedor</legend>
					<div class='form-group'>
											<input type='text' name='Nombre' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[1];}else{if(!empty($_POST['Nombre'])){echo $_POST['Nombre'];}}?>' placeholder='Nombre' required><br>
					<input type='text' name='Nit_empresa' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[2];}else{if(!empty($_POST['Nit_empresa'])){echo $_POST['Nit_empresa'];}}?>' placeholder='Nit_empresa' required><br>
					<input type='text' name='Telefono' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[3];}else{if(!empty($_POST['Telefono'])){echo $_POST['Telefono'];}}?>' placeholder='Telefono' required><br>
					<input type='text' name='Direccion' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[4];}else{if(!empty($_POST['Direccion'])){echo $_POST['Direccion'];}}?>' placeholder='Direccion' required><br>
					<input type='text' name='Email' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[5];}else{if(!empty($_POST['Email'])){echo $_POST['Email'];}}?>' placeholder='Email' required><br>

 
					</div>											
				<button type='submit' name='add' class='btn btn-success'>Guardar</button>
			</form>
<?php
include '../pie/pie.php'; 
				if (isset($_POST['add'])) {
					if (!empty($_GET['id'])) {
						if (!empty($_POST['Nombre']) &&!empty($_POST['Nit_empresa']) &&!empty($_POST['Telefono']) &&!empty($_POST['Direccion']) &&!empty($_POST['Email'])) {
						if ($proveedor->edit_proveedor($_GET['id'],$_POST['Nombre'],$_POST['Nit_empresa'],$_POST['Telefono'],$_POST['Direccion'],$_POST['Email'],1) == 0) { ?>

							<script>alert('Se ha editado un registro con exito');location.href='view_proveedor.php';</script>
						<?php }else{ ?>
							<script>alert('Ocurrio un error!');location.href='view_proveedor.php';</script>
							
						<?php }
					}
					}else{
					if (!empty($_POST['Nombre']) &&!empty($_POST['Nit_empresa']) &&!empty($_POST['Telefono']) &&!empty($_POST['Direccion']) &&!empty($_POST['Email'])) {
						include '../clases/clase_proveedor.php';
						$proveedor = new proveedor();
						if ($proveedor->add_proveedor($_POST['Nombre'],$_POST['Nit_empresa'],$_POST['Telefono'],$_POST['Direccion'],$_POST['Email'],1) == 0) { ?>

							<script>alert('Se agrego con exito');location.href='view_proveedor.php';</script>
							
						<?php }else{ ?>
							<script>alert('Ocurrio un error!');location.href='view_proveedor.php';</script>
							 
						<?php }

					}
				}
				}
			?>