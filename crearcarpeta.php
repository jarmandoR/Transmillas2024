<?php
$mes=date('m');
echo $ano=date('Y');
$nuevacarpeta='guias_'.$mes.'_'.$ano;
$micarpeta = '/home2/transml9/public_html/imagesguias/'.$nuevacarpeta; ///home2/transml9/imagesguias/
echo $micarpeta;
if (!file_exists($micarpeta)) {
    echo "no existe";
    mkdir($micarpeta, 0777, true);
}
?>