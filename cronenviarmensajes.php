<?php

$bd="u713516042_transmillas"; 
$host="localhost";
$user="u713516042_jose";
$pass="0?jBMSc4GUcN";
$Usu_ses="vive";
$salt = "transmi2344fsdfd"; 

date_default_timezone_set("America/Bogota");


 $link = mysqli_connect($host, $user, $pass) or die("Unable to Connect to '$host'");
mysqli_select_db($link, $bd) or die("Could not open the db '$bd'");


$sql="SELECT `idreportealertas`, `rep_alerta`, `rep_fechavencimiento`, `rep_emails`, `rep_useractualiza`, `rep_fechareporte`, `rep_idsede`,sed_nombre FROM `reportealertas` inner join sedes on rep_idsede=idsedes WHERE idreportealertas>=0  ORDER BY idreportealertas  asc ";
$result2 = mysqli_query($link, $sql);

$va=0; 
$totalasignadas=0;
$fechaactual=date("Y-m-d");
echo "<table>";
	while($rw1=mysqli_fetch_row($result2))
	{

		
	  	$id_p=$rw1[0];
			$va++; $p=$va%2;
      if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
      $fecha=$rw1[2];
	  		  $fecha1= new DateTime("$fecha");
			$fecha2= new DateTime("$fechaactual");
			$resta = $fecha1->diff($fecha2); 
			$dias=$resta->days;
			$fecha11= strtotime($fecha);
			$fecha22= strtotime($fechaactual);
			if($fecha22 > $fecha11)
			{
			//echo "La fecha actual es mayor a la comparada.</br>";

			$dias=$dias*-1;
			$diasantes=$dias-3;
			}else
				{
			//	echo "La fecha comparada es igual o menor</br>";
				$diasantes=$dias;
				}

			
			if($diasantes<=0){
				$color="#ff5f42";
				$usu_mail=explode(",",$rw1[3]);
				$archivo='';
				$mensaje=$rw1[1];
				$persona=$rw1[4];
				enviar_mail2($usu_mail, $archivo,$mensaje,$persona,'Alarma Vencida');
			}
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "<td>".$rw1[1]."</td>";
			echo "<td>".$rw1[2]."</td>";
			echo "<td>Ver</td>";
			echo "<td>".$dias."</td>";
			echo "<td>".$rw1[3]."</td>";
			echo "<td>".$rw1[4]."</td>";
			echo "<td>".$rw1[5]."</td>";
      echo "<td>".$rw1[7]."</td>";
      
      echo "</tr>";
    }
    
	echo "</table>";



function enviar_mail2($usu_mail, $archivo,$mensaje,$persona,$asunto)
{
			$enviados="";
			require_once("connection/class.phpmailer.php");
			$mail = new PHPMailer();
			$mail->From = "logistica@transmillas.com";
			$mail->FromName = "Transmillas";
			$mail->Subject = "$persona"."- -"."$asunto";
			$mail->Body = "$mensaje";

					 foreach($usu_mail as $mails)
					{
							echo  $mails;
							$mail->AddAddress($mails);
							$enviados.=$mails.",";
						
					}
			if($archivo!=""){
			$mail->AddAttachment($archivo,$archivo);
			}
			$mail->Send();
			$logFile = fopen("enviodealertaslog.txt", 'a') or die("Error creando archivo");
			echo "\n".date("d/m/Y H:i:s")." Correo enviado a: $enviados";
			fwrite($logFile, "\n".date("d/m/Y H:i:s")." Correo enviado a:$enviados") or die("Error escribiendo en el archivo");fclose($logFile);
			//echo "correos enviados";
}
/* 
$usu_mail2=explode(",",'libar1012@gmail.com');
enviar_mail22('detc1809@gmail.com', '','pruebas transmillas','jose','Alarma Vencida',1);

function comprobar_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}

function enviar_mail22($usu_mail, $archivo,$mensaje,$persona,$asunto,$tipo)
{
			require_once("connection/class.phpmailer.php");
			$mail = new PHPMailer();
			$mail->isHTML(true); 
			$mail->From = "ventastransmillas@gmail.com";
			$mail->FromName = "Transmillas";
			$mail->Subject = "$persona"."- -"."$asunto";
			$mail->Body = "$mensaje";
			if($tipo==1){
				if (comprobar_email($usu_mail)) {
					$mail->AddAddress($usu_mail);
				}else {
						return 13;
						}		
			} else if ($tipo==2){
					 foreach($usu_mail as $mails)
					{
						if (comprobar_email($mails)) {
							$mail->AddAddress($mails);
						}
					}
			}
			if($archivo!=""){
			$mail->AddAttachment($archivo,$archivo);
			}
			$mail->Send();
}  */

?>