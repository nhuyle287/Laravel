<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<body class="login-container" style="background-image: url('public/images/login.jpg')">
<!-- Main navbar -->
{{-- <div class="navbar navbar-inverse bg-indigo"
     style="background-image: linear-gradient(to top, rgb(22 ,138, 106), #28a745);">
    <div class="navbar-header">
        <a class="navbar-brand">

            <span class="brand-title">Phần mềm Hoa Technology</span>
        </a>
        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

</div> --}}
@yield('content')
<!-- /page container -->

</body>
</html>
