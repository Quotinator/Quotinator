@foreach($quotes as $quote)
	@include('templates.partials.quote', array('quote' => $quote))
@endforeach
{{ $quotes->links() }}