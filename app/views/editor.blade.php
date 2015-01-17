<div class='quote'>
{{ isset($quote) ? Form::model($quote, array('route' => ['edit', $quote->id])) : Form::open(array('url' => 'submit')) }}
	{{ Form::token() }}
	{{ Form::label('title', 'Title') }}
	{{ Form::text('title', Input::old('title'), array('placeholder' => 'Quote Title')) }}

	{{ Form::label('quote', 'Quote') }}
	{{ Form::textarea('quote', Input::old('quote'), array('placeholder' => 'Quote Body')) }}

{{ Form::submit('Submit!') }}
{{ Form::close() }}
</div>