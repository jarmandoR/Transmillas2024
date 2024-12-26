<?php 
require("login_autentica.php"); 
include("layout.php");

if($param5!=''){ $id_sedes=$param5;  $conde2=" "; }  
 $idUserA=$_SESSION['usuario_id'];//mi id
 $iduChat=$_REQUEST["idUserm"]; //id del usiario del chat



$varVisto=$_GET["varVisto"];
$fechaactualHora =date("Y-m-d H:i:s");
$miRol=$nivel_acceso;
$misede=$_SESSION['usu_idsede'];

$respuestas=$_GET["menres"];
$respuestas1=$respuestas;

$idnrespues=$_POST["numresp"];

// if ($respuestas1!='') {
//     echo"si existe";
// }
// $responder=0;



// if ($varVisto!='') {
//     $sql3="UPDATE `noticia` SET `not_visto`='$varVisto',`not_fechaVisto`='$fechaactualHora' WHERE (`not_idDe`='$iduChat' and `not_idusuario`='$idUserA'and not_visto='no')";
//      $DB->Execute($sql3);
// }
 

?>


  

<?php 



?>


<iframe src="https://transmillas.com/chatPruebas/salaChats.php?id=<?php echo$idUserA; ?>" width="100%" height="600px" id="miIframe"></iframe>

<link href="jquery.multiselect.css" rel="stylesheet" type="text/css">
<script src="jquery.min.js"></script>
<script src="jquery.multiselect.js"></script>
<script type="text/javascript">



const miIframe = document.getElementById('miIframe');

// Función para mantener la barra de desplazamiento abajo del iframe
function mantenerScrollAbajo() {
    miIframe.contentWindow.scrollTo(0, miIframe.contentDocument.body.scrollHeight);
}

// Llama a la función para mantener la barra de desplazamiento abajo inicialmente
mantenerScrollAbajo();

// Llama a la función cuando el contenido dentro del iframe se actualiza o cambia
// Por ejemplo, después de cargar una nueva página o recibir datos a través de AJAX
// Simula una llamada a mantenerScrollAbajo() después de un cierto período de tiempo
setTimeout(mantenerScrollAbajo, 100);


</script>

