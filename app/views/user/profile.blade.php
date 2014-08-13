@extends('templates.page')

@section('pagetitle', $user->username . '\'s profile')
@section('content')
<img class='avatar' src='{{ $user->avatar }}' />
<span class='title'></span>
<a class='button' href='{{ URL::route('user.quotes', [$user->username]) }}'>Submitted Quotes&nbsp;<span class="fa fa-pencil"></span></a><br />
<a class='button' href='{{ URL::route('user.favorites', [$user->username]) }}'>Favorites&nbsp;<span class="fa fa-star"></span></a>
<div class='clear'></div>
@if($user->about)
<h4>About me</h4>
<pre>{{ $user->about }}</pre>
@endif
@stop