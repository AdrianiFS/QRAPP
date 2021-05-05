@extends('layouts.app')
@section('welcomeContent')
<div id="app" class="container welcomeBg welcomeContainer">
    <div class="welcomeContainer--left">
        <img src="{{ URL::asset('images/qrhand-copy.png') }}" alt="Qr code solutions">
    </div>
    <div class="welcomeContainer--right">
        <h1 class="welcomeTitle">Welcome to Qr PRO Solutions</h1>
        <p class="welcomePar">You can create a qr code from a refencence stored on our database to be redirectioned to any url which you can overwrite as much as you want.</p>
        <div class="welcomeButtonContainer">
            <a class="qrBtn welcomeButton" href="{{ url('/qrpages/qrform') }}">Start now!</a>
        </div>
    </div>
</div>
@endsection