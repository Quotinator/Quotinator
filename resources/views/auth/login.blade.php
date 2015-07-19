@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
<div class='quote'>
{!! Form::open(array('url' => url('/auth/login'))) !!}
	{!! Form::label('username', 'Username') !!}
	{!! Form::text('username', old('username'), array('placeholder' => 'Quotinator', 'autofocus')) !!}

	{!! Form::label('password', 'Password') !!}
	{!! Form::password('password') !!}

	{!! Form::label('persist', 'Remember me') !!}
	{!! Form::checkbox('persist') !!}

{!! Form::submit('Submit!') !!}
{!! Form::close() !!}
<p>
<a href="/password/email">Forgot your password?</a>
</p>
</div>
@endsection
