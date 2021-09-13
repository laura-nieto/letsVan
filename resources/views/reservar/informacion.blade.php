@extends('layouts.home')
@section('title',"Información - Let's Van")
@section('main')
    <article class="home--title">
        <h2 class="text-center">
            Información del Viaje
        </h2>
    </article>
    <article class="container">
        @if (session('success'))
        <div class="alert alert-info" role="alert">
            Toda la Información ha sido enviada al correo ingresado.
        </div>
        @endif
        <section>
            <div class="card mb-3">
                <div class="card-header background-lets">
                    <h4>Salida</h4>
                </div>
                <div class="card-body">
                    <h5>Origen: {{$corrida->origen_tabla->destino}} - {{$corrida->origen_tabla->ubicacion}}</h5>
                    <h5>Día: {{$corrida->dia_salida->format('d-m-y')}}</h5>
                    <h5>Hora: {{$corrida->hora_salida}}</h5>
                    <h5><a href="{{$corrida->origen_tabla->url}}">Ver en Google Maps</a></h5>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header background-lets">
                    <h4>Llegada</h4>
                </div>
                <div class="card-body">
                    <h5>Destino: {{$corrida->destino_tabla->destino}} - {{$corrida->destino_tabla->ubicacion}}</h5>
                    <h5>Día: {{$corrida->dia_llegada->format('d-m-y')}}</h5>
                    <h5>Hora: {{$corrida->hora_llegada}}</h5>
                    <h5><a href="{{$corrida->destino_tabla->url}}">Ver en Google Maps</a></h5>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="/" class="btn btn-lets">Inicio</a>
            </div>
        </section>
    </article>
@endsection