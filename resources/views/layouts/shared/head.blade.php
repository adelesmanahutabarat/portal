<!-- Shortcut Icon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/logo.png') }}">

@yield('css')
<!-- App css -->
<link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@if(isset($isDark) && $isDark)
<link href="{{ URL::asset('assets/css/backend-dark.min.css') }}" rel="stylesheet" type="text/css" />
{{-- <link href="{{ URL::asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" /> --}}
@else
<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
@endif
