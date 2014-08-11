@extends('templates.default')

@section('content')
	@include('templates.partials.quote', array('quote' => $quote))
@stop