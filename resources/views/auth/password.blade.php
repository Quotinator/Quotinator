@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
<div class='quote'>
{!! Session::get('error') !!}
{!! Session::get('status') !!}
{!! Form::open(array('url' => '/password/email')) !!}

	{!! Form::label('email', 'Email') !!}
    {!! Form::email('email', old('email'), array('placeholder' => 'email')) !!}<br />
    {!! Form::submit('Send Reminder') !!}<br />

{!! Form::close() !!}
</div>
@endsection
