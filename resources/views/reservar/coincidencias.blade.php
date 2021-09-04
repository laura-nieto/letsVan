@extends('layouts.home')
@section('title',"Ver Viajes - Let's Van")
@section('main')
    <article class="home--title">
        <h2 class="text-center">
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
                <div class="card p-4">
                    <h4 class="text-center">Parece que no hay viajes con esas características</h4>
                </div>
            </article>
        @endif
        @foreach ($coincidencias as $corrida)
            <article class="mt-2 shadow-sm">
                <div class="card d-flex flex-md-row align-items-md-center p-2">
                    <div class="card-body d-flex flex-wrap">
                        <div class="w-100 d-flex justify-content-center justify-content-sm-around">
                            <div>
                                <h5 class="text-center"><strong>{{$corrida->origen_tabla->destino}}</strong></h5>
                                <h5>{{$corrida->dia_salida->format('d-m-y')}}</h5>
                                <h5>{{$corrida->hora_salida}}</h5>
                            </div>
                            <div class="mx-5 mx-sm-0">
                                <img src="{{asset('/img/icon-bus.png')}}" alt="" class="img-icon">
                            </div>
                            <div>
                                <h5 class="text-center"><strong>{{$corrida->destino_tabla->destino}}</strong></h5>
                                <h5>{{$corrida->dia_llegada->format('d-m-y')}}</h5>
                                <h5>{{$corrida->hora_llegada}}</h5>
                            </div>
                        </div>
                        <div class="w-100 mt-4 d-flex justify-content-around">
                            <div>
                                <h5>Servicios:
                                    @foreach ($corrida->unidad->servicios as $servicio)
                                        {{$servicio->nombre . ', '}}
                                    @endforeach
                                </h5>
                            </div>
                            <div>
                                <h5><strong>${{$corrida->precio->adulto}} MXN</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="w-40-responsive card-body border-dashed-left ml-sm-3">
                        <form action="" method="post" class="align-self-center d-flex flex-column flex-md-row align-items-center justify-content-center">
                            @csrf
                            <input type="hidden" name="corrida" value="{{$corrida->id}}">
                            <div class="d-flex flex-column align-items-center mt-3 mt-md-0">
                                <div class="mb-3">
                                    <input type="number" class="form-control mb-2" placeholder="Cantidad de niños" name="niños">
                                    <input type="number" class="form-control" placeholder="Cantidad de adultos" name="adultos">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Seleccionar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        @endforeach

        <a href="/" class="btn btn-lets mt-4">Volver</a>
    </section>

@endsection