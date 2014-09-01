<div class='quote'>
<a href='{{ URL::route('user.dashboard.account')}}'>Edit Account<span class='fa fa-cog fa-spin'></span></a><br />
<a href='{{ URL::route('user.dashboard.profile')}}'>Edit Profile<span class='fa fa-cog fa-spin'></span></a>
</div>
<div class='quote clear col-2'>
<strong>Quote Status</strong><br />
@if($quotes->count() > 0)
	<p>
	@foreach($quotes->get() as $quote)
		@if ($quote->status == 1)
			<span class='status approved'>[Approved] <i class='fa fa-thumbs-o-up'></i></span> 
		@elseif ($quote->status == 0)
			<span class='status pending'>[Pending] <i class='fa fa-spinner fa-spin'></i></span>
		@elseif ($quote->status == -1)
			<span class='status denied'>[Denied] <i class='fa fa-thumbs-o-down'></i></span>
		@endif
		<a href='{{ URL::route('quote', [$quote->id]) }}'>#{{ $quote->id }}</a> {{ $quote->title }}<br />
	@endforeach
	</p>
@else
	<p>You have no quotes.</p>
@endif
</div>
@if(Auth::user()->can(['quote.approve', 'quote.deny']))
<div class='quote col-2'>
	<strong>Moderate Quotes</strong><br />
	@if($moderatequotes->count() > 0)	
		<p>
		@foreach($moderatequotes->get() as $quote)
			@if ($quote->status == 1)
				<span class='status approved'>[Approved] <i class='fa fa-thumbs-o-up'></i></span> 
			@elseif ($quote->status == 0)
				<span class='status pending'>[Pending] <i class='fa fa-spinner fa-spin'></i></span>
			@elseif ($quote->status == -1)
				<span class='status denied'>[Denied] <i class='fa fa-thumbs-o-down'></i></span>
			@endif
			<a href='{{ URL::route('quote', [$quote->id]) }}'>#{{ $quote->id }}</a> {{ $quote->title }}<br />
		@endforeach
		</p>
	@else
		<p>No quotes to moderate.</p>
	@endif
@endif
</div>