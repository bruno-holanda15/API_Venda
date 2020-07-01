<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Produto;
use App\Categoria;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    public function teste(HttpRequest $request)
    {
        $request->all();
        $nome = $request->nome;
        $frase = "Olá testandooo $nome!";
        return response()->json([$frase], 201);
    }

    public function create(HttpRequest $request)
    {
        $validator = Validator::make( $request->all(), [
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required|integer',
            'categoria_id'=>'required|integer'
        ]);

        if($validator->fails()) {
            return response()->json(['Erro ao criar um produto.'],400);
        }

        $categoria = Categoria::find($request->categoria_id);
        if(is_null($categoria)){
           
            return response()->json(['Categoria inexistente, não foi possível criar produto!'],400);

        }

        $newProduto = new Produto();
        $newProduto->nome = $request->nome;
        $newProduto->descricao = $request->descricao;
        $newProduto->categoria_id = $request->categoria_id;
        $newProduto->preco = $request->preco;
        
        $newProduto->save();

        return response()->json(['Novo produto criado com sucesso.'],201);

    }

    public function delete(HttpRequest $request)
    {
        $id = $request->id;
        $produto = Produto::find($id);

        if(is_null($produto)){
            return response()->json(['Produto inexistente.'],400);

        }

        $produto->delete();
        return response()->json(["Produto deletado."], 201);

    }

    public function listProdutos()
    {
        $produtos = Produto::all();

        return response()->json([$produtos],200);
    }
}