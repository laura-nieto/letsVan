@extends('layouts.home')
@section('title',"Editar - Let's Van")
@section('main')
<article class="home--title">
    <h2 class="text-center">
        @switch(Request::segment(1))
        @case('unidad')
        Editar Unidad
        @break
        @case('choferes')
        Editar Chofer
        @break
        @case('corrida')
        Editar Corrida
        @break
        @case('chofer')
        Editar Chofer
        @break
        @case('destino')
        Editar Destino
        @break
        @case('cupon')
        Editar Cupón
        @endswitch
    </h2>
</article>
<section class="w-50 crud--new">
    <a href="{{url()->previous()}}" class="btn btn-lets mr-3 fsize-1">Regresar</a>
</section>
<article class="w-75 mx-auto mb-5 border">
    <form action="{{ route(Request::segment(1) . '.update',[$unidad->id])}}" method="post" class="p-5 form--new" enctype="multipart/form-data">
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
                    <label class="form-label" for="">Costo de Renta</label>
                    <input type="number" class="form-control @error('servicios') is-invalid @enderror" name="costo_renta" value="{{$unidad->costo_renta}}">
                    @error('costo_renta')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 grid-c5 grid-c3-responsive">
                    <h5 class="r-1">Servicios</h5>
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
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="mr-sm-3">
                                <label for="" class="form-label">Origen</label>
                                <select class="form-control" name="origen">
                                    <option selected disabled hidden>Seleccionar Origen</option>
                                    @foreach ($origenes as $origen)
                                        @if ($unidad->origen === $origen->id)
                                            <option selected value="{{$origen->id}}">{{$origen->destino}}</option> 
                                        @else
                                            <option value="{{$origen->id}}">{{$origen->destino}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-2 mt-md-0">
                                <label for="" class="form-label">Destino</label>
                                <select class="form-control" name="destino">
                                    <option selected disabled hidden>Seleccionar Destino</option>
                                    @foreach ($destinos as $destino)
                                        @if ($unidad->destino === $destino->id)
                                            <option selected value="{{$destino->id}}">{{$destino->destino}}</option> 
                                        @else
                                            <option value="{{$destino->id}}">{{$destino->destino}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <a href="{{route('destino.create')}}" class="ml-5 mt-2 mt-md-0">Agregar ruta</a>
                        </div>
                        @if(session('destino'))
                            <div class="alert alert-danger mt-1">{{ session('destino')}}</div>
                        @endif
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
                        <select class="form-control w-25-responsive" aria-label="Default select example" name="unidad_id">
                            @foreach ($unidades as $auto)
                                @if ($unidad->unidad_id === $auto->id)
                                    <option selected value="{{$auto->id}}">{{$auto->marca}} - {{$auto->modelo}}</option> 
                                @else
                                    <option value="{{$auto->id}}">{{$auto->marca}} - {{$auto->modelo}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('unidad_id')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Chofer</label>
                        <select class="form-control w-25-responsive" aria-label="Default select example" name="chofer_id">
                            @foreach ($choferes as $chofer)
                                @if ($unidad->chofer_id === $chofer->id)
                                    <option selected value="{{$chofer->id}}">{{$chofer->apellido . ' ' . $chofer->nombre}}</option>
                                @else
                                    <option value="{{$chofer->id}}">{{$chofer->apellido . ' ' . $chofer->nombre}}</option>
                                @endif
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
                <div class="mb-5">
                    @error('imagen')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <label for="exampleFormControlFile1" class="fsize-1">Imágen del Servicio.</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="imagen">
                </div>
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
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Tipo de ruta</label>
                    <select class="form-control w-50 width-75-responsive" name="type">
                        <option value="origen" {{$unidad->destino_origen == 'origen' ? 'selected' : ''}}>Origen</option>
                        <option value="destino" {{$unidad->destino_origen == 'destino' ? 'selected' : ''}}>Destino</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Ubicación</label>
                    <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" name="ubicacion" value="{{$unidad->ubicacion}}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">URL</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{$unidad->url}}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Referencia</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" name="referencia" value="{{$unidad->referencia}}">
                    <button type="submit" class="btn btn-lets mt-3">Crear</button>
                </div>
                @break
            @case('cupon')
                <div class="mb-3">
                    <label for="" class="form-label">Código del cupón</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$unidad->nombre}}">
                    @error('nombre')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descuento</label>
                    <input type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{$unidad->descuento}}">
                    @error('precio')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-lets mt-3">Crear</button>
                </div>
                @break
        @endswitch

    </form>
</article>
@endsection