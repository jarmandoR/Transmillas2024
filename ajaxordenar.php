<?php
include('config.php');
    if (isset($_POST['update'])) {
      print_r($_POST['positions']);
      echo  $tamano = $_POST['posinicial'];
 
        $tam=0;
        foreach($_POST['positions'] as $position) {
          
           $index = $position[0];
           $newPosition = $position[1];
          if($tamano==$index){
            $UpdatePosition = ("UPDATE ord_recoentregas SET orden = '$newPosition', ord_estado = 'Ordenado' WHERE orden_id='$index' ");

          }else{
            $UpdatePosition = ("UPDATE ord_recoentregas SET orden = '$newPosition' WHERE orden_id='$index' ");

          }
          $tam++;
          $result = mysqli_query($con, $UpdatePosition);
          print_r($UpdatePosition);
        }
    }
?>

