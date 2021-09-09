@extends('layouts.home')
@section('title',"Crear nuevo - Let's Van")
@section('main')
<article class="home--title">
    <h2 class="text-center">
        @switch(Request::segment(1))
        @case('unidad')
        Crear nueva Unidad
        @break
        @case('choferes')
        Crear nuevo Chofer
        @break
        @case('destino')
        Crear nuevo destino
        @break
        @default
        @endswitch
    </h2>
</article>
<article class="w-75 mx-auto mb-5 border">
    <form action="{{ route(Request::segment(1) . '.store')}}" method="post" class="p-5 form--new" enctype="multipart/form-data">
        @csrf
        @switch(Request::segment(1))
            @case('unidad')
                <div class="mb-5">
                    @error('imagen')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <label for="exampleFormControlFile1" class="fsize-1">Imágen de la unidad.</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="imagen">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Marca</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="marca" value="{{old('marca')}}">
                    @error('marca')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Modelo</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="modelo" value="{{old('modelo')}}">
                    @error('modelo')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Placa</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="placa" value="{{old('placa')}}">
                    @error('placa')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Propietario</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="propietario" value="{{old('propietario')}}">
                    @error('propietario')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Asientos</label>
                    <input type="number" class="form-control @error('servicios') is-invalid @enderror" name="asientos" value="{{old('asientos')}}">
                    @error('asientos')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Costo de Renta</label>
                    <input type="number" class="form-control @error('servicios') is-invalid @enderror" name="costo_renta" value="{{old('costo_renta')}}">
                    @error('costo_renta')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 grid-c5 grid-c3-responsive">
                    @foreach ($servicios as $servicio)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="{{$servicio->id}}">
                            <label class="form-check-label">{{$servicio->nombre}}</label>
                        </div>
                    @endforeach
                    @error('servicios')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-lets mt-3">Enviar</button>
                @break
            @case('chofer')
                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{old('nombre')}}">
                    @error('nombre')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Apellido</label>
                    <input type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{old('apellido')}}">
                    @error('apellido')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Edad</label>
                    <input type="number" class="form-control @error('edad') is-invalid @enderror" name="edad" value="{{old('edad')}}">
                    @error('edad')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Domicilio</label>
                    <input type="text" class="form-control @error('domicilio') is-invalid @enderror" name="domicilio" value="{{old('domicilio')}}">
                    @error('domicilio')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Celular</label>
                    <input type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{old('celular')}}">
                    @error('celular')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">E-mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                    @error('email')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-lets mt-3">Enviar</button>
                @break

                
            @case('corrida')
                <section class="new--corrida--corrida">
                    <div class="mb-3">
                        <label for="" class="form-label">Origen</label>
                        <select class="form-select" name="origen">
                            <option selected disabled hidden>Seleccionar Origen</option>
                            @foreach ($destinos as $destino)
                                <option value="{{$destino->id}}">{{$destino->destino}}</option>
                            @endforeach
                        </select>
                        @error('origen')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Destino</label>
                        <select class="form-select" name="destino">
                            <option selected disabled hidden>Seleccionar Destino</option>
                            @foreach ($destinos as $destino)
                                <option value="{{$destino->id}}">{{$destino->destino}}</option>
                            @endforeach
                        </select>
                        @error('destino')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Día Salida</label>
                        <input type="date" class="form-control @error('dia_salida') is-invalid @enderror" name="dia_salida" value="{{old('dia_salida')}}">
                        @error('dia_salida')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hora Salida</label>
                        <input type="time" class="form-control @error('hora_salida') is-invalid @enderror" name="hora_salida" value="{{old('hora_salida')}}">
                        @error('hora_salida')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Día Llegada</label>
                        <input type="date" class="form-control @error('dia_llegada') is-invalid @enderror" name="dia_llegada" value="{{old('dia_llegada')}}">
                        @error('dia_llegada')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Hora Llegada</label>
                        <input type="time" class="form-control @error('hora_llegada') is-invalid @enderror" name="hora_llegada" value="{{old('hora_llegada')}}">
                        @error('hora_llegada')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Unidad</label>
                        <select class="form-select" aria-label="Default select example" name="unidad_id">
                            <option selected hidden value="">Elija una unidad</option>
                            @foreach ($unidades as $unidad)
                                <option value="{{$unidad->id}}">{{$unidad->marca}} - {{$unidad->modelo}}</option>
                            @endforeach
                        </select>
                        @error('unidad_id')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Chofer</label>
                        <select class="form-select" aria-label="Default select example" name="chofer_id">
                            <option selected hidden value="">Elija una chofer</option>
                            @foreach ($choferes as $chofer)
                                <option value="{{$chofer->id}}">{{$chofer->apellido . ' ' . $chofer->nombre}}</option>
                            @endforeach
                        </select>
                        @error('chofer_id')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </section>
                <section class="border-top mt-3 pt-3">
                    <div class="mb-3">
                        <label class="form-label" for="">Precio Adulto</label>
                        <input type="number" class="form-control @error('precio_adulto') is-invalid @enderror" name="precio_adulto" value="{{old('precio_adulto')}}">
                        @error('precio_adulto')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Precio Niño</label>
                        <input type="number" class="form-control @error('precio_niño') is-invalid @enderror" name="precio_niño" value="{{old('precio_niño')}}">
                        @error('precio_niño')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="cupon" value="on">
                            <label class="form-check-label" for="">
                              Cupón
                            </label>
                        </div>
                    </div>
                </section>
                <button type="submit" class="btn btn-lets mt-3">Enviar</button>
                @break
            @case('servicio')
                <div class="mb-3">
                    <label for="" class="form-label">Nombre del servicio</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{old('nombre')}}">
                    @error('nombre')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-lets mt-3">Crear</button>
                </div>
                @break
            @case('destino')
                <div class="mb-3">
                    <label for="" class="form-label">Nombre del Destino</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{old('nombre')}}">
                    @error('nombre')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-lets mt-3">Crear</button>
                </div>
                @break
            @default

        @endswitch

    </form>
</article>
@endsection
