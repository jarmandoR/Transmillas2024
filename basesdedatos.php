<?php 
require("login_autentica.php"); 
include("layout.php");
include("autocompleta.php");
if(isset($_REQUEST["p1"])){ $p1=$_REQUEST["p1"]; } else {$p1="";}
if(isset($_REQUEST["p2"])){ $p2=$_REQUEST["p2"]; } else {$p2="";} 
if(isset($_REQUEST["tipof"])){ $tipof=$_REQUEST["tipof"]; } else {$tipof="";} 
?>
<script language="javascript">
function llena_datos()
{
	p1=document.getElementById('param1').value;
	p2=document.getElementById('param2').value; 
	destino="basesdedatos.php?p1="+p1+"&p2="+p2;
	document.location.href=destino;
}
</script>
<?php 
$FB->titulo_azul1("Base de datos",9,0, 7);  
$FB->abre_form("form1","","post");
$FB->llena_texto("Proyectos:",1,2,$DB,"SELECT idproyectos, pro_alias FROM proyectos ORDER BY pro_codigo","llena_datos();",$p1,1,0);
$FB->llena_texto("Buscar:", 2, 15, $DB, "autocomplet1(this.value);", "llena_datos();", $p2, 4, 0);
$FB->cierra_form(); 
if($rcrear==1) { $FB->nuevo("Base de datos/Conusulta", "", ""); } 
echo "<table width='100%' align='center'><tr><td>";
if($p1!=""){ $con1=" AND proyectos_idproyectos='$p1'"; } else { $con1=""; }
if($p2!=""){ $con2=" AND aci_nombre LIKE '%$p2%' "; } else { $con2=""; }
$sql="SELECT idactindgener, pro_nombre, aci_nombre, aig_descripcion, aig_fuente FROM actindgener INNER JOIN proyectos ON proyectos_idproyectos=idproyectos 
AND (aig_fuente='Base de datos' OR aig_fuente='Consulta') $con1 $con2 ORDER BY aci_nombre";
$DB->Execute($sql); $va=-1; 
echo "<div class='row' style='width:100%;'>";
while($rw1=mysqli_fetch_row($DB->Consulta_ID))
{
	$va++;
	if($va==3) { echo "</div><div class='row' style='width:100%;'>"; $va=0; } 
	$id_p=$rw1[0];
?>
	<div class="col-md-4"><div class="box" style="min-width:300px; min-height:220px;"><div class="box-header" >
	<h3 class="box-title"><?php echo $rw1[2]; ?></h3></div>
	<div class="box-tools pull-right" style="left:-15px;top:-10px;position:relative;">
	<?php $DB1->edites2($id_p, "Base de datos/Conusulta", $param_edicion, $rw1[4]);?></div>
	<div class="box-body"><?php echo "<table width='100%;'><tr><td width='90%;'>$rw1[2]</td></tr></table>";?> </div>
	<div class="box-footer"><a class="btn btn-default btn-flat" data-toggle="myModal4" data-target="#compose-modal2" 
    onclick="pop_dis(<?php echo $rw1[0];?>,'Asignar Permisos');"/><i class="fa fa-pencil"></i> Asignar Permisos</a></div></div></div>
<?php }
if($va==1){ ?>
	<div class="col-md-4"><div class="box" style="min-width:300px; min-height:220px;"></div></div>
<?php }
include("footer.php");
?>