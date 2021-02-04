<?php
						if (!empty($_GET['id'])) {
							include '../clases/clase_pedido.php';
							$pedido = new pedido();
							if ($pedido->del_pedido($_GET['id']) == 0) { ?>
									<script>alert('Se elimino con exito');location.href='view_pedido.php';</script>
									<?php
							}else{ ?>
									<script>alert('Ocurrio un error al borrar!');location.href='view_pedido.php';</script>
									<?php
							}
						}else{ ?>
									<script>location.href='view_pedido.php';</script>
									<?php
						}
					?>