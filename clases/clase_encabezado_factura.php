<?php
class encabezado_factura{
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

	public function get_encabezado_factura(){
		try{
			$q = $this->pdo->prepare('SELECT * FROM encabezado_factura');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function get_total_inventario(){
		try{
			$q = $this->pdo->prepare('SELECT sum(Cantidad*Precio_compra) as Total FROM precio where Cantidad != 0');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function buscar_fac_ccf($N_fac,$N_ccf){
		try{
			$q = $this->pdo->prepare('SELECT 
									    encabezado_factura.Id_factura, encabezado_factura.N_fac, encabezado_factura.N_ccf, fac.Serie
									FROM
									    encabezado_factura INNER JOIN factura AS fac ON fac.Id_factura = encabezado_factura.Id_factura
									WHERE
										(SELECT 
										    Estado
										FROM
										    factura
										WHERE
										    factura.Id_factura = encabezado_factura.Id_factura) = 1
										AND encabezado_factura.Estado =1 AND encabezado_factura.N_fac = '.$N_fac.' OR encabezado_factura.N_ccf = '.$N_ccf);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function buscar_Id_fac_ccf($Serie,$N_fac,$N_ccf){
		try{
			$q = $this->pdo->prepare('SELECT 
									    ef.Id_encabezado_factura,
										ef.Id_pedido, 
										fac.Serie
									FROM
									    encabezado_factura AS ef INNER JOIN factura AS fac ON fac.Id_factura = ef.Id_factura
									WHERE
									    fac.Serie = ? AND ef.N_fac = ?
									        AND ef.N_ccf = ? LIMIT 1');
			$q->bindParam(1,$Serie);
			$q->bindParam(2,$N_fac);
			$q->bindParam(3,$N_ccf);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function buscar_detalle_venta($id){
		try{
			$q = $this->pdo->prepare('SELECT * FROM detalle_venta where Id_pedido = ?');
			$q->bindParam(1,$id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function get_precio_id_producto($id){
		try{
			$q = $this->pdo->prepare('SELECT * FROM precio where Id_producto = ?');
			$q->bindParam(1,$id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function get_id_producto($id){
		try{
			$q = $this->pdo->prepare('SELECT * FROM producto where Id_producto = ?');
			$q->bindParam(1,$id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function edit_precio_anu_fac($Id_precio,$Cantidad){
		try {
			$q = $this->pdo->prepare('UPDATE precio SET Cantidad =(Cantidad + ?) WHERE Id_precio=?');

			$q->bindParam(1,$Cantidad);
			$q->bindParam(2,$Id_precio);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}

	public function buscar_encabezado_factura($Id_pedido){
		try{
			$q = $this->pdo->prepare('SELECT * FROM encabezado_factura where Id_pedido = ?');
			$q->bindParam(1,$Id_pedido);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function buscar_comision_mecanico($fecha_inicial,$fecha_final){
		try{
			$q = $this->pdo->prepare('SELECT 
									    Nombre,
									    (SELECT 
									            IFNULL(SUM(Comision_m), 0)
									        FROM
									            encabezado_factura
									                INNER JOIN
									            pedido ON pedido.Id_pedido = encabezado_factura.Id_pedido
									        WHERE
									            pedido.Id_mecanico = mecanico.Id_mecanico
									                AND Comision_m != 0
									                AND encabezado_factura.Estado != 0
									                AND Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'") AS Comision
									FROM
									    mecanico
									WHERE
									    (SELECT 
									            IFNULL(SUM(Comision_m), 0)
									        FROM
									            encabezado_factura
									                INNER JOIN
									            pedido ON pedido.Id_pedido = encabezado_factura.Id_pedido
									        WHERE
									            pedido.Id_mecanico = mecanico.Id_mecanico
									                AND Comision_m != 0
									                AND encabezado_factura.Estado != 0
									                AND Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'") != 0 order by Comision desc');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function buscar_comision_vendedor($fecha_inicial,$fecha_final){
		try{
			$q = $this->pdo->prepare('SELECT 
										    Nombre,
										    (SELECT 
										            IFNULL(SUM(Comision_m), 0)
										        FROM
										            encabezado_factura
										                INNER JOIN
										            pedido ON pedido.Id_pedido = encabezado_factura.Id_pedido
										        WHERE
										            pedido.Id_vendedor = vendedor.Id_vendedor
										                AND encabezado_factura.Estado != 0
										                AND Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'") AS Comision_m,
										    (SELECT 
										            IFNULL(SUM(Comision_v), 0)
										        FROM
										            encabezado_factura
										                INNER JOIN
										            pedido ON pedido.Id_pedido = encabezado_factura.Id_pedido
										        WHERE
														pedido.Id_vendedor = vendedor.Id_vendedor
										                AND encabezado_factura.Estado != 0
										                AND Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'") AS Comision,
										    (SELECT 
										            IFNULL(SUM(Precio_c*Cantidad), 0)
										        FROM
										            encabezado_factura
										                INNER JOIN
										            pedido ON pedido.Id_pedido = encabezado_factura.Id_pedido
										            INNER JOIN
										            detalle_venta ON detalle_venta.Id_pedido = encabezado_factura.Id_pedido
										        WHERE
														pedido.Id_vendedor = vendedor.Id_vendedor
										                AND encabezado_factura.Estado != 0
										                AND Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'") AS Precio_c,
											(SELECT 
										            IFNULL(SUM(Compra_total*(1-Descuento)), 0)
										        FROM
										            encabezado_factura
										                INNER JOIN
										            pedido ON pedido.Id_pedido = encabezado_factura.Id_pedido
										        WHERE
										            pedido.Id_vendedor = vendedor.Id_vendedor
										                AND encabezado_factura.Estado != 0
										                AND Fecha BETWEEN "'.$fecha_inicial.'" AND "'.$fecha_final.'") AS Venta
										FROM
										    vendedor
										ORDER BY Comision DESC');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function buscar_encabezado_factura_fecha($fecha_inicial,$fecha_final,$filtros){
		try{
			$filtro = "";
			if ($filtros == 0) {
				$filtro = "";
			}elseif ($filtros == 1) {
				$filtro = "(N_fac = 0 AND N_ccf > 0) AND";
			}elseif ($filtros == 2) {
				$filtro = "(N_fac > 0 AND N_ccf = 0) AND";
			}
			$q = $this->pdo->prepare('SELECT
										Condicon_operacion,
									    Id_factura,
									    N_fac,
									    N_ccf,
									    CASE Estado
									        WHEN 1 THEN (Compra_total - (Compra_total * Descuento))
									        ELSE 0
									    END AS Total,
									    CASE Estado
									        WHEN 1 THEN (((Compra_total - (Compra_total * Descuento)) / 1.13) * 0.13)
									        ELSE 0
									    END AS Iva,
									    Id_pedido,
									    CASE Estado
									        WHEN 1 THEN Comision_m
									        ELSE 0
									    END AS Comision_m,
									    CASE Estado
									        WHEN 1 THEN Comision_v
									        ELSE 0
									    END AS Comision_v,
									    CASE Estado
									        WHEN
									            1
									        THEN
									            (SELECT 
									                    SUM((Precio_c*Cantidad))
									                FROM
									                    detalle_venta
									                WHERE
									                     detalle_venta.Id_pedido = encabezado_factura.Id_pedido)
									        ELSE 0
									    END AS Precio_c,
									    Fecha,
										Estado,
										Id_pedido
									FROM
									    encabezado_factura
									WHERE
									    '.$filtro.' Fecha BETWEEN "'.$fecha_inicial.'" and "'.$fecha_final.'" ');
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function get_id_factura($id){
		try{
			$q = $this->pdo->prepare('SELECT * FROM factura where Id_factura = ?');
			$q->bindParam(1,$id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
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
	public function get_id_pedido($id){
		try{
			$q = $this->pdo->prepare('SELECT * FROM pedido where Id_pedido = ?');
			$q->bindParam(1,$id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}


	public function get_pedido_cliente($id){
		try{
			$q = $this->pdo->prepare('SELECT * FROM pedido inner join cliente on pedido.Id_cliente = cliente.Id_cliente where Id_pedido = ?');
			$q->bindParam(1,$id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}

	public function get_id_encabezado_factura($id){
		try{
			$q = $this->pdo->prepare('SELECT * FROM encabezado_factura where Id_encabezado_factura = ?');
			$q->bindParam(1,$id);
			$q->execute();
			return $q->fetchAll();
			$this->pdo = null;
		}catch(PDOException $e){
			echo 'Error '.$e->getMessage();
		}
	}
	public function add_encabezado_factura($Id_factura,$N_fac,$N_ccf,$Fecha,$Fecha_vencimiento,$Descuento,$comision_mecanico,$comision_vendedor,$Abono,$Compra_total,$Condicon_operacion,$Id_usuario,$Id_pedido,$Estado){
		try {
			$q = $this->pdo->prepare('INSERT INTO encabezado_factura(Id_factura,N_fac,N_ccf,Fecha,Fecha_vencimiento,Descuento,Comision_m,Comision_v,Abono,Compra_total,Condicon_operacion,Id_usuario,Id_pedido,Estado) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

			$q->bindParam(1,$Id_factura);
			$q->bindParam(2,$N_fac);
			$q->bindParam(3,$N_ccf);
			$q->bindParam(4,$Fecha);
			$q->bindParam(5,$Fecha_vencimiento);
			$q->bindParam(6,$Descuento);
			$q->bindParam(7,$comision_mecanico);
			$q->bindParam(8,$comision_vendedor);
			$q->bindParam(9,$Abono);
			$q->bindParam(10,$Compra_total);
			$q->bindParam(11,$Condicon_operacion);
			$q->bindParam(12,$Id_usuario);
			$q->bindParam(13,$Id_pedido);
			$q->bindParam(14,$Estado);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}

	public function add_comentario_anular($Comentario,$Id_encabezado_factura,$Estado){
		try {
			$q = $this->pdo->prepare('INSERT INTO anular_factura_com(Comentario,Id_encabezado_factura,Estado) values(?,?,?)');

			$q->bindParam(1,$Comentario);
			$q->bindParam(2,$Id_encabezado_factura);
			$q->bindParam(3,$Estado);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}

	public function edit_encabezado_factura($Id_encabezado_factura,$Id_factura,$N_fac,$N_ccf,$Fecha,$Fecha_vencimiento,$Abono,$Compra_total,$Condicon_operacion,$Id_usuario,$Id_pedido,$Estado){
		try {
			$q = $this->pdo->prepare('UPDATE encabezado_factura SET Id_factura =?, N_fac =?, N_ccf =?, Fecha =?, Fecha_vencimiento =?, Abono =?, Compra_total =?, Condicon_operacion =?, Id_usuario =?, Id_pedido =?, Estado =? WHERE Id_encabezado_factura=?');

			$q->bindParam(1,$Id_factura);
			$q->bindParam(2,$N_fac);
			$q->bindParam(3,$N_ccf);
			$q->bindParam(4,$Fecha);
			$q->bindParam(5,$Fecha_vencimiento);
			$q->bindParam(6,$Abono);
			$q->bindParam(7,$Compra_total);
			$q->bindParam(8,$Condicon_operacion);
			$q->bindParam(9,$Id_usuario);
			$q->bindParam(10,$Id_pedido);
			$q->bindParam(11,$Estado);
			$q->bindParam(12,$Id_encabezado_factura);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}

	public function anular_factura($Id_encabezado_factura,$Estado){
		try {
			$q = $this->pdo->prepare('UPDATE encabezado_factura SET Estado =? WHERE Id_encabezado_factura=?');

			$q->bindParam(1,$Estado);
			$q->bindParam(2,$Id_encabezado_factura);
			$q->execute();
			$this->pdo = null;
			return 0;
		} catch (PDOException $e) {
			echo 'Error '.$e->getMessage();
		}
		return 1;
	}

	public function del_encabezado_factura($Id_encabezado_factura){
		try {
			$q = $this->pdo->prepare('DELETE FROM encabezado_factura WHERE Id_encabezado_factura=?');
			$q->bindParam(1,$Id_encabezado_factura);
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
