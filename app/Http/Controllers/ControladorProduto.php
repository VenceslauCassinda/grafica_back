<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ControladorProduto extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'nome' => 'required|string',
            'estado' => 'required|integer',
            'tipo' => 'required|integer',
            'preco_compra' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'recebivel' => 'required|integer',
        ]);

        $dado = Produto::create([
            'nome' => $atributos['nome'],
            'preco_compra' => $atributos['preco_compra'],
            'estado' => $atributos['estado'],
            'tipo' => $atributos['tipo'],
            'recebivel' => $atributos['recebivel'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function atualizar(Request $requisicao, $id){

        $dado = Produto::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $dado->nome = $requisicao->nome;
        $dado->preco_compra = $requisicao->preco_compra;
        $dado->estado = $requisicao->estado;
        $dado->recebivel = $requisicao->recebivel;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = Produto::find($id);
        if(!$dado){
            return response([
                'message' => 'Não Existe!'
            ], 403);
        }

        $logado = auth()->user();

        if($logado->nivel_acesso != 2 && $logado->nivel_acesso != 1){
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

        $todos = Produto::all();
        return response([
            'todos' => $todos
        ], 200);
    }
    
    

    public function produto(Request $requisicao, $id){
        $dado = Produto::find($id);
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
