<?php



// Incluir los archivos de PHPMailer
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Crear una nueva instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    // $mail->isSMTP();
    // $mail->Host = 'smtp.gmail.com';
    // $mail->SMTPAuth = true;
    // $mail->Username = 'jose523a@gmail.com'; // Reemplaza con tu correo de Gmail
    // $mail->Password = 'joseNVD22'; // Reemplaza con tu contraseña de Gmail
    // $mail->SMTPSecure = 'tls';
    // $mail->Port = 587;
    //Clave ventas transmillas  gega vsfg okti mpum 
    //clave de pruebas jose R ngtz uiqb txff wbyy

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ventastransmillas@gmail.com';
    $mail->Password   = 'gega vsfg okti mpum'; // Asegúrate de usar la contraseña de la aplicación si tienes 2FA habilitado
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

     $destinatario = $_POST['correo'];
    $correos = json_decode($_POST['correos'], true);



    //   $destinatario = "jose523a@gmail.com";

    // Remitente y destinatarios
    $mail->setFrom('ventastransmillas@gmail.com', 'TRANSMILLAS LOGISTICA Y TRANSPORTADORA S.A.S.'); // Reemplaza con tu correo y nombre
    if ($destinatario!="") {
        $mail->addAddress($destinatario, ''); // Reemplaza con el correo del destinatario

    }
    if (is_array($correos)) {
        foreach ($correos as $destinatarios) {
            $mail->addAddress($destinatarios);
        }
    } else {
        echo "Error: 'correos' no es un array válido.";
        exit;
    }

    $contenido=$_POST['body'];
    $idFactura=$_POST['idfac'];



    // Adjuntar imágenes embebidas
    $mail->AddEmbeddedImage('images/logoCorreo.jpg', 'empresa_logo');
    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Documentos de Facturacion';

    $contenidoHTML = '
    <html>
    <head>
        <style>
            .footer {
                font-size: 12px;
                color: #777;
                margin-top: 20px;
                border-top: 1px solid #ddd;
                padding-top: 10px;
            }
        </style>
    </head>
    <body>
        <div>
        <img src="cid:empresa_logo" alt="Logo de la empresa" style="width: 400px;">
            <p>' . $contenido . '</p>
            <div class="footer">
                <p>Gracias por su atención.</p>
                <p>TRANSMILLAS LOGISTICA Y TRANSPORTADORA S.A.S.</p>
                <p>Carrera 20 # 56-26 Galerías</p>
                <p>PBX:3103122</p>
            </div>
        </div>
    </body>
    </html>';

    $mail->Body    = $contenidoHTML;
    $mail->AltBody = strip_tags($contenido);

    if (isset($_FILES['File0']) && $_FILES['File0']['error'] == UPLOAD_ERR_OK) {
        $uploadFile0 = $_FILES['File0']['tmp_name'];
        $uploadFileName0 = $_FILES['File0']['name'];
        $mail->addAttachment($uploadFile0, $uploadFileName0);
    }

    if (isset($_FILES['File1']) && $_FILES['File1']['error'] == UPLOAD_ERR_OK) {
        $uploadFile1 = $_FILES['File1']['tmp_name'];
        $uploadFileName1 = $_FILES['File1']['name'];
        $mail->addAttachment($uploadFile1, $uploadFileName1);
    }


    if (isset($_POST['linkFac']) ) {
        // Ruta del archivo existente en el servidor
        $existingFilePath = $_POST['linkFac'];
        $existingFileName = $_POST['linkFac']; // Nombre con el que deseas que aparezca en el correo

        // Adjunta el archivo existente en el servidor
        $mail->addAttachment($existingFilePath, $existingFileName);
    }
    if (isset($_POST['linkfac1']) ) {
        // Ruta del archivo existente en el servidor
        $existingFilePath = $_POST['linkfac1'];
        $existingFileName = $_POST['linkfac1']; // Nombre con el que deseas que aparezca en el correo

        // Adjunta el archivo existente en el servidor
        $mail->addAttachment($existingFilePath, $existingFileName);
    }


    // Enviar el correo
    $mail->send();
    echo 'El mensaje ha sido enviado';
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

    $sql2="SELECT fac_correofac FROM `facturascreditos`  WHERE idfacturascreditos='$idFactura'";
    $DB1->Execute($sql2); 
    $rw1=mysqli_fetch_row($DB1->Consulta_ID);
    
    $nummensajes=$rw1[0]+1;
    $sqlsqlupdate = "UPDATE `facturascreditos` SET fac_correofac='$nummensajes'  WHERE idfacturascreditos='$idFactura'";
    $DB->Execute($sqlsqlupdate);
 

} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}";
}





?>