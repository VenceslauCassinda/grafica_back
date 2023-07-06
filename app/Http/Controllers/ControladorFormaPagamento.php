<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPagamento;

class ControladorFormaPagamento extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'forma' => 'required|string',
            'descricao' => 'required|string',
            'tipo' => 'required|string',
        ]);

        $dado = FormaPagamento::create([
            'forma' => $atributos['forma'],
            'descricao' => $atributos['descricao'],
            'tipo' => $atributos['tipo'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function atualizar(Request $requisicao, $id){

        $dado = FormaPagamento::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $dado->forma = $requisicao->forma;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = FormaPagamento::find($id);

        $logado = auth()->user();

        $dado->delete();
        return response([
            'message' => 'Dado Removido!'
        ], 200);
    }

    public function todos(){
        $logado = auth()->user();

        $todos = FormaPagamento::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = FormaPagamento::find($id);
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
