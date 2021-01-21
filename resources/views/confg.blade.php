@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">    
    <link rel="stylesheet" type="text/css" href="{{ url('css/formEdit.css') }}">    
@endsection
@section('title', 'Configurações')
@section('content')
    <div class="container">
        @include('layouts.navbar')
        <div class="box">
            <form action="{{ action('Authenticate@edit') }}" method="post">
                @csrf
                <div class="field">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" value="{{ auth()->user()->name }}">
                </div>
                
                <div class="field">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="{{ auth()->user()->email }}">
                </div>
               
                <div class="field">
                    <label for="password">Nova Senha</label>
                    <input type="password" name="password" id="password" >
                </div>
                
                <input type="submit" value="Alterar">
            </form>
        </div>
        @include('layouts.footer')
    </div>
@endsection