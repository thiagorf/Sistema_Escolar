@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/scores.css') }}">
@endsection
@section('title', 'Editar Nota')
@section('content')

    <div class="container">   
        @include('layouts.navbar')
        <div class="box">

            <h3>Nota do {{$score->file->user->name}}</h3>

            <form action="{{ action('Content@scoreUpdate') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$score->id}}">
                <label for="evaluation">Tipo de Avaliação</label>
                <input type="text" name="evaluation" id="evaluation" value="{{ $score->evaluation }}">
                <label for="score">Nota</label>
                <input type="number" name="score" id="score" value="{{ $score->score }}">
                <input type="submit" value="Gerar Nota">
            </form>
            
        </div>
        
        @include('layouts.footer')
    </div>
@endsection
