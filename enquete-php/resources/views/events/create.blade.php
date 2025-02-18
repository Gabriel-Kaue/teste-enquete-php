@extends ('layouts.main')
@section('title',"Criar Enquete")
@section('content')

<div id="evemt-container">
    <h1>Crie sua enquete</h1>
    <form action="/events" method="post">
        <div id="formfield">
            <ul class="wrapper">
                <li class="form-row">
                    <input type="text" name="titulo" placeholder="Titulo" required>
                </li>
                <li class="form-row">
                    <input type="datetime-local" name="dtInicio" placeholder="Data de Inicio" required>
                </li>
                <li class="form-row">
                     <input type="datetime-local" name="dtFim" placeholder="Data de Fim" required>
                </li>
                <li class="form-row">
                    <input type="text" name="resposta" class="respostas" placeholder="resposta" required>
                </li>
                <li class="form-row">
                    <input type="text" name="resposta" class="respostas" placeholder="resposta" required>
                </li>
                <li class="form-row">
                    <input type="text" name="resposta" class="respostas" placeholder="resposta" required>
                </li>
            </ul>
        </div>
        <input type="submit" value="CRIAR ENQUETE">
    </form>
    <div>
        <button class="add" onclick="add()"><i class="mais"></i>Criar Resposta</button>
        <button class="remove" onclick="remover()"><i class="menos"></i>Remover Resposta</button>
    </div>
</div>


@endsection
