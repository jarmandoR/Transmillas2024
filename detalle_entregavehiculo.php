 <?php 
require("login_autentica.php");
include("declara.php");

@$accion=$_REQUEST["accion"];
@$condecion=$_REQUEST["condecion"];
@$condecion=$_REQUEST["condecion"];
$fechatiempo=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");
@$idhojadevida=$_REQUEST["idhojadevida"];

switch ($condecion)
{
	case "entregadevehiculo":
	
		$sql1="INSERT INTO `entregavehiculo`(`ent_fechaentrega`, `ent_vehiculo`, `ent_userregistra`, `ent_idhojadevida`, `ent_fecharegistra`) 
		VALUES('$param1','$param2','$id_nombre','$idhojadevida','$fecha')";
		 $vinculo=$DB->Executeid($sql1);

$sql="SELECT `identregavehiculo`, `ent_fechaentrega`, `ent_vehiculo`, `ent_userregistra`, `ent_idhojadevida`, `ent_fecharegistra` FROM `entregavehiculo` WHERE  ent_idhojadevida=$idhojadevida and identregavehiculo='$vinculo'";

$DB->Execute($sql); 
$va=0; 

while($rw1=mysqli_fetch_row($DB->Consulta_ID))
{
			$id_p=$rw1[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "<td>".$rw1[1]."</td>
			<td>".$rw1[2]."</td>
			<td>".$rw1[3]."</td>		
			<td>".$rw1[5]."</td>";		

			//echo $LT->llenadocs3($DB1, "entregavehiculo",$id_p, 1, 35, 'Ver');
		if($nivel_acceso==1 or $nivel_acceso==12){
			$DB->edites($id_p, "entregavehiculo", 2,"$idhojadevida");
		}
}


			
break;
	case "tecnopreventiva":

		if (is_uploaded_file($_FILES['param82']['tmp_name'])) {
			$imagen = md5(date("Y-m-d-H-i-s").rand(0,9999).$_SESSION['usuario_id']).".jpg";
			move_uploaded_file($_FILES['param82']['tmp_name'],"./imagenrevision/".$imagen);
		}

		 $sql1="INSERT INTO `revisionvehiculo`(`rev_fecha`, `rev_idvehiculo`, `rev_ingreso`, `rev_usuvehiculo`, `rev_usuregistra`,`rev_identifiuser`,`rev_foto`) 
		VALUES('$param80','$param81','$param12','$idhojadevida',' $param11',' $param13','$imagen')";

		$vinculo=$DB->Executeid($sql1);

$sql="SELECT `idrevisionvehiculo`,`rev_fecha`,`rev_idvehiculo`,`rev_usuregistra`,`rev_usuvehiculo`, `rev_ingreso`, `rev_foto`FROM `revisionvehiculo` WHERE  rev_usuvehiculo=$idhojadevida and idrevisionvehiculo='$vinculo'";

$DB->Execute($sql); 
$va=0; 

while($rw2=mysqli_fetch_row($DB->Consulta_ID))
{
			$id_p=$rw2[0];
			$va++; $p=$va%2;
			if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
			echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
			echo "<td>".$rw2[1]."</td>
			<td>".$rw2[2]."</td>
			<td>".$rw2[3]."</td>		
			<td>".$rw2[5]."</td>	
			<td><a href='imagenrevision/".$rw2[6]."' target='_blank'><img src='imagenrevision/".$rw2[6]."' width='20'>ver</a></td>";

		if($nivel_acceso==1 or $nivel_acceso==12){
			$DB->edites($id_p, "revisionvehiculo", 2,"$idhojadevida");
		}
}

	break;
}

?> 

