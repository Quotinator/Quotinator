@extends('templates.page')

@section('pagetitle', $pagetitle)
@section('content')
<div class='quote'>
	<h3>Registering</h3>
	<ul>
		<li>Anyone is welcome to register so long as they are human.</li>
		<li>All fields are required on the registration screen.</li>
	</ul>
	<h3>Dashboard</h3>
	<ul>
		<li>To update your email or password, head over to your <a class='button' href='{{ URL::route('user.dashboard') }}'>Dashboard&nbsp;<span class="fa fa-cog fa-spin"></span></a></li>
		<li>Your password must be at least 8 characters</li>
	</ul>
	<h3>Submitting</h3>
	<ul>
		<li>You must be logged in to submit</li>
		<li>If there is a back story to your quote then don't bother</li>
		<li>Strip quotes of all unnecessary chat (include join and part messages)</li>
		<li>Quotes should not contain direct attacks.</li>
	</ul>
	<h3>Voting</h3>
	<ul>
		<li>You must be logged in to vote</li>
		<li>You can only vote once per Quote</li>
		<li>Once you vote, an unvote botton will appear so that you can remove your vote.</li>
	</ul>
	<h3>I forgot my password</h3>
	<ul>
		<li>If you have forgotten your password please visit <a href="{{ URL::to('password/remind') }}">Forgot your password?</a>. A password reset link will be sent to the email you provided at registration.</li>
		<li>If you are still having troubles, please contact <a href='https://twitter.com/tjbenator'>@tjbenator</a>.</li>
	</ul>


</div>
@stop