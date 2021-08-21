@extends('layouts.home')
@section('title',"Ver Pasajeros - Let's Van")
@section('main')
    <article class="home--title">
        <h1 class="text-center">
            Ver Viajes
        </h1>
    </article>
    @if (session('error'))
        <div class="alert alert-danger px-5" role="alert">
            {{session('error')}}
        </div>
    @endif
    <section class="px-5">
        @if ($coincidencias->isEmpty())
            <article>
                <div class="card p-4">
                    <h4 class="text-center">Parece que no hay viajes con esas características</h4>
                </div>
            </article>
        @endif
        @foreach ($coincidencias as $corrida)
            <article>
                <div class="card d-flex flex-md-row align-items-md-center p-2">
                    <div class="card-body w-50 width-75-responsive">
                        <h5>Origen: <strong>{{$corrida->origen_tabla->destino}}</strong></h5>
                        <h5>Salida: {{$corrida->dia_salida->format('d-m-y')}} - {{$corrida->hora_salida}}</h5>
                        <h5>Destino: <strong>{{$corrida->destino_tabla->destino}}</strong></h5>
                        <h5>Llegada: {{$corrida->dia_llegada->format('d-m-y')}} - {{$corrida->hora_llegada}}</h5>
                        <h5>Servicios:
                            @foreach ($corrida->unidad->servicios as $servicio)
                                {{$servicio->nombre . ', '}}
                            @endforeach
                        </h5>
                    </div>
                    <form action="" method="post" class="w-50 align-self-center width-75-responsive d-flex flex-column align-items-center">
                        @csrf
                        <input type="hidden" name="corrida" value="{{$corrida->id}}">
                        <div class="mb-3">
                            <input type="number" class="form-control mb-2" placeholder="Cantidad de niños" name="niños">
                            <input type="number" class="form-control" placeholder="Cantidad de adultos" name="adultos">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Seleccionar</button>
                    </form>
                </div>
            </article>
        @endforeach

        <a href="/" class="btn btn-lets mt-4">Volver</a>
    </section>

@endsection