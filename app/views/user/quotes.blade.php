@extends('templates.filtered')
@section('message', Lang::choice('messages.userquotes', $count, array('username' => $user->username, 'count' => $count)))
