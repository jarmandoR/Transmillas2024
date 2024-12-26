<?php 
require_once("expdf/lib/pdf/mpdf.php");  


require("login_autentica.php");
include("cabezote3.php"); 
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$asc="ASC";
$conde1=""; 
$conde3=""; 
$opcion=$_REQUEST["preguia"];

if($param4!=''){  $fechainicio=$param4;}
if($param5!=''){  $fechaactual=$param5;}

/* if($param2!="" and $param1!=""){ 
 $conde1="and $param1 like '%$param2%' "; 
  }else { $conde1="  "; }  */

if($param1==""){ $param1="ser_prioridad"; } 
//if($param3!=''){ $conde3 =" and (cli_nombre like '%$param3%' or ser_destinatario like '%$param3%')";  }
if($param3!=''){ $conde3 =" and (rel_nom_credito like '%$param3%')";  }

if($param6=='Sin Facturar'){
    $conde4=' and ser_numerofactura is null';
}elseif($param6=='Facturados'){
    $conde4=' and ser_numerofactura>=1';
}else{
    $conde4=''; 
}


// $sql2="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_valorprestamo,ser_valor,rel_nom_credito,ser_numerofactura,ser_valorseguro
 //FROM serviciosdia s inner join rel_sercre rs on rs.idservicio=idservicios where date(ser_fecharegistro)>='$fechainicio' and  date(ser_fecharegistro)<='$fechaactual' and ser_clasificacion=2 and ser_estado!=100  $conde1 $conde2 $conde3  $conde4 ORDER BY $param1 $asc ";

 $sql="SELECT `idservicios`,`ser_fechaentrega`,`cli_nombre`, `cli_telefono`,`cli_direccion`, `ser_destinatario`, `ser_telefonocontacto`,`ser_direccioncontacto`,`ciu_nombre`,`ser_prioridad`,ser_fecharegistro,ser_consecutivo,ser_guiare,cli_idciudad,ser_valorprestamo,ser_valor,rel_nom_credito,ser_numerofactura,ser_valorseguro
 FROM  servicios s inner join rel_sercli  on idservicios=ser_idservicio 
inner join clientesservicios on idclientesdir=ser_idclientes inner join ciudades on idciudades=cli_idciudad   inner join rel_sercre rs on rs.idservicio=idservicios where date(ser_fecharegistro)>='$fechainicio' and  date(ser_fecharegistro)<='$fechaactual' and ser_clasificacion=2  and ser_estado>=3 and ser_estado!=100  $conde1 $conde2 $conde3  $conde4 ORDER BY idrelsercre $asc ";

$idguias='';
$html1= "";
$totalcontado=0;
$guiafacturadas=0;
$DB->Execute($sql); $va=0; 

    while($rw1=mysqli_fetch_row($DB->Consulta_ID))
    {
        $id_p=$rw1[0];
        $va++; $p=$va%2;
        
        
        
       
       

        $sqlrecogida="SELECT ima_ruta,ima_tipo,idimagenguias from imagenguias where ima_tipo='Entrega' and  ima_idservicio=$id_p ";
        $DB1->Execute($sqlrecogida); 
        $guiasi=mysqli_fetch_row($DB1->Consulta_ID);
        $entrgasg=$guiasi[0];


        if (!empty($entrgasg) && file_exists($entrgasg)) {
            // Ruta de la imagen
            $ruta_imagen = $entrgasg;
            // Obtener las dimensiones de la imagen
            $dimensiones = getimagesize($ruta_imagen);
            $ancho = $dimensiones[0];
            $alto = $dimensiones[1];

            // Comprobar si el ancho es mayor que el alto
            if ($ancho > $alto) {
                // Girar la imagen 90 grados en sentido antihorario
                $imagen_original = imagecreatefromjpeg($ruta_imagen);
                $imagen_rotada = imagerotate($imagen_original, 270, 0);

                // Sobrescribir la imagen original con la imagen rotada
                imagejpeg($imagen_rotada, $ruta_imagen);

                // Liberar la memoria
                imagedestroy($imagen_original);
                imagedestroy($imagen_rotada);

                // echo "La imagen ha sido rotada exitosamente.";
            } else {
                // echo "La imagen no necesita ser rotada.";
            }
        }

        
        $html1.= "<tr><td align='center' >
        
        <center><img src='$entrgasg' border='1' alt='Guia sin imagen' width='500' height='800'/><center></td>></tr>

        <td align='center' ><a  onclick='pop_dis5($id_p,\"Recogidas\")';  style='cursor: pointer;' title='Recogidas' ><img src='img/recogidas.png' ></a></td>

        </tr>"; 
    }
    $html1.= "<tr><td align='center' > Total Datos:".$va."</td>"; 
    
    $html1.= "</tr>"; 
   

$mpdf=new mPDF('c','A4');
    $css= file_get_contents('expdf/reportes/css/style.css');
    $mpdf->writeHTML($css,1);
    $mpdf->writeHTML($html1);
    //$mpdf->Output('reporte.pdf','I');  
    $mpdf->Output('imagenes.pdf','D');   

?>