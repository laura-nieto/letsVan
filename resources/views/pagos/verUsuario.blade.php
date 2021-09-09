@extends('layouts.home')
@section('title',"Ver Mis Reservas - Let's Van")
@section('main')
<article class="home--title">
    <h2 class="text-center">
        Pagos {{$payment->created_at->format('d/m/Y')}}
    </h2>
</article>
<div class="w-50 crud--new">
    <a href="{{route('ver_reservas',Auth::id())}}" class="btn btn-lets fsize-1">Volver</a>
</div>
<article class="p-3 reservas-user">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Tipo de Pago</th>
                <th scope="col">Número de Orden</th>
                <th scope="col">Total</th>
                <th scope="col">Estado del Pago</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$payment->tipo_pago}}</td>
                <td>{{$payment->number_order}}</td>
                <td>{{$payment->total}}</td>
                <td>
                    @if ($payment->pay == 0)
                    No pago
                    @elseif($payment->pay == 1)
                    Pagado
                    @elseif($payment->pay == 2)
                    Pago no realizado
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</article>
@endsection