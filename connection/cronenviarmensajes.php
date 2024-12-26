<?php

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$to = "jose.miranda@transmillas.com";
$from = "libar1012@gmail.com";
$subject = "Checking PHP mail";
$message = "PHP mail works just fine";
$headers = "From:" . $from;
mail($to,$subject,$message, $headers);
echo "The email message was sent.";
/* 
require_once("funciones.php");

$bd="u713516042_transmillas"; 
$host="localhost";
$user="u713516042_jose";
$pass="0?jBMSc4GUcN";
$Usu_ses="vive";
$salt = "transmi2344fsdfd"; 

date_default_timezone_set("America/Bogota");

$usu_mail2=explode(",",'libar1012@gmail.com');
enviar_mail22('detc1809@gmail.com', '','pruebas transmillas','jose','Alarma Vencida',1);
enviar_mail22('libar1012@gmail.com', '','pruebas transmillas','jose','Alarma Vencida',1);

enviar_mail2('detc1809@gmail.com', '','pruebas transmillas','jose','Alarma Vencida',1);
enviar_mail2('libar1012@gmail.com', '','pruebas transmillas','jose','Alarma Vencida',1);


$enviados='';

function enviar_mail22($usu_mail, $archivo,$mensaje,$persona,$asunto,$tipo)
{
			require_once("class.phpmailer.php");
			$mail = new PHPMailer();
			$mail->isHTML(true); 
			$mail->From = "ventastransmillas@gmail.com";
			$mail->FromName = "Transmillas";
			$mail->Subject = "$persona"."- -"."$asunto";
			$mail->Body = "$mensaje";
			if($tipo==1){
				if (comprobar_email($usu_mail)) {
					$mail->AddAddress($usu_mail);
					$enviados.=$usu_mail.",";
				}else {
						return 13;
						}		
			} else if ($tipo==2){
					 foreach($usu_mail as $mails)
					{
						if (comprobar_email($mails)) {
							$mail->AddAddress($mails);
							$enviados.=$mails.",";
						}
					}
			}
			if($archivo!=""){
			$mail->AddAttachment($archivo,$archivo);
			}
			$mail->Send();
			echo "\n".date("d/m/Y H:i:s")." Correo enviado a: $enviados";

}  */

?>