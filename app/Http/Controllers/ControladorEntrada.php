<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;

class ControladorEntrada extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'id_produto' => 'required|integer',
            'id_funcionario' => 'required|integer',
            'motivo' => 'required|string',
            'quantidade' => 'required|integer',
        ]);

        $dado = Entrada::create([
            'id_produto' => $atributos['id_produto'],
            'id_funcionario' => $atributos['id_funcionario'],
            'motivo' => $atributos['motivo'],
            'quantidade' => $atributos['quantidade'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = Entrada::find($id);
        if(!$dado){
            return response([
                'message' => 'Não Existe!'
            ], 403);
        }

        $dado->delete();
        return response([
            'message' => 'Dado Removido!'
        ], 200);
    }

    public function todos(){
        $logado = auth()->user();

        $todos = Entrada::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = Entrada::find($id);
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
