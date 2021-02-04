<?php
				include '../menu/menu.php';
				if (!empty($_GET['id'])) {
					include '../clases/clase_comicion.php';
					$comicion = new comicion();
					$data = $comicion->get_id_comicion($_GET['id']);

							$nvl = 0;
							foreach ($data as $row){
								$nvl += 1;
							}
				}
include '../clases/clase_vendedor.php';
$vendedor = new vendedor();
$data_vendedor = $vendedor->get_vendedor();
include '../clases/clase_mecanico.php';
$mecanico = new mecanico();
$data_mecanico = $mecanico->get_mecanico();?>

			<form action='' method='POST' role='form' class='col-xs-12 col-sm-12 col-md-6 col-lg-6' enctype='multipart/form-data'>
				<legend>comicion</legend>
					<div class='form-group'>
						<input id='vendedor' list="b_vendedor" class="form-control" onchange="buscar($(this).val(),4);avilitar($(this).val(),1);" placeholder='Cod vendedor'>
						<datalist id="b_vendedor">
							<?php
								foreach ($data_vendedor as $row){ ?>
									<option value="<?php echo $row['Cod_vendedor'] ?>"></option>
								<?php } ?>
						</datalist><br>
						<input type="hidden" name="Id_vendedor" id="Id_vendedor">
						<input id='mecanico' list="b_mecanico" class="form-control" onchange="buscar($(this).val(),5);avilitar($(this).val(),2);" placeholder='Cod mecanico'>
						<datalist id="b_mecanico">
							<?php
								foreach ($data_mecanico as $row){ ?>
									<option value="<?php echo $row['Cod_mecanico'] ?>"></option>
								<?php } ?>
						</datalist><br>
						<input type="hidden" name="Id_mecanico" id="Id_mecanico">
						<input type='text' name='Comicion' class='form-control'   value='<?php if(!empty($_GET['id'])){echo $row[3];}else{if(!empty($_POST['Comicion'])){echo $_POST['Comicion'];}}?>' placeholder='Comicion' required><br>
						<input type="hidden" name="Tipo_persona" id="Tipo_persona">
					</div>
				<button type='submit' name='add' class='btn btn-success'>Guardar</button>
			</form>
<?php
include '../pie/pie.php';
				if (isset($_POST['add'])) {
					if (!empty($_GET['id'])) {
						if (!empty($_POST['Id_vendedor']) &&!empty($_POST['Id_mecanico']) &&!empty($_POST['Comicion']) &&!empty($_POST['Tipo_persona']) &&!empty($_POST['Estado'])) {
						if ($comicion->edit_comicion($_GET['id'],$_POST['Id_vendedor'],$_POST['Id_mecanico'],$_POST['Comicion'],$_POST['Tipo_persona'],$_POST['Estado']) == 0) { ?>

							<script>alert('Se ha editado un registro con exito');location.href='view_comicion.php';</script>
						<?php }else{ ?>
							<script>alert('Ocurrio un error!');location.href='view_comicion.php';</script>

						<?php }
					}
					}else{
					if ((!empty($_POST['Id_vendedor']) || !empty($_POST['Id_mecanico'])) && !empty($_POST['Comicion']) && !empty($_POST['Tipo_persona'])) { ?>
						<?php 
						include '../clases/clase_comicion.php';
						$comicion = new comicion();
						if($_POST['Tipo_persona']==1){
							$vendedor = $_POST['Id_vendedor'];
							$mecanico = 0;
						}elseif($_POST['Tipo_persona']==2){
							$mecanico = $_POST['Id_mecanico'];
							$vendedor = 0;
						}
						if ($comicion->add_comicion($vendedor,$mecanico,$_POST['Comicion'],$_POST['Tipo_persona'],1) == 0) { ?>

							<script>alert('Se agrego con exito');location.href='view_comicion.php';</script>

						<?php }else{ ?>
							<script>alert('Ocurrio un error!');location.href='view_comicion.php';</script>

						<?php }

					}else{
						?>
							<script>alert('Ocurrio un error Todos los campos son obligatorios!');</script>

						<?php
					}
				}
				}
			?>
<script>
	function buscar(dato,tipo){
		if (dato != '') {
			//alert(dato+' Tipo: '+tipo);
			$('#img').html("<img src='../img/cargando.gif' width=30 height=30/>");
			console.log(dato);
			$.ajax({
				url: "agregar_pu.php",
				type : 'post',
				dataType: 'html',
				data: {
					dato: dato,
					tipo: tipo
				},
			})
			.done(function(data) {
				if (tipo == 5) {
					$('#Id_mecanico').val(data);
					console.log(data);
				}else if(tipo == 4){
					$('#Id_vendedor').val(data);
					console.log(data);
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				$('#img').html("");
			});
        }
	}
	function avilitar(dato,tipo) {
		if (dato=='') {
			document.getElementById('vendedor').removeAttribute('disabled');
			document.getElementById('mecanico').removeAttribute('disabled');
		}else if(dato!=''){
			if (tipo==1) {
				document.getElementById('mecanico').setAttribute('disabled','disabled');
				$('#Tipo_persona').val(1);
			}else{
				document.getElementById('vendedor').setAttribute('disabled','disabled');
				$('#Tipo_persona').val(2);
			}
		}
	}
</script>
