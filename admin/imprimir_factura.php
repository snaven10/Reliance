<?php
require('../fpdf/fpdf.php');
class PDF_Javascript extends FPDF {

    var $javascript;
    var $n_js;
    
    function __construct($orientation='P',$uni='mm',$format='Letter') {
        parent::__construct($orientation,$uni,$format);
    }
    function IncludeJS($script) {
        $this->javascript=$script;
    }
    function _putjavascript() {
        $this->_newobj();
        $this->n_js=$this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R ]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS '.$this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }
    function _putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }
    function _putcatalog() {
        parent::_putcatalog();
        if (isset($this->javascript)) {
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }
}

class PDF_AutoPrint extends PDF_Javascript
{
    function __construct($orientation='P',$uni='mm',$format='Letter') {
        parent::__construct($orientation,$uni,$format);
    }
    function AutoPrint($dialog)
    {    
        $param=($dialog ? 'true' : 'false');
        $script="print(".$param.");";
        $this->IncludeJS($script);
    }
}
?>
<?php
class funciones_calculo
{
    function numtoletras($xcifra)
    {
        $xarray = array(0 => "Cero",
            1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
            "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
            "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
            100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
        );
        //
        $xcifra = trim($xcifra);
        $xlength = strlen($xcifra);
        $xpos_punto = strpos($xcifra, ".");
        $xaux_int = $xcifra;
        $xdecimales = "00";
        if (!($xpos_punto === false)) {
            if ($xpos_punto == 0) {
                $xcifra = "0" . $xcifra;
                $xpos_punto = strpos($xcifra, ".");
            }
            $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
            $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
        }

        $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
        $xcadena = "";
        for ($xz = 0; $xz < 3; $xz++) {
            $xaux = substr($XAUX, $xz * 6, 6);
            $xi = 0;
            $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
            $xexit = true; // bandera para controlar el ciclo del While
            while ($xexit) {
                if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                    break; // termina el ciclo
                }

                $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
                $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
                for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                    switch ($xy) {
                        case 1: // checa las centenas
                            if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas

                            } else {
                                $key = (int) substr($xaux, 0, 3);
                                if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                    $xseek = $xarray[$key];
                                    $xsub = self::subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                    if (substr($xaux, 0, 3) == 100)
                                        $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                    $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                                }
                                else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                    $key = (int) substr($xaux, 0, 1) * 100;
                                    $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                } // ENDIF ($xseek)
                            } // ENDIF (substr($xaux, 0, 3) < 100)
                            break;
                        case 2: // checa las decenas (con la misma lógica que las centenas)
                            if (substr($xaux, 1, 2) < 10) {

                            } else {
                                $key = (int) substr($xaux, 1, 2);
                                if (TRUE === array_key_exists($key, $xarray)) {
                                    $xseek = $xarray[$key];
                                    $xsub = self::subfijo($xaux);
                                    if (substr($xaux, 1, 2) == 20)
                                        $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                    $xy = 3;
                                }
                                else {
                                    $key = (int) substr($xaux, 1, 1) * 10;
                                    $xseek = $xarray[$key];
                                    if (20 == substr($xaux, 1, 1) * 10)
                                        $xcadena = " " . $xcadena . " " . $xseek;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                                } // ENDIF ($xseek)
                            } // ENDIF (substr($xaux, 1, 2) < 10)
                            break;
                        case 3: // checa las unidades
                            if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada

                            } else {
                                $key = (int) substr($xaux, 2, 1);
                                $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                                $xsub = self::subfijo($xaux);
                                $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                            } // ENDIF (substr($xaux, 2, 1) < 1)
                            break;
                    } // END SWITCH
                } // END FOR
                $xi = $xi + 3;
            } // ENDDO

            if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
                $xcadena.= " DE";

            if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
                $xcadena.= " DE";

            // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
            if (trim($xaux) != "") {
                switch ($xz) {
                    case 0:
                        if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                            $xcadena.= "UN BILLON ";
                        else
                            $xcadena.= " BILLONES ";
                        break;
                    case 1:
                        if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                            $xcadena.= "UN MILLON ";
                        else
                            $xcadena.= " MILLONES ";
                        break;
                    case 2:
                        if ($xcifra < 1) {
                            $xcadena = " CERO CON $xdecimales/100. USD DOLARES";
                        }
                        if ($xcifra >= 1 && $xcifra < 2) {
                            $xcadena = " UNO CON $xdecimales/100. USD DOLARES";
                        }
                        if ($xcifra >= 2) {
                            $xcadena.= " CON $xdecimales/100. USD DOLARES"; //
                        }
                        break;
                } // endswitch ($xz)
            } // ENDIF (trim($xaux) != "")
            // ------------------      en este caso, para México se usa esta leyenda     ----------------
            $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
            $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
            $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
            $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
            $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
            $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
            $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
        } // ENDFOR ($xz)
        return trim($xcadena);
    }

    // END FUNCTION

    function subfijo($xx)
    { // esta función regresa un subfijo para la cifra
        $xx = trim($xx);
        $xstrlen = strlen($xx);
        if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
            $xsub = "";
        //
        if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
            $xsub = "MIL";
        //
        return $xsub;
    }

    // END FUNCTION
    function res_iva($value,$tipo)
    {
        if ($tipo==0) {
            return $value;
        }elseif ($tipo==1) {
            return ($value / 1.13);
        }
    }
    function iva($value,$tipo)
    {
        if ($tipo==0) {
            return 0;
        }elseif ($tipo==1) {
            return ($value * 0.13);
        }
    }
}
class PDF extends PDF_AutoPrint
{
    function cabeceraVertical_cf($cabecera)
    {
        $this->SetMargins(2,2,1.3);
        // // Set font
        $this->SetFont('Arial','I',9);
        // Numero de factura 
        $this->SetXY(13.5, 1.2);
        $this->Cell(2,2,$cabecera['Datos_fac'],0,1,'l');

        // vendido a
        $this->SetXY(3.5, 2.45);
        $this->Cell(2,2,$cabecera['Nombre'],0,1,'l');
        // Direccion
        $this->SetXY(3.5, 2.75);
        $this->Cell(2,2,$cabecera['Direccion'],0,1,'l');
        // // Municipio
        // $this->SetXY(0.6, 0.6);
        // $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');
        // // Departamento
        // $this->SetXY(0.6, 0.6);
        // $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');

        // /*Segunda mitad de encabesado*/
        // Fecha
        $this->SetXY(14.6, 2.4);
        $this->Cell(2,2,$cabecera['Fecha'],0,1,'l');
        // Nrc
        $this->SetXY(14.2, 2.7);
        $this->Cell(2,2,$cabecera['Nrc'],0,1,'l');
        //cod vendedor
        $this->SetXY(18, 4.5);
        $this->Cell(2,2,$cabecera['Cod_vendedor'],0,1,'l');
        // Nit
        // $this->SetXY(12.6, 1.7);
        // $this->Cell(2,2,$cabecera['Nit'],0,1,'l');


        //     // Giro
        //     $this->SetXY(0.6, 0.6);
        //     $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');
        //     // Nota de permiso anterior
        //     $this->SetXY(0.6, 0.6);
        //     $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');
        //     // Fecha de nota
        //     $this->SetXY(0.6, 0.6);
        //     $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');
        //     // Venta a cuenta de 
        //     $this->SetXY(0.6, 0.6);
        //     $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');
        // dinero en letras
        $this->SetXY(2.6, 9.8);
        $this->Cell(2,2,$cabecera['Num_letras'],0,1,'l'); 
    }
    function cuerpo_cf($datos,$contenido_final)
    {
        $this->SetMargins(2,2,1.3);
        $this->SetFont('Arial','I',9);
        $widthColumn = array('1','2','8.4','4.8','2.2');
        $contador = 4.1;
        foreach ($datos as $row) {
            $this->SetXY(1.8, $contador);
            $this->Cell($widthColumn[0],5,$row['Cantidad'],0,0,'L');      
            $this->Cell($widthColumn[1],5,$row['Cod'],0,0,'L');      
            $this->Cell($widthColumn[2],5,$row['Nombre'],0,0,'L');      
            $this->Cell($widthColumn[3],5,$row['precio'],0,0,'L');      
            $this->Cell($widthColumn[4],5,$row['venta'],0,0,'L'); 
            $this->Ln();   
            $contador += 0.4;  
        }
        $this->SetXY(1.5, 8.2);
        $this->Cell($widthColumn[0],5,'',0,0,'L');      
        $this->Cell($widthColumn[1],5,'',0,0,'L');      
        $this->Cell($widthColumn[2],5,'',0,0,'L');      
        $this->Cell($widthColumn[3],5,'',0,0,'L');
        $this->Cell($widthColumn[4],5,$contenido_final['Sumas'],0,0,'L'); 

        $this->SetXY(1.5, 8.6);
        $this->Cell($widthColumn[0],5,'',0,0,'L');      
        $this->Cell($widthColumn[1],5,'',0,0,'L');      
        $this->Cell($widthColumn[2],5,'',0,0,'L');      
        $this->Cell($widthColumn[3],5,'',0,0,'L');
        $this->Cell($widthColumn[4],5,$contenido_final['Iva'],0,0,'L'); 

        $this->SetXY(1.5, 10.2);
        $this->Cell($widthColumn[0],5,'',0,0,'L');      
        $this->Cell($widthColumn[1],5,'',0,0,'L');      
        $this->Cell($widthColumn[2],5,'',0,0,'L');      
        $this->Cell($widthColumn[3],5,'',0,0,'L');
        $this->Cell($widthColumn[4],5,$contenido_final['Venta_total'],0,0,'L'); 

    }

    function cabeceraVertical_ccf($cabecera)
    {
        $this->SetMargins(2,2,1.3);
        // // Set font
        $this->SetFont('Arial','I',9);
        // Numero de factura 
        $this->SetXY(13, 1.2);
        $this->Cell(2,2,$cabecera['Datos_fac'],0,1,'l');

        // vendido a
        $this->SetXY(2.8, 2.3);
        $this->Cell(2,2,$cabecera['Nombre'],0,1,'l');
        // Direccion
        $this->SetXY(2.8, 2.6);
        $this->Cell(2,2,$cabecera['Direccion'],0,1,'l');
        // // Municipio
        // $this->SetXY(0.6, 0.6);
        // $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');
        // // Departamento
        // $this->SetXY(0.6, 0.6);
        // $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');

        // Nrc
        $this->SetXY(2.2, 3.7);
        $this->Cell(2,2,$cabecera['Nrc'],0,1,'l');
        // /*Segunda mitad de encabesado*/
        // Fecha
        $this->SetXY(13, 2.3);
        $this->Cell(2,2,$cabecera['Fecha'],0,1,'l');
        // Nit
        $this->SetXY(13, 2.6);
        $this->Cell(2,2,$cabecera['Nit'],0,1,'l');

        //cod vendedor
        $this->SetXY(17.5, 4.5);
        $this->Cell(2,2,$cabecera['Cod_vendedor'],0,1,'l');
        //     // Giro
        //     $this->SetXY(0.6, 0.6);
        //     $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');
        //     // Nota de permiso anterior
        //     $this->SetXY(0.6, 0.6);
        //     $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');
        //     // Fecha de nota
        //     $this->SetXY(0.6, 0.6);
        //     $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');
        //     // Venta a cuenta de 
        //     $this->SetXY(0.6, 0.6);
        //     $this->Cell(2,2,$cabecera['Nombre'].$this->GetX(),0,1,'C');
        // dinero en letras
        $this->SetXY(2.2, 9.6);
        $this->Cell(2,2,$cabecera['Num_letras'],0,1,'l'); 
    }
    function cuerpo_ccf($datos,$contenido_final)
    {
        $this->SetMargins(2,2,1.3);
        $this->SetFont('Arial','I',9);
        $widthColumn = array('1','2','8.5','4.8','2.2');
        $contador = 4.1;
        foreach ($datos as $row) {
            $this->SetXY(1.2, $contador);
            $this->Cell($widthColumn[0],5,$row['Cantidad'],0,0,'L');      
            $this->Cell($widthColumn[1],5,$row['Cod'],0,0,'L');      
            $this->Cell($widthColumn[2],5,$row['Nombre'],0,0,'L');      
            $this->Cell($widthColumn[3],5,$row['precio'],0,0,'L');      
            $this->Cell($widthColumn[4],5,$row['venta'],0,0,'L'); 
            $this->Ln();   
            $contador += 0.4;  
        }
        $this->SetXY(1.2, 8.2);
        $this->Cell($widthColumn[0],5,'',0,0,'L');      
        $this->Cell($widthColumn[1],5,'',0,0,'L');      
        $this->Cell($widthColumn[2],5,'',0,0,'L');      
        $this->Cell($widthColumn[3],5,'',0,0,'L');
        $this->Cell($widthColumn[4],5,$contenido_final['Sumas'],0,0,'L'); 

        $this->SetXY(1.2, 8.6);
        $this->Cell($widthColumn[0],5,'',0,0,'L');      
        $this->Cell($widthColumn[1],5,'',0,0,'L');      
        $this->Cell($widthColumn[2],5,'',0,0,'L');      
        $this->Cell($widthColumn[3],5,'',0,0,'L');
        $this->Cell($widthColumn[4],5,$contenido_final['Iva'],0,0,'L'); 

        $this->SetXY(1.2, 10.2);
        $this->Cell($widthColumn[0],5,'',0,0,'L');      
        $this->Cell($widthColumn[1],5,'',0,0,'L');      
        $this->Cell($widthColumn[2],5,'',0,0,'L');      
        $this->Cell($widthColumn[3],5,'',0,0,'L');
        $this->Cell($widthColumn[4],5,$contenido_final['Venta_total'],0,0,'L'); 

    }
} // FIN Class PDF
$pdf = new PDF('P','cm',array(21.6,27.9));
$calculo = new funciones_calculo();
$pdf->AddPage();

include '../clases/clase_encabezado_factura.php';
$encabezado_factura = new encabezado_factura();
$encabezado_fact = $encabezado_factura->buscar_encabezado_factura($_GET['ped']);
$factura_se = $encabezado_factura->get_id_factura($encabezado_fact[0]['Id_factura']);
include '../clases/clase_pedido.php';
$pedido = new pedido();
$pedi = $pedido->get_id_pedido($_GET['ped']);
$vendedor_datos = $pedido->get_id_vendedor($pedi[0]['Id_vendedor']); 
$vendedor = $vendedor_datos[0]['Cod_vendedor']; 
$cliente = $pedido->get_id_cliente($pedi[0]['Id_cliente']);
$cliente_detall = $pedido->get_id_detalle_cliente($pedi[0]['Id_cliente']);
include '../clases/clase_detalle_venta.php';
$detalle_venta = new detalle_venta();
$detalle_ven = $detalle_venta->buscar_id_pedido($_GET['ped']);

// primer if ccf
$valida = 0;
if ($factura_se[0][4]==1) {
    $datos_fac = $factura_se[0][1].' '.$encabezado_fact[0][3];
    $valida = 1;
// primer elseif cf
}elseif ($factura_se[0][4]==0) {
    $datos_fac =  $factura_se[0][1].' '.$encabezado_fact[0][2];
} 
$nombre = $cliente[0][2]; /*<!-- Nombre de cliente -->*/
if ($valida) {
    $direccion = $cliente_detall[0]['Direccion']; /*<!-- Direccion de cliente -->*/
    $nrc = $cliente_detall[0]['Nrc']; /*<!-- Nrc de cliente -->*/
    $nit = $cliente_detall[0]['Nit']; /*<!-- Nrc de cliente -->*/
    $cod_vendedor = (isset($vendedor)) ? $vendedor : '';; /*<!-- Cod vendedor -->*/
}else{
    $direccion = (isset($cliente_detall[0]['Direccion'])) ? $cliente_detall[0]['Direccion'] : ''; /*<!-- Direccion de cliente -->*/
    $nrc = (isset($cliente_detall[0]['Nrc'])) ? $cliente_detall[0]['Nrc'] : ''; /*<!-- Nrc de cliente -->*/
    $nit = (isset($cliente_detall[0]['Nit'])) ? $cliente_detall[0]['Nit'] : ''; /*<!-- Nrc de cliente -->*/
    $cod_vendedor = (isset($vendedor)) ? $vendedor : '';; /*<!-- Cod vendedor -->*/
}
$fecha = $encabezado_fact[0]['Fecha']; /*<!-- Nombre de cliente -->*/
$fecha = new DateTime($fecha);
$fecha = $fecha->format('d-m-Y');

// datos Productos
$i = 0;
$total = 0;
$ivas = 0;
$t_v = 0;
foreach ($detalle_ven as $row){
    $producto1 = $detalle_venta->get_id_producto($row['Id_producto']); 
    $producto[$i]['Cantidad'] = $row['Cantidad'];
    $producto[$i]['Cod'] = $producto1[0][1];
    $producto[$i]['Nombre'] = $producto1[0][3];
    $producto[$i]['precio'] = number_format($calculo->res_iva(($row['Precio_v']-($row['Precio_v']*$encabezado_fact[0][6])),$factura_se[0][4]),2,'.',',');
    $total += ($calculo->res_iva((($row['Precio_v']-($row['Precio_v']*$encabezado_fact[0][6]))*$row['Cantidad']),$factura_se[0][4]));
    $t_v = $calculo->res_iva((($row['Precio_v']-($row['Precio_v']*$encabezado_fact[0][6]))*$row['Cantidad']),$factura_se[0][4]);
    $ivas += $calculo->iva($t_v,$factura_se[0][4]);
    $producto[$i]['venta'] = number_format($calculo->res_iva((($row['Precio_v']-($row['Precio_v']*$encabezado_fact[0][6]))*$row['Cantidad']),$factura_se[0][4]),2,'.',',');
    $i++;
} 
$num_toletras = $calculo->numtoletras($total+$ivas);

//Títulos que llevará la cabecera
$Encabesado = array(
    'Datos_fac'=> $datos_fac, 
    'Nombre'=> $nombre, 
    'Cod_vendedor'=> $cod_vendedor, 
    'Direccion'=> $direccion, 
    'Nrc'=> $nrc,
    'Fecha'=> $fecha, 
    'Nit'=> $nit,
    'Num_letras'=> $num_toletras
);
$contenido_final = array(
    "Sumas"=>number_format($total,2,'.',','),
    "Iva"=>number_format($ivas,2,'.',','),
    "Venta_total"=>number_format(($total+$ivas),2,'.',',')
    );
//Métodos llamados con el objeto $pdf
if ($valida) {
    $pdf->cabeceraVertical_ccf($Encabesado);
    $pdf->cuerpo_ccf($producto,$contenido_final);
}else{
    $pdf->cabeceraVertical_cf($Encabesado);
    $pdf->cuerpo_cf($producto,$contenido_final);
}
// $pdf->body($datos);
// $pdf->cabeceraHorizontal($miCabecera);
// echo  $pdf->GetPageHeight();
// $imprimir = new 
$pdf->AutoPrint(true);
$pdf->Output();
echo "<script>setTimeout(window.close,500);</script>"; 
?>
