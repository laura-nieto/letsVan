@extends('layouts.home')
@section('title',"Ver Transferencia - Let's Van")
@section('main')
    <div class="container">
        <section class="d-flex flex-column align-items-center mt-5">
            <div class="images">
                <img src="{{asset('img/transferencias/'.$payment->imagen)}}" alt="Imágen de transferencia" width="800" height="500">
            </div>
                
            <div id="image-viewer">
                <span class="close">&times;</span>
                <img class="modal-content" id="full-image">
            </div>

            <div class="card mt-3" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$payment->payment->comprador->apellido . " " . $payment->payment->comprador->nombre}}</li>
                    <li class="list-group-item">{{$payment->payment->comprador->email}}</li>
                </ul>
            </div>
            <form action="" method="post">
                @csrf
                <input type="submit" name="submitButton" value="Aprobar" class="btn btn-primary mt-5">
                <input type="submit" name="submitButton" value="No aprobar" class="btn btn-danger mt-5">
            </form>
        </section>
    </div>
@endsection
@section('js')
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <script>
        $(".images img").click(function(){
            $("#full-image").attr("src", $(this).attr("src"));
            $('#image-viewer').show();
        });

        $("#image-viewer .close").click(function(){
            $('#image-viewer').hide();
        });
    </script>
@endsection