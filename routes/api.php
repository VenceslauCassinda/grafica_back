<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorAuth;
use App\Http\Controllers\ControladorFuncionario;
use App\Http\Controllers\ControladorProduto;
use App\Http\Controllers\ControladorStock;
use App\Http\Controllers\ControladorCliente;
use App\Http\Controllers\ControladorPreco;
use App\Http\Controllers\ControladorEntrada;
use App\Http\Controllers\ControladorSaida;
use App\Http\Controllers\ControladorPedido;
use App\Http\Controllers\ControladorItemsPedido;
use App\Http\Controllers\ControladorFormaPagamento;
use App\Http\Controllers\ControladorPagamento;
use App\Http\Controllers\ControladorComprovativo;
use App\Http\Controllers\ControladorExemplar;
use App\Http\Controllers\ControladorDetalhesItem;
use App\Http\Controllers\ControladorTema;
use App\Http\Controllers\ControladorServico;
use App\Http\Controllers\ControladorEvento;
use App\Http\Controllers\ControladorDetalheItem;
use App\Http\Controllers\ControladorTipoDetalhe;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [ControladorAuth::class, 'login']);
// USUARIOS
Route::post('registarUsuario', [ControladorAuth::class, 'registar']);
Route::get('/usuarios', [ControladorAuth::class, 'todos']);
// FUNCIONARIOS
Route::post('registarFuncionario', [ControladorFuncionario::class, 'adicionar']);
Route::get('/funcionarios', [ControladorFuncionario::class, 'todos']);
// CLIENTES
Route::get('/clientes', [ControladorCliente::class, 'todos']);
Route::post('/registarCliente', [ControladorCliente::class, 'adicionar']);

//COMPROVATIVO
Route::post('/fazerUploadComprovativo', [ControladorComprovativo::class, 'upload']);
Route::post('/fazerUploadExemplar', [ControladorExemplar::class, 'upload']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    // CRUD DE USUARIOS
    Route::get('/usuarioAtual', [ControladorAuth::class, 'usuarioAtual']);
    Route::get('/usuario/{id}', [ControladorAuth::class, 'usuario']);
    Route::post('/eliminarUsuario/{id}/', [ControladorAuth::class, 'eliminar']);
    Route::post('/atualizarUsuario/{id}/', [ControladorAuth::class, 'atualizar']);
    Route::post('/atualizarUsuarioComPass/{id}/', [ControladorAuth::class, 'atualizarComPass']);
    Route::post('/terminarSessao', [ControladorAuth::class, 'terminarSessao']);
    
    // CRUD DE FUNCIONARIOS
    Route::get('/funcionario/{id}/', [ControladorFuncionario::class, 'funcionario']);
    Route::post('/eliminarFuncionario/{id}/', [ControladorFuncionario::class, 'eliminar']);
    Route::post('/atualizarFuncionario/{id}/', [ControladorFuncionario::class, 'atualizar']);
    
    // CRUD DE FUNCIONARIOS
    Route::get('/produto/{id}/', [ControladorProduto::class, 'produto']);
    Route::get('/produtos', [ControladorProduto::class, 'todos']);
    Route::post('/registarProduto', [ControladorProduto::class, 'adicionar']);
    Route::post('/eliminarProduto/{id}/', [ControladorProduto::class, 'eliminar']);
    Route::post('/atualizarProduto/{id}/', [ControladorProduto::class, 'atualizar']);
    
    // CRUD DE STOCKS
    Route::get('/stock/{id}/', [ControladorStock::class, 'cada']);
    Route::get('/stocks', [ControladorStock::class, 'todos']);
    Route::post('/registarStock', [ControladorStock::class, 'adicionar']);
    Route::post('/eliminarStock/{id}/', [ControladorStock::class, 'eliminar']);
    Route::post('/atualizarStock/{id}/', [ControladorStock::class, 'atualizar']);
    
    // CRUD DE CLIENTES
    Route::get('/cliente/{id}/', [ControladorCliente::class, 'cada']);
    Route::post('/eliminarCliente/{id}/', [ControladorCliente::class, 'eliminar']);
    Route::post('/atualizarCliente/{id}/', [ControladorCliente::class, 'atualizar']);

    // CRUD DE PRECOS VENDA
    Route::get('/preco/{id}/', [ControladorPreco::class, 'cada']);
    Route::get('/precos', [ControladorPreco::class, 'todos']);
    Route::get('/tabela', [ControladorPreco::class, 'tabela']);
    Route::post('/registarPreco', [ControladorPreco::class, 'adicionar']);
    Route::post('/eliminarPreco/{id}/', [ControladorPreco::class, 'eliminar']);
    Route::post('/atualizarPreco/{id}/', [ControladorPreco::class, 'atualizar']);
    
    // CRUD DE ENTRADAS PRODUTO
    Route::get('/entrada/{id}/', [ControladorEntrada::class, 'cada']);
    Route::get('/entradas', [ControladorEntrada::class, 'todos']);
    Route::post('/registarEntrada', [ControladorEntrada::class, 'adicionar']);
    Route::post('/eliminarEntrada/{id}/', [ControladorEntrada::class, 'eliminar']);
    Route::post('/atualizarEntrada/{id}/', [ControladorEntrada::class, 'atualizar']);
    
    // CRUD DE SAIDAS PRODUTO
    Route::get('/saida/{id}/', [ControladorSaida::class, 'cada']);
    Route::get('/saidas', [ControladorSaida::class, 'todos']);
    Route::post('/registarSaida', [ControladorSaida::class, 'adicionar']);
    Route::post('/eliminarSaida/{id}/', [ControladorSaida::class, 'eliminar']);
    Route::post('/atualizarSaida/{id}/', [ControladorSaida::class, 'atualizar']);
    
    // CRUD DE PEDIDO
    Route::get('/pedido/{id}/', [ControladorPedido::class, 'cada']);
    Route::get('/pedidos', [ControladorPedido::class, 'todos']);
    Route::post('/registarPedido', [ControladorPedido::class, 'adicionar']);
    Route::post('/eliminarPedido/{id}/', [ControladorPedido::class, 'eliminar']);
    Route::post('/atualizarPedido/{id}/', [ControladorPedido::class, 'atualizar']);
    
    // CRUD DE PEDIDO
    Route::get('/itemPedido/{id}/', [ControladorItemsPedido::class, 'cada']);
    Route::get('/itemsPedido', [ControladorItemsPedido::class, 'todos']);
    Route::post('/registarItemPedido', [ControladorItemsPedido::class, 'adicionar']);
    Route::post('/eliminarItemPedido/{id}/', [ControladorItemsPedido::class, 'eliminar']);
    Route::post('/atualizarItemPedido/{id}/', [ControladorItemsPedido::class, 'atualizar']);
    
    // CRUD DE PAGAMENTO
    Route::get('/pagamento/{id}/', [ControladorPagamento::class, 'cada']);
    Route::get('/pagamentos', [ControladorPagamento::class, 'todos']);
    Route::post('/registarPagamento', [ControladorPagamento::class, 'adicionar']);
    Route::post('/eliminarPagamento/{id}/', [ControladorPagamento::class, 'eliminar']);
    Route::post('/atualizarPagamento/{id}/', [ControladorPagamento::class, 'atualizar']);
    
    // CRUD DE PAGAMENTO
    Route::get('/formaPagamento/{id}/', [ControladorFormaPagamento::class, 'cada']);
    Route::get('/formasPagamento', [ControladorFormaPagamento::class, 'todos']);
    Route::post('/registarFormaPagamento', [ControladorFormaPagamento::class, 'adicionar']);
    Route::post('/eliminarFormaPagamento/{id}/', [ControladorFormaPagamento::class, 'eliminar']);
    Route::post('/atualizarFormaPagamento/{id}/', [ControladorFormaPagamento::class, 'atualizar']);
    
    // CRUD DE COMPROVATIVO
    Route::get('/comprovativo/{id}/', [ControladorComprovativo::class, 'cada']);
    Route::get('/comprovativos', [ControladorComprovativo::class, 'todos']);
    Route::post('/registarComprovativo', [ControladorComprovativo::class, 'adicionar']);
    Route::post('/eliminarComprovativo/{id}/', [ControladorComprovativo::class, 'eliminar']);
    Route::post('/atualizarComprovativo/{id}/', [ControladorComprovativo::class, 'atualizar']);

    // CRUD DE EXEMPLAR
    Route::get('/exemplar/{id}/', [ControladorExemplar::class, 'cada']);
    Route::get('/exemplares', [ControladorExemplar::class, 'todos']);
    Route::post('/registarExemplar', [ControladorExemplar::class, 'adicionar']);
    Route::post('/eliminarExemplar/{id}/', [ControladorExemplar::class, 'eliminar']);
    Route::post('/atualizarExemplar/{id}/', [ControladorExemplar::class, 'atualizar']);
    
    // CRUD DE DETALHE ITEM
    Route::get('/detalheItem/{id}/', [ControladorDetalheItem::class, 'cada']);
    Route::get('/detalhesItem', [ControladorDetalheItem::class, 'todos']);
    Route::post('/registarDetalheItem', [ControladorDetalheItem::class, 'adicionar']);
    Route::post('/eliminarDetalheItem/{id}/', [ControladorDetalheItem::class, 'eliminar']);
    Route::post('/atualizarDetalheItem/{id}/', [ControladorDetalheItem::class, 'atualizar']);
    
    // CRUD DE TIPO DETALHE
    Route::get('/tipoDetalhe/{id}/', [ControladorTipoDetalhe::class, 'cada']);
    Route::get('/tiposDetalhe', [ControladorTipoDetalhe::class, 'todos']);
    Route::post('/registarTipoDetalhe', [ControladorTipoDetalhe::class, 'adicionar']);
    Route::post('/eliminarTipoDetalhe/{id}/', [ControladorTipoDetalhe::class, 'eliminar']);
    Route::post('/atualizarTipoDetalhe/{id}/', [ControladorTipoDetalhe::class, 'atualizar']);
    
    // CRUD DE TEMA
    Route::get('/tema/{id}/', [ControladorTema::class, 'cada']);
    Route::get('/temas', [ControladorTema::class, 'todos']);
    Route::post('/registarTema', [ControladorTema::class, 'adicionar']);
    Route::post('/eliminarTema/{id}/', [ControladorTema::class, 'eliminar']);
    Route::post('/atualizarTema/{id}/', [ControladorTema::class, 'atualizar']);
    
    // CRUD DE SERVICO
    Route::get('/servico/{id}/', [ControladorServico::class, 'cada']);
    Route::get('/servicos', [ControladorServico::class, 'todos']);
    Route::post('/registarServico', [ControladorServico::class, 'adicionar']);
    Route::post('/eliminarServico/{id}/', [ControladorServico::class, 'eliminar']);
    Route::post('/atualizarServico/{id}/', [ControladorServico::class, 'atualizar']);
    
    // CRUD DE EVENTO
    Route::get('/evento/{id}/', [ControladorEvento::class, 'cada']);
    Route::get('/eventos', [ControladorEvento::class, 'todos']);
    Route::post('/registarEvento', [ControladorEvento::class, 'adicionar']);
    Route::post('/eliminarEvento/{id}/', [ControladorEvento::class, 'eliminar']);
    Route::post('/atualizarEvento/{id}/', [ControladorEvento::class, 'atualizar']);
});
