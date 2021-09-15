@extends('layouts.home')
@section('title',"Reservar Pasajeros - Let's Van")
@section('main')
    <article class="m-5">
        <h2 class="text-center">
            {{$ida->origen_tabla->destino . ' - ' . $vuelta->origen_tabla->destino}}
        </h2>
    </article>
    <div class="container">
        <form action="" method="post">
            @csrf
            <section class="card w-50 w-100-sm-responsive m-auto">
                <div class="card-header background-lets">
                    <h4>Comprador</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="comprador_nombre">
                        @error('comprador_nombre')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="comprador_apellido">
                        @error('comprador_apellido')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                        @error('email')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="number" class="form-control" name="telefono">
                        @error('telefono')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </section>
            <section class="card my-4">
                <div class="card-header background-lets">
                    <h4>Pasajeros Ida</h4>
                </div>
                <div class="card-body grid-c2">
                    @for($i = 0; $i < $cantidad_ida; $i++)
                        <div>
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="pasajero[ida][{{$i}}][nombre]" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="pasajero[ida][{{$i}}][apellido]" required>
                            </div>
                            @if(session()->has('niños'))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pasajero[ida][{{$i}}][type]" value="adulto" required>
                                    <label class="form-check-label">Adulto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pasajero[ida][{{$i}}][type]" value="niño">
                                    <label class="form-check-label">Niño</label>
                                </div>
                            @else
                                <input type="hidden" name="pasajero[ida][{{$i}}][type]" value="adulto">
                            @endif
                        </div>
                    @endfor
                </div>
            </section>
            <section class="card my-4">
                <div class="card-header background-lets">
                    <h4>Pasajeros Vuelta</h4>
                </div>
                <div class="card-body grid-c2">
                    @for($i = 0; $i < $cantidad_vuelta; $i++)
                        <div>
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="pasajero[vuelta][{{$i}}][nombre]" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="pasajero[vuelta][{{$i}}][apellido]" required>
                            </div>
                            @if(session()->has('niños'))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pasajero[vuelta][{{$i}}][type]" value="adulto" required>
                                    <label class="form-check-label">Adulto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pasajero[vuelta][{{$i}}][type]" value="niño">
                                    <label class="form-check-label">Niño</label>
                                </div>
                            @else
                                <input type="hidden" name="pasajero[vuelta][{{$i}}][type]" value="adulto">
                            @endif
                        </div>
                    @endfor
                </div>
                
            </section>
            {{-- <section class="card mb-4">
                <div class="card-body">
                    <div class="w-50 m-auto">
                        @if ($pasajes['niños'])
                            <h5 class="text-center">Niños: <strong>${{$corrida->precio->niño}}</strong></h5>
                        @endif
                        @if($pasajes['adultos'])
                            <h5 class="text-center">Adultos: <strong>${{$corrida->precio->adulto}}</strong></h5>
                        @endif
                        <h5 class="text-center">Total a pagar: ${{$total}}</h5>
                    </div>
                </div>
            </section> --}}
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mb-4">Siguiente</button>
            </div>
        </form>
    </div>
@endsection
