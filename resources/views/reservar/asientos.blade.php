@extends('layouts.home')
@section('title',"Ver Pasajeros - Let's Van")
@section('main')
    <article class="home--title">
        <h1 class="text-center">
            Reservar Asientos
        </h1>
    </article>
    @if (session('error'))
        <div class="alert alert-danger px-5" role="alert">
            {{session('error')}}
        </div>
    @endif
    <article class="w-75 m-auto reservar--asientos">
        @if ($corrida->unidad->asientos == 13)
            <section class="d-flex justify-content-center">
                <figure class="figure">
                    <img src="{{asset('img/viaje-13.PNG')}}" alt="Vista de los asientos" class="figure-img img-fluid rounded width-500">
                    <figcaption class="figure-caption">Imágen estipulativa.</figcaption>
                </figure>
            </section>
            <section class="d-flex justify-content-center asientos-reserva-13">
                <form action="" method="post">
                    @csrf
                    <input type="hidden" id="limit" value="{{$cantidad}}">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="size-input-check"  name="asiento[]" value="1" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}>
                                </td>
                                <td></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="4" {{$corrida->asientos->where('asiento',4)->isNotEmpty() ? 'disabled':''}}></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="7" {{$corrida->asientos->where('asiento',7)->isNotEmpty() ? 'disabled':''}}></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="10" {{$corrida->asientos->where('asiento',10)->isNotEmpty() ? 'disabled':''}}></td>   
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="11" {{$corrida->asientos->where('asiento',11)->isNotEmpty() ? 'disabled':''}}></td>    
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="2" {{$corrida->asientos->where('asiento',2)->isNotEmpty() ? 'disabled':''}}></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="5" {{$corrida->asientos->where('asiento',5)->isNotEmpty() ? 'disabled':''}}></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="8" {{$corrida->asientos->where('asiento',8)->isNotEmpty() ? 'disabled':''}}></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="12" {{$corrida->asientos->where('asiento',12)->isNotEmpty() ? 'disabled':''}}></td>   
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="3" {{$corrida->asientos->where('asiento',3)->isNotEmpty() ? 'disabled':''}}></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="6" {{$corrida->asientos->where('asiento',6)->isNotEmpty() ? 'disabled':''}}></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="9" {{$corrida->asientos->where('asiento',9)->isNotEmpty() ? 'disabled':''}}></td>
                                <td><input type="checkbox" class="size-input-check" name="asiento[]" value="13" {{$corrida->asientos->where('asiento',13)->isNotEmpty() ? 'disabled':''}}></td>   
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mb-2">Seleccionar</button>
                </form>
            </section>
            
        @endif
        @if ($corrida->unidad->asientos == 20)
        <section class="d-flex justify-content-center">
            <figure class="figure">
                <img src="{{asset('img/viaje-20.PNG')}}" alt="Vista de los asientos" class="figure-img img-fluid rounded width-500">
                <figcaption class="figure-caption">Imágen estipulativa.</figcaption>
            </figure>
        </section>
        <section class="d-flex justify-content-center asientos-reserva-13">
            <form action="" method="post">
                @csrf
                <input type="hidden" id="limit" value="{{$cantidad}}">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" class="size-input-check"  name="asiento[]" value="1" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}>
                            </td>
                            <td></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="5" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="8" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="11" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="14" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="17" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="2" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="18" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="3" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="6" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="9" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="12" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="15" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="19" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="4" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="7" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="10" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="13" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="16" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                            <td><input type="checkbox" class="size-input-check"  name="asiento[]" value="20" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}}></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mb-2">Seleccionar</button>
            </form>
        </section>
        @endif
    </article>
@endsection
@section('js')
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <script src="{{asset('js/aqui.js')}}"></script>
@endsection