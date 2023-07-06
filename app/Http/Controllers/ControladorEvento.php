<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class ControladorEvento extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'evento' => 'required|string',
            'descricao' => 'required|string',
        ]);

        $dado = Evento::create([
            'evento' => $atributos['evento'],
            'descricao' => $atributos['descricao'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function atualizar(Request $requisicao, $id){

        $dado = Evento::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $dado->Evento = $requisicao->Evento;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = Evento::find($id);

        $logado = auth()->user();

        $dado->delete();
        return response([
            'message' => 'Dado Removido!'
        ], 200);
    }

    public function todos(){
        $logado = auth()->user();

        $todos = Evento::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = Evento::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }
        return response([
            'dado' => auth()->user()
        ], 200);
    }
}
