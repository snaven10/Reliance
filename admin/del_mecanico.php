<?php
						if (!empty($_GET['id'])) {
							include '../clases/clase_mecanico.php';
							$mecanico = new mecanico();
							if ($mecanico->del_mecanico($_GET['id']) == 0) { ?>
									<script>alert('Se elimino con exito');location.href='view_mecanico.php';</script>
									<?php
							}else{ ?>
									<script>alert('Ocurrio un error al borrar!');location.href='view_mecanico.php';</script>
									<?php
							}
						}else{ ?>
									<script>location.href='view_mecanico.php';</script>
									<?php
						}
					?>