@extends('layouts.home')
@section('title',"Inicio - Let's Van")
@section('main')
@php
    session()->forget(['cantidad','total','pasajes','comprador','cupon','niños','corrida_ida','redondo','pasajeros_ida','pasajeros_vuelta','asientos_ida','asientos_vuelta','corrida_vuelta','cantidad_vuelta']);
@endphp 
 {{-- {{session()->flush();}}   --}}
{{-- {{dd(session()->all())}} --}}
@guest
    <section class="background-lets d-flex flex-column flex-md-row justify-content-between height-40">
        <h2 class="align-self-center h1 font-weight-bold font-3 mb-5 mt-3 pl-md-4">
            Tu mejor opción para viajar cómodo, seguro y a bajo costo.
        </h2>
        <div class="d-flex justify-content-end">
            <div class="position-relative">
                <div class="position-absolute position-top">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="49" height="40" viewBox="0 0 49 40">
                        <image class="image-icon-width-responsive" id="WIFI" width="49" height="40" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADEAAAAoCAYAAABXRRJPAAADmklEQVRYhe3Ze+idcxwH8NfZ5jc1ZXM3xdxDmKgxNpfFj8b+kPjDUuRSkkQSEZMkIpfYEMU//jDxpyKbSyblujUxud/ZzPyYLWv66nN0Op3n+zznnOccv8m7nj/O+X6fz/dzv3yfhnowAdOxL2Zgb+yJnbF9nLARa/ENvsBn+DR+94V+hEgMz8EpODqY36FLGr/iE7yFl/AaPq9JsYXYHZfiRfyGrTU/SajncRF2qZv5/XAvfhgA40XPt7gzXLMv7IV78MsQmW9/1uGO8IKOKIqJibgCN2C3ilr4EWvwUQTtd1iPP+KcFOBTsUfE00E4oAu3+Rq3YUmVzYfhlYpaehM34QTsVJGZVqTsdSIW4e2KZ76AA3NEF4b5ckS+x/2Y1QPTOaQ0fTwW46cKPJzTTqsRQZR7MZnz+pxv1ohUc24OZnM8LWoemXL705mNm3BXF7FRtzDJ6n9m+Hs8WeAZnF1A5D1cjtcrHDgJ++PQCNp9sCumxPpYpOhUrT/E6ih0WyrQPhkP4pAOa5uFAGMdJFxSoQJPxmj48eogWDV1JguvxAOYh+1KzkqZ7YkCN/8bp2FD/Lk5tJ9Dcq3r8EGN9WAVro6MlcM1Yb1mDZnbuvd0fIlzMwSSy1wZTdugiltyt8tK+roLY9/cTos5LcyK2BgU8+3PchyV4ecfXqt2scnMt0cM5JCq9LuRENZEivw99k+Jap0K1UwcWSHjpSbz2oi5njGCR0s0luaEpzAf07o4KGlyAZZWSAj3RSvUNVIFfbIkuywuSHvd4gg8VlIPHupl/mlk0u8yHFMD8+2YXRB3P+OMfgifGsNKk+CtvZq2IkaiQ2iety4myEJUNc/8iI1b8EjJ3oNxXATvjChSQptppn4HK/BxCZ2rIqgXhuVrQS6TjMRhyyNWytLnxmipzyux6tD6tdEY9HutB2/gpGEx245GuFcdhW1LtDFDF+DhAVTpu3thZlKPQmyNq5XzW1rt1rVXY/39qNqNqNYzo0eb3YHm+rgKGjpGo61oajIF67EVmJjTNsdvKGrmhoUzQ9s3dnnexOjHUr81798UoInpfbyb7mz/x38CdV3tFyG15ofH2spoPbYpXBzjbjMDfYVLtiUBzsoUtAXjgL9STCiZxVfEnnGNHeOGvEiItS3teW1aqxubYsAvwljsGddCpO8Rz2bWn4t5Ytxjakxj7a70cpc3IpUwyDqR7qguiHvWhPR1NN2l1upK8BdwBAQz+AO8TAAAAABJRU5ErkJggg=="/>
                    </svg>
                </div>
                <div class="position-absolute position-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="52" height="52" viewBox="0 0 52 52">
                        <image class="image-icon-width-responsive" id="TV" width="52" height="52" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADQAAAA0CAYAAADFeBvrAAADrklEQVRogd2a24tPURTHPzOMSwxGbpk0kkuTS3IrMzFPSomYSCmFF/KgRJEH8STXSCIl48GtEE/+AS88uCYTyiUMpsYMY4i5aP1aUzN71v5dzpnfnD0+der32+fsfdb3t/dee629fwMIlznAQWA+8ABoDdjWjFQA9UCHXqcDtzctIqahixi5ngdsb1qqDDFy7Q3YZi+VQKMhpgYYGKjNXio9PSNiCvramDHAKeAKsDhC/aXAN0PM2STECNe6GPELWJlD3Yo0wywxah1jfmcpyjfMLiXVM53sNIzK1FNLPGLOJS2mkyM5iJKeaTKev5iM6X6OGka6wy8ob5YNlijpqWXAAo+Y86GK6eSQR9QPo/xCGCZn5rBhfPBzJhMiqs0Q0q7DLC+4Y7cc2KY5yMgYL+xQMZLTFBr3nuq73Xu50KztiKt/ZNXbAbRkMVRCu/4AB1wxW/qhEPfah3b7WA1fRsfo/hCQnpoteUZ1FmLqgCfAa+Al8AX47snzG3XiFwNFxv0RwHBgOjBFjABm9cIPMghYi7pPXzfKZFsX00FkQhzDQg1K4w671FJQ47l5AxiaRyEWu2MKqinUDy7v1VH86mNBxzRRjEqHbx04o3MkCY7rHIyEJUgau5uQGHTe1qa5/xn46btpCZLh9qp3bIuETIEXRsWPwGr1jjN1zyErQW80j0mSx867JcxZBdzRqP0dsB24mo2grwmLET4430XgQ+O5HhG7Jaip9+yKTEOWFXt4aEtQczIauuEuF3OBecZzm90CS9Dn3rcvZ1y7JFS6DawBxqtjOAlscBu29oxDyO9bjLJJwC11WEN8FeMkWPnEt8606Qiq72+CLMTLLQKmAtOAXSqwG6EKKna+N+j8eagixBOf0PS7G5agEOaQO0eeaQTjctMtsARNzIuJueEGp4M9tYe5BZagvs6BLNyEUtag5cZzO9wCS1BJ3szMnlHOk4M0T5IcbYY6h+u6xdwNax0aF4CgyUZZiW4dt6Y7c7V6aKquzElihTmdpD1A9jmF8gTFDImzC+Rbh6qj2xObKg1zIuETtBUoS0CM2LM/bgPWQlqi2WDkXyoCRbqlVhGjjYJCKx5S5D8H94E96irzFUFMANYD94CNMdtqL9Cc4nKGB//qTsxb3Rau0xC/Pt0OjIO8q1TXlFL9w0aZOiB33YmKnMinwoc3/8HpQ4P2dooVGj/1Z0Gb3F5doxFtfxMiCZ+ERCnciS7jWtYgOYK3jkJCQkIgSSvkUOFTyjDgH6q9C0X1pwdCAAAAAElFTkSuQmCC"/>
                    </svg>
                </div>
                <div class="position-absolute position-bot">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="38" height="51" viewBox="0 0 38 51">
                        <image class="image-icon-width-responsive" id="VENTILADOR" width="38" height="51" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACYAAAAzCAYAAAD7JnqGAAAE50lEQVRYhdWZa4hVVRTHf01TzYypOUSaWc1MTwmjjF5qJfWlBsmsiCm0pAihvpRCEIoZTVnEUI1lEDUl9MGKMkQs7C1Z0YPGqLTMpBp7SCk2KWXWjXX572Fxuueefc6dmegPhzvn7L3W/u+9116PPQdQDM3AucCZwOlAC3AEcDDwK7AD2AT0Au8BHwN/FBwrChcCTwLbgVKOx0h2AifGDhS7YlOBhcAl7tufWpFNIvoLsBOYABymVZys34DfgKeA+4C+WlaoAegSibBCG4HbgIkR8ocC04CHgB+dju+BuUVJtQEbnDJbmdnAIQX1HQkslg0GnY8C9XmUnAJscQq6gdGu/QxgHnAzcLUmkUf3eqf7eWBEjKANslVCdpKuc21mk/ckttaefqAHGBdJzlb9ESf/HHBQNYFG4ANHqj3RviDjJH4GHBVJznC3k32gWseHXcfZibZRwA8RLmJNDmKGJ5zspZU6THcduiq0n53Db03NQawJ+Ehy2xK2XLadd9T4ubY0iZMq2FbaszTPkukw/S5di3xDuxvgshThOuD1SGKv5CRmeEyy5u8ODx9f1Mf3gQOrCJ8MfBNBbEMBYrYjeyV/IzpFwenNi1Bg7uTlDGKvFiBmWC35N+ylQy97ch71BVVs7vGCxK6R/M/2skwv63ME9YD5kl0BTAEmAbcAFxck1qrJ7saFh+4CikY6f2fe/JiM/uYarpQztcB+lQ5VgMXNL2Rr5T9KmmlRzFHqY9HiXeCEhJ4xiqubUxxyk+u7FtiHUpCS9rcIWp0PCs9a6blDO9KXcVg63bgrjVidY7sjBykLuBdoK1sqpEKn6tdmfl7EoZqj3A95iLq6sJ/K2bNQLx9jgf5NGfunTkfAh/ptiNBpGKt8DcXkv3H7fmuG8LHy6H4LlqltFvCVUud1GmSEksuYSLFTdoh8ZLlwectlk2kYl2K4Pl9rEHk0yLocQX+F5MxEvpZPLR/dEEbS/NgzGYrfVhkX0BYZukqy7eBmjgf2Bz92hTrsTfFDVun8laF8q2rNpN1kTWi7ipWAax3Zsj3s1oebKhCbHzHrhVXMoF1ZyS7X3zKIp93WB6xR+2vhw6oq2cVdEcQ6qhALGK8EcopPaxx8dnGDn1UYZFZCYHEEscsjiGWhx63mAHGfwW5OZLAzIoidXyOps1ymsijZOM0Zuc/5m3SE00j9lMzTc8Ln/FvkYP+Fbjegr5I6qhC7s8bV6nG6kuXiABp1AEqKczNdm53YbU6JFbkP6uqpKLqcvnuzdLS664F9iUrcgvZFKljyXAskYUF/uSO1MqPWGIAd3S+dYLeLZbViUuLu4tm8FzUtCQVGdG6OjCGJ8boS6E9MONdtT4DN5H5taVD2iTz9xIjlHyVXslynN+joUw6Witji4xw5Wn+juF9pjeVj3yrB26UYOUY2eJpuGAP6daO4VPcgg4bpKs3y3sEa+SVDcQebRLNWcbLSnQlKDBuVEOxRkdMr99MbCoz/AvUiVnSy/w/UOrtOpcMblRWglWtTYLYrzJeGeyWOVvFRzehXDzep5goVU9pz+3CRmqFL4Dzu4gVdow8J7DpyVU5C/unXv2rGDha5JqUnVkMWJeWf71QN1YSRqlgGg1DyWVILseuHiFTI9VrTBq5LaxBqSQazYP7vuLROWbmQGaxdeAwVKsdP4B9NUmv0YY6LgwAAAABJRU5ErkJggg=="/>
                    </svg>
                </div>
            </div>
            <img src="{{asset('img/background-user.png')}}" alt=""
            class="background-image">
        </div>

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
                <div class="w-15 mb-3 w-100-r320">
                    <select class="form-control bg-lets-light" aria-label="tipo" id="tipo" name="tipo">
                        <option value="0" selected>Sencillo</option>
                        <option value="1">Redondo</option>
                    </select>
                </div>
                <div class="d-flex flex-column flex-md-row justify-content-sm-around">
                    <div class="d-flex w-100 flex-wrap-r320">
                        <div class="mr-3 w-100-sm">
                            <select class="form-control bg-lets-light @error('origen') border-danger @enderror"
                                aria-label="Origen" name="origen">
                                <option selected disabled hidden>Origen</option>
                                @foreach ($origenes as $origen)
                                <option value="{{$origen->id}}">{{$origen->destino}}</option>
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
                    <div class="d-flex mt-3 mt-md-0 w-100 flex-wrap-r320">
                        <div class="mr-3 w-100-sm w-50">
                            <input type="date" class="form-control bg-lets-light" placeholder="Fecha de Ida"
                                name="dia_salida">
                        </div>
                        <div class="w-100-sm w-50" style="display:none;" id="input-hidden">
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
    <section class="d-flex p-4 w-95 mb-5 mx-auto align-content-center mb-0-r320">
        <div class="w-25">
            <img src="{{asset('img/CATEDRAL-MORELIA-BLUE_NGO.png')}}" alt="" class="img-home-catedral">
            <img src="{{asset('/img/ANGEL-BLUE.png')}}" alt="" class="img-home-columna d-md-none d-sm-block">
        </div>
        <div class="align-self-center d-flex flex-column flex-xl-row align-items-center letter-responsive mx-auto">
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
        <div class="w-10 d-none d-sm-none d-md-block">
            <img src="{{asset('/img/ANGEL-BLUE.png')}}" alt="" class="img-home-columna">
        </div>
    </section>

    <section class="background-lets text-white mt-5 p-5 descripcion d-flex justify-content-center text-justify mt-0-r320">
        <div class="w-75-md">
            <div class="d-flex align-items-center shadow-me">
                <img src="{{asset('/img/24HRS.png')}}" alt="" class="image-caracteristicas image-caracteristicas-1">
                <p class="mb-0 ml-3">
                    Reserva las 24 horas, desde la comodidad de tu casa u oficina, solo entra a nuestro sitio, busca tu salida y
                    fecha, ELIJE TU ASIENTO y tu forma de pago. Tan fácil como eso y ya tienes tu e-ticket para abordar tu Van.
                </p>
            </div>
            <div class="d-flex align-items-center mt-5 shadow-me">
                <img src="{{asset('/img/PAGOS.png')}}" alt="" class="image-caracteristicas image-caracteristicas-2">
                <p class="mb-0 ml-3">
                    Tu pago lo puedes hacer con tarjeta de crédito o débito, Transferencia o depósito. Todas las opciones, 100%
                    digital y sin papel.
                </p>
            </div>
            <div class="d-flex align-items-center mt-5 shadow-me">
                <img src="{{asset('/img/UBICACION.png')}}" alt="" class="image-caracteristicas image-caracteristicas-3">
                <p class="mb-0 ml-3">
                    Viaja de punto a punto sin la necesidad de estar en las terminales. Más rápido y con ubicaciones muy
                    céntricas.
                </p>
            </div>
            <div class="d-flex align-items-center mt-5 shadow-me">
                <img src="{{asset('/img/CINE.png')}}" alt="" class="image-caracteristicas image-caracteristicas-4">
                <p class="mb-0 ml-3">
                    Disfruta del mejor entretenimiento en tus viajes, contamos con las últimas películas de estreno.
                </p>
            </div>
        </div>
    </section>

    <section class="p-4 w-95 mt-5 mx-auto d-flex flex-md-row flex-column caracteristicas text-justify">
        <div class="d-flex flex-column mr-md-4">
            <div class="mb-3 text-center-r320">
                <img src="{{asset('/img/logo/LOGO-FONDO-NEGRO-LV-2.jpg')}}" alt="Logo Lets Van" class="img-logo">
            </div>
            <div class="mb-md-5 text-center-r320">
                <h2 class="color--lets shadow-text">Empresa 100% Mexicana</h2>
                <h3 class="color--lets shadow-text">Agencia de Viajes Online</h3>
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

            <div class="d-flex justify-content-center my-md-auto my-4 m-0-r320">
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


    <section class="mt-5 p-5 background-lets text-white text-justify mt-0-r320">
        <h2 class="text-center mb-3 color-black">Sobre nosotros</h2>
        <div class="d-flex flex-md-row flex-column justify-content-center description-as">
            <p class="mr-md-5">
                LET’S VAN es una empresa 100% mexicana, agencia de viajes online. Dentro del segmento turistico dedicado a
                organizar grupos de personas que desean viajar de Morelia a la CDMX y viceversa, en donde buscamos que cada
                viaje sea fácil, accesible, comodo y seguro. Haciendo uso de las tecnologías para coordinar al grupo de
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
                        <h5>Cupones</h5>
                        <a href="{{route('cupon.index')}}" class="btn btn-lets">Administrar</a>
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
    <section class="background-lets d-flex flex-column flex-md-row justify-content-between height-40">
        <h2 class="align-self-center h1 font-weight-bold font-3 mb-5 mt-3 pl-md-4">
            Tu mejor opción para viajar cómodo, seguro y a bajo costo.
        </h2>
        <div class="d-flex justify-content-end">
            <div class="position-relative">
                <div class="position-absolute position-top">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="49" height="40" viewBox="0 0 49 40">
                        <image class="image-icon-width-responsive" id="WIFI" width="49" height="40" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADEAAAAoCAYAAABXRRJPAAADmklEQVRYhe3Ze+idcxwH8NfZ5jc1ZXM3xdxDmKgxNpfFj8b+kPjDUuRSkkQSEZMkIpfYEMU//jDxpyKbSyblujUxud/ZzPyYLWv66nN0Op3n+zznnOccv8m7nj/O+X6fz/dzv3yfhnowAdOxL2Zgb+yJnbF9nLARa/ENvsBn+DR+94V+hEgMz8EpODqY36FLGr/iE7yFl/AaPq9JsYXYHZfiRfyGrTU/SajncRF2qZv5/XAvfhgA40XPt7gzXLMv7IV78MsQmW9/1uGO8IKOKIqJibgCN2C3ilr4EWvwUQTtd1iPP+KcFOBTsUfE00E4oAu3+Rq3YUmVzYfhlYpaehM34QTsVJGZVqTsdSIW4e2KZ76AA3NEF4b5ckS+x/2Y1QPTOaQ0fTwW46cKPJzTTqsRQZR7MZnz+pxv1ohUc24OZnM8LWoemXL705mNm3BXF7FRtzDJ6n9m+Hs8WeAZnF1A5D1cjtcrHDgJ++PQCNp9sCumxPpYpOhUrT/E6ih0WyrQPhkP4pAOa5uFAGMdJFxSoQJPxmj48eogWDV1JguvxAOYh+1KzkqZ7YkCN/8bp2FD/Lk5tJ9Dcq3r8EGN9WAVro6MlcM1Yb1mDZnbuvd0fIlzMwSSy1wZTdugiltyt8tK+roLY9/cTos5LcyK2BgU8+3PchyV4ecfXqt2scnMt0cM5JCq9LuRENZEivw99k+Jap0K1UwcWSHjpSbz2oi5njGCR0s0luaEpzAf07o4KGlyAZZWSAj3RSvUNVIFfbIkuywuSHvd4gg8VlIPHupl/mlk0u8yHFMD8+2YXRB3P+OMfgifGsNKk+CtvZq2IkaiQ2iety4myEJUNc/8iI1b8EjJ3oNxXATvjChSQptppn4HK/BxCZ2rIqgXhuVrQS6TjMRhyyNWytLnxmipzyux6tD6tdEY9HutB2/gpGEx245GuFcdhW1LtDFDF+DhAVTpu3thZlKPQmyNq5XzW1rt1rVXY/39qNqNqNYzo0eb3YHm+rgKGjpGo61oajIF67EVmJjTNsdvKGrmhoUzQ9s3dnnexOjHUr81798UoInpfbyb7mz/x38CdV3tFyG15ofH2spoPbYpXBzjbjMDfYVLtiUBzsoUtAXjgL9STCiZxVfEnnGNHeOGvEiItS3teW1aqxubYsAvwljsGddCpO8Rz2bWn4t5Ytxjakxj7a70cpc3IpUwyDqR7qguiHvWhPR1NN2l1upK8BdwBAQz+AO8TAAAAABJRU5ErkJggg=="/>
                    </svg>
                </div>
                <div class="position-absolute position-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="52" height="52" viewBox="0 0 52 52">
                        <image class="image-icon-width-responsive" id="TV" width="52" height="52" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADQAAAA0CAYAAADFeBvrAAADrklEQVRogd2a24tPURTHPzOMSwxGbpk0kkuTS3IrMzFPSomYSCmFF/KgRJEH8STXSCIl48GtEE/+AS88uCYTyiUMpsYMY4i5aP1aUzN71v5dzpnfnD0+der32+fsfdb3t/dee629fwMIlznAQWA+8ABoDdjWjFQA9UCHXqcDtzctIqahixi5ngdsb1qqDDFy7Q3YZi+VQKMhpgYYGKjNXio9PSNiCvramDHAKeAKsDhC/aXAN0PM2STECNe6GPELWJlD3Yo0wywxah1jfmcpyjfMLiXVM53sNIzK1FNLPGLOJS2mkyM5iJKeaTKev5iM6X6OGka6wy8ob5YNlijpqWXAAo+Y86GK6eSQR9QPo/xCGCZn5rBhfPBzJhMiqs0Q0q7DLC+4Y7cc2KY5yMgYL+xQMZLTFBr3nuq73Xu50KztiKt/ZNXbAbRkMVRCu/4AB1wxW/qhEPfah3b7WA1fRsfo/hCQnpoteUZ1FmLqgCfAa+Al8AX47snzG3XiFwNFxv0RwHBgOjBFjABm9cIPMghYi7pPXzfKZFsX00FkQhzDQg1K4w671FJQ47l5AxiaRyEWu2MKqinUDy7v1VH86mNBxzRRjEqHbx04o3MkCY7rHIyEJUgau5uQGHTe1qa5/xn46btpCZLh9qp3bIuETIEXRsWPwGr1jjN1zyErQW80j0mSx867JcxZBdzRqP0dsB24mo2grwmLET4430XgQ+O5HhG7Jaip9+yKTEOWFXt4aEtQczIauuEuF3OBecZzm90CS9Dn3rcvZ1y7JFS6DawBxqtjOAlscBu29oxDyO9bjLJJwC11WEN8FeMkWPnEt8606Qiq72+CLMTLLQKmAtOAXSqwG6EKKna+N+j8eagixBOf0PS7G5agEOaQO0eeaQTjctMtsARNzIuJueEGp4M9tYe5BZagvs6BLNyEUtag5cZzO9wCS1BJ3szMnlHOk4M0T5IcbYY6h+u6xdwNax0aF4CgyUZZiW4dt6Y7c7V6aKquzElihTmdpD1A9jmF8gTFDImzC+Rbh6qj2xObKg1zIuETtBUoS0CM2LM/bgPWQlqi2WDkXyoCRbqlVhGjjYJCKx5S5D8H94E96irzFUFMANYD94CNMdtqL9Cc4nKGB//qTsxb3Rau0xC/Pt0OjIO8q1TXlFL9w0aZOiB33YmKnMinwoc3/8HpQ4P2dooVGj/1Z0Gb3F5doxFtfxMiCZ+ERCnciS7jWtYgOYK3jkJCQkIgSSvkUOFTyjDgH6q9C0X1pwdCAAAAAElFTkSuQmCC"/>
                    </svg>
                </div>
                <div class="position-absolute position-bot">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="38" height="51" viewBox="0 0 38 51">
                        <image class="image-icon-width-responsive" id="VENTILADOR" width="38" height="51" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACYAAAAzCAYAAAD7JnqGAAAE50lEQVRYhdWZa4hVVRTHf01TzYypOUSaWc1MTwmjjF5qJfWlBsmsiCm0pAihvpRCEIoZTVnEUI1lEDUl9MGKMkQs7C1Z0YPGqLTMpBp7SCk2KWXWjXX572Fxuueefc6dmegPhzvn7L3W/u+9116PPQdQDM3AucCZwOlAC3AEcDDwK7AD2AT0Au8BHwN/FBwrChcCTwLbgVKOx0h2AifGDhS7YlOBhcAl7tufWpFNIvoLsBOYABymVZys34DfgKeA+4C+WlaoAegSibBCG4HbgIkR8ocC04CHgB+dju+BuUVJtQEbnDJbmdnAIQX1HQkslg0GnY8C9XmUnAJscQq6gdGu/QxgHnAzcLUmkUf3eqf7eWBEjKANslVCdpKuc21mk/ckttaefqAHGBdJzlb9ESf/HHBQNYFG4ANHqj3RviDjJH4GHBVJznC3k32gWseHXcfZibZRwA8RLmJNDmKGJ5zspZU6THcduiq0n53Db03NQawJ+Ehy2xK2XLadd9T4ubY0iZMq2FbaszTPkukw/S5di3xDuxvgshThOuD1SGKv5CRmeEyy5u8ODx9f1Mf3gQOrCJ8MfBNBbEMBYrYjeyV/IzpFwenNi1Bg7uTlDGKvFiBmWC35N+ylQy97ch71BVVs7vGCxK6R/M/2skwv63ME9YD5kl0BTAEmAbcAFxck1qrJ7saFh+4CikY6f2fe/JiM/uYarpQztcB+lQ5VgMXNL2Rr5T9KmmlRzFHqY9HiXeCEhJ4xiqubUxxyk+u7FtiHUpCS9rcIWp0PCs9a6blDO9KXcVg63bgrjVidY7sjBykLuBdoK1sqpEKn6tdmfl7EoZqj3A95iLq6sJ/K2bNQLx9jgf5NGfunTkfAh/ptiNBpGKt8DcXkv3H7fmuG8LHy6H4LlqltFvCVUud1GmSEksuYSLFTdoh8ZLlwectlk2kYl2K4Pl9rEHk0yLocQX+F5MxEvpZPLR/dEEbS/NgzGYrfVhkX0BYZukqy7eBmjgf2Bz92hTrsTfFDVun8laF8q2rNpN1kTWi7ipWAax3Zsj3s1oebKhCbHzHrhVXMoF1ZyS7X3zKIp93WB6xR+2vhw6oq2cVdEcQ6qhALGK8EcopPaxx8dnGDn1UYZFZCYHEEscsjiGWhx63mAHGfwW5OZLAzIoidXyOps1ymsijZOM0Zuc/5m3SE00j9lMzTc8Ln/FvkYP+Fbjegr5I6qhC7s8bV6nG6kuXiABp1AEqKczNdm53YbU6JFbkP6uqpKLqcvnuzdLS664F9iUrcgvZFKljyXAskYUF/uSO1MqPWGIAd3S+dYLeLZbViUuLu4tm8FzUtCQVGdG6OjCGJ8boS6E9MONdtT4DN5H5taVD2iTz9xIjlHyVXslynN+joUw6Witji4xw5Wn+juF9pjeVj3yrB26UYOUY2eJpuGAP6daO4VPcgg4bpKs3y3sEa+SVDcQebRLNWcbLSnQlKDBuVEOxRkdMr99MbCoz/AvUiVnSy/w/UOrtOpcMblRWglWtTYLYrzJeGeyWOVvFRzehXDzep5goVU9pz+3CRmqFL4Dzu4gVdow8J7DpyVU5C/unXv2rGDha5JqUnVkMWJeWf71QN1YSRqlgGg1DyWVILseuHiFTI9VrTBq5LaxBqSQazYP7vuLROWbmQGaxdeAwVKsdP4B9NUmv0YY6LgwAAAABJRU5ErkJggg=="/>
                    </svg>
                </div>
            </div>
            <img src="{{asset('img/background-user.png')}}" alt=""
            class="background-image">
        </div>
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
                <div class="w-15 mb-3 w-100-r320">
                    <select class="form-control bg-lets-light" aria-label="tipo" id="tipo" name="tipo">
                        <option value="0" selected>Sencillo</option>
                        <option value="1">Redondo</option>
                    </select>
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-sm-around">
                    <div class="d-flex w-100 flex-wrap-r320">
                        <div class="mr-3 w-100-sm">
                            <select class="form-control bg-lets-light @error('origen') border-danger @enderror"
                                aria-label="Origen" name="origen">
                                <option selected disabled hidden>Origen</option>
                                @foreach ($origenes as $origen)
                                <option value="{{$origen->id}}">{{$origen->destino}}</option>
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
                    <div class="d-flex mt-3 mt-sm-0 w-100 flex-wrap-r320">
                        <div class="mr-3 w-100-sm">
                            <input type="date" class="form-control bg-lets-light" placeholder="Fecha de Ida"
                                name="dia_salida">
                        </div>
                        <div class="w-100-sm w-50" style="display:none;" id="input-hidden">
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
    <section class="d-flex p-4 w-95 mb-5 mx-auto align-content-center mb-0-r320">
        <div class="w-25">
            <img src="{{asset('img/CATEDRAL-MORELIA-BLUE_NGO.png')}}" alt="" class="img-home-catedral">
            <img src="{{asset('/img/ANGEL-BLUE.png')}}" alt="" class="img-home-columna d-md-none d-sm-block">
        </div>
        <div class="align-self-center d-flex flex-column flex-xl-row align-items-center letter-responsive mx-auto">
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
        <div class="w-10 d-none d-sm-none d-md-block">
            <img src="{{asset('/img/ANGEL-BLUE.png')}}" alt="" class="img-home-columna">
        </div>
    </section>

    <section class="background-lets text-white mt-5 p-5 descripcion d-flex justify-content-center text-justify mt-0-r320">
        <div class="w-75-md">
            <div class="d-flex align-items-center shadow-me">
                <img src="{{asset('/img/24HRS.png')}}" alt="" class="image-caracteristicas image-caracteristicas-1">
                <p class="mb-0 ml-3">
                    Reserva las 24 horas, desde la comodidad de tu casa u oficina, solo entra a nuestro sitio, busca tu salida y
                    fecha, ELIJE TU ASIENTO y tu forma de pago. Tan fácil como eso y ya tienes tu e-ticket para abordar tu Van.
                </p>
            </div>
            <div class="d-flex align-items-center mt-5 shadow-me">
                <img src="{{asset('/img/PAGOS.png')}}" alt="" class="image-caracteristicas image-caracteristicas-2">
                <p class="mb-0 ml-3">
                    Tu pago lo puedes hacer con tarjeta de crédito o débito, Transferencia o depósito. Todas las opciones, 100%
                    digital y sin papel.
                </p>
            </div>
            <div class="d-flex align-items-center mt-5 shadow-me">
                <img src="{{asset('/img/UBICACION.png')}}" alt="" class="image-caracteristicas image-caracteristicas-3">
                <p class="mb-0 ml-3">
                    Viaja de punto a punto sin la necesidad de estar en las terminales. Más rápido y con ubicaciones muy
                    céntricas.
                </p>
            </div>
            <div class="d-flex align-items-center mt-5 shadow-me">
                <img src="{{asset('/img/CINE.png')}}" alt="" class="image-caracteristicas image-caracteristicas-4">
                <p class="mb-0 ml-3">
                    Disfruta del mejor entretenimiento en tus viajes, contamos con las últimas películas de estreno.
                </p>
            </div>
        </div>
    </section>

    <section class="p-4 w-95 mt-5 mx-auto d-flex flex-md-row flex-column caracteristicas text-justify mt-0-r320">
        <div class="d-flex flex-column mr-md-4">
            <div class="mb-3 text-center-r320">
                <img src="{{asset('/img/logo/LOGO-FONDO-NEGRO-LV-2.jpg')}}" alt="Logo Lets Van" class="img-logo">
            </div>
            <div class="mb-md-5 text-center-r320">
                <h2 class="color--lets shadow-text">Empresa 100% Mexicana</h2>
                <h3 class="color--lets shadow-text">Agencia de Viajes Online</h3>
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

            <div class="d-flex justify-content-center my-md-auto my-4 m-0-r320">
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

    <section class="mt-5 p-5 background-lets text-white text-justify mt-0-r320">
        <h2 class="text-center mb-3 color-black">Sobre nosotros</h2>
        <div class="d-flex flex-md-row flex-column justify-content-center description-as">
            <p class="mr-md-5">
                LET’S VAN es una empresa 100% mexicana, agencia de viajes online. Dentro del segmento turistico dedicado a
                organizar grupos de personas que desean viajar de Morelia a la CDMX y viceversa, en donde buscamos que cada
                viaje sea fácil, accesible, comodo y seguro. Haciendo uso de las tecnologías para coordinar al grupo de
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
