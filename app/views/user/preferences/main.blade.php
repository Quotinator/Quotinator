@extends('templates.page')

@section('pagetitle', 'Preferences')
@section('content')
<a href='{{ URL::route('user.preferences.account')}}'>Edit Account<span class='fa fa-cog fa-spin'></span></a><br />
<a href='{{ URL::route('user.preferences.profile')}}'>Edit Profile<span class='fa fa-cog fa-spin'></span></a>
@stop