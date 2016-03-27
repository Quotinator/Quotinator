@extends('layouts.master')

@section('title', $title)

@section('content')
<div class='quote'>
    <img class='avatar' src='{{ $user->avatar() }}' />
    <a class='button' href='{{ URL::route('user.quotes', [$user->username]) }}'>Submitted Quotes&nbsp;<span class="fa fa-pencil"></span></a><br />
    <a class='button' href='{{ URL::route('user.favorites', [$user->username]) }}'>Favorites&nbsp;<span class="fa fa-star"></span></a>
    <div class='clear'></div>
</div>

<h3>{{ $user->username }}'s most recent submissions</h3>
@foreach($quotes as $quote)
  @include('partials.quote', array('quote' => $quote))
@endforeach
@endsection
