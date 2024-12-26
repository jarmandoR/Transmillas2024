
<?php 
require("login_autentica.php"); 
include("layout.php");
include("cabezote4.php"); 

if($param5!=''){ $id_sedes=$param5;  $conde2=" "; }  
$idUserA=$_SESSION['usuario_id'];
$iduChat=$_REQUEST["idUserm"];
?>
<script>



</script>
<head>
<META HTTP-EQUIV="Cache-Control" CONTENT ="no-cache">
  </head>
<body onload=" ">

<?php 

//echo $_SESSION['usuario_rol'];
$FB->abre_form("form1","mensajesChat.php","post");
//$FB->nuevo("Planillas", "$id_ciudad", "nuevo_admin.php");
$FB->titulo_azul1("Buzon de Mensajes recibidos ",9,0,5);  
// if($rcrear==1) { $FB->nuevo("Buzon", $condecion, ""); } 


  $conde="and not_fecha like '$fechaactual%'"; 
 $conde1="and not_fecha like '$fechaactual%'"; 
 $conde2="and usu_nombre='$id_nombre'"; 
 $conde3="and roles_idroles = '$nivel_acceso'"; 
$conde4="and not_idDe = '$idUsetA'and not_idusuario='$iduChat' ";
$conde4="or  not_idDe = '$iduChat'and not_idusuario='$idUsetA' ";

if($param1!=''){ $conde="and not_fecha >= '$param1'";  $fechaactual=$param1;  }
if($param5!=''){ $conde1="and not_fecha <= '$param5'"; $fechaactual1=$param5;  }

$FB->llena_texto("Buscar desde la fecha:", 1, 10, $DB, "", "", "$fechaactual", 1, 0);
$FB->llena_texto("Buscar hasta la fecha:", 5, 10, $DB, "", "", "", 1, 0);
$FB->llena_texto("", 3, 142, $DB, "BUSCAR", "","", 1, 0);

$FB->cierra_form(); 
if($nivel_acceso==1 or $nivel_acceso==5){
  $FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
  }




$FB->titulo_azul1("",1,0,7); 
// $FB->titulo_azul1("Titulo",1,0,0); 
//  $FB->titulo_azul1("ver",1,0,0); 
// $FB->titulo_azul1("Imagen",1,0,0);
// $FB->titulo_azul1("Expira",1,0,0); 
// $FB->titulo_azul1("Para Rol",1,0,0); 
// $FB->titulo_azul1("para Usuario",1,0,0); 
// $FB->titulo_azul1("Visto",1,0,0); 
// $FB->titulo_azul1("Respuesta",1,0,0); 

//  echo"<head>
//     <meta charset='utf-8'>
//     <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
//     <!--  All snippets are MIT license http://bootdey.com/license -->
//     <title>messages like material design - Bootdey.com</title>
//     <meta name='viewport' content='width=device-width, initial-scale=1'>
    
//     <style type='text/css'>
//       body {
//     font-family: Roboto,sans-serif;
//     font-size: 13px;
//     line-height: 1.42857143;
//     color: #767676;
//     background-color: #edecec;
// }

// #messages-main {
//     position: relative;
//     margin: 0 auto;
//     box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
// }
// #messages-main:after, #messages-main:before {
//     content: ' ';
//     display: table;
// }
// #messages-main .ms-menu {
//     position: absolute;
//     left: 0;
//     top: 0;
//     border-right: 1px solid #eee;
//     padding-bottom: 50px;
//     height: 100%;
//     width: 240px;
//     background: #fff;
// }
// @media (min-width:768px) {
//     #messages-main .ms-body {
//     padding-left: 240px;
// }
// }@media (max-width:767px) {
//     #messages-main .ms-menu {
//     height: calc(100% - 58px);
//     display: none;
//     z-index: 1;
//     top: 58px;
// }
// #messages-main .ms-menu.toggled {
//     display: block;
// }
// #messages-main .ms-body {
//     overflow: hidden;
// }
// }
// #messages-main .ms-user {
//     padding: 15px;
//     background: #f8f8f8;
// }
// #messages-main .ms-user>div {
//     overflow: hidden;
//     padding: 3px 5px 0 15px;
//     font-size: 11px;
// }
// #messages-main #ms-compose {
//     position: fixed;
//     bottom: 120px;
//     z-index: 1;
//     right: 30px;
//     box-shadow: 0 0 4px rgba(0, 0, 0, .14), 0 4px 8px rgba(0, 0, 0, .28);
// }
// #ms-menu-trigger {
//     user-select: none;
//     position: absolute;
//     left: 0;
//     top: 0;
//     width: 50px;
//     height: 100%;
//     padding-right: 10px;
//     padding-top: 19px;
// }
// #ms-menu-trigger i {
//     font-size: 21px;
// }
// #ms-menu-trigger.toggled i:before {
//     content: '\f2ea'
// }
// .fc-toolbar:before, .login-content:after {
//     content: ''
// }
// .message-feed {
//     padding: 20px;
// }
// #footer, .fc-toolbar .ui-button, .fileinput .thumbnail, .four-zero, .four-zero footer>a, .ie-warning, .login-content, .login-navigation, .pt-inner, .pt-inner .pti-footer>a {
//     text-align: center;
// }
// .message-feed.right>.pull-right {
//     margin-left: 15px;
// }
// .message-feed:not(.right) .mf-content {
//     background: #03a9f4;
//     color: #fff;
//     box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
// }
// .message-feed.right .mf-content {
//     background: #eee;
// }
// .mf-content {
//     padding: 12px 17px 13px;
//     border-radius: 2px;
//     display: inline-block;
//     max-width: 80%
// }
// .mf-date {
//     display: block;
//     color: #B3B3B3;
//     margin-top: 7px;
// }
// .mf-date>i {
//     font-size: 14px;
//     line-height: 100%;
//     position: relative;
//     top: 1px;
// }
// .msb-reply {
//     box-shadow: 0 -20px 20px -5px #fff;
//     position: relative;
//     margin-top: 30px;
//     border-top: 1px solid #eee;
//     background: #f8f8f8;
// }
// .four-zero, .lc-block {
//     box-shadow: 0 1px 11px rgba(0, 0, 0, .27);
// }
// .msb-reply textarea {
//     width: 100%;
//     font-size: 13px;
//     border: 0;
//     padding: 10px 15px;
//     resize: none;
//     height: 60px;
//     background: 0 0;
// }
// .msb-reply button {
//     position: absolute;
//     top: 0;
//     right: 0;
//     border: 0;
//     height: 100%;
//     width: 60px;
//     font-size: 25px;
//     color: #2196f3;
//     background: 0 0;
// }
// .msb-reply button:hover {
//     background: #f2f2f2;
// }
// .img-avatar {
//     height: 37px;
//     border-radius: 2px;
//     width: 37px;
// }
// .list-group.lg-alt .list-group-item {
//     border: 0;
// }
// .p-15 {
//     padding: 15px!important;
// }
// .btn:not(.btn-alt) {
//     border: 0;
// }
// .action-header {
//     position: relative;
//     background: #f8f8f8;
//     padding: 15px 13px 15px 17px;
// }
// .ah-actions {
//     z-index: 3;
//     float: right;
//     margin-top: 7px;
//     position: relative;
// }
// .actions {
//     list-style: none;
//     padding: 0;
//     margin: 0;
// }
// .actions>li {
//     display: inline-block;
// }

// .actions:not(.a-alt)>li>a>i {
//     color: #939393;
// }
// .actions>li>a>i {
//     font-size: 20px;
// }
// .actions>li>a {
//     display: block;
//     padding: 0 10px;
// }
// .ms-body{
//     background:#fff;    
// }
// #ms-menu-trigger {
//     user-select: none;
//     position: absolute;
//     left: 0;
//     top: 0;
//     width: 50px;
//     height: 100%;
//     padding-right: 10px;
//     padding-top: 19px;
//     cursor:pointer;
// }
// #ms-menu-trigger, .message-feed.right {
//     text-align: right;
// }
// #ms-menu-trigger, .toggle-switch {
//     -webkit-user-select: none;
//     -moz-user-select: none;
// }
//     </style>
// </head>
// <body>";

       






// echo"   <div class='ms-body'>
//             <div class='action-header clearfix'>";

// $sql1="SELECT `idusuarios`, `usu_nombre` FROM `usuarios` where idusuarios=$iduChat ";
//  // echo "$id_nombre";
// $DB1->Execute($sql1); 
//   $rw2=mysqli_fetch_array($DB1->Consulta_ID);

  
//             echo" 
                
                
//                 <div class='pull-left hidden-xs'>
//                     <img src='https://bootdey.com/img/Content/avatar/avatar2.png' alt='' class='img-avatar m-r-10'>
//                     <div class='lv-avatar pull-left'>
                        
//                     </div>
//                     <span>".$rw2[1]."</span>
//                 </div>
                 
//                 <ul class='ah-actions actions'>
//                     <li>
//                         <a href=''>
//                             <i class='fa fa-trash'></i>
//                         </a>
//                     </li>
//                     <li>
//                         <a href=''>
//                             <i class='fa fa-check'></i>
//                         </a>
//                     </li>
//                     <li>
//                         <a href=''>
//                             <i class='fa fa-clock-o'></i>
//                         </a>
//                     </li>
//                     <li class='dropdown'>
//                         <a href='' data-toggle='dropdown' aria-expanded='true'>
//                             <i class='fa fa-sort'></i>
//                         </a>
            
//                         <ul class='dropdown-menu dropdown-menu-right'>
//                             <li>
//                                 <a href=''>Latest</a>
//                             </li>
//                             <li>
//                                 <a href=''>Oldest</a>
//                             </li>
//                         </ul>
//                     </li>                             
//                     <li class='dropdown'>
//                         <a href='' data-toggle='dropdown' aria-expanded='true'>
//                             <i class='fa fa-bars'></i>
//                         </a>
            
//                         <ul class='dropdown-menu dropdown-menu-right'>
//                             <li>
//                                 <a href=''>Refresh</a>
//                             </li>
//                             <li>
//                                 <a href=''>Message Settings</a>
//                             </li>
//                         </ul>
//                     </li>
//                 </ul>
//             </div>";


 
// echo $sql="SELECT idnoticia,  not_fecha,  usu_usuario, not_titulo, not_descripcion, not_expiracion,not_idrol,not_visto,not_respuesta,not_imagen , roles_idroles, not_idusuario, usu_nombre, not_userinsert,not_idDe FROM noticia left join usuarios on idusuarios=not_idusuario where idnoticia>1 $conde $conde1 $conde3 $conde4 ORDER BY 1 desc";
//  // echo "$id_nombre";
// $DB->Execute($sql); $va=0; 
//   while($rw1=mysqli_fetch_row($DB->Consulta_ID))
//   {
  
//     $estado="";
//     $id_p=$rw1[0];
//     $va++; $p=$va%2;
//     if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
//     if($rw1[5]=='Confirmar' and $fechaultima<=$fechaactual){
        
//          $color="#C72907";
//       }
//       else if($rw1[7]==''){
//         $color="#2ECC71";
//       }
    
//     // echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
    
//     // echo "<td>".$rw1[1]."</td>
  
//     // <td>".$rw1[3]."</td>
    
    
    
    
//     // ";
//     // <td><textarea readonly='readonly'> ".$rw1[4]."</textarea> </td>
//     // <td>".$rw1[5]."</td>
//     // <td><textarea readonly='readonly'> ".$rw1[4]."</textarea> </td>
//     // <td align='center'><a href='imgMensajes/".$rw1[9]."' target='_blank'><img src='imgMensajes/".$rw1[9]."' width='50'></a></td>
// // echo "<td align='center'><a href='imgMensajes/".$rw1[9]."' target='_blank'><img src='imgMensajes/".$rw1[9]."' width='50'></a></td><td align='center'><a href='imgMensajes/".$rw1[9]."' target='_blank'><img src='imgMensajes/".$rw1[9]."' width='50'></a></td>";
// // <td><img  src='imgMensajes/".$rw1[9]."' alt='' style='max-height: 100px;'/> </td>
//     //  $sql5="SELECT `idroles`, `rol_nombre` FROM `roles` where  `idroles`='$rw1[6]' ";
//     //    $DB1->Execute($sql5);
//     //     $rolnombre=$DB1->recogedato(1);
//     //    if($rolnombre=='0' or $rolnombre==''){
//     //      $rolnombre='Todos';
//     //    }



//     //    if($rw1[7]==''){
//     //      $visto='NO';}else{$visto=$rw1[7];}
//     //    // }<td>".$visto."</td> 
//     // echo "<td>".$rolnombre."</td>
//     // <td>".$rw1[2]."</td>
    
//     // ";
// // echo "<td colspan='1' width='0' align='center' ><a id='link' onclick='pop_dis16(\"$id_p\",\"mensaje\",\"$rw1[7]\")';   title='Pago Reclamo' >Ver</td>";
//  // echo "<td colspan='1' width='0' align='center' ><a id='link' onclick='pop_dis16(\"$id_p\",\"verMensaje\",\"$rw1[7]\")';   title='Pago Reclamo' >ver</td>";
//  //    if($nivel_acceso==1 or $nivel_acceso==5){
//  //      $DB->edites($id_p, "idnoticia", 1, $condecion);
//  //      }



//   // echo"  
//   //           <div class='message-feed media'>
//   //               <div class='pull-left'>
//   //               <small class='mf-date'><i class='fa fa-clock-o'></i> quien envia</small>
//   //                   <img src='https://bootdey.com/img/Content/avatar/avatar1.png' alt='' class='img-avatar'>
//   //               </div>
//   //               <div class='media-body'>
//   //                   <div class='mf-content'>
//   //                       Quien envia
//   //                   </div>
//   //                   <small class='mf-date'><i class='fa fa-clock-o'></i> 20/02/2015 at 09:00</small>
//   //               </div>
//   //           </div>";
            
// if ($rw1[11]==$idUserAor or $rw1[14]==$idUserA) {
//   # code...


//           echo "  <div class='message-feed right'>
//                 <div class='pull-right'>
//                 <small class='mf-date'><i class='fa fa-clock-o'></i> ".$rw1[13]."</small>
//                     <img src='https://bootdey.com/img/Content/avatar/avatar2.png' alt='' class='img-avatar'>
//                 </div>
//                 <div class='media-body'>
//                     <div class='mf-content'>
//                         ".$rw1[4]."
//                     </div>
//                     <small class='mf-date'><i class='fa fa-clock-o'></i> ".$rw1[1]."</small>
//                 </div>
//             </div>";
            
//          }else{




//  echo"  
//             <div class='message-feed media'>
//                 <div class='pull-left'>
//                 <small class='mf-date'><i class='fa fa-clock-o'></i> ".$rw1[13]."</small>
//                     <img src='https://bootdey.com/img/Content/avatar/avatar1.png' alt='' class='img-avatar'>
//                 </div>
//                 <div class='media-body'>
//                     <div class='mf-content'>
//                         ".$rw1[4]."
//                     </div>
//                     <small class='mf-date'><i class='fa fa-clock-o'></i> ".$rw1[1]."</small>
//                 </div>
//             </div>";
            


//          }

//        }   
            
//           echo "  
//             <div class='msb-reply'>';
//              <div class='col-lg-6'>
//     <div class='input-group'>
//       <input type='text' class='form-control'>
//       <span class='input-group-btn'>
//         <button class='btn btn-default' type='button'>Enviar</button>
//       </span>
//      </div>
//         </div>
//     </div>
// </div>
// <script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
// <script src='http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
// <script type='text/javascript'>
//   $(function(){
//    if ($('#ms-menu-trigger')[0]) {
//         $('body').on('click', '#ms-menu-trigger', function() {
//             $('.ms-menu').toggleClass('toggled'); 
//         });
//     }
// });



// </script>
// </body>
// </html>";


echo "


<head>
  <style type='text/css'>
    * {
  box-sizing: border-box;
}

body {
  background-color: #edeff2;
  font-family: 'Calibri', 'Roboto', sans-serif;
}
 .img-avatar {
   height: 37px;
     border-radius: 2px;
     width: 37px;
}
.chat_window {
  position: absolute;
  width: calc(100% - 20px);
  max-width: 1500px;
  height: 600px;
  border-radius: 10px;
  background-color: #fff;
 
  
 
 
  
}

.top_menu {
  background-color: #fff;
  width: 100%;
  padding: 20px 0 15px;
  box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
}
.top_menu .buttons {
  margin: 3px 0 0 20px;
  position: absolute;
}
.top_menu .buttons .button {
  width: 16px;
  height: 16px;
  border-radius: 50%;
  display: inline-block;
  margin-right: 10px;
  position: relative;
}
.top_menu .buttons .button.close {
  background-color: #f5886e;
}
.top_menu .buttons .button.minimize {
  background-color: #fdbf68;
}
.top_menu .buttons .button.maximize {
  background-color: #a3d063;
}
.top_menu .title {
  text-align: center;
  color: #bcbdc0;
  font-size: 20px;
}

.messages {
  position: relative;
  list-style: none;
  padding: 20px 10px 0 10px;
  margin: 0;
  height: 347px;
  overflow: scroll;
}
.messages .message {
  clear: both;
  overflow: hidden;
  margin-bottom: 20px;
  transition: all 0.5s linear;
  opacity: 0;
}
.messages .message.left .avatar {
  background-color: #f5886e;
  float: left;
}
.messages .message.left .text_wrapper {
  background-color: #ffe6cb;
  margin-left: 20px;
}
.messages .message.left .text_wrapper::after, .messages .message.left .text_wrapper::before {
  right: 100%;
  border-right-color: #ffe6cb;
}
.messages .message.left .text {
  color: #c48843;
}
.messages .message.right .avatar {
  background-color: #fdbf68;
  float: right;
}
.messages .message.right .text_wrapper {
  background-color: #c7eafc;
  margin-right: 20px;
  float: right;
}
.messages .message.right .text_wrapper::after, .messages .message.right .text_wrapper::before {
  left: 100%;
  border-left-color: #c7eafc;
}
.messages .message.right .text {
  color: #45829b;
}
.messages .message.appeared {
  opacity: 1;
}
.messages .message .avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: inline-block;
}
.messages .message .text_wrapper {
  display: inline-block;
  padding: 20px;
  border-radius: 6px;
  width: calc(100% - 85px);
  min-width: 100px;
  position: relative;
}
.messages .message .text_wrapper::after, .messages .message .text_wrapper:before {
  top: 18px;
  border: solid transparent;
  content: ' ';
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}
.messages .message .text_wrapper::after {
  border-width: 13px;
  margin-top: 0px;
}
.messages .message .text_wrapper::before {
  border-width: 15px;
  margin-top: -2px;
}
.messages .message .text_wrapper .text {
  font-size: 18px;
  font-weight: 300;
}

.bottom_wrapper {
  position: relative;
  width: 100%;
  background-color: #fff;
  padding: 20px 20px;
  position: absolute;
  bottom: 0;
}
.bottom_wrapper .message_input_wrapper {
  display: inline-block;
  height: 50px;
  border-radius: 25px;
  border: 1px solid #bcbdc0;
  width: calc(100% - 160px);
  position: relative;
  padding: 0 20px;
}
.bottom_wrapper .message_input_wrapper .message_input {
  border: none;
  height: 100%;
  box-sizing: border-box;
  width: calc(100% - 40px);
  position: absolute;
  outline-width: 0;
  color: gray;
}
.bottom_wrapper .send_message {
  width: 140px;
  height: 50px;
  display: inline-block;
  border-radius: 50px;
  background-color: #a3d063;
  border: 2px solid #a3d063;
  color: #fff;
  cursor: pointer;
  transition: all 0.2s linear;
  text-align: center;
  float: right;
}
.bottom_wrapper .send_message:hover {
  color: #a3d063;
  background-color: #fff;
}
.bottom_wrapper .send_message .text {
  font-size: 18px;
  font-weight: 300;
  display: inline-block;
  line-height: 48px;
}

.message_template {
  display: none;
}

    </style>";



 

 $sql1="SELECT `idusuarios`, `usu_nombre` FROM `usuarios` where idusuarios=$iduChat ";
//  // echo "$id_nombre";
 $DB1->Execute($sql1); 
   $rw2=mysqli_fetch_array($DB1->Consulta_ID);

echo"
</head>
<div class='chat_window'>
  <div class='top_menu'>




  
  <div class='avatar'>
                    <img src='https://bootdey.com/img/Content/avatar/avatar2.png' alt='' class='img-avatar m-r-10'>
                    <div class='lv-avatar pull-left'>
                        
                    </div>
                    <span>".$rw2[1]."</span>
                </div>
    <div class='buttons'>
     <!-- <div class='button close'>
        
      </div>
      <div class='button minimize'>
        
      </div>
      <div class='button maximize'>
        
      </div>-->
    </div>
    <div class='title'>Chat</div>
 </div><ul class='messages'></ul>


  <div class='bottom_wrapper clearfix'>

    <div class='message_input_wrapper'>

      <input class='message_input' placeholder='Type your message here...' />
    </div>


    <div class='send_message'>


      <div class='icon'></div>

      <div class='text'>Send</div>

    </div>
  </div>
</div>

";
// echo $sql="SELECT idnoticia,  not_fecha,  usu_usuario, not_titulo, not_descripcion, not_expiracion,not_idrol,not_visto,not_respuesta,not_imagen , roles_idroles, not_idusuario, usu_nombre, not_userinsert,not_idDe FROM noticia left join usuarios on idusuarios=not_idusuario where idnoticia>1 $conde $conde1 $conde3 $conde4 ORDER BY 1 desc";
//  // echo "$id_nombre";
// $DB->Execute($sql); $va=0; 
//   while($rw1=mysqli_fetch_row($DB->Consulta_ID))
//   {
    
 echo"

<div class='message_template'>
  <li class='message'>
  <div class='avatar'>  aqui va la foto
    
  </div>


  <div class='text_wrapper'>
  <small class='mf-date'><i class='fa fa-clock-o'></i> 13:43 pm </small>
    <div class='text'>
      
    </div>
   aqui va el mensaje
  </div>
</li>
</div>


";

// }
include("footer.php");
?>
<script type='text/javascript'>
(function () {
    var Message;
    Message = function (arg) {
        this.text = arg.text, this.message_side = arg.message_side;
        this.draw = function (_this) {
            return function () {
                var $message;
                $message = $($('.message_template').clone().html());
                $message.addClass(_this.message_side).find('.text').html(_this.text);
                $('.messages').append($message);
                return setTimeout(function () {
                    return $message.addClass('appeared');
                }, 0);
            };
        }(this);
        return this;
    };
    $(function () {
        var getMessageText, message_side, sendMessage;
        message_side = 'right';
        getMessageText = function () {
            var $message_input;
            $message_input = $('.message_input');
            return $message_input.val();
        };
        sendMessage = function (text) {
            var $messages, message;
            if (text.trim() === '') {
                return;
            }
            $('.message_input').val('');
            $messages = $('.messages');
            message_side = message_side === 'left' ? 'right' : 'left';
            message = new Message({
                text: text,
                message_side: message_side
            });
            message.draw();
            return $messages.animate({ scrollTop: $messages.prop('scrollHeight') }, 300);
        };
        $('.send_message').click(function (e) {
            return sendMessage(getMessageText());
        });
        $('.message_input').keyup(function (e) {
            if (e.which === 13) {
                return sendMessage(getMessageText());
            }
        });
        sendMessage('Hello Philip! :)');
        setTimeout(function () {
            return sendMessage('Hi Sandy! How are you?');
        }, 1000);
        return setTimeout(function () {
            return sendMessage('I\'m fine, thank you!');
        }, 2000);
    });
}.call(this));
</script>