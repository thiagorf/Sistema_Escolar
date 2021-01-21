@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/contentActivities.css') }}">
    
@endsection
@section('title', 'Atividades')
@section('content')
    <div class="container">
        
        @include('layouts.navbar')
        @can('editar-curso')
            <div class="crt">
                <a href="{{action('Content@show', ['id' => $course->id])}}">Criar conteudo</a>
                <a href="{{url()->previous()}}">Voltar</a> 
            </div>
        @endcan
        @if ($course->contents->count() == 0)
            <p>Não existe nenhum conteudo postado no momento</p>
        @else
        <div class="wrapper">
            @foreach ($course->contents as $content)
            
                <div class="card">
                    @if (!(auth()->user()->roles->first()->role == 'Aluno'))
                        
                   
                    <span><i class="fas fa-ellipsis-h"></i></span>

                    <div class="crud">
                        <a href="{{action('Content@formEdit', ['id' => $content->id])}}">Editar</a>
                        <a href="{{action('Content@delete', ['id' => $content->id])}}">Excluir</a>
                    </div>
                    @endif

                    <div class="header">
                        <h3>{{$content->title}}</h3>
                        <p>{{$content->body}}</p>
                    </div>

                    <div class="resources">
                        <a href="{{action('Content@specificContent', ['id' => $content->id])}}">Ver atividade</a> 
                    </div>
                </div>   
             
            @endforeach
        </div> 
        @endif
        @include('layouts.footer')
                
    </div>
    <script>
        const ponto = document.querySelectorAll('.fa-ellipsis-h');  
        const tbl = document.querySelectorAll('.crud');
        
            for (let i = 0; i < ponto.length; i++) {   
                ponto[i].addEventListener('click', () => {
                    tbl[i].classList.toggle('crud-s');
                })    
            }

        const event = new Event('click');   
        document.body.onclick = function (e) {
            for (let i = 0; i < ponto.length; i++) {
                if (e.target !== ponto[i] && tbl[i].classList.contains('crud-s')) {
                    tbl[i].classList.toggle('crud-s');
                }
            }   
        }    
    </script>
@endsection

