@extends('layouts.app')
@section('content')
<div id="wrapper">
    <div id="page" class="container">
        <div id="content">
            <div class="title">
                <h2>{{ $qrgenerator->generatedUrl }}</h2>
            </div>
            {{ $qrgenerator->redirectionUrl }}
            <p>

            </p>
        </div>
    </div>
</div>
</div>
@endsection')