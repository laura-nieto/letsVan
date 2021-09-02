@extends('layouts.home')
@section('title',"Inicio - Let's Van")
@section('link-head')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
@endsection
@section('main')
{{-- {{session()->flush();}} --}}
{{-- {{dd(session()->all())}} --}}
@if (Auth::user()->role === 1)
<div class="container">
    <article class="home--title">
        <h1 class="text-center">Panel de Control</h1>
    </article>
    <article>
        <section>
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                    <h5>Unidades</h5>
                    <a href="{{route('unidad.index')}}" class="btn btn-lets">Modificar</a>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                    <h5>Choferes</h5>
                    <a href="{{route('chofer.index')}}" class="btn btn-lets">Modificar</a>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                    <h5>Corridas</h5>
                    <a href="{{route('corrida.index')}}" class="btn btn-lets">Modificar</a>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                    <h5>Destinos</h5>
                    <a href="{{route('destino.index')}}" class="btn btn-lets">Modificar</a>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                    <h5>Servicios</h5>
                    <a href="{{route('servicio.index')}}" class="btn btn-lets">Modificar</a>
                </div>
            </div>
        </section>
        <section class="mt-4">

            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="m-0">Transferencias</h5>
                        @if($exists)
                        <i class="fas fa-exclamation-circle fa-2x ml-3 text-danger"></i> 
                        @endif
                    </div>
                    <a href="{{route('ver_transferencias')}}" class="btn btn-lets">Ver</a>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                    <h5>Pasajeros</h5>
                    <a href="{{route('pasajeros.verCorridas')}}" class="btn btn-lets">Ver</a>
                </div>
            </div>
        </section>
    </article>
</div>
@elseif(Auth::user()->role === 2)
<div class="container">
    <article class="home--title">
        <h1 class="text-center">Panel de Control</h1>
    </article>
    <article>
        <section class="mt-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                    <h5>Pasajeros</h5>
                    <a href="{{route('pasajeros.verCorridas')}}" class="btn btn-lets">Ver</a>
                </div>
            </div>
        </section>
    </article>
</div>
@elseif(Auth::user()->role === 0)
{{-- <div class="background-image" style="background-image: url({{asset('img/background-user.jpg')}})"></div> --}}
<section class="bg-dark d-flex justify-content-between height-40">
    <h2 class="text-white align-self-center">
        Tu mejor opción para viajar cómodo, seguro y a bajo costo.
    </h2>
    <img src="{{asset('img/background-user.png')}}" alt=""
        class="background-image align-self-center align-self-md-start">

</section>

<section class="search-form m-auto shadow-sm p-3 bg-white rounded">
    @if (session('success'))
        <div class="alert alert-success mx-2" role="alert">
            {{session('success')}}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger px-5" role="alert">
            {{session('error')}}
        </div>
    @endif
    <form action="{{route('corrida.buscar')}}" method="get">
        <article class="mb-3">
            <div class="w-15 mb-3">
                <select class="form-control" aria-label="tipo" id="tipo">
                    <option value="0" selected>Sencillo</option>
                    <option value="1">Redondo</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <div class="w-25 mr-3">
                    <select class="form-control @error('origen') border-danger @enderror" aria-label="Origen"
                        name="origen">
                        <option selected disabled hidden>Origen</option>
                        @foreach ($destinos as $destino)
                        <option value="{{$destino->id}}">{{$destino->destino}}</option>
                        @endforeach
                    </select>
                    @error('origen')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="w-25 mr-3">
                    <select class="form-control @error('destino') border-danger @enderror" aria-label="Destino"
                        name="destino">
                        <option selected disabled hidden>Destino</option>
                        @foreach ($destinos as $destino)
                        <option value="{{$destino->id}}">{{$destino->destino}}</option>
                        @endforeach
                    </select>
                    @error('destino')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="w-25 mr-3">
                    <input type="date" class="form-control" placeholder="Fecha de Ida" name="dia_salida">
                </div>
                <div class="w-25" style="display:none;" id="input-hidden">
                    <input type="date" class="form-control" placeholder="Fecha de Vuelta" name="dia_llegada">
                </div>
            </div>
        </article>
        <article class="d-flex justify-content-between">
            {{-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="viaje_redondo">
                                <label class="form-check-label">
                                    Viaje Redondo
                                </label>
                            </div> --}}
            <button type="submit" class="btn btn-lets">Buscar</button>
        </article>
    </form>
</section>
<section class="p-4 w-95 m-auto d-flex flex-md-row flex-column caracteristicas">
    <div class="d-flex flex-column">

        <div class="mb-3">
            <h5>Let's Van</h5>
        </div>
        <div class="mb-md-5">
            <h2>Empresa 100% Mexicana</h2>
            <h3>Agencia de Viajes Online</h3>
        </div>

        <div class="d-flex align-items-center flex-fill py-4">
            <div class="mr-3">
                <img src="{{asset('/img/calendar.png')}}" alt="" class="img-icon">
            </div>
            <div>
                <h5>Morelia a CDMX</h5>
                <p class="mb-0">Dedicado a organizar grupos de personas que deseen viajar de Morelia a CDMX y viceversa.
                </p>
            </div>
        </div>

        <div class="d-flex align-items-center flex-fill py-4">
            <div class="mr-3">
                <img src="{{asset('/img/lock.png')}}" alt="" class="img-icon">
            </div>
            <div>
                <h5>Viaje Seguro</h5>
                <p class="mb-0">Buscamos que cada viaje sea fácil, accesible, cómodo y seguro. Haciendo uso de las
                    tecnologías para coordinar al grupo de personas que utilicen esta ruta de viaje constante y puedan
                    ahorrar dinero en cada viaje.</p>
            </div>
        </div>
    </div>
    <div class="align-self-md-center">


        <div class="d-flex justify-content-center mt-md-3">
            <img src="{{asset('/img/section-home.png')}}" alt="" class="img-home">
        </div>


        <div class="mt-5 pl-md-5 d-flex align-items-center">
            <div class="mr-3">
                <img src="{{asset('/img/medal.png')}}" alt="" class="img-icon">
            </div>
            <div>
                <h5>Vehículos Sanitizados</h5>
                <p class="mb-0">Nos apoyamos de proveedores locales de transporte que cuentan con permiso para
                    transporte turístico de pasajeros.</p>
            </div>
        </div>
    </div>


</section>
<section class="bg-dark text-white mt-5 p-5 descripcion d-flex justify-content-center">
   <ol class="order-list-me">
       <li>
            Reserva las 24 horas, desde la comodidad de tu casa u oficina, solo entra a nuestro sitio, busca tu salida y
            fecha, ELIJE TU ASIENTO y tu forma de pago. Tan fácil como eso y ya tienes tu e-ticket para abordar tu Van.
        </li>
       <li>
            Tu pago lo puedes hacer con tarjeta de crédito o débito, Transferencia o depósito. Todas las opciones, 100%
            digital y sin papel.
       </li>
       <li>
            Viaja de punto a punto sin la necesidad de estar en las terminales. Más rápido y con ubicaciones muy
            céntricas.
       </li>
       <li>
            Disfruta del mejor entretenimiento en tus viajes, contamos con las últimas películas de estreno.
       </li>
   </ol>

</section>

<section class="w-95 mt-4 p-4 mx-auto">
    <h2 class="text-center mb-3">Sobre nosotros</h2>
    <div class="d-flex flex-md-row flex-column justify-content-center description-as">
        <p class="mr-md-5">
            LET’S VAN es una empresa 100% mexicana, agencia de viajes on line. Dentro del segmento turistico dedicado a organizar grupos de personas que desean viajar de Morelia a la CDMX y viceversa, en donde buscamos que cada viaje sea facíl, accesible, comodo y seguro. Haciendo uso de las tecnologías para coordinar al grupo de personas que utilicen esta ruta de viaje constante y puedan ahorrar dinero en cada viaje.
        </p>
        <p>
            Para llevar a cabo este servicio nos apoyamos de proveedores locales de transporte que cuentan con permiso para trasnporte turístico de pasajeros y al tener nuestros grupos organizados ellos nos brindan el servicio de punto a punto.
        </p>
    </div>
</section>

<footer class="bg-dark text-white mt-5 p-3 footer-index d-flex">
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100" height="50" viewBox="0 0 630 300">
            <image id="Capa_1" data-name="Capa 1" x="44" y="102" width="533" height="77" xlink:href="data:img/png;base64,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"/>
        </svg> 
    </div>
    <div class="d-flex align-items-center justify-content-center m-auto">
        <p class="m-0 mr-4">Encontranos en:</p>
        <a href="facebook.com" class="text-white mr-4"><i class="fab fa-instagram fa-2x"></i></a>
        <a href="instagram.com" class="text-white"><i class="fab fa-facebook-f fa-2x"></i></a>
    </div>
</footer>
@endif

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script>
    $('#tipo').change(function () {
        if ($('#tipo option:selected').val() == 1) {
            $('#input-hidden').show();

        } else {
            $('#input-hidden').hide();
        }
    });

</script>
@endsection
