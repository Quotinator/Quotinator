<div class='quote'>
	<a name='{{ $quote->id }}'></a>
	<img class='avatar' src='{{ $quote->user->avatar }}' />
	<span class='title'>
		<a href='{{ $quote->id }}'>#{{ $quote->id }}</a>
		{{ $quote->title }}
	</span>
	<br />
	<span class='poster'>Posted by <a href='{{ URL::route('user', [$quote->user->username]) }}'>{{ $quote->user->username }}</a></span>
	<br />
	<em>{{ $quote->created_at }}</em>
	<div class='votes'>
		<a href='#' class='upvotes'><i class='fa fa-arrow-up'></i>{{ $quote->upVotes() }}</a>
		&nbsp;|&nbsp;
		<a href='#' class='downvotes'>{{ $quote->downVotes() }}<i class='fa fa-arrow-down'></i></a>
		&nbsp;|&nbsp;{{ $quote->totalVotes() }}
	</div>
	<br />
	<pre class='quotetext' onfocus='copyClipboard(this);'>{{ $quote->quote }}</pre>
</div>