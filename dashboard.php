<?php
require("login_autentica.php");
include("layout.php");
include("cabezote2.php");
include("connection/FusionCharts.php");
?>
<script language="javascript">
function llena_datos(variab)
{
	p1=document.getElementById('selproyectos').value;
	p2=document.getElementById('selindi').value;
	p3=document.getElementById('param3').value;
	if(variab==1){ 
		destino="dashboard.php?p1="+p1+"&p2="+p2+"&p3="+p3;
		document.location.href=destino;
	}
	else {
		destino="detalle_reportesx.php?p1="+p1+"&p2="+p2+"&p3="+p3;
		document.location.href=destino;
	}
}
</script>
<link href="Content/MapORamaStyles.css" rel="stylesheet" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="js/gomap.js"></script> 
<?php 
$FB->abre_form("form11","","post");
$FB->volver1("act_calendario.php", "Dashboard", 4, "", "");
?>
<tr><td>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="Intabla">
<tr><td>L&iacute;neas estrat&eacute;gicas:</td>
<td align="right">
    <div class="multiselect">
        <div class="selectBox" onclick="showCheckboxes('checkboxes')"><select><option>Seleccione...</option></select><div class="overSelect"></div></div>
        <div id="checkboxes" style="background-color:#FFFFFF; z-index:100;">
            <table width="100%"><tr><td align="right"><a href="#" onClick="marcar('proyectos'); checkChoice2();"><span class='text9'>Todos</span></a></td>
            </tr>
            <?php
            $sql="SELECT idproyectos, pro_alias FROM proyectos ORDER BY pro_alias ";
            $DB->Execute($sql);
            while($rw=mysqli_fetch_row($DB->Consulta_ID))
            {
                echo "<tr><td class='text9'>".substr($rw[1],0,20)."</td><td align='right' width='20px'>
                <input type='checkbox' name='proyectos[]' id='proyectos' style='width:20px;' onclick=\"checkChoice2(this)\" value=\"".$rw[0]."\"></td></tr>";
            }
            echo "<input type='hidden' name='proyectos[]' id='proyectos' style='width:20px;' value=\"".$rw[0]."\">";
            $DB->cerrarconsulta();
            ?>
            </table>
        </div>
    </div>
</td>
<td>Indicadores: </td><td align="right">
<div class="selectBox" onclick="showCheckboxes('mye1')"><select><option>Seleccione...</option></select><div class="overSelect"></div></div>
<div id="mye1" style="background-color:#FFFFFF; z-index:100;"></div>
</td></tr>
<?php 
if(isset($_REQUEST["p1"])){$p1=trim($_REQUEST["p1"]);} else {$p1="";} 
if(isset($_REQUEST["p2"])){$p2=trim($_REQUEST["p2"]);} else {$p2="";} 
if(isset($_REQUEST["p3"])){$p3=trim($_REQUEST["p3"]);} else {$p3="";} 
$FB->llena_texto("Reportes:", 3, 24, $DB, $reportes_1, "", $p3, 1, 0); 
$FB->llena_texto("", 4, 27, $DB, "", "llena_datos(2);", "llena_datos(1);", 4, 0); 
$FB->llena_texto("selproyectos", 1, 13, $DB, "", "", "", 5, 0);
$FB->llena_texto("selindi", 1, 13, $DB, "", "", "", 5, 0);
$FB->cierra_tabla(); 
$FB->cierra_form(); 
$p1=substr($p1,0,strlen($p1)-1); 
if($p1!=""){ $cond=" AND a.proyectos_idproyectos IN ($p1) ";  } else {$cond="";}
$p2=substr($p2,0,strlen($p2)-1); 
if($p2!=""){ $cond2=" WHERE idactindgener IN ($p2) ";  } else {$cond2="";}
$DB2 = new DB_mssql; $avance=0; $pre=""; $suf="";
$DB2->conectar(); 
switch($p3)
{
	case "Gestores por IE":
	$sql="SELECT ges_nombre, COUNT(*), idgestores FROM gestoresie INNER JOIN ieducativas ON ieducativas_idieducativas=idieducativas INNER JOIN gestores ON 
	gestores_idgestores=idgestores $cond1 GROUP BY ges_nombre ORDER BY ges_nombre";
	$titul1="Gestor"; $titul2="I Educativas"; $grafica="Pie";
	break; 	
	case "IE por municipio":
	$sql="SELECT ciu_nombre, COUNT(*), idciudades FROM gestoresie INNER JOIN ieducativas a ON ieducativas_idieducativas=idieducativas INNER JOIN gestores ON 
	gestores_idgestores=idgestores INNER JOIN ciudades ON a.usu_idsede=idciudades $cond1 GROUP BY ciu_nombre";
	$titul1="Municipio"; $titul2="I Educativas"; $grafica="Pie";
	break; 	
	case "Avance por IE":
	$sql="SELECT ied_nombre, ied_nombre, idieducativas FROM gestoresie INNER JOIN ieducativas ON ieducativas_idieducativas=idieducativas INNER JOIN gestores ON 
	gestores_idgestores=idgestores $cond1 GROUP BY ied_nombre ORDER BY ied_nombre ";
	$titul1="I Educativa"; $titul2="% Avance"; $avance=1; $grafica="Barras";
	break; 	
	case "Avance por municipio":
	$sql="SELECT ciu_nombre, COUNT(*), idciudades FROM gestoresie INNER JOIN ieducativas a ON ieducativas_idieducativas=idieducativas INNER JOIN gestores ON 
	gestores_idgestores=idgestores INNER JOIN ciudades ON a.usu_idsede=idciudades $cond1 GROUP BY ciu_nombre ORDER BY ciu_nombre";
	$titul1="Municipio"; $titul2="% Avance"; $avance=1; $grafica="Barras"; $suf="%";
	break; 	
	default:
	$sql="SELECT ges_nombre, COUNT(*), idgestores FROM gestoresie INNER JOIN ieducativas ON ieducativas_idieducativas=idieducativas INNER JOIN gestores ON 
	gestores_idgestores=idgestores $cond1 GROUP BY ges_nombre ORDER BY ges_nombre";
	$titul1="Gestor"; $titul2="I Educativas"; $grafica="Pie";
	break;
} 
?>
<table width="100%"><tr><td width="40%" valign="top">
<div style="overflow:auto; height:245px;">
<?php $FB->titulo_azul1($titul1,1,0,5); $FB->titulo_azul1($titul2,1,150,0);  
$DB1->Execute($sql); $va=0; $total1=0; $total2=0; $categorias=""; $serie1="";
$ccan1="<chart palette='4' decimals='2' enableSmartLabels='1' enableRotation='0' bgColor='FFFFFF' bgAlpha='40,100' bgRatio='0,100' 
bgAngle='360' showBorder='1' startingAngle='70' formatnumberscale='0' showPercentValues='1' showPercentInToolTip='0' >";
$ccan="<?xml version='1.0' encoding='utf-8'?><chart palette='1' formatNumberScale='0' showBorder='1' showPercentValues='1' decimals='0' numberprefix='$pre' numberSuffix='$suf' >";
while($rw1=mysqli_fetch_row($DB1->Consulta_ID))
{
	$va++; $p=$va%2; $id_p=$rw1[0]; 
	$lab=explode(" ",$rw1[0]);
	if(isset($lab[1])){ $label=$lab[0]." ".$lab[1]; } else {$label=$rw1[0];} 
	$categorias.="<category label='".utf8_encode($label)."' />";
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
	echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"' >";
	echo "<td>$rw1[0]</td>";
	if($avance==1){ $por2=avance_vis($DB2, $DB, 0, $rw1[2], $tip); echo "<td align='right'>".number_format($por2,1,".",",")."%</td>"; }  
	else { echo "<td align='right'>$rw1[1]</td>"; $por2=0; } 
	echo "</tr>";
	$ccan1.="<set label='$label' value='$rw1[1]' />";
	$serie1.="<set value='".str_replace("%","",$por2)."' />";
	$total1=$total1+$rw1[1]; 
}
echo "<tr bgcolor='#074F91' class='tittle3' align='center'><td>Total</td><td align='right'>".$total1."</td></tr>";  
$ccan1.="</chart>";
$ccan.="<categories>".$categorias."</categories>";
$ccan.="<dataset SeriesName='Avance' >".$serie1."</dataset>";
$ccan.="</chart>";
echo "</table>"; ?></div></td><td rowspan="2" valign="top"><div id="mapa" style="width:100%; height:545px; overflow:auto;"></div></td></tr>
<tr><td valign="top">
<?php 
if($grafica=="Barras"){ echo renderChartHTML("Charts/ScrollColumn2D.swf", "", $ccan, "ChartId", 500, 260, false, true); }
else { echo renderChartHTML("Charts/Pie3D.swf", "", $ccan1, "ChartId", 500, 270, false, true); } 
?></td></tr>
</table>
    <script type="text/javascript">
        var constants = {
            'activos': 'img/icon2.png',
            'suspendidos': 'img/icon5.png',
            'alerta': 'img/icon3.png',
            'atrasados': 'img/icon4.png',
        };
        var proySuspendidos = false;
        var proyAlerta = false;
        var proyAtrasados = false;
        $(function () {
            $("#mapa").goMap({
                latitude: 5.637184,
                longitude: -74.072463,
                maptype: 'ROADMAP',
                zoom: 5
            });
<?php 
$sel1="SELECT idciudades, ciu_nombre, ied_nombre, ciu_latitud, ciu_longitud FROM gestoresie INNER JOIN ieducativas a ON ieducativas_idieducativas=idieducativas 
INNER JOIN gestores ON gestores_idgestores=idgestores INNER JOIN ciudades ON a.usu_idsede=idciudades $cond1 GROUP BY ciu_nombre  ";
$DB1->Execute($sel1);  
while($rw2=mysqli_fetch_row($DB1->Consulta_ID)){
	$por2=avance_vis($DB2, $DB, 0, $rw2[0], 1);
?>			
            $.goMap.createMarker({
				latitude: <?php echo $rw2[3]; ?>, 
            	longitude: <?php echo $rw2[4]; ?>, 
				title: '<?php echo $rw2[2]; ?>',
                group: 'ACTGroup',
				<?php if($por2==0){?> icon: constants.alerta, 
				<?php }elseif($por2>0 and $por2<70){?> icon: constants.atrasados, 
				<?php }else{?>icon: constants.activos,<?php }?>
				html: '<?php echo "Ciudad: $rw2[1]<br>I. Educativa: $rw2[2]<br>Avance %: $por2"; ?>'
            });
<?php }  ?>			
            $("#ActivosCheckbox").click(function () {
                if ($('#ActivosCheckbox').is(':checked')) {
                    $.goMap.showHideMarkerByGroup('ACTGroup', true)
                } else {
                    $.goMap.showHideMarkerByGroup('ACTGroup', false)
                }
            });

       }); // ready handler
    </script> 
</body></html> 