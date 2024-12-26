


<?php 
require("login_autentica.php"); 
include("declara.php");


if($param5!=''){ $id_sedes=$param5;  $conde2=" "; }  
$idUserA=$_SESSION['usuario_id'];

$responde=$_GET['respon'];

// if ($responde==1) {

// $iduChat=$_GET['idPro'];
 
// }

$iduChat=$_POST['idPro'];




?>


<head>

  </head>
<body onload=" ">

<?php 


  $conde="and not_fecha like '$fechaactual%'"; 
 $conde1="and not_fecha like '$fechaactual%'"; 
 $conde2="and usu_nombre='$id_nombre'"; 
 $conde3="and roles_idroles = '$nivel_acceso'"; 
$conde4="and ((not_idDe = '$idUserA' and not_idusuario='$iduChat') or  (not_idDe = '$iduChat' and not_idusuario='$idUserA'))";
$conde5="";

$fechadosdias=date("Y-m-d H:i:s",strtotime($fecha_actual."- 1 days")); 

  $sql="SELECT idnoticia,  not_fecha,  usu_usuario, not_titulo, not_descripcion, not_expiracion,not_idrol,not_visto,not_respuesta,not_imagen , roles_idroles, not_idusuario, usu_nombre, not_userinsert,not_idDe, not_fechaVisto,not_idrespuestaespesifi FROM noticia left join usuarios on idusuarios=not_idusuario where idnoticia>1 and not_fecha>=date('$fechadosdias') and not_deChat = ''  $conde4   ORDER BY 1 asc";
 // echo "$id_nombre";
$DB->Execute($sql); $va=0; 
  while($rw1=mysqli_fetch_row($DB->Consulta_ID))
  {
    
    $estado="";
    $id_p=$rw1[0];
    $va++; $p=$va%2;
    if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
    if($rw1[5]=='Confirmar' and $fechaultima<=$fechaactual){
        
         $color="#C72907";
      }
      else if($rw1[7]==''){
        $color="#2ECC71";
      }
    
              
        if ($rw1[11]==$idUserAor or $rw1[14]==$idUserA) {

          

                  echo "
                  
                  
                  <div class='message-feed right'>
                        <div class='pull-right'>                    
                            <img src='imgUsuarios/userd.jpg' alt='' class='img-avatar' alt='' class='img-avatar'>
                        </div>
                        <small class='mf-date'><i class='fa fa-clock-o'></i> ".$rw1[1]."
                        </small>

                        <div class='media-body'>";

if ($rw1[16]!='') {
            $sql1="SELECT not_descripcion,not_imagen FROM noticia WHERE idnoticia='$rw1[16]'";
        $DB1->Execute($sql1); 
        
        $rw4=mysqli_fetch_array($DB1->Consulta_ID);
          

                        echo"Respondio a : ".$rw4[0]."</div>";
                        if ($rw4[1]!='') {
                        echo "<a href='imgMensajes/".$rw4[1]."' target='_blank'><img src='imgMensajes/".$rw4[1]."' width='50'></a>";
                      }

}


                          echo"  <div class='mf-content'>";

            if ($rw1[9]!=''){

                echo "<a href='imgMensajes/".$rw1[9]."' target='_blank'><img src='imgMensajes/".$rw1[9]."' width='50'></a>";


            }
                echo "".$rw1[4]."</div>";
                    if ($rw1[7]=='si') {
                        echo"<small class='mf-date'></i> ".$rw1[15]."";
                         echo" ✔️</small>";
                    }

                    
                echo "</div> 
                  </div>";
            
         }else{

                
               $idmensa=1;
               $mensa=2;

           echo "<div class='message-feed media'>
           

                    <div class='pull-left'>              
                        <img src='imgUsuarios/userd.jpg' alt='' class='img-avatar' alt='' class='img-avatar'>
                    </div>
                    <small class='mf-date'><i class='fa fa-clock-o'></i> ".$rw1[1]."</small>
                    <div class='media-body'> ";

             
                     
                



                echo"<div class='mf-content'> 
                <li class='dropdown'>
                        <a href='' data-toggle='dropdown' aria-expanded='true'>
                            <i class='fa fa-bars'></i>
                        </a>
            
                        <ul class='dropdown-menu dropdown-menu-right'>
                            <li>


                            <a href='javascript:funcion(".$rw1[0].")' >Llamar función</a>
                              
                            </li>

                            
                        </ul>

                       </li>";
  

                          if ($rw1[9]!=''){

                              echo" <a href='imgMensajes/".$rw1[9]."' target='_blank'><img src='imgMensajes/".$rw1[9]."' width='50'></a>";

                              }
                              echo"          
                                  ".$rw1[4]."
                              </div>         
                              ";

                          if ($rw1[7]=='si') {
                              echo"<small class='mf-date'></i> ".$rw1[15]."";
                           echo" ✔️</small>";
                          }


                          
                          if ($rw1[16]!='') {
              $sql1="SELECT not_descripcion,not_imagen FROM noticia WHERE idnoticia='$rw1[16]'";
              $DB1->Execute($sql1); 
        
              $rw4=mysqli_fetch_array($DB1->Consulta_ID);
          

                        echo"Respondio a : ".$rw4[0]."</div>";
                        if ($rw4[1]!='') {
                        echo "<a href='imgMensajes/".$rw4[1]."' target='_blank'><img src='imgMensajes/".$rw4[1]."' width='50'></a>";
                      }

}

                           echo"
                          </div>
                  </div>
            ";
            


         }

       }   
?>
<script>
//  function funcion(respue){
//         alert('Función ejecutada');


// // var respuesta;
// // var respuesta = respue;

// // // var texto=document.getElementById('texto').value;

// // var ruta="respuesta="+respuesta;

 

// //     $.ajax({
    
// //     url: 'mensajes2p.php',
// //     type: 'POST',
// //     data: ruta,
// //     })
// //     .done(function(res){

// //         $('#respuesta').html(res)
        
// //     })
// //     .fail(function(){

// //         console.log("error");
// //     })
// //     .always(function(){

// //         console.log("completo");
// //         // document.getElementById("miform").reset();
// //         // getTimeAJAX();
// //         // sinjQuery();
// //     });
//       }


</script>
<!-- <a href='javascript:funcion(ok)'>Llamar función</a> -->
