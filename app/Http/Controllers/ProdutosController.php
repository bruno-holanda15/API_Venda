<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function list()
    {   
        $produtos = [
            "PS4",
            "Controle",
            "Jogo",
            "Memória HD"
        ];
        return view('produtos.index', ['produtos' => $produtos]);
    }

    public function create()
    {
        return view('produtos.criar');
    }

    public function store(Request $request)
    {

        $descricao = $request->descricao;
        $nome = $request->nome;
        $preco = $request->preco;
        var_dump($descricao);

        
    }
}