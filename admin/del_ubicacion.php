<?php
						if (!empty($_GET['id'])) {
							include '../clases/clase_ubicacion.php';
							$ubicacion = new ubicacion();
							if ($ubicacion->del_ubicacion($_GET['id']) == 0) { ?>
									<script>alert('Se elimino con exito');location.href='view_ubicacion.php';</script>
									<?php
							}else{ ?>
									<script>alert('Ocurrio un error al borrar!');location.href='view_ubicacion.php';</script>
									<?php
							}
						}else{ ?>
									<script>location.href='view_ubicacion.php';</script>
									<?php
						}
					?>