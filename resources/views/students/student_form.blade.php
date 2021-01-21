@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/form.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="box">
        <form action="{{action('Authenticate@register')}}" method="post">
            @csrf
            <h3>Cadastrar</h3>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="error">{{ $error }}</div>
                @endforeach   
            @endif
            <div class="efe">
                <label class="animation" for="name">Nome</label>
                <input class="inp" type="text" name="name" id="name" placeholder=" "> 
            </div>
            <div class="efe">
                <label class="animation" for="email">Email</label>
                <input class="inp" type="email" name="email" id="email" placeholder=" ">
            </div>
            <div class="efe">
                <label class="animation" for="password">Senha</label>
                <input class="inp" type="password" name="password" id="password" placeholder=" ">
            </div>
            <div class="check"><button type="submit"><span class="text">Cadastrar</span></button></div>
        </form>
    </div>
    @include('layouts.footer')
</div>
@endsection

