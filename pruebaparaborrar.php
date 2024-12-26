<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copiar columna a Excel</title>
</head>
<body>
    <table id="myTable" border="1">
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
        </tr>
        <tr>
            <td>Juan Pérez</td>
            <td>juan@example.com</td>
            <td>123456789</td>
        </tr>
        <tr>
            <td>María García</td>
            <td>maria@example.com</td>
            <td>987654321</td>
        </tr>
        <tr>
            <td>Carlos Ruiz</td>
            <td>carlos@example.com</td>
            <td>555555555</td>
        </tr>
    
    <br>
    <!-- El índice de la columna 'Correo' es 1 -->
    <button onclick="copyColumnToClipboard(1)">Copiar Columna 'Correo'</button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function copyColumnToClipboard(columnIndex) {
                const table = document.getElementById('myTable');
                let columnText = '';

                // Recorrer las filas de la tabla y obtener el texto de la columna especificada
                for (let i = 0; i < table.rows.length; i++) {
                    columnText += table.rows[i].cells[columnIndex].innerText + '\n';
                }

                // Crear un elemento textarea para copiar al portapapeles
                const textarea = document.createElement('textarea');
                textarea.value = columnText;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);

                alert('Columna copiada al portapapeles');
            }
            window.copyColumnToClipboard = copyColumnToClipboard;
        });
    </script>
</body>
</html>