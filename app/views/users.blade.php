<div class='quote'>
<div class='usertiles'>
@foreach($users as $user)
	<a class='usertile' href='{{ URL::route('user.profile', [$user->username])  }}'>
		<img src='{{ $user->avatar }}' alt='{{ $user->username }}' /><br />
		<div class='title'>{{ $user->username }}</div>
		Quotes: {{ $user->quotes->count() }}
	</a>
@endforeach
</div>
</div>
{{ $users->links() }}