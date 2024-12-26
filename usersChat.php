<?php 
require("login_autentica.php"); 
include("layout.php");
$sedesesion=$_SESSION['usu_idsede'];

$idUserA=$_SESSION['usuario_id'];

if ($nivel_acceso!=1 or $nivel_acceso!=12) {
$FB->titulo_azul1("Usuarios Chat",9,0,7);  
$FB->abre_form("form1","","post");
$FB->llena_texto("Roles:",1,2,$DB,"SELECT idroles, rol_nombre FROM roles ORDER BY rol_nombre","cambio3(this.value,param2.value,0,\"usersChat.php\",1);",$param1,1,0);
// $param2 = "1";


$FB->llena_texto("ciudades:",2,2,$DB,"SELECT idsedes, sed_nombre FROM sedes ","cambio3(param1.value,this.value,0,\"usersChat.php\",1);",$param2,1,0);	



// $FB->llena_texto("Ciudad:",3,8,$DB,$estado_pro,"cambio3(param1.value,this.value,0,\"usersChat.php\", 1);",$param2,1,0);
$FB->cierra_form();
 



$conde3 = "";
//echo $param2;
// $conde1=""; if($param2!=""){ if($param2=="Activo") { 
	$conde1=" AND usu_estado='1' ";
 // } else { $conde1=" AND usu_estado='0' "; } }
	if($param1!="0" and $param1!=""){ $conde=" AND idroles='$param1' "; } else { $conde="";} 
	if($param2!="0" and $param2!=""){ $conde1=" AND usu_idsede='$param2' "; } else { $conde1="and usu_idsede = '$sedesesion'";} 
}else{
$FB->titulo_azul6("Nuevo chat",1,0,5,"usu_nombre",$asc2); 
$conde1="and usu_idsede = '$sedesesion'";

}
//if($param3!="0" and $param3!=""){ $conde2=" AND entidades_identidades IN (SELECT identidades FROM contratosproyectos INNER JOIN entidades ON entidades_identidades=identidades AND proyectos_idproyectos='$param3')"; } else { $conde2="";} 

 //$sql="SELECT `idusuarios`, `rol_nombre` , `usu_nombre` , `usu_mail` , `usu_usuario` ,`usu_nivelacademico` ,`usu_identificacion` , `usu_estado` , `idroles`  FROM usuarios INNER JOIN roles ON roles_idroles=idroles and idusuarios!=1 $conde $conde1 $conde2 GROUP BY usu_nombre ORDER BY usu_nombre $asc ";

// menu de la parte superior 
echo"<ul class='ah-actions actions'>
                    
                    <li>
                        
                    </li>
                    <li>";
                    // echo "<a id='link' onclick='pop_dis16(\"$id_p\",\"mensajes/visto\",\"$rw1[7]\")';   title='Enviar Imagen' >📷";

                       echo" 
                       <span>".$rw2[1]."</span>
                    </li>

                    <li class='dropdown'>

                    <a href='salaChats.php' class='btn btn-default'><span class='glyphicon glyphicon-circle-arrow-left'></span>Volver</a>
                 
                        <ul class='dropdown-menu dropdown-menu-right'>
                            <li>
                                <a href='usersChat.php'>Latest</a>
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
                </ul>";


 $sql="SELECT `idusuarios`, `rol_nombre` , `usu_nombre` , `usu_mail`, `usu_usuario` ,`usu_nivelacademico` ,`usu_identificacion`, `usu_estado` , `idroles`,`usu_tipocontrato`,`usu_filtro`, `usu_idsede`  FROM usuarios INNER JOIN roles ON roles_idroles=idroles INNER JOIN sedes ON idsedes=usu_idsede    AND usu_estado='1' $conde $conde1  ORDER BY usu_nombre $asc";

 $DB->Execute($sql); 
$va=0; 
while($rw=mysqli_fetch_row($DB->Consulta_ID)){
	$va++; $p=$va%2; $id_p=$rw[0];
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	echo "<tr bgcolor='$color' class='text' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	
echo "<head>
    <meta charset='utf-8'>
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>messages like material design - Bootdey.com</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    
    <style type='text/css'>
      body {
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
    background: #f8f8f8;
    padding: 15px 13px 15px 17px;
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
}
#ms-menu-trigger, .message-feed.right {
    text-align: right;
}
#ms-menu-trigger, .toggle-switch {
    -webkit-user-select: none;
    -moz-user-select: none;
}
    </style>";

    $sles="SELECT usu_identificacion FROM usuarios WHERE idusuarios='$rw[0]'";
$DB_m->Execute($sles); 
$identifi=$DB_m->recogedato(0);

if ($identifi!='') {
$sles1="SELECT hoj_foto FROM hojadevida WHERE hoj_cedula='$identifi'";
$DB_m1->Execute($sles1); 
$foto=$DB_m1->recogedato(0);
}

     $sql1 = "SELECT count(*) FROM `noticia` WHERE not_idusuario='$id_usuario' and not_visto='' AND not_idDe='$rw[0]' ";
 $DB1->Execute($sql1); 
 $cantMensajes=$DB1->recogedato(0);


if ($rw[0]!=$idUserA) {


    

    echo"
</head><td><div class='list-group lg-alt'>
                <a class='list-group-item media' href='mensajes.php?idUserm=".$rw[0]."&varVisto=si'>
                    <div class='pull-left'>
                        
                         ";
              if ($foto!='') {
    # code...
              echo "<img src='imgUsuarios/".$foto."' alt='' class='img-avatar'>";
                }else{

                    echo "<img src='imgUsuarios/userd.jpg' alt='' class='img-avatar'>"; 
                }


                echo "
                    </div>
                    <div class='media-body'>
                        <small class='list-group-item-heading'>".$rw[2]."</small>
                        <small class='list-group-item-text c-gray'>".$rw[1]."</small>";

                        if ($cantMensajes>0) {
                        echo"
                        <small class='list-group-item-text c-gray' style='background-Color:#FF0000; color:#FFFFFF; width:50px; height:50px;'>$cantMensajes</small>";
                        }
                        
                        
                    echo"
                    </div>
                </a></td>";
 
	}

	// $DB->edites($id_p, "Usuario", $param_edicion, $condecion);
	// echo "</tr>";
}
include("footer.php");
?>