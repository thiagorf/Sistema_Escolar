@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/content.css') }}">
@endsection
@section('title', 'Cursos')


@section('content')

<div class="container">
    @include('layouts.navbar')
    <div class="sort">
        <span id="sort-value">filtrar </span><i class="fas fa-angle-down fa-xs ab"></i>
        <div hidden  class="sort-item-f">
            <a class="a" href="{{ route('content') }}/?sort=desc" id="an">Recentes</a>
            <a class="a" href="{{ route('content') }}/?sort=asc">Mais antigo</a>
        </div>
    </div>

    <div class="content" id="content">
        @if ($courses->count() == 0)
            <p>Não existe nenhum curso disponivel</p>
        @else
            @foreach ($courses as $course)
            <div class="card">
                <div class="header">
                    <h3>{{$course->name}}</h3>
                    <div class="spec">
                       <span>Profº {{$course->users->pluck('name')->first()}}</span>
                       <span>{{$course->evaluation->type_evaluation}}</span>
                    </div>
                    <span>Vagas preenchidas:
                    @if ($course->users->count() == 0 )
                    {{$course->users->count()}} /{{$course->student_number}}
                    @else
                    {{ $course->users->count() -1}}/{{$course->student_number}}
                    @endif
                    </span>
                </div>
                <div class="detail">
                    @if (($course->users->firstWhere('id', auth()->user()->id)) || !(auth()->user()->roles->first()->role == 'Aluno'))
                        <i class="fas fa-ellipsis-h"></i>
                        <div class="crud">
                            @can('editar-curso')
                            <a href="{{action('Course@edit_form', ['id' => $course->id])}}">Editar</a>
                            @endcan
                            @can('excluir-curso')
                            <a href="{{action('Course@delete', ['id' => $course->id])}}">Excluir</a>
                            @endcan
                            @if (auth()->user()->roles->first()->role == 'Aluno' && $course->users->firstWhere('id', auth()->user()->id))
                                <a href="{{action('Course@leaveCourse', ['id' => $course->id])}}">Sair do curso</a>
                            @endif
                        </div>
                    @endif
                        <p>{{$course->description}}</p>
                </div>
                <div class="resources">
                    @if (!$course->users->firstWhere('id', auth()->user()->id))
                        <a href="{{action('Course@enter', ['id' => $course->id])}}">Entrar no curso</a>
                    @else
                        <a href="{{action('Course@showContent', ['id' => $course->id])}}">Ver mais</a>      
                    @endif
                </div>
            </div>
            @endforeach
        @endif
    </div>
    @include('layouts.footer')
</div>

<script>
    const dot = document.querySelectorAll('.fa-ellipsis-h');
    const cru = document.querySelectorAll('.crud-s');
    for (let i = 0; i < dot.length; i++) {
        dot[i].addEventListener('click', (e) => {
            console.log(e.target.nextElementSibling)
             e.target.nextElementSibling.classList.toggle('crud-s')
            
        })
    }
  
    const links = document.querySelectorAll('.a');
    for(let i = 0; i < links.length; i++){
        links[i].addEventListener('click', clicks);
    }

    async function clicks(e) {
        e.preventDefault();
        
        const url = e.target.href;
        const response = await fetch(url);
        const data = await response.text();
        const load = document.querySelector('#content');
        load.innerHTML = "";
        load.innerHTML = data;

    }

    const sort = document.querySelector('.sort');
    const sv = document.querySelector('.sort-item-f');
    sort.addEventListener('click', (e) => {
        e.stopPropagation();
        sv.removeAttribute('hidden')
        sv.style.display = "flex"
    })
</script>
@endsection
 