@extends('layouts.home')
@section('title',"Inicio - Let's Van")
@section('main')
<div class="container">


<article class="home--title">
    <h1 class="text-center">Crear Pasaje</h1>
</article>
<section class="m-auto shadow-sm p-3 bg-white rounded">
    @if (session('success'))
        <div class="alert alert-success mx-2" role="alert">
            {{session('success')}}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger px-5" role="alert">
            {{session('error')}}
        </div>
    @endif
    <form action="{{route('corrida.buscar')}}" method="get">
        <article class="mb-3">
            <div class="w-15 mb-3">
                <select class="form-control" aria-label="tipo" id="tipo">
                    <option value="0" selected>Sencillo</option>
                    <option value="1">Redondo</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <div class="w-25 mr-3">
                    <select class="form-control @error('origen') border-danger @enderror" aria-label="Origen"
                        name="origen">
                        <option selected disabled hidden>Origen</option>
                        @foreach ($destinos as $destino)
                        <option value="{{$destino->id}}">{{$destino->destino}}</option>
                        @endforeach
                    </select>
                    @error('origen')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="w-25 mr-3">
                    <select class="form-control @error('destino') border-danger @enderror" aria-label="Destino"
                        name="destino">
                        <option selected disabled hidden>Destino</option>
                        @foreach ($destinos as $destino)
                        <option value="{{$destino->id}}">{{$destino->destino}}</option>
                        @endforeach
                    </select>
                    @error('destino')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="w-25 mr-3">
                    <input type="date" class="form-control" placeholder="Fecha de Ida" name="dia_salida">
                </div>
                <div class="w-25" style="display:none;" id="input-hidden">
                    <input type="date" class="form-control" placeholder="Fecha de Vuelta" name="dia_llegada">
                </div>
            </div>
        </article>
        <article class="d-flex justify-content-between">
            {{-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="viaje_redondo">
                                <label class="form-check-label">
                                    Viaje Redondo
                                </label>
                            </div> --}}
            <button type="submit" class="btn btn-lets">Buscar</button>
        </article>
    </form>
</section>
</div>
@endsection