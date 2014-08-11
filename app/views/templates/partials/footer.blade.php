</div>
<div id='footer' class='clear'>
	<div class='col'>
		<div id='trademark'>{{ Config::get('settings.copyright') }}</div>
	</div>
	<div class='col'>
		<ul class='nav'>
			<li><a href='{{ URL::route('about') }}'>About</a></li>
			<li><a class='button' href='{{ URL::route('help') }}'>Help&nbsp;<span class="fa fa-book"></span>&nbsp;</a></li>
		</ul>
	</div>
	<div class='clear full-width'>
		<img class='DO' src='{{ asset('img/DO_Proudly_Hosted_Badge_White-0f0151a4.png') }}' />
	</div>
</div>
</div>
</body>
</html>