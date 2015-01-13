@extends('admin.layout')
@section('content')
The predicted profit for population = {{ $population}} is <strong> Rs.{{ $profit }}/-</strong>.
{{ Form::open(array('action' => array('MachineController@busiexp'), 'method' => 'get')) }}
 {{ Form::text('population', null, array( 'placeholder' => 'Population',  'class' => 'form-control')) }}
{{ Form::submit('Predict', array('class' => 'btn btn-success btn-xs')) }}
{{ Form::close() }}
</br>
<img  src="/img/busiexp/polyFit20.png" alt=""/>
@stop