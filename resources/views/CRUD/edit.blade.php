@extends('layouts.home')
@section('title',"Editar - Let's Van")
@section('main')
<article class="home--title">
    <h1 class="text-center">
        @switch(Request::segment(1))
        @case('unidad')
        Editar Unidad
        @break
        @case('choferes')
        Editar Chofer
        @break
        @case('corrida')
        Editar Corrida
        @case('destino')
        Editar Destino
        @endswitch
    </h1>
</article>
<article class="w-75 m-auto border">
    <form action="{{ route(Request::segment(1) . '.update',[$unidad->id])}}" method="post" class="p-5 form--new">
        @csrf
        @method('put') 
        @switch(Request::segment(1))
            @case('unidad')
                <div class="mb-3">
                    <label for="" class="form-label">Marca</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" aria-describedby="emailHelp" name="marca" value="{{$unidad->marca}}">
                    @error('marca')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Modelo</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="modelo" value="{{$unidad->modelo}}">
                    @error('modelo')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Placa</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="placa" value="{{$unidad->placa}}">
                    @error('placa')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Propietario</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="propietario" value="{{$unidad->propietario}}">
                    @error('propietario')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Asientos</label>
                    <input type="number" class="form-control @error('servicios') is-invalid @enderror" name="asientos" value="{{$unidad->asientos}}">
                    @error('asientos')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Costo</label>
                    <input type="number" class="form-control @error('servicios') is-invalid @enderror" name="costo_renta" value="{{$unidad->costo_renta}}">
                    @error('costo_renta')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 grid-c5 grid-c3-responsive">
                    @foreach ($servicios as $servicio)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="{{$servicio->id}}" {{$unidad->servicios->contains($servicio->id)?'checked':''}}>
                            <label class="form-check-label">{{$servicio->nombre}}</label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-lets mt-3">Modificar</button>
                @break




            @case('chofer')
                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="nombre" value="{{$unidad->nombre}}">
                    @error('nombre')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Apellido</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="apellido" value="{{$unidad->apellido}}">
                    @error('apellido')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Edad</label>
                    <input type="number" class="form-control @error('servicios') is-invalid @enderror" name="edad" value="{{$unidad->edad}}">
                    @error('edad')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Domicilio</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="domicilio" value="{{$unidad->domicilio}}">
                    @error('domicilio')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Celular</label>
                    <input type="text" class="form-control @error('servicios') is-invalid @enderror" name="celular" value="{{$unidad->celular}}">
                    @error('celular')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-lets mt-3">Modificar</button>
                @break


            @case('corrida')
                <section>
                    <div class="mb-3">
                        <label for="" class="form-label">Origen</label>
                        <select class="form-select" name="origen">
                            <option selected disabled hidden>Seleccionar Origen</option>
                            @foreach ($destinos as $destino)
                                @if ($unidad->origen === $destino->id)
                                    <option selected value="{{$destino->id}}">{{$destino->destino}}</option>
                                @endif
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
                                @if ($unidad->destino === $destino->id)
                                    <option selected value="{{$destino->id}}">{{$destino->destino}}</option>
                                @endif
                                <option value="{{$destino->id}}">{{$destino->destino}}</option>
                            @endforeach
                        </select>
                        @error('destino')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Día Salida</label>
                        <input type="date" class="form-control @error('dia_salida') is-invalid @enderror" name="dia_salida" value="{{$unidad->dia_salida}}">
                        @error('dia_salida')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hora Salida</label>
                        <input type="time" class="form-control @error('hora_salida') is-invalid @enderror" name="hora_salida" value="{{$unidad->hora_salida}}">
                        @error('hora_salida')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Día Llegada</label>
                        <input type="date" class="form-control @error('dia_llegada') is-invalid @enderror" name="dia_llegada" value="{{$unidad->dia_llegada}}">
                        @error('dia_llegada')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Hora Llegada</label>
                        <input type="time" class="form-control @error('hora_llegada') is-invalid @enderror" name="hora_llegada" value="{{$unidad->hora_llegada}}">
                        @error('hora_llegada')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Unidad</label>
                        <select class="form-select" aria-label="Default select example" name="unidad_id">
                            @foreach ($unidades as $auto)
                                @if ($unidad->unidad_id === $auto->id)
                                    <option selected value="{{$auto->id}}">{{$auto->placa}}</option>
                                @endif
                                <option value="{{$auto->id}}">{{$auto->placa}}</option>
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
                        <input type="number" class="form-control @error('precio_adulto') is-invalid @enderror" name="precio_adulto" value="{{$unidad->precio->adulto}}">
                        @error('precio_adulto')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Precio Niño</label>
                        <input type="number" class="form-control @error('precio_niño') is-invalid @enderror" name="precio_niño" value="{{$unidad->precio->niño}}">
                        @error('precio_niño')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="cupon" value="on" {{$unidad->precio->cupon ? 'checked':''}}>
                            <label class="form-check-label" for="">
                              Cupón
                            </label>
                        </div>
                    </div>
                </section>
                <button type="submit" class="btn btn-lets mt-3">Modificar</button>
                @break
            @case('servicio')
                <div class="mb-3">
                    <label for="" class="form-label">Nombre del servicio</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$unidad->nombre}}">
                    @error('nombre')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-lets mt-3">Crear</button>
                </div>
                @break
            @case('destino')
                <div class="mb-3">
                    <label for="" class="form-label">Nombre del Destino</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$unidad->destino}}">
                    @error('nombre')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-lets mt-3">Crear</button>
                </div>
                @break
        @endswitch

    </form>
</article>
@endsection