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

$idnrespues=$_POST["numresp"];

// if ($respuestas1!='') {
//     echo"si existe";
// }
// $responder=0;



if ($varVisto!='') {
    $sql3="UPDATE `noticia` SET `not_visto`='$varVisto',`not_fechaVisto`='$fechaactualHora' WHERE (`not_idDe`='$iduChat' and `not_idusuario`='$idUserA'and not_visto='no')";
     $DB->Execute($sql3);
}
 

?>

    
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
  

<?php 



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
                    <a href='salaChats3.php' class='btn btn-default'><span class='glyphicon glyphicon-circle-arrow-left'></span>Volver</a>                       
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
    //caja de mensajes        
    echo "<div class='message_template' id ='caja' style=' overflow: scroll;'></div>"; 
    echo "</div>";

  
  
 


echo"
        <div id='respues'></div>
        <div id='respuesta'> </div> 
       

        <form id='miForm'>
        <div class='form-group'>
        <tr>
    
            <input type='file' id='idFiles' class='form-control' name='file' value='selecciona archivo' multiple>
            </tr>
        </div>
        <div class='form-group'>
        <tr>
            <input type='text' class='form-control' name='mensajetexto' placeholder='nombre'>
         </div> 
         <div>  
            <input type='hidden' class='form-control'  name='de' size='20' value='".$idUserA."'>
        
        <input type='hidden' class='form-control'  name='para' size='20' value='".$iduChat."'>
        <input  type='hidden' class='form-control'  name='nrespuestas' id='nrespuestas'  size='20' value=''>
        </div>
        
            <button type='submit'  id='enviar'  class='btn btn-primary btn-block' name='enviar' onclick='miFunc()' >Enviar</button></tr> 
            <!-- <input type='submit' value='enviar'> -->

       
    </form>
    </div>";

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
// getTimeAJAX();


function getTimeAJAX() {
        //GUARDAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA AJAX 
        var miVariableJS = '<?php echo $iduChat; ?>';
        // var para=document.getElementById('para').value;
        var ruta1="idPro="+miVariableJS;

        var time = $.ajax({
            type: 'POST',
            data: ruta1,
            url: 'chatConsultas2.php', //indicamos la ruta donde se genera la hora
                dataType: 'text',//indicamos que es de tipo texto plano
                async: false     //ponemos el parámetro asyn a falso
        }).responseText;
        //actualizamos el div que nos mostrará la hora actual
        document.getElementById("caja").innerHTML = ""+time;

    }
    // setInterval(getTimeAJAX,1000);
    setTimeout(getTimeAJAX,100);




// function miFunc(){
    $("#miForm").on("submit", function(e){
            e.preventDefault();


// $('#enviar').click(function guardar(){  

// setTimeout(getTimeAJAX,100);

var data=getFiles();
    data=getFormData("miForm",data);


    $.ajax({
        url:"pros.php",
        type:"POST",
        data:data,
        dataType:"json",
        contentType:false,
        processData:false,
        cache:false
    }).always(function(data){

         
          getTimeAJAX();
          sinjQuery();
          document.getElementById("miForm").reset();
        // if(data.ok==1)
        // {
        //     document.getElementById("miForm").reset();
        //     alert("datos enviados correctamente\n\n"+data.message);
            
           
           
             
        // }else{
        //      document.getElementById("miForm").reset();
        //     alert("ha habido algun error\n\n"+data.message);
           

        // }

    });
    return false;



    


});

function getFiles()

{
    var idFiles=document.getElementById("idFiles");
    // Obtenemos el listado de archivos en un array
    var archivos=idFiles.files;
    // Creamos un objeto FormData, que nos permitira enviar un formulario
    // Este objeto, ya tiene la propiedad multipart/form-data
    var data=new FormData();
    // Recorremos todo el array de archivos y lo vamos añadiendo all
    // objeto data
    for(var i=0;i<archivos.length;i++)
    {
        // Al objeto data, le pasamos clave,valor
        data.append("archivo"+i,archivos[i]);
    }
    return data;
}
 
/**
 * Función que recorre todo el formulario para apadir en el FormData los valores del formulario
 * @param string id hace referencia al id del formulario
 * @param FormData data hace referencia al FormData
 * @return FormData
 */
function getFormData(id,data)
{
    $("#"+id).find("input,select").each(function(i,v) {
        if(v.type!=="file") {
            if(v.type==="checkbox" && v.checked===true) {
                data.append(v.name,"on");
            }else{
                data.append(v.name,v.value);
            }
        }
    });
    return data;

}

function funcion(val1){

    
        // alert('Función ejecutada'+val1);
        document.getElementById('respues').innerHTML = 'RESPONDIENDO⬅️';

        $('#nrespuestas').val(val1);

        var ruta1="numresp="+val1;

         $.ajax({
        type: 'POST',
        data: ruta1,
        dataType: 'text',//indicamos que es de tipo texto plano
        async: false 
    });

}







// $("#miform").on("submit", function(e){
//             e.preventDefault();
// // $('#enviar').click(function guardar(){  

// // setTimeout(getTimeAJAX,100);



// var de=document.getElementById('de').value;
// var mensaje=document.getElementById('texto').value;
// var para=document.getElementById('para').value;
// var foto=document.getElementById('imagenchat').files[0];
// // var texto=document.getElementById('texto').value;

// var ruta="de="+de+"&men="+mensaje+"&para="+para+"&foto="+foto;

 

//     $.ajax({
    
//     url: 'mensajesok.php',
//     type: 'POST',
//     data: ruta,
//     })
//     .done(function(res){

//         $('#respuesta').html(res)
        
//     })
//     .fail(function(){

//         console.log("error");
//     })
//     .always(function(){

//         console.log("completo");
//         document.getElementById("miform").reset();
//         getTimeAJAX();
//         sinjQuery();
//     });


    


// });

// $('#langOptgroup').multiselect({
//     columns: 4,
//     placeholder: 'Select Languages',
//     search: true,
//     selectAll: true
// });



</script>

