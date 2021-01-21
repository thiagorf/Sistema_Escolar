<div class="menu">
    @auth
    <div class="side-bar">
        <i class="fas fa-bars fa-lg t" id="side"></i>
        <div class="side-items" id="sItems">
            <span class="t"><i class="fas fa-times fa-lg"></i></span>
            <a href="{{ route('content') }}">Todos os Cursos</a>
            @if (!(auth()->user()->roles->first()->role == 'Aluno'))
                <a href="{{ route('scores') }}">Todas as Notas</a>
                <a href="{{ action('Course@show') }}" >Criar Curso</a>
                @if (auth()->user()->roles->first()->role == 'Admin')
                    <a  href="{{ route('teacher') }}">Adicionar Professor</a> 
                @endif
            @else  
                <a href="{{ route('scores') }}">Suas Notas</a>
            @endif
        </div>
    </div>
        <button class="show" id="show">{{auth()->user()->name}}<i class="fas fa-angle-down fa-xs aa"></i></button>  
        <div hidden class="dropdown" id="dropdown" >
            <a href="{{ action('Authenticate@logout') }}">Sair</a>
            <a href="{{ route('confg') }}">Configuração</a>
        </div> 
    @endauth
</div>
