@extends('templates.default')

@section('content')
	<div class='quote'>
	{{ Lang::choice('messages.userquotes', $count, array('username' => $user->username, 'count' => $count)) }}
	</div>
	@foreach($quotes as $quote)
		@include('templates.partials.quote', array('quote' => $quote))
	@endforeach
	{{ $quotes->links() }}
@stop