{!! Form::open(['id'=>'add_analysis_form', 'name'=> 'add_analysis_form']) !!}
{{ Form::hidden('research_id', $research_id) }}
{{ Form::hidden('analysis_id', null, ['id'=>'analysis_id']) }}
{{ Form::hidden('iteration', null, ['id'=>'iteration']) }}
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
        <b>Единица измерения</b>
        <div class="form-group">
            <div class="form-line {{ $errors->has('unit') ? ' error' : '' }}">
                {{ Form::text('unit', null,['id' => 'unit','class'=>'form-control']) }}
            </div>
            @if ($errors->has('unit'))
                <label id="unit-error" class="error" for="unit">{{ $errors->first('unit') }}</label>
            @endif
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-12">
        <b>Референсные значения</b>
        <div class="form-group">
            <div class="form-line {{ $errors->has('r_range') ? ' error' : '' }}">
                {{-- {{ Form::text('r_range', null,['id' => 'r_range','class'=>'form-control']) }} --}}
                {{ Form::textarea('r_range', null,['id' => 'r_range', 'class'=>'form-control no-resize', 'rows' => 4]) }}
            </div>
            @if ($errors->has('r_range'))
                <label id="r_range-error" class="error" for="r_range">{{ $errors->first('r_range') }}</label>
            @endif
        </div>
    </div>
</div>
{!! Form::close() !!}