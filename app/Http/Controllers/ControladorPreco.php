<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preco;
use App\Models\Produto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ControladorPreco extends Controller
{
    public function adicionar(Request $requisicao){
        $atributos = $requisicao->validate([
            'id_produto' => 'required|integer',
            'quantidade' => 'required|integer',
            'preco' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);

        $dado = Preco::create([
            'id_produto' => $atributos['id_produto'],
            'quantidade' => $atributos['quantidade'],
            'preco' => $atributos['preco'],
        ]);

        return response([
            'dado' => $dado,
        ],200);
    }

    public function eliminar(Request $requisicao, $id){
        $dado = Preco::find($id);
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

        $todos = Preco::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function cada(Request $requisicao, $id){
        $dado = Preco::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }
        return response([
            'dado' => auth()->user()
        ], 200);
    }

    public function tabela(){
        $todos = Produto::all();
        $pdf = App::make('dompdf.wrapper');
        $dados = '';
        $dados  .= '<h1>TABELA DE PREÇO</h1><br>';
        $dados  .= '<table>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
            </tr>
            </tr>';
        foreach ($todos as $p) {
            $nome = $p->nome;
            $preco = $p->preco_compra;
            $dados .= '<tr>
            <td>'.$nome.'</td>
            <td>'.$preco.'</td>
        </tr>';
        }
        
        $dados .= '</table>';
        $pdf->loadHTML($dados);
        // $content = $pdf->download()->getOriginalContent();

        return $pdf->download();
        // return response([
        //     'todos' => $todos
        // ], 200);
    }
}