<?php 
require("login_autentica.php"); 
include("declara.php");

echo$de1=$_POST['de'];
echo$para1=$_POST['para'];
echo$texto=$_POST['men'];
$fechaactualHora =date("Y-m-d H:i:s");


// mail('jose523a@gmail.com','titulo',$mensaje.' de '.$nombre);

 echo "hola".$de1."tu mensaje".$texto;


    // $mensaje1 = $_POST["mensaje"]; 
    // $de1 = $_POST["de"];
    // $para1 = $_POST["para"];
    // $fecha1 = $_POST["fecha"];
echo"<img src='$foto'>";



    
      if (is_uploaded_file($_FILES['foto']['tmp_name'])){
        $imagen = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['usuario_id']).".jpg";
  
        move_uploaded_file($_FILES['foto']['tmp_name'], "./imgUsuarios/".$imagen);
     }else{
        $imagen='';
     } 

 //Insertar imagenes se puede subir mas de dos imagenes.
    
        
            $sql=" INSERT INTO noticia (not_descripcion,not_idDe,not_idusuario,not_fecha,not_visto,not_imagen) VALUES ('$texto','$de1','$para1','$fechaactualHora','no','$imagen')";
            $DB->Execute($sql);  
        

          
        //     $sql4 ="SELECT usu_tokpush FROM usuarios WHERE idusuarios = '$para1'";
        //         $DB1->Execute($sql4);     
        //     $iddepe=$DB1->recogedato(0); 

        //     // $severKey="SERVER_KEY";
        //     $severKey="AAAArG5v458:APA91bFAocZ-skdsFXycEsyPZ0dupcaWvrIGo2wgEqM_rXr8pTvS7dmekiOS6DWOXJSRac9S73BnqFWKYMccUI2BcFdUQ6lRyn-kY8ghsdhzRhvlCcDPOp-JyAFUjBGhGirw5IXQhqFy";

        //     $url="https://fcm.googleapis.com/fcm/send";
        //     $prioridad="alta";
        //     $icono="notificaciones/img/icon.png";
        //     if($prioridad == 'alta'){
        //         $icono="images/logo2021.jpeg";
        //     }

        // $sles1="SELECT usu_nombre FROM usuarios WHERE idusuarios='$de1'";
        // $DB_m1->Execute($sles1); 
        // $nomuser=$DB_m1->recogedato(0);
        // // Para un solo token, si es para varios usar “registration_ids” en vez de “to”.
        // $title='Nuevo mensaje de'.$nomuser;
        // $message= $texto;
        // $field = array('to'=>$iddepe, 'notification'=>array('title'=>$title, 'body'=>$message, 'icon'=>$icono));

        // $fields=json_encode($field);


        // $header=array(
        //     'Authorization: key='.$severKey,
        //     'Content-Type: application/json'
        // );
        // $ch=curl_init();
        // curl_setopt($ch, CURLOPT_URL,$url);
        // curl_setopt($ch, CURLOPT_POST,true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);

        // $result=curl_exec($ch);
        // $result;
        // curl_close($ch);



?>
<!-- <link href="jquery.multiselect.css" rel="stylesheet" type="text/css">
<script src="jquery.min.js"></script>
<script src="jquery.multiselect.js"></script>
<script type="text/javascript"> -->


