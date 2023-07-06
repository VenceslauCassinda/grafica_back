<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;

class ControladorPagamento extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'id_forma_pagamento' => 'required|integer',
            'id_pedido' => 'required|integer',
            'estado' => 'required|integer',
            'valor' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);

        $dado = Pagamento::create([
            'id_forma_pagamento' => $atributos['id_forma_pagamento'],
            'id_pedido' => $atributos['id_pedido'],
            'estado' => $atributos['estado'],
            'valor' => $atributos['valor'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = Pagamento::find($id);
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

        $todos = Pagamento::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = Pagamento::find($id);
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
