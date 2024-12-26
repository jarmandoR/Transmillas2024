 <?php 
require("login_autentica.php");
include("layout.php"); 
if(isset($_REQUEST["idmen1"])){ $idmen1=$_REQUEST["idmen1"]; } else { $idmen1=1; } 
$id_menu=$_REQUEST["idmen"];

$FB->volver1("", $DB->recogedato(0), 4, "", "");

	
	
		echo "</tr><tr>"; 
		echo "<td align='center' width='25%'><a href='https://05ae-186-29-153-247.ngrok-free.app/SistemaTransmillas' target='_blank' tittle='historico'>";
		echo"<img src='images/historico.png' width='120'>";
		echo "</a><br>Servidor Casa</td>"; 
		echo "</tr>"; 
		// echo "<td align='center' width='25%'><a href='http://186.31.66.42:8080/transmillas/' target='_blank' tittle='produccion'>";
		
		// echo"<img src='images/enproduccion.jpg' width='120'>";
		// echo "</a><br>Produccio</td>"; 
	


$FB->cierra_tabla();
include("footer.php"); 
?>