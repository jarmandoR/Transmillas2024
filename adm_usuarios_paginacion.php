<?php
require("login_autentica.php");
include("cabezote3.php");
include("cabezote1.php");


$sql=$_POST['query'];
$conde=$_POST['conde'];
$conde1=$_POST['conde1'];
$mostrarPor=$_POST['mostrarPor'];
// $sql3=$_POST['query'];

// $cadena_original = $sql;
// $palabra_especifica = "FROM";
// $palabra_nueva = "SELECT count(*) ";

// // Encuentra la primera aparición de la palabra específica
// $subcadena_desde_palabra = strstr($cadena_original, $palabra_especifica);

// if ($subcadena_desde_palabra !== false) {

//     // Reemplaza la parte inicial con una cadena vacía
//     $sql3 = $palabra_nueva . $subcadena_desde_palabra;
//     // echo $cadena_modificada;
// } else {
//     // echo "La palabra específica no fue encontrada en la cadena.";
// }

$sql3="SELECT count(*)  FROM usuarios INNER JOIN roles ON roles_idroles=idroles and idusuarios!=1 $conde $conde1  ORDER BY usu_nombre $asc";
$DB1->Execute($sql3); 
$cantdatos=$DB1->recogedato(0);
$canBotones = $cantdatos/$mostrarPor;
// $canBotones = round($canBotones);

if (is_float($canBotones)) {
    $canBotones=$canBotones+1;
    // echo "El número es decimal.";
} 
if ($mostrarPor==50) {
	$s50="selected";
}else if ($mostrarPor==200) {
	$s200="selected";
}
else if ($mostrarPor==500) {
	$s500="selected";
}
else if ($mostrarPor==10000) {
	$todos="selected";
}

echo"<input type='hidden' id='cantidad' value='$canBotones'>";
echo "<section class='paginacion' id='mostrarPor'><ul ><li>Mostrar <select onChange='cambiarPagina(1,this.value)' ><option value='50' $s50 >50</option><option value='200' $s200>200</option><option value='500' $s500>500</option><option value='10000' $todos>Todos..</option></select></li><li><a>Total Registros: $cantdatos </a></li><li ></li>";
for($i=1; $i<=$canBotones;$i++){
	//Se valida la paginacion total
	//de registros
	// if($i<=$cantdatos){
		//Validamos la pag activo
	//   if($i==$compag){

	//   echo "<li><a href=\"?pag=".$i."\" class=\"active\">".$i."</a></li>";

	//   }else {

		  echo "<li><a href='javascript:cambiarPagina($i);' id='$i'  >".$i."</a></li>";

	//   }     		

	// }

}
echo "<li class=\"active\"></li></ul>";




$FB->titulo_azul6("Rol",1,0,5,"rol_nombre",$asc2); 
$FB->titulo_azul6("Nombre",1,0,0,"usu_nombre",$asc2); 
$FB->titulo_azul1("CC",1,100,0); 
$FB->titulo_azul1("Usuario",1,100,0); 
$FB->titulo_azul1("Profesion",1,0,0); 
$FB->titulo_azul1("Firma/Huella",1,0,0);
$FB->titulo_azul1("Foto",1,0,0);
$FB->titulo_azul1("Contrato",1,0,0);
$FB->titulo_azul1("Laborando en sistema",1,0,0); 
$FB->titulo_azul1("Ver en sistema ",1,0,0); 
$FB->titulo_azul1("Ver en Nomina ",1,0,0); 
$FB->titulo_azul3("Acciones",2,0,2,$param_edicion);
$DB->Execute($sql); 
while($rw=mysqli_fetch_row($DB->Consulta_ID)){
	$va++; $p=$va%2; $id_p=$rw[0];
	if($p==0){$color="#FFFFFF";} else{$color="#EFEFEF";}
    
	echo "<tr bgcolor='$color' class='text' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
	echo "<td onclick='pop_dis(\"$rw[3]\", \"Usuarios-Roles\");' style='cursor: pointer;' title='Haga click aqui para asignar roles al usuario'>$rw[1]</td>
	<td onclick='pop_dis2(\"$rw[0]\", \"Detalle Usuario\");' style='cursor: pointer;' title='Haga click aqui para detalles del usuario'>$rw[2]</td>";

	echo "<td align='center'>$rw[6]</td><td align='center'>$rw[4]</td><td align='center'>$rw[5]</td>";
	$sql1="SELECT doc_ruta FROM documentos WHERE doc_idviene='$id_p' AND doc_tabla='Usuario' and doc_version=1 ORDER BY doc_fecha DESC ";
	$DB1->Execute($sql1);
	$ruta=$DB1->recogedato(0);

	$sql1="SELECT doc_ruta FROM documentos WHERE doc_idviene='$id_p' AND doc_tabla='Usuario' and doc_version=2 ORDER BY doc_fecha DESC ";
	$DB1->Execute($sql1);
	@$firma=$DB1->recogedato(0);	

	
	echo "<td align='center'><a href='$ruta' target='_blank'><img src='$ruta' width='50'></a></td><td align='center'><a href='$firma' target='_blank'><img src='$firma' width='50'></a></td>";
	if($rw[9]==''){
		$rw[9]='Actualizar';
	}
	echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($id_p,\"tipocontrato\",\"$rw[9]\")';  title='contrato' >$rw[9]</td>";
	$colorselect1="";
	$st1="";
	$st2="";
	echo "<td><div id='inactivo'>"; if($rw[7]==1){ $st1="selected"; $colorselect1="style='background-color:rgb(7, 79, 145); color:#FFFFFF;'"; } else { $colorselect1="style='background-color:#8B0000; color:#FFFFFF;'"; $st2="selected"; } 
	echo "<select  data-target='$id_p' name='param14' id='param14' $colorselect1 class='form-control' onChange='cambioEstado(this.value, 65, \"inactivo$va\", $id_p)' required>";

	// $LT->llenaselect_ar($st,$estado_pro);
	echo"<option value='0' $st2 >Inactivo</option>";
	echo"<option value='1' $st1 >Activo</option>";
	
	echo "</select></div>";
	echo "<input type='date'  id='$id_p' class='dateInput' style='display: none;' onchange='cambiofechafin(this.value,$rw[6])'></td>";
	$colorselect2="";
	$st3="";
	$st4="";
	
	echo "<td><div id='inactivo'>"; if($rw[10]==1){ $st3="selected"; $colorselect2="style='background-color:rgb(7, 79, 145); color:#FFFFFF;'";} else { $st4="selected"; $colorselect2="style='background-color:#8B0000; color:#FFFFFF;'";} 
	echo "<select name='param15' id='param15' $colorselect2 class='form-control' onChange='cambioEstado(this.value, 80, \"inactivo$va\", $id_p)' required>";
	// $LT->llenaselect_ar($st,$estado_pro);
	echo"<option value='0'  $st4 >Inactivo</option>";
	echo"<option value='1' $st3 >Activo</option>";
	echo "</select></div></td>";
	$st5="";
	$st6="";
	echo "<td><div id='inactivo'>"; if($rw[11]==1){ $st5="selected"; $colorselect3="style='background-color:rgb(7, 79, 145); color:#FFFFFF;'";} else { $st6="selected"; $colorselect3="style='background-color:#8B0000; color:#FFFFFF;'";} 
	echo "<select name='param16' id='param16' $colorselect3 class='form-control' onChange='cambioEstado(this.value, 801, \"inactivo$va\", $id_p)' required>";
	// $LT->llenaselect_ar($st,$estado_pro);
	echo"<option value='0' $st6>Inactivo</option>";
	echo"<option value='1' $st5>Activo</option>";
	echo "</select></div></td>";
	$DB->edites($id_p, "Usuario", $param_edicion, $condecion);
	echo "</tr>";
   
}





?>