<?php
// include class



// $nombrecon=$_GET["nombrecon"];
// $cedulacon=$_GET["cedulacon"];
// $placasvehi=$_GET["placasvehi"];
// $valorcont=$_GET["valorcont"];
// $fechaini=$_GET["fechaini"];
// $fechafin=$_GET["fechafin"];
// $piezascont=$_GET["piezascont"];
// $telefonocon=$_GET["telefonocon"];
// $firmacon=$_GET["firmacon"];
// $expedida=$_GET["expedida"];
// $ciudaddes=$_GET["ciudaddes"];
// $ciudadori=$_GET["ciudadori"];
// $num_mani=$_GET["num_mani"];
// $num_remesa=$_GET["num_remesa"];

// $cot_id=$_GET["id"];
// $cot_clirente=$_GET["clirente"];	
// $cot_nit=$_GET["nit"];	
// $cot_origen=$_GET["origen"];	
// $cot_destino=$_GET["destino"];	
// $cot_direc_origen=$_GET["direc_origen"];	
// $cot_direc_destino=$_GET["direc_destino"];	
// $cot_desc_merc=$_GET["desc_merc"];	
// $cot_tipo_servi=$_GET["tipo_servi"];	
// $cot_peso=$_GET["peso"];	
// $cot_val_minima=$_GET["val_minima"];	
// $cot_kilo_adi=$_GET["kilo_adi"];	
// $cot_vol=$_GET["vol"];	
// $cot_val_asegurado=$_GET["val_asegurado"];	
// $cot_val_seguro=$_GET["val_seguro"];	
// $cot_val_kilos_adi=$_GET["val_kilos_adi"];	
// $cot_val_servicio=$_GET["val_servicio"];	
// $cot_val_total=$_GET["val_total"];	
// $cot_fecha=$_GET["fecha"];
// $ciudadhecho=$_GET["ciudadhecho"];
// $usuhecho=$_GET["usuhecho"];



$nombredoc="Cotizacion".$cot_id;

// Convertir la fecha en un timestamp
$timestamp1 = strtotime($fechaini);

// Obtener el día de la fecha
$dia1 = date('d', $timestamp1);
$mes1 = date('m', $timestamp1);
$ano1 = date('Y', $timestamp1);
// Convertir la fecha en un timestamp
$timestamp2 = strtotime($fechafin);

// Obtener el día de la fecha
$dia2 = date('d', $timestamp2);
$mes2 = date('m', $timestamp2);
$ano2 = date('Y', $timestamp2);


require("login_autentica.php");
require('fpdf/fpdf.php');

$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$id_sedes=$_SESSION['usu_idsede'];

$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    // $this->Image('assets/cabecerapagina.jpg',10,8,0);
    // Times bold 15
    $this->SetFont('Times','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    // $this->Cell(30,10,'Title',1,0,'C');
    // Salto de línea
    $this->Ln(20);

   
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Times italic 8
    $this->SetFont('Times','I',8);

}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
// Establecer posición absoluta para la imagen
$pdf->Image('img/hoja_Nueva.png', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());

// Establecer posición relativa para el texto
$pdf->SetXY(10, 10); // Ajusta la posición según tus necesidades
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
$pdf->SetLeftMargin(25);
$pdf->SetRightMargin(25);
$pdf->Ln(15);
$pdf->SetFont('Times', 'B', 12);














$conde="";
$conde="pre_idciudadori";
$precioinicialkilos=$_SESSION['precioinicial'];


if(isset($_REQUEST["param1"]) && isset($_REQUEST["param2"])){ if($param1!="" and $param2!=""){  $conde="pre_idciudadori"; $conde1="and (pre_idciudadori='$param1' and pre_idciudaddes='$param2') or  (pre_idciudaddes='$param1' and pre_idciudadori='$param2')"; }else {

    if(isset($_REQUEST["param1"])){ if($param1!=""){  $conde="pre_idciudadori"; $conde1="and pre_idciudadori='$param1' "; } } else {$param1=""; $conde1=""; }
    if(isset($_REQUEST["param2"])){  if($param2!=""){ $conde="pre_idciudaddes"; $conde1.="and pre_idciudaddes='$param2' "; } } else {$param2="";  $conde1="";}
    } } 


// $FB->titulo_azul1("Configuraci&oacute;n de Precios",9,0,7);  
// $FB->abre_form("form1","","post");

// $FB->llena_texto("Ciudad 1:",1,2,$DB,"SELECT `idciudades`, `ciu_nombre` FROM `ciudades`  where inner_estados=1","cambio1(this.value, param2.value, \"precios.php\", 1);",$param1,1,0);
// $FB->llena_texto("Ciudad 2:",2,2,$DB,"SELECT `idciudades`, `ciu_nombre` FROM ciudades","cambio1(param1.value, this.value, \"precios.php\", 1);",$param2,4,0);
// echo "<tr><td colspan='4'>
// <div  class='container'>
// <button type='button' class='icon-button file-button' onclick=\"window.location.href='precios.php?param1=$param1&param2=$param2&descargar=1'\"><i class='fas fa-file'></i>Excel</button>
// </div></td></tr></table>";
// echo "<tr><td colspan='4'>
// <div  class='container'>
// <button type='button' class='icon-button file-button' onclick='openInNewTab()'><i class='fas fa-file'></i>Excel</button>
// </div></td></tr></table>";

// $FB->cierra_form(); 

// if($rcrear==1) { $FB->nuevo("Precios", $condecion, ""); } 

$FB->titulo_azul1("Ciudad Origen",1,0,5); 
$FB->titulo_azul1("Ciudad Destino",1,0,0); 
$FB->titulo_azul1("Primeros $precioinicialkilos Kg ",1,0,0); 

$sql = "SELECT `idprecioskilos`, `pre_inicial`, `prec_final` FROM `precioskilos` order by pre_inicial asc";
$DB1->Execute($sql);
$menus=array();
while ($rw2 = mysqli_fetch_row($DB1->Consulta_ID)) {

    $FB->titulo_azul1("Precio Kg $rw2[1] a $rw2[2]",1,0,0); 
    array_push($menus,$rw2[0]);
}


$FB->titulo_azul1("Tipo Servicio",1,0,0); 
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);

$sql="SELECT `idprecios`, `pre_idciudadori`, `pre_idciudaddes`, `pre_kilo`, `pre_adicional`,`pre_tiposervicio` FROM `precios`  where idprecios>0  $conde1 ORDER BY $conde, $ord $asc";
$DB1->Execute($sql); $va=0;
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
    $preciosconfi=array();
    $id_p=$rw1[0];
    $va++; $p=$va%2;
    if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
    
    $sql1="SELECT  `ciu_nombre`,idciudades FROM `ciudades` WHERE idciudades in ($rw1[1],$rw1[2]) ";
    $DB->Execute($sql1); 
    while($rw=mysqli_fetch_row($DB->Consulta_ID))
    {
        
        if($rw[1]==$rw1[1]){
            $valor[1]=$rw[0];
        }else {
            $valor[2]=$rw[0];
        }
    }
    if($rw1[1]==$rw1[2]){ $valor[2]=$valor[1];  }
    echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
        echo "<td>".$valor[1]."</td>
             <td>".$valor[2]."</td>";
             echo "<td>".$rw1[3]."</td>";

             $sql2 = "SELECT  `con_precios`,con_idprecios FROM `configuracionkilos` WHERE con_idprecioskilos='$id_p' and con_tipo='normal' order by idconfiguracionkilos asc";
            $DB->Execute($sql2);
            while($rw3=mysqli_fetch_row($DB->Consulta_ID))
            {
                $preciosconfi[$rw3[1]]=$rw3[0];
                
            }
            
            foreach ($menus as $value) {

                 $datosp =$preciosconfi[$value];
                if($datosp !=''){
                    echo "<td>".$datosp."</td>";
                }
                else{
                    echo "<td>0</td>";
                }
                

            }


        

        

        if($rw1[5]!=0 and $rw1[5]!=NULL){
            $sql33="Select `idtiposervicio`, `tip_nom` from tiposervicio WHERE `idtiposervicio`='$rw1[5]'"; 
            $DB->Execute($sql33);
            $rw7=mysqli_fetch_row($DB->Consulta_ID); 
            echo "<td>$rw7[1]</td>";
        }else {
            echo "<td>Carga via terrestre</td>";
        }

    $DB->edites($id_p, "Precios", 1, $condecion);
    echo "</tr>";
}



























// Definir la matriz de datos
 $matriz = array(
   array("Tipo de servicio", "holi"),
//     array("Peso en kilos", $cot_peso),
//     array("Ciudad Origen", $cot_origen),
//     array("Ciudad Destino", $cot_destino),
//     array("Valor Carga Minima", $cot_val_minima),
//     array("Valor Kilo adicional", $cot_kilo_adi),
//     array("Volumen", $cot_vol),
//     array("Valor Asegurado", $cot_val_asegurado),
//     array("Valor seguro", $cot_val_seguro),
//     array("Valor kilos adicionales", $cot_val_kilos_adi),
//     array("Valor servicio", $cot_val_servicio),
//     array("Valor Total (servicio + seguro)", $cot_val_total)
//     // Continúa con los datos de tu matriz...
);
// Establecer el tamaño de la celda y la separación entre las celdas
$cellWidth = 80; // Ancho de cada celda
$cellHeight = 5; // Alto de cada celda
$margin = 25; // Margen izquierdo
$margind = 25; // Margen izquierdo

// Bucle para crear las 12 filas
// Bucle para crear las filas
foreach ($matriz as $fila) {
    // Establecer la posición para la fila actual
    $x = $margin;
    $y = $pdf->GetY();
    
    // Bucle para crear las celdas de la fila actual
    foreach ($fila as $valor) {
        // Agregar celda con el valor actual de la matriz
        $pdf->SetXY($x, $y);
        $pdf->Cell($cellWidth, $cellHeight, $valor, 1); // Agregar borde
        
        // Mover a la siguiente columna
        $x += $cellWidth;
    }
    
    // Mover a la siguiente fila
    $pdf->Ln();
}










$pdf->Ln(5);

$pdf->MultiCell(0, 5, utf8_decode('Es importante que, al momento de solicitar el servicio de transporte de carga, le indique al funcionario de Transmillas que su servicio será liquidado bajo el siguiente número de cotización: '), 0,'J');
$pdf->Ln(5);

$pdf->MultiCell(0, 5, utf8_decode('El transporte de carga se realizará vía terrestre con un tiempo de entrega de 24 horas. Con el objetivo de brindar una mejor calidad de servicio, el cliente puede hacer el rastreo ingresando el número de remesa asignado a través de la página: https://www.transmillas.com/#Rastreo'), 0,'J');
$pdf->Ln(5);

$pdf->MultiCell(0, 5, utf8_decode('Esta cotización es válida para las características anteriormente descritas. En caso de que el peso a transportar sea diferente, se realizará la corrección necesaria al precio final negociado.'), 0,'J');
$pdf->Ln(5);



// $pdf->Ln(6);
// $pdf->MultiCell(0, 5, utf8_decode('Atentamente,   							                        '), 0,'J');
// $pdf->Ln(5);
// $pdf->MultiCell(0, 5, utf8_decode(''.$usuhecho.'   							                        '), 0,'J');
// $pdf->MultiCell(0, 5, utf8_decode('Asesor Comercial				                                            '), 0,'J');
// $pdf->MultiCell(0, 5, utf8_decode('Transmillas Logística y Transportadora S.A.S 						    '), 0,'J');
// $pdf->MultiCell(0, 5, utf8_decode('Nit: 901089478-8						                                    '), 0,'J');
// $pdf->MultiCell(0, 5, utf8_decode('Telefono: 3103122 ext (110) / 3166910614                              '), 0,'J');
// $pdf->MultiCell(0, 5, utf8_decode('https://www.transmillas.com/                             '), 0,'J');






$pdf->Ln(10);


$pdf->Output();
// $filename = 'Precios/'.$nombredoc.'.pdf'; // Ruta donde deseas guardar el PDF en el servidor
$pdf->Output($filename, 'F');
?>