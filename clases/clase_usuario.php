<?php
include_once "cn.php":
class usuario extends cn {
	public function get_usuario(){
		try{
			$q = $this->pdo->prepare('SELECT
										usuario.Id_usuario,
										usuario.Nombre,
										usuario.Usuario,
										usuario.Nivel,
										usuario.Estado,
										user_sucu.Id_sucursal,
										sucursales.Sucursal
									FROM
										usuario
									LEFT JOIN user_sucu ON
										usuario.Id_usuario = user_sucu.Id_usuario
									LEFT  JOIN sucursales ON
										user_sucu.Id_sucursal = sucursales.Id_sucursales
									WHERE Nivel != 3');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}
	public function get_usuario_ad(){
		try{
			$q = $this->pdo->prepare('SELECT
										usuario.Id_usuario,
										usuario.Nombre,
										usuario.Usuario,
										usuario.Nivel,
										usuario.Estado,
										user_sucu.Id_sucursal,
										sucursales.Sucursal
									FROM
										usuario
									LEFT JOIN user_sucu ON
										usuario.Id_usuario = user_sucu.Id_usuario
									LEFT  JOIN sucursales ON
										user_sucu.Id_sucursal = sucursales.Id_sucursales');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}
	public function login_usuario($Usser, $Pass){
		try{
			$q = $this->pdo->prepare('SELECT
										usuario.Id_usuario,
										Nivel,
										Nombre,
										sucursales.Id_sucursales,
										Sucursal,
										Tipo
									FROM
										usuario
											INNER JOIN
										user_sucu ON usuario.Id_usuario = user_sucu.Id_usuario
										INNER JOIN
										sucursales ON user_sucu.Id_sucursal = sucursales.Id_sucursales
									WHERE
										Usuario = ?
											AND Password = ?');
			$q->bindParam(1,$Usser);
			$q->bindParam(2,$Pass);
			$q->execute();
			return $q->fetch(PDO::FETCH_ASSOC);
			$this->pdo = null;
			return 0;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}
	public function get_id_usuario($id){
		try{
			$q = $this->pdo->prepare('SELECT * FROM usuario where Id_usuario = ?');
			$q->bindParam(1,$id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}
	public function add_usuario($Nombre,$Usuario,$Password,$Nivel,$Estado){
		try {
			$q = $this->pdo->prepare('INSERT INTO usuario(Nombre,Usuario,Password,Nivel,Estado) values(?,?,?,?,?)');
			$q->bindParam(1,$Nombre);
			$q->bindParam(2,$Usuario);
			$q->bindParam(3,$Password);
			$q->bindParam(4,$Nivel);
			$q->bindParam(5,$Estado);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}
	public function asignar_sucursal($Id_user,$Id_sucursal){
		try {
			$q = $this->pdo->prepare('INSERT INTO user_sucu (Id_usuario, Id_sucursal) VALUES(?, ?)');
			$q->bindParam(1,$Id_user);
			$q->bindParam(2,$Id_sucursal);
			$q->execute();
			return $this->reactivar_use($Id_user);
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}
	public function reactivar_use($Id_usuario){
		try {
			$q = $this->pdo->prepare('UPDATE usuario SET Estado = 1	WHERE Id_usuario = ?');
			$q->bindParam(1,$Id_usuario);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}
	public function edit_usuario($Id_usuario,$Nombre,$Usuario,$Password,$Nivel,$Estado){
		try {
			$q = $this->pdo->prepare('UPDATE usuario SET Nombre =?, Usuario =?, Password =?, Nivel =?, Estado =? WHERE Id_usuario=?');
			$q->bindParam(1,$Nombre);
			$q->bindParam(2,$Usuario);
			$q->bindParam(3,$Password);
			$q->bindParam(4,$Nivel);
			$q->bindParam(5,$Estado);
			$q->bindParam(6,$Id_usuario);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}
	public function del_usuario($Id_usuario){
		try {
			$q = $this->pdo->prepare('UPDATE usuario SET Estado = 0	WHERE Id_usuario = ?');
			$q->bindParam(1,$Id_usuario);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}
}
