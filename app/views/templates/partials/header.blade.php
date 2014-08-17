<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<title>{{ Config::get('settings.site_title') }}</title>

	<!-- Custom styling -->
	{{ HTML::style('css/main.css'); }}
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

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
					{{ Form::open(array('route' => 'search')) }}
						{{ Form::submit("&#9654;", array('class' => 'search'))}}
						{{ Form::text('search', Session::get('search', ''), array('class' => 'search', 'placeholder' => 'Search...'))}}
					{{ Form::close() }}
				</div>
				@if( Auth::check() )
					<a href='{{ URL::route('user.profile', [Auth::User()->username]) }}'>
						<img class='myavatar' title='My Profile' src='{{ Auth::User()->avatar }}'>
					</a>
				@endif
			</div>
		</div>

		<ul class='nav clear'>

			<li><a class='button' href='{{ URL::route('home') }}'>Home&nbsp;<span class="fa fa-home"></span></a></li>
			<li><a class='button' href='{{ URL::route('top') }}'>Top&nbsp;<span class="fa fa-arrow-up"></span></a></li>
			<li><a class='button' href='{{ URL::route('random') }}'>Random&nbsp;<span class="fa fa-random"></span></a></li>

			@if( Auth::check() )

			<li><a class='button' href='{{ URL::route('user.favorites', [Auth::User()->username]) }}'>Favorites&nbsp;<span class="fa fa-star"></span></a></li>
			<li><a class='button' href='{{ URL::route('submit') }}'>Submit&nbsp;<span class="fa fa-pencil"></span></a></li>
			<li><a class='button' href='{{ URL::route('user.preferences') }}'>Preferences&nbsp;<span class="fa fa-cog fa-spin"></span></a></li>
				@if( Auth::user()->can('moderate.bot'))
					<li><a class='button' href='#'>Penguin</a></li>
					<li><a class='button' href='#'>Herobrine</a></li>
				@endif

			<li><a class='button' href='{{ URL::route('logout') }}'>Logout&nbsp;<span class="fa fa-sign-out"></span></a></li>
			@else
			<li><a class='button' href='{{ URL::route('login') }}'>Login&nbsp;<span class="fa fa-sign-in"></span></a></li>
			<li><a class='button eye-catching' href='{{ URL::route('register') }}'>Register</a></li>
			@endif
		</ul>
		<h2>@yield('pagetitle')</h2>
		<div class='quotes'>
		@if (count($errors) > 0)
			<div class='quote'>
			@foreach ($errors->all() as $error)
				{{ $error }} <br />
			@endforeach
			</div>
		@endif