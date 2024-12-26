<?php
require("login_autentica.php"); 
include("declara.php");

$funcion=$_POST['funcion'];

if($funcion=="primas"){// Recibir la imagen
    $imagen = $_FILES['imagen'];

    // Recibir los IDs seleccionados
    $idsSeleccionados = json_decode($_POST['ids']);

    // Recibir las fechas y horas
    $fechaHora1 = $_POST['fechaHora1'];
    $fechaHora2 = $_POST['fechaHora2'];



    // Mostrar la información recibida
    // echo "Imagen recibida: <pre>" . print_r($imagen, true) . "</pre><br>";
    // echo "Fechas y horas recibidas: $fechaHora1, $fechaHora2<br>";
    // echo "IDs seleccionados:<br>";




    if (is_uploaded_file($_FILES['imagen']['tmp_name'])){
        $nombreArchivo = $_FILES["imagen"]["name"];
        $imagen = date("Y-m-d-H-i-s").$nombreArchivo;
    
        move_uploaded_file($_FILES['imagen']['tmp_name'], "./img_nomina/".$imagen);
    }else{
        $imagen = "";
    }




    foreach ($idsSeleccionados as $id) {
        // echo "$id<br>";

        echo$sql="UPDATE `primas` SET `pri_img_compro`='$imagen' WHERE pri_fecha_inicio ='$fechaHora1' and pri_idusu = '$id' ";	
        $DB1->Execute($sql);
    }
}

    $imagen = $_FILES['imagen'];

    // Recibir los IDs seleccionados
    $idsSeleccionados = json_decode($_POST['ids']);

    // Recibir las fechas y horas
    $fechaHora1 = $_POST['fechaHora1'];
    $fechaHora2 = $_POST['fechaHora2'];



    // Mostrar la información recibida
    // echo "Imagen recibida: <pre>" . print_r($imagen, true) . "</pre><br>";
    // echo "Fechas y horas recibidas: $fechaHora1, $fechaHora2<br>";
    // echo "IDs seleccionados:<br>";




    if (is_uploaded_file($_FILES['imagen']['tmp_name'])){
        $nombreArchivo = $_FILES["imagen"]["name"];
        $imagen = date("Y-m-d-H-i-s").$nombreArchivo;
    
        move_uploaded_file($_FILES['imagen']['tmp_name'], "./img_nomina/".$imagen);
    }else{
        $imagen = "";
    }




    foreach ($idsSeleccionados as $id) {
        // echo "$id<br>";

        echo$sql="UPDATE `nomina` SET `nom_img_compro`='$imagen' WHERE nom_fecha_inicio ='$fechaHora1' and nom_id_usu = '$id' ";	
        $DB1->Execute($sql);
    }





// if($_FILES["param5"]!=''){
// 	$QL->addDocumento1($_FILES["param5"], 1, "cancelarpago", $id_param, "cancelarpago", $DB);
    
// }
 
	