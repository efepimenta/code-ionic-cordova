@extends('app')

@section('content')

    <div class="container">
        <h3>Pedido ( {{$order->id}} )</h3>

        <h2>Cliente: {{$order->client->user->name}}</h2>
        <h4>Data: {{$order->created_at}}</h4>

        <p>
            Entregar em: <br>
            {{$order->client->address}} - {{$order->client->city}} - {{$order->client->state}}
        </p>

        @include('errors._orders')

        {!! Form::model($order, ['route' => ['admin.orders.update', $order->id], 'class'=>'form']) !!}

        @include('admin.orders._form')

        <div class="form-group">
            {!! Form::submit('Salvar',['class'=>'form-control btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection