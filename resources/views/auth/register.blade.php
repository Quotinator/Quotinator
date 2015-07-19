@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
<div class='quote'>

{!! Form::open(array('url' => '/auth/register')) !!}
	{!! Form::label('username', 'Username') !!}
	{!! Form::text('username', old('username'), array('placeholder' => 'Username')) !!}

	{!! Form::label('password', 'Password') !!}
	{!! Form::password('password') !!}

	{!! Form::label('password_confirmation', 'Confirm password') !!}
	{!! Form::password('password_confirmation') !!}

	{!! Form::label('email', 'Email') !!}
	{!! Form::email('email', old('email'), array('placeholder' => 'your@email.com')) !!}

{!! Form::submit('Submit!') !!}
{!! Form::close() !!}
<p>
<a href="{!! url('/password/email') !!}">Forgot your password?</a>
</p>
</div>
@endsection
