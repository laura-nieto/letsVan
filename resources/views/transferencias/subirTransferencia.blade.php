@extends('layouts.home')
@section('title',"Subir Transferencia - Let's Van")
@section('main')
        <article class="home--title">
            <h2 class="text-center">
                Subir transferencia
            </h2>
        </article>
        <article class="container">
            @error('transferencia')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
            <section class="card p-5">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlFile1" class="fsize-1">Seleccione la imágen de la transferencia. La extensión debe ser jpeg, png o jpg</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="transferencia">
                    </div>
                    <button type="submit" class="btn btn-lets mt-5">Subir</button>
                </form>
            </section>
        </article>
@endsection