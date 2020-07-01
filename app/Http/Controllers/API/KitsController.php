<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Kit;
use App\KitProduto;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KitsController extends Controller
{
    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'nome'=>'required|min:4|max:32'
        ]);

        if($validator->fails()) {
            return response()->json(['Erro ao criar um kit.'],400);
        }

        $newKit = new Kit();
        $newKit->nome = $request->nome;

        $newKit->save();
        return response()->json(["Kit $request->nome criado com sucesso."],400);

        
    }

    public function addProduto(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kit_id'=>'required|integer',
            'produto_id'=>'required|integer'
        ]);        

        if($validator->fails()){
            return response()->json(['Erro ao adicionar produto ao kit.'],400);

        }

        $produto = Produto::find($request->produto_id);
        
        if(is_null($produto)){
            return response()->json(['Produto inexistente.'],400);

        }

        $kit = Kit::find($request->kit_id);
        if(is_null($kit)){
            return response()->json(['Kit inexistente.'],400);

        }

        $newKitProduto = new KitProduto();
        $newKitProduto->kit_id = $request->kit_id;
        $newKitProduto->produto_id = $request->produto_id;
        $newKitProduto->save();


        return response()->json(["Adicionando $produto->nome ao $kit->nome"],200);

    }

    public function removeProduto(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kit_id'=>'required|integer',
            'produto_id'=>'required|integer'
        ]);    
        if($validator->fails()){
            return response()->json(['Falta informações para exclusão.'],400);

        } 

        $kitProduto = DB::table('kits_produtos')
            ->where([
                ['produto_id','=',$request->produto_id],
                ['kit_id','=',$request->kit_id]
            ])->delete();

        if(!$kitProduto){
            return response()->json(['Erro ao deletar produto do kit.'],400);

        }
        return response()->json(['Produto deletado do kit.'],200);
        
    }

    public function listAllKits()
    {
        $lista = DB::table('kits_produtos')
            ->paginate(2);
            
        return response()->json($lista,200);

    }

    public function listOneKit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kit_id' => 'required|integer'
        ]);

        if($validator->fails()){
            return response()->json(['Necessário Kit Id para busca'],400);

        }

        $lista = DB::table('kits_produtos')
            ->where(
                'kit_id','=',$request->kit_id
            )->get();

        // $lista = DB::table('kits_produtos')
        //     ->paginate(2);

        if(count($lista) === 0 ){
            return response()->json(['Erro, não possui Kit com esse id.'],400);

        }
        
        return response()->json(["Lista de kit id $request->kit_id.",$lista],200);
        // return response()->json($lista,200);

    }
}