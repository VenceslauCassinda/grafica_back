<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalheItem;

class ControladorDetalheItem extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'id_item' => 'required|integer',
            'id_tipo' => 'required|integer',
            'dizeres' => 'required|string',
            'link' => 'required|string',
            'detalhe' => 'required|string',
            'nome_cor' => 'required|string',
        ]);

        $dado = DetalheItem::create([
            'id_item' => $atributos['id_item'],
            'id_tipo' => $atributos['id_tipo'],
            'dizeres' => $atributos['dizeres'],
            'detalhe' => $atributos['detalhe'],
            'link' => $atributos['link'],
            'nome_cor' => $atributos['nome_cor'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function atualizar(Request $requisicao, $id){

        $dado = DetalheItem::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $dado->id_item = $requisicao->id_item;
        $dado->detalhe = $requisicao->detalhe;
        $dado->dizeres = $requisicao->dizeres;
        $dado->id_tipo = $requisicao->id_tipo;
        $dado->link = $requisicao->link;
        $dado->nome_cor = $requisicao->nome_cor;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = DetalheItem::find($id);
        if(!$dado){
            return response([
                'message' => 'Não Existe!'
            ], 403);
        }

        $logado = auth()->user();

        $dado->delete();
        return response([
            'message' => 'Dado Removido!'
        ], 200);
    }

    public function todos(){
        $logado = auth()->user();

        $todos = DetalheItem::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = DetalheItem::find($id);
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
