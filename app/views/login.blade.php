<div class='quote'>
<p>If you haven't logged in since our code update August 31st, 2014, you will need to <a href="{{ URL::to('password/remind') }}">reset your password</a> in order to regain access to your account.</p>
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
</div>