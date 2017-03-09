@extends('app')

@section('content')

    <div class="container">
        <h3>Pedidos</h3>
{{--        <a href="{{route('admin.orders.create')}}" class="btn btn-default">Novo Pedido</a>--}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Total</td>
                    <td>Data</td>
                    <td>Entregador</td>
                    <td>Status</td>
                    <td>Items</td>
                    <td>Botões</td>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->total}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            @if($order->deliveryman)
                                {{$order->deliveryman->name}}
                            @else
                                ---
                            @endif
                        </td>
                        <td>{{$order->status}}</td>
                        <td>
                            <ul>
                                @foreach($order->items as $item)
                                    <li>{{$item->product->name}}</li>
                                @endforeach
                            </ul>
                        </td>

                        <td>
                            <a href="{{route('admin.orders.edit', ['id'=>$order->id])}}"
                               class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $orders->render() !!}
        </div>
    </div>

@endsection