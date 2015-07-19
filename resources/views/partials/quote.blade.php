<div class='quote'>
	<div id='{{ $quote->id }}'></div>
	<a href='{{ URL::route('user.profile', [$quote->user->username]) }}' title="View {{ $quote->user->username }}'s profile">
		<img class='avatar' alt='{{ $quote->user->username }}' src='{{ $quote->user->avatar }}' />
	</a>
	<span class='title'>
		<a href='{{ URL::route('quote', [$quote->id]) }}'>#{{ $quote->id }}</a>
		{{ $quote->title }}
		@if($quote->isFavored())
			<a target="_blank" href='#' title='Remove Favorite'><i class='fa fa-star favorite'></i></a>
		@else
			<a target="_blank" href='#' title='Make Favorite'><i class='fa fa-star-o favorite'></i></a>
		@endif

		@if($quote->status <= 0)
			@if ($quote->user == Auth::User())
				<a href="#"><i class='fa fa-pencil'></i></a>
			@endif
		@endif

		@if($quote->status == 0)
			<span class='pending'>[Pending] <i class='fa fa-spinner fa-spin'></i></span>
		@elseif ($quote->status == -1)
			<span class='denied'>[Denied] <i class='fa fa-thumbs-o-down'></i></span>
		@endif

	</span>
	<br />
	<span class='poster'>Quoted by <a href='{{ URL::route('user.profile', [$quote->user->username]) }}'>{{ $quote->user->username }}</a></span>
	<br />
	<em>{{ $quote->created_at->diffForHumans() }}</em>
	<div class='votes'>
		<a target="_blank" href='#' class='upvotes'><i class='fa fa-arrow-up'></i>{{ $quote->upVotes() }}</a>
		&nbsp;|&nbsp;
		<a target="_blank" href='#' class='downvotes'>{{ $quote->downVotes() }}<i class='fa fa-arrow-down'></i></a>
		@if(true)
		&nbsp;|&nbsp;
		<a target="_blank" href='#' class='unvote' title='Remove Vote'><i class='fa fa-eraser'></i></a>
		@endif
	</div>

	<pre class='quotetext clear' onfocus='copyClipboard(this);'>{{ $quote->quote }}</pre>
</div>
