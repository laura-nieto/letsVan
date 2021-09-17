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
                    <h4>Ida</h4>
                </div>
                <div class="card-body">
                    <h5>Origen: {{$ida->origen_tabla->destino}} - {{$ida->origen_tabla->ubicacion}}</h5>
                    <h5>Día: {{$ida->dia_salida->format('d-m-y')}}</h5>
                    <h5>Hora: {{$ida->hora_salida}}</h5>
                    <h5><a href="{{$ida->origen_tabla->url}}">Ver en Google Maps</a></h5>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header background-lets">
                    <h4>Llegada</h4>
                </div>
                <div class="card-body">
                    <h5>Destino: {{$vuelta->destino_tabla->destino}} - {{$vuelta->destino_tabla->ubicacion}}</h5>
                    <h5>Día: {{$vuelta->dia_llegada->format('d-m-y')}}</h5>
                    <h5>Hora: {{$vuelta->hora_llegada}}</h5>
                    <h5><a href="{{$vuelta->destino_tabla->url}}">Ver en Google Maps</a></h5>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="/" class="btn btn-lets">Inicio</a>
            </div>
        </section>
    </article>
@endsection