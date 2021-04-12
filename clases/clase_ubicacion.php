<?php
include_once "cn.php";
class ubicacion extends cn
{
	public function get_ubicacion($sucursal)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM ubicacion WHERE Id_sucursal = ?');
			$q->bindParam(1, $sucursal);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_ubicacion_dist()
	{
		try {
			$q = $this->pdo->prepare('SELECT distinct Estante FROM ubicacion');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_id_ubicacion($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM ubicacion where Id_ubicacion = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function buscar_ubicacion($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM ubicacion where Estante = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function buscar($Estante)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM ubicacion where Estante = ?');
			$q->bindParam(1, $Estante);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function add_ubicacion($Estante, $Estado)
	{
		try {
			$q = $this->pdo->prepare('INSERT INTO ubicacion(Estante,Estado) values(?,?)');

			$q->bindParam(1, $Estante);
			$q->bindParam(2, $Repisa);
			$q->bindParam(3, $Casilla);
			$q->bindParam(4, $Estado);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function edit_ubicacion($Id_ubicacion, $Estante, $Estado)
	{
		try {
			$q = $this->pdo->prepare('UPDATE ubicacion SET Estante =?, Estado =? WHERE Id_ubicacion=?');

			$q->bindParam(1, $Estante);
			$q->bindParam(2, $Estado);
			$q->bindParam(3, $Id_ubicacion);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
	public function del_ubicacion($Id_ubicacion)
	{
		try {
			$q = $this->pdo->prepare('DELETE FROM ubicacion WHERE Id_ubicacion=?');
			$q->bindParam(1, $Id_ubicacion);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
}
