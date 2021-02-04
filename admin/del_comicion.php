<?php
						if (!empty($_GET['id'])) {
							include '../clases/clase_comicion.php';
							$comicion = new comicion();
							if ($comicion->del_comicion($_GET['id']) == 0) { ?>
									<script>alert('Se elimino con exito');location.href='view_comicion.php';</script>
									<?php
							}else{ ?>
									<script>alert('Ocurrio un error al borrar!');location.href='view_comicion.php';</script>
									<?php
							}
						}else{ ?>
									<script>location.href='view_comicion.php';</script>
									<?php
						}
					?>