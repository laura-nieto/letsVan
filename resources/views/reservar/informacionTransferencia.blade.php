@extends('layouts.home')
@section('title',"Información - Let's Van")
@section('main')
    <article class="home--title">
        <h1 class="text-center">
            Información del Viaje
        </h1>
    </article>
    <article class="container">
        <section>
            <div class="card mb-3">
                <div class="card-header background-lets">
                    <h4>Datos para la transferencia</h4>
                </div>
                <div class="card-body fsize-1">
                    <p class="card-text">En el correo ingresado encontrará el link para subir la imágen de su transferencia.</p>
                    <p class="card-text">Recuerde que si no realiza la transferencia en 8hs, la reserva será anulada.</p>
                </div>
            </div>
        </section>
        <section>
            <div class="d-flex justify-content-center">
                <a href="/" class="btn btn-lets">Inicio</a>
            </div>
        </section>
    </article>
@endsection