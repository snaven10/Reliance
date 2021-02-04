<?php
					class detalle_venta{
						private $pdo;


						public function __Construct(){
							try{
							$this->pdo = new PDO('mysql:host=localhost;dbname=heavy_parts_nuevo', 'snaven','SNAVEN10');
							$this->pdo->exec('SET CHARACTER SET utf8');
							$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
							}catch(PDOException $e){
								echo 'Error!: '.$e->getMessage();
								die();
							}
						}

						public function get_detalle_venta(){
							try{
								$q = $this->pdo->prepare('SELECT * FROM detalle_venta');
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function get_id_pedido($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM pedido where Id_pedido = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						public function buscar_id_pedido($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM detalle_venta where Id_pedido = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						
						public function get_id_producto($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM producto where Id_producto = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						public function get_precio_id_producto($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM precio where Id_producto = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						public function get_id_detalle_venta($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM detalle_venta where Id_detalle_venta = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						public function add_detalle_venta($Id_pedido,$Id_producto,$Cantidad,$Precio_c,$Precio_v,$Estado){
							try {
								$q = $this->pdo->prepare('INSERT INTO detalle_venta(Id_pedido,Id_producto,Cantidad,Precio_c,Precio_v,Estado) values(?,?,?,?,?,?)');

								$q->bindParam(1,$Id_pedido);
								$q->bindParam(2,$Id_producto);
								$q->bindParam(3,$Cantidad);
								$q->bindParam(4,$Precio_c);
								$q->bindParam(5,$Precio_v);
								$q->bindParam(6,$Estado);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function edit_detalle_venta($Id_detalle_venta,$Id_pedido,$Id_producto,$Cantidad,$Precio_v,$Estado){
							try {
								$q = $this->pdo->prepare('UPDATE detalle_venta SET Id_pedido =?, Id_producto =?, Cantidad =?, Precio_u =?, Estado =? WHERE Id_detalle_venta=?');

								$q->bindParam(1,$Id_pedido);
								$q->bindParam(2,$Id_producto);
								$q->bindParam(3,$Cantidad);
								$q->bindParam(4,$Precio_v);
								$q->bindParam(5,$Estado);
								$q->bindParam(6,$Id_detalle_venta);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}
						public function del_detalle_venta($Id_detalle_venta){
							try {
								$q = $this->pdo->prepare('DELETE FROM detalle_venta WHERE Id_detalle_venta=?');
								$q->bindParam(1,$Id_detalle_venta);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

					}
					?>
