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
        </div>   
                <li class="form-row">
                    <button type="submit" value="Submit">CRIAR ENQUETE</button>
                </li>
            </ul>
    </form>
    <div>
        <ul class="wrapper">
            <li class="form-row">
                <button class="form-row" onclick="add()">Criar Resposta</button>
            </li>
            <li class="form-row">
                 <button class="form-row" onclick="remover()">Remover Resposta</button>
            </li>
        </ul>
    </div>
</div>


@endsection
