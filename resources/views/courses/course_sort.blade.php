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
                @if (!(auth()->user()->roles->first()->role == 'Aluno'))
                    <i class="fas fa-ellipsis-h"></i>
                    <div class="crud">
                        @can('editar-curso')
                        <a href="{{action('Course@edit_form', ['id' => $course->id])}}">Editar</a>
                        @endcan
                        @can('excluir-curso')
                        <a href="{{action('Course@delete', ['id' => $course->id])}}">Excluir</a>
                        @endcan  
                    </div>
                @endif
                <p>{{$course->description}}</p>
            </div>

            <div class="resources">
                <a href="{{action('Course@showContent', ['id' => $course->id])}}">Ver mais</a>
                @if (!$course->users->firstWhere('id', auth()->user()->id))
                    <a href="{{action('Course@enter', ['id' => $course->id])}}">Entrar no curso</a>
                @endif
            </div>
        </div>
@endforeach