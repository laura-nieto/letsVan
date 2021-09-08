@extends('layouts.home')
@section('title',"Ver Pasajeros - Let's Van")
@section('main')
    <article class="home--title">
        <h2 class="text-center">
            Ver Pasajeros
        </h2>
    </article>
    <section class="w-50 crud--new">
        <a href="{{route('index')}}" class="btn btn-lets fsize-1">Inicio</a>
    </section>
    <article class="px-5 d-flex justify-content-between article-pasajeros-responsive">
        <section class=" w-25 mr-4 section--corrida">
            <div class="card text-dark bg-light">
                <div class="card-header background-lets">
                    <h5>Corrida</h5>
                </div>
                <div class="card-body bg-white">
                    <ul class="list-group list-group-flush w-100">
                        <li class="list-group-item"><strong>Día Salida:</strong> {{$corrida->dia_salida->format('d-m-y')}}</li>
                        <li class="list-group-item"><strong>Hora Salida:</strong> {{$corrida->hora_salida}}</li>
                        <li class="list-group-item"><strong>Día Llegada: </strong>{{$corrida->dia_llegada->format('d-m-y')}}</li>
                        <li class="list-group-item"><strong>Hora Salida: </strong>{{$corrida->hora_llegada}}</li>
                    </ul>
                </div>
            </div>
            <div class="mt-3 mb-5 d-flex justify-content-center">
                <a href="{{route('pasajeros.descargar',$corrida->id)}}" class="btn btn-lets">Descargar PDF</a>
            </div>
            </section>
        <section class="w-75 section--pasajeros">
            <table class="table table-hover m-auto">
                <thead>
                    <tr>
                        <th scope="col">Apellido</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Asiento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asientos as $asiento)
                        <tr>
                            <td>{{$asiento->pasajero->apellido}}</td>
                            <td>{{$asiento->pasajero->nombre}}</td>
                            <td>{{$asiento->asiento}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </article>

@endsection