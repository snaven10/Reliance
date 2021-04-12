<?php
include "cn.php";
class factura extends cn
{
	public function get_factura()
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM factura');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function Consultar_series($datos)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM factura WHERE CCF = ?');
			$q->bindParam(1, $datos);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function ultimo($par)
	{
		try {
			$q = $this->pdo->prepare('SELECT * , (max(Numero_cor)+1) as Numero FROM factura where CCF = ? and Estado = 1');
			$q->bindParam(1, $par);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_id_factura($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM factura where Id_factura = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}
	public function add_factura($Serie, $Numero_factura, $ccf, $Estado)
	{
		try {
			$numero = self::ultimo($ccf);
			$Id_factura = $numero[0][0];
			self::desactivar_factura($Id_factura, 0);
			$q = $this->pdo->prepare('INSERT INTO factura(Serie,Numero_factura,Numero_cor,CCF,Estado) values(?,?,?,?,?)');
			$q->bindParam(1, $Serie);
			$q->bindParam(2, $Numero_factura);
			$q->bindParam(3, $Numero_factura);
			$q->bindParam(4, $ccf);
			$q->bindParam(5, $Estado);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function desactivar_factura($Id_factura, $Estado)
	{
		try {
			$q = $this->pdo->prepare('UPDATE factura SET Estado =? WHERE Id_factura=?');
			$q->bindParam(1, $Estado);
			$q->bindParam(2, $Id_factura);
			$q->execute();
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function edit_factura($Id_factura, $Serie, $Numero_factura, $Numero_cor, $Estado)
	{
		try {
			$q = $this->pdo->prepare('UPDATE factura SET Serie =?, Numero_factura =?, Numero_cor =?, Estado =? WHERE Id_factura=?');

			$q->bindParam(1, $Serie);
			$q->bindParam(2, $Numero_factura);
			$q->bindParam(3, $Numero_cor);
			$q->bindParam(4, $Estado);
			$q->bindParam(5, $Id_factura);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function edit_facturas($Id_factura, $Estado)
	{
		try {
			$q = $this->pdo->prepare('UPDATE factura SET Estado =? WHERE Id_factura=?');

			$q->bindParam(1, $Estado);
			$q->bindParam(2, $Id_factura);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function edit_facturas_c($Id_factura, $Numero_cor)
	{
		try {
			$q = $this->pdo->prepare('UPDATE factura SET Numero_cor =? WHERE Id_factura=?');

			$q->bindParam(1, $Numero_cor);
			$q->bindParam(2, $Id_factura);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function del_factura($Id_factura)
	{
		try {
			$q = $this->pdo->prepare('UPDATE factura SET Estado =? WHERE Id_factura=?');
			$q->bindParam(1, 0);
			$q->bindParam(2, $Id_factura);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
}
