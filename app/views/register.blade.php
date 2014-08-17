@extends('templates.page')

@section('pagetitle', 'Register')

@section('content')
<div class='quote'>

{{ Form::open(array('url' => 'register')) }}
	{{ Form::label('username', 'Username') }}
	{{ Form::text('username', Input::old('username'), array('placeholder' => 'Username')) }}

	{{ Form::label('password', 'Password') }}
	{{ Form::password('password') }}

	{{ Form::label('password_confirmation', 'Confirm password') }}
	{{ Form::password('password_confirmation') }}

	{{ Form::label('email', 'Email') }}
	{{ Form::email('email', Input::old('email'), array('placeholder' => 'your@email.com')) }}

{{ Form::submit('Submit!') }}
{{ Form::close() }}
<p>
<a href="{{ URL::to('password/remind') }}">Forgot your password?</a>
</p>
</div>
@stop