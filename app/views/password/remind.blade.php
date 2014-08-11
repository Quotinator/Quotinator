@extends('templates.page')

@section('pagetitle', 'Send Password Reset')

@section('content')
{{ Session::get('error') }}
{{ Session::get('status') }}
{{ Form::open(array('action' => 'RemindersController@postRemind')) }}

	{{ Form::label('email', 'Email') }}
    {{ Form::email('email', Input::old('email'), array('placeholder' => 'email')) }}<br />
    {{ Form::submit('Send Reminder') }}<br />

{{ Form::close() }}
@stop