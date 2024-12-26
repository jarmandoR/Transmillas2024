<?php 
require("login_autentica.php"); 
include("declara.php");
$message="";

echo$de1=$_POST['de'];
echo$para1=$_POST['para'];
echo$texto=$_POST["mensajetexto"];
echo$numrespuesta=$_POST["nrespuestas"];
$fechaactualHora =date("Y-m-d H:i:s");
 
// si vale 1 todo ha ido bien, 0 ha habido algun problema
$ok=1;



function compressImage($source, $destination, $quality) { 
    // Obtenemos la información de la imagen
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Creamos una imagen
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Guardamos la imagen
    imagejpeg($image, $destination, $quality); 
     
    // Devolvemos la imagen comprimida
    return $destination; 
} 
 
 
// if($_POST["mensajetexto"])
// {
//     $message.="El nombre recibido es: ".$_POST["mensajetexto"]."\n";
// }else{
//     $message.="No se ha recibido el nombre\n";
//     $ok=0;
// }
 
 // $message.="es : ".$_POST["de"]."\n";
 // $message.="es: ".$_POST["para"]."\n";
$status = $statusMsg = ''; 
if($_FILES)
{





    foreach($_FILES as $file)
    {   
        
        
        if($file["error"]==UPLOAD_ERR_OK)
        {

            // movemos el archivo a la carpeta donde se encuentra este archivo
            
            // move_uploaded_file($file["tmp_name"], "imgMensajes/".$file["name"]);
           
            // $message.="La imagen ".$imagen." se ha recibido correctamente\n";


 
 
// Ruta subida
$uploadPath = "imgMensajes/"; 
 
// Si el fichero se ha enviado


    $status = 'error'; 
    
        // File info 
        $fileName = basename($file["name"]); 
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
         
        // Permitimos solo unas extensiones
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $file["tmp_name"]; 
             
            // Comprimos el fichero
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 50); 
             
            if($compressedImage){ 
                $status = 'success'; 
                $statusMsg = "La imagen se ha subido satisfactoriamente."; 
            }else{ 
                $statusMsg = "La compresion de la imagen ha fallado"; 
            } 
        }else{ 

              // movemos el archivo a la carpeta donde se encuentra este archivo
            
            move_uploaded_file($file["tmp_name"], "imgMensajes/".$file["name"]);
           
            
        } 
        $imagen = $file["name"];

 
// Mostrar el estado de la imagen 












               $sql=" INSERT INTO noticia (not_descripcion,not_idDe,not_idusuario,not_fecha,not_imagen,not_visto,not_respuesta,not_idrespuestaespesifi) VALUES ('$texto','$de1','$para1','$fechaactualHora','$imagen','no','','$numrespuesta')";
    $DB->Execute($sql);
 
    
        }
        
    }


     // $sql4 ="SELECT usu_tokpush FROM usuarios WHERE idusuarios = '$para1'";
     //            $DB1->Execute($sql4);     
     //        $iddepe=$DB1->recogedato(0); 

     //        // $severKey="SERVER_KEY";
     //        $severKey="AAAArG5v458:APA91bFAocZ-skdsFXycEsyPZ0dupcaWvrIGo2wgEqM_rXr8pTvS7dmekiOS6DWOXJSRac9S73BnqFWKYMccUI2BcFdUQ6lRyn-kY8ghsdhzRhvlCcDPOp-JyAFUjBGhGirw5IXQhqFy";

     //        $url="https://fcm.googleapis.com/fcm/send";
     //        $prioridad="alta";
     //        $icono="notificaciones/img/icon.png";
     //        if($prioridad == 'alta'){
     //            $icono="images/logo2021.jpeg";
     //        }

     //     $sql2="SELECT usu_nombre FROM usuarios WHERE idusuarios='$de1'";
     //    $DB->Execute($sql2); 
     //    $nomuser=$DB->recogedato(0);
     //    // Para un solo token, si es para varios usar “registration_ids” en vez de “to”.
     //    $title='Nuevo mensaje de'.$nomuser;
     //    $message= "TE HA ENVIADO IMAGENES";
     //    $field = array('to'=>$iddepe, 'notification'=>array('title'=>$title, 'body'=>$message, 'icon'=>$icono));

     //    $fields=json_encode($field);


     //    $header=array(
     //        'Authorization: key='.$severKey,
     //        'Content-Type: application/json'
     //    );
     //    $ch=curl_init();
     //    curl_setopt($ch, CURLOPT_URL,$url);
     //    curl_setopt($ch, CURLOPT_POST,true);
     //    curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
     //    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
     //    curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);

     //    $result=curl_exec($ch);
     //    $result;
     //    curl_close($ch);

}else{
    $imagen='';
    $sql=" INSERT INTO noticia (not_descripcion,not_idDe,not_idusuario,not_fecha,not_visto,not_imagen,not_idrespuestaespesifi) VALUES ('$texto','$de1','$para1','$fechaactualHora','no','$imagen','$numrespuesta')";
            $DB->Execute($sql);  

echo$sql4 ="SELECT usu_tokpush FROM usuarios WHERE idusuarios = '$para1'";
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

        echo$sql2="SELECT usu_nombre FROM usuarios WHERE idusuarios='$de1'";
        $DB->Execute($sql2); 
        $nomuser=$DB->recogedato(0);
        // Para un solo token, si es para varios usar “registration_ids” en vez de “to”.
        $title='Nuevo mensaje de'.$nomuser;
        $message= $texto;
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

    

    $message.="No se ha recibido ningun archivo\n";
    $ok=0;
}



 

// if ($_FILES){
    
//     $cantidad= count($_FILES["file"]["tmp_name"]);
//     for ($i=0; $i<$cantidad; $i++){
//     //Comprobamos si el fichero es una imagen
//         if ($_FILES['file']['type'][$i]=='image/png' || $_FILES['file']['type'][$i]=='image/jpeg'){
//         //Subimos el fichero al servidor
//         move_uploaded_file($_FILES["file"]["tmp_name"][$i],"./imgMensajes/".$_FILES["file"]["name"][$i]);
//         $validar=true;
//         $tipoD='';

//         }elseif($_FILES['file']['type'][$i]=='application/pdf'){
//             move_uploaded_file($_FILES["file"]["tmp_name"][$i],"./imgMensajes/".$_FILES["file"]["name"][$i]);
//             $validar=true;
//             $tipoD='pdf';
//         }else
//          $validar=false;   
//     }
// }else{

    
// }




//  //Insertar imagenes se puede subir mas de dos imagenes.
//  if (isset($_FILES['file']) && $validar==true){ 
//     for ($i=0; $i<$cantidad; $i++){

//     echo "<h1>";  $imagen = $_FILES["file"]["name"][$i]; echo "</h1>";  

//     $sql=" INSERT INTO noticia (not_descripcion,not_idDe,not_idusuario,not_fecha,not_imagen,not_visto,not_respuesta,not_idrespuestaespesifi) VALUES ('$mensaje1','$de1','$para1','$fechaactualHora','$imagen','no','$tipoD','$idrespuestaespesifi')";
//     $DB->Execute($sql);

//  } 
// }



# devolvemos un json con la información
echo json_encode(array("ok"=>$ok,"message"=>$message));
?>
<link href="jquery.multiselect.css" rel="stylesheet" type="text/css">
<script src="jquery.min.js"></script>
<script src="jquery.multiselect.js"></script>
<script type="text/javascript">