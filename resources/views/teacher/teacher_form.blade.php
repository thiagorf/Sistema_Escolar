@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/formEdit.css') }}">
@endsection
@section('title', 'Cadastrar Professor')
@section('content')
    <div class="container">
        @include('layouts.navbar')
        <div class="box">
            <form action="{{ action('Teacher@register') }}" method="post">
                @csrf

                <h3>Cadastrando Professor</h3>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="error">{{ $error }}</div>
                    @endforeach   
                @endif

                <div class="field">
                    <label for="name">Nome do Professor: </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>

                <div class="field">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}">
                </div>

                <div class="field">
                    <label for="password">Senha provisoria:</label>
                    <input type="password" name="password" id="password">
                </div>

                <input type="submit" value="Cadastrar">

            </form>
        </div>
        @include('layouts.footer')
    </div>
@endsection

