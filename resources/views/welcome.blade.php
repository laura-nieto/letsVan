@extends('layouts.home')
@section('title',"Inicio - Let's Van")
@section('main')
{{-- {{session()->flush();}} --}}
{{-- {{dd(session()->all())}} --}}
    @if (Auth::user()->is_admin)
        <div class="container">
            <article class="home--title">
                <h1 class="text-center">Title</h1>
            </article>
            <article>
                <section>
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                            <h5>Unidades</h5>
                            <a href="{{route('unidad.index')}}" class="btn btn-lets">Modificar</a>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                            <h5>Choferes</h5>
                            <a href="{{route('chofer.index')}}" class="btn btn-lets">Modificar</a>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                            <h5>Corridas</h5>
                            <a href="{{route('corrida.index')}}" class="btn btn-lets">Modificar</a>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                            <h5>Destinos</h5>
                            <a href="{{route('destino.index')}}" class="btn btn-lets">Modificar</a>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                            <h5>Servicios</h5>
                            <a href="{{route('servicio.index')}}" class="btn btn-lets">Modificar</a>
                        </div>
                    </div>
                </section>
                <section class="mt-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                            <h5>Pasajeros</h5>
                            <a href="{{route('pasajeros.verCorridas')}}" class="btn btn-lets">Ver</a>
                        </div>
                    </div>
                </section>
            </article>
        </div>
    @else
        <div class="container">
            <article class="home--title">
                <h1 class="text-center">Buscar</h1>
            </article>
            @if (session('success'))
                <div class="alert alert-success mx-2" role="alert">
                    {{session('success')}}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger px-5" role="alert">
                    {{session('error')}}
                </div>
            @endif
            <article>
                <form action="{{route('corrida.buscar')}}" method="get">
                    <section class="my-3">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Origen</label>
                                <select class="form-select" name="origen">
                                    <option selected disabled hidden>Seleccionar Origen</option>
                                    @foreach ($destinos as $destino)
                                        <option value="{{$destino->id}}">{{$destino->destino}}</option>
                                    @endforeach
                                </select>
                                @error('origen')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Destino</label>
                                <select class="form-select" name="destino">
                                    <option selected disabled hidden>Seleccionar destino</option>
                                    @foreach ($destinos as $destino)
                                        <option value="{{$destino->id}}">{{$destino->destino}}</option>
                                    @endforeach
                                </select>
                                @error('destino')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </section>
                    <section class="my-3">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Fecha de Ida</label>
                                <input type="date" class="form-control" placeholder="Fecha de Ida" name="dia_salida">
                            </div>
                            <div class="col">
                                <label class="form-label">Fecha de Vuelta</label>
                                <input type="date" class="form-control" placeholder="Fecha de Vuelta" name="dia_llegada">
                            </div>
                        </div>
                    </section>
                    <section class="my-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="viaje_redondo">
                            <label class="form-check-label">
                                Viaje Redondo
                            </label>
                        </div>
                    </section>
                    <button type="submit" class="btn btn-lets mt-3">Buscar</button>
                </form>
            </article>
        </div>
    @endif
    
@endsection