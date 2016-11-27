{!! Form::open(['id'=>'add_types_form', 'name'=> 'add_types_form']) !!}
<div class="row clearfix">
    <div class="col-md-12">
        <b>Наименование</b>
        <div class="form-group">
            <div class="form-line {{ $errors->has('name') ? ' error' : '' }}">
                {{ Form::text('name', null,['id' => 'name','class'=>'form-control']) }}
            </div>
            @if ($errors->has('name'))
                <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
            @endif
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-12">
        <b>Описание</b>
        <div class="form-group">
            <div class="form-line {{ $errors->has('description') ? ' error' : '' }}">
                {{ Form::text('description', null,['id' => 'description','class'=>'form-control']) }}
            </div>
            @if ($errors->has('description'))
                <label id="description-error" class="error" for="description">{{ $errors->first('description') }}</label>
            @endif
        </div>
    </div>
</div>
{!! Form::close() !!}