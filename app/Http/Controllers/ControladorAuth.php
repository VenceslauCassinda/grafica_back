<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ControladorAuth extends Controller
{
    
    public function eliminar(Request $requisicao, $id){
        $dado = User::find($id);
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
            'message' => 'Usuário Removido!'
        ], 200);
    }

    public function todos(){
        // $novo = new User;
        // $novo->save();
        // $logado = auth()->user();

        // if($logado->nivel_acesso != 2){
        //     return response([
        //         'message' => 'Sem Permissão!'
        //     ], 403);
        // }
        $todos = User::all();
        return response([
            'todos' => $todos
        ], 200);
    }

    public function atualizar(Request $requisicao, $id){
        $requisicao->validate([
            'name' => 'required|string',
            'nivel_acesso' => 'required|integer',
            'logado' => 'required|integer',
            'estado' => 'required|integer',
        ]);
        $dado = User::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $logado = auth()->user();

        // if($logado->nivel_acesso != 2 || $logado->id != $dado->id){
        //     return response([
        //         'message' => 'Sem Permissão!'
        //     ], 403);
        // }

        $dado->name = $requisicao->name;
        $dado->imagem = $requisicao->imagem;
        $dado->nivel_acesso = $requisicao->nivel_acesso;
        $dado->estado = $requisicao->estado;
        $dado->logado = $requisicao->logado;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }
    
    public function atualizarComPass(Request $requisicao, $id){
        $requisicao->validate([
            'name' => 'required|string',
            'nivel_acesso' => 'required|integer',
            'logado' => 'required|integer',
            'estado' => 'required|integer',
        ]);
        $dado = User::find($id);
        if(!$dado){
            return response([
                "message" => "Não Existe!"
            ], 403);
        }

        $logado = auth()->user();

        // if($logado->nivel_acesso != 2 || $logado->id != $dado->id){
        //     return response([
        //         'message' => 'Sem Permissão!'
        //     ], 403);
        // }

        $dado->name = $requisicao->name;
        $dado->password = bcrypt($requisicao->password);
        $dado->imagem = $requisicao->imagem;
        $dado->nivel_acesso = $requisicao->nivel_acesso;
        $dado->estado = $requisicao->estado;
        $dado->logado = $requisicao->logado;

        $dado->save();

        return response([
            'dado' => $dado
        ], 200);
    }
    
    public function registar(Request $requisicao){
        $atributos = $requisicao->validate([
            'name' => 'required|string|unique:users,name',
            'nivel_acesso' => 'required|integer',
            'logado' => 'required|integer',
            'estado' => 'required|integer',
            'password' => 'required|min:8'
        ]);

        $usuario = User::create([
            'name' => $atributos['name'],
            'nivel_acesso' => $atributos['nivel_acesso'],
            'logado' => $atributos['logado'],
            'estado' => $atributos['estado'],
            'password' => bcrypt($atributos['password'])
        ]);

        return response([
            'dado' => $usuario,
            'token' => $usuario->createToken('secret')->plainTextToken,
        ],200);
    }
    
    public function login(Request $requisicao){
        $atributos = $requisicao->validate([
            'name' => 'required|string',
            'password' => 'required|min:8'
        ]);

        if(!Auth::attempt($atributos)){
            return response([
                'message' => 'Credencias Inválidas!',
            ], 403);
        }

        return response([
            'dado' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken,
        ],200);
    }

    public function terminarSessao(){
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Sessão Terminada!'
        ], 200);
    }
    
    public function usuarioAtual(){
        return response([
            'dado' => auth()->user()
        ], 200);
    }
    
    public function usuario(Request $requisicao, $id){
        $dado = User::find($id);
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
