<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
        }
    </style>
</head>
<body>
    <div style="margin:10px 10px 30px">
        <h2>Corrida</h2>
        <ul style="list-style:none;margin-top:10px">
            <li><strong>Día Salida:</strong> {{$corrida->dia_salida->format('d-m-y')}}</li>
            <li><strong>Hora Salida:</strong> {{$corrida->hora_salida}}</li>
            <li><strong>Día Llegada: </strong>{{$corrida->dia_llegada->format('d-m-y')}}</li>
            <li><strong>Hora Salida: </strong>{{$corrida->hora_llegada}}</li>
        </ul>
    </div>
    <table style="border-collapse:collapse;width:50%;margin:10px 10px">
        <thead style="border-top:2px solid #dee2e6;border-bottom:2px solid #dee2e6;">
            <tr>
                <th style="border-right:2px solid #dee2e6;text-align:left;padding:5px">Apellido</th>
                <th style="border-right:2px solid #dee2e6;text-align:left;padding:5px">Nombre</th>
                <th style="text-align:left;padding:5px">Asiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asientos as $asiento)
                <tr style="border:2px solid #dee2e6">
                    <td style="border-right:2px solid #dee2e6;padding:5px">{{$asiento->pasajero->apellido}}</td>
                    <td style="border-right:2px solid #dee2e6;padding:5px">{{$asiento->pasajero->nombre}}</td>
                    <td style="padding:5px;">{{$asiento->asiento}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>