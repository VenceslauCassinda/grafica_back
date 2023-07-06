<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Comprovativo;

class ControladorComprovativo extends Controller
{
    public function upload(Request $requisicao){
        $arquivo = $requisicao->file('file');
        if($arquivo->isValid()){
            $fileName = $arquivo->getClientOriginalName();
            $arquivo->move(public_path('storage'), $fileName);
            return response([
                'url_base' => url("/"),
                'url' => Storage::url($fileName),                
                'message' => 'Arquivo Válido!'
            ], 200);
        }
        return response([
            'message' => 'Arquivo Inválido!'
        ], 403);
    }
    
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'id_pagamento' => 'required|integer',
            'link' => 'required|string',
            'descricao' => 'required|string',
        ]);

        $dado = Comprovativo::create([
            'id_pagamento' => $atributos['id_pagamento'],
            'link' => $atributos['link'],
            'descricao' => $atributos['descricao'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = Comprovativo::find($id);
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

        $todos = Comprovativo::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = Comprovativo::find($id);
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
