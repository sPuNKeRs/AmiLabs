<p><b>Здравствуйте, {{ $patient_research->patient->getFio() }}!</b></p>
<p>Ваш результат исследования "{{$patient_research->research->name}} №{{ $patient_research->id }} от {{ $patient_research->create_date }}" готов.</p>