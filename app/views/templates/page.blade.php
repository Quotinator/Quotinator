@include('templates.partials.header')
<div class='quote'>
		<h2>@yield('pagetitle', 'Page Title')</h2>
        @yield('content', 'No content')
</div>
@include('templates.partials.footer')