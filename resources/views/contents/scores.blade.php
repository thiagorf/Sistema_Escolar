@extends('layouts.main')
@section('assets')
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/score.css') }}">
@endsection
@section('title', 'Notas')
@section('content')

<div class="container">  
    @include('layouts.navbar')
    @if ($user->courses->isEmpty())
        <p>Não ha notas disponiveis</p>
    @else 
        <div class="score-card">
            @foreach ($user->courses as $course)
                <div class="s">
                    <h3>{{$course->name}}</h3>
                    <i class="fas fa-angle-down fa-sm xd"></i>
                    <table class="sc-n">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Avaliacao 1</th>
                                <th>Nota 1</th>
                                <th>Avaliacao 2</th>
                                <th>Nota 2</th>
                            </tr>
                        </thead>
                    @foreach ($course->users->sortBy('name') as $name)
                        @if (auth()->user()->roles->first()->role == 'Aluno')
                            @if ($name->id == auth()->user()->id)
                            <tr>
                                <td><span>{{ $name->name}}</span></td>
                                @foreach ($name->scores as $nScore) 
                                    @foreach ($course->scores as $cScore)
                                        @if ($nScore->id == $cScore->id) 
                                            <td><span>{{$nScore->evaluation}}</span></td>
                                            <td><span>{{$nScore->score}}</span></td>
                                        @endif
                                    @endforeach 
                                @endforeach
                            </tr>
                            @endif 
                        @else   
                            @if ($loop->first)
                                @continue
                            @endif
                                <tr>
                                    <td>{{ $name->name}}</td>
                            @foreach ($name->scores as $nScore) 
                                @foreach ($course->scores as $cScore)
                                    @if ($nScore->id == $cScore->id)
                                        <td><a href="{{ action('Content@scoreEdit', ['id' => $nScore->id]) }}">{{$nScore->evaluation}}</a></td>
                                        <td><a href="{{ action('Content@scoreEdit', ['id' => $nScore->id]) }}">{{$nScore->score}}</a></td>}
                                    @endif
                                @endforeach 
                            @endforeach
                                </tr>
                        @endif
                    @endforeach
    </table>        
        </div>
            @endforeach
        </div>
        @endif     
        @include('layouts.footer')
</div>
    <script>
        const sh = document.querySelectorAll('.s');
        const tbl = document.querySelectorAll('.sc-n');
        for (let i = 0; i < sh.length; i++) {
            sh[i].addEventListener('click', () => {
                tbl[i].classList.toggle('n');
            })
            
        }
    </script>
@endsection