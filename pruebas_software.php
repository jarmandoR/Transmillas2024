
<?php



?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar y Descargar Excel con Handsontable</title>
  <!-- Handsontable CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.css">
 <!-- Estilos CSS -->
 <style>
    /* Estilo para la barra superior */
    .barra-superior {
      background-color: #f0f0f0;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Estilo del botón */
    #descargarExcel {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    Efecto hover en el botón
    #descargarExcel:hover {
      background-color: #0056b3;
    }

    /* Estilo para centrar el loader */
    #loader {
      display: flex;
      justify-content: center;
      align-items: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.8);
      z-index: 9999;
    }

    #loader img {
      width: 100px; /* Tamaño de la imagen */
    }

    #loader h2 {
      margin-left: 10px;
      font-size: 18px;
      color: #555;
    }

    /* Estilo del contenedor de la tabla */
    /* #tabla {
      width: 100%;
      max-width: 1000px;
      margin: 0 auto;
    } */
    </style>
</head>
<body>
  <!-- <h1>Editar y Descargar Excel</h1> -->
  <div class="barra-superior">
    <!-- <h2>Editar</h2> -->
    <button id="descargarExcel">Descargar y guardar Excel</button>
  </div>
    <input type="hidden"  id="param2"  name="param2" value="<?php echo $_GET['param2'];?>">
    <input type="hidden"  id="param3" name="param3" value="<?php echo $_GET['param3'];?>">	
    <input type="hidden"  id="param4" name="param4" value="<?php echo $_GET['param4'];?>">
    <input type="hidden"  id="param5" name="param5" value="<?php echo $_GET['param5'];?>">
    <input type="hidden"  id="param6" name="param6" value="<?php echo $_GET['param6'];?>">
    <input type="hidden"  id="param7" name="param7" value="<?php echo $_GET['param7'];?>">
    <input type="hidden"  id="param9" name="param9" value="<?php echo $_GET['param9'];?>">
    <input type="hidden"  id="param10" name="param10" value="<?php echo $_GET['param10'];?>">
    <input type="hidden"  id="nameArchivo" name="nameArchivo" value="<?php echo $_GET['prefac'];?>">

    <div id="loader" style="display: none;">
        <img src="img/loading.gif" alt="Cargando..." /> <h2>Cargando.....</h2>
    </div>
  <!-- Contenedor para Handsontable -->
  <div id="tabla" style="width: 800px; height: 300px; margin-bottom: 20px;"></div>

  <!-- Botón para descargar como Excel -->
  <!-- <button id="descargarExcel">Descargar Excel</button> -->

  <!-- Handsontable JS -->
  <script src="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.js"></script>
  <!-- SheetJS (xlsx) para exportar a Excel -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

  <script>
    p2=document.getElementById('param2').value;
	p3=document.getElementById('param3').value;	
	p4=document.getElementById('param4').value;
	p5=document.getElementById('param5').value;
	p6=document.getElementById('param6').value;
	p1=document.getElementById('param7').value;
    p9=document.getElementById('param9').value;
    p10=document.getElementById('param10').value;
    nameArchivo=document.getElementById('nameArchivo').value;

    // Paso 1: Obtener los datos desde el servidor usando AJAX (fetch)
// Mostrar el icono de "cargando"
document.getElementById('loader').style.display = 'block';

fetch('datos_facturas.php?param1='+p1+'&param2='+p2+'&param3='+p3+'&param4='+p4+'&param5='+p5+'&param6='+p6+'&pagina=0&idfactura=&preguia=&ver=si')
  .then(response => response.json()) // Convertir respuesta a JSON
  .then(datos => {
    // Ocultar el icono de "cargando" cuando los datos sean recibidos
    document.getElementById('loader').style.display = 'none';

    // Paso 2: Inicializar Handsontable con los datos recibidos
    const contenedor = document.getElementById('tabla');
    
    const tabla = new Handsontable(contenedor, {
      data: datos, // Usar los datos obtenidos desde la consulta MySQL
      rowHeaders: true, // Mostrar encabezados de fila
      colHeaders: ['Fecha Ingreso', '#Guia', '#Relacionado','Remitente', 'Telefono', 'Direccion','Ciudad O','Destinatario','Telefono','Direccion','Ciudad D','Servicio','Prestamo','Piezas','Peso','Volumen','Precio 5 KIlos','Kilos Adicional','Valor Adicionales','Seguro','%Seguro','Flete+%Seguro','Credito','AC','AU','Tipo Servicio','Manifiesto','Carga','Foto','Fecha entrega'], // Encabezados de columnas
      filters: true, // Habilitar filtros
      dropdownMenu: true, // Menú desplegable para filtros
      columnSorting: true, // Habilitar ordenación
      licenseKey: 'non-commercial-and-evaluation', // Uso no comercial
      minSpareRows: 1 // Fila vacía para nuevos datos
    });

    // // Paso 3: Función para exportar a Excel
    // function exportarExcel() {
    //   // Obtener los datos actuales de la tabla
    //   const datosExcel = tabla.getData();
      
    //   // Crear una hoja de Excel
    //   const hojaExcel = XLSX.utils.aoa_to_sheet(datosExcel);
      
    //   // Crear un libro de Excel
    //   const libro = XLSX.utils.book_new();
      
    //   // Añadir la hoja al libro
    //   XLSX.utils.book_append_sheet(libro, hojaExcel, 'Datos');
      
    //   // Descargar el archivo Excel
    //   XLSX.writeFile(libro, 'tabla_datos.xlsx');
    // }
    // Paso 3: Función para exportar a Excel y guardarlo en el servidor
function exportarExcel() {
  // Obtener los datos actuales de la tabla
  const datosExcel = tabla.getData();
  
  // Crear una hoja de Excel
  const hojaExcel = XLSX.utils.aoa_to_sheet(datosExcel);
  
  // Crear un libro de Excel
  const libro = XLSX.utils.book_new();
  
  // Añadir la hoja al libro
  XLSX.utils.book_append_sheet(libro, hojaExcel, 'Datos');

  // Convertir el libro Excel a binario para enviarlo al servidor
  const excelBinario = XLSX.write(libro, { bookType: 'xlsx', type: 'binary' });

  // Crear un objeto Blob a partir del binario
  const blobExcel = new Blob([s2ab(excelBinario)], { type: 'application/octet-stream' });

  // Crear un objeto FormData para enviar el archivo al servidor
  const formData = new FormData();
  
  formData.append('archivo_excel', blobExcel, nameArchivo+'.xlsx');

    // Enviar el archivo al servidor mediante AJAX
    fetch('guardaP_Fecxel.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log('Archivo guardado en el servidor:', data);
    })
    .catch(error => {
        console.error('Error al guardar el archivo en el servidor:', error);
    });

    // Función auxiliar para convertir a binario
    function s2ab(s) {
        const buf = new ArrayBuffer(s.length);
        const view = new Uint8Array(buf);
        for (let i = 0; i < s.length; i++) {
        view[i] = s.charCodeAt(i) & 0xFF;
        }
        return buf;
    }

    // También puedes permitir la descarga local
    XLSX.writeFile(libro, nameArchivo+'.xlsx');
    }

    // Añadir evento al botón para descargar como Excel
    document.getElementById('descargarExcel').addEventListener('click', exportarExcel);
  })
  .catch(error => {
    // Ocultar el icono de "cargando" si ocurre un error
    document.getElementById('loader').style.display = 'none';
    console.error('Error al obtener los datos:', error);
  });
      
  </script>
</body>
</html>