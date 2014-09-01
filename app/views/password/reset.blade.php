<div class='quote'>
{{ Session::get('error') }}

{{ Form::open(array('action' => 'RemindersController@postReset')) }}
    {{ Form::hidden('token', $token) }}

    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', Input::old('email'), array('placeholder' => 'email')) }}<br />

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}<br />
    
    {{ Form::label('password_confirmation', 'Password Again') }}
    {{ Form::password('password_confirmation') }}<br />

    {{ Form::submit('Reset Password') }}<br />
{{ Form::close() }}
</div>