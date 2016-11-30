{!! Form::open(['id'=>'choose_research_form', 'name'=> 'choose_research_form', 'method'=>'POST', 'route' => 'registry.patients.research.add']) !!}
{{ Form::hidden('patient_id', $patient_id, ['id'=>'patient-id']) }}
<ul class="research-list-ul">
  @foreach($research_list as $research)
  <li class="">
    <input name="research_id" type="radio" id="research_id_{{ $research->id }}" class="research_type with-gap radio-col-red" value="{{ $research->id }}"  {{ $loop->first ? 'checked="checked"' : '' }}>
    <label for="research_id_{{ $research->id }}">{{ $research->name }}</label>
  </li>
  @endforeach
</ul>
{!! Form::close() !!}



