@extends('layouts.home')
@section('title',"Ver Mis Reservas - Let's Van")
@section('main')
        <article class="home--title">
            <h2 class="text-center">
                Ver Reservas
            </h2>
        </article>
        <article class="p-3 reservas-user">
            <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Día Salida</th>
                    <th scope="col">Hora Salida</th>
                    <th scope="col">Día Llegada</th>
                    <th scope="col">Hora Llegada</th>
                    <th scope="col">Asientos</th>
                    <th scope="col">Estado del Pago</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{$payment->corrida->dia_salida->format('d-m-y')}}</td>
                            <td>{{$payment->corrida->hora_salida}}</td>
                            <td>{{$payment->corrida->dia_llegada->format('d-m-y')}}</td>
                            <td>{{$payment->corrida->hora_llegada}}</td>
                            <td>
                                @foreach (json_decode($payment->asientos) as $asiento)
                                    {{$asiento . ','}}
                                @endforeach
                            </td>
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
        </article>

@endsection