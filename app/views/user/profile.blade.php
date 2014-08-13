@extends('templates.page')

@section('pagetitle', $user->username . '\'s profile')
@section('content')
<p>
<a class='button' href='{{ URL::route('user.quotes', [$user->username]) }}'>Submitted Quotes&nbsp;<span class="fa fa-pencil"></span></a><br />
<a class='button' href='{{ URL::route('user.favorites', [$user->username]) }}'>Favorites&nbsp;<span class="fa fa-star"></span></a>
</p>
<h4>About {{ $user->username }}</h4>
<p>
	{{ $user->about }}
</p>
@stop