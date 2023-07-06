<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;

class ControladorStock extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'id_produto' => 'required|integer',
            'quantidade' => 'required|integer',
        ]);

        $dado = Stock::create([
            'id_produto' => $atributos['id_produto'],
            'quantidade' => $atributos['quantidade'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function atualizar(Request $requisicao, $id){

        $dado = Stock::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $dado->id_produto = $requisicao->id_produto;
        $dado->quantidade = $requisicao->quantidade;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = Stock::find($id);
        if(!$dado){
            return response([
                'message' => 'Não Existe!'
            ], 403);
        }

        $logado = auth()->user();

        if($logado->nivel_acesso != 2){
            return response([
                'message' => 'Sem Permissão!'
            ], 403);
        }

        $dado->delete();
        return response([
            'message' => 'Dado Removido!'
        ], 200);
    }

    public function todos(){
        $logado = auth()->user();

        $todos = Stock::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = Stock::find($id);
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
