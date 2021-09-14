@extends('layouts.home')
@section('title',"Elegir Asiento - Let's Van")
@section('main')
    <article class="home--title">
        <h2 class="text-center">
            Reservar Asientos
        </h2>
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
                <form action="" method="post" class="d-flex flex-column">
                    @csrf
                    <input type="hidden" id="limit" value="{{$cantidad}}">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="1" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}} id="1">
                                    <label for="1" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>
                                <td></td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="4" {{$corrida->asientos->where('asiento',4)->isNotEmpty() ? 'disabled':''}} id="4">
                                    <label for="4" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="7" {{$corrida->asientos->where('asiento',7)->isNotEmpty() ? 'disabled':''}} id="7">
                                    <label for="7" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>

                                </td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="10" {{$corrida->asientos->where('asiento',10)->isNotEmpty() ? 'disabled':''}} id="10">
                                    <label for="10" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>   
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="11" {{$corrida->asientos->where('asiento',11)->isNotEmpty() ? 'disabled':''}} id="11">
                                    <label for="11" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>    
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="2" {{$corrida->asientos->where('asiento',2)->isNotEmpty() ? 'disabled':''}} id="2">
                                    <label for="2" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="5" {{$corrida->asientos->where('asiento',5)->isNotEmpty() ? 'disabled':''}} id="5">
                                    <label for="5" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="8" {{$corrida->asientos->where('asiento',8)->isNotEmpty() ? 'disabled':''}} id="8">
                                    <label for="8" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="12" {{$corrida->asientos->where('asiento',12)->isNotEmpty() ? 'disabled':''}} id="12">
                                    <label for="12" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>   
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="3" {{$corrida->asientos->where('asiento',3)->isNotEmpty() ? 'disabled':''}} id="3">
                                    <label for="3" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="6" {{$corrida->asientos->where('asiento',6)->isNotEmpty() ? 'disabled':''}} id="6">
                                    <label for="6" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="9" {{$corrida->asientos->where('asiento',9)->isNotEmpty() ? 'disabled':''}} id="9">
                                    <label for="9" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>
                                <td>
                                    <input type="checkbox" class="size-input-check propio-check" name="asiento[]" value="13" {{$corrida->asientos->where('asiento',13)->isNotEmpty() ? 'disabled':''}} id="13">
                                    <label for="13" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                                </td>   
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary my-3 mx-auto">Seleccionar</button>
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
            <form action="" method="post" class="d-flex flex-column">
                @csrf
                <input type="hidden" id="limit" value="{{$cantidad}}">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="1" {{$corrida->asientos->where('asiento',1)->isNotEmpty() ? 'disabled':''}} id="1">
                                <label for="1" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td></td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="5" {{$corrida->asientos->where('asiento',5)->isNotEmpty() ? 'disabled':''}} id="5">
                                <label for="5" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="8" {{$corrida->asientos->where('asiento',8)->isNotEmpty() ? 'disabled':''}} id="8">
                                <label for="8" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="11" {{$corrida->asientos->where('asiento',11)->isNotEmpty() ? 'disabled':''}} id="11">
                                <label for="11" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="14" {{$corrida->asientos->where('asiento',14)->isNotEmpty() ? 'disabled':''}} id="14">
                                <label for="14" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="17" {{$corrida->asientos->where('asiento',17)->isNotEmpty() ? 'disabled':''}} id="17">
                                <label for="17" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="2" {{$corrida->asientos->where('asiento',2)->isNotEmpty() ? 'disabled':''}} id="2">
                                <label for="2" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="18" {{$corrida->asientos->where('asiento',18)->isNotEmpty() ? 'disabled':''}} id="18">
                                <label for="18" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="3" {{$corrida->asientos->where('asiento',3)->isNotEmpty() ? 'disabled':''}} id="3">
                                <label for="3" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="6" {{$corrida->asientos->where('asiento',6)->isNotEmpty() ? 'disabled':''}} id="6">
                                <label for="6" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="9" {{$corrida->asientos->where('asiento',9)->isNotEmpty() ? 'disabled':''}} id="9">
                                <label for="9" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="12" {{$corrida->asientos->where('asiento',12)->isNotEmpty() ? 'disabled':''}} id="12">
                                <label for="12" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="15" {{$corrida->asientos->where('asiento',15)->isNotEmpty() ? 'disabled':''}} id="15">
                                <label for="15" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="19" {{$corrida->asientos->where('asiento',19)->isNotEmpty() ? 'disabled':''}} id="19">
                                <label for="19" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="4" {{$corrida->asientos->where('asiento',4)->isNotEmpty() ? 'disabled':''}} id="4">
                                <label for="4" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="7" {{$corrida->asientos->where('asiento',7)->isNotEmpty() ? 'disabled':''}} id="7">
                                <label for="7" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="10" {{$corrida->asientos->where('asiento',10)->isNotEmpty() ? 'disabled':''}} id="10">
                                <label for="10" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="13" {{$corrida->asientos->where('asiento',13)->isNotEmpty() ? 'disabled':''}} id="13">
                                <label for="13" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="16" {{$corrida->asientos->where('asiento',16)->isNotEmpty() ? 'disabled':''}} id="16">
                                <label for="16" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                            <td>
                                <input type="checkbox" class="size-input-check propio-check"  name="asiento[]" value="20" {{$corrida->asientos->where('asiento',20)->isNotEmpty() ? 'disabled':''}} id="20">
                                <label for="20" class="label-propio-check"><img src="{{asset('/img/armchair.png')}}" alt=""></label>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mb-2  mx-auto">Seleccionar</button>
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