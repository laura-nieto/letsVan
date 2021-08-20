<!DOCTYPE html>
<html>

<head>
    <title>Ticket - Lets Van</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        * {
            margin: 0;
        }

    </style>
</head>

<body>
    <div style="padding-top:20px;width:80%;margin:0 auto">
        <header>
            <h1 style="color:#68c3ed;text-align:center">Lets Van</h1>
        </header>

        <main style="border:1px solid #68c3ed;padding:20px">
            <div>
                <h5>Contacto</h5>
                <h6>{{$nombre}} - {{$telefono}}</h6>
            </div>
            <div style="margin-top:2rem">
                <h5>Viaje</h5>
                <h6>Recorrido: {{$corrida->origen}} - {{$corrida->destino}}</h6>
                <h6>Salida: {{$corrida->dia_salida->format('d-m-y')}} - {{$corrida->hora_salida}}</h6>
                <h6>Llegada: {{$corrida->dia_llegada->format('d-m-y')}} - {{$corrida->hora_llegada}}</h6>
            </div>
            <div style="margin-top:2rem">
                <h5>Transporte</h5>
                <table width="75%">
                    <tbody>
                        <tr>
                            <td style="padding:5px;">Marca: {{$corrida->unidad->marca}}</td>
                            <td style="padding:5px;">Modelo: {{$corrida->unidad->modelo}}</td>
                            <td style="padding:5px;">Placa: {{$corrida->unidad->placa}}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-top:2rem">
                <table width="75%" style="margin:auto;border-collapse:collapse;">
                    <thead style="border-bottom: 1px solid #68c3ed">
                        <tr>
                            <th style="padding:5px;text-align:center;border-right: 1px solid #68c3ed">Descripción</th>
                            <th style="padding:5px;text-align:center;border-right: 1px solid #68c3ed" width="25%">
                                Cantidad</th>
                            <th style="padding:5px;text-align:center">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($descripcion['adulto']))
                            <tr style="border-bottom: 1px solid #68c3ed">
                                <td style="padding:5px;text-align:center;border-right: 1px solid #68c3ed;border-bottom: 1px solid #68c3ed">Pasaje Adulto</td>
                                <td style="padding:5px;text-align:center;border-right: 1px solid #68c3ed;border-bottom: 1px solid #68c3ed">{{$descripcion['adulto']['cantidad']}}</td>
                                <td style="padding:5px;text-align:center;border-bottom: 1px solid #68c3ed">${{$descripcion['adulto']['precio']}}</td>
                            </tr>
                        @endif
                        @if(isset($descripcion['niño']))
                            <tr style="border-bottom: 1px solid #68c3ed">
                                <td style="padding:5px;text-align:center;border-right: 1px solid #68c3ed;border-bottom: 1px solid #68c3ed">Pasaje Niño</td>
                                <td style="padding:5px;text-align:center;border-right: 1px solid #68c3ed;border-bottom: 1px solid #68c3ed">{{$descripcion['niño']['cantidad']}}</td>
                                <td style="padding:5px;text-align:center;">${{$descripcion['niño']['precio']}}</td>
                            </tr>
                        @endif
                        <tr>
                            <td colspan="2" style="padding:5px;border-right: 1px solid #68c3ed;text-align:center">Total:</td>
                            <td style="padding:5px;text-align:center">${{$total}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-top:2rem">
                <h4>Asientos:
                    @foreach ($asientos as $asiento)
                    {{$asiento . " - "}}
                    @endforeach
                </h4>
            </div>
        </main>
    </div>

</body>

</html>
