@extends('app')

@section('content')

    <div class="container">
        <h3>Editando Cliente ( {{$client->user->name}} )</h3>

        @include('errors._clients')

        {!! Form::model($client, ['route' => ['admin.clients.update', $client->id], 'class'=>'form']) !!}

        @include('admin.clients._form')

        <div>
            {!! Form::submit('Salvar',['class'=>'form-control btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection