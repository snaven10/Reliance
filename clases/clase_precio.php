<?php
					class precio{
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

						public function get_precio(){
							try{
								$q = $this->pdo->prepare('SELECT * FROM precio');
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

						public function get_id_precio($id){
							try{
								$q = $this->pdo->prepare('SELECT * FROM precio where Id_precio = ?');
								$q->bindParam(1,$id);
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}
						public function add_precio($Cantidad,$Precio_compra,$Precio_venta,$Descuento,$Id_producto,$Estado){
							try {
								$q = $this->pdo->prepare('INSERT INTO precio(Cantidad,Precio_compra,Precio_venta,Descuento,Id_producto,Estado) values(?,?,?,?,?,?)');
								$q->bindParam(1,$Cantidad);
								$q->bindParam(2,$Precio_compra);
								$q->bindParam(3,$Precio_venta);
								$q->bindParam(4,$Descuento);
								$q->bindParam(5,$Id_producto);
								$q->bindParam(6,$Estado);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function ultimo(){
							try{
								$q = $this->pdo->prepare('SELECT max(Numero) as Numero, max(Id_entradas) as Id_entradas FROM entradas');
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function ultimo_traslado_entr(){
							try{
								$q = $this->pdo->prepare('SELECT max(Numero) as Numero, max(Id_entrada_traslados) as Id_entrada_traslados FROM entradas_traslados');
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function ultimo_trs(){
							try{
								$q = $this->pdo->prepare('SELECT max(Numero) as Numero, max(Id_salidas_trs) as Id_salidas_trs FROM salidas_trs');
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function ultimo_s(){
							try{
								$q = $this->pdo->prepare('SELECT max(Numero) FROM salidas');
								$q->execute();
								return $q->fetchAll();
								$this->pdo = null;
							}catch(PDOException $e){
								echo 'Error '.$e->getMessage();
							}
						}

						public function add_entradas($Fecha,$Numero,$n_factura,$Estado){
							try {
								$q = $this->pdo->prepare('INSERT INTO entradas(Fecha,Numero,N_factura,Estado) values(?,?,?,?)');
								$q->bindParam(1,$Fecha);
								$q->bindParam(2,$Numero);
								$q->bindParam(3,$n_factura);
								$q->bindParam(4,$Estado);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function add_traslados_entradas($Id_sucursales,$Fecha,$Numero,$N_traslado,$Estado){
							try {
								$q = $this->pdo->prepare('INSERT INTO entradas_traslados(Id_sucursales,Fecha,Numero,N_traslado,Estado) values(?,?,?,?,?)');
								$q->bindParam(1,$Id_sucursales);
								$q->bindParam(2,$Fecha);
								$q->bindParam(3,$Numero);
								$q->bindParam(4,$N_traslado);
								$q->bindParam(5,$Estado);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function add_reporte_entrada_traslados($Id_entrada_traslados,$Cantidad,$Precio_compra,$Precio_venta,$Descuento,$Id_producto){
							try {
								$q = $this->pdo->prepare('INSERT INTO reporte_entrada_traslados(Id_entrada_traslados,Cantidad,Precio_compra,Precio_venta,Descuento,Id_producto) values(?,?,?,?,?,?)');
								$q->bindParam(1,$Id_entrada_traslados);
								$q->bindParam(2,$Cantidad);
								$q->bindParam(3,$Precio_compra);
								$q->bindParam(4,$Precio_venta);
								$q->bindParam(5,$Descuento);
								$q->bindParam(6,$Id_producto);
								$q->bindParam(7,$Estado);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function add_reporte_entrada($Id_entradas,$Cantidad,$Precio_compra,$Precio_venta,$Descuento,$Id_producto,$Estado){
							try {
								$q = $this->pdo->prepare('INSERT INTO reporte_entrada(Id_entradas,Cantidad,Precio_compra,Precio_venta,Descuento,Id_producto,Estado) values(?,?,?,?,?,?,?)');
								$q->bindParam(1,$Id_entradas);
								$q->bindParam(2,$Cantidad);
								$q->bindParam(3,$Precio_compra);
								$q->bindParam(4,$Precio_venta);
								$q->bindParam(5,$Descuento);
								$q->bindParam(6,$Id_producto);
								$q->bindParam(7,$Estado);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function add_salidas($Fecha,$Numero,$Estado){
							try {
								$q = $this->pdo->prepare('INSERT INTO salidas(Fecha,Numero,Estado) values(?,?,?)');
								$q->bindParam(1,$Fecha);
								$q->bindParam(2,$Numero);
								$q->bindParam(3,$Estado);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function add_trs($Id_sucursales,$Fecha,$Numero){
							try {
								$q = $this->pdo->prepare('INSERT INTO salidas_trs(Id_sucursales,Fecha,Numero) values(?,?,?)');
								$q->bindParam(1,$Id_sucursales);
								$q->bindParam(2,$Fecha);
								$q->bindParam(3,$Numero);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function add_reporte_salida($Id_salida,$Cantidad,$Descripcion,$Id_producto,$Estado){
							try {
								$q = $this->pdo->prepare('INSERT INTO reporte_salida(Id_salidas,Cantidad,Descripcion,Id_producto,Estado) values(?,?,?,?,?)');
								$q->bindParam(1,$Id_salida);
								$q->bindParam(2,$Cantidad);
								$q->bindParam(3,$Descripcion);
								$q->bindParam(4,$Id_producto);
								$q->bindParam(5,$Estado);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function add_reporte_trs($Id_salidas_trs,$Cantidad,$Descripcion,$Id_producto){
							try {
								$q = $this->pdo->prepare('INSERT INTO reporte_trs(Id_salidas_trs,Cantidad,Descripcion,Id_producto) values(?,?,?,?)');
								$q->bindParam(1,$Id_salidas_trs);
								$q->bindParam(2,$Cantidad);
								$q->bindParam(3,$Descripcion);
								$q->bindParam(4,$Id_producto);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function edit_precio($Id_precio,$Cantidad,$Precio_venta,$Estado){
							try {
								$q = $this->pdo->prepare('UPDATE precio SET Cantidad =?, Precio_venta =?, Estado =? WHERE Id_precio=?');
								$q->bindParam(1,$Cantidad);
								$q->bindParam(2,$Precio_venta);
								$q->bindParam(3,$Estado);
								$q->bindParam(4,$Id_precio);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function edit_precio_fac($Id_precio,$Cantidad){
							try {
								$q = $this->pdo->prepare('UPDATE precio SET Cantidad =(Cantidad - ?) WHERE Id_precio=?');
								$q->bindParam(1,$Cantidad);
								$q->bindParam(2,$Id_precio);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function edit_precios($Id_producto,$Cantidad,$Precio_compra,$Precio_venta,$Descuento,$Estado){
							try {
								$q = $this->pdo->prepare('UPDATE precio SET Cantidad = (Cantidad + '.$Cantidad.'), Precio_compra =?, Precio_venta =?, Descuento =?, Estado =? WHERE Id_producto=?');
								$q->bindParam(1,$Precio_compra);
								$q->bindParam(2,$Precio_venta);
								$q->bindParam(3,$Descuento);
								$q->bindParam(4,$Estado);
								$q->bindParam(5,$Id_producto);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function edit_precio_salidas($Id_precio,$Cantidad){
							try {
								$q = $this->pdo->prepare('UPDATE precio SET Cantidad = (Cantidad - ?) WHERE Id_precio=?');
								$q->bindParam(1,$Cantidad);
								$q->bindParam(2,$Id_precio);
								$q->execute();
								$this->pdo = null;
								return 0;
							} catch (PDOException $e) {
								echo 'Error '.$e->getMessage();
							}
							return 1;
						}

						public function del_precio($Id_precio){
							try {
								$q = $this->pdo->prepare('DELETE FROM precio WHERE Id_precio=?');
								$q->bindParam(1,$Id_precio);
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
