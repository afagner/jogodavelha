<?php

namespace App\Http\Controllers;

use App\Models\Jogadas;
use App\Models\UsersJogos;
use Illuminate\Http\Request;

class JogoDaVelhaController extends Controller
{
    protected $usersjogos, $jogadas;

    public function __construct(UsersJogos $usersjogos, Jogadas $jogadas)
    {
        $this->usersjogos = $usersjogos;
        $this->jogadas = $jogadas;
    }

    /**
     * renderiza a index
     */

    public function index()
    {
        session()->flush();
        return view('jogodavelha.index');
    }

    /**
     * cadastra o jogador
     * @param Request $request
     **/

    public function salvaUser(Request $request)
    {
        $nome = $request->get('nome');

        $users_jogos = $this->usersjogos->novojogador($nome);

        session()->put('jogador_id', $users_jogos['id']);

    }

    public function novoJogo()
    {
        if(!empty(session()->get('tabuleiro'))) {
            session()->flush();
        }
    }

    public function efetuaJogada(Request $request)
    {
        $posicao = $request->get('posicao');
        $player = $request->get('player');
        $jogador_id = session()->get('jogador_id');

        if(empty(session()->get('tabuleiro'))) {

            for($i=0;$i < 9; $i++){
                if($posicao == $i){
                    $jogadas[$i] = $player;
                }else{
                    $jogadas[$i] = "";
                }
            }

            session()->put('tabuleiro', $jogadas);
        }else{
            session()->put('tabuleiro.'.$posicao, $player);
        }

        $user = $this->usersjogos->getUser($jogador_id);

        $this->jogadas->jogada($user['id'], $user['nome'], $player, $posicao);

        return $this->deuVelha($player);
    }

    public function deuVelha($player)
    {
        $jogadas = session()->get('tabuleiro');

        if ($jogadas[0] == $jogadas[3] and $jogadas[0] == $jogadas[6] and $jogadas[0] == $player) {
            return $player;
        }

        if ($jogadas[0] == $jogadas[1] and $jogadas[0] == $jogadas[2] and $jogadas[0] == $player) {
            return $player;
        }

        if ($jogadas[0] == $jogadas[4] and $jogadas[0] == $jogadas[8] and $jogadas[0] == $player) {
            return $player;
        }

        if ($jogadas[1] == $jogadas[4] and $jogadas[1] == $jogadas[7] and $jogadas[1] == $player) {
            return $player;
        }

        if ($jogadas[2] == $jogadas[5] and $jogadas[2] == $jogadas[8] and $jogadas[2] == $player) {
            return $player;
        }

        if ($jogadas[2] == $jogadas[4] and $jogadas[2] == $jogadas[6] and $jogadas[2] == $player) {
            return $player;
        }

        if ($jogadas[3] == $jogadas[4] and $jogadas[3] == $jogadas[5] and $jogadas[3] == $player) {
            return $player;
        }

        if ($jogadas[6] == $jogadas[7] and $jogadas[6] == $jogadas[8] and $jogadas[6] == $player) {
            return $player;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JogoDaVelha  $jogoDaVelha
     * @return \Illuminate\Http\Response
     */
    public function show(JogoDaVelha $jogoDaVelha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JogoDaVelha  $jogoDaVelha
     * @return \Illuminate\Http\Response
     */
    public function edit(JogoDaVelha $jogoDaVelha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JogoDaVelha  $jogoDaVelha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JogoDaVelha $jogoDaVelha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JogoDaVelha  $jogoDaVelha
     * @return \Illuminate\Http\Response
     */
    public function destroy(JogoDaVelha $jogoDaVelha)
    {
        //
    }
}
