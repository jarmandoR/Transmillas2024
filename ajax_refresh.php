<?php
require("login_autentica.php");
include("cabezote3.php");
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT iddocentes, doc_nombre, doc_documento FROM docentes WHERE doc_nombre LIKE '%$keyword%' ORDER BY doc_nombre ASC LIMIT 0, 10";
$DB->execute($sql);
while($rw=mysqli_fetch_row($DB->Consulta_ID)){
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rw[1]).'\')">'.$rw[1].'</li>';
}
?>