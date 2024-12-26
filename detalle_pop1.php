<?php
require("login_autentica.php");
include("cabezote1.php");
include("permisos.php");
if(isset($_REQUEST["id_param"])) {$id_param=$_REQUEST["id_param"]; } else { $id_param=""; } 
if(isset($_REQUEST["tabla"])) {$tabla=$_REQUEST["tabla"]; } else { $tabla=""; } 
$DB2 = new DB_mssql;
$DB2->conectar();
$DB3 = new DB_mssql;
$DB3->conectar();
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="modal-header"><h4 class="modal-title"><?php echo utf8_decode($tabla); ?></h4></div>
<div align="center">
<?php 
if($tabla=="Avance indicador") {
	$sql1="SELECT mar_meta, mar_nombre, met_peso FROM metas INNER JOIN marcologico ON marcologico_idmarcologico=idmarcologico AND idmetas='$id_param'";
	$DB1->Execute($sql1); 
	$rw1=mysqli_fetch_row($DB1->Consulta_ID);
	$met=$rw1[0]; $ind=$rw1[1]; $foca=$rw1[2]; 
	if($ind==""){
		$sql1="SELECT met_nombre, met_peso FROM metas WHERE idmetas='$id_param'";
		$DB1->Execute($sql1); 
		$rw1=mysqli_fetch_row($DB1->Consulta_ID); $ind=$rw1[0]; $foca=$rw1[1]; 
	}
	$valor=valor_indicador($DB1, $id_param, $cond_reportes, "", $foca);
?>
	<script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Valor", { role: "style" } ],
            ["Meta", <?php echo $met; ?>, "#000080"],
            ["Valor actual", <?php echo $valor; ?>, "#009933"],
          ]);
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,{ calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" }, 2]);
          var options = { title: "<?php echo $ind; ?>", width: 600, height: 400, bar: {groupWidth: "95%"}, legend: { position: "none" },};
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
      }
    </script>
	<div id="columnchart_values" style="width: 100%; height: 400px;" align="center"></div>
<?php } elseif($tabla=="Evolución Avance"){
	$sql1="SELECT mar_meta, mar_nombre, met_peso FROM metas LEFT JOIN marcologico ON marcologico_idmarcologico=idmarcologico AND idmetas='$id_param'";
	$DB1->Execute($sql1); 
	$rw1=mysqli_fetch_row($DB1->Consulta_ID);
	$met=$rw1[0]; $ind=$rw1[1]; $fech=date("Y-m-d"); $foca=$rw1[2]; 
	if($ind==""){
		$sql1="SELECT met_nombre, met_peso FROM metas WHERE idmetas='$id_param'";
		$DB1->Execute($sql1); 
		$rw1=mysqli_fetch_row($DB1->Consulta_ID); $ind=$rw1[0]; $foca=$rw1[1]; 
	} 
?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Meta', 'Valor'],
		  <?php   $valo=0; 
			$fech=$FB->desciende_feca($fech, 180);
		  	for($i=0; $i<6; $i++)
		  	{
				$fech=$FB->aumenta_feca($fech, 30);
				$anio=substr($fech,0,4);
				$mont=substr($fech,5,2);
				$cond=" AND YEAR(res_fecha)<='$anio' AND MONTH(res_fecha)<='$mont' ";
				$cond1=$cond_reportes;
				$valor=valor_indicador($DB1, $id_param, $cond1, $cond, $foca);
				$valo=$valo+$valor;
				if($met==""){ $met=0; }
				echo "['$anio $mont', $met, $valor],";
		  	}
		  ?>
        ]);
        var options = {
          title: "<?php echo $ind; ?>", width: "100%", height: "90%",
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
      }
	</script>
    <div id="curve_chart" style="width: 100%; height: 400px;" align="center"></div>
<?php } elseif($tabla=="Evolución Avance Carga"){
	$sql="SELECT pro_alias FROM proyectos WHERE idproyectos='$id_param' ";
	$DB1->Execute($sql); $fech=date("Y-m-d");
	$ind=$DB1->recogedato(0); ?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Meta', 'Valor'],
		  <?php  $valo=0; $met=100;
			$fech=$FB->desciende_feca($fech, 180);
		  	for($i=0; $i<6; $i++)
		  	{
				$fech=$FB->aumenta_feca($fech, 30);
				$anio=substr($fech,0,4);
				$mont=substr($fech,5,2);
				$cond_reportes="SELECT COUNT(DISTINCT(idieducativas)) FROM ieducativas a INNER JOIN ciudades ON a.usu_idsede=idciudades
				INNER JOIN departamentos ON iddepartamentos=departamentos_iddepartamentos INNER JOIN gestoresie ON idieducativas=ieducativas_idieducativas INNER JOIN gestores 
				ON gestores_idgestores=idgestores INNER JOIN usuarios ON idusuarios=usuarios_idusuarios INNER JOIN proyectos ON roles_idroles=pro_diligencia
				AND idproyectos='$id_param' ";
				$DB2->Execute($cond_reportes); 
				$cpro=$DB2->recogedato(0);
				$cond="WHERE YEAR(res_fecha)<='$anio' AND MONTH(res_fecha)<='$mont' ";
				$valor=avance_gestion1($DB2, $DB1, 0, $cpro, $id_param, 0, $cond);  
				$valo=$valo+$valor;
				if($met==""){ $met=0; }
				echo "['$anio $mont', $met, $valor],";
		  	}
		  ?>
        ]);
        var options = {
          title: "<?php echo $ind; ?>", width: "100%", height: "90%",
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
      }
	</script>
    <div id="curve_chart" style="width: 100%; height: 400px;" align="center"></div>
<?php } elseif($tabla=="Avance Carga"){
	$sql="SELECT pro_alias FROM proyectos WHERE idproyectos='$id_param' ";
	$DB1->Execute($sql); 
	$ind=$DB1->recogedato(0);
	$cond_reportes="SELECT COUNT(DISTINCT(idieducativas)) FROM ieducativas a INNER JOIN ciudades ON a.usu_idsede=idciudades
	INNER JOIN departamentos ON iddepartamentos=departamentos_iddepartamentos INNER JOIN gestoresie ON idieducativas=ieducativas_idieducativas INNER JOIN gestores 
	ON gestores_idgestores=idgestores INNER JOIN usuarios ON idusuarios=usuarios_idusuarios INNER JOIN proyectos ON roles_idroles=pro_diligencia
	AND idproyectos='$id_param' ";
	$DB2->Execute($cond_reportes); 
	$cpro=$DB2->recogedato(0);
	$valor=avance_gestion1($DB2, $DB1, 0, $cpro, $id_param, 0, "WHERE res_orden!='20000000000' ");  
?>
	<script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Valor", { role: "style" } ],
            ["Meta", <?php echo 100; ?>, "#000080"],
            ["Valor actual", <?php echo $valor; ?>, "#009933"],
          ]);
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,{ calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" }, 2]);
          var options = { title: "<?php echo $ind; ?>", width: 600, height: 400, bar: {groupWidth: "95%"}, legend: { position: "none" },};
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
      }
    </script>
	<div id="columnchart_values" style="width: 100%; height: 400px;" align="center"></div>
<?php } elseif($tabla=="Distribucion Alarmas"){
	$sql1="SELECT met_nombre FROM metas WHERE idmetas='$id_param'";
	$DB1->Execute($sql1); 
	$rw1=mysqli_fetch_row($DB1->Consulta_ID);
	$ind=$rw1[0]; 
?>
	<script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Valor", { role: "style" } ],
		<?php
		$sqls="SELECT DISTINCT(ala_tabla), ala_tabla FROM alarmas ";
		$DB->Execute($sqls);  $i=0;
		while($rw1=mysqli_fetch_row($DB->Consulta_ID)){
			$valor=reporte_alarmas($DB1, "WHERE ala_tabla='$rw1[0]'");
			if($valor==""){$valor=0;} else { $valor=number_format($valor,0,"",""); } 
        	echo "['$rw1[1]', $valor, '$colora[$i]'],"; $i++; if($i==14){$i=0;}
		} ?> 
          ]);
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,{ calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" }, 2]);
          var options = { title: "<?php echo $ind; ?>", colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'], width: 500, height: 300, bar: {groupWidth: "95%"},
		  legend: { position: "none" },};
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
      }
    </script>
    <div id="columnchart_values" align="center" style="width:55%; position:absolute; left:3%; height:310px; overflow:auto;" align="center"></div>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
		<?php
		$sqls="SELECT iddepartamentos, dep_nombre FROM departamentos ORDER BY dep_nombre";
		$DB1->Execute($sqls); 
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID)){
			$cond=" INNER JOIN ieducativas a ON usuarios_idusuarios=idieducativas INNER JOIN gestoresie ON ieducativas_idieducativas=idieducativas  
			INNER JOIN gestores ON gestores_idgestores=idgestores INNER JOIN ciudades ON a.usu_idsede=idciudades AND departamentos_iddepartamentos='$rw1[0]'";
			$valor=reporte_alarmas($DB2, $cond);
			if($valor==""){$valor=0;}
        	echo "['$rw1[1]', $valor],";
		} ?> 
        ]);
        var options = {'title':'<?php echo $ind; ?>','width':400,'height':300};
        var chart1 = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart1.draw(data, options);
      }
    </script>
    <div id="chart_div" align="center" style="left:55%; position:absolute; width:43%; height:310px; overflow:auto;" ></div>
<?php } elseif($tabla=="Distribución Avance"){ 
	$sql1="SELECT mar_meta, mar_nombre, proyectos_idproyectos, met_peso, int_prefijo, int_sufijo FROM metas INNER JOIN marcologico ON marcologico_idmarcologico=idmarcologico 
	INNER JOIN tiposindicadores ON met_tipo=idtiposindicadores AND idmetas='$id_param'";
	$DB1->Execute($sql1); 
	$rw1=mysqli_fetch_row($DB1->Consulta_ID);
	$met=$rw1[0]; $ind=$rw1[1]; $id_proyecto=$rw1[2]; $foca=$rw1[3]; $pref=$rw1[4]; $suff=$rw1[5]; $fech=date("Y-m-d"); 
	if($ind==""){
		$sql1="SELECT met_nombre, proyectos_idproyectos, met_peso, int_prefijo, int_sufijo FROM metas INNER JOIN tiposindicadores ON met_tipo=idtiposindicadores
		WHERE idmetas='$id_param'";
		$DB1->Execute($sql1); 
		$rw1=mysqli_fetch_row($DB1->Consulta_ID);
		$ind=$rw1[0]; $id_proyecto=$rw1[1]; $foca=$rw1[2]; $pref=$rw1[3]; $suff=$rw1[4];
	} 
?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
		<?php 
		$sqls="SELECT iddepartamentos, dep_nombre FROM departamentos ORDER BY dep_nombre";
		$DB1->Execute($sqls); 
		while($rw1=mysqli_fetch_row($DB1->Consulta_ID)){
			$cond="	AND iddepartamentos='$rw1[0]'  ";
			$valor=valor_indicador($DB, $id_param, $cond_reportes, $cond, $foca);
			if($valor==""){$valor=0;} $valo[$rw1[0]]=$valor;
        	echo "['$rw1[1]', $valor],";
		} ?> 
        ]);
        var options = {'title':'<?php echo $ind; ?>','width':"100%",'height':300};
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  	<div id="chart_div" align="center" style="width:40%; position:absolute; left:0;"></div>
	<div id="mapa" style="width:60%; height:380px; position:absolute; left:40%; overflow:auto;" align="center"></div>
    <link href="Content/MapORamaStyles.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="js/gomap.js"></script> 
    <script type="text/javascript">
            var constants = { 'activos': 'img/icon2.png', 'suspendidos': 'img/icon5.png', 'alerta': 'img/icon3.png', 'atrasados': 'img/icon4.png'};
            var proySuspendidos = false;
            var proyAlerta = false;
            var proyAtrasados = false;
            $(function () {
                $("#mapa").goMap({ latitude: 5.637184, longitude: -74.072463, maptype: 'ROADMAP', zoom: 6 });
    <?php  
	$sqls="SELECT iddepartamentos, dep_nombre FROM departamentos ORDER BY dep_nombre";
	$DB1->Execute($sqls); 
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID)){
		$valor=$valo[$rw1[0]];
	    $sel="SELECT idciudades, ciu_nombre, ciu_latitud, ciu_longitud FROM ciudades WHERE departamentos_iddepartamentos='$rw1[0]' AND ciu_latitud!='' ORDER BY ciu_codigo ASC";
    	$DB->Execute($sel);  
		$rw2=mysqli_fetch_row($DB->Consulta_ID);
		if($valor==""){$valor=0;}
    ?>			
               $.goMap.createMarker({
                    latitude: <?php echo $rw2[2]; ?>, 
                    longitude: <?php echo $rw2[3]; ?>, 
                    title: '<?php echo $rw1[1]; ?>',
                    group: 'ACTGroup',
                    <?php if($valor==0){?> icon: constants.alerta, <?php
                    }else{?>icon: constants.activos,<?php } ?>
                    html: '<?php echo "Departamento: $rw1[1]<br><br>Valor: $pref".number_format($valor,2,",",".")."$suff"; ?>'
                });
    <?php  }  ?>			
                $("#ActivosCheckbox").click(function () {
                    if ($('#ActivosCheckbox').is(':checked')) { $.goMap.showHideMarkerByGroup('ACTGroup', true) } 
					else { $.goMap.showHideMarkerByGroup('ACTGroup', false) }
                });
           }); 
        </script> 
<?php } elseif($tabla=="Distribución Avance Carga"){ 
	$sql="SELECT pro_alias FROM proyectos WHERE idproyectos='$id_param' ";
	$DB1->Execute($sql); $fech=date("Y-m-d");
	$ind=$DB1->recogedato(0);
	$met=100; $ind=$rw1[0];  	 
?>
	<script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Valor", { role: "style" } ],
		<?php 
		$sqls="SELECT iddepartamentos, dep_nombre FROM departamentos ORDER BY dep_nombre";
		$DB->Execute($sqls);  $i=0;
		while($rw1=mysqli_fetch_row($DB->Consulta_ID)){
			$cond_reportes="SELECT COUNT(DISTINCT(idieducativas)) FROM ieducativas a INNER JOIN ciudades ON a.usu_idsede=idciudades
			INNER JOIN departamentos ON iddepartamentos=departamentos_iddepartamentos INNER JOIN gestoresie ON idieducativas=ieducativas_idieducativas INNER JOIN gestores 
			ON gestores_idgestores=idgestores INNER JOIN usuarios ON idusuarios=usuarios_idusuarios INNER JOIN proyectos ON roles_idroles=pro_diligencia
			AND idproyectos='$id_param' AND iddepartamentos='$rw1[0]'   ";
			$DB2->Execute($cond_reportes); 
			$cpro=$DB2->recogedato(0);
			$cond=" INNER JOIN ieducativas a ON res_respuesta=idieducativas  INNER JOIN ciudades ON a.usu_idsede=idciudades
			INNER JOIN departamentos ON iddepartamentos=departamentos_iddepartamentos INNER JOIN gestoresie ON idieducativas=ieducativas_idieducativas INNER JOIN gestores 
			ON gestores_idgestores=idgestores AND iddepartamentos='$rw1[0]'  ";
			$valor=avance_gestion1($DB2, $DB1, 0, $cpro, $id_param, 0, $cond);  
			$valo[$rw1[0]]=$valor;
			if($valor==""){$valor=0;} else { $valor=number_format($valor,0,"",""); } 
        	if($valor>0){ echo "['$rw1[1]', $valor, '#0065FE'],"; }
			$i++; if($i==14){$i=0;}
		}  ?> 
          ]);
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,{ calc: "stringify", sourceColumn: 1, type: "string", role: "annotation" }, 2]);
          var options = { title: "Avance <?php echo $ind." $par"; ?>",width:490,height:450,chartArea:{width:"65%",height:"85%"},isStacked:false,legend:'none', fontSize: 10, 
		  colors: ['#0065FE']};
          var chart = new google.visualization.BarChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);  
      }
    </script>
    <div id="columnchart_values" align="center" style="width:49%; position:absolute; left:0; height:400px; overflow:auto;"></div>
    <div id="mapa" style="width:50%;  height:400px; position:absolute; left:50%; overflow:auto;" align="center"></div>
    <link href="Content/MapORamaStyles.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="js/gomap.js"></script> 
        <script type="text/javascript">
            var constants = { 'activos': 'img/icon2.png', 'suspendidos': 'img/icon5.png', 'alerta': 'img/icon3.png', 'atrasados': 'img/icon4.png',};
            var proySuspendidos = false;
            var proyAlerta = false;
            var proyAtrasados = false;
            $(function () {
                $("#mapa").goMap({ latitude: 5.637184, longitude: -74.072463, maptype: 'ROADMAP', zoom: 6 });
    <?php  
	$sqls="SELECT iddepartamentos, dep_nombre FROM departamentos ORDER BY dep_nombre";
	$DB1->Execute($sqls); 
	while($rw1=mysqli_fetch_row($DB1->Consulta_ID)){
		$valor=$valo[$rw1[0]];
	    $sel="SELECT idciudades, ciu_nombre, ciu_latitud, ciu_longitud FROM ciudades WHERE departamentos_iddepartamentos='$rw1[0]' AND ciu_latitud!='' ORDER BY ciu_codigo ASC";
    	$DB->Execute($sel);  
		$rw2=mysqli_fetch_row($DB->Consulta_ID);
		if($valor==""){$valor=0;}
    ?>			
                $.goMap.createMarker({
                    latitude:<?php echo $rw2[2]; ?>, 
                    longitude: <?php echo $rw2[3]; ?>, 
                    title: '<?php echo $rw1[1]; ?>',
                    group: 'ACTGroup',
                    <?php if($valor==0){?> icon: constants.alerta, <?php
                    }else{?>icon: constants.activos,<?php } ?>
                    html: '<?php echo "Departamento: $rw1[1]<br>Valor avance: ".number_format($valor,2,".",".")."%"; ?>'
                });
    <?php  }  ?>			
                $("#ActivosCheckbox").click(function () {
                    if ($('#ActivosCheckbox').is(':checked')) { $.goMap.showHideMarkerByGroup('ACTGroup', true) } 
					else { $.goMap.showHideMarkerByGroup('ACTGroup', false) }
                });
           }); 
        </script> 
<?php }  ?>
</div>