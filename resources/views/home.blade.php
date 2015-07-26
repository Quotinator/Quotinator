@extends('layouts.master')

@section('title', $title)

@section('content')
  <div class='quote'>
    <strong>Sort: </strong>
    @sortablelink('title', 'Title') |
    @sortablelink('id', 'ID') |
    @sortablelink('confidence', 'Popularity')
  </div>
  @foreach($quotes as $quote)
    @include('partials.quote', array('quote' => $quote))
  @endforeach
  {!! $quotes->appends(\Input::except('page'))->render() !!}
@endsection
