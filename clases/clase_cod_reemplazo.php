<?php
					class cod_reemplazo{
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

						public function get_cod_reemplazo(){
							try{
								$q = $this->pdo->prepare('SELECT * FROM cod_reemplazo');
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
						public function get_id_cod_reemplazo($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM cod_reemplazo where Id_cod_reemplazo = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function get_id_cod_reemplazo_p($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM cod_reemplazo where Id_producto = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						public function add_cod_reemplazo($Cod_reemplazo,$Id_producto,$Estado){
							try {
								$q = $this->pdo->prepare('INSERT INTO cod_reemplazo(Cod_reemplazo,Id_producto,Estado) values(?,?,?)');
								 
								$q->bindParam(1,$Cod_reemplazo);
						$q->bindParam(2,$Id_producto);
						$q->bindParam(3,$Estado);
						$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function edit_cod_reemplazo($Id_cod_reemplazo,$Cod_reemplazo,$Id_producto,$Estado){
							try {
								$q = $this->pdo->prepare('UPDATE cod_reemplazo SET Cod_reemplazo =?, Id_producto =?, Estado =? WHERE Id_cod_reemplazo=?');
								 
								$q->bindParam(1,$Cod_reemplazo);
								$q->bindParam(2,$Id_producto);
								$q->bindParam(3,$Estado);
								$q->bindParam(4,$Id_cod_reemplazo); 
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function edit_cod_reemplazo_pr($Id_cod_reemplazo,$Cod_reemplazo){
							try {
								$q = $this->pdo->prepare('UPDATE cod_reemplazo SET Cod_reemplazo =? WHERE Id_cod_reemplazo=?');
								 
								$q->bindParam(1,$Cod_reemplazo);
								$q->bindParam(2,$Id_cod_reemplazo); 
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function del_cod_reemplazo($Id_cod_reemplazo){
							try {
								$q = $this->pdo->prepare('DELETE FROM cod_reemplazo WHERE Id_cod_reemplazo=?');
								$q->bindParam(1,$Id_cod_reemplazo);
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