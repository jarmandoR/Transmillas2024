<script> 

function verifique(){

	alert("Numero de guia o telefono equivocado verifique e intente de nuevo ");
	window.location.href = "rastreocliente.php";
}
</Script>

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
$guia=$_POST['guia'];
$telefono=$_POST['telefono'];
// ser_telefonocontacto='$telefono' or	
// $vsql1="SELECT cli_telefono FROM `serviciosdia`  WHERE  cli_telefono = '$telefono'";
// $DB1->Execute($vsql1); 
// $coiside=$DB1->recogedato(0);

// if ($coiside!='') {
// 	$conde1="";
// }else{$conde1="and ser_telefonocontacto = '$telefono'";}

 $vsql="SELECT ser_estado,idservicios,ser_consecutivo,ser_telefonocontacto  FROM `servicios`  WHERE  ser_consecutivo='$guia' ";
$DB1->Execute($vsql); 
while($servi=mysqli_fetch_row($DB1->Consulta_ID))
{

	$estado=$servi[0];
	$desnoentr=$servi[2];

	if ($servi[3]== $telefono) {
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
	}else{

		$vsql1="SELECT cli_telefono FROM `serviciosdia`  WHERE  cli_telefono = '$telefono' and idservicios ='$servi[1]'";
		$DB1->Execute($vsql1); 
		$coiside=$DB1->recogedato(0);
		if ($coiside!='') {
			echo$sqlrecogida="SELECT ima_ruta,ima_tipo,idimagenguias from imagenguias where ima_idservicio=$servi[1] ";
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
		}else{
			
			echo"<script>verifique();</script>";
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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 
 

  
</head>

<?php
if ($estado!="") {
	# code...

?>	
<div class="card h-100 d-flex flex-column" id="chat2" >
          <div class="card-header  fixed-top d-flex justify-content-between align-items-center p-3" style="background-color: #154360; color: #ffffff; ">
          <!-- <img src="https://sistema.transmillas.com/imgUsuarios/<?php echo$fotousu; ?>" style="width:55px; height:55px; border-radius: 50% "> -->
              <h3 class="mb-0">Estado de la guia: <?echo$desnoentr;?></h3>
          
          
          </div>
		  <div class="card-body flex-grow-1 overflow-auto mt-4"   data-mdb-perfect-scrollbar="true"  style="margin-top: 5.5rem!important;" id="usuarios" >
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
			}elseif ($estado==11) {


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
			}elseif ($estado==201) {


				$nollego="SELECT ser_descentrega FROM serviciosdia where ser_consecutivo = '$desnoentr' ";

				$DB->Execute($nollego);
				$desno=$DB->recogedato(0); //por que no fue entregada la guia 
				?>

				<img src="imgrastreo/bodega.png" class="img-fluid" alt="" width="150px" height="150px" style="margin-left: auto;  margin-right:auto; display: block;">

			   	<div class="hscroll"style="margin-left: auto;  margin-right:auto; display: block;">
	 
				<table width="100%" border="1" cellspacing="0" cellpadding="6" >
				<tbody>
				<tr>
				

				</tr>
				<tr><td><h2>Se encuentra en bodega  </h2></td></tr>
				<tr><td><h3><?echo$desno;?></h3></td></tr>


				<?php
   			}
			?>



        		
        	
</tbody>
</table>
  
</div>




        	 
        	




        </div>


		
         
          
         
            
		    </div>
		</div>
			


 <?php 
        	  
        	} ?>
