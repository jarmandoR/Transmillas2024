<?php 
require("login_autentica.php"); 
require("layout2.php");
include("Includes/FusionCharts.php");
if(isset($p1)){$p1=trim($_REQUEST["p1"]);} else {$p1="";} 
if(isset($p2)){$p2=trim($_REQUEST["p2"]);} else {$p2="";} 
if(isset($p3)){$p3=trim($_REQUEST["p3"]);} else {$p3="";} 
$p1=substr($p1,0,strlen($p1)-1); 
if($p1!=""){ $cond=" AND a.proyectos_idproyectos IN ($p1) ";  } else {$cond="";}
$p2=substr($p2,0,strlen($p2)-1); 
if($p2!=""){ $cond2=" WHERE idactindgener IN ($p2) ";  } else {$cond2="";}
$DB2 = new DB_mssql;
$DB2->conectar(); 
switch($p3)
{
	case "Gestores por IE":
	$sql="SELECT ges_nombre, COUNT(*), idgestores FROM gestoresie INNER JOIN ieducativas ON ieducativas_idieducativas=idieducativas INNER JOIN gestores ON 
	gestores_idgestores=idgestores GROUP BY ges_nombre ORDER BY ges_nombre";
	break; 	
	case "IE":
	$sql="SELECT ciu_nombre, COUNT(*), idciudades FROM  ciudades  GROUP BY ciu_nombre";
	break; 	
	case "Avance por IE":
	$sql="SELECT ied_nombre, ied_nombre, idieducativas FROM gestoresie INNER JOIN ieducativas ON ieducativas_idieducativas=idieducativas INNER JOIN gestores ON 
	gestores_idgestores=idgestores GROUP BY ied_nombre ORDER BY ied_nombre";
	break; 	
	case "Avance por municipio":
	$sql="SELECT ciu_nombre, COUNT(*) FROM gestoresie INNER JOIN ieducativas a ON ieducativas_idieducativas=idieducativas INNER JOIN gestores ON gestores_idgestores=idgestores
	INNER JOIN ciudades ON a.usu_idsede=idciudades GROUP BY ciu_nombre ORDER BY ciu_nombre";
	break; 	
} 
?>
<link href="Content/MapORamaStyles.css" rel="stylesheet" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="js/gomap.js"></script>
<table><tr><td><?php $FB->titulo_azul1("C&oacute;digo Dane",1,0,5); $FB->titulo_azul1("Instituci&oacute;n Educativa",1,150,0);  
$DB1->Execute($sql); $va=0; 
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$va++; $p=$va%2; $id_p=$rw1[0];
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"' >";
	echo "<td>$rw1[0]</td><td align='right'>$rw1[1]</td></tr>";
}
echo "</table>"; ?></td></tr></table>

<div id="map" style="width:100px; height:300px;"></div>
    <script type="text/javascript">
        var constants = {
            'activos': 'img/icon2.png',
            'suspendidos': 'img/icon5.png',
            'alerta': 'img/icon4.png',
            'atrasados': 'img/icon1.png',
        };
        var proySuspendidos = false;
        var proyAlerta = false;
        var proyAtrasados = false;
        $(function () {
            $("#map").goMap({
                latitude: 8.637184,
                longitude: -74.072463,
                maptype: 'ROADMAP',
                zoom: 7
            });
       }); // ready handler
    </script>
</body>
</html>