<?php
require("login_autentica.php"); 
//require_once("expdf/lib/pdf/mpdf.php");  
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

 $idser=$_REQUEST['id_param'];
 
 
/*
 header("Cache-Control: private, max-age=10800, pre-check=10800");
 header("Expires: " . date(DATE_RFC822,strtotime(" 1 day")));

  if (file_exists($imagen)){
$fp = fopen($imagen, "r");
<pre>    $etag = md5(serialize(fstat($fp)));
    fclose($fp);
    header('Etag: '.$etag);
    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && (strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= filemtime($imagen) || trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) ) {
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($imagen)).' GMT', true, 304);
        exit();
    }
    else{
        header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($imagen)).' GMT');
        readfile($imagen);
    }</pre>
}
else{
 header("Location: image-not-found.jpg");
}
 */ 
?>
<style type="text/css">
.embed-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
}
.embed-container iframe {
    position: absolute;
    top:0;
    left: 0;
    width: 50%;
    height: 70%;
}
    </style>
	
	
	
	
	
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<button   type="button" class="btn btn-danger btn-lg"  onclick="location.href='inicio1.php?bandera=1&param15=Envio Oficina'" value="Cerrar" />Cerrar</button>
<!--	<button  class="btn btn-primary btn-lg"   onclick="location.href='inicio1.php'">Imprimir</button>-->
<!--	<button  class="btn btn-primary btn-lg"   onclick="location.href='inicio1.php'">Imprimir</button>-->

<div class="embed-container">
    <iframe width="560" height="515" src="ticketfactura.php?id_param=<?php echo $idser;?>";  frameborder="0" allowfullscreen >
	</iframe>
</div>

<?php
?>
