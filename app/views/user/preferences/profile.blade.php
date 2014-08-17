@extends('templates.page')

@section('pagetitle', 'Preferences - Profile')
@section('content')
<div class='quote'>
<img class='avatar' title='{{ Auth::User()->username }}' src='{{ Auth::User()->avatar }}'><br />
This website uses gravatars.<br />
Please visit <a href='https://www.gravatar.com/78883c51e89c462cd15eb22c9c0fe005'>Gravatar</a> to update your avatar.<br /> 
Don't have a Gravatar account? <a href='https://en.gravatar.com/connect/?source=_signup'>Click Here!</a>

<div class='clear'></div>

<p>
	@foreach($errors->all() as $error)
		{{ $error }} <br />
	@endforeach
</p>
{{ Form::open(array('action' => 'UserPreferencesController@postEditProfile')) }}
   	{{ Form::label('about', 'About me') }}
    {{ Form::textarea('about', Auth::User()->about, array('placeholder' => 'Something about yourself')) }}<br />

    {{ Form::submit('Save', array('class' => 'save')) }}<br />
{{ Form::close() }}
</div>
@stop