<?php
	class cierre{

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
		public function get_cierre_general()
		{
			try
			{
				$q = $this->pdo->prepare('SELECT * FROM cierre WHERE Estado = 1');
				$q->execute();
				return $q->fetchAll();
			}
			catch(PDOException $e)
			{
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_ultimo_cierre_general()
		{
			try
			{
				$q = $this->pdo->prepare('SELECT * FROM cierre WHERE Estado = 1 order by Id_cierre DESC LIMIT 1');
				$q->execute();
				return $q->fetch();
			}
			catch(PDOException $e)
			{
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_venta_total($fecha_inicial,$fecha_final){
			try{
				$q = $this->pdo->prepare('SELECT 
										    SUM((Compra_total - (Compra_total * Descuento))) AS	Total
										FROM
										    encabezado_factura
										WHERE
										    Condicon_operacion = 1
										        AND Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'";');
				$q->execute();
				return $q->fetch();
			}catch(PDOException $e){
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_gastos($fecha_inicial,$fecha_final){
			try{
				$q = $this->pdo->prepare('SELECT 
										    SUM(Monto) AS Total
										FROM
										    gatos
										WHERE
										    Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'";');
				$q->execute();
				return $q->fetch();
			}catch(PDOException $e){
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_egresos($fecha_inicial,$fecha_final){
			try{
				$q = $this->pdo->prepare('SELECT 
										    SUM(Monto) AS Total
										FROM
										    egresos
										WHERE
										    Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'";');
				$q->execute();
				return $q->fetch();
			}catch(PDOException $e){
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_gastos_fecha($fecha_inicial,$fecha_final){
			try{
				$q = $this->pdo->prepare('SELECT 
										    *
										FROM
										    gatos
										WHERE
										    Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'";');
				$q->execute();
				return $q->fetchAll();
			}catch(PDOException $e){
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_egresos_fecha($fecha_inicial,$fecha_final){
			try{
				$q = $this->pdo->prepare('SELECT 
										    *
										FROM
										    egresos
										WHERE
										    Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'";');
				$q->execute();
				return $q->fetchAll();
			}catch(PDOException $e){
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_abonos($fecha_inicial,$fecha_final){
			try{
				$q = $this->pdo->prepare('SELECT 
										    SUM(Abano) AS Total
										FROM
										    abonos
										WHERE
										    Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'";');
				$q->execute();
				return $q->fetch();
			}catch(PDOException $e){
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_depositos($fecha_inicial,$fecha_final){
			try{
				$q = $this->pdo->prepare('SELECT 
										    SUM(Monto) AS Total
										FROM
										    depositos
										WHERE
										    Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'";');
				$q->execute();
				return $q->fetch();
			}catch(PDOException $e){
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_depositos_fecha($fecha_inicial,$fecha_final){
			try{
				$q = $this->pdo->prepare('SELECT 
										    *
										FROM
										    depositos
										WHERE
										    Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'";');
				$q->execute();
				return $q->fetchAll();
			}catch(PDOException $e){
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_caja_cierre(){
			try{
				$q = $this->pdo->prepare('SELECT Caja_cierre AS Total FROM cierre order by Id_cierre DESC LIMIT 1');
				$q->execute();
				return $q->fetch();
			}catch(PDOException $e){
				echo 'Error '.$e->getMessage();
			}
		}

		public function get_cierre($fecha_inicial,$fecha_final){
			try{
				$q = $this->pdo->prepare('SELECT *,count(Id_cierre) AS Total FROM cierre WHERE Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'";');
				$q->execute();
				return $q->fetch();
			}catch(PDOException $e){
				echo 'Error '.$e->getMessage();
			}
		}

		public function add_cierre($Dia_anterior,$Ventas,$Abonos,$Gastos,$Egresos,$Depositos,$Caja,$Caja_cierre,$Fecha){
			try {
				$q = $this->pdo->prepare('INSERT INTO cierre (Dia_anterior, Ventas, Abonos, Gastos,Egresos, Depositos, Caja, Caja_cierre, Fecha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);');
					$q->bindParam(1,$Dia_anterior);
					$q->bindParam(2,$Ventas);
					$q->bindParam(3,$Abonos);
					$q->bindParam(4,$Gastos);
					$q->bindParam(5,$Egresos);
					$q->bindParam(6,$Depositos);
					$q->bindParam(7,$Caja);
					$q->bindParam(8,$Caja_cierre);
					$q->bindParam(9,$Fecha);
					$q->execute();
					return 0;
				
			} catch (PDOException $e) {
				echo 'Error '.$e->getMessage();
			}
			return 1;
		}

		public function add_deposito($Depositos,$Fecha){
			try {
				$q = $this->pdo->prepare('INSERT INTO depositos (Monto,Fecha) VALUES (?,?);');
					$q->bindParam(1,$Depositos);
					$q->bindParam(2,$Fecha);
					$q->execute();
					return 0;
				
			} catch (PDOException $e) {
				echo 'Error '.$e->getMessage();
			}
			return 1;
		}

		public function add_gasto($Monto,$Descripcion){
			try {
				$q = $this->pdo->prepare('INSERT INTO gatos (Monto, Descripcion) VALUES (?, ?);');
					$q->bindParam(1,$Monto);
					$q->bindParam(2,$Descripcion);
					$q->execute();
					return 0;
				
			} catch (PDOException $e) {
				echo 'Error '.$e->getMessage();
			}
			return 1;
		}

		public function add_egresos($Monto,$Descripcion){
			try {
				$q = $this->pdo->prepare('INSERT INTO egresos (Monto, Descripcion) VALUES (?, ?);');
					$q->bindParam(1,$Monto);
					$q->bindParam(2,$Descripcion);
					$q->execute();
					return 0;
				
			} catch (PDOException $e) {
				echo 'Error '.$e->getMessage();
			}
			return 1;
		}

	}
?>
