<?php
	include '../clases/clase_producto.php';
	$producto = new producto();
	include '../clases/clase_ubicacion.php';
	$ubicacion = new ubicacion();
	$data_ubicacion = $ubicacion->get_ubicacion();
	include '../clases/clase_precio.php';
	$precio = new precio();
	if ($_POST['tipo']==1) { 
		$data = $producto->get_id_producto_ubicasion($_POST['dato']); 
		?>
								<table class='table'  style="border: 1px solid #000;">
									<CENTER><h2>REPORTE INVENTARIO COSTO ESTANTE: <?php echo $data[0][17]; ?></h2></CENTER>
									<thead>
										<tr>
											<th>Cod_producto</th>
											<th>Nombre</th>
											<th>Cantidad</th>
											<th>Costo</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody class="result"  style="border: 1px solid #000;">
										<?php
										if (count($data)>0) {
											$i = 0;
											$h = 1;
											$cantidad = 0;
											$costo = 0;
											$total = 0;
											foreach ($data as $row) {
												if ($i == 5) {
													$h++;
													$i = 0;
												}
												?>
											<tr style="cursor: pointer; border: 1px solid #000;" onclick="modal('<?php echo $row['Id_producto'] ?>');" class="pag pag-<?php echo $h; ?>">
												<td style="border: 1px solid #000;"><?php echo $row['Cod_producto'] ?></td>
												<td style="border: 1px solid #000;"><?php echo $row['Nombre'] ?></td>
												<td style="border: 1px solid #000;"><?php $precio1 = $precio->get_precio_id_producto($row['Id_producto']); $cantidad += $precio1[0][1]; echo $precio1[0][1]; ?></td>
												<td style="border: 1px solid #000;"><?php $costo += $row['Precio_compra'];  echo '$'.$row['Precio_compra'] ?></td>
												<td style="border: 1px solid #000;"><?php $total += ($row['Precio_compra'] * $precio1[0][1]); echo ('$'.$row['Precio_compra'] * $precio1[0][1]) ?></td>
											</tr>
											<?php $i++; }?>
											<tr>
												<th style="border: 1px solid #000;" colspan="2">Total</th>
												<th style="border: 1px solid #000;"><?php echo $cantidad; ?></th>
												<th style="border: 1px solid #000;"><?php echo '$'.$costo; ?></th>
												<th style="border: 1px solid #000;"><?php echo '$'.$total; ?></th>
											</tr>
										<?php }else{?>
                                            	<tr><td colspan="4" ><center>No hay resultados - lo siento</center></td></tr>
                                        <?php } ?>
									</tbody>
								</table>
	<?php }elseif ($_POST['tipo']==2) { 
		$data = $producto->consulta_cod($_POST['dato']); ?>
								<table class='table'  style="border: 1px solid #000;">
									<CENTER><h2>REPORTE INVENTARIO COSTO </h2></CENTER>
									<thead>
										<tr>
											<th>Cod_producto</th>
											<th>Nombre</th>
											<th>Estante</th>
											<th>Cantidad</th>
											<th>Costo</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody class="result"  style="border: 1px solid #000;">
										<?php
										if (count($data)>0) {
											$i = 0;
											$h = 1;
											$cantidad = 0;
											$costo = 0;
											$total = 0;
											foreach ($data as $row) {
												if ($i == 5) {
													$h++;
													$i = 0;
												}
												?>
											<tr style="cursor: pointer; border: 1px solid #000;" onclick="modal('<?php echo $row['Id_producto'] ?>');" class="pag pag-<?php echo $h; ?>">
												<td style="border: 1px solid #000;"><?php echo $row['Cod_producto'] ?></td>
												<td style="border: 1px solid #000;"><?php echo $row['Nombre'] ?></td>
												<td style="border: 1px solid #000;"><?php echo 'Estante: '.$row['Estante'] ?></td>
												<td style="border: 1px solid #000;"><?php $precio1 = $precio->get_precio_id_producto($row['Id_producto']); $cantidad += $precio1[0][1]; echo $precio1[0][1]; ?></td>
												<td style="border: 1px solid #000;"><?php $costo += $row['Precio_compra'];  echo '$'.$row['Precio_compra'] ?></td>
												<td style="border: 1px solid #000;"><?php $total += ($row['Precio_compra'] * $precio1[0][1]); echo ('$'.$row['Precio_compra'] * $precio1[0][1]) ?></td>
											</tr>
											<?php $i++; }?>
											<tr>
												<th style="border: 1px solid #000;" colspan="3">Total</th>
												<th style="border: 1px solid #000;"><?php echo $cantidad; ?></th>
												<th style="border: 1px solid #000;"><?php echo '$'.$costo; ?></th>
												<th style="border: 1px solid #000;"><?php echo '$'.$total; ?></th>
											</tr>
										<?php }else{?>
                                            	<tr><td colspan="4" ><center>No hay resultados - lo siento</center></td></tr>
                                        <?php } ?>
									</tbody>
								</table>
	<?php }	?>
								

