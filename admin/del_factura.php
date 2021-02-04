<?php
						if (!empty($_GET['id'])) {
							include '../clases/clase_factura.php';
							$factura = new factura();
							if ($factura->del_factura($_GET['id']) == 0) { ?>
									<script>alert('Se elimino con exito');location.href='view_factura.php';</script>
									<?php
							}else{ ?>
									<script>alert('Ocurrio un error al borrar!');location.href='view_factura.php';</script>
									<?php
							}
						}else{ ?>
									<script>location.href='view_factura.php';</script>
									<?php
						}
					?>