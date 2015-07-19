@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
<div class='quote'>
{!! Session::get('error') !!}

{!! Form::open(array('url' => '/password/reset')) !!}
    {!! Form::hidden('token', $token) !!}

    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', old('email'), array('placeholder' => 'email')) !!}<br />

    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password') !!}<br />

    {!! Form::label('password_confirmation', 'Password Again') !!}
    {!! Form::password('password_confirmation') !!}<br />

    {!! Form::submit('Reset Password') !!}<br />
{!! Form::close() !!}
</div>
@endsection
