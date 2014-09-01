<div class='quote'>
{{ Form::open(array('action' => 'UserDashboardController@postEditAccount')) }}
    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', Auth::User()->email, array('placeholder' => 'email')) }}<br />

    {{ Form::label('newpassword', 'New Password') }}
    {{ Form::password('newpassword') }}<br />
    
    {{ Form::label('newpassword_confirmation', 'New Password Again') }}
    {{ Form::password('newpassword_confirmation') }}<br />

	{{ Form::label('password', 'Current Password*') }}
    {{ Form::password('password') }}<br /><br />
    <i>Current password is required</i><br />
    {{ Form::submit('Save', array('class' => 'save')) }}<br />
{{ Form::close() }}
</div>