<?php
include_once "cn.php":
class comicion extends cn
{
	public function get_comicion()
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM comicion');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_id_vendedor($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM vendedor where Id_vendedor = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}
	public function get_id_mecanico($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM mecanico where Id_mecanico = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}
	public function get_id_comicion($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM comicion where Id_comicion = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function buscar_comicion($Id_mecanico, $Id_vendedor)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM comicion where Id_mecanico = ? and Id_vendedor = ? order by Comicion asc');
			$q->bindParam(1, $Id_mecanico);
			$q->bindParam(2, $Id_vendedor);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function add_comicion($Id_vendedor, $Id_mecanico, $Comicion, $Tipo_persona, $Estado)
	{
		try {
			$q = $this->pdo->prepare('INSERT INTO comicion(Id_vendedor,Id_mecanico,Comicion,Tipo_persona,Estado) values(?,?,?,?,?)');

			$q->bindParam(1, $Id_vendedor);
			$q->bindParam(2, $Id_mecanico);
			$q->bindParam(3, $Comicion);
			$q->bindParam(4, $Tipo_persona);
			$q->bindParam(5, $Estado);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function edit_comicion($Id_comicion, $Id_vendedor, $Id_mecanico, $Comicion, $Tipo_persona, $Estado)
	{
		try {
			$q = $this->pdo->prepare('UPDATE comicion SET Id_vendedor =?, Id_mecanico =?, Comicion =?, Tipo_persona =?, Estado =? WHERE Id_comicion=?');

			$q->bindParam(1, $Id_vendedor);
			$q->bindParam(2, $Id_mecanico);
			$q->bindParam(3, $Comicion);
			$q->bindParam(4, $Tipo_persona);
			$q->bindParam(5, $Estado);
			$q->bindParam(6, $Id_comicion);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
	public function del_comicion($Id_comicion)
	{
		try {
			$q = $this->pdo->prepare('DELETE FROM comicion WHERE Id_comicion=?');
			$q->bindParam(1, $Id_comicion);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
}
