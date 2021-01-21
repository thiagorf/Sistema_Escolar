@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/formEdit.css') }}">
@endsection
@section('title', 'Editando')
@section('content')

    <div class="container">
        @include('layouts.navbar')
        <div class="box">
            <form action="{{ action('Content@edit') }}" method='post' enctype="multipart/form-data">
                @csrf
                <h3>Editando Conteudo</h3>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="error">{{ $error }}</div>
                    @endforeach   
                @endif

                <div class="field">
                    <label for="title">Titulo</label>
                    <input type="text" name="title" value="{{$content->title}}" id="title">
                </div>

                <div class="field">
                    <label for="body">Corpo</label>
                    <textarea class="tt" name="body" id="body" cols="30" rows="10">
                        {{ $content->body }}
                    </textarea>
                </div>
                <input type="hidden" name="id" value="{{$content->id}}">
                
                <div class="field">
                    <div class="file-select">
                        <label for="file">
                            {{ !($content->files->count() == 0) ? $content->files->first()->fileName  : "Escolha seu Arquivo"}}
                        </label><i class="fas fa-times fa-sm c"></i>
                        <input type="file" name="file" id="file">
                    </div>
                </div>
               
                <input type="submit" value="Atualiar">
            </form>
        </div>
        @include('layouts.footer')
    </div>
    <script>
        const inp = document.querySelector('input[type=file]');
        const label = document.querySelector('label[for=file]');
        const c = document.querySelector('.c');

        inp.addEventListener('change', () => {
            const str = inp.value.replace('C:\\fakepath\\', " ");
            label.innerHTML = str ? str : "Escolha seu Arquivo";
        });
        const event = new Event('change');
        
        c.addEventListener('click', () => {
            inp.value = "";
            inp.dispatchEvent(event)
        });
    </script>
@endsection
