<?php
require("login_autentica.php");
include("cabezote3.php");
include("cabezote1.php");

$fechaini=$_POST["fechaini"];
$fechafin=$_POST["fechafin"];
$cliente=$_POST["cliente"];
$nit=$_POST["nit"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check All Selects</title>
</head>
<body>

<table>
  <tr>
    <td>Row 1</td>
    <td>
      <select>
        <option value="no">No</option>
        <option value="si">Sí</option>
      </select>
      <select>
        <option value="no">No</option>
        <option value="si">Sí</option>
      </select>
      <select>
        <option value="no">No</option>
        <option value="si">Sí</option>
      </select>
    </td>
  </tr>
</table>

<table>
  <tr>
    <td>Row 2</td>
    <td>
      <!-- Esta fila no tiene selects -->
    </td>
  </tr>
</table>

<table>
  <tr>
    <td>Row 3</td>
    <td>
      <select>
        <option value="no">No</option>
        <option value="si">Sí</option>
      </select>
      <select>
        <option value="no">No</option>
        <option value="si">Sí</option>
      </select>
      <select>
        <option value="no">No</option>
        <option value="si">Sí</option>
      </select>
    </td>
  </tr>
</table>

<button id="myButton" style="display: none;">Submit</button>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Función para verificar el estado de todos los selects
    function checkSelects() {
      let allSelectedYes = true;
      const selects = document.querySelectorAll('select');

      selects.forEach(function (select) {
        if (select.value !== 'si') {
          allSelectedYes = false;
        }
      });

      // Mostrar u ocultar el botón basado en el estado de los selects
      const button = document.getElementById('myButton');
      if (allSelectedYes) {
        button.style.display = 'block';
      } else {
        button.style.display = 'none';
      }
    }

    // Llamar a checkSelects al cargar la página
    checkSelects();

    // Agregar evento change a todos los selects para verificar en tiempo real
    const selects = document.querySelectorAll('select');
    selects.forEach(function (select) {
      select.addEventListener('change', checkSelects);
    });
  });
</script>

</body>
</html>