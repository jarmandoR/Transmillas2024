<?php


require("connection/conectarse.php");
require("connection/funciones.php");
require("connection/arrays.php");
require("connection/funciones_clases.php");
require("connection/sql_transact.php");
require("connection/llenatablas.php");
// require("detalle_pop.php");

$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$FB = new funciones_varias;
$QL = new sql_transact;
$LT = new llenatablas;

// echo "MIRA tU GUIA";
$guia=$_GET['guia'];
$telefono=$_GET['telefono'];
// ser_telefonocontacto='$telefono' or	
$vsql1="SELECT cli_telefono FROM `serviciosdia`  WHERE  cli_telefono = '$telefono'";
$DB1->Execute($vsql1); 
$coiside=$DB1->recogedato(0);

if ($coiside!='') {
	$conde1="";
}else{$conde1="and ser_telefonocontacto = '$telefono'";}

 



$vsql="SELECT ser_estado,idservicios,ser_consecutivo  FROM `servicios`  WHERE  ser_consecutivo='$guia' $conde1 ";
$DB1->Execute($vsql); 
while($servi=mysqli_fetch_row($DB1->Consulta_ID))
{
 $estado=$servi[0];
 $desnoentr=$servi[2];

$sqlrecogida="SELECT ima_ruta,ima_tipo,idimagenguias from imagenguias where ima_idservicio=$servi[1] ";
					$DB1->Execute($sqlrecogida); 
					while($guiasi=mysqli_fetch_row($DB1->Consulta_ID))
					{

						if($guiasi[1]=='Recogida'){
							$recogidasg=$guiasi[0];
							$idimagenre=$guiasi[2];
						}elseif($guiasi[1]=='Entrega'){
							$entrgasg=$guiasi[0];
							$idimagenent=$guiasi[2];
						}

					}
					
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Trasnmillas</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="https://www.transmillas.com/assets/img/favicon.png" rel="icon">
  <link href="https://www.transmillas.com/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://www.transmillas.com/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://www.transmillas.com/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="https://www.transmillas.com/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="https://www.transmillas.com/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="https://www.transmillas.com/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="https://www.transmillas.com/assets/vendor/aos/aos.css" rel="stylesheet">
  

  <!-- Template Main CSS File -->
  <link href="https://www.transmillas.com/assets/css/style.css" rel="stylesheet">
  <link href="https://www.transmillas.com/assets/css/main.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="https://www.transmillas.com/assets/css/chatBot.css" rel="stylesheet" type="text/css"/>
  		<!-- iconos de face y yotube -->
	<link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">	 

<!-- End WOWSlider.com HEAD section  clase de estulos encabezado y menu -->  
	<link rel="stylesheet" href="https://www.transmillas.com/assets/css/encabezado.css">

  <!-- =======================================================
  * Template Name: Mamba - v2.0.1
  * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<?php
if ($estado!="") {
	# code...

?>	
 <div class="container">

        <div class="section-title">
          <h2></h2>
          <p></p>
        </div>
        <!-- <dbiv class="row"> -->

        	<?php
        	if ($estado==4) {
        	?>	
        	
        	<img src="imgrastreo/recogida.png" class="img-fluid" alt="" width="800" height="150" style="margin-left: auto;  margin-right:auto; display: block;">
        		<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
  
<table width="100%" border="1" cellspacing="0" cellpadding="6" >
<tbody>
<tr>
<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

</tr>



<!-- <tr>
<td>No se ha recogido</td>
</tr> -->
<tr><td><h2>✔️ Recogido</h2></td></tr>
<tr><td><?php
if($recogidasg!='')
					{
						
						echo "<a href='$recogidasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia recogida </a>";
						
						
	
					}

					?></td></tr>
<tr><td><?php

if($entrgasg!=''){
						
						echo "<a href='$entrgasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia entregada </a>";
					}
					?></td></tr>

</tbody>
</table>
  
</div>
            <?php
            $FB->llena_texto("Guia recogida",1,9, $DB, "", "","$rw[2]" ,1, 1);
        	}elseif ($estado==6 or $estado==14 ) {

        		?>	
        	
        	<img src="imgrastreo/enoficina.png" class="img-fluid" alt="" width="800" height="150" style="margin-left: auto;  margin-right:auto; display: block;">
        	<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
  
<table width="100%" border="1" cellspacing="0" cellpadding="6" >
<tbody>
<tr>
<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

</tr>
<tr>
<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

</tr>




<tr><td><h2>✔️ En oficina pesado</h2></td></tr>
<tr><td><?php
if($recogidasg!='')
					{
						
						echo "<a href='$recogidasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia </a>";
						
						
	
					}?>
						
</td></tr>

</tbody>
</table>
  
</div>
             <?php
        	}elseif ($estado==7 or $estado==12) {

        		?>	
        	
        	<img src="imgrastreo/enCaminoOfDes.png" class="img-fluid" alt="" width="800" height="150" style="margin-left: auto;  margin-right:auto; display: block;">
        	<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
  
<table width="100%" border="1" cellspacing="0" cellpadding="6" >
<tbody>
<tr>
<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

</tr>



<tr><td><h2>✔️ En camino a sede de destino</h2></td></tr>
<tr><td><?php
if($recogidasg!='')
					{
						
						echo "<a href='$recogidasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia recogida </a>";
						
						
	
					}

					?></td></tr>
<tr><td><?php

if($entrgasg!=''){
						
						echo "<a href='$entrgasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia entregada </a>";
					}
					?></td></tr>

</tbody>
</table>
  
</div>
        	 <?php
        	}elseif ($estado==8 or $estado==13) {

        		?>	
        	
        	<img src="imgrastreo/enOficinaDes.png" class="img-fluid" alt="" width="800" height="150" style="margin-left: auto;  margin-right:auto; display: block;">
        	<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
  
<table width="100%" border="1" cellspacing="0" cellpadding="6" >
<tbody>
<tr>
<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

</tr>




<tr><td><h2>✔️ En sede u oficina de destino</h2></td></tr>
<tr><td><?php
if($recogidasg!='')
					{
						
						echo "<a href='$recogidasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia recogida </a>";
						
						
	
					}

					?></td></tr>
<tr><td><?php

if($entrgasg!=''){
						
						echo "<a href='$entrgasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia entregada </a>";
					}
					?></td></tr>
</tbody>
</table>
  
</div>
        	 <?php
        	}elseif ($estado==9) {

        		?>	
        	
        	<img src="imgrastreo/enCaminoEntregar.png" class="img-fluid" alt="" width="800" height="150" style="margin-left: auto;  margin-right:auto; display: block;">
        	<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
  
<table width="100%" border="1" cellspacing="0" cellpadding="6" >
<tbody>
<tr>
<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

</tr>




<tr><td><h2>✔️ En camino para ser entregada</h2></td></tr>
<tr><td><?php
if($recogidasg!='')
					{
						
						echo "<a href='$recogidasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia recogida </a>";
						
						
	
					}

					?></td></tr>
<tr><td><?php

if($entrgasg!=''){
						
						echo "<a href='$entrgasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia entregada </a>";
					}
					?></td></tr>

</tbody>
</table>
  
</div>
        	 <?php
        	}elseif ($estado==10) {

        		?>	
        	
        	<img src="imgrastreo/entregado.png" class="img-fluid" alt="" width="800" height="150" style="margin-left: auto;  margin-right:auto; display: block;">

        	<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
  
<table width="100%" border="1" cellspacing="0" cellpadding="6" >
<tbody>
<tr>
<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

</tr>




<tr><td><h2>✔️Entregada</h2></td></tr>
<tr><td><?php
if($recogidasg!='')
					{
						
						echo "<a href='$recogidasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia recogida </a>";
						
						
	
					}

					?></td></tr>
<tr><td><?php

if($entrgasg!=''){
						
						echo "<a href='$entrgasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia entregada </a>";
					}
					?></td></tr>


</tr>
</tbody>
</table>
  
</div>
        	
        	 <?php 
        	  
        	}elseif ($estado==5) {

        		?>	
        	
        	<img src="imgrastreo/norecogida.png" class="img-fluid" alt="" width="800" height="150" style="margin-left: auto;  margin-right:auto; display: block;">

        	<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
  
<table width="100%" border="1" cellspacing="0" cellpadding="6" >
<tbody>
<tr>
<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

</tr>





<tr><td><h2>No se ha recogido </h2></td></tr>
<tr><td><?php
if($recogidasg!='')
					{
						
						echo "<a href='$recogidasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia recogida </a>";
						
						
	
					}

					?></td></tr>
<tr><td><?php

if($entrgasg!=''){
						
						echo "<a href='$entrgasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia entregada </a>";
					}
					?></td></tr>


	 <?php 
        	  
        	}elseif ($estado==18) {

        		?>	
        	
        	<img src="imgrastreo/guiaenreclamacion.png" class="img-fluid" alt="" width="800" height="150" style="margin-left: auto;  margin-right:auto; display: block;">

        	<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
  
<table width="100%" border="1" cellspacing="0" cellpadding="6" >
<tbody>
<tr>
<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

</tr>



<!-- <tr>
<td>No se ha recogido</td>
</tr> -->
<!-- <tr><td>✔️ Recogido</td></tr>
<tr><td>✔️ En oficina pesado</td></tr> -->
<!-- <tr><td>✔️ En ofocina</td></tr> -->
<!-- <tr><td>✔️ En camino a sede de destino</td></tr>
<tr><td>✔️ En sede u oficina de destino</td></tr> -->
<!-- <tr><td>✔️ En oficina pesado</td></tr> -->
<!-- <tr><td>✔️ En camino para ser entregada</td></tr> -->

<tr><td><h2>En reclamacion (abierta)</h2></td></tr>
<tr><td><?php
if($recogidasg!='')
					{
						
						echo "<a href='$recogidasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia recogida </a>";
						
						
	
					}

					?></td></tr>
<tr><td><?php

if($entrgasg!=''){
						
						echo "<a href='$entrgasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia entregada </a>";
					}
					?></td></tr>


	 <?php 
        	  
        	}elseif ($estado==19) {?>

	<img src="imgrastreo/guiaenreclamacion.png" class="img-fluid" alt="" width="800" height="150" style="margin-left: auto;  margin-right:auto; display: block;">

	        	<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
	  
	<table width="100%" border="1" cellspacing="0" cellpadding="6" >
	<tbody>
	<tr>
	<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

	</tr>
    <tr><td><h2>En reclamacion (conciliacion)</h2></td></tr>
		<tr><td><?php
		if($recogidasg!='')
					{
						
						echo "<a href='$recogidasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia recogida </a>";
						
						
	
					}

					?></td></tr>
		<tr><td><?php

		if($entrgasg!=''){
						
						echo "<a href='$entrgasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia entregada </a>";
					}
					?></td></tr>

	 






        	<?php 	
        	}elseif ($estado==20) {?>

        	<tr><td><h2>En reclamacion (abierta)</h2></td></tr>
<tr><td><?php
if($recogidasg!='')
					{
						
						echo "<a href='$recogidasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia recogida </a>";
						
						
	
					}

					?></td></tr>
<tr><td><?php

if($entrgasg!=''){
						
						echo "<a href='$entrgasg' target='_blank'>&nbsp;<i class='fa fa-camera-retro fa-lg'></i>&nbsp;Ver Foto Guia entregada </a>";
					}
					?></td></tr>


	 <?php
	}elseif ($estado=11) {


		 $nollego="SELECT ser_descentrega FROM serviciosdia where ser_consecutivo = '$desnoentr' ";

$DB->Execute($nollego);
$desno=$DB->recogedato(0); //por que no fue entregada la guia 
?>

<img src="imgrastreo/noentragada.png" class="img-fluid" alt="" width="800" height="150" style="margin-left: auto;  margin-right:auto; display: block;">

	        	<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
	  
	<table width="100%" border="1" cellspacing="0" cellpadding="6" >
	<tbody>
	<tr>
	<th><h1>Estado guia: <?echo$desnoentr;?></h1></th>

	</tr>
    <tr><td><h2>❌No entregada</h2></td></tr>
    <tr><td><h3><?echo$desno;?></h3></td></tr>


 <?php
	}
	?>



        		
        	
</tbody>
</table>
  
</div>




        	 
        	




        </div>
 <?php 
        	  
        	} ?>
         <!-- Vendor JS Files -->
  <script src="https://www.transmillas.com/assets/vendor/jquery/jquery.min.js"></script>
  <script src="https://www.transmillas.com/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://www.transmillas.com/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="https://www.transmillas.com/assets/vendor/php-email-form/validate.js"></script>
  <script src="https://www.transmillas.com/assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="https://www.transmillas.com/assets/vendor/venobox/venobox.min.js"></script>
  <script src="https://www.transmillas.com/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="https://www.transmillas.com/assets/vendor/counterup/counterup.min.js"></script>
  <script src="https://www.transmillas.com/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="https://www.transmillas.com/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="https://www.transmillas.com/assets/js/main.js"></script>