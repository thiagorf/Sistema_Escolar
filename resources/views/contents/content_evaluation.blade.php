@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/scores.css') }}">
@endsection
@section('title', 'Avaliar Aluno')
@section('content')

    <div class="container">
        @include('layouts.navbar')
        <div class="box">
            <h3>Aluno {{ $student->name }}</h3>
            <h4>Materiais Enviados</h4>
            <ul>
                @foreach ($student->files as $file)
                    @if ($file->id == $files->id)
                        <li><a href="{{ action('Content@pdfShow', ['id' => $file->id]) }}" target='_blank'>{{ $file->fileName }} </a></li>
                    @endif
                @endforeach
            </ul>
        
            <form action="{{ action('Content@evaluate') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $files->id }}">
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <input type="hidden" name="course_id" value="{{ $files->contents->first()->course_id  }}">
                <label for="evaluation">Tipo de Avaliação</label>
                <input type="text" name="evaluation" id="evaluation">
                <label for="score">Nota</label>
                <input type="number" name="score" id="score">
                <input type="submit" value="Gerar Nota">
            </form>
            
        </div>
        @include('layouts.footer')
    </div>
@endsection
