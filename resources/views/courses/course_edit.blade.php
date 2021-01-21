@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/formEdit.css') }}">
@endsection
@section('title', 'Editar Curso')
@section('content')
    <div class="container">
        @include('layouts.navbar')
        <div class="box">
            <form action="{{action('Course@edit')}}" method="POST">
                @csrf
                <h3>Editando Curso</h3>
                
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="error">{{ $error }}</div>
                    @endforeach   
                 @endif

                <div class="field">
                    <label for="name">Nome do Curso</label>
                    <input type="text" name="name" value="{{$courses->name}}" id="name">
                </div>

                <div class="field">
                    <label for="student_number">Nº Alunos</label>
                    <input type="student_number" name="student_number" value="{{$courses->student_number}}" id="numero">
                </div>

                <div class="field">
                    <label for="description">Descrição do Curso</label>
                    <textarea class="tt" name="description" id="description" cols="30" rows="10">
                        {{ $courses->description }}
                    </textarea>
                </div>
                
                <input type="hidden" name="id" value="{{$courses->id}}">
                <div class="field-select">
                    <label for="types">Formas de Avaliação</label>
                    <select name="types">
                        @foreach ($evaluations as $evaluation)
                            <option value="{{$evaluation->id}}" {{($courses->evaluation_id == $evaluation->id)? 'selected' : ''}}>
                                {{$evaluation->type_evaluation}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <input type="submit" value="Atualizar">
            </form>
        </div>
        @include('layouts.footer')
    </div>
@endsection

