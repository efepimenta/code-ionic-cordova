@extends('app')

@section('content')

    <div class="container">
        <h3>Produtos</h3>
        <a href="{{route('admin.products.create')}}" class="btn btn-default">Novo Produto</a>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Categoria</td>
                    <td>Categoria</td>
                    <td>Botões</td>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <a href="{{route('admin.products.edit', ['id'=>$product->id])}}" class="btn btn-warning btn-sm">Editar</a>
                            <a href="{{route('admin.products.destroy', ['id'=>$product->id])}}" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $products->render() !!}
        </div>
    </div>

@endsection