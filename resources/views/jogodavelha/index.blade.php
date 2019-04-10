<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Jogo da Velha</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    </head>
    <body>
    <div class="nickname_container" id="nick">

        <span>Jogador:</span>
        <form id="submit"><input type="text" id="nickname" /></form>

    </div>

    <div id="topo" hidden>

        <div class="menu">
            <div class="name" id="name"></div>
            <div class="last" id="time"></div>
        </div>

        <!--ol class="chat">

        </ol>
        <div id='bottom'></div>
        <input class="textarea" type="text" placeholder="Type here!" id="textarea" /-->
    </div>
    <form>
        <div id="tabuleiro" hidden>
            <h1>Jogo da Velha</h1>

            @for($i=0;$i < 9; $i++)

                <input id="{{ $i }}" type="text" size="1" name="a{{ $i }}" onfocus="joga(this)">

            @endfor

            <div class="controle">
                <label>Nivel de Dificuldade:</label>
                <select name="difficulty" class="form-control" size="1" onchange="nivel=form.difficulty[form.difficulty.selectedIndex].value;">
                    <option value="1"> Fácil </option>
                    <option selected="" value="2"> Médio</option>
                    <option value="3"> Difícil </option>
                </select>
                <button type="button" class="btn" onclick="limpar_Tabuleiro(this.form)">Reiniciar Partida</button>
            </div>
        </div>
    </form>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jogo.js') }}"></script>
    </body>
</html>
