@extends('app')

@section('content')

    <div class="container">
        <h3>Categorias</h3>
        <a href="{{route('admin.categories.create')}}" class="btn btn-default">Nova Categoria</a>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Botões</td>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <a href="{{route('admin.categories.edit', ['id'=>$category->id])}}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $categories->render() !!}
        </div>
    </div>

@endsection