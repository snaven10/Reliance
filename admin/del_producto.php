<?php
						if (!empty($_GET['id'])) {
							include '../clases/clase_producto.php';
							$producto = new producto();
							if ($producto->del_producto($_GET['id']) == 0) { ?>
									<script>alert('Se elimino con exito');location.href='view_producto.php';</script>
									<?php
							}else{ ?>
									<script>alert('Ocurrio un error al borrar!');location.href='view_producto.php';</script>
									<?php
							}
						}else{ ?>
									<script>location.href='view_producto.php';</script>
									<?php
						}
					?>