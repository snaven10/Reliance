<?php
include_once "cn.php";
class abonos extends cn
{
	public function get_clientes_creditos()
	{
		try {
			$q = $this->pdo->prepare('SELECT 
										    clt.*,
										    detalle_cliente.*,
										    (SELECT 
										            CONCAT(SUM((Compra_total - (Compra_total * Descuento))),
										                        ";",
										                        SUM(Abono))
										        FROM
										            encabezado_factura
										                INNER JOIN
										            pedido ON encabezado_factura.Id_pedido = pedido.Id_pedido
										                INNER JOIN
										            cliente ON pedido.Id_cliente = cliente.Id_cliente
										        WHERE
										            cliente.Id_cliente = clt.Id_cliente) AS Datos
										FROM
										    cliente AS clt
										        INNER JOIN
										    detalle_cliente ON clt.Id_cliente = detalle_cliente.Id_cliente
										WHERE
										    clt.Estado = 1;');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_encabezado_facturas()
	{
		try {
			$q = $this->pdo->prepare('SELECT 
										    encabezado_factura.*, factura.Serie, cliente.Nombre As Cliente,
										    (encabezado_factura.Descuento*encabezado_factura.Compra_total) AS Descuento_compra
										FROM
										    encabezado_factura
										        INNER JOIN
										    factura ON encabezado_factura.Id_factura = factura.Id_factura
										        INNER JOIN
										    pedido ON encabezado_factura.Id_pedido = pedido.Id_pedido
										        INNER JOIN
										    cliente ON pedido.Id_cliente = cliente.Id_cliente
										WHERE
										    Condicon_operacion = 2
										ORDER BY Fecha DESC;');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_facturas_abonadas($fecha_inicial, $fecha_final)
	{
		try {
			$q = $this->pdo->prepare('SELECT 
										    encabezado_factura.*, (Compra_total - (Compra_total * Descuento)) AS Total, abonos.Fecha, 
										    abonos.Abano As Monto, factura.Serie, cliente.Nombre As Cliente,
										    (encabezado_factura.Descuento*encabezado_factura.Compra_total) AS Descuento_compra
										FROM
										    encabezado_factura
										        INNER JOIN
										    factura ON encabezado_factura.Id_factura = factura.Id_factura
										        INNER JOIN
										    pedido ON encabezado_factura.Id_pedido = pedido.Id_pedido
										        INNER JOIN
										    cliente ON pedido.Id_cliente = cliente.Id_cliente
										        INNER JOIN
										    abonos ON encabezado_factura.Id_encabezado_factura = abonos.Id_encabezado_factura
										WHERE
										    Condicon_operacion = 2 AND abonos.Fecha BETWEEN "' . $fecha_inicial . '" AND "' . $fecha_final . '";');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_encabezado_facturas_pendientes()
	{
		try {
			$q = $this->pdo->prepare('SELECT 
										    encabezado_factura.*,
										    factura.Serie,
										    cliente.Nombre AS Cliente,
										    (encabezado_factura.Descuento*encabezado_factura.Compra_total) AS Descuento_compra
										FROM
										    encabezado_factura
										        INNER JOIN
										    factura ON encabezado_factura.Id_factura = factura.Id_factura
										        INNER JOIN
										    pedido ON encabezado_factura.Id_pedido = pedido.Id_pedido
										        INNER JOIN
										    cliente ON pedido.Id_cliente = cliente.Id_cliente
										WHERE
										    Condicon_operacion = 2 AND abono = 0
										    AND encabezado_factura.Estado = 1
										ORDER BY Fecha DESC;');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_encabezado_facturas_abonadas()
	{
		try {
			$q = $this->pdo->prepare('SELECT 
										    encabezado_factura.*,
										    factura.Serie,
										    cliente.Nombre AS Cliente,
										    (encabezado_factura.Descuento*encabezado_factura.Compra_total) AS Descuento_compra
										FROM
										    encabezado_factura
										        INNER JOIN
										    factura ON encabezado_factura.Id_factura = factura.Id_factura
										        INNER JOIN
										    pedido ON encabezado_factura.Id_pedido = pedido.Id_pedido
										        INNER JOIN
										    cliente ON pedido.Id_cliente = cliente.Id_cliente
										WHERE
										    Condicon_operacion = 2
										        AND ((encabezado_factura.Compra_total-(encabezado_factura.Descuento*encabezado_factura.Compra_total)) > Abono AND Abono > 0)
										        AND encabezado_factura.Estado = 1
										ORDER BY Fecha DESC;');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_encabezado_facturas_canseladas()
	{
		try {
			$q = $this->pdo->prepare('SELECT 
										    encabezado_factura.*,
										    factura.Serie,
										    cliente.Nombre AS Cliente,
										    (encabezado_factura.Descuento*encabezado_factura.Compra_total) AS Descuento_compra
										FROM
										    encabezado_factura
										        INNER JOIN
										    factura ON encabezado_factura.Id_factura = factura.Id_factura
										        INNER JOIN
										    pedido ON encabezado_factura.Id_pedido = pedido.Id_pedido
										        INNER JOIN
										    cliente ON pedido.Id_cliente = cliente.Id_cliente
										WHERE
										    Condicon_operacion = 2
										        AND (encabezado_factura.Compra_total-(encabezado_factura.Descuento*encabezado_factura.Compra_total)) = Abono
										        AND encabezado_factura.Estado = 1
										ORDER BY Fecha DESC;');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_factura_id($Id)
	{
		try {
			$q = $this->pdo->prepare('SELECT 
										    encabezado_factura.*, factura.Serie, cliente.Nombre As Cliente,
										    (encabezado_factura.Descuento*encabezado_factura.Compra_total) AS Descuento_compra
										FROM
										    encabezado_factura
										        INNER JOIN
										    factura ON encabezado_factura.Id_factura = factura.Id_factura
										        INNER JOIN
										    pedido ON encabezado_factura.Id_pedido = pedido.Id_pedido
										        INNER JOIN
										    cliente ON pedido.Id_cliente = cliente.Id_cliente
										WHERE
										    Id_encabezado_factura = ? ;');
			$q->bindParam(1, $Id);
			$q->execute();
			return $q->fetch();
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function get_abonos_id_encabezado_factura($Id)
	{
		try {
			$q = $this->pdo->prepare('SELECT * FROM abonos WHERE Id_encabezado_factura = ?;');
			$q->bindParam(1, $Id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
	}

	public function add_abonos($Id_encabezado_factura, $Monto)
	{
		try {
			$q = $this->pdo->prepare('INSERT INTO abonos (Id_encabezado_factura, Abano) VALUES (?, ?);');

			$q->bindParam(1, $Id_encabezado_factura);
			$q->bindParam(2, $Monto);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error ' . $e->getMessage();
		}
		return 1;
	}
}
