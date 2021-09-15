@extends('layouts.home')
@section('title',"Métodos de Pago - Let's Van")
@section('main')
    @php
        // SDK de Mercado Pago
        require  base_path('vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = 'Pasaje a ' . $vuelta->destino_tabla->destino;
        $item->quantity = 1;
        $item->unit_price = $total;

        //...
        $preference->back_urls = array(
            "success" => route('payment.success.redondo',$vuelta->id),
            "failure" => route('payment.fail'),
            "pending" => route('payment.pending')
        );
        $preference->auto_return = "approved";
        // ...

        $preference->items = array($item);
        $preference->save();
    @endphp
    <article class="home--title">
        <h2 class="text-center">
            Realizar Pago
        </h2>
    </article>
    @if (session('success'))
        <div class="alert alert-success mx-2" role="alert">
            {{session('success')}}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger px-5" role="alert">
            {{session('error')}}
        </div>
    @endif
    <article class="container">
        <section class="mb-5">
            <div class="card">
                <div class="card-header background-lets">
                    <h4>Ida</h4>
                </div>
                <div class="card-body d-flex flex-column flex-md-row justify-content-around">
                    <div class="p-3">
                        <h5>Origen: {{$ida->origen_tabla->destino}}</h5>
                        <h5>Salida: {{$ida->dia_salida->format('d-m-y')}}</h5>
                        <h5>Hora de Salida: {{$ida->hora_salida}}</h5>
                    </div>
                    <div class="p-3">
                        <h5>Destino: {{$ida->destino_tabla->destino}}</h5>
                        <h5>Llegada: {{$ida->dia_llegada->format('d-m-y')}}</h5>
                        <h5>Hora de Llegada: {{$ida->hora_llegada}}</h5>
                    </div>                    
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header background-lets">
                    <h4>Vuelta</h4>
                </div>
                <div class="card-body d-flex flex-column flex-md-row justify-content-around">
                    <div class="p-3">
                        <h5>Origen: {{$vuelta->origen_tabla->destino}}</h5>
                        <h5>Salida: {{$vuelta->dia_salida->format('d-m-y')}}</h5>
                        <h5>Hora de Salida: {{$vuelta->hora_salida}}</h5>
                    </div>
                    <div class="p-3">
                        <h5>Destino: {{$vuelta->destino_tabla->destino}}</h5>
                        <h5>Llegada: {{$vuelta->dia_llegada->format('d-m-y')}}</h5>
                        <h5>Hora de Llegada: {{$vuelta->hora_llegada}}</h5>
                    </div>
                </div>
            </div>
        </section>
        @if ($ida->precio->cupon)
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('descuento_cupon',$ida->id)}}" method="post" class="w-25">
                        @csrf
                        <div class="mb-3">
                            <h5 class="form-label">Cupón</h5>
                            <input type="text" class="form-control" name="cupon" {{session()->exists('cupon')? 'disabled':''}}>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" {{session()->exists('cupon')? 'disabled':''}}>Cargar</button>
                    </form>
                </div>
            </div>
        @endif
        <section class="mb-5">
            <div class="card">
                <div class="card-header background-lets">
                    <h4>Total a pagar</h4>
                </div>
                <div class="card-body">
                    {{-- @if ($pasajes['niños'])
                        <h5>Niños: {{$pasajes['niños']}} x ${{$corrida->precio->niño}}</h5>
                    @endif
                    @if($pasajes['adultos'])
                        <h5>Adultos: {{$pasajes['adultos']}} x  ${{$corrida->precio->adulto}}</h5>
                    @endif
                    @if (session('cupon'))
                        <h5>Descuento: ${{session('cupon')}}</h5>
                    @endif --}}
                    <h4>Total a pagar: ${{$total}}</h4>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="cho-container m-3">

                    </div>
                    @if ($transferencia)
                        <div>
                            <form action="{{route('pagar_transferencia',$ida->id)}}" method="post">
                                @csrf
                                <input type="submit" value="Transferencia" class="btn btn-lets">
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        
    </article>

@endsection
@section('js')
    {{-- SDK MercadoPago.js V2 --}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    
    <script>
        // Agrega credenciales de SDK
          const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
                locale: 'es-AR'
          });
        
          // Inicializa el checkout
          mp.checkout({
              preference: {
                  id: '{{$preference->id}}'
              },
              render: {
                    container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                    label: 'Mercado Pago', // Cambia el texto del botón de pago (opcional)
              }
        });
        </script>
@endsection