<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<title>{{ (isset($title) ? $title . ' | ' : null) . Config::get('settings.site_title') }}</title>

	<!-- Custom styling -->
	<link rel="stylesheet" href="{{ elixir('css/all.css') }}">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>
	<div id='wrap'>
		<div id='header'>
			<div id='brand'>
				<h1><a href='/'>{{ Config::get('settings.site_title') }}</a></h1>
				<em class='subtitle'>{{ Config::get('settings.site_sub_title') }}</em>
			</div>

			<div id='head-right'>
				<div id='searchdiv'>
					{!! Form::open(array('route' => 'home')) !!}
						{!! Form::submit("&#9654;", array('class' => 'search')) !!}
						{!! Form::text('search', Session::get('search', ''), array('class' => 'search', 'placeholder' => 'Search...')) !!}
					{!! Form::close() !!}
				</div>
				@if( Auth::check() )
					<a href='#'>
						<img class='myavatar' title='My Profile' src='{{ Auth::User()->avatar() }}'>
					</a>
				@endif
			</div>
		</div>

		<ul class='nav clear'>

			<li><a class='button' href='{{ URL::route('home') }}'>Home&nbsp;<span class="fa fa-home"></span></a></li>
			@if( Auth::check() )

			<li><a class='button' href='{{-- URL::route('user.favorites', [Auth::User()->username]) --}}'>Favorites&nbsp;<span class="fa fa-star"></span></a></li>
			<li><a class='button' href='{{-- URL::route('submit') --}}'>Submit&nbsp;<span class="fa fa-pencil"></span></a></li>
			<li><a class='button' href='{{-- URL::route('user.dashboard') --}}'>Dashboard&nbsp;<span class="fa fa-dashboard"></span></a></li>

			<li><a class='button' href='{{ url('/auth/logout') }}'>Logout&nbsp;<span class="fa fa-sign-out"></span></a></li>
			@else
			<li><a class='button' href='{{ url('/auth/login') }}'>Login&nbsp;<span class="fa fa-sign-in"></span></a></li>
			<li><a class='button eye-catching' href='{{ url('/auth/register') }}'>Register</a></li>
			@endif
		</ul>
		<h2>{{ (isset($title) ? $title : null) }}</h2>
		<div class='quotes'>
		@if (count($errors) > 0)
			<div class='quote'>
			@foreach ($errors->all() as $error)
				{{ $error }} <br />
			@endforeach
			</div>
		@endif
