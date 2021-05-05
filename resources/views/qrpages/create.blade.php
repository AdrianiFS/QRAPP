@extends('layouts.app')
@section('createContent')
<div class="container">
    <div class="qrContainer">
        <div id="qrcode"></div>
        <h1>QR generator</h1>
        <img class="qrImg" src="/images/blank-qr-code.jpg" alt="qr blank img" />
        <form method="POST" action="/qrpages">
            @csrf
            <input type="text" value="" class="qrInput @error('generatedUrl') is-danger @enderror" placeholder="generatedUrl" name="generatedUrl" id="generatedUrl" />
            @error('generatedUrl')
            <span class="alert is-danger" role="alert">
                <strong>{{ $errors->first('generatedUrl') }}</strong>
            </span>
            @enderror
            <input type="text" value="" class="qrInput @error('redirectionUrl') is-danger @enderror" placeholder="redirectionUrl" name="redirectionUrl" id="redirectionUrl" />
            @error('redirectionUrl')
            <span class="alert is-danger" role="alert">
                <strong>{{ $errors->first('redirectionUrl') }}</strong>
            </span>
            @enderror
            <input class="qrBtn" type="submit">
            <p style="color: red" class="msg"></p>
        </form>
    </div>
</div>
@endsection