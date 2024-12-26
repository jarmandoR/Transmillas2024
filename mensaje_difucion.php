<?php
require("login_autentica.php");
include("declara.php");
 $fechaactualHora =date("Y-m-d H:i:s");
include("layout.php");
$idUserA=$_SESSION['usuario_id'];
?>
<div class="container">

    <form id="signup" method='POST' enctype='multipart/form-data' >

        <div class="header">
        
            <h3>Mensaje de difucion</h3>
            
            
            
        </div>
        
        <div class="sep"></div>

        <div class="inputs">
        
            
        
       
        <input type='text'   name='mensaje'  placeholder='escriba aqui su mensaje' />
        
        
        
      
     
        
                
       
        <input type='file'  name='param500' value='' multiple/>
		<select name="rol" class='select'>

				
<option value='0'>Todos los roles</option>"
				<?php
				
		     echo  $sql="SELECT idroles, rol_nombre FROM roles ";
		 // echo "$id_nombre";
		$DB->Execute($sql); 
		  while($rw2=mysqli_fetch_row($DB->Consulta_ID))
		   {
			echo"<option value='$rw2[0]'>".$rw2[1]."</option>";

			}
				?>

				</select>

        <select name="ciudad" class='select'>
<option value='0'>Todas las ciudades</option>"
		<?php
				
		     echo  $sql="SELECT idsedes, sed_nombre FROM sedes where sed_principal ='si'";
		 // echo "$id_nombre";
		$DB->Execute($sql); 
		  while($rw3=mysqli_fetch_row($DB->Consulta_ID))
		   {
			echo"<option value='$rw3[0]'>".$rw3[1]."</option>";

			}
				?>

		</select>
       
          
       
        
        <button type='submit' id="submit"class='btn btn-danger' name='enviar' >Enviar</button></tr> 
            
            
        
        </div>

    </form>

</div>



<?php



$mensaje1 = $_POST["mensaje"]; 
$de1 = $_POST["de"];

 $fecha1 = $_POST["fecha"];
$rol = $_POST["rol"];
$ciudad = $_POST["ciudad"];

if(isset($_POST['mensaje'])){ 

if($rol==0 and  $ciudad==0 ){ $conde1=("usu_estado='1' ");
}elseif($rol==0 and  $ciudad!=0 ){$conde1=("  usu_idsede='$ciudad' and usu_estado ='1'");
}elseif($rol!=0 and  $ciudad==0 ){$conde1=("  roles_idroles= '$rol' and usu_estado ='1'");
}else{$conde1=("roles_idroles= '$rol' and  usu_idsede='$ciudad' and usu_estado ='1'");}

   echo $sql7="SELECT idusuarios,usu_tokpush FROM usuarios  where $conde1";
 // echo "$id_nombre";
$DB1->Execute($sql7); 
  while($rw2=mysqli_fetch_row($DB1->Consulta_ID))
  {
 //Insertar imagenes se puede subir mas de dos imagenes.
		
if (is_uploaded_file($_FILES['param500']['tmp_name'])){
		if ($_FILES['param500']['type']=='image/png' || $_FILES['param500']['type']=='image/jpeg'){

			move_uploaded_file($_FILES["param500"]["tmp_name"],"./imgMensajes/".$_FILES["param500"]["name"]);

		// $imagen = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['idc']).".jpg";
			$imagen = $_FILES["param500"]["name"]; 

	}elseif($_FILES['param500']['type']=='application/pdf'){
            move_uploaded_file($_FILES["param500"]["tmp_name"],"./imgMensajes/".$_FILES["param500"]["name"]);
            $imagen = $_FILES["param500"]["name"]; 
            $tipoD="pdf";

            }else{$tipoD='';}
   
		// move_uploaded_file($_FILES['param500']['tmp_name'], "./imgMensajes/".$imagen);
	 }else{
	 	
	 }		 

				// insertar mensaje.
				

				    

				        
				           $sql=" INSERT INTO noticia (not_descripcion,not_idDe,not_fecha,not_visto,not_idusuario,not_imagen) VALUES ('$mensaje1','$idUserA','$fechaactualHora','no','$rw2[0]','$imagen')";
				            $DB->Execute($sql);  
				        
// $sql4 ="SELECT usu_tokpush FROM usuarios WHERE idusuarios = '$para1'";
//         $DB1->Execute($sql4);     
//      $iddepe=$DB1->recogedato(0); 

// $severKey="SERVER_KEY";

if ($rw2[1]!='') {
				            	# code...
				          			            
$severKey="AAAArG5v458:APA91bFAocZ-skdsFXycEsyPZ0dupcaWvrIGo2wgEqM_rXr8pTvS7dmekiOS6DWOXJSRac9S73BnqFWKYMccUI2BcFdUQ6lRyn-kY8ghsdhzRhvlCcDPOp-JyAFUjBGhGirw5IXQhqFy";

$url="https://fcm.googleapis.com/fcm/send";



$prioridad="alta";

$icono="notificaciones/img/icon.png";



if($prioridad == 'alta'){
    $icono="images/logo2021.jpeg";
}


// Para un solo token, si es para varios usar “registration_ids” en vez de “to”.
$title='Nuevo mensaje de'.$de1;
$message= $mensaje1;
$field = array('to'=>$rw2[1], 'notification'=>array('title'=>$title, 'body'=>$message, 'icon'=>$icono));

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



				// include("layout.php");



				// include("declara.php");
				// $id_usuario=$_SESSION['usuario_id'];

				

			

}	
}		
?>
<style type="text/css">
​body {
    /*background-image: url(http://kreativo.se/backlogin.jpg);*/
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#8be8cf), color-stop(100%,#cdeb8b));
  
  
    font-family: "Helvetica Neue", Helvetica, Arial;
    padding-top: 20px;
}

.container {
    width: 406px;
    max-width: 406px;
    margin: 0 auto;
}

#signup {
    padding: 0px 25px 25px;
    background: #fff;
    box-shadow: 
        0px 0px 0px 5px rgba( 255,255,255,0.4 ), 
        0px 4px 20px rgba( 0,0,0,0.33 );
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    display: table;
    position: static;
}

#signup .header {
    margin-bottom: 20px;
}

#signup .header h3 {
    color: #333333;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 5px;
}

#signup .header p {
    color: #8f8f8f;
    font-size: 14px;
    font-weight: 300;
}

#signup .sep {
    height: 1px;
    background: #e8e8e8;
    width: 406px;
    margin: 0px -25px;
}

#signup .inputs {
    margin-top: 25px;
}

#signup .inputs label {
    color: #8f8f8f;
    font-size: 12px;
    font-weight: 300;
    letter-spacing: 1px;
    margin-bottom: 7px;
    display: block;
}

input::-webkit-input-placeholder {
    color:    #b5b5b5;
}

input:-moz-placeholder {
    color:    #b5b5b5;
}

#signup .inputs input[type=email], input[type=password], input[type=text], input[type=file] {
    background: #f5f5f5;
    font-size: 0.8rem;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    padding: 13px 10px;
    width: 330px;
    margin-bottom: 20px;
    box-shadow: inset 0px 2px 3px rgba( 0,0,0,0.1 );
    clear: both;
}
.select{
    background: #f5f5f5;
    font-size: 0.8rem;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    padding: 13px 10px;
    width: 330px;
    margin-bottom: 20px;
    box-shadow: inset 0px 2px 3px rgba( 0,0,0,0.1 );
    clear: both;
}

#signup .inputs input[type=email]:focus, input[type=password]:focus {
    background: #fff;
    box-shadow: 0px 0px 0px 3px #fff38e, inset 0px 2px 3px rgba( 0,0,0,0.2 ), 0px 5px 5px rgba( 0,0,0,0.15 );
    outline: none;   
}

#signup .inputs .checkboxy {
    display: block;
    position: static;
    height: 25px;
    margin-top: 10px;
    clear: both;
}

#signup .inputs input[type=checkbox] {
    float: left;
    margin-right: 10px;
    margin-top: 3px;
}

#signup .inputs label.terms {
    float: left;
    font-size: 14px;
    font-style: italic;
}

#signup .inputs #submit {
    width: 100%;
    margin-top: 20px;
    padding: 15px 0;
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 1px;
    text-align: center;
    text-decoration: none;
        background: -moz-linear-gradient(
        top,
        #b9c5dd 0%,
        #a4b0cb);
    background: -webkit-gradient(
        linear, left top, left bottom, 
        from(#b9c5dd),
        to(#a4b0cb));
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    border: 1px solid #737b8d;
    -moz-box-shadow:
        0px 5px 5px rgba(000,000,000,0.1),
        inset 0px 1px 0px rgba(255,255,255,0.5);
    -webkit-box-shadow:
        0px 5px 5px rgba(000,000,000,0.1),
        inset 0px 1px 0px rgba(255,255,255,0.5);
    box-shadow:
        0px 5px 5px rgba(000,000,000,0.1),
        inset 0px 1px 0px rgba(255,255,255,0.5);
    text-shadow:
        0px 1px 3px rgba(000,000,000,0.3),
        0px 0px 0px rgba(255,255,255,0);
    display: table;
    position: static;
    clear: both;
}

#signup .inputs #submit:hover {
    background: -moz-linear-gradient(
        top,
        #a4b0cb 0%,
        #b9c5dd);
    background: -webkit-gradient(
        linear, left top, left bottom, 
        from(#a4b0cb),
        to(#b9c5dd));
}
