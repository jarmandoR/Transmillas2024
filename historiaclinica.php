<?php 
require("login_autentica.php");
require_once("expdf/lib/pdf/mpdf.php");  
$id_usuario=$_SESSION['usuario_id'];
$id_nombre=$_SESSION['usuario_nombre'];
$nivel_acceso=$_SESSION['usuario_rol'];
$DB = new DB_mssql;
$DB->conectar();
$DB1 = new DB_mssql;
$DB1->conectar();
$DB2 = new DB_mssql;
$DB2->conectar();


 $sql="SELECT idhistoria, his_fecha,his_hora,his_codigo,usu_nombre, tip_nombre,pac_iddocumento, 
`pac_nombre`, `pac_email`, `pac_fechanacimiento`, `pac_sexo`, `est_nombre`, `pac_profesion`, `pac_procedentede`,
 `pac_direccion`, `pac_barrio`, `pac_telefonocasa` , `pac_responsable`, `pac_restelefono`, `pac_acompanante`, 
 `pac_acotelefono`, `pac_EpsArl`,sed_nombre ,`his_motivo`, `his_enfermedadactual`, 
`his_Revisionsis`, `his_antfamiliares`, `his_antpersonales`,  his_antgineco_g, `his_antgineco_p`, `his_antgineco_a`,
`his_antgineco_c`, `his_antgineco_furn`, `his_antgineco_plf`,`his_antgineco_fuc`,`his_antgineco_res`,`his_aparienciageneral`, 
	`his_aparienciag_fc`, `his_aparienciag_fr`, `his_aparienciag_t`, 
	`his_aparienciag_talla`, `his_aparienciag_peso`, `his_tensionarterial`, 
	`his_glasgow`, `his_piel`, 
	`his_cabeza`, `his_ojos`, `his_oidos`, `his_nariz`, `his_boca`, 
	`his_cuello`, `his_orofaringe`, `his_torax`, `his_corazon`, 
	`his_pulmones`, `his_abdomen`, `his_genitourinarios`,
	 `his_estremidades`, `his_neurologia`, `his_osteomuscular`, 
	 `his_linfatico`, `his_apoyodiagnostico`, `his_reporlaboratorio`, 
	`his_diagnostico`, `his_conductatra`, `his_remisionespe`, 
	`his_incapacidad`, `his_indentificacionorigen`, `his_idsede`,`his_estado`
 From historiaclinica inner join usuarios on his_idusuario=idusuarios 
inner join pacientes on his_idpaciente=idpaciente inner join estadocivil on estadocivil_idestadocivil=idestadocivil
inner join sedes on his_idsede=idsede inner join tipodocumento on iddocumento=tipodocumento_idtipodocumento
where idhistoria='$id_param' ";
$DB->Execute($sql); 
$rw=mysqli_fetch_row($DB->Consulta_ID); 

$html="<header>
      <div id='logo'>
        <img src='img/fondopdf2.png' width=800px; height='150px'>
      </div>
    </header>
    <main>
	<div id='citamedica'>
	<table class=''><tr bgcolor='#074F91' class=''><td colspan='6' width='' align='center'   style='color:#FFFFFF' >Datos Personales</td></tr>";
$datoaument=1;
	$html.="<tr class='text'>";
$html.="<td bgcolor='#EFEFEF' >Fecha Cita:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Hora:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Codigo:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="</tr><tr class='text'>";
$html.="<td bgcolor='#EFEFEF' >Medico:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Tipo Documento:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Documento:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
$html.="</tr><tr class='text'>";
$html.="<td bgcolor='#EFEFEF' >Nombre Del Paciente:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Email:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Fecha de nacimiento:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
$html.="</tr><tr class='text'>";
$html.="<td bgcolor='#EFEFEF' >Genero:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Estado Civil:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Profesion:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="</tr><tr class='text'>";
$html.="<td bgcolor='#EFEFEF' >Procedente de:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Direccion de Residencia:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Barrio:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;

$html.="</tr><tr class='text'>";
$html.="<td bgcolor='#EFEFEF' >Tel&eacute;fonos:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Nombre del Responsable:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Tel&eacute;fonos:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
$html.="</tr><tr class='text'>";
$html.="<td bgcolor='#EFEFEF' >Nombre del Acompa&ntilde;ante:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >Tel&eacute;fonos:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<td bgcolor='#EFEFEF' >EPS-ARL:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
$html.="</tr><tr class='text'>";
$html.="<td bgcolor='#EFEFEF' >Sede:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
$html.="<tr>"; 

//echo 	$html;
// $html.=$FB->titulo_azul1("",4,0,9);
 $html.="<tr bgcolor='#074F91' class='tittle3' ><td colspan='4' width='' align='center' ></td></tr>";
 
		$html.="<tr class='text' >";
		$html.="<td>Motivo de la  consulta:</td><td colspan='5' >".utf8_encode($rw[$datoaument])."</td></tr>";  $datoaument++;
		$html.="<tr class='text' bgcolor='#EFEFEF' >";
		$html.="<td>Emfermedad Actual:</td><td colspan='5'   bgcolor='#FFFFFF' >".utf8_encode($rw[$datoaument])."</td></tr>";  $datoaument++;
		$html.="<tr class='text' >";
		$html.="<td>Revision por Sistemas:</td><td colspan='5'  bgcolor='#FFFFFF' >".utf8_encode($rw[$datoaument])."</td></tr>";  $datoaument++;
		$html.="<tr class='text' bgcolor='#EFEFEF' >";
		$html.="<td>Antecedentes Familiares:</td><td  colspan='5'  bgcolor='#FFFFFF'>".utf8_encode($rw[$datoaument])."</td></tr>";  $datoaument++;
		$html.="<tr class='text' >";
		$html.="<td>Antecedentes Personales:</td><td colspan='5'  bgcolor='#FFFFFF' >".utf8_encode($rw[$datoaument])."</td></tr>";  $datoaument++;
		$html.="</table>";		
//$html.=$FB->titulo_azul1("",4,0,9);
 $html.="<table width='100%' ><tr bgcolor='#074F91'   ><td colspan='8'  align='center' ></td></tr>";

			$html.="<tr bgcolor='#074F91' class='tittle3' >
			<td colspan='1' width='' align='center' style='color:#FFFFFF' >G</td>";
			$html.="<td colspan='1' width='' align='center' style='color:#FFFFFF'  >P</td>";
			$html.="<td colspan='1' width='' align='center' style='color:#FFFFFF'  >A</td>";
			$html.="<td colspan='1' width='' align='center' style='color:#FFFFFF'  >C</td>";
			$html.="<td colspan='1' width='' align='center' style='color:#FFFFFF' >FURN</td>";  
			$html.="<td colspan='1' width='' align='center' style='color:#FFFFFF'  >PLF</td>";
			$html.="<td colspan='1' width='' align='center' style='color:#FFFFFF' >FUC</td>";
			$html.="<td colspan='1' width='' align='center' style='color:#FFFFFF'  >RES</td>
			</tr>";

	$html.="<tr class='text'>
		<td >".utf8_encode($rw[$datoaument])."</td>"; $datoaument++;
		$html.="<td >".utf8_encode($rw[$datoaument])."</td>"; $datoaument++;
		$html.="<td >".utf8_encode($rw[$datoaument])."</td>"; $datoaument++;
		$html.="<td >".utf8_encode($rw[$datoaument])."</td>"; $datoaument++;
		$html.="<td >".utf8_encode($rw[$datoaument])."</td>"; $datoaument++;
		$html.="<td >".utf8_encode($rw[$datoaument])."</td>"; $datoaument++;
		$html.="<td >".utf8_encode($rw[$datoaument])."</td>"; $datoaument++;
		$html.="<td >".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
		$html.="</tr>";


//$html.=$FB->titulo_azul1("",4,0,5);

	$html.="</table>";		
 $html.="<table width='100%' ><tr bgcolor='#074F91' class='' ><td colspan='4' width='' align='center' ></td></tr>";

$html.="<tr class='text' >";
	$html.="<td bgcolor='#EFEFEF' >APARIENCIA GENERAL:</td><td>".utf8_encode($rw[$datoaument])."</td>"; $datoaument++;
	$html.="<td bgcolor='#EFEFEF'>FC:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor='#EFEFEF' >FR:</td><td>".utf8_encode($rw[$datoaument])."</td></tr><tr class='text' >";  $datoaument++; 
	
	$html.="<td bgcolor=''>T:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor='' >TALLA:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++;
	$html.="<td bgcolor=''>PESO:</td><td>".utf8_encode($rw[$datoaument])."</td></tr><tr class='text' >";  $datoaument++; 
	
	$html.="<td bgcolor='#EFEFEF' >TENSION ARTERIAL:</td><td>".utf8_encode($rw[$datoaument])."</td>"; 	$datoaument++;
	$html.="<td bgcolor='#EFEFEF'>GLASGOW:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor='#EFEFEF' >PIEL:</td><td>".utf8_encode($rw[$datoaument])."</td></tr><tr class='text' >";  $datoaument++; 
	
	$html.="<td bgcolor=''>CABEZA:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor='' >OJOS:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor=''>OIDOS:</td><td>".utf8_encode($rw[$datoaument])."</td></tr><tr class='text' >";  $datoaument++; 
	
	$html.="<td bgcolor='#EFEFEF' >NARIZ:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor='#EFEFEF'>BOCA:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor='#EFEFEF' >CUELLO:</td><td>".utf8_encode($rw[$datoaument])."</td></tr><tr class='text' >";  $datoaument++; 
	
	$html.="<td bgcolor=''>OROFARINGE:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor='' >TORAX:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor=''>CORAZON:</td><td>".utf8_encode($rw[$datoaument])."</td></tr><tr class='text' >";  $datoaument++; 
	
	$html.="<td bgcolor='#EFEFEF' >PULMONES:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor='#EFEFEF'>ABDOMEN:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor='#EFEFEF' >GENITO URINARIOS:</td><td>".utf8_encode($rw[$datoaument])."</td></tr><tr class='text' >";  $datoaument++; 
	
	$html.="<td bgcolor=''>EXTREMIDADES:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor='' >NEUROLOGIA:</td><td>".utf8_encode($rw[$datoaument])."</td>";  $datoaument++; 
	$html.="<td bgcolor=''>OSTEOMOSCULAR:</td><td>".utf8_encode($rw[$datoaument])."</td></tr><tr class='text' >";  $datoaument++; 
	
	$html.="<td bgcolor='#EFEFEF' >LINFATICO:</td><td>".utf8_encode($rw[$datoaument])."</td>"; 	$datoaument++; 
	$html.="<td bgcolor='#EFEFEF'></td><td ></td></tr>";
	
	// $html.=$FB->cierra_tabla();  
	// $html.=$FB->titulo_azul1("",4,0,5);
	
		$html.="</table>";		
 $html.="<table width='100%'  ><tr bgcolor='#074F91' class='tittle3' ><td colspan='4' width='' align='center' ></td></tr>";


		$html.="<tr class='text' bgcolor='#EFEFEF' >";
		$html.="<td>Apoyo Diagnostico:</td><td  colspan='2'  bgcolor='#FFFFFF' >".utf8_encode($rw[$datoaument])."</td>"; 	$datoaument++; 
		$html.="<td>Reporte De Laboratorio:</td><td  colspan='2'  bgcolor='#FFFFFF' >".utf8_encode($rw[$datoaument])."</td></tr>"; 	$datoaument++; 
		$html.="<tr class='text' bgcolor='' >";
		$html.="<td>Diagnostico:</td><td colspan='2'  bgcolor='#FFFFFF' >".utf8_encode($rw[$datoaument])."</td>"; 	$datoaument++; 
		$html.="<td>Cunducta/Tratamiento:</td><td colspan='2'  bgcolor='#FFFFFF' >".utf8_encode($rw[$datoaument])."</td></tr>"; 	$datoaument++; 
		$html.="<tr class='text' bgcolor='#EFEFEF' >";
		$html.="<td>Remision A Especialista:</td><td  colspan='2'  bgcolor='#FFFFFF'>".utf8_encode($rw[$datoaument])."</td>"; 	$datoaument++; 
		$html.="<td>Incapacidad:</td><td colspan='2' bgcolor='#FFFFFF' >".utf8_encode($rw[$datoaument])."</td><tr>"; 	$datoaument++; 
		$html.="<tr class='text' bgcolor='' >";
		$html.="<td>Origen De La Enfermedad:</td><td colspan='5'  >".utf8_encode($rw[$datoaument])."</td><tr>"; 	$datoaument++; 
						
		//$html.=$FB->cierra_tabla(); 
	 $html.="</table>";	
 
 	$html.='</div></main><footer></footer>';
 	$mpdf=new mPDF('c','A4');
	$css= file_get_contents('css/style.css');
	$mpdf->writeHTML($css,1);
	$mpdf->writeHTML($html);
	//$mpdf->Output('reporte.pdf','I');  
	$mpdf->Output('citamedica.pdf','D');   
?>