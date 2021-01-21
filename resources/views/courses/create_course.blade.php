@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/formEdit.css') }}">
    
@endsection
@section('title', 'Criando Curso')
    
@section('content')

<div class="container">
    @include('layouts.navbar')
     <div class="box">
        <form action="{{action('Course@create')}}" method="post">
            @csrf
            <h3>Criando curso</h3>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="error">{{ $error }}</div>
                @endforeach   
            @endif
            
            <div class="field">
                <label class="" for="name">Nome do Curso</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}">
            </div>

             <div class="field">
                <label  for="description">Descrição do Curso</label>
                <textarea class="tt" name="description" id="description" cols="30" rows="10" >
                    {{ old('description') }}
                </textarea>
            </div> 

            <div class="field">   
                <label for="student_number">Nº de alunos</label>
                <input id="student_number" type="number" name="student_number" value="{{ old('numero') }}">
            </div>

            <div class="field-select">
                <label for="types">Formas de avaliação:</label>
                <select name="types" id="types">
                    @foreach ($types as $type)
                        <option value="{{$type->id}}">{{$type->type_evaluation}}</option>
                    @endforeach
                </select>
            </div>
            
            <input type="submit" value="Criar">   
        </form>
    </div>
    
</div>
@include('layouts.footer')
@endsection
