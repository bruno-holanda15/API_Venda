<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Categoria;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{
    
    public function create(HttpRequest $request)
    {
        $validator = Validator::make( $request->all(), [
            'nome' => 'required'

        ]);

        if($validator->fails()) {
            return response()->json(['Erro ao criar uma categoria'],400);
        }

        $newCategoria = new Categoria();
        $newCategoria->nome = $request->nome;

        $newCategoria->save();

        return response()->json(['Nova categoria criado com sucesso'],201);

    }

    public function delete(HttpRequest $request)
    {
        $id = $request->id;
        $categoria = Categoria::find($id);

        if(is_null($categoria)){
            return response()->json(['Categoria inexistente'],400);

        }

        $categoria->delete();
        return response()->json(["Categoria deletado"], 201);

    }

    public function listCategorias()
    {
        $categorias = Categoria::all();

        return response()->json([$categorias],200);
    }
}