@extends('layouts.home')
@section('title',"Inicio - Let's Van")
@section('main')
{{-- {{session()->flush();}} --}}
@guest
    <section class="background-lets d-flex justify-content-between height-40">
        <h2 class="align-self-center h1 font-weight-bold font-3 asd mb-4">
            Tu mejor opción para viajar cómodo, seguro y a bajo costo.
        </h2>
        <img src="{{asset('img/background-user.png')}}" alt=""
            class="background-image align-self-center align-self-md-start">

    </section>

    <section class="search-form m-auto shadow-sm p-3 bg-white rounded w-75-lg">
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
                    <select class="form-control bg-lets-light" aria-label="tipo" id="tipo">
                        <option value="0" selected>Sencillo</option>
                        <option value="1">Redondo</option>
                    </select>
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-sm-around">
                    <div class="d-flex w-100">
                        <div class="mr-3 w-100-sm">
                            <select class="form-control bg-lets-light @error('origen') border-danger @enderror"
                                aria-label="Origen" name="origen">
                                <option selected disabled hidden>Origen</option>
                                @foreach ($destinos as $destino)
                                <option value="{{$destino->id}}">{{$destino->destino}}</option>
                                @endforeach
                            </select>
                            @error('origen')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mr-md-3 w-100-sm">
                            <select class="form-control bg-lets-light @error('destino') border-danger @enderror"
                                aria-label="Destino" name="destino">
                                <option selected disabled hidden>Destino</option>
                                @foreach ($destinos as $destino)
                                <option value="{{$destino->id}}">{{$destino->destino}}</option>
                                @endforeach
                            </select>
                            @error('destino')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex mt-3 mt-md-0 w-100">
                        <div class="mr-3 w-100-sm w-50">
                            <input type="date" class="form-control bg-lets-light" placeholder="Fecha de Ida"
                                name="dia_salida">
                        </div>
                        <div class="w-50" style="display:none;" id="input-hidden">
                            <input type="date" class="form-control bg-lets-light" placeholder="Fecha de Vuelta"
                                name="dia_llegada">
                        </div>
                    </div>
                </div>
            </article>
            <article class="d-flex justify-content-between">
                <button type="submit" class="btn btn-lets btn-ancho fz-1">Buscar</button>
            </article>
        </form>
    </section>
    <section class="d-flex p-4 w-95 mb-5 mx-auto align-content-center justify-content-between">
        <div class="w-25">
            <img src="{{asset('img/CATEDRAL-MORELIA-BLUE2.png')}}" alt="" class="img-home-catedral">
        </div>
        <div class="align-self-center d-flex flex-column flex-xl-row align-items-center letter-responsive">
            <div>
                <div class="d-flex align-items-center mb-4 fa-arrow-responsive">
                    <i class="fas fa-arrow-circle-right fa-5x"></i>
                    <h2 class="h1 m-0 ml-2">Morelia</h2>
                </div>
                <div class="d-flex align-items-center fa-arrow-responsive">
                    <i class="fas fa-arrow-circle-left fa-5x"></i>
                    <h2 class="h1 m-0 ml-2">CDMX</h2>
                </div>
            </div>
            <div class="ml-xl-5 mt-4 mt-xl-0 align-self-center">
                <h3 class="h2 text-center">Viaje sencillo desde</h3>
                <h2 class="text-success text-center font-weight-bold font-3">$360</h2>
            </div>
        </div>
        <div class="w-25">
            <img src="{{asset('/img/columna.png')}}" alt="" class="img-home-columna">
        </div>
    </section>

    <section class="background-lets text-white mt-5 p-5 descripcion d-flex justify-content-center text-justify">
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

    <section class="p-4 w-95 mt-5 mx-auto d-flex flex-md-row flex-column caracteristicas text-justify">
        <div class="d-flex flex-column mr-md-4">
            <div class="mb-3">
                <img src="{{asset('/img/logo/LOGO-FONDO-NEGRO-LV-2.jpg')}}" alt="Logo Lets Van" class="img-logo">
            </div>
            <div class="mb-md-5">
                <h2>Empresa 100% Mexicana</h2>
                <h3>Agencia de Viajes Online</h3>
            </div>
            <div class="d-flex align-items-center flex-fill py-4 mt-5 mt-md-0">
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
        <div class="d-flex flex-column">

            <div class="d-flex justify-content-center my-md-auto my-4">
                <img src="{{asset('/img/section-home.png')}}" alt="" class="img-home">
            </div>
            <div class="d-flex align-items-center py-4">
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


    <section class="mt-5 p-5 background-lets text-white text-justify">
        <h2 class="text-center mb-3">Sobre nosotros</h2>
        <div class="d-flex flex-md-row flex-column justify-content-center description-as">
            <p class="mr-md-5">
                LET’S VAN es una empresa 100% mexicana, agencia de viajes on line. Dentro del segmento turistico dedicado a
                organizar grupos de personas que desean viajar de Morelia a la CDMX y viceversa, en donde buscamos que cada
                viaje sea facíl, accesible, comodo y seguro. Haciendo uso de las tecnologías para coordinar al grupo de
                personas que utilicen esta ruta de viaje constante y puedan ahorrar dinero en cada viaje.
            </p>
            <p>
                Para llevar a cabo este servicio nos apoyamos de proveedores locales de transporte que cuentan con permiso
                para trasnporte turístico de pasajeros y al tener nuestros grupos organizados ellos nos brindan el servicio
                de punto a punto.
            </p>
        </div>
    </section>
@else

@if (Auth::user()->role === 1)
    <div class="container">
        <article class="home--title">
            <h2 class="text-center">Panel de Control</h2>
        </article>
        <article>
            <section>
                <div class="card">
                    <div class="card-header background-lets">
                        <h4>Administración</h4>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                        <h5>Corridas</h5>
                        <a href="{{route('corrida.index')}}" class="btn btn-lets">Administrar</a>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                        <h5>Unidades</h5>
                        <a href="{{route('unidad.index')}}" class="btn btn-lets">Administrar</a>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                        <h5>Choferes</h5>
                        <a href="{{route('chofer.index')}}" class="btn btn-lets">Administrar</a>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                        <h5>Origenes/Destinos</h5>
                        <a href="{{route('destino.index')}}" class="btn btn-lets">Administrar</a>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                        <h5>Servicios de la Unidad</h5>
                        <a href="{{route('servicio.index')}}" class="btn btn-lets">Administrar</a>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                        <h5>Nuevo Pasaje</h5>
                        <a href="{{route('corrida.admin_buscar')}}" class="btn btn-lets">Crear</a>
                    </div>
                </div>
            </section>
            <section class="my-5">
                <div class="card">
                    <div class="card-header background-lets">
                        <h4>Reportes</h4>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                        <div class="d-flex align-items-center">
                            <h5 class="m-0">Transferencias</h5>
                            @if($exists)
                            <div class="bg-danger text-white ml-3 notification"><span>{{$exists}}</span></div>
                            @endif
                        </div>
                        <a href="{{route('ver_transferencias')}}" class="btn btn-lets">Ver</a>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                        <h5>Pasajeros</h5>
                        <a href="{{route('pasajeros.verCorridas')}}" class="btn btn-lets">Ver</a>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center border-bottom">
                        <h5>Pagos</h5>
                        <a href="{{route('pagos.buscador')}}" class="btn btn-lets">Ver</a>
                    </div>
                </div>
            </section>
        </article>
    </div>
@elseif(Auth::user()->role === 2)
    <div class="container">
        <article class="home--title">
            <h2 class="text-center">Panel de Control</h2>
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
    <section class="background-lets d-flex justify-content-between height-40">
        <h2 class="align-self-center h1 font-weight-bold font-3 asd mb-4">
            Tu mejor opción para viajar cómodo, seguro y a bajo costo.
        </h2>
        <img src="{{asset('img/background-user.png')}}" alt=""
            class="background-image align-self-center align-self-md-start">
    </section>

    <section class="search-form m-auto shadow-sm p-3 bg-white rounded w-75-lg">
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
                    <select class="form-control bg-lets-light" aria-label="tipo" id="tipo">
                        <option value="0" selected>Sencillo</option>
                        <option value="1">Redondo</option>
                    </select>
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-sm-around">
                    <div class="d-flex w-100">
                        <div class="mr-3 w-100-sm">
                            <select class="form-control bg-lets-light @error('origen') border-danger @enderror"
                                aria-label="Origen" name="origen">
                                <option selected disabled hidden>Origen</option>
                                @foreach ($destinos as $destino)
                                <option value="{{$destino->id}}">{{$destino->destino}}</option>
                                @endforeach
                            </select>
                            @error('origen')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mr-sm-3 w-100-sm">
                            <select class="form-control bg-lets-light @error('destino') border-danger @enderror"
                                aria-label="Destino" name="destino">
                                <option selected disabled hidden>Destino</option>
                                @foreach ($destinos as $destino)
                                <option value="{{$destino->id}}">{{$destino->destino}}</option>
                                @endforeach
                            </select>
                            @error('destino')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex mt-3 mt-sm-0 w-100">
                        <div class="mr-3 w-100-sm">
                            <input type="date" class="form-control bg-lets-light" placeholder="Fecha de Ida"
                                name="dia_salida">
                        </div>
                        <div class="w-100-sm" style="display:none;" id="input-hidden">
                            <input type="date" class="form-control bg-lets-light" placeholder="Fecha de Vuelta"
                                name="dia_llegada">
                        </div>
                    </div>
                </div>
            </article>
            <article class="d-flex justify-content-between">
                <button type="submit" class="btn btn-lets btn-ancho fz-1">Buscar</button>
            </article>
        </form>
    </section>
    <section class="d-flex p-4 w-95 mb-5 mx-auto align-content-center justify-content-between">
        <div class="w-25">
            <img src="{{asset('img/CATEDRAL-MORELIA-BLUE2.png')}}" alt="" class="img-home-catedral">
        </div>
        <div class="align-self-center d-flex flex-column flex-xl-row align-items-center letter-responsive">
            <div>
                <div class="d-flex align-items-center mb-4 fa-arrow-responsive">
                    <i class="fas fa-arrow-circle-right fa-5x"></i>
                    <h2 class="h1 m-0 ml-2">Morelia</h2>
                </div>
                <div class="d-flex align-items-center fa-arrow-responsive">
                    <i class="fas fa-arrow-circle-left fa-5x"></i>
                    <h2 class="h1 m-0 ml-2">CDMX</h2>
                </div>
            </div>
            <div class="ml-xl-5 mt-4 mt-xl-0 align-self-center">
                <h3 class="h2 text-center">Viaje sencillo desde</h3>
                <h2 class="text-success text-center font-weight-bold font-3">$360</h2>
            </div>
        </div>
        <div class="w-25">
            <img src="{{asset('/img/columna.png')}}" alt="" class="img-home-columna">
        </div>
    </section>

    <section class="background-lets text-white mt-5 p-5 descripcion d-flex justify-content-center text-justify">
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

    <section class="p-4 w-95 mt-5 mx-auto d-flex flex-md-row flex-column caracteristicas text-justify">
        <div class="d-flex flex-column mr-md-4">
            <div class="mb-3">
                <img src="{{asset('/img/logo/LOGO-FONDO-NEGRO-LV-2.jpg')}}" alt="Logo Lets Van" class="img-logo">
            </div>
            <div class="mb-md-5">
                <h2>Empresa 100% Mexicana</h2>
                <h3>Agencia de Viajes Online</h3>
            </div>
            <div class="d-flex align-items-center flex-fill py-4 mt-5 mt-md-0">
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
        <div class="d-flex flex-column">

            <div class="d-flex justify-content-center my-md-auto my-4">
                <img src="{{asset('/img/section-home.png')}}" alt="" class="img-home">
            </div>
            <div class="d-flex align-items-center py-4">
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
        {{-- <div class="align-self-md-center">
                    
                    
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
        </div> --}}


    </section>

    <section class="mt-5 p-5 background-lets text-white text-justify">
        <h2 class="text-center mb-3">Sobre nosotros</h2>
        <div class="d-flex flex-md-row flex-column justify-content-center description-as">
            <p class="mr-md-5">
                LET’S VAN es una empresa 100% mexicana, agencia de viajes on line. Dentro del segmento turistico dedicado a
                organizar grupos de personas que desean viajar de Morelia a la CDMX y viceversa, en donde buscamos que cada
                viaje sea facíl, accesible, comodo y seguro. Haciendo uso de las tecnologías para coordinar al grupo de
                personas que utilicen esta ruta de viaje constante y puedan ahorrar dinero en cada viaje.
            </p>
            <p>
                Para llevar a cabo este servicio nos apoyamos de proveedores locales de transporte que cuentan con permiso
                para trasnporte turístico de pasajeros y al tener nuestros grupos organizados ellos nos brindan el servicio
                de punto a punto.
            </p>
        </div>
    </section>

@endif

@endguest
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
