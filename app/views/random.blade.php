@foreach($quotes as $quote)
	@include('templates.partials.quote', array('quote' => $quote))
@endforeach
<div class='quote'>
	<a href="{{ URL::route('random')}}"><span class="fa fa-random fa-3x"></span></a>
</div>