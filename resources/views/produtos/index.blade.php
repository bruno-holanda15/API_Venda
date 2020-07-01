@extends('layout')
@section('cabecalho')
    Produtos
@endsection

@section('conteudo')

    <a href="/produtos/criar-produto" class="btn btn-dark mb-3">Adicionar</a>

    <ul class="list-group">
        @foreach ($produtos as $produto)
            
            <li class="list-group-item"><?php echo $produto; ?></li>
        @endforeach
    </ul>

@endsection
