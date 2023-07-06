<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;


class ControladorFuncionario extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'id_usuario' => 'required|integer',
            'nome_completo' => 'required|string',
            'estado' => 'required|integer',
        ]);

        $dado = Funcionario::create([
            'id_usuario' => $atributos['id_usuario'],
            'nome_completo' => $atributos['nome_completo'],
            'estado' => $atributos['estado'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function atualizar(Request $requisicao, $id){

        $dado = Funcionario::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $dado->nome_completo = $requisicao->nome_completo;
        $dado->id_usuario = $requisicao->id_usuario;
        $dado->estado = $requisicao->estado;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = Funcionario::find($id);
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
        // $logado = auth()->user();

        // if($logado->nivel_acesso != 2){
        //     return response([
        //         'message' => 'Sem Permissão!'
        //     ], 403);
        // }
        $todos = Funcionario::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function funcionario(Request $requisicao, $id){
        $dado = Funcionario::find($id);
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
