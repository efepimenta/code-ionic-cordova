@extends('app')

@section('content')

    <div class="container">
        <h3>Novo Cliente</h3>

        @include('errors._clients')

        {!! Form::open(['route' => 'admin.clients.store', 'class'=>'form']) !!}

        @include('admin.clients._form')

        <div class="form-group">
            {!! Form::submit('Criar',['class'=>'form-control btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection