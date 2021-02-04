<?php
				include '../menu/menu.php';
				if (!empty($_GET['id'])) {
					include '../clases/clase_cliente.php';
					$cliente = new cliente();
					$data = $cliente->get_id_cliente_detalle($_GET['id']);
							
							$nvl = 0;
							foreach ($data as $row){
								$nvl += 1;
							}
				}?>

			<form action='' method='POST' role='form' class='col-xs-12 col-sm-12 col-md-6 col-lg-6' enctype='multipart/form-data'>
				<legend>cliente</legend>
					<div class='form-group'>
					<input type='text' name='Nombre' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[2];}else{if(!empty($_POST['Nombre'])){echo $_POST['Nombre'];}}?>' placeholder='Nombre' required><br>
					<input type='text' name='Nit' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[7];}else{if(!empty($_POST['Nit'])){echo $_POST['Nit'];}}?>' placeholder='Nit' required><br>
					<input type='text' name='Nrc' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[8];}else{if(!empty($_POST['Nrc'])){echo $_POST['Nrc'];}}?>' placeholder='Nrc' required><br>
					<input type='text' name='Direccion' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[9];}else{if(!empty($_POST['Direccion'])){echo $_POST['Direccion'];}}?>' placeholder='Direccion' required><br>
					<input type='text' name='Telefono' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[10];}else{if(!empty($_POST['Telefono'])){echo $_POST['Telefono'];}}?>' placeholder='Telefono' required><br>
					<?php 
					if (isset($_GET['id'])) { ?>
						<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
					<?php } ?>
					</div>											
				<button type='submit' name='add' class='btn btn-success'>Guardar</button>
			</form>
<?php
include '../pie/pie.php'; 
				if (isset($_POST['add'])) {
					if (!empty($_POST['id'])) {
						if (!empty($_POST['Nombre']) && !empty($_POST['Nit']) &&!empty($_POST['Nrc']) &&!empty($_POST['Direccion']) &&!empty($_POST['Telefono'])) {
							if ($cliente->edit_cliente($_POST['id'],$_POST['Nombre']) == 0) { 
					            include '../clases/clase_detalle_cliente.php';
					            $detalle_cliente = new detalle_cliente();

								if ($detalle_cliente->edit_detalle_cliente($_POST['id'],$_POST['Nit'],$_POST['Nrc'],$_POST['Direccion'],$_POST['Telefono']) == 0) 
								{ ?>
									<script>alert('Se ha editado un registro con exito');location.href='view_cliente.php';</script>
								<?php 
								}
							}else{ ?>
								<script>alert('Ocurrio un error!');location.href='view_cliente.php';</script>
								
							<?php }
						}
					}else{
						if (!empty($_POST['Nombre'])) {
					        include '../clases/clase_cliente.php';
					        $cliente = new cliente();
					        if ($cliente->add_cliente(1,$_POST['Nombre'],1) == 0) {
					            $cliente = null;
					            $cliente = new cliente();
					            $ultimo = $cliente->ultimo();
					            $cliente = null;
					            $cliente = new cliente();
					            $ultimo_detalle = $cliente->ultimo_detalle();
					            include '../clases/clase_detalle_cliente.php';
					            $detalle_cliente = new detalle_cliente();
					            if ($detalle_cliente->add_detalle_cliente(($ultimo_detalle[0][0]+1),$ultimo[0][0],$_POST['Nit'],$_POST['Nrc'],$_POST['Direccion'],$_POST['Telefono'],1) == 0) { ?>
					            		<script>alert('Se agrego con exito');location.href='view_cliente.php';</script>
					            <?php }else{?>
					            		<script>alert('Ocurrio un error!');location.href='view_cliente.php';</script>
					           <?php }
					        }else{ ?>
					            <script>alert('Ocurrio un error!');location.href='view_cliente.php';</script>
					        <?php }
					    }
				}
				}
			?>