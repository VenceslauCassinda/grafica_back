<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemPedido;

class ControladorItemsPedido extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'estado' => 'required|integer',
            'id_produto' => 'required|integer',
            'id_pedido' => 'required|integer',
            'total' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'desconto' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'quantidade' => 'required|integer',
        ]);

        $dado = ItemPedido::create([
            'id_produto' => $atributos['id_produto'],
            'id_pedido' => $atributos['id_pedido'],
            'total' => $atributos['total'],
            'desconto' => $atributos['desconto'],
            'estado' => $atributos['estado'],
            'quantidade' => $atributos['quantidade'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function atualizar(Request $requisicao, $id){

        $dado = ItemPedido::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $dado->id_produto = $requisicao->id_produto;
        $dado->id_pedido = $requisicao->id_pedido;
        $dado->total = $requisicao->total;
        $dado->desconto = $requisicao->desconto;
        $dado->estado = $requisicao->estado;
        $dado->quantidade = $requisicao->quantidade;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = ItemPedido::find($id);
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

        $todos = ItemPedido::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = ItemPedido::find($id);
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
