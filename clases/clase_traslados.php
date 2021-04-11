<?php
					class traslados{
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

						public function get_traslados(){
							try{
								$q = $this->pdo->prepare('SELECT entradas_traslados.*,Sucursal FROM entradas_traslados INNER JOIN sucursales ON entradas_traslados.Id_sucursales = sucursales.Id_sucursales where entradas_traslados.Estado = 1');
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function get_trs(){
							try{
								$q = $this->pdo->prepare('SELECT salidas_trs.*,Sucursal FROM salidas_trs 
									INNER JOIN sucursales ON salidas_trs.Id_sucursales = sucursales.Id_sucursales
									where salidas_trs.Estado = 1');
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						//funciona

						public function get_id_reporte_trs($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM reporte_trs where Id_reporte_trs = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function get_num_reporte_trs($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM reporte_trs where Id_salidas_trs = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function get_id_trs($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM salidas_trs where Id_salidas_trs = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						
						public function get_id_entradas_traslads($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM entradas_traslados where Id_entrada_traslados = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						public function get_id_entradas_traslads_repor($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM reporte_entrada_traslados where Id_entrada_traslados = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						//fin funciona

						public function add_entradas($Fecha,$Numero,$N_factura,$Estado){
							try {
								$q = $this->pdo->prepare('INSERT INTO entradas(Fecha,Numero,N_factura,Estado) values(?,?,?,?)');
								 
								$q->bindParam(1,$Fecha);
								$q->bindParam(2,$Numero);
								$q->bindParam(3,$N_factura);
								$q->bindParam(4,$Estado);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function edit_entradas($Id_entradas,$Fecha,$Numero){
							try {
								$q = $this->pdo->prepare('UPDATE entradas SET Fecha =?, Numero =? WHERE Id_entradas=?');
								 
								$q->bindParam(1,$Fecha);
								$q->bindParam(2,$Numero);
								$q->bindParam(3,$Id_entradas); 
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}
						public function del_entradas($Id_entradas){
							try {
								$q = $this->pdo->prepare('DELETE FROM entradas WHERE Id_entradas=?');
								$q->bindParam(1,$Id_entradas);
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