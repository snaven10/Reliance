<?php
date_default_timezone_set('America/El_salvador');
				include '../menu/menu.php';
				include '../clases/clase_cierre.php';

				$cierre = new cierre();
				$ultimo_cierre = $cierre->get_ultimo_cierre_general();
				$fecha = $ultimo_cierre['Fecha'];
				$nuevafecha = strtotime('+1 day', strtotime($fecha));
				$nuevafecha = date('Y-m-d',$nuevafecha);
				$cerrado = $cierre->get_cierre($nuevafecha,date('Y-m-d'));
				if ($cerrado['Total'] == 0) {
					$venta = $cierre->get_venta_total($nuevafecha,date('Y-m-d'));
					$gastos = $cierre->get_gastos($nuevafecha.' 05:00:00',date('Y-m-d H:i:s'));
					$egresos = $cierre->get_egresos($nuevafecha.' 05:00:00',date('Y-m-d H:i:s'));
					$abonos = $cierre->get_abonos($nuevafecha.' 05:00:00',date('Y-m-d H:i:s'));
					$depositos = $cierre->get_depositos($nuevafecha.' 05:00:00',date('Y-m-d H:i:s'));
					$caja_cierre = $cierre->get_caja_cierre();
				} else {
					$venta['Total'] = $cerrado['Ventas'];
					$gastos['Total'] = $cerrado['Gastos'];
					$egresos['Total'] = $cerrado['Egresos'];
					$abonos['Total'] = $cerrado['Abonos'];
					$depositos['Total'] = $cerrado['Depositos'];
					$caja_cierre['Total'] = $cerrado['Dia_anterior'];
				}				
		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
					  <li class="active">Cierre Caja</li>
					</ol>
					<div class="panel panel-primary"> 
						<div class="panel-heading"> 
							<h1 class='text-center'>Cierre Caja</h1>
						</div> 
						<div class="panel-body"> 
							<div class='table-responsive'>
								<table class='table table-striped table-bordered'>
									<thead>
										<tr> 
											<th>Datos</th>
											<th>Montos</th>
										</tr>
									</thead>
									<tr>
										<th>Dia anterior</th>
										<td><?php echo "$".number_format($caja_cierre['Total'],2,'.',','); ?></td>
									</tr>
									<tr>
										<th>Venta</th>
										<td><?php echo "$".number_format($venta['Total'],2,'.',','); ?></td>
									</tr>
									<tr>
										<th>Abonos</th>
										<td><?php echo "$".number_format($abonos['Total'],2,'.',','); ?></td>
									</tr>
									<tr>
										<th>Sub total</th>
										<th><?php echo "$".(number_format(($caja_cierre['Total']+$venta['Total']+$abonos['Total']),2,'.',',')); ?></th>
									</tr>
									<tr>
										<th>Gastos</th>
										<td><?php echo "$".number_format($gastos['Total'],2,'.',','); ?></td>
									</tr>
									<tr>
										<th>Egresos</th>
										<td><?php echo "$".number_format($egresos['Total'],2,'.',','); ?></td>
									</tr>
									<tr>
										<th>Depositos</th>
										<td><?php echo "$".number_format($depositos['Total'],2,'.',','); ?></td>
									</tr>
									<tr>
										<th>Total caja</th>
										<th><?php echo "$".(number_format(($caja_cierre['Total']+$venta['Total']+$abonos['Total']-$gastos['Total']-$egresos['Total']-$depositos['Total']),2,'.',',')); ?></th>
									</tr>
								</table>
							</div>	
							<div class="col-md-12">
								<div class="row">
									<form action='' method='POST' role='form' enctype='multipart/form-data'>
										<div class="col-md-4">		
											<input type="hidden" value="<?php echo number_format($caja_cierre['Total'],2,'.',','); ?>" name="dia_anterior">
											<input type="hidden" value="<?php echo number_format($venta['Total'],2,'.',','); ?>" name="venta">
											<input type="hidden" value="<?php echo number_format($abonos['Total'],2,'.',','); ?>" name="abonos">
											<input type="hidden" value="<?php echo number_format($gastos['Total'],2,'.',','); ?>" name="gastos">
											<input type="hidden" value="<?php echo number_format($egresos['Total'],2,'.',','); ?>" name="egresos">
											<input type="hidden" value="<?php echo number_format($depositos['Total'],2,'.',','); ?>" name="depositos">
											<input type="hidden" name="caja" value='<?php echo number_format(($caja_cierre['Total']+$venta['Total']+$abonos['Total']-$gastos['Total']-$egresos['Total']-$depositos['Total']),2,'.',','); ?>'>

											<!-- campo total en caja-->
											<b>Caja:</b>
											<input class="form-control" type="text" value='<?php echo number_format(($caja_cierre['Total']+$venta['Total']+$abonos['Total']-$gastos['Total']-$egresos['Total']-$depositos['Total']),2,'.',','); ?>' disabled>
										</div>
										<div class="col-md-4">
											<b>Total en Caja:</b>
											<input type="hidden" name="tota_caja" value="<?php echo number_format(($caja_cierre['Total']+$venta['Total']+$abonos['Total']-$gastos['Total']-$egresos['Total']-$depositos['Total']),2,'.',','); ?>">
											<input class="form-control" type="text" value='<?php echo number_format(($caja_cierre['Total']+$venta['Total']+$abonos['Total']-$gastos['Total']-$egresos['Total']-$depositos['Total']),2,'.',','); ?>' disabled>
										</div>
										<div class="col-md-4">
											<?php 
											if ($cerrado['Total'] == 0) { ?>
											 	<br><button type='submit' name='add' class='btn btn-success'>Cerrar</button>
											 
											<?php } ?>											
										</div>
									</form>
							 	</div>							 	
							 </div> 
						</div> 
					</div>
<?php include '../pie/pie.php';  
if (isset($_POST['add'])) {
	if ((!empty($_POST['tota_caja']) || !empty($_POST['dia_anterior'])) && !empty($_POST['venta']) && !empty($_POST['abonos']) && !empty($_POST['gastos']) && !empty($_POST['egresos']) && !empty($_POST['depositos']) && !empty($_POST['caja'])) { ?>
		<?php 
		if ($cierre->add_cierre($_POST['dia_anterior'],$_POST['venta'],$_POST['abonos'],$_POST['gastos'],$_POST['egresos'],$_POST['depositos'],$_POST['caja'],$_POST['tota_caja'],date('Y-m-d')) == 0) { ?>

			<script>alert('Se cerro la caja con exito');location.href='cierre_caja.php';</script>

		<?php }else{ ?>
			<script>alert('Ocurrio un error!');location.href='cierre_caja.php';</script>

		<?php }

	}else{
		?>
			<script>alert('Ocurrio un error Todos los campos son obligatorios!');</script>

		<?php
	}

}
?>