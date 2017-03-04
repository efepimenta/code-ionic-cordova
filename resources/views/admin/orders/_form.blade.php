<div class="form-group">
    {!! Form::label('status','Status:') !!}
    {!! Form::select('status',$list_status,null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('entregador','Entregador:') !!}
    {!! Form::select('user_deliveryman_id',$deliveryman,null,['class'=>'form-control']) !!}
</div>