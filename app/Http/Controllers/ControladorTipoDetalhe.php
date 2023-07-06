<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoDetalhe;

class ControladorTipoDetalhe extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'tipo' => 'required|integer',
            'tipo_produto' => 'required|integer',
            'detalhe' => 'required|string',
        ]);

        $dado = TipoDetalhe::create([
            'tipo' => $atributos['tipo'],
            'tipo_produto' => $atributos['tipo_produto'],
            'detalhe' => $atributos['detalhe'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function atualizar(Request $requisicao, $id){

        $dado = TipoDetalhe::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $dado->detalhe = $requisicao->detalhe;
        $dado->tipo = $requisicao->tipo;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = TipoDetalhe::find($id);
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

        $todos = TipoDetalhe::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = TipoDetalhe::find($id);
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
