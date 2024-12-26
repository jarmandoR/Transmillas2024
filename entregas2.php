<?php 
require("login_autentica.php"); 
include("layout.php");
//require("imprimir.php"); 
?>
<head>
<!-- 	<script language="JavaScript" type="text/javascript" src="js/jquery-1.4.4.min"></script> 
 --> <!--    <script src="js/jquery.printPage.js" type="text/javascript"></script> -->
  <script>  
/*   var version2 = jQuery.noConflict(); 
   version2(document).ready(function() {
    version2(".btnPrint").printPage();
  });   */ 
  </script>

</head>
<body onload="<?php 
echo "llena_datos(0,$nivel_acceso, '', 'ASC');";
 switch ($tabla)
{
	case "Factura":
	echo "pop_dis4($id_param,'Factura');";
	break;
	
	default:
	break;
} 
?>

">
<script>


timer2 =0;
function llena_datos(ex, nivel, ordby, asc)
{
	p1=document.getElementById('param31').value;
	//if(document.getElementById('param2')){ p2=document.getElementById('param2').value; } else { p2=0;} 
	
	p2=document.getElementById('param32').value;
	p4=document.getElementById('param34').value;

	
	
	if(nivel==1){
	p5=document.getElementById('param35').value;
	}else{ 
	p5=0; 
	p2=0; 
	}
	var pagina=0; 
	if(ordby=="undefined"){ ordby=""; }
	if(asc=="undefined" || asc=="" ){ asc="ASC"; }
	if(ex==1){
		destino="detalle_entregasx.php?p1="+p1+"&p2="+p2+"&p5="+p5;
		location.href=destino;
	}
	else {
		destino="detalle_entregas2.php?param31="+p1+"&param32="+p2+"&param34="+p4+"&param35="+p5+"&pagina="+pagina+"&ordby="+ordby+"&asc="+asc;
		MostrarConsulta4(destino, "destino_vesr")
	}
	clearTimeout(timer2);
	timer2=setTimeout(function(){llena_datos(0,nivel,'','ASC')},600000); // 3000ms = 3s
}

</script>
<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","","post");
$FB->titulo_azul1("Entregar Paquete",9,0,5);  

$conde3="";	

$conde="and ser_fechaguia like '$fechaactual%'"; 
if($param4!=''){ $conde="and ser_fechaguia like '$param34%'";  $fechaactual=$param34;  }
$FB->llena_texto("Fecha de Busqueda:", 34, 10, $DB, "", "", "$fechaactual", 1, 0);
if($param35!=''){ $id_sedes=$param35; $conde2="and inner_sedes=$id_sedes"; }  else { $conde2=""; }
if($nivel_acceso==1){
	
$FB->llena_texto("Sede de Entrega:",35,2,$DB,"(SELECT `idsedes`,`sed_nombre` FROM sedes where idsedes>0 )", "", "$id_sedes", 4, 0);

}else if($nivel_acceso==3) {
	
$conde3="and ser_idusuarioguia='$id_usuario'";	
	
}


$FB->llena_texto("Busqueda por:",31,82,$DB,$busqueda,"",$param31,1,0);
$FB->llena_texto("Dato:", 32, 1, $DB, "", "","$param32", 4,0);
$FB->llena_texto("", 37, 277, $DB, "", "", "llena_datos(0, $nivel_acceso, \"id_nombre\", \"ASC\");",4,0);
$FB->div_valores("destino_vesr",6); 


include("footer.php");
?>