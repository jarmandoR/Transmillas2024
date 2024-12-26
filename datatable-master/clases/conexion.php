<?php 
class conectar {
    public function conexion() {

   global $host, $user, $pass, $bd;


        $conexion = mysqli_connect($host, $user, $pass, $bd);
        return $conexion;
    }
}

 ?>
