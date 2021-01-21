@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/formEdit.css') }}">
@endsection
@section('title', 'Criando Material')
@section('content')
    <div class="container">
        @include('layouts.navbar')
        <div class="box">
            <form action="{{action('Content@create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <h3>Criando Material</h3>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="error">{{ $error }}</div>
                    @endforeach   
                @endif

                <div class="field">
                    <label for="title">Titulo:</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}">
                 </div>
                
                <div class="field">
                    <label for="body">Conteudo: </label>
                    <textarea class="tt" name="body" id="body" cols="30" rows="10">
                        {{ old('body') }}
                    </textarea>
                </div>

                <div class="field">
                    <label for="file">Selecione um material<i class="fas fa-angle-down fa-xs ab"></i></label>
                    <input type="file" name="file" id="file">
                </div>   

                <input type="hidden" name="id" value={{$course->id}}>
                <input type="submit" value="Enviar">
            </form>
        </div>
        @include('layouts.footer')
    </div>
@endsection
