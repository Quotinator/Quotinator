@extends('templates.page')

@section('pagetitle', 'Preferences')
@section('content')
<p>
	<img title='{{ Auth::User()->username }}' src='{{ Auth::User()->avatar }}'><br />
	This website uses gravatars.<br />
	Please visit <a href='https://www.gravatar.com/78883c51e89c462cd15eb22c9c0fe005'>Gravatar</a> to update your avatar.<br /> 
	Don't have a Gravatar account? <a href='https://en.gravatar.com/connect/?source=_signup'>Click Here!</a>
</p>
<p>
	@foreach($errors->all() as $error)
		{{ $error }} <br />
	@endforeach
</p>
{{ Form::open(array('action' => 'PreferencesController@postUser')) }}
    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', Auth::User()->email, array('placeholder' => 'email')) }}<br />

    {{ Form::label('newpassword', 'New Password') }}
    {{ Form::password('newpassword') }}<br />
    
    {{ Form::label('newpassword_confirmation', 'New Password Again') }}
    {{ Form::password('newpassword_confirmation') }}<br />

	{{ Form::label('password', 'Current Password') }}
    {{ Form::password('password') }}<br />

    {{ Form::submit('Save', array('class' => 'save')) }}<br />
{{ Form::close() }}
@stop