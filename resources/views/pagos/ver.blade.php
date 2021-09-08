@extends('layouts.home')
@section('title',"Ver Mis Reservas - Let's Van")
@section('main')
    <article class="home--title">
        <h2 class="text-center">
            Pagos {{$fechas[0]}} - {{$fechas[1]}}
        </h2>
    </article>
    <article class="p-3 reservas-user">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Apellido y Nombre comprador</th>
                    <th scope="col">Teléfono del comprador</th>
                    <th scope="col">Número de Orden</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estado del Pago</th>
                </tr>
            </thead>
            <tbody>
                @if ($payments->isEmpty())
                    <tr>
                        <th colspan="5" class="fz-1 text-center">
                            No hay pagos entre esas fechas.
                        </th>
                    </tr>
                @endif
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{$payment->comprador->apellido . ' ' . $payment->comprador->nombre}}</td>
                        <td>{{$payment->comprador->telefono}}</td>
                        <td>{{$payment->number_order}}</td>
                        <td>{{$payment->total}}</td>
                        <td>
                            @if ($payment->pay == 0)
                            No pago
                            @elseif($payment->pay == 1)
                            Pagado
                            @elseif($payment->pay == 2)
                            Transferencia aún no paga
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            <a href="{{route('pagos.buscador')}}" class="fz-1">Volver</a>
        </div>
    </article>

@endsection
