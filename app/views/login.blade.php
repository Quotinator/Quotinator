@extends('templates.page')

@section('pagetitle', 'Login')

@section('content')

<!-- if there are login errors, show them here -->
<p>
	{{ $errors->first('username') }}
	{{ $errors->first('password') }}
	{{ $errors->first('failed') }}
</p>

{{ Form::open(array('url' => 'login')) }}
	{{ Form::label('username', 'Username') }}
	{{ Form::text('username', Input::old('username'), array('placeholder' => 'Quotinator', 'autofocus')) }}

	{{ Form::label('password', 'Password') }}
	{{ Form::password('password') }}

{{ Form::submit('Submit!') }}
{{ Form::close() }}
<p>
<a href="{{ URL::to('password/remind') }}">Forgot your password?</a>
</p>
@stop