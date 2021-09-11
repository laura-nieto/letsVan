<!DOCTYPE html>
<html>

<head>
    <title>Ticket - Lets Van</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: 0;
        }

    </style>
</head>

<body>
    <div style="padding-top:20px;width:80%;margin:0 auto">
        <header style="background-color:#000;border-radius:20px">
            <img src="data:image/png;base64,{{ $image }}" alt="" width="200" style="margin:2px 20px">
        </header>
        <main style="padding-top:30px;">
            <div style="border-top:solid 2px #68c3ed;margin:0 auto;width:97%;"></div>
            <section style="padding:30px">
                <h2 style="font-size:1.3rem">¡Gracias por tu compra!</h2>
                <h5 style="color:red;margin-top:20px">Uso obligatorio de cubrebocas en el viaje</h5>
            </section>
            <section style="padding:20px 30px 30px">
                <table>
                    <thead>
                        <td>
                            <div>
                                <h2 style="font-size:1.3rem">Origen</h2>
                                <p style="font-size:1.1rem;margin:30px 0;">{{$corrida->origen_tabla->destino}}</p>
                                <div>
                                    <h3 style="font-size:1.3rem;margin-bottom:5px;">Ubicación de Salida</h3>
                                    <p style="font-size:1.1rem;margin-bottom:5px">{{$corrida->origen_tabla->ubicacion}}</p>
                                    <a href="" style="font-size:0.9rem">{{$corrida->origen_tabla->url}}</a>
                                    <p style="font-size:1.1rem;margin-top:5px">{{$corrida->origen_tabla->referencia}}</p>
                                </div>
                                <div style="margin-top:30px">
                                    <h4 style="font-size:1.1rem;margin-bottom:5px;">Hora de Salida</h4>
                                    <p style="font-size:1.1rem">{{$corrida->hora_salida}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <h2 style="font-size:1.3rem">Destino</h2>
                                <p style="font-size:1.1rem;margin:30px 0;">{{$corrida->destino_tabla->destino}}</p>
                                <div>
                                    <h3 style="font-size:1.3rem;margin-bottom:5px;">Ubicación de Regreso</h3>
                                    <p style="font-size:1.1rem;margin-bottom:5px">{{$corrida->destino_tabla->ubicacion}}</p>
                                    <a href="" style="font-size:0.9rem">{{$corrida->destino_tabla->url}}</a>
                                    <p style="font-size:1.1rem;margin-top:5px">{{$corrida->destino_tabla->referencia}}</p>
                                </div>
                                <div style="margin-top:30px">
                                    <h4 style="font-size:1.1rem;margin-bottom:5px;">Hora de Llegada</h4>
                                    <p style="font-size:1.1rem">{{$corrida->hora_llegada}}</p>
                                </div>
                            </div>
                        </td>
                    </thead>
                </table>
                
                
            </section>
            <section style="border-top:dashed 2px #68c3ed;padding:30px">
                <div style="display:flex;">
                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th style="font-size:1.2rem;padding:5px;text-align:left">Pasajero</th>
                                <th style="font-size:1.2rem;padding:5px;text-align:left">Tipo de Pasajero</th>
                                <th style="font-size:1.2rem;padding:5px;text-align:left">Asiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($pasajeros as $pasajero) 
                                <tr>
                                    <td style="font-size:1.1rem;padding:5px;">{{$pasajero['nombre']}}</td>
                                    <td style="font-size:1.1rem;padding:5px;">{{$pasajero['type']}}</td>
                                    <td style="font-size:1.1rem;padding:5px;">{{$asientos[$i]}}</td>
                                </tr>
                                @php
                                    $i+=1;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="margin-top:30px;">
                    <table>
                        <thead>
                            <tbody>
                                <td>
                                    <div style="margin-right:120px">
                                        <h5 style="font-size:1.2rem;">Forma de Pago</h5>
                                        <p style="font-size:1.1rem">{{$tipo_pago}}</p>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <h5 style="font-size:1.2rem;">Monto de Pago</h5>
                                        <p style="font-size:1.1rem">${{$total}}</p>
                                    </div>
                                </td>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </section>
            <section style="border-top:dashed 2px #68c3ed;padding:30px">
                <p style="margin-bottom:20px;">NOTA: Favor de presentarte 15 min. antes de la salida. No hay cambios ni devoluciones.</p>
                <p style="font-size:0.9rem;margin-bottom:5px;">Terminos y condiciones en <a href="https://www.letsvan.com.mx">www.letsvan.com.mx</a></p>
                <p style="font-size:0.9rem;">Aviso de Privacidad <a href="https://www.letsvan.com.mx">www.letsvan.com.mx</a></p>
            </section>
        </main>
    </div>

</body>
</html>