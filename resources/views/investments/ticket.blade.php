<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Inversión</title>
    <style>
        body {
            font-family: 'Courier New', monospace; /* Estilo de fuente monoespaciado para simular impresora de tickets */
            background-color: #f4f4f4;
            color: #333;
            max-width: 300px;
            margin: 30px auto;
            padding: 10px 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-top: 5px dashed #000; /* Borde superior decorativo */
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 18px;
            text-transform: uppercase; /* Mayúsculas para el título */
            margin-bottom: 5px;
        }
        h2 {
            font-size: 14px;
            font-weight: normal;
            margin: 10px 0;
        }
        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse; /* Elimina el espacio entre las celdas */
        }
        th, td {
            text-align: left;
            padding: 5px 0;
        }
        th {
            padding-bottom: 5px;
            border-bottom: 1px dashed #ccc; /* Línea punteada debajo de los encabezados */
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
        .footer p {
            margin: 5px 0; /* Espaciado entre líneas del footer */
        }
    </style>
</head>
<body>
    
    <div>
        <h2>Ticket de Inversión</h2>
        <table>
            <tr>
                <th>ID Transacción:</th>
                <td>{{ $transaction->id }}</td>
            </tr>
            <tr>
                <th>Proyecto:</th>
                <td>{{ $transaction->investment->title }}</td>
            </tr>
            <tr>
                <th>Monto:</th>
                <td>${{ number_format($transaction->amount, 2) }}</td>
            </tr>
            <tr>
                <th>Fecha:</th>
                <td>{{ $transaction->created_at->format('d/m/Y H:i:s') }}</td>
            </tr>
            <tr>
                <th>Inversor:</th>
                <td>{{ $transaction->user->name }}</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p>¡Gracias por su inversión!</p>
      
    </div>
</body>
</html>
