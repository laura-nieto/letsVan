@extends('layouts.home')
@section('title',"Buscar Pagos - Let's Van")
@section('main')
<div class="container">


    <article class="home--title">
        <h2 class="text-center">Ver Pagos</h2>
    </article>
    <section class="m-auto shadow-sm p-3 bg-white rounded">
       
        <form action="{{route('pagos.coincidencias')}}" method="get">
            <article class="mb-4">
                <div class="d-flex justify-content-center">
                    <div class="w-25 mr-3">
                        <label for="">Desde</label>
                        <input type="date" class="form-control" placeholder="Desde" name="desde">
                        @error('desde')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="w-25">
                        <label for="">Hasta</label>
                        <input type="date" class="form-control" placeholder="Hasta" name="hasta">
                        @error('hasta')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </article>
            <article class="d-flex justify-content-center">
                <button type="submit" class="btn btn-lets">Buscar</button>
            </article>
        </form>
    </section>
    </div>
@endsection