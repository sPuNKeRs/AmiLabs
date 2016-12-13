{!! Form::open(['id'=>'choose_research_alert', 'name'=> 'choose_research_alert', 'method'=>'POST']) !!}
{{ Form::hidden('patient_id', $patient->id, ['id'=>'patient-id']) }}
{{ Form::hidden('patient_research_id', isset($patient_research->id) ? $patient_research->id : null, ['id'=>'patient-research-id']) }}
<ul class="alert-list-ul">
  <li class="">
    <input name="alert_type" type="radio" id="alert-type-1" class="alert-type with-gap radio-col-red" value="1" checked>
    <label for="alert-type-1">Электронная почта</label>
  </li>
   <li class="">
    <input name="alert_type" type="radio" id="alert-type-2" class="alert-type with-gap radio-col-red" value="2">
    <label for="alert-type-2">СМС</label>
  </li>
   <li class="">
    <input name="alert_type" type="radio" id="alert-type-3" class="alert-type with-gap radio-col-red" value="3">
    <label for="alert-type-3">Электронная почта + СМС</label>
  </li>
</ul>
{!! Form::close() !!}



