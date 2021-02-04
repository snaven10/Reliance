<?php
						if (!empty($_GET['id'])) {
							include '../clases/clase_vendedor.php';
							$vendedor = new vendedor();
							if ($vendedor->del_vendedor($_GET['id']) == 0) { ?>
									<script>alert('Se elimino con exito');location.href='view_vendedor.php';</script>
									<?php
							}else{ ?>
									<script>alert('Ocurrio un error al borrar!');location.href='view_vendedor.php';</script>
									<?php
							}
						}else{ ?>
									<script>location.href='view_vendedor.php';</script>
									<?php
						}
					?>