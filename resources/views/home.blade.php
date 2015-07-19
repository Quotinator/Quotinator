@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
    @foreach($quotes as $quote)
      @include('partials.quote', array('quote' => $quote))
    @endforeach
@endsection
