@extends('templates.default')

@section('content')
	@foreach($quotes as $quote)
		@include('templates.partials.quote', array('quote' => $quote))
	@endforeach
	{{ $quotes->links() }}
@stop