<?php
class producto
{
	private $pdo;


	public function __Construct()
	{
		try {
			$this->pdo = new PDO('mysql:host=localhost;dbname=heavy_parts_nuevo', 'snaven', 'SNAVEN10');
			$this->pdo->exec('SET CHARACTER SET utf8');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		} catch (PDOException $e) {
			echo 'Error!: ' . $e->getMessage();
			die();
		}
	}

	public function get_producto($sucursal)
	{
		try {
			$q = $this->pdo->prepare('SELECT
										*
									FROM
										producto
											INNER JOIN
										precio ON producto.Id_producto = precio.Id_producto
									WHERE
										precio.Id_sucursal = ?');
			$q->bindParam(1, $sucursal);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}
	
	public function get_producto_list()
	{
		try {
			$q = $this->pdo->prepare('SELECT
										*
									FROM
										producto
											INNER JOIN
										precio ON producto.Id_producto = precio.Id_producto');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function kardex_ventas($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT
										(SELECT
												Cod_producto
											FROM
												producto
											WHERE
												producto.Id_producto = detalle_venta.Id_producto) AS Cod_producto,
										Fecha,
										IF(N_ccf > 0,
											CONCAT("CCF #: ", N_ccf),
											CONCAT("FACTURA #: ", N_fac)) AS Numero,
										detalle_venta.Cantidad,
										encabezado_factura.Id_pedido
									FROM
										encabezado_factura
											INNER JOIN
										detalle_venta ON encabezado_factura.Id_pedido = detalle_venta.Id_pedido
									WHERE
										detalle_venta.Id_producto = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function kardex_entradas($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT
										(SELECT
												Cod_producto
											FROM
												producto
											WHERE
												producto.Id_producto = reporte_entrada.Id_producto) AS Cod_producto,
										Fecha, Numero,
										reporte_entrada.Cantidad
									FROM
										entradas
											INNER JOIN
										reporte_entrada ON entradas.Id_entradas = reporte_entrada.Id_entradas
									WHERE
										reporte_entrada.Id_producto = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function kardex_salidas($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT
										(SELECT
												Cod_producto
											FROM
												producto
											WHERE
												producto.Id_producto = reporte_salida.Id_producto) AS Cod_producto,
										Fecha, Numero,
										reporte_salida.Cantidad
									FROM
										salidas
											INNER JOIN
										reporte_salida ON salidas.Id_salidas = reporte_salida.Id_salidas
									WHERE
										reporte_salida.Id_producto = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function ultimo()
	{
		try {
			$q = $this->pdo->prepare('SELECT max(Id_producto) FROM producto');
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

	public function get_id_cod_reemplazo($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM cod_reemplazo where Id_cod_reemplazo = ?');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_id_producto_ubicasion($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT
										*
									FROM
										producto
											INNER JOIN
										precio ON producto.Id_producto = precio.Id_producto
											INNER JOIN
										ubicacion ON producto.Id_ubicacion = ubicacion.Id_ubicacion
									WHERE
										precio.Cantidad > 0 AND Estante = ? order by Cod_producto');
			$q->bindParam(1, $id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_producto_cod($id)
	{
		try {
			$q = $this->pdo->prepare('SELECT
										producto.*, proveedor.Nombre AS Proveedor
									FROM
										producto
											INNER JOIN
										proveedor ON  producto.Id_proveedor = proveedor.Id_proveedor
									WHERE Cod_producto = ? ');
			$q->bindParam(1, $id);
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
	public function add_producto($Cod_producto, $Cod_oem, $Nombre, $Descripcion, $img, $Id_proveedor, $Id_ubicacion, $Estado)
	{
		try {
			$q = $this->pdo->prepare('INSERT INTO producto(Cod_producto,Cod_oem,Nombre,Descripcion,img,Id_proveedor,Id_ubicacion,Estado) values(?,?,?,?,?,?,?,?)');

			$q->bindParam(1, $Cod_producto);
			$q->bindParam(2, $Cod_oem);
			$q->bindParam(3, $Nombre);
			$q->bindParam(4, $Descripcion);
			$q->bindParam(5, $img);
			$q->bindParam(6, $Id_proveedor);
			$q->bindParam(7, $Id_ubicacion);
			$q->bindParam(8, $Estado);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function edit_producto($Id_producto, $Cod_producto, $Cod_oem, $Nombre, $Descripcion, $img, $Id_proveedor, $Id_ubicacion, $Estado)
	{
		try {
			$q = $this->pdo->prepare('UPDATE producto SET Cod_producto =?, Cod_oem =?, Nombre =?, Descripcion =?, img =?, Id_proveedor =?, Id_ubicacion =?, Estado =? WHERE Id_producto=?');

			$q->bindParam(1, $Cod_producto);
			$q->bindParam(2, $Cod_oem);
			$q->bindParam(3, $Nombre);
			$q->bindParam(4, $Descripcion);
			$q->bindParam(5, $img);
			$q->bindParam(6, $Id_proveedor);
			$q->bindParam(7, $Id_ubicacion);
			$q->bindParam(8, $Estado);
			$q->bindParam(9, $Id_producto);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}


	public function modificar($Id_producto, $Id_ubicacion)
	{
		try {
			$q = $this->pdo->prepare('UPDATE producto SET Id_ubicacion =? WHERE Id_producto=?');

			$q->bindParam(1, $Id_ubicacion);
			$q->bindParam(2, $Id_producto);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}

	public function consulta($Dato, $po)
	{
		try {
			$q = $this->pdo->prepare('SELECT
										pr.Id_producto
									FROM
										producto AS pr
									WHERE
										SUBSTR(pr.Cod_producto, 1, ' . $po . ') = ?');
			$q->bindParam(1, $Dato);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function consulta_cod($Dato)
	{
		try {
			$q = $this->pdo->prepare('SELECT
											*
									FROM
											producto
										INNER JOIN
											precio ON producto.Id_producto = precio.Id_producto
												INNER JOIN
											ubicacion ON producto.Id_ubicacion = ubicacion.Id_ubicacion
										WHERE
											precio.Cantidad > 0 AND SUBSTR(Cod_producto, 1, 3) = ? order by Cod_producto');
			$q->bindParam(1, $Dato);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function del_producto($Id_producto)
	{
		try {
			$q = $this->pdo->prepare('DELETE FROM producto WHERE Id_producto=?');
			$q->bindParam(1, $Id_producto);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
}
