@extends('layouts.home')
@section('title',"Ver Pasajeros - Let's Van")
@section('main')
    <article class="home--title">
        <h2 class="text-center">
            Ver Pasajeros
        </h2>
    </article>
    <section class="px-sm-2">
        <section class="w-50 crud--new">
            <a href="{{route('index')}}" class="btn btn-lets fsize-1">Inicio</a>
        </section>
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Corrida</th>
                <th scope="col">Salida</th>
                <th scope="col">Hora Salida</th>
                <th scope="col">Ver</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($corridas as $corrida)
                    <tr>
                        <th scope="row">{{$corrida->id}}</th>
                        <td>{{$corrida->dia_salida->format('d-m-y')}}</td>
                        <td>{{$corrida->hora_salida}}</td>
                        <td>
                            <a href="{{route('pasajeros.ver',$corrida->id)}}" class="btn btn-lets">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

@endsection