@extends('templates.page')

@section('pagetitle', 'Dashboard')
@section('content')
<div class='quote'>
<a href='{{ URL::route('user.dashboard.account')}}'>Edit Account<span class='fa fa-cog fa-spin'></span></a><br />
<a href='{{ URL::route('user.dashboard.profile')}}'>Edit Profile<span class='fa fa-cog fa-spin'></span></a>
</div>
@stop