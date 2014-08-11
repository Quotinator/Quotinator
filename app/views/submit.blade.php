@extends('templates.page')

@section('pagetitle', 'Submit')

@section('content')
<!-- if there are login errors, show them here -->
<p>
	{{ $errors->first('title') }}
	{{ $errors->first('quote') }}
	{{ $errors->first('failed') }}
</p>

{{ Form::open(array('url' => 'submit')) }}
	{{ Form::token() }}
	{{ Form::label('title', 'Title') }}
	{{ Form::text('title', Input::old('title'), array('placeholder' => 'Quote Title')) }}

	{{ Form::label('quote', 'Quote') }}
	{{ Form::textarea('quote', Input::old('quote'), array('placeholder' => 'Quote Body')) }}

{{ Form::submit('Submit!') }}
{{ Form::close() }}
@stop