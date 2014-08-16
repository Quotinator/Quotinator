@extends('templates.filtered')
@section('message', Lang::choice('messages.search', $count, array('terms' => $terms, 'count' => $count)))