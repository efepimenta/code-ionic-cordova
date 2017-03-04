@extends('app')

@section('content')

    <div class="container">
        <h3>Clientes</h3>
        <a href="{{route('admin.clients.create')}}" class="btn btn-default">Novo Cliente</a>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <td>Nome</td>
                    <td>Email</td>
                    <td>phone</td>
                    <td>address</td>
                    <td>city</td>
                    <td>state</td>
                    <td>zipcode</td>
                    <td>Botões</td>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{$client->user->name}}</td>
                        <td>{{$client->user->email}}</td>
                        <td>{{$client->phone}}</td>
                        <td>{{$client->address}}</td>
                        <td>{{$client->city}}</td>
                        <td>{{$client->state}}</td>
                        <td>{{$client->zipcode}}</td>
                        <td>
                            <a href="{{route('admin.clients.edit', ['id'=>$client->id])}}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $clients->render() !!}
        </div>
    </div>

@endsection