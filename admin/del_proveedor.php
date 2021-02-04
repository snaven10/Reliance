<?php
						if (!empty($_GET['id'])) {
							include '../clases/clase_proveedor.php';
							$proveedor = new proveedor();
							if ($proveedor->del_proveedor($_GET['id']) == 0) { ?>
									<script>alert('Se elimino con exito');location.href='view_proveedor.php';</script>
									<?php
							}else{ ?>
									<script>alert('Ocurrio un error al borrar!');location.href='view_proveedor.php';</script>
									<?php
							}
						}else{ ?>
									<script>location.href='view_proveedor.php';</script>
									<?php
						}
					?>