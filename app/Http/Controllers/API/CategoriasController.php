<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Categoria;
use GuzzleHttp\Client;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

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

    public function addCategoria(HttpRequest $request)
    {
        $validator = Validator::make( $request->all(), [
            'codigo' => 'required',
            'categoria_filho'=>'required'

        ]);
        // https://api.mercadolibre.com/categories/MLA1071
        $client = new Client(['base_uri' => 'https://api.mercadolibre.com/categories/']);
        $response = $client->request(
            'GET',
            $request->codigo,
            [
                "verify" => false,
                "headers" => [
                    "Content-Type" => "application/json;charset=UTF-8",
                    "Accept"=>"application/json",
                    "APP_KEY"=>"ABCDEF"
                ]
            ]
        );
        $body = $response->getBody();
        $jsonHTML = json_decode($body->getContents(),true);

        $categoriaFinal = $jsonHTML['children_categories'][$request->categoria_filho]['name'];
        if(is_null($categoriaFinal)){
          return response()->json(['Categoria indisponivel'],400);

        }

        $newCategoria = new Categoria();
        $newCategoria->nome = $categoriaFinal;
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