@extends('layouts.master')

@section('title', $title)

@section('content')
    @include('partials.quotes', array('quotes' => $quotes))
@endsection
