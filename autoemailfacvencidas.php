<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function sendEmail(idfac,email,body){


    
// const fileNames = 
// let arrayParam = encodeURIComponent(JSON.stringify(fileNames));
// console.log(fileNames);
console.log(idfac+"_"+email+"_"+body);

// const email = document.getElementById('param2');
// const body = document.getElementById('param5');
const formData = new FormData();
var cond = 1;
//agregar correo
formData.append('correo', email);
//agregar correo
formData.append('body', body);
formData.append('idfac', idfac);
formData.append('cond', cond);

// const loadingElement = document.getElementById('loading');

// Mostrar el GIF de carga
// loadingElement.style.display = 'block';
// Enviar datos al servidor
fetch('email_facvencida.php', {
    method: 'POST',
    body: formData
})
.then(response => response.text())
.then(result => {
    console.log(result);
    // alert(result);
    // idsSeleccionados = [];
})
.catch(error => {
    console.error('Error:', error);
    // alert('Error al enviar el correo');
}).finally(() => {
    // // Ocultar el GIF de carga
    // loadingElement.style.display = 'none';
});

}
</script>


<?php


$bd="u713516042_transmillas2"; 
$host="localhost";
$user="u713516042_jose2";
$pass="Dobarli23@transmillas";
$Usu_ses="vive";
$salt = "transmi2344fsdfd"; 

date_default_timezone_set("America/Bogota");


 $link = mysqli_connect($host, $user, $pass) or die("Unable to Connect to '$host'");
mysqli_select_db($link, $bd) or die("Could not open the db '$bd'");



$fechaActual=date('Y-m-d');




$sql="SELECT `idfacturascreditos`, `fac_fechafactura`,`fac_credito`, `fac_numerofactura`, `fac_fechaprefac`,`fac_idservicios`, `fac_iduserpre`,`fac_numeroref`, `fac_fechafacturado`, `fac_fechavencimiento`, `fac_estado`,`fac_tipopago`,`fac_iduserfac`,fac_precio,`fac_fecharadicado`,fac_fechapago,fac_notacredito,fac_fecharafacturado,fac_pagoconfir,fac_userconfirmo,fac_fechacomfir,fac_valorpendiente,fac_preciofinal,fac_correoven, fac_nit,fac_correofac FROM `facturascreditos` WHERE date(fac_fechafactura)>='2024-01-01' and (fac_tipopago='Pendiente' or fac_tipopago is null) and fac_estado='Facturado' and fac_credito!='EXTERNOS'  ORDER BY fac_numeroref ASC ";
$html="";
$resultado="";
// $DB->Execute($sql); 
$result2 = mysqli_query($link, $sql);
$guias=0;
	while($rw1=mysqli_fetch_row($result2))
	{
        $fechaVence=$rw1[9];
        $numero=$rw1[7];
        $id_p=$rw1[0];
        if ($rw1[2]=="EXTERNOS") {
        echo"Es externo <br>";
        }else{
            $sql2="SELECT `idcreditos`, `cre_nombre`,idhojadevida FROM `creditos` INNER JOIN hojadevidacliente on hoj_clientecredito=idcreditos WHERE cre_nombre='$rw1[2]'";

            $result3 = mysqli_query($link, $sql2);
            $rw2=mysqli_fetch_row($result3);

            $correo="SELECT `cont_correo` FROM `contactofacturacion` WHERE cont_idhojavida ='$rw2[2]' and con_principal='1'";

            $result4 = mysqli_query($link, $correo);
            $ema=mysqli_fetch_row($result4);




            $email="$ema[0]";
            $mensaje="Estimado cliente le recordamos que la factura # ".$numero."  se encuentra vencida,si ya realizó su pago por favor enviar el soporte a  esté correo";

            
 

                if ( $fechaActual>=$fechaVence) {
                    if ($email!="") {
                        echo"<script>sendEmail($id_p,\"$email\",\"$mensaje\");</script>"; 
                        $resultado.="Factura $numero Vencida el $fechaVence Se envia al correo $email Alerta <br> \n";


                        $sql3="SELECT fac_correoven FROM `facturascreditos`  WHERE idfacturascreditos='$id_p'";
                        $result5 = mysqli_query($link, $sql3);
                        $cuen=mysqli_fetch_row($result5);
                        
                        $nummensajes=$cuen[0]+1;
                        $sqlsqlupdate = "UPDATE `facturascreditos` SET fac_correoven='$nummensajes'  WHERE idfacturascreditos='$id_p'";
                        $update = mysqli_query($link, $sqlsqlupdate);
                    }else {
                        $resultado.="Factura $numero Vencida el $fechaVence No se encontro correo del credito $rw1[2]  <br> \n";
                    }
                    
                    
                }


            // }
        }


        $resultado.= "_".$fechaActual;
    }


    echo$resultado;

    // Abre el archivo en modo "append" para agregar contenido al final del archivo
    $archivo = fopen("emailsEnviados.txt", "a");

    // Escribe el resultado en el archivo, seguido de un salto de línea
    fwrite($archivo, $resultado . "\n");

    // Cierra el archivo
    fclose($archivo);
?>

