<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Name - @yield('title')</title>

    @include('restmenu::layouts.admin.resources.styles')
    @stack('style_file')
    @stack('style_custom')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('restmenu::layouts.admin.sections.navbar')

    @include('restmenu::layouts.admin.sections.sidebar')

    @yield('content')

    @include('restmenu::layouts.admin.sections.footer')

    @include('restmenu::layouts.admin.sections.miscbar')

</div>
<!-- ./wrapper -->

@include('restmenu::layouts.admin.resources.scripts')
@stack('script_file')
@stack('script_custom')

</body>
</html>
