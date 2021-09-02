@extends('layouts.home')
@section('title',"Información - Let's Van")
@section('main')
    <article class="home--title">
        <h1 class="text-center">
            Transferencias
        </h1>
    </article>
    <article class="crud">
        @if (session('success'))
            <div class="alert alert-success mx-2" role="alert">
                {{session('success')}}
            </div>
        @endif
        <section class="px-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">N° de Transferencia</th>
                        <th scope="col">Comprador</th>
                        <th scope="col">Aprobada</th>
                        <th scope="col" class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transferencias as $transferencia)
                        <tr>
                            <td scope="row">{{$transferencia->payment->number_order}}</td>
                            <td>{{$transferencia->payment->comprador->apellido . ' ' . $transferencia->payment->comprador->nombre}}</td>
                            <td>
                                {{$transferencia->visto ? 'Sí':'No'}}
                            </td>
                            <td class="d-flex d-flex-justify-around around--btn">
                                <a href="{{route('ver_transferencia',$transferencia->id)}}"
                                    class="btn btn-lets">Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </article>
@endsection