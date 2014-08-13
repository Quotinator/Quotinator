@extends('templates.filtered')
@section('message', Lang::choice('messages.userfavorites', $count, array('username' => $user->username, 'count' => $count)))
