@extends('layouts.master')

@section('title', $title)

@section('content')
    @foreach($quotes as $quote)
      @include('partials.quote', array('quote' => $quote))
    @endforeach
    {!! $quotes->render() !!}
@endsection
