@extends('layouts.home')
@section('title',"Información - Let's Van")
@section('main')
    <article class="home--title">
        <h1 class="text-center">
            Subir transferencia
        </h1>
    </article>
    <article class="container">
        @error('transferencia')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
        <section class="card p-5">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlFile1">Seleccione la imágen de la transferencia</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="transferencia">
                </div>
                <button type="submit" class="btn btn-lets mt-5">Subir</button>
            </form>
        </section>
    </article>
@endsection
