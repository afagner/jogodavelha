step = 0;

nivel=3;

$(document).ready(function(){

    $("#submit").submit(function(e) {
        e.preventDefault();
        $("#nick").fadeOut();
        $("#topo").fadeIn();
        $("#tabuleiro").fadeIn();
        var nome = $("#nickname").val();
        var time = new Date();
        $("#name").html(nome);
        $("#time").html('Login: ' + time.getHours() + ':' + time.getMinutes());
        var url = "salva-usuario";
        enviaDados(url, { nome: nome });

    });
});

function enviaDados(url, data=null, player=null){
    $.ajax({
        type: "POST",
        data: data,
        url: url,
        success: function(dados) {
            statusJogo(dados);
        }
    });
}

function statusJogo(player) {

    if (player == "X") {

        alert("Você Ganhou!");
        block_position();
        step = -1;
    }

    if (player == "O") {

        alert("Você Perdeu!");
        block_position();
        step = -1;
    }
}

function limpar_Tabuleiro() {

    step = 0;
    var url = "novo-jogo";

    for (i=0;i<9; ++i) {

        $('#'+ i).attr('disabled',false).val('')

    }

    enviaDados(url);

}

function block_position() {

    for (i=0;i<9; ++i) {

        $('#'+ i).attr('disabled',true)

    }

}

function joga(field) {

    position= 'a'+ field.id;

    field.form[position].value="X";

    $('#'+ field.id).attr('disabled',true);

    var url = "efetua-jogada";
    enviaDados(url, { posicao: field.id, player : "X"});

    position=get_move(field.form);

    if (position=="") {

        alert("Não houve vencedor.");
        block_position();

        return;
    }

    if (step==5) {

        alert("Não houve vencedor.")
        block_position()

        return;
    }

    field.form[position].value="O";

    $('#'+ field.form[position].id).attr('disabled',true);

    var url = "efetua-jogada";

    enviaDados(url, { posicao: field.form[position].id, player : "O" });
}

// get position for move.

function comp_move(form,player,weight,depth) {

    var cost;

    var bestcost=-2;

    var position;

    var newplayer;

    if (player=="X") newplayer="O"; else newplayer="X";

    if (depth==nivel) return 0;

    //if (eval_pos(form)) return 1;

    for (var i=0; i<9; ++i) {

        position='a'+i;

        if (form[position].value != "")

            continue;

        form[position].value=player;

        cost = comp_move(form,newplayer, -weight, depth+1);

        if (cost > bestcost) {

            bestcost=cost;

            if (cost==1) i=9;

        }

        form[position].value="";

    }

    if (bestcost==-2) bestcost=0;

    return(-bestcost);

}

// get position for move.

function get_move(form) {

    var cost;

    var bestcost=-2;

    bestmove="";

    // don't think about first move.

    if (step++ == 0)

        if (form.a4.value=="")

            return "a4";

        else

        if (form.a0.value=="")

            return "a0";



    for (var i=0; i<9; ++i) {

        localposition='a'+i;

        if (form[localposition].value != "")

            continue;

        form[localposition].value="O";

        cost=comp_move(form,"X", -1, 0);

        if (cost > bestcost) {

            if (cost==1) i=9;

            bestmove=localposition;

            bestcost=cost;

        }

        form[localposition].value="";

    }

    return bestmove;

}