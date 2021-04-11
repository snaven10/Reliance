<?php
class sucursales{
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

	public function get_sucursales(){
		try{
			$q = $this->pdo->prepare('SELECT * FROM sucursales order by Tipo desc');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function get_id_sucursales($Id){
		try{
			$q = $this->pdo->prepare('SELECT * FROM sucursales WHERE Id_sucursales = ?');
			$q->bindParam(1,$Id);
			$q->execute();
			return $q->fetch();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function mostrar_sucursales($Id){
		try{
			$q = $this->pdo->prepare('SELECT * FROM sucursales WHERE Id_sucursales != ?');
			$q->bindParam(1,$Id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function add_sucursales($Nombre,$Nit_empresa,$Telefono,$Direccion,$Email,$Estado){
		try {
			$q = $this->pdo->prepare('INSERT INTO sucursales(Nombre,Nit_empresa,Telefono,Direccion,Email,Estado) values(?,?,?,?,?,?)');
				
			$q->bindParam(1,$Nombre);
			$q->bindParam(2,$Nit_empresa);
			$q->bindParam(3,$Telefono);
			$q->bindParam(4,$Direccion);
			$q->bindParam(5,$Email);
			$q->bindParam(6,$Estado);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}

	public function edit_sucursales($Id_sucursales,$Nombre,$Nit_empresa,$Telefono,$Direccion,$Email,$Estado){
		try {
			$q = $this->pdo->prepare('UPDATE sucursales SET Nombre =?, Nit_empresa =?, Telefono =?, Direccion =?, Email =?, Estado =? WHERE Id_sucursales=?');
				
			$q->bindParam(1,$Nombre);
			$q->bindParam(2,$Nit_empresa);
			$q->bindParam(3,$Telefono);
			$q->bindParam(4,$Direccion);
			$q->bindParam(5,$Email);
			$q->bindParam(6,$Estado);
			$q->bindParam(7,$Id_sucursales); 
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}
	
	public function desactivar_matris($Id_sucursales){
		try {
			$q = $this->pdo->prepare('UPDATE sucursales SET Tipo = 0 WHERE Tipo != 0'); 
			$q->execute();
			self::activar_matris($Id_sucursales);
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}

	public function activar_matris($Id_sucursales){
		try {
			$q = $this->pdo->prepare('UPDATE sucursales SET Tipo = 1 WHERE Id_sucursales = ?'); 
			$q->bindParam(1,$Id_sucursales);
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