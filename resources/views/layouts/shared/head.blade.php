<!-- Shortcut Icon -->
<link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">
<link rel="icon" type="image/ico" href="{{asset('assets/images/favicon.png')}}" />

@yield('css')
<!-- App css -->
<link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
@if(isset($isDark) && $isDark)
<link href="{{ URL::asset('assets/css/backend-dark.min.css') }}" rel="stylesheet" type="text/css" />
{{-- <link href="{{ URL::asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" /> --}}
@else
<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
@endif
