<div class='quote'>
	<a name='{{ $quote->id }}'></a>
	<a href='{{ URL::route('user.profile', [$quote->user->username]) }}' title="View {{ $quote->user->username }}'s profile">
		<img class='avatar' src='{{ $quote->user->avatar }}' />
	</a>
	<span class='title'>
		<a href='{{ URL::route('quote', [$quote->id]) }}'>#{{ $quote->id }}</a>
		{{ $quote->title }}
	</span>
	<br />
	<span class='poster'>Posted by <a href='{{ URL::route('user.profile', [$quote->user->username]) }}'>{{ $quote->user->username }}</a></span>
	<br />
	<em>{{ $quote->created_at }}</em>
	<div class='votes'>
		<a href='?upvote={{ $quote->id }}' class='upvotes'><i class='fa fa-arrow-up'></i>{{ $quote->upVotes() }}</a>
		&nbsp;|&nbsp;
		<a href='?downvote={{ $quote->id }}' class='downvotes'>{{ $quote->downVotes() }}<i class='fa fa-arrow-down'></i></a>
		@if($quote->didAuthVote())
		&nbsp;|&nbsp;
		<a href='?unvote={{ $quote->id }}' class='unvote' title='Remove Vote'><i class='fa fa-eraser'></i></a>
		@endif
	</div>
	<pre class='quotetext clear' onfocus='copyClipboard(this);'>{{ $quote->quote }}</pre>
</div>