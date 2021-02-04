<?php
					class cliente{
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

						public function get_cliente(){
							try{
								$q = $this->pdo->prepare('SELECT * FROM cliente inner join detalle_cliente on detalle_cliente.Id_cliente = cliente.Id_cliente where cliente.Estado = 1');
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function ultimo(){
							try{
								$q = $this->pdo->prepare('SELECT max(Id_cliente) FROM cliente');
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function get_id_detalle_cliente($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM detalle_cliente where Id_detalle_cliente = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function ultimo_detalle(){
							try{
								$q = $this->pdo->prepare('SELECT max(Cod_cliente) as Cod_cliente FROM detalle_cliente');
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function buscar($cod,$rnc){
							try{
								$q = $this->pdo->prepare('SELECT * FROM cliente where Id_cliente = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						public function get_id_cliente($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM cliente where Id_cliente = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function get_id_cliente_detalle($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM cliente inner join detalle_cliente on cliente.Id_cliente = detalle_cliente.Id_cliente where cliente.Id_cliente = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function add_cliente($tipo_cliente,$Nombre,$Estado){
							try {
								$q = $this->pdo->prepare('INSERT INTO cliente(tipo_cliente,Nombre,Estado) values(?,?,?)');

								$q->bindParam(1,$tipo_cliente);
						$q->bindParam(2,$Nombre);
						$q->bindParam(3,$Estado);
						$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function edit_cliente($Id_cliente,$Nombre){
							try {
								$q = $this->pdo->prepare('UPDATE cliente SET Nombre =? WHERE Id_cliente=?');
								$q->bindParam(1,$Nombre);
								$q->bindParam(2,$Id_cliente);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}
						public function del_cliente($Id_cliente){
							try {
								$q = $this->pdo->prepare('DELETE FROM cliente WHERE Id_cliente=?');
								$q->bindParam(1,$Id_cliente);
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
