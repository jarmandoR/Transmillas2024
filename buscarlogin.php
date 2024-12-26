<?php
require("login_autentica.php"); //coneccion bade de datos
$DB1 = new DB_mssql;
$DB1->conectar();
$DB = new DB_mssql;
$DB->conectar();

//Obtenemos los datos de los input


// Definir las columnas que se mostrarán en la datatable
$columns = array(
	'idusername',
	'username',
	'rolname',
	'ip',
	'login_date',
	'device_type'
  );

  // Definir los nombres de las columnas para la tabla
$column_names = array(
	"idusername" => "idusername",
	"username" => "username",
	"rolname" => "rolname",
	"ip" => "ip",
	"login_date" => "login_date",
	"device_type" => "device_type"
);
  
  // Obtener los filtros de búsqueda
  $fecha = $_POST['fecha'];
  $usuario = $_POST['usuario'];
  
  // Construir la consulta SQL con los filtros de búsqueda
  $sql = "SELECT  idusername, username, rolname, ip, login_date, REPLACE(device_type, '/', ' ') as device_type  FROM userslogin WHERE 1=1";
  if (!empty($fecha)) {
	$sql .= " AND login_date like '$fecha%'";
  }
  if (!empty($usuario)) {
	$sql .= " AND idusername = '$usuario'";
  }
  
  // Obtener el total de registros de la tabla
  $DB->Execute($sql); 
  $total=$DB->numregistros();   
 // $total = mysqli_num_rows(mysqli_query($DB->Consulta_ID));
  
  // Obtener los registros que se mostrarán en la página actual
  $sql .= " ORDER BY id ASC LIMIT " . $_POST['start'] . ", " . $_POST['length'];

  $resultado = $DB1->Execute($sql); 
  

// Construir el arreglo JSON con los datos de la tabla
$data = array();
while ($row = $resultado->fetch_assoc()) {
	/* $sub_array = array();
	foreach ($columns as $column) {
	  $sub_array[] = $row[$column];
	} */
	$data[] = $row;
}
  
// Devolver el arreglo JSON a la datatable
$json_data = array(
	"draw" => intval($_POST['draw']),
	"recordsTotal" => intval($total),
	"recordsFiltered" => intval($total),
	"data" => $data
);
echo json_encode($json_data);

 

?>