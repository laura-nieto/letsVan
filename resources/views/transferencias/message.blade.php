@extends('layouts.home')
@section('title',"Información - Let's Van")
@section('main')
        <div class="container">
            <div class="card mt-5">
                @if (!$error) 
                    <div class="card-header bg-danger text-white">
                        <h4>Error</h4>
                    </div>
                    <div class="card-body fsize-1">
                        <p class="card-text">El tiempo para realizar la transferencia ha pasado y se ha liberado la reservación.</p>
                    </div>
                @elseif($error)
                    <div class="card-header bg-success text-white">
                        <h4>Recibido</h4>
                    </div>
                    <div class="card-body fsize-1">
                        <p class="card-text">Dentro de las siguientes 24 horas, si la transferencia fue correcta le llegará un correo con el ticket para poder realizar el viaje.</p>
                    </div>
                @endif
            </div>
        </div>
@endsection