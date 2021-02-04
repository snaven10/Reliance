<?php
				include '../menu/menu.php';
				include '../clases/clase_cierre.php';

				$cierre = new cierre();

				$data = $cierre->get_cierre_general();
		?>
					<ol class="breadcrumb">
					  <li><a onclick="contenido('view_producto.php');">Reliance</a></li>
					  <li class="active">cierres de caja</li>
					</ol>
					<div class="panel panel-primary"> 
						<div class="panel-heading"> 
							<h1 class='text-center'>Cierres de caja</h1>
						</div> 
						<div class="panel-body"> 
							<a href="add_cliente.php" class='btn btn-info'>Nuevo cliente</a><br><br>
							<div class='table-responsive'>
								<table class='table table-striped table-bordered' id='tabla_datos'>
									<thead>
										<tr> 
											<td>Fecha</td>
											<td>Dia anterior</td>
											<td>Ventas</td>
											<td>Abonos</td>
											<td>Gastos</td>
											<td>Egresos</td>
											<td>Depositos</td> 
											<td>Caja</td>
											<td>Caja Cerro con</td>
										</tr>
									</thead>
									<?php
									foreach ($data as $row) {?>
									<tr> 
										<td><?php echo $row['Fecha']; ?></td>
										<td><?php echo "$".number_format($row['Dia_anterior'],2,'.',','); ?></td>
										<td><?php echo "$".number_format($row['Ventas'],2,'.',','); ?></td>
										<td><?php echo "$".number_format($row['Abonos'],2,'.',','); ?></td>
										<td><?php echo "$".number_format($row['Gastos'],2,'.',','); ?></td>
										<td><?php echo "$".number_format($row['Egresos'],2,'.',','); ?></td>
										<td><?php echo "$".number_format($row['Depositos'],2,'.',','); ?></td>
										<td><?php echo "$".number_format($row['Caja'],2,'.',','); ?></td>
										<th><?php echo "$".number_format($row['Caja_cierre'],2,'.',','); ?></th>			
									</tr>
									<?php }?>
								</table>
							</div>	 
						</div> 
					</div>
		<?php
			include '../pie/pie.php';
		?>