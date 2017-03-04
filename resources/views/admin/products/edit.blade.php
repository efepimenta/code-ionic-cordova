@extends('app')

@section('content')

    <div class="container">
        <h3>Editando Produto ( {{$product->name}} )</h3>

        @include('errors._categories')

        {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'class'=>'form']) !!}

        @include('admin.products._form')

        <div class="form-group">
            {!! Form::submit('Salvar',['class'=>'form-control btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection