@extends('app')

@section('content')

    <div class="container">
        <h3>Editando Cupoms ( {{$cupom->cod}} )</h3>

        @include('errors._cupoms')

        {!! Form::model($cupom, ['route' => ['admin.cupoms.update', $cupom->id], 'class'=>'form']) !!}

        @include('admin.cupoms._form')

        <div class="form-group">
            {!! Form::submit('Salvar',['class'=>'form-control btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection