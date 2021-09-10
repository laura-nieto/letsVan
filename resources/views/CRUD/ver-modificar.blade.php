@extends('layouts.home')
@section('title',"Ver - Let's Van")
@section('main')
<article class="home--title">
    <h2 class="text-center">
        @switch(Request::segment(1))
        @case('unidad')
        Unidades
        @break
        @case('chofer')
        Choferes
        @break
        @case('corrida')
        Corridas
        @break
        @case('servicio')
        Servicios
        @break
        @case('destino')
        Destinos
        @break
        @endswitch
    </h2>
</article>
<article class="crud">
    <section class="w-50 crud--new">
        <a href="{{route('index')}}" class="btn btn-lets mr-3 fsize-1">Inicio</a>
        <a href="{{Request::segment(1) . '/create'}}" class="btn btn-lets fsize-1">Crear Nuevo</a>
    </section>
    @if (session('mensaje.success'))
    <div class="alert alert-success mx-2" role="alert">
        {{session('mensaje.success')}}
    </div>
    @endif
    <section class="px-lg-5">
        <table class="table table-hover">
            @switch(Request::segment(1))
            @case('unidad')
            <thead>
                <tr>
                    <th scope="col">Marca</th>
                    <th scope="col">Placa</th>
                    <th scope="col">Propietario</th>
                    <th scope="col">Costo de Renta</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unidades as $unity)
                <tr>
                    <th scope="row">{{$unity->marca}}</th>
                    <td>{{$unity->placa}}</td>
                    <td>{{$unity->propietario}}</td>
                    <td>{{$unity->costo_renta}}</td>
                    <td class="d-flex d-flex-justify-around around--btn">
                        <a href="{{Request::segment(1) . '/' . $unity->id . '/edit'}}"
                            class="btn btn-lets">Modificar</a>
                        <form method="POST" action="{{route( 'unidad.destroy',$unity->id)}}">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Eliminar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @break
            @case('chofer')
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Celular</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($choferes as $chofer)
                <tr>
                    <th scope="row">{{$chofer->nombre}}</th>
                    <td>{{$chofer->apellido}}</td>
                    <td>{{$chofer->edad}}</td>
                    <td>{{$chofer->domicilio}}</td>
                    <td>{{$chofer->celular}}</td>
                    <td class="d-flex d-flex-justify-around around--btn">
                        <a href="{{Request::segment(1) . '/' . $chofer->id . '/edit'}}"
                            class="btn btn-lets">Modificar</a>
                        <form method="POST" action="{{route( 'chofer.destroy',$chofer->id)}}">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Eliminar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @break
            @case('corrida')
            <thead>
                <tr>
                    <th scope="col">Salida</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Llegada</th>
                    <th scope="col">Hora</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($corridas as $corrida)
                <tr>
                    <td scope="row">{{$corrida->dia_salida->format('d-m-y')}}</td>
                    <td>{{$corrida->hora_salida}}</td>
                    <td>{{$corrida->dia_llegada->format('d-m-y')}}</td>
                    <td>{{$corrida->hora_llegada}}</td>
                    <td class="d-flex d-flex-justify-around around--btn">
                        <a href="{{Request::segment(1) . '/' . $corrida->id . '/edit'}}"
                            class="btn btn-lets">Modificar</a>
                        <form method="POST" action="{{route( 'corrida.destroy',$corrida->id)}}">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Eliminar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @break
            @case('servicio')
            <thead>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Servicio</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                <tr>
                    <th scope="row">{{$servicio->id}}</th>
                    <td>{{$servicio->nombre}}</td>
                    <td class="d-flex d-flex-justify-around around--btn">
                        <a href="{{Request::segment(1) . '/' . $servicio->id . '/edit'}}"
                            class="btn btn-lets">Modificar</a>
                        <form method="POST" action="{{route( 'servicio.destroy',$servicio->id)}}">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Eliminar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @break
            @case('destino')
            <thead>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Ruta</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($destinos as $destino)
                <tr>
                    <th scope="row">{{$destino->id}}</th>
                    <td>{{$destino->destino}}</td>
                    <td class="d-flex d-flex-justify-around around--btn">
                        <a href="{{Request::segment(1) . '/' . $destino->id . '/edit'}}"
                            class="btn btn-lets">Modificar</a>
                        <form method="POST" action="{{route( 'destino.destroy',$destino->id)}}">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Eliminar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @break
            @default
            @endswitch
        </table>
    </section>
</article>
@endsection
