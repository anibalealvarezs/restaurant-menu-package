@extends('restmenu::layouts.admin.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('restmenu::layouts.admin.sections.content.header')

    @yield('main')
</div>
<!-- /.content-wrapper -->
@endsection