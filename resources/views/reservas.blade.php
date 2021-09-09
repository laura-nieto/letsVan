@extends('layouts.home')
@section('title',"Ver Mis Reservas - Let's Van")
@section('main')
        <article class="home--title">
            <h2 class="text-center">
                Ver Reservas
            </h2>
        </article>
        <article class="w-50 crud--new">
            <a href="{{route('index')}}" class="btn btn-lets fsize-1">Inicio</a>
        </article>
        <article class="p-3 reservas-user">
            <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Corrida</th>
                    <th scope="col">Asientos</th>
                    <th scope="col">Pago</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td><a href="/corrida/{{$payment->corrida->id}}">{{$payment->corrida->id}}</a></td>
                            <td>
                                @foreach (json_decode($payment->asientos) as $asiento)
                                    {{$asiento . ','}}
                                @endforeach
                            </td>
                            <td><a href="{{route('ver_corrida',$payment->id)}}">{{$payment->number_order}}</a></td>
                        </tr>
                    @endforeach  
                </tbody>
              </table>
        </article>
@endsection