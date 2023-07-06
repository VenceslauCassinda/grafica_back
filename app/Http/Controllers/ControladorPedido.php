<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class ControladorPedido extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'estado' => 'required|integer',
            'id_funcionario' => 'required|integer',
            'id_cliente' => 'required|integer',
            'total' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'parcela' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'data_levantamento' => 'required|date',
            'dias' => 'required|integer',
            'evento' => 'required|string',
            'tema' => 'required|string',
            'servico' => 'required|string',
        ]);

        $dado = Pedido::create([
            'id_funcionario' => $atributos['id_funcionario'],
            'id_cliente' => $atributos['id_cliente'],
            'total' => $atributos['total'],
            'parcela' => $atributos['parcela'],
            'estado' => $atributos['estado'],
            'evento' => $atributos['evento'],
            'tema' => $atributos['tema'],
            'servico' => $atributos['servico'],
            'dias' => $atributos['dias'],
            'data_levantamento' => $atributos['data_levantamento'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function atualizar(Request $requisicao, $id){

        $dado = Pedido::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $dado->id_funcionario = $requisicao->id_funcionario;
        $dado->id_cliente = $requisicao->id_cliente;
        $dado->total = $requisicao->total;
        $dado->parcela = $requisicao->parcela;
        $dado->estado = $requisicao->estado;
        $dado->data_levantamento = $requisicao->data_levantamento;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = Pedido::find($id);
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

        $todos = Pedido::orderBy('created_at', 'DESC')->get();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = Pedido::find($id);
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
