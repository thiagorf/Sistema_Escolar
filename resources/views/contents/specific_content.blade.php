@extends('layouts.main')
@section('assets')
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/ActivitiesDetails.css') }}">
<style>
    .conteudo {
        display: none;
    }

    .exibir {
        display: block;
    }
</style>
@endsection
@section('title', 'conteudo')

@section('content')
<div class="container">
    @include('layouts.navbar')
    <div class="card">

        <div class="header">
            <h3>{{$content->title}}</h3>
            <span>{{$content->body}}</span>
        </div>

        @if (!$content->files->isEmpty())
            <div class="activities">

                <div id="act-1">
                    <p>Material do professor <i class="fas fa-angle-down fa-xs aa"></i></p>
                    <a class="activities-n" href="{{ action('Content@pdfShow', ['id' => $content->files->first()->id]) }}" target="_blank">{{$content->files->first()->fileName}}</a> 
                </div>

                <div id="act-2">
                    @if (auth()->user()->roles->first()->role == "Aluno")
                        <p>Seu material<i class="fas fa-angle-down fa-xs aa"></i></p>
                        @if (!($content->files->contains('user_id', auth()->user()->id)))
                            <form class="activities-n frm" id="files" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="ids" value="{{$content->id}}">
                                <label for="file">Escolher arquivo</label>
                                <input type="file" id="file" name="file">
                                <input type="submit" value="Enviar">
                            </form>
                            @else
                                @foreach ($content->files as $t)
                                    @if (($t->user->id == auth()->user()->id))
                                        <span class="activities-n frm">{{ $t->user->name }} -- {{$t->fileName}}</span>                       
                                    @else
                                        @continue
                                    @endif
                                @endforeach
                        @endif          
                    @endif
            </div>
            
            </div>
            @if (auth()->user()->roles->first()->role == "Admin")
                <div class="aln">
                    <p>Material de aluno <i class="fas fa-angle-down fa-xs aa"></i></p>
                        <div class="aln-n">
                            @foreach ($content->files as $fl)
                            <p>
                                @if (!($fl->user->roles->first()->role == 'Aluno'))
                                    @continue
                                @endif
                                <span>{{$fl->user->name}}</span>
                                <a href="{{ action('Content@pdfShow', ['id' => $fl->id]) }}" target="_blank">{{$fl->fileName}}</a>
                                <a href="{{ action('Content@evaluate_form', ['id' => $fl->user->id, 'f_id' => $fl->id]) }}"><span>Avaliar</span></a>
                                
                            </p>
                            @endforeach  
                        </div>
                </div>
            @endif
        @endif
</div>    
     <div class="coments">
        <span>Comentarios</span>

        <form id="forms" method="post">
            @csrf
            <input type="text" name="comentario" id="comentario">
            <input type="hidden" name="id" value="{{$content->id}}" id="id">
            <button type="submit" >Enviar</button>
        </form>
        
        <hr>

        <div id="x">
            @foreach ($content->comments as $comment)
                <p>{{$comment->user->name}}: {{$comment->comment}}</p>
            @endforeach
        </div>

     </div>
    @include('layouts.footer')
    </div>
     <script>
        if (!(document.querySelector('.activities') == null )) {
            console.log(document.querySelector('.activities'))
            document.getElementById('act-1').addEventListener('click', (e) => {
                const nn = document.querySelector('a.activities-n')
                nn.classList.toggle('activities-s')
            });
            document.getElementById('act-2').addEventListener('click', () => {
                const fr = document.querySelector('.frm')
                fr.classList.toggle('activities-s')
            });
            if (!(document.querySelector('.aln') == null)) {
                document.querySelector('.aln').addEventListener('click', () =>{
                const aln_n = document.querySelector('.aln-n')
                aln_n.classList.toggle('aln-s');
            });
            }
        }
        document.getElementById('forms').addEventListener('submit', forms)
        if (!(document.getElementById('files') == null )) {
            document.getElementById('files').addEventListener('submit', formulario)
        }

        async function formulario(e)
        {
            e.preventDefault()
            try {
                const metaTag = document.querySelector('meta[name="csrf-token"]').content
                const newHeader = new Headers();
                newHeader.set('X-CSRF-Token', metaTag);
                const form = document.getElementById('files');
                const data =  new FormData(form);
                const response = await fetch("{{ action('Content@studentPDF') }}", {
                    method: 'POST',
                    body: data,
                    credentials: 'same-origin',
                    headers: newHeader
                })
                const resolve = await response.json();
            } catch(e) {
                console.log(e)
            }

        }
 
        async function forms(e) {
            e.preventDefault()
            try {    
                const forms = document.querySelector('#forms')
                const metaTag = document.querySelector('meta[name="csrf-token"]').content
                const newHeader = new Headers();
                newHeader.set('X-CSRF-Token', metaTag);
                const data = new FormData(forms)
                const url = "{{ action('Comment@write') }}"
                const response = await fetch(url, {
                    method: 'POST',
                    body: data,
                    credentials: 'same-origin',
                    headers: newHeader 
                })      
                const resolve = await response.text();
                forms.reset()
                document.getElementById('x').innerHTML = resolve;   

                } catch(e) {
                    console.log(e)
                }
             }
     </script>
@endsection

