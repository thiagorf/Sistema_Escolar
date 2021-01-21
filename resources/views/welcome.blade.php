@extends('layouts.main')

@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/welcome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/form.css') }}">
 
@endsection

@section('content')
<div class="container">
    <div class="box">
        <form  action="{{action('Authenticate@show')}}" method="post">
            @csrf
            <h3>Faça login para poder continuar</h3>
            <div class="efe">
                <label class="animation " for="email">Email</label>
                <input class="inp" type="email" name="email" id="email" placeholder=" ">
                
            </div>
            <div class="efe">
                <label class="animation" for="password">Senha</label>
                <input class="inp" type="password" name="password" id="password" placeholder=" ">
                
            </div>
            <div class="remenber">
                <input  type="checkbox" id="remenber" name="remenber" value="remenber">
                <label for="remenber"><span class="checkbox">Manter conectado</span></label> 
            </div>
            <div class="check"><button type="submit"><span class="text">Entrar</span></button></div>
        </form>
        
        <div class="cta-container">
            <span class="cta">Não possui uma conta?</span>
            <span class="cta"><a class="register" href="{{action('Authenticate@register_form')}}">Cadastre-se</a></span>
        </div>    
    </div>
    
    
    @include('layouts.footer')
    
</div>

@endsection

