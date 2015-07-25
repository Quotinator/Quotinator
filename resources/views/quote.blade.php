@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
      @include('partials.quote', array('quote' => $quote))
@endsection
