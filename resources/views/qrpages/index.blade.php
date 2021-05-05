@extends('layouts.app')
@section('indexContent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card prof">
                @foreach($qrgenerator as $gen)
                <p>{{$gen->generatedUrl}}</p>
                <p>{{$gen->redirectionUrl}}</p>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection