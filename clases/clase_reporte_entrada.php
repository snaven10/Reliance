<?php
include_once "cn.php":
class reporte_entrada extends cn
{
	public function get_reporte_entrada()
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM reporte_entrada');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_id_entradas($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM reporte_entrada where Id_entradas = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_id_salidas($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM reporte_salida where Id_salidas = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_id_producto($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM producto where Id_producto = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}
	public function get_id_reporte_entrada($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM reporte_entrada where Id_reporte_entrada = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}
	public function add_reporte_entrada($Id_entradas, $Cantidad, $Precio_compra, $Precio_venta, $Descuento, $Id_producto, $Estado)
	{
		try {
			$q = $this->pdo->prepare('INSERT INTO reporte_entrada(Id_entradas,Cantidad,Precio_compra,Precio_venta,Descuento,Id_producto,Estado) values(?,?,?,?,?,?,?)');

			$q->bindParam(1, $Id_entradas);
			$q->bindParam(2, $Cantidad);
			$q->bindParam(3, $Precio_compra);
			$q->bindParam(4, $Precio_venta);
			$q->bindParam(5, $Descuento);
			$q->bindParam(6, $Id_producto);
			$q->bindParam(7, $Estado);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function edit_reporte_entrada($Id_reporte_entrada, $Id_entradas, $Cantidad, $Precio_compra, $Precio_venta, $Descuento, $Id_producto, $Estado)
	{
		try {
			$q = $this->pdo->prepare('UPDATE reporte_entrada SET Id_entradas =?, Cantidad =?, Precio_compra =?, Precio_venta =?, Descuento =?, Id_producto =?, Estado =? WHERE Id_reporte_entrada=?');

			$q->bindParam(1, $Id_entradas);
			$q->bindParam(2, $Cantidad);
			$q->bindParam(3, $Precio_compra);
			$q->bindParam(4, $Precio_venta);
			$q->bindParam(5, $Descuento);
			$q->bindParam(6, $Id_producto);
			$q->bindParam(7, $Estado);
			$q->bindParam(8, $Id_reporte_entrada);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
	public function del_reporte_entrada($Id_reporte_entrada)
	{
		try {
			$q = $this->pdo->prepare('DELETE FROM reporte_entrada WHERE Id_reporte_entrada=?');
			$q->bindParam(1, $Id_reporte_entrada);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
}
