<?php
include "cn.php";
class proveedor extends cn
{
	public function get_proveedor()
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM proveedor');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_id_proveedor($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM proveedor where Id_proveedor = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function buscar_proveedor($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM proveedor where Nombre = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function add_proveedor($Nombre, $Nit_empresa, $Telefono, $Direccion, $Email, $Estado)
	{
		try {
			$q = $this->pdo->prepare('INSERT INTO proveedor(Nombre,Nit_empresa,Telefono,Direccion,Email,Estado) values(?,?,?,?,?,?)');

			$q->bindParam(1, $Nombre);
			$q->bindParam(2, $Nit_empresa);
			$q->bindParam(3, $Telefono);
			$q->bindParam(4, $Direccion);
			$q->bindParam(5, $Email);
			$q->bindParam(6, $Estado);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function edit_proveedor($Id_proveedor, $Nombre, $Nit_empresa, $Telefono, $Direccion, $Email, $Estado)
	{
		try {
			$q = $this->pdo->prepare('UPDATE proveedor SET Nombre =?, Nit_empresa =?, Telefono =?, Direccion =?, Email =?, Estado =? WHERE Id_proveedor=?');

			$q->bindParam(1, $Nombre);
			$q->bindParam(2, $Nit_empresa);
			$q->bindParam(3, $Telefono);
			$q->bindParam(4, $Direccion);
			$q->bindParam(5, $Email);
			$q->bindParam(6, $Estado);
			$q->bindParam(7, $Id_proveedor);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
	public function del_proveedor($Id_proveedor)
	{
		try {
			$q = $this->pdo->prepare('DELETE FROM proveedor WHERE Id_proveedor=?');
			$q->bindParam(1, $Id_proveedor);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
}
