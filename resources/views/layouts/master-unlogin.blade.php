<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<body class="login-container">
<!-- Main navbar -->
<div class="login-background">

<div class="navbar navbar-inverse bg-indigo"
     style=" background-image: linear-gradient(to top, rgb(22, 53, 138), #83abda);;">
    <div class="navbar-header">
        <a class="navbar-brand">

            <span class="brand-title">Chào mừng đến phòng mạch Lý Kim Tùng</span>
        </a>
        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

</div>
@yield('content')
</div>
<!-- /page container -->

</body>
</html>
