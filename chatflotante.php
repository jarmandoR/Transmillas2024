<?php 
require("login_autentica.php"); 
include("loyautpruebas.php");
$sedesesion=$_SESSION['usu_idsede'];

$idUserA=$_SESSION['usuario_id'];
 $miRol=$nivel_acceso;
$misede=$_SESSION['usu_idsede'];
$fechaa =date("Y-m-d");
if ($nivel_acceso==1 or $nivel_acceso==12) {
$FB->titulo_azul1("Usuarios Chat",9,0,7);  
$FB->abre_form("form1","","post");

}
$sql6="SELECT usu_nombre, usu_mail FROM usuarios WHERE idusuarios='$idUserA' ";
                    $DB->Execute($sql6); 
                    $rw5=mysqli_fetch_row($DB->Consulta_ID);
 $nomuser=$rw5[0];


$FB->titulo_azul6("Mis chats",1,0,5,"usu_nombre",$asc2); 

$conde3 = "and usu_idsede = '$sedesesion'";
//echo $param2;
// $conde1=""; if($param2!=""){ if($param2=="Activo") { 
    $conde1=" AND usu_estado='1' ";
 // } else { $conde1=" AND usu_estado='0' "; } }
    if($param1!="0" and $param1!=""){ $conde=" AND idroles='$param1' "; } else { $conde="";} 
    if($param2!="0" and $param2!=""){ $conde1=" AND usu_idsede='$param2' "; } else { $conde1="";} 

   // echo "<ul class='ah-actions actions'>
            //<li>
            //</li>         
            //</ul>

            //<li class='dropdown'>
            //<a href='' data-toggle='dropdown' aria-expanded='true'> ";

            //echo"</a> </li></ul> ";

 $sql="  SELECT idnoticia,  iduser,max(not_fecha) fecha,usu_nombre,rol_nombre
         FROM ((SELECT idnoticia, not_idDe as iduser,not_fecha FROM noticia where not_idusuario = '$idUserA' and not_visto!= '' ORDER BY not_fecha desc) UNION (SELECT idnoticia, not_idusuario as iduser,not_fecha FROM noticia where not_idDe = '$idUserA' and not_visto!= '' ORDER BY not_fecha desc)ORDER BY not_fecha desc )
 mensajes inner join usuarios on idusuarios=iduser inner join roles ON roles_idroles=idroles GROUP by iduser ORDER BY fecha desc";
 

 $DB->Execute($sql); 


$va=0; 
while($rw=mysqli_fetch_row($DB->Consulta_ID)){

 $sles3="SELECT usu_estado  FROM usuarios WHERE idusuarios = '$rw[1]'";
$DB_m->Execute($sles3); 
$estado=$DB_m->recogedato(0);   

//si el usuario esta activo
if ($estado!=0) {
    # code...

    $va++; $p=$va%2; $id_p=$rw[0];
    if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
    echo "<tr bgcolor='$color' class='text' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";

// Trae los numeros de mesajes.

 $sql1 = "SELECT count(*) FROM `noticia` WHERE not_idusuario='$idUserA' AND not_idDe='$rw[1]'and not_visto='no'";
 $DB1->Execute($sql1); 
 $cantMensajes=$DB1->recogedato(0);

//para mostrar foto
$sles="SELECT usu_identificacion FROM usuarios WHERE idusuarios='$rw[1]'";
$DB_m->Execute($sles); 
$identifi=$DB_m->recogedato(0);

if ($identifi!='') {
    $sles1="SELECT hoj_foto FROM hojadevida WHERE hoj_cedula like'%$identifi%' ";
    $DB_m1->Execute($sles1); 
    $foto=$DB_m1->recogedato(0);
}
$sles2="SELECT seg_almuerzosino  FROM seguimiento_user WHERE seg_idusuario = '$rw[1]'and seg_fechaingreso like '$fechaa%'";
$DB_m->Execute($sles2); 
$almorzando=$DB_m->recogedato(0);

                 echo " </head><td><div class='list-group lg-alt'>
                <a class='list-group-item media'
                href='mensajes2pchatflot.php?idUserm=".$rw[1]."&varVisto=si' target='iframechat' >
                <div class='pull-left'>
                ";
              if ($foto!='') {
                    echo "<img src='imgUsuarios/".$foto."' alt='' class='img-avatar'>";
                }else{

                    echo "<img src='imgUsuarios/userd.jpg' alt='' class='img-avatar'>"; 
                }


                echo "      
                </div>
                <div class='media-body'>
                <small class='list-group-item-heading'>".$rw[3]."</small>
                <small class='list-group-item-text c-gray'>".$rw[4]."</small>";
                      
                $nomtem= $rw[1];
                if ($cantMensajes>0) {   

                         echo" <small class='list-group-item-text c-gray' style='background-Color:#FF0000; color:#FFFFFF; width:50px; height:50px;'>$cantMensajes </small>";
                }
            if ($almorzando=='si') {

                echo" 🔴 Almorzando";
            }
                                               
                 echo" </div> </a></td>";

}//llave cierra condicion activo
                
    }

include("footer.php");
?>
<script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.1/firebase-messaging.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="notificaciones.js"></script>
    <head>


<script type="text/javascript">

    function getTimeAJAX() {
        //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    
        var time = $.ajax({
            type: 'POST',
            data: {idPro : $('#idChat').val()},
            url: 'chatConsultas.php', //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
        }).responseText;
        //actualizamos el div que nos mostrará la hora actual
        document.getElementById("caja").innerHTML = ""+time;
    }

//setInterval(getTimeAJAX,1000);
</script>
</head>