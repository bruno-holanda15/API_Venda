@extends('layout')

@section('cabecalho')
    Adicionar produto
@endsection

@section('conteudo')
    <form method="post">
    @csrf
        <div class="form-group">

            <label for="nome" class="">Nome</label>
            <input type="text" class="form-control mb-2" name="nome" id="nome">

            <label for="descricao" class="">Descrição do produto</label>
            <input type="text" class="form-control mb-2" name="descricao" id="descricao">
            
            <label for="preco" class="">Preço</label>
            <input type="text" class="form-control mb-2" name="preco" id="preco">
        </div>

        <button class="btn btn-primary">Adicionar</button>
    </form>
@endsection