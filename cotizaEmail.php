<?php
require("login_autentica.php"); 
$id_ciudad= $_SESSION['usu_idsede'];
$id_usuario= $_SESSION['usuario_id'];
@$tipoguia=$_REQUEST["tipoguia"];
@$registros=$_REQUEST["registros"];
$id_nombre=$_SESSION['usuario_nombre'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();


$numFac=$_POST["numFac"];

$cliente = $_POST["cliente"];
$email = $_POST["email"];
// Dirección de correo electrónico del destinatario
$destinatario = $_POST["email"];

// Asunto del correo
$asunto = 'Cotizacion de servicio';

// Mensaje del correo
$mensaje = 'Hola '.$cliente.', adjuntamos el PDF de tu cotizacion en este correo.';

// Ruta del archivo PDF en el servidor
$ruta_pdf = 'cotizaciones/Cotizacion'.$numFac.'.pdf';


// Nombre del archivo adjunto (puede ser diferente al nombre del archivo en el servidor)
$nombre_adjunto = 'cotizacion_No_'.$numFac.'.pdf';
if (file_exists($ruta_pdf)) {
$mensaje_html = '
<html>
<head>
  <title>Cotizacion transmillas</title>
  <style>
  body {
    background-color: #f2f2f2; /* Gris claro */
  }
  .content {
    text-align: center;
    padding: 20px;
  }
  img {
    width: 200px;
    height: auto;
  }
</style>
</head>
<body>
  <div style="text-align: center;">
    <img src="sistema/images/Logo Google Nuevo.png" alt="Transmillas" style="width: 200px; height: auto;">
    <p>Hola '.$cliente.', adjuntamos tu cotizacion solicitada en formato PDF.</p>
  </div>
</body>
</html>
';




// Cabecera para el correo
$headers = "From:Transmillas s.a.s <Ventastransmillas@gmail.com>\r\n";
$headers .= "Reply-To: Ventastransmillas@gmail.com\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-".md5(time())."\"\r\n";

// Contenido del mensaje
$body = "--PHP-mixed-".md5(time())."\r\n";
$body .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-".md5(time())."\"\r\n\r\n";

// Texto del mensaje
$body .= "--PHP-alt-".md5(time())."\r\n";
$body .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$body .= $mensaje."\r\n\r\n";

// HTML del mensaje
$body .= "--PHP-alt-".md5(time())."\r\n";
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$body .= $mensaje_html."\r\n\r\n";

// Adjuntar el archivo PDF
$file = fopen($ruta_pdf, 'rb');
$data = fread($file, filesize($ruta_pdf));
fclose($file);
$data = chunk_split(base64_encode($data));
$body .= "--PHP-mixed-".md5(time())."\r\n";
$body .= "Content-Type: application/pdf; name=\"".$nombre_adjunto."\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "Content-Disposition: attachment\r\n\r\n";
$body .= $data."\r\n\r\n";
$body .= "--PHP-mixed-".md5(time())."--";

// Verificar si el archivo existe

    // Enviar el correo
    if (mail($destinatario, $asunto, $body, $headers)) {
        $sql="UPDATE `cotozaciones` SET `cot_enviado`='si' WHERE cot_id='$numFac'";
        $DB->Execute($sql);
        echo "Correo enviado correctamente.";
        
    } else {
        echo "Error al enviar el correo.";
    }
} else {
    // El archivo no existe
    echo "Revise el archivo antes de enviarlo y vuelva a intentar.";
    // Aquí puedes mostrar un mensaje de error en la interfaz de usuario o realizar otras acciones
}

?>