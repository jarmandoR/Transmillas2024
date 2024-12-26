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

// if ($respuestas1!='') {
//     echo"si existe";
// }
// $responder=0;



if ($varVisto!='') {
    $sql3="UPDATE `noticia` SET `not_visto`='$varVisto',`not_fechaVisto`='$fechaactualHora' WHERE (`not_idDe`='$iduChat' and `not_idusuario`='$idUserA'and not_visto='no')";
     $DB->Execute($sql3);
}
 

?>

<!DOCTYPE html>
<html lang='es'>
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

</script>
<style type='text/css'>

      body1 {
    font-family: Roboto,sans-serif;
    font-size: 13px;
    line-height: 1.42857143;
    color: #767676;
    background-color: #edecec;

}

#messages-main {
    position: relative;
    margin: 0 auto;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}
#messages-main:after, #messages-main:before {
    content: ' ';
    display: table;
}
#messages-main .ms-menu {
    position: absolute;
    left: 0;
    top: 0;
    border-right: 1px solid #eee;
    padding-bottom: 50px;
    height: 100%;
    width: 240px;
    background: #fff;
}
@media (min-width:768px) {
    #messages-main .ms-body {
    padding-left: 240px;
}
}@media (max-width:767px) {
    #messages-main .ms-menu {
    height: calc(100% - 58px);
    display: none;
    z-index: 1;
    top: 58px;
}
#messages-main .ms-menu.toggled {
    display: block;
}
#messages-main .ms-body {
    overflow: hidden;
}
}
#messages-main .ms-user {
    padding: 15px;
    background: #f8f8f8;
}
#messages-main .ms-user>div {
    overflow: hidden;
    padding: 3px 5px 0 15px;
    font-size: 11px;
}
#messages-main #ms-compose {
    position: fixed;
    bottom: 120px;
    z-index: 1;
    right: 30px;
    box-shadow: 0 0 4px rgba(0, 0, 0, .14), 0 4px 8px rgba(0, 0, 0, .28);
}
#ms-menu-trigger {
    user-select: none;
    position: absolute;
    left: 0;
    top: 0;
    width: 50px;
    height: 100%;
    padding-right: 10px;
    padding-top: 19px;
}
#ms-menu-trigger i {
    font-size: 21px;
}
#ms-menu-trigger.toggled i:before {
    content: '\f2ea'
}
.fc-toolbar:before, .login-content:after {
    content: ''
}
.message-feed {
    padding: 20px;
}
#footer, .fc-toolbar .ui-button, .fileinput .thumbnail, .four-zero, .four-zero footer>a, .ie-warning, .login-content, .login-navigation, .pt-inner, .pt-inner .pti-footer>a {
    text-align: center;
}
.message-feed.right>.pull-right {
    margin-left: 15px;
}
.message-feed:not(.right) .mf-content {
    background: #03a9f4;
    color: #fff;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}
.message-feed.right .mf-content {
    background: #eee;
}
.mf-content {
    padding: 12px 17px 13px;
    border-radius: 2px;
    display: inline-block;
    max-width: 80%
}
.mf-date {
    display: block;
    color: #B3B3B3;
    margin-top: 7px;
}
.mf-date>i {
    font-size: 14px;
    line-height: 100%;
    position: relative;
    top: 1px;
}
.msb-reply {
    box-shadow: 0 -20px 20px -5px #fff;
    position: relative;
    margin-top: 30px;
    border-top: 1px solid #eee;
    background: #f8f8f8;
}
.four-zero, .lc-block {
    box-shadow: 0 1px 11px rgba(0, 0, 0, .27);
}
.msb-reply textarea {
    width: 100%;
    font-size: 13px;
    border: 0;
    padding: 10px 15px;
    resize: none;
    height: 60px;
    background: 0 0;
}
.msb-reply button {
    position: absolute;
    top: 0;
    right: 0;
    border: 0;
    height: 100%;
    width: 60px;
    font-size: 25px;
    color: #2196f3;
    background: 0 0;
}
.msb-reply button:hover {
    background: #f2f2f2;
}
.img-avatar {
    height: 37px;
    border-radius: 2px;
    width: 37px;
}
.list-group.lg-alt .list-group-item {
    border: 0;
}
.p-15 {
    padding: 15px!important;
}
.btn:not(.btn-alt) {
    border: 0;
}
.action-header {
    position: relative;
    background: #AED6F1 ;
    padding: 8px 8px 8px 8px;
}
.ah-actions {
    z-index: 3;
    float: left;
    margin-top: 7px;
    position: relative;
}
.actions {
    list-style: none;
    padding: 0;
    margin: 0;
}
.actions>li {
    display: inline-block;
}

.actions:not(.a-alt)>li>a>i {
    color: #939393;
}
.actions>li>a>i {
    font-size: 20px;
}
.actions>li>a {
    display: block;
    padding: 0 10px;
}
.ms-body{
    background:#fff;    
}
#ms-menu-trigger {
    user-select: none;
    position: absolute;
    left: 0;
    top: 0;
    width: 50px;
    height: 100%;
    padding-right: 10px;
    padding-top: 19px;
    cursor:pointer;
    background: #AED6F1 ;
}
#ms-menu-trigger, .message-feed.right {
    text-align: right;
}
#ms-menu-trigger, .toggle-switch {
    -webkit-user-select: none;
    -moz-user-select: none;
}

 .message_template{
       
        height:500px;
         overflow: scroll;
    }
    </style>
  </head>

<body>

<?php 

$conde="and not_fecha like '$fechaactual%'"; 
$conde1="and not_fecha like '$fechaactual%'"; 
$conde2="and usu_nombre='$id_nombre'"; 
$conde3="and roles_idroles = '$nivel_acceso'"; 
$conde4="and not_idDe = '$idUserA'and not_idusuario='$iduChat' ";
$conde5="or  not_idDe = '$iduChat'and not_idusuario='$idUserA' ";
if($param1!=''){ $conde="and not_fecha >= '$param1'";  $fechaactual=$param1;  }
if($param5!=''){ $conde1="and not_fecha <= '$param5'"; $fechaactual1=$param5;  }

$FB->titulo_azul6("",1,0,5,"usu_nombre",$asc2); 
if($nivel_acceso==1 or $nivel_acceso==5){
  $FB->titulo_azul3("",2,0,2,$param_edicion);
  }


echo"<div class='ms-body1'  ><div class='action-header clearfix'>";

$sql1="SELECT `idusuarios`, `usu_nombre`,`usu_identificacion` FROM `usuarios` where idusuarios=$iduChat ";
$DB1->Execute($sql1); 
  $rw2=mysqli_fetch_array($DB1->Consulta_ID);

$sles1="SELECT hoj_foto FROM hojadevida WHERE hoj_cedula like'%$rw2[2]%'";
$DB_m1->Execute($sles1); 
$foto=$DB_m1->recogedato(0);

$fechaa =date("Y-m-d");
$sles="SELECT seg_almuerzosino  FROM seguimiento_user WHERE seg_idusuario = '$rw2[0]'and seg_fechaingreso like '$fechaa%'";
$DB_m->Execute($sles); 
$almorzando=$DB_m->recogedato(0);
  
            echo " 
                 <div class='pull-left hidden-xs' id = 'aqui'>               
                    <div class='lv-avatar pull-left'>                       
                    </div>
                </div> 
                <ul class='ah-actions actions'>
                <li>";

                if ($foto!='') {
                    echo "<img src='imgUsuarios/".$foto."' alt='' class='img-avatar' alt='' class='img-avatar m-r-10'>";
                }else{

                    echo "
                    <img src='imgUsuarios/userd.jpg' alt='' class='img-avatar' alt='' class='img-avatar m-r-10'>
                    "; 
                }

                     echo "
                    </li>
                    <li>";
                       echo "<span>".$rw2[1]."</span>
                    </li>
                    <li class='dropdown'>
                    <a href='salaChats.php' class='btn btn-default'><span class='glyphicon glyphicon-circle-arrow-left'></span>Volver</a>                       
                        <ul class='dropdown-menu dropdown-menu-right'>
                            <li>
                                <a href=''>Latest</a>
                            </li>
                            <li>
                                <a href=''>Oldest</a>
                            </li>
                        </ul>
                    </li>                             
                    <li class='dropdown'>
                        <a href='' data-toggle='dropdown' aria-expanded='true'>
                            <i class='fa fa-bars'></i>
                        </a>
            
                        <ul class='dropdown-menu dropdown-menu-right'>
                            <li>
                                <a href=''>Refresh</a>
                            </li>
                            <li>
                                <a href=''>Message Settings</a>
                            </li>
                        </ul>
                    </li>
                    ";
                    if ($almorzando=='si') {
                        
                    
                   echo " <li>
                    <div class='alert alert-danger' role='alert'>
                    <strong>🔴</strong> En el momento no esta disponible, esta almorzando
                    </li>";
                    }else{

                    echo "<li>
                    <div class='alert alert-success' role='alert'>
                      <strong>🟢</strong> Disponible
                       </li>
                    ";

                    }
                echo "</ul>
           </div>";
    echo "<div class='message_template' id ='caja' style=' overflow: scroll;'></div>"; 
    echo "</div>";

    if ($respuestas1!=''){
    $idrespuestaespesifi=$respuestas1;
    }else{

$idrespuestaespesifi=0;
    }
  
 //subir imagenes se puede subir mas de dos imagenes.
if (isset($_FILES['imagenchat'])){
    
    $cantidad= count($_FILES["imagenchat"]["tmp_name"]);
    for ($i=0; $i<$cantidad; $i++){
    //Comprobamos si el fichero es una imagen
        if ($_FILES['imagenchat']['type'][$i]=='image/png' || $_FILES['imagenchat']['type'][$i]=='image/jpeg'){
        //Subimos el fichero al servidor
        move_uploaded_file($_FILES["imagenchat"]["tmp_name"][$i],"./imgMensajes/".$_FILES["imagenchat"]["name"][$i]);
        $validar=true;
        $tipoD='';

        }elseif($_FILES['imagenchat']['type'][$i]=='application/pdf'){
            move_uploaded_file($_FILES["imagenchat"]["tmp_name"][$i],"./imgMensajes/".$_FILES["imagenchat"]["name"][$i]);
            $validar=true;
            $tipoD='pdf';
        }else
         $validar=false;   
    }
}


$mensaje1 = $_POST["mensaje"]; 
$de1 = $_POST["de"];
$para1 = $_POST["para"];
 $fecha1 = $_POST["fecha"];

 //Insertar imagenes se puede subir mas de dos imagenes.
 if (isset($_FILES['imagenchat']) && $validar==true){ 
    for ($i=0; $i<$cantidad; $i++){

    echo "<h1>";  $imagen = $_FILES["imagenchat"]["name"][$i]; echo "</h1>";  

    $sql=" INSERT INTO noticia (not_descripcion,not_idDe,not_idusuario,not_fecha,not_imagen,not_visto,not_respuesta,not_idrespuestaespesifi) VALUES ('$mensaje1','$de1','$para1','$fechaactualHora','$imagen','no','$tipoD','$idrespuestaespesifi')";
    $DB->Execute($sql);

 } 
}

// insertar mensaje.
if(isset($_POST['mensaje'])){ 

    $mensaje1 = $_POST["mensaje"]; 
    $de1 = $_POST["de"];
    $para1 = $_POST["para"];
    $fecha1 = $_POST["fecha"];

    if($mensaje1!="") {
        $respuestas1='';
            $sql=" INSERT INTO noticia (not_descripcion,not_idDe,not_idusuario,not_fecha,not_visto,not_idrespuestaespesifi) VALUES ('$mensaje1','$de1','$para1','$fechaactualHora','no','$idrespuestaespesifi')";
            $DB->Execute($sql);  
        

            $sql4 ="SELECT usu_tokpush FROM usuarios WHERE idusuarios = '$para1'";
                $DB1->Execute($sql4);     
            $iddepe=$DB1->recogedato(0); 

            // $severKey="SERVER_KEY";
            $severKey="AAAArG5v458:APA91bFAocZ-skdsFXycEsyPZ0dupcaWvrIGo2wgEqM_rXr8pTvS7dmekiOS6DWOXJSRac9S73BnqFWKYMccUI2BcFdUQ6lRyn-kY8ghsdhzRhvlCcDPOp-JyAFUjBGhGirw5IXQhqFy";

            $url="https://fcm.googleapis.com/fcm/send";
            $prioridad="alta";
            $icono="notificaciones/img/icon.png";
            if($prioridad == 'alta'){
                $icono="images/logo2021.jpeg";
            }

        $sles1="SELECT usu_nombre FROM usuarios WHERE idusuarios='$de1'";
        $DB_m1->Execute($sles1); 
        $nomuser=$DB_m1->recogedato(0);
        // Para un solo token, si es para varios usar “registration_ids” en vez de “to”.
        $title='Nuevo mensaje de'.$nomuser;
        $message= $mensaje1;
        $field = array('to'=>$iddepe, 'notification'=>array('title'=>$title, 'body'=>$message, 'icon'=>$icono));

        $fields=json_encode($field);


        $header=array(
            'Authorization: key='.$severKey,
            'Content-Type: application/json'
        );
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);

        $result=curl_exec($ch);
        $result;
        curl_close($ch);


    }

}

$responder=1;
if ($respuestas1!='')  {

    $sles2="SELECT not_descripcion,not_imagen FROM noticia WHERE idnoticia='$respuestas1'";
        $DB_m1->Execute($sles2); 
        // $menrespuesta=$DB_m1->recogedato(0);
        $rw4=mysqli_fetch_array($DB_m1->Consulta_ID);

   echo "<div class='input-group' >
        <tr>
         <mark>Respondiendo a: ";
         echo$rw4[0];
          if ($rw4[1]!=''){

                    echo" <a href='imgMensajes/".$rw4[1]."' target='_blank'><img src='imgMensajes/".$rw4[1]."' width='50'></a>";

                    }


         echo"</mark></tr>
        </div>";
}


echo " <div class='col-lg-6'>
       <form method='POST' enctype='multipart/form-data' >";


        echo"<div class='input-group'>
        <tr>
        <input type='text' class='form-control'  name='mensaje' size='20' placeholder='escriba aqui su mensaje' ></tr>
        </div>
        <div class='input-group'>
        <input type='hidden' class='form-control'  name='de' size='20' value='".$idUserA."'>
        </div>
        <div class='input-group'>
        <input type='hidden' class='form-control'  name='para' size='20' value='".$iduChat."' id = 'idChat'>
        </div>          
        <div class='input-group'><tr> 
        <input type='file' class='form-control'  name='imagenchat[]' value='' multiple></tr>
        </div>
          <span class=input-group-btn'>
        <tr> 
        <button type='submit' class='btn btn-danger' name='enviar' >Enviar</button></tr> 
     </span>  
     </div> 
 <div class='row justify-content-md-center'>
</div>    
</body>
</html>";

include("footer.php");
?>
<link href="jquery.multiselect.css" rel="stylesheet" type="text/css">
<script src="jquery.min.js"></script>
<script src="jquery.multiselect.js"></script>
<script type="text/javascript">


function sinjQuery(){
    $('#caja').scrollTop( $('#caja').prop('scrollHeight') );
}

setTimeout(sinjQuery,1000); 
getTimeAJAX();

// $('#langOptgroup').multiselect({
//     columns: 4,
//     placeholder: 'Select Languages',
//     search: true,
//     selectAll: true
// });



</script>



