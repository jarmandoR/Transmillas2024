<?php 
include("cabezote1.php"); 
include("cabezote4.php"); 
$id_sedes=$_SESSION['usu_idsede'];
$conde1="";
if(isset($_REQUEST["ord"])){ $ord=$_REQUEST["ord"]; } else { $ord="1"; } 
if(isset($_REQUEST["asc"])){ $asc=$_REQUEST["asc"]; } else {$asc="ASC"; } $asc2="ASC"; if($asc=="ASC"){ $asc2="DESC";}
?>
	<style type="text/css">



            /* .flotante {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #f1f1f1;
            width: 200px;
            height: 200px;
            cursor: move;
            } */
            .chat2 {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #f1f1f1;
            width: 200px;
            height: 200px;
            cursor: move;
            }

            /* Media query para tamaños de pantalla mayores a 768px */
            @media (min-width: 768px) {


                /* .chat {
                
                position: fixed;
                bottom: 0;
                right: 0;
                width: 400px;
                height: 500px;
                background-color: #fff;
                border: 1px solid #ccc;
                z-index: 9999;
                margin-bottom: 20px;
               background-color:  rgb(7, 79, 145);
                } */
                .chat {
                
                    position: fixed;;
                    bottom: 0;
                    right: 0;
                    background-color: #f1f1f1;
                    width: 400px;
                    height: 500px;
                    cursor: move;

                


                background-color: #fff;
                border: 1px solid #ccc;
                z-index: 9999;
                margin-bottom: 20px;
               background-color:  rgb(7, 79, 145);
                }


                #contenido{
                width: 400px;
                height: 500px;


                }


            /* .flotante {
          
                background-color: #ccc;
                width: 300px;
                height: 300px;
            } */
            #agrandar{
                background-color: #fff;
                /* float: right;   */
                display: none;
            }

            #minimizar{
                
                background-color: #fff;
                display: inline;
                float: right;
            }
            }


            @media (max-width: 768px) {
           

                .chat {
           
           position: fixed;
           bottom: 0;
           right: 0;
           width: 150px;
           height: 50px;
           background-color: #fff;
           border: 1px solid #ccc;
           z-index: 9999;
           margin-bottom: 20px;
           background-color:  rgb(7, 79, 145);
           }
           #contenido{
           width: 150px;
           height: 1px;

           }


           #agrandar{
                background-color: #fff;
                /* float: right;   */
       
            }

            #minimizar{
                
                background-color: #fff;
                display: none;
                float: right;
            }
            }


           
            #botones{
                background-color: rgb(7, 79, 145);
                /* float: right; */
                
            }

            .barra {
            cursor: move;
            position: absolute;
            top: 676px;
            left: 629;
            width: 150px;
            height: 50px;
            background-color: rgb(7, 79, 145);
            padding: 10px;
            }
            .barra2 {
            
            background-color: rgb(7, 79, 145);
            padding: 10px;
            
            }
          
            .bubble_chat {
                float: right;
                padding:2px 4px 2px 4px;
                background-color: rgb(7, 79, 145);
                color:white;
                font-weight:bold;
                font-size:0.80 em;
                border-radius:60px;
                box-shadow: 1px 1px 1px gray;
            }
            .notichat {
                float: right;
                padding:2px 4px 2px 4px;
                background-color: rgb(7, 79, 145);
                color:white;
                font-weight:bold;
                font-size:0.80 em;
                border-radius:60px;
                box-shadow: 1px 1px 1px gray;
            }
            #volver{

                float: right;
            }
         

			#header {
				margin:auto;
				width:500px;
				font-family:Arial, Helvetica, sans-serif;
			}
			
			ul, ol {
				list-style:none;
			}
			
			.nav > li {
				float:left;
			}
			
			.nav li a {
				background-color:#ecedef;
				text-decoration:none;
				padding:10px 12px;
				display:block;
			}
            .nav li a:hover {
				background-color:#f0f0f0;
			}
						
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
			}
			
			.nav li:hover > ul {
				display:block;
			}
			
			.nav li ul li {
				position:relative;
			}
			
			.nav li ul li ul {
				right:-140px;
				top:0px;
			}		 
             
            .noti_bubble {
                float: right;
                padding:2px 4px 2px 4px;
                background-color:red;
                color:white;
                font-weight:bold;
                font-size:0.80 em;
                border-radius:60px;
                box-shadow: 1px 1px 1px gray;
            }

		</style>
<script language="javascript">
function mostrarAlerta() {
    alert("¡Realice el preoperacional y espere un momento a que se habilite su sesion, si no se habilita Solicite ingreso al sistema!");
}

function llena_datosord(ord, asc)
{
	destino="<?php echo $_SERVER['PHP_SELF']; ?>?ord="+ord+"&asc="+asc;
	location.href=destino;
}
function llena_datosord2(ord, asc,tabla)
{
	destino="<?php echo $_SERVER['PHP_SELF']; ?>?ord="+ord+"&asc="+asc+"&tabla="+tabla;
	location.href=destino;
}
function  buscarnotificaciones(tipo){
    datos = {"tipo":tipo};
    var numerogastos;
		$.ajax({
				url: "notificaciones.php",
				type: "POST",
				data: datos,
				async: false,
				success: function(result) {
				//	alert(result);
					if(result!=null){
                       
						numerogastos= result.gastossede;
						numeroperador= result.gastosoperador;
						numeroremesas= result.gastosremesas;
						cierrecaja= result.cierrecaja;
						seguimiento= result.seguimiento;
						pendientes= result.pendientes;
						faltantes= result.faltantes;
						alertassede= result.alertassede;
					//	alert(numerogastos);
                    if(alertassede!='' && alertassede>0 ){
							var divvalor= document.getElementById("notif28");
                            divvalor.innerHTML='<div class="noti_bubble">'+alertassede+'</div>';

						}
                    if(faltantes!='' && faltantes>0 ){
							var divvalor= document.getElementById("notif27");
                            divvalor.innerHTML='<div class="noti_bubble">'+faltantes+'</div>';

						}
                    if(pendientes!='' && pendientes>0 ){
							var divvalor= document.getElementById("notif26");
                            divvalor.innerHTML='<div class="noti_bubble">'+pendientes+'</div>';
						}
                    if(seguimiento!='' && seguimiento>0 ){
							var divvalor= document.getElementById("notif25");
                            divvalor.innerHTML='<div class="noti_bubble">'+seguimiento+'</div>';
						}
						if(numerogastos!='' && numerogastos>0 ){
							var divvalor= document.getElementById("notif");
                            divvalor.innerHTML='<div class="noti_bubble">'+numerogastos+'</div>';
						}

                        if(numeroperador!='' && numeroperador>0 ){
							var divvalor2= document.getElementById("notif22");
                            divvalor2.innerHTML='<div class="noti_bubble">'+numeroperador+'</div>';
                        }
                        
                        if(numeroremesas!='' && numeroremesas>0 ){
							var divvalor3= document.getElementById("notif23");
                            divvalor3.innerHTML='<div class="noti_bubble">'+numeroremesas+'</div>';
						}
                        console.log(cierrecaja);
                        if(cierrecaja!='' && cierrecaja>0 ){
							var divvalor4= document.getElementById("notif24");
                            divvalor4.innerHTML='<div class="noti_bubble">'+cierrecaja+'</div>';
						}

                        trueorfalse=false;

					}else {
						trueorfalse=true;
					}	
				}
            });
           // console.log('josee111');
            clearTimeout(timer2);
    timer2=setTimeout(function(){buscarnotificaciones(tipo)},1200000); // 3000ms = 3s

}
</script>
<?php
       if ($nivel_acceso==1 or $nivel_acceso==6) {
        $controlDeUso="";
        $controlUsoMensaje='';

       } else{
        
        $sql="SELECT seg_motivo,seg_fechafinalizo from seguimiento_user where  seg_idusuario='$id_usuario' and seg_fechaingreso like '%$fechaactual%' order by seg_fechaingreso asc";
        $DB->Execute($sql); 
        $ingresoU=mysqli_fetch_row($DB->Consulta_ID);

        if ($ingresoU!="") {
            if ($ingresoU[0]=="Ingreso") {
                if ( is_null($ingresoU[1])) {
                    // echo"No ha salido";
                    $controlDeUso="";
                    $controlUsoMensaje='';

                }else{
                    if ($nivel_acceso==5 ) {
                        $controlDeUso="";
                        $controlUsoMensaje='';
                    }else{
                        $controlDeUso='style="pointer-events: none; opacity: 0.5;"';
                        $controlUsoMensaje='pointer-events: none; opacity: 0.5;';
                        echo'<script language="javascript">mostrarAlerta();</script>';
                     }
                }
                

            }else{
                $controlDeUso='style="pointer-events: none; opacity: 0.5;"';
                echo'<script language="javascript">mostrarAlerta();</script>';
                $controlUsoMensaje='pointer-events: none; opacity: 0.5;';
                // echo"___si__".$ingresoU[0];
            }
        }else{
            $controlDeUso='style="pointer-events: none; opacity: 0.5;"';
            echo'<script language="javascript">mostrarAlerta();</script>';
            $controlUsoMensaje='pointer-events: none; opacity: 0.5;';
            // echo"_____".$ingresoU[0];
        }
       }


        
?>
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <?php  if($nivel_acceso==1){
                                echo '<h4 class="modal-title"><i class="fa fa-user"></i> Edita tu perfil</h4>';
                        }
						
                        ?>
                    </div>
                   <?php 
					$sql="SELECT usu_nombre, usu_mail FROM usuarios WHERE idusuarios='$id_usuario' ";
					$DB->Execute($sql); 
					$rw1=mysqli_fetch_row($DB->Consulta_ID);



					?>
					<form name='form2' id='form2' method='post' action='nuevo_adminok.php' enctype='multipart/form-data'>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Nombre:</span>
                                    <input name="paramc1" id="paramc1" type="text" class="form-control" placeholder="Nombre" value="<?php echo $rw1[0]; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Email:</span>
                                    <input name="paramc2" id="paramc2" type="email" class="form-control" placeholder="Ingrese email" value="<?php echo $rw1[1]; ?>">
                                </div>
                            </div>
                            <div class="form-group"><p>Si quiere modificar su contrase&ntilde;a llene los siguientes campos.</p></div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Contrase&ntilde;a Actual:</span>
                                    <input name="paramc33" id="paramc33" type="password" class="form-control" placeholder="*****">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Contrase&ntilde;a Nueva:</span>
                                    <input name="paramc3" id="paramc3" type="password" class="form-control" placeholder="******">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-success btn-file">
                                    <i class="fa fa-paperclip"></i> Foto de perf&iacute;l
                                    <input type="file" name="paramc4" />
                                </div>
                                <p class="help-block">Tama&ntilde;o: 215px x 215px</p>
                            </div>
                        </div>
                        <div class="modal-footer clearfix">
                           <?php $FB->llena_texto("tabla", 1, 13, $DB, "", "", "Edita tu perfil", 5, 0); ?>
                           <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Descartar</button>
                           <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Guardar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    <body class="skin-blue">

        <header  class="header">
            <a href="inicio.php" class="logo">Inicio</a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div   class="navbar-right">
                    <ul class="nav navbar-nav">
                    <?php 

                        $sqlnomina = "SELECT  count(*) from nomina where nom_id_usu='$id_usuario' and (nom_confirmaUsu='' or nom_confirmaUsu='no' ) and nom_cuentaCobro IS NOT NULL ";
                        $DB1->Execute($sqlnomina); 
                        $nominaspendientes=$DB1->recogedato(0);
                        ?>
                        <li >
                            <a href="mispagos.php" ><i class="glyphicon glyphicon-usd"></i><span>Mis pagos
                                <i id='mispagos' >
                                
                                        <div class="noti_bubble"><i ><?=$nominaspendientes?></i></div>
                                </i>
                                </span>
                            </a>
                        </li> 
                        <?php 
                    if($nivel_acceso==1){
                        $DB_m = new DB_mssql;
                        $DB_m->conectar();
                        $DB_m1 = new DB_mssql;
                        $DB_m1->conectar();
                        $DB_m2 = new DB_mssql;
                        $DB_m2->conectar();

                       $numerocomfirmar=0;
                        $gatoscomfirmar=0;
                        $remesascomfirmar=0;
                        $cierrecaja=0;
                        if($gatoscomfirmar>=1){
                            $colornoti2='background-color:#FF0000';
                        }else{
                            $colornoti2='';
                        }


                        $fechaIni = $fechaactual." 00:00:00";
                        $fechaFin = $fechaactual." 23:59:59";
                        $sql1 = "SELECT count(*) FROM usuarios WHERE  (usu_estado=1 and usu_filtro=1) and idusuarios NOT IN (SELECT  preidusuario FROM `pre-operacional` where  prefechaingreso>='$fechaIni' and prefechaingreso<='$fechaFin' ) and roles_idroles!='6' ORDER BY `idusuarios`  DESC ";
                        $DB1->Execute($sql1); 
                        $sinIngreso=$DB1->recogedato(0);
                        // if($sinIngreso>=1){
                        //     $colornot='background-color:#FF0000';
                        // }else{
                        //     $colornot='';
                        // }


                        ?>

                        <li <?php echo$controlDeUso; ?>>
                            <a href="seguimientouser.php" ><i class="glyphicon glyphicon-bell"></i><span>👥 Sin ingreso 
                                <i id='notif230' >
                                
                                        <div class="noti_bubble"><i ><?=$sinIngreso?></i></div>
                                </i>
                                </span>
                            </a>
                         </li>
                        <li <?php echo$controlDeUso; ?>>
                            <a href="faltantes.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Faltantes 
                                <i id='notif27'>
                                        <?=$flatantes?>
                                </i>
                                </span>
                            </a>
                         </li>
                          <li <?php echo$controlDeUso; ?>>
                            <a href="pesopendiente.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Pendientes 
                                <i id='notif26'>
                                        <?=$pendientes?>
                                </i>
                                </span>
                            </a>
                         </li>
                         <li <?php echo$controlDeUso; ?>>
                            <a href="reporteoper.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Seguimiento 
                                <i id='notif25'>
                                        <?=$seguimiento?>
                                </i>
                                </span>
                            </a>
                         </li>
                          <li <?php echo$controlDeUso; ?>>
                                <a href="cierrecaja.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Cierre 
                                    <i id='notif24'>
                                            <?=$cierrecaja?>
                                    </i>
                                    </span>
                                </a>
                             </li>
                           <li <?php echo$controlDeUso; ?>>
                                <a href="gastos.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Remesas 
                                    <i id='notif23'>
                                            <?=$remesascomfirmar?>
                                    </i>
                                    </span>
                                </a>
                             </li>
                            <li <?php echo$controlDeUso; ?>>
                                <a href="gastosoperador.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Gatos 
                                    <i id='notif22'>
                                            <?=$gatoscomfirmar?>
                                    </i>
                                    </span>
                                </a>
                             </li>

                                <li <?php echo$controlDeUso; ?>>
                                    <a href="cajamenor.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Confirmar 
                                        <i id='notif' >
                                                        <?=$numerocomfirmar?>
                                        </i>
                                        </span>
                                    </a>
                                </li>
                        
  
                        <?php 
                        }elseif($nivel_acceso==2 or $nivel_acceso==5){

                            ?>

                            <li <?php echo$controlDeUso; ?>>
                            <a href="pesopendiente.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Pendientes 
                                <i id='notif26'>
                                        <?=$pendientes?>
                                </i>
                                </span>
                            </a>
                         </li>
                            <li <?php echo$controlDeUso; ?>>
                            <a href="reporteoper.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Seguimiento 
                                <i id='notif25'>
                                        <?=$seguimiento?>
                                </i>
                                </span>
                            </a>
                         </li>

                         <?php 
                         } elseif($nivel_acceso==9){
                            

                            ?>

                             <li id="noti_Container" <?php echo$controlDeUso; ?>>
                                <a href="faltantes.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Faltantes 
                                    <i id='notif27'>
                                            <?=$faltantes?>
                                    </i>
                                    </span>
                                </a>
                             </li>
                             <?php      
                         }elseif($nivel_acceso==3){
                            

                            ?>

                            <li >
                                <a href="gastos.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Remesas 
                                    <i id='notif23'>
                                            <?=$remesascomfirmar?>
                                    </i>
                                    </span>
                                </a>
                             </li>
                             <?php      
                         } elseif($nivel_acceso==10){  

                            ?>
   
                            <li <?php echo$controlDeUso; ?>>
                                <a href="reportealertas.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Alertas 
                                    <i id='notif28'>
                                            <?=$alertassede?>
                                    </i>
                                    </span>
                                </a>
                             </li>   
                            <li <?php echo$controlDeUso; ?>>
                                <a href="faltantes.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Faltantes 
                                    <i id='notif27'>
                                            <?=$faltantes?>
                                    </i>
                                    </span>
                                </a>
                             </li>
                             <li <?php echo$controlDeUso; ?>>
                            <a href="pesopendiente.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Pendientes 
                                <i id='notif26'>
                                        <?=$pendientes?>
                                </i>
                                </span>
                            </a>
                         </li>
                             <li <?php echo$controlDeUso; ?>>
                                <a href="cierrecaja.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Cierre 
                                    <i id='notif24'>
                                            <?=$cierrecaja?>
                                    </i>
                                    </span>
                                </a>
                             </li>
                             <?php 
                         } elseif($nivel_acceso==12){
                            

                            ?>

                            <li <?php echo$controlDeUso; ?>>
                                    <a href="seguimientouser.php" ><i class="glyphicon glyphicon-bell"></i><span>👥 Sin ingreso 
                                        <i id='notif230' >
                                        
                                                <div class="noti_bubble"><i ><?=$sinIngreso?></i></div>
                                        </i>
                                        </span>
                                    </a>
                            </li>
                              <li <?php echo$controlDeUso; ?> >
                                <a href="reportealertas.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Alertas 
                                    <i id='notif28'>
                                            <?=$alertassede?>
                                    </i>
                                    </span>
                                </a>
                             </li>
                             <li <?php echo$controlDeUso; ?> >
                            <a href="pesopendiente.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Pendientes 
                                <i id='notif26'>
                                        <?=$pendientes?>
                                </i>
                                </span>
                            </a>
                         </li>
                            <li <?php echo$controlDeUso; ?> >
                            <a href="reporteoper.php?idmen=194" ><i class="glyphicon glyphicon-bell"></i><span>Seguimiento 
                                <i id='notif25'>
                                        <?=$seguimiento?>
                                </i>
                                </span>
                            </a>
                         </li>    
                         <?php 
                         } 
    
                          
                           echo '<li '.$controlDeUso.' ><a >Estado '.$estado.'<i class="caret"></a></i>
                                    <ul>
                                        
                                        <li><a href="cambio_adminok.php?tabla=cambioestado&condecion=almuerzo">Almorzando</a></li>
                                        <li><a href="cambio_adminok.php?tabla=cambioestado&condecion=regreso">Regreso Almuerzo</a></li>
                                        <li><a href="cambio_adminok.php?tabla=cambioestado&condecion=regresooficina">Regreso Oficina</a></li>';
                                      echo "<li><a onclick='pop_dis56(1,\"Salida\")'; >Salida</a></li>";
                                        
                                 echo '</ul>
                                 </li>';
                            echo "<li $controlDeUso >";
                            echo "<a  onclick='pop_dis55(1, \"Cotizar\")'; > Cotizar</a>";
                             echo "</li>";
                             if($nivel_acceso==1 or $nivel_acceso==5 or $nivel_acceso==10){

                                 echo "<li $controlDeUso >";
                                     echo "<a  onclick='pop_dis57(1, \"Cuentas\")'; > Cuentas</a>";
                                 echo "</li>";

                             }elseif($id_sedes==1 and $nivel_acceso==2){

                                echo "<li $controlDeUso>";
                                     echo "<a  onclick='pop_dis57(1, \"Cuentas\")'; > Cuentas</a>";
                                echo "</li>";
                             }
                        ?>

                        <li  class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i><span>Perfil <i class="caret"></i></span></a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
<?php 
$DB_m = new DB_mssql;
$DB_m->conectar();
$DB_m1 = new DB_mssql;
$DB_m1->conectar();
$DB_m2 = new DB_mssql;
$DB_m2->conectar();
$sles="SELECT doc_ruta FROM documentos WHERE doc_tabla='Usuario' AND doc_idviene='$id_usuario' ORDER BY doc_fecha DESC ";
$DB_m->Execute($sles); 
$imagenusu=$DB_m->recogedato(0);
$nombre=explode(" ",$id_nombre);
?>
<img src="<?php echo $imagenusu; ?>" class="img-circle" alt="User Image" />
<p><?php print $id_nombre; ?><small><?php echo $rol_nombre; ?></small></p>

                                </li>                                
                                <li class="user-footer">
                                    <div class="pull-left">
                                    <?php  if($nivel_acceso==1){
                                    	echo '<a class="btn btn-default btn-flat" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Editar Perfil</a>';
                                    }
                                    ?>
                                    </div>
                                    <div class="pull-right">
                                        <a href="salir.php" class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

            <aside class="left-side sidebar-offcanvas" style="min-height:550px;">
                <section  class="sidebar" >
                    <div class="user-panel">
                        <div class="pull-left image"><img src="<?php echo $imagenusu; ?>" class="img-circle" alt="User Image" /></div>
                        <div class="pull-left info"><p>Hola, <?php print $nombre[0]." ".$nombre[1];   ?></p>
						 <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a></div>
                    </div>
                    <ul class="sidebar-menu">
<?php
if($id_sedes==1){
$condeno='';
}else{
    $condeno=" and men_url not in ('telefonosweb.php')"; 
}

 $sql="SELECT men_nombre, men_url, idmenu, men_descripcion FROM menu INNER JOIN permisos ON idmenu=menu_idmenu AND men_predecesor=0 AND roles_idroles='$nivel_acceso' AND men_orden!=0 AND per_consultar=1 $condeno ORDER BY men_orden ";
$DB_m->Execute($sql); $va=0;
while($rw_m=mysqli_fetch_row($DB_m->Consulta_ID))
{
	$id_menu=$rw_m[2]; if($rw_m[1]=="configuracion.php") { $link="#"; $class="treeview"; } else { $link=$rw_m[1];  $class="sidebar-menu"; } 
	
    
    if($link=="telefonosweb.php" ){
         $sql2="SELECT count(*) FROM `telefonospagina` WHERE  tel_estado = 'Sin validar' ";
         $DB_m2->Execute($sql2);
         $ntele=mysqli_fetch_row($DB_m2->Consulta_ID);

         echo "<li class='$class'><a href='$link' title='$rw_m[3]'>";
         $LT->llenadocs1($DB_m1, "Menu", $id_menu, 1, 15, 1);
         echo "<span> $rw_m[0] ";
      //  echo '<font color="Red" face="Comic Sans MS,arial">';
          echo ' <div class="noti_bubble">'.$ntele[0].'</div>';
        // echo '<i class="img-circle" style="background-color:#FF0000;width:160px;height:80px" > '.$ntele[0].' </i>';
         echo "</span> </a>";
     }else if($link=="vertareas.php" ){  
        if($nivel_acceso==1 or $nivel_acceso==12 ){
            $sql1="SELECT count(*)  FROM `tareas` LEFT JOIN (select `pro_comentario`, `pro_fecha`, `usu_nombre`,(CASE WHEN pro_estado IS Null THEN 'Por Realizar' else pro_estado END) as estado,pro_idtareas from programartareas left join usuarios on idusuarios=pro_idusuario where pro_fecha like '%$fechaactual%' ) t1 ON t1.pro_idtareas=idtareas WHERE idtareas>=0 and tar_diassemana like '%$dia%' and  tar_idsede='$id_sedes' and tar_estado='Activo'  and (CASE WHEN t1.estado IS Null THEN 'Por Realizar' else t1.estado END)='Por Realizar' ORDER BY idtareas asc";

        }else{
            $sql1="SELECT count(*)  FROM `tareas` LEFT JOIN (select `pro_comentario`, `pro_fecha`, `usu_nombre`,(CASE WHEN pro_estado IS Null THEN 'Por Realizar' else pro_estado END) as estado,pro_idtareas from programartareas left join usuarios on idusuarios=pro_idusuario where pro_fecha like '%$fechaactual%'  ) t1 ON t1.pro_idtareas=idtareas WHERE idtareas>=0 and tar_diassemana like '%$dia%' and ((tar_idoperario='$id_usuario') or (tar_idoperario='0' and tar_idsede is NUll and tar_idrol='$nivel_acceso') or (tar_idoperario='0' and tar_idrol is NUll and tar_idsede='$id_sedes') or (tar_idoperario='0' and tar_idrol='$nivel_acceso' and tar_idsede='$id_sedes')) and tar_estado='Activo'  and (CASE WHEN t1.estado IS Null THEN 'Por Realizar' else t1.estado END)='Por Realizar' ORDER BY idtareas asc";
        }
        $DB1->Execute($sql1); 
        $cantAlertas=$DB1->recogedato(0);
                echo "<li $controlDeUso class='$class'><a href='$link' title='$rw_m[3]'>";
                $LT->llenadocs1($DB_m1, "Menu", $id_menu, 1, 15, 1);
                echo "<span > $rw_m[0] ";
          echo ' <div class="noti_bubble">'.$cantAlertas.'</div>';
         echo "</span>
         </a>";
     }
     else if($link=="reportealertas.php" ){  
        $sql1 = "SELECT count(*) as sede FROM `reportealertas` inner join sedes on rep_idsede=idsedes WHERE idreportealertas>=0 and idsedes=$id_sedes  and rep_fechavencimiento<='$fechaactual' ";
        $DB1->Execute($sql1); 
        $cantAlertas=$DB1->recogedato(0);
                echo "<li $controlDeUso class='$class'><a href='$link' title='$rw_m[3]'>";
                $LT->llenadocs1($DB_m1, "Menu", $id_menu, 1, 15, 1);
                echo "<span > $rw_m[0] ";
          echo ' <div class="noti_bubble">'.$cantAlertas.'</div>';
         echo "</span>
         </a>";
     }else if($link=="reclamos.php" ){  
        $sql1 = "SELECT count(*) FROM `reclamos` inner join servicios on rec_idservicio=idservicios WHERE idreclamos>0 and `rec_estado`= 'Confirmar' ORDER BY idreclamos";

        // $sql1 = "SELECT count(rec_tipo) FROM `reclamos` WHERE rec_estado='confirmar' ";
        $DB1->Execute($sql1); 
        $reclamos=$DB1->recogedato(0);
                echo "<li $controlDeUso class='$class'><a href='$link?param34=Confirmar' title='$rw_m[3]'>";
                $LT->llenadocs1($DB_m1, "Menu", $id_menu, 1, 15, 1);
                echo "<span > $rw_m[0] ";
          echo ' <div class="noti_bubble">'.$reclamos.'</div>';
         echo "</span>
         </a>";
     }
     else if($link=="salaChats3.php" ){
        $sql1 = "SELECT count(*) FROM `noticia` WHERE not_idusuario='$id_usuario' and  not_visto='no' and not_deChat = '' ";
        $DB1->Execute($sql1); 
        $cantMensajes=$DB1->recogedato(0);
                echo "<li $controlDeUso class='$class'><a href='$link' title='$rw_m[3]'>";
                $LT->llenadocs1($DB_m1, "Menu", $id_menu, 1, 15, 1);
                echo "<span > $rw_m[0] ";
          echo ' <div class="noti_bubble"><i id = "span">'.$cantMensajes.'</i></div>';
         echo "</span>
         </a>";

 }else if($link=="chatTransmillas.php" ){
    $sql1 = "SELECT COUNT(*)FROM `salasChatTransmillas` WHERE sl_id_deReceptor ='$id_usuario'and sl_numMensajes='1' ";
    $DB1->Execute($sql1); 
    $numMensajes=$DB1->recogedato(0);
    echo'<input type="hidden"  id="mensajesN" value="'.$numMensajes.'">';
            echo "<li $controlDeUso class='$class'><a href='$link' title='$rw_m[3]'>";
            $LT->llenadocs1($DB_m1, "Menu", $id_menu, 1, 15, 1);
            echo "<span > $rw_m[0] ";
      echo ' <div class="notichat" id="notichat">'.$numMensajes.'</div>';
     echo "</span>
     </a>";
     

}else if($link=="confirmacioncambios.php" && $id_sedes==1){
    $sql1 = "SELECT count(*) FROM `modificaciones` WHERE mod_userverificado='' ";
    $DB1->Execute($sql1); 
    $canttrancambios=$DB1->recogedato(0);
            echo "<li $controlDeUso class='$class'><a href='$link' title='$rw_m[3]'>";
            $LT->llenadocs1($DB_m1, "Menu", $id_menu, 1, 15, 1);
            echo "<span > $rw_m[0] ";
      echo ' <div class="noti_bubble">'.$canttrancambios.'</div>';
     echo "</span>
     </a>";

}else if($link=="confirmacionpagos.php" ){
    $sql1 = "SELECT count(*) FROM `pagoscuentas` WHERE pag_userverifica='' and pag_tipopago!=''";
    $DB1->Execute($sql1); 
    $canttranferencias=$DB1->recogedato(0);
            echo "<li $controlDeUso class='$class'><a href='$link' title='$rw_m[3]'>";
            $LT->llenadocs1($DB_m1, "Menu", $id_menu, 1, 15, 1);
            echo "<span > $rw_m[0] ";
      echo ' <div class="noti_bubble">'.$canttranferencias.'</div>';
     echo "</span>
     </a>";

}
  else{

        if($link=="confirmacioncambios.php" ){}
        elseif($link=="confirmacioncambios.php" and $nivel_acceso==3){
            
        }
        else{
            echo "<li $controlDeUso class='$class'><a href='$link' title='$rw_m[3]'>";
            $LT->llenadocs1($DB_m1, "Menu", $id_menu, 1, 15, 1);
            echo "<span> $rw_m[0]</span></a>";
        }
     }


 

    echo "<ul class='treeview-menu'>";
	 $sql="SELECT men_nombre, men_url, idmenu, men_descripcion FROM menu INNER JOIN permisos ON idmenu=menu_idmenu AND men_predecesor='$id_menu' AND 
	roles_idroles='$nivel_acceso' AND men_orden!=0 AND per_consultar=1 ORDER BY men_orden ";
	$DB_m1->Execute($sql); 
	while($rw_m1=mysqli_fetch_row($DB_m1->Consulta_ID))
	{
		if(strlen($rw_m1[0])>22){ $texts=substr($rw_m1[0],0,22)."...";  } else { $texts=$rw_m1[0]; } 
	
        $general = explode('?',$rw_m1[1]);
		if($general[0] =='adm_general.php'){ 

            if ($general[1] == '') {
	        	echo "<li><a href='$rw_m1[1]?idmen=$rw_m1[2]&tabla=$rw_m1[0]' title='$rw_m1[0]'><i class='fa fa-angle-double-right'></i>$texts</a></li>"; 
            } else {
	        	echo "<li><a href='$rw_m1[1]&idmen=$rw_m1[2]&tabla=$rw_m1[0]' title='$rw_m1[0]'><i class='fa fa-angle-double-right'></i>$texts</a></li>"; 
            }
    }
		else{
			echo "<li><a href='$rw_m1[1]?idmen=$rw_m1[2]' title='$rw_m1[0]'><i class='fa fa-angle-double-right'></i>$texts</a></li>"; 
		}
	
	} 
	echo "</ul></li>";
	$va++;
} 



// if ($numMensajes <= 1) {
// echo"es mayor ";
//     $colordeMensaje='style="backgroundColor: #FF0000; "  ';
//     $colordeMensajeMenu='style="backgroundColor: #FF0000; "  ';

// }else{

//     $colordeMensaje='style="backgroundColor:#074f91; "  ';
//     $colordeMensajeMenu='style="backgroundColor:#074f91; "  ';
    
//     echo"No es mayor ";
// }
?>

</ul></section></aside>
<aside class="right-side" style="min-height:550px;"  > 

<!-- DIV DEL CHAT FLOTANTE DE MENSAJES -->

<!-- <div id="miDiv" class="flotante">Contenido del div flotante</div> -->
<input type="hidden"  id="usuEmisor" value="<?php echo$id_usuario; ?>" >


<div class="chat"  id="chat" style=" border: 1px solid; border-radius: 10px; <?php echo$controlUsoMensaje;?> " >
<div class="barra2" id="barra2" style="  border-radius: 10px; " >
   


   <button onclick="grande()" id="agrandar">
   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
   <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
   </svg></button>
   <button onclick="mini(<?php echo$id_usuario; ?>)" id="minimizar">
   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
   <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
   </svg>
   </button>
   <!-- <div class="bubble_chat" id="burbuja" <?echo$colordeMensaje;?> ><?echo$numMensajes;?> mensajes</div> -->
   <div class="bubble_chat" id="burbuja"></div>



</div>
  <iframe id="contenido" src="https://transmillas.com/chatPruebas/salaChats.php?id=<?php echo$id_usuario; ?>" ></iframe>
</div>

<!-- <div class="chat2"  id="chat2" >
    HOLAA
</div> -->
<!-- <div class="barra" id="barra" style=" border: 1px solid; border-radius: 10px;">
   
        

        <button onclick="grande()" id="agrandar">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
        <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
        </svg></button>
        <button onclick="mini()" id="minimizar">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
        </svg>
        </button>
        <div class="bubble_chat" id="burbuja">0 Mensajes</div>
  
    
   
    
  </div> -->
<?php
    if($nivel_acceso==1 or $nivel_acceso==2 or $nivel_acceso==10  or $nivel_acceso==12 or $nivel_acceso==5 ){
    ?>
<script language="javascript">
    timer2=0;
    clearTimeout(timer2);
     buscarnotificaciones(1); // 3000ms = 3s
    </script>
    <?php
    } 

    ?>
    <script type="text/javascript">
        
function cantMen() {

        //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX    
        var time = $.ajax({
            type: 'POST',
            // data: {idPro : $('#idChat').val()},
            url: 'consultaNch.php', //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
        }).responseText;

        //actualizamos el div que nos mostrará la hora actual
        document.getElementById("span").innerHTML = ""+time;
        if(time!='0'){
            mostrarToast(time);
        }
        

    }

// }
cantMen(); 
//setInterval(cantMen,30000);


	function buscarservicio(valor, valor2, valores3, valor4, valor5=null) {
      //  alert(valores3);
		var ruta = "param20="+valor+"&param21="+valor2+"&paramtipser="+valores3+"&cro="+valor4+"&idservicio="+valor5;
		$.ajax({

			url: 'detalle_recoleccioncomprarecogida.php',
			type: 'Get',
			data: ruta,
		}).done(function(res) {

			$('#respuesta').html(res)
		});
	}

    function precioconvenir(valor,valor1,valor2,valor3) {

        if(valor1==1000){
            var ruta = "cond="+valor+"&param1="+valor1+"&para="+valor2+"&nombre="+valor3;
            $.ajax({

                url: 'resultados1.php',
                type: 'Get',
                data: ruta,
            }).done(function(res) {

                $('#convenir').html(res)
            });
        }else{
            $('#convenir').html('');
        }
    }







        const chat = document.querySelector('.chat');
        const agrandarBtn = document.getElementById('agrandar');
        const minimizarBtn = document.getElementById('minimizar');
        const contenido = document.getElementById('contenido');
        

         function grande(){
        // chat.classList.add('agrandado');
        chat.style.display = 'inline';
        chat.style.width = '400px';
        chat.style.height = '500px';
        contenido.style.width = '400px';
        contenido.style.height = '500px';
        agrandarBtn.style.display = 'none';
        minimizarBtn.style.display = 'inline';
        colocarEnEsquina();
        // contenido.contentWindow.location.reload();
       

        
        };

         function mini(idusu){
        // chat.classList.remove('agrandado');

        // chat.style.display = 'none';
        chat.style.width = '150px';
        chat.style.height = '50px';
        minimizarBtn.style.display = 'none';
        agrandarBtn.style.display = 'inline';
        contenido.style.width = '150px';
        contenido.style.height = '0px';
        
        contenido.setAttribute('src', 'https://transmillas.com/chatPruebas/salaChats.php?id='+idusu+'');
        colocarEnEsquina();
        // contenido.style.display = "none";

        }
    </script>

<?php

///////////////////////////////////////////////////para las notificaciones en tiempo real de mensajes///////////////////////////////////



    // $DB1->Execute($sql1); 
    // echo"CANT MEN".$TotalMenNu=$DB1->recogedato(0);
    

// $url  ='http://localhost/chat1/';
// $url  ='https://transmillas.com/chatPruebas/';
?>
 <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.22.0/firebase-messaging.js"></script>
    <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
  
<script>
        
const firebaseConfig = {
  apiKey: "AIzaSyCbIQB4aoxjD_AdZPenYkobDsv55UUo33g",
  authDomain: "chattransmillas.firebaseapp.com",
  projectId: "chattransmillas",
  storageBucket: "chattransmillas.appspot.com",
  messagingSenderId: "296893197753",
  appId: "1:296893197753:web:bb8340472819ee15375a68",
  measurementId: "G-ZCDP31CLF2"
};

  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
 



  var database = firebase.database();
//   console.log('Datos escritos en la base de datos correctamente.');
  
// Consulta los datos de la tabla "usuarios" una vez
// database.ref('mensajes').once('value')
//   .then(function(snapshot) {
//     // Maneja los datos obtenidos
//     var usuarios = snapshot.val();
//     console.log('Datos de usuarios:', usuarios);
//   })
//   .catch(function(error) {
//     console.error('Error al consultar la base de datos:', error);
//   });
// Intenta escribir datos en la base de datos
// database.ref('salasC').set({
//   message: 'Conexión exitosa!'
// }, function(error) {
//   if (error) {
//     console.error('Error al escribir en la base de datos:', error);
//   } else {
//     console.log('Datos escritos en la base de datos correctamente.');
//   }
// });


var Mensajes = 0;
Mensajes = document.getElementById('mensajesN').value;
let contMensajes = 0;
// Mensajes = document.getElementById('mensajesN').value;
// if (contMensajes === "") {
//      contMensajes = 0;

// }else{

//      contMensajes = parseInt(contMensajes);
//     // contMensajes = contMensajes;
// }

let idemisor = document.getElementById('usuEmisor').value;
const divElement = document.getElementById("burbuja");
const divnotimenu = document.getElementById("notichat");


// if (contMensajes>0) {
//                     divElement.style.backgroundColor = "red";
//                     // divnotimenu.style.backgroundColor = "red";
//                 }else{
                
//                     divElement.style.backgroundColor = "#074f91";
//                     // divnotimenu.style.backgroundColor = "#074f91";
                    

//}


var anterior = 0; 



//NUEVO contMensajesEO DE MENSAJES

 firebase.database().ref("salasChat").orderByChild("slrecep").equalTo(idemisor).on("child_added", function(snapshot) {
//   console.log('MEN'+snapshot.val().fecha);
//   if (snapshot.val().idReceptor === idEmisor ) {


    if (snapshot.val().numMensajes === "1" && snapshot.val().slrecep === idemisor  ) {

        reproducirSonido();
        Mensajes = Mensajes + 1;
        // anterior = contMensajes;
        // contMensajes = contMensajes+1;
        if (Mensajes > 0) {
            divElement.style.backgroundColor = "red";
             divnotimenu.style.backgroundColor = "red";
        }

        divElement.innerHTML = ""+Mensajes+" mensajes";
        // divnotimenu.innerHTML = ""+Mensajes;
         
         console.log("llego un nuevo Chat");
        // divElement.innerHTML = divElement.innerHTML.replace(anterior, contMensajes);
        // divnotimenu.innerHTML = divnotimenu.innerHTML.replace(anterior, contMensajes);


       
}

// Realiza la consulta a Firebase Realtime Database

//   if (snapshot.exists()) {
//     const data = snapshot.val();
//     // Guarda los datos en la caché del navegador utilizando localStorage
//     localStorage.setItem("datosSalasDeChatnoti", JSON.stringify(data));
//     // Realiza las operaciones necesarias con los datos obtenidos
//     console.log(data);
//   } else {
//     console.log("No se encontraron datos en la base de datos.");
//   }
//   }

  });
firebase.database().ref("salasChat").on("child_changed", function(snapshot) {
        // console.log('MEN'+snapshot.val().fecha);
    if (snapshot.val().slrecep === idemisor) {


        
        
        if (snapshot.val().slNummen === "" ) {

            if (Mensajes > 0) {
                Mensajes = Mensajes - 1;
            
            // divnotimenu.style.backgroundColor = "red";
            }else {
                
                Mensajes = 0;

            }
            
            if (Mensajes > 0) {
            divElement.style.backgroundColor = "red";
            divnotimenu.style.backgroundColor = "red";
            }else {
                divElement.style.backgroundColor = "#074f91";
                divnotimenu.style.backgroundColor = "#074f91";

            }
            divElement.innerHTML = ""+Mensajes+" mensajes";
            divnotimenu.innerHTML = ""+Mensajes;

            console.log(snapshot.val().slrecep +" leiste el mensaje");


            }else if (snapshot.val().slNummen === "1" ) {
            
                console.log(snapshot.val().slrecep +" Te llego mensaje");

                Mensajes = Mensajes + 1;
                reproducirSonido();
                if (Mensajes > 0) {
                divElement.style.backgroundColor = "red";
                divnotimenu.style.backgroundColor = "red";
                }else {
                    divElement.style.backgroundColor = "#074f91";
                    divnotimenu.style.backgroundColor = "#074f91";

                }
                divElement.innerHTML = ""+Mensajes+" mensajes";
   
        }

      


            


    }
}
        ); 


        function reproducirSonido() {
        var audio = new Audio('img/msn-alert.mp3');
        audio.play();
        }
        function goBack() {
  history.back();
}


var div = document.getElementById("chat");





var agrandar = document.getElementById("agrandar");
var minimizar = document.getElementById("minimizar");
var iframe = document.getElementById("contenido");
var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
div.addEventListener("mousedown", dragMouseDown);
div.addEventListener("touchstart", dragMouseDown);

agrandar.addEventListener("mousedown", function(e) {
  e.stopPropagation();
});
agrandar.addEventListener("touchstart", function(e) {
  e.stopPropagation();
});

minimizar.addEventListener("mousedown", function(e) {
  e.stopPropagation();
});
minimizar.addEventListener("touchstart", function(e) {
  e.stopPropagation();
});

function dragMouseDown(e) {
  e = e || window.event;
  e.preventDefault();
  pos3 = e.clientX || e.touches[0].clientX;
  pos4 = e.clientY || e.touches[0].clientY;
  document.addEventListener("mouseup", closeDragElement);
  document.addEventListener("touchend", closeDragElement);
  document.addEventListener("mousemove", elementDrag);
  document.addEventListener("touchmove", elementDrag);
}

function elementDrag(e) {
  e = e || window.event;
  e.preventDefault();
  pos1 = pos3 - (e.clientX || e.touches[0].clientX);
  pos2 = pos4 - (e.clientY || e.touches[0].clientY);
  pos3 = e.clientX || e.touches[0].clientX;
  pos4 = e.clientY || e.touches[0].clientY;
  div.style.top = (div.offsetTop - pos2) + "px";
  div.style.left = (div.offsetLeft - pos1) + "px";
}

function closeDragElement() {
  document.removeEventListener("mouseup", closeDragElement);
  document.removeEventListener("touchend", closeDragElement);
  document.removeEventListener("mousemove", elementDrag);
  document.removeEventListener("touchmove", elementDrag);
}



function miFuncion() {
  // Código de la función que deseas ejecutar después de cierto tamaño de pantalla
  console.log("Función ejecutada después de cierto tamaño de pantalla");
}

window.addEventListener("resize", function() {
  // Obtener el ancho de la ventana
  var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

  // Ejecutar la función si el ancho de la ventana es mayor a 768px
  if (windowWidth > 768) {
    miFuncion();
  }
});

// var divElement = document.getElementById('miDiv');

// Función para colocar el div en la esquina inferior derecha
function colocarEnEsquina() {
  div.style.left = '';
  div.style.top = '';
  div.style.bottom = '0';
  div.style.right = '0';
}
</script>
