@extends('layouts.home')
@section('title',"Información - Let's Van")
@section('main')
    <article class="home--title">
        <h2 class="text-center">
            Información del Viaje
        </h2>
    </article>
    <article class="container">
        <section>
            <div class="card mb-3">
                <div class="card-header background-lets">
                    <h4>Datos para la transferencia</h4>
                </div>
                <div class="card-body fsize-1 d-flex">
                    <div class="mr-3">
                        <img src="{{asset('/img/bbva.png')}}" alt="" width="100">
                    </div>
                    <div>
                        <p class="card-text"><strong>Titular:</strong> Guillermo Andrés Pérez Torres</p>
                        <p class="card-text"><strong>Número de Cuenta:</strong> 293 768 7923</p>
                        <p class="card-text"><strong>Cuenta CLABE:</strong> 012 180 02937687923 6</p>
                    </div>
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