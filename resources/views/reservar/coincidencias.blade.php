@extends('layouts.home')
@section('title',"Ver Viajes - Let's Van")
@section('main')
<div class="background-lets vh-main">
    <article class="home--title">
        <h2 class="text-center h1">
            Ver Viajes
        </h2>
    </article>
    @if (session('error'))
        <div class="alert alert-danger px-5" role="alert">
            {{session('error')}}
        </div>
    @endif
<section class="px-lg-5 px-2">
    @if ($coincidencias->isEmpty())
        <article>
            <div class="card p-4 cristal-color">
                <h4 class="text-center">Parece que no hay viajes con esas características</h4>
            </div>
        </article>
    @endif
    @foreach ($coincidencias as $corrida)
        <article class="mt-2 shadow-sm w-responsive-75">
            <div class="card d-flex flex-md-row align-items-md-center p-2 cristal-color">
                <div class="card-body d-flex flex-column flex-sm-row flex-wrap w-60 align-items-center">
                    <div class="w-25 w-100-responsive d-flex justify-content-center d-sm-block">
                        <img src="{{asset('img/unidades/'.$corrida->unidad->image)}}" alt="Imágen de la unidad"
                            class="image-unity">
                    </div>
                    <div class="w-75 mt-3 mt-sm-0">
                        <div class="w-100 d-flex justify-content-center justify-content-sm-around">
                            <div>
                                <h5 class="text-center"><strong>{{$corrida->origen_tabla->destino}}</strong></h5>
                                <h5>{{$corrida->dia_salida->format('d-m-y')}}</h5>
                                <h5>{{$corrida->hora_salida}}</h5>
                            </div>
                            <div class="mx-5 mx-sm-0 d-flex flex-column justify-content-between align-items-center">
                                <i class="fas fa-arrows-alt-h fa-3x"></i>
                                <h5><strong>${{$corrida->precio->adulto}} MXN</strong></h5>
                            </div>
                            <div>
                                <h5 class="text-center"><strong>{{$corrida->destino_tabla->destino}}</strong></h5>
                                <h5>{{$corrida->dia_llegada->format('d-m-y')}}</h5>
                                <h5>{{$corrida->hora_llegada}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 mt-3">
                        <h5>Servicios:
                            @foreach ($corrida->unidad->servicios as $servicio)
                            {{$servicio->nombre . ', '}}
                            @endforeach
                        </h5>
                    </div>
                </div>
                <div class="w-40-responsive card-body border-dashed-left ml-sm-3">
                    <form action="" method="post"
                        class="align-self-center d-flex flex-column flex-md-row align-items-center justify-content-center">
                        @csrf
                        <input type="hidden" name="corrida" value="{{$corrida->id}}">
                        <div class="d-flex flex-column align-items-center mt-3 mt-md-0">
                            <div class="mb-3">
                                <input type="number" class="form-control mb-2" placeholder="Cantidad de niños" name="niños">
                                <input type="number" class="form-control" placeholder="Cantidad de adultos" name="adultos">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 fsize-1">Seleccionar</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endforeach

    <a href="/" class="btn btn-lets my-4 fz-1">Volver</a>
</section>
</div>
@endsection
