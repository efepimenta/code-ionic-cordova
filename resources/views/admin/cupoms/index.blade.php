@extends('app')

@section('content')

    <div class="container">
        <h3>Cupoms</h3>
        <a href="{{route('admin.cupoms.create')}}" class="btn btn-default">Novo Cupom</a>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Cód</td>
                    <td>Valor</td>
                    <td>Usado</td>
                    <td>Botões</td>
                </tr>
                </thead>
                <tbody>
                @foreach($cupoms as $cupom)
                    <tr>
                        <td>{{$cupom->id}}</td>
                        <td>{{$cupom->code}}</td>
                        <td>{{$cupom->value}}</td>
                        <td>{{$cupom->used}}</td>
                        <td>
                            <a href="{{route('admin.cupoms.edit', ['id'=>$cupom->id])}}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $cupoms->render() !!}
        </div>
    </div>

@endsection