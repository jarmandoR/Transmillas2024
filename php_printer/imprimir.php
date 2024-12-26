<html>
<head>
  <link rel="stylesheet" href="css/imprimir.css">
</head>
<body>
<?php
 	echo "
	<div class='ticket'>
    <img src='images/imprimir.png' alt='Logotipo'>
    <p class='centrado'>FACTURA TRASMILAS
      <br>RESOLUCIÓN:$planillas[0]
      <br>PLANILLA:$planillas[1]
      <br>$fechatiempo</p>
    <table>
      <thead>
        <tr>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class='columna1'>DESTINATARIO:</th>
          <td class='columna2'>$rw[3]</td>
        </tr>
        <tr>
          <th class='columna1'>TÉLEFONO:</th>
          <td class='columna2'>$rw[4]</td>
        </tr>
        <tr>
          <th class='columna1'>CIUDAD:</th>
          <td class='columna2'>$rw[5]</td>
        </tr>
        <tr>
          <th class='columna1'>DIRECCIÓN:</th>
          <td class='columna2'>$rw[6]</td>
        </tr>
        <tr>
          <th class='columna1'>DESCRIPCIÓN:</th>
          <td class='columna2'>$rw[7]</td>
        </tr>
        <tr>
          <th class='columna1'>PIEZAS:</th>
          <td class='columna2'>$rw[8]</td>
        </tr>
        <tr>
          <th class='columna1'>TIPO PAGO:</th>
          <td class='columna2'>$rw[9]</td>
        </tr>
        <tr>
          <th class='columna1'>PRESTAMO:</th>
          <td class='columna2'>$rw[10]</td>
        </tr>
        <tr>
          <th class='columna1'>ABONO:</th>
          <td class='columna2'>$rw[11]</td>
        </tr>
        <tr>
          <th class='columna1'>SEGURO:</th>
          <td class='columna2'>$rw[12]</td>
        </tr>
        <tr>
          <th class='columna1'>CLIENTE:</th>
          <td class='columna2'>$rw[2]</td>
        </tr>
        <tr>
          <th class='columna1'>FIRMA:</th>
          <td class='columna2'></td>
        </tr>

        
      </tbody>
    </table>
    <p class='centrado'>¡GRACIAS POR SU CONFIANZA!
      <br>www.transmillas.com/politica.php</p>
  </div>"; 
 ?>
</body>

</html>