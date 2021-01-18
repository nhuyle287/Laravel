@inject('request', 'Illuminate\Http\Request')

<aside class="main-sidebar sidebar-dark-light elevation-5"
       style="background-image: linear-gradient(to top,rgb(22 ,138, 106), #28a745);box-shadow: 0 5rem  rgb(22 ,138, 106)!important">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="background-color: #28a745;">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                @can('customer-access')
                    <li class="nav-item has-treeview " style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="{{ route("admin.customers.index") }}"
                           class="nav-link {{ $request->segment(2) == 'customers' ? 'active active-sub' : '' }}">
                            <i class="fa fa-child"></i>
                            <p>
                                Khách hàng
                            </p>
                        </a>
                    </li>
                @endcan
                @can('list-service-management-access')
                    <li class="nav-item has-treeview " style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="{{route("admin.list-services.index")}}"
                           class="nav-link {{ ($request->segment(2) == 'list-services' && $request->segment(3) == 'index' )? 'active active-sub' : '' }}">
                            <i class="fas fa-list"></i>
                            <p>
                                Dịch vụ đang sử dụng
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview  {{ $request->segment(3) == 'registerdomain' ? 'menu-open' : '' }}
                        || {{ $request->segment(3) == 'registerhosting' ? 'menu-open' : '' }}
                        || {{ $request->segment(3) == 'registervps' ? 'menu-open' : '' }}
                        || {{ $request->segment(3) == 'registeremail' ? 'menu-open' : '' }}
                        || {{ $request->segment(3) == 'registerssl' ? 'menu-open' : '' }}
                        || {{ $request->segment(3) == 'registerwebsite' ? 'menu-open' : '' }}
                        || {{ $request->segment(2) == 'register-softs' ? 'menu-open' : '' }}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fa fa-paper-plane"></i>
                            <p>
                                Đăng ký mới
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview " id="nav-item" style="background-color:#347C2C">

                            @can('register-domain-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.list-services.registerdomain")}}"
                                       class="nav-link {{ $request->segment(3) == 'registerdomain' ? 'active active-sub' : '' }}">
                                        <i class="fas fa-registered"></i>
                                        <p>Đăng ký mới Domain</p>
                                    </a>
                                </li>
                            @endcan
                            @can('register-hosting-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.list-services.registerhosting")}}"
                                       class="nav-link {{ $request->segment(3) == 'registerhosting' ? 'active active-sub' : '' }}">
                                        <i class="fas fa-registered"></i>
                                        <p>Đăng ký mới Hosting</p>
                                    </a>
                                </li>
                            @endcan
                            @can('register-vps-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.list-services.registervps")}}"
                                       class="nav-link {{ $request->segment(3) == 'registervps' ? 'active active-sub' : '' }}">
                                        <i class="fas fa-registered"></i>
                                        <p>Đăng ký mới VPS</p>
                                    </a>
                                </li>
                            @endcan
                            @can('register-email-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.list-services.registeremail")}}"
                                       class="nav-link {{ $request->segment(3) == 'registeremail' ? 'active active-sub' : '' }}">
                                        <i class="fas fa-registered"></i>
                                        <p>Đăng ký mới Email</p>
                                    </a>
                                </li>
                            @endcan
                            @can('register-ssl-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.list-services.registerssl")}}"
                                       class="nav-link {{ $request->segment(3) == 'registerssl' ? 'active active-sub' : '' }}">
                                        <i class="fas fa-registered"></i>
                                        <p>Đăng ký mới SSL</p>
                                    </a>
                                </li>
                            @endcan
                            @can('register-website-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.list-services.registerwebsite")}}"
                                       class="nav-link {{ $request->segment(3) == 'registerwebsite' ? 'active active-sub' : '' }}">
                                        <i class="fas fa-registered"></i>
                                        <p>Đăng ký mới Website</p>
                                    </a>
                                </li>
                            @endcan
                            @can('register-soft-access')
                                <li class="nav-item "
                                    style="margin-bottom: 3px;">
                                    <a href="{{route("admin.register-softs.create")}}"
                                       class="nav-link {{ $request->segment(2) == 'register-softs' ? 'active active-sub' : '' }}">
                                        <i class="fas fa-laptop-medical"></i>
                                        <p>
                                            Đăng ký mới phần mềm
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('order-management-access')
                    <li class="nav-item has-treeview {{ $request->segment(2) == 'order' ? 'menu-open' : '' }}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fab fa-first-order"></i>
                            <p>
                                Quản lý đơn hàng
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview " id="nav-item" style="background-color:#347C2C">
                            @can('order-service-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.order.services")}}"
                                       class="nav-link {{($request->segment(2) == 'order' && $request->segment(3)=='services') ? 'active active-sub' : '' }}">
                                        <i class="fa fa-list"></i>
                                        <p>Đơn hàng dịch vụ</p>
                                    </a>
                                </li>
                            @endcan
                            @can('order-software-access')
                                <li class="nav-item">
                                    <a href="{{route("admin.order.software")}}"
                                       class="nav-link {{($request->segment(2) == 'order' && $request->segment(3)=='software') ? 'active active-sub' : '' }}">
                                        <i class="fa fa-list"></i>
                                        <p>
                                            Đơn hàng phần mềm
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('invoice-management-access')
                    <li class="nav-item has-treeview {{ $request->segment(2) == 'invoices' ? 'menu-open' : '' }} || {{ $request->segment(2) == 'revenue' ? 'menu-open' : '' }} || {{ $request->segment(2) == 'expenditure' ? 'menu-open' : '' }}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fas fa-book-dead"></i>
                            <p>
                                Quản lý hóa sổ quỹ
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview " id="nav-item" style="background-color:#347C2C">
                            @can('receipt-access')
                                <li class="nav-item">
                                    <a href="{{route("admin.invoices.receipts")}}"
                                       class="nav-link {{ $request->segment(2) == 'invoices' ? 'active active-sub' : '' }}">
                                        <i class="fas fa-list"></i>
                                        <p>
                                            Danh sách sổ quỹ
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('revenue-access')
                                <li class="nav-item">
                                    <a href="{{route("admin.revenue.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'revenue' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>
                                            Phiếu thu
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expenditure-access')
                                <li class="nav-item">
                                    <a href="{{route("admin.expenditure.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'expenditure' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>
                                            Phiếu chi
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('service-management-access')
                    <li class="nav-item has-treeview {{ $request->segment(2) == 'domains' ? 'menu-open' : '' }}
                        || {{ $request->segment(2) == 'hostings' ? 'menu-open' : '' }}
                        || {{ $request->segment(2) == 'vpss' ? 'menu-open' : '' }}
                        || {{ $request->segment(2) == 'emails' ? 'menu-open' : '' }}
                        || {{ $request->segment(2) == 'ssls' ? 'menu-open' : '' }}
                        || {{ $request->segment(2) == 'websites' ? 'menu-open' : '' }}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fa fa-briefcase"></i>
                            <p>
                                Quản lý dịch vụ
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview " id="nav-item" style="background-color:#347C2C">
                            @can('domain-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.domains.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'domains' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>Quản lý tên miền</p>
                                    </a>
                                </li>
                            @endcan
                            @can('hosting-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.hostings.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'hostings' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>Quản lý Hosting</p>
                                    </a>
                                </li>
                            @endcan
                            @can('vps-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.vpss.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'vpss' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>Quản lý VPS</p>
                                    </a>
                                </li>
                            @endcan
                            @can('email-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.emails.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'emails' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>Quản lý dịch vụ Email</p>
                                    </a>
                                </li>
                            @endcan
                            @can('ssl-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.ssls.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'ssls' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>Quản lý dịch vụ SSL</p>
                                    </a>
                                </li>
                            @endcan
                            @can('website-access')
                                <li class="nav-item "
                                    style="margin-bottom: 3px;">
                                    <a href="{{route("admin.websites.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'websites' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>Quản lý dịch vụ Website</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('software-management-access')
                    <li class="nav-item has-treeview {{ $request->segment(2) == 'softwares' ? 'menu-open' : '' }}
                        || {{ $request->segment(2) == 'typesoftwares' ? 'menu-open' : '' }}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class=" fas fa-money-check"></i>
                            <p>
                                Quản lý phần mềm
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview " style="background-color: #347C2C">
                            @can('software-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.softwares.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'softwares' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fa fa-gift"></i>
                                        <p>Gói phần mềm</p>
                                    </a>
                                </li>
                            @endcan
                            @can('typesoftware-access')
                                <li class="nav-item "
                                    style="margin-bottom: 3px;">
                                    <a href="{{route("admin.typesoftwares.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'typesoftwares' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fa fa-gift"></i>
                                        <p>Loại phần mềm</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('staff-management-access')
                    <li class="nav-item has-treeview {{ ($request->segment(2) == 'staffs' || $request->segment(2) == 'positions' || $request->segment(2) == 'departments') ? 'menu-open' : '' }}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-tie"></i>
                            <p>
                                Quản lý nhân viên
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview " style="background-color: #347C2C">
                            @can('staff-access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.staffs.index") }}"
                                       class="nav-link {{ $request->segment(2) == 'staffs' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-user-friends"></i>
                                        <p>{{ __('sidebar.staff') }}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('position-access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.positions.index") }}"
                                       class="nav-link {{ $request->segment(2) == 'positions' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-users-cog"></i>
                                        <p>{{ __('sidebar.position') }}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('department-access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.departments.index") }}"
                                       class="nav-link {{ $request->segment(2) == 'departments' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-landmark"></i>
                                        <p>{{ __('sidebar.department') }}</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('internship-management-access')
                    <li class="nav-item has-treeview {{ $request->segment(2) == 'internships' ? 'menu-open' : '' }}
                        || {{ $request->segment(2) == 'internship-topic' ? 'menu-open' : '' }}
                        || {{ $request->segment(2) == 'category-topic' ? 'menu-open' : '' }}
                        || {{ $request->segment(2) == 'topics' ? 'menu-open' : '' }} " style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fa fa-users"></i>
                            <p>
                                Quản lý thực tập sinh
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview " id="nav-item" style="background-color:#347C2C">
                            @can('internship-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.internship.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'internships' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>Danh sách thực tập sinh</p>
                                    </a>
                                </li>
                            @endcan
                            @can('internship-topic-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.internship-topic.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'internship-topic' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>Danh sách đang thực tập</p>
                                    </a>
                                </li>
                            @endcan
                            @can('category-topic-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.category-topic.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'category-topic' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>Quản lý danh mục đề tài</p>
                                    </a>
                                </li>
                            @endcan
                            @can('topic-access')
                                <li class="nav-item "
                                    style="margin-bottom: 3px;">
                                    <a href="{{route("admin.topic.index")}}"
                                       class="nav-link {{ $request->segment(2) == 'topic' ? 'active active-sub' : '' }}">
                                        <i class="fa fa-gift"></i>
                                        <p>Quản lý danh sách đề tài</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('contract-management-access')
                    <li class="nav-item has-treeview {{ $request->segment(3) == 'software' && $request->segment(2) == 'contract' ? 'menu-open' : '' }}
                        || {{($request->segment(3) == 'vps' && $request->segment(2) == 'contract') ? 'menu-open' : '' }} || {{ $request->segment(3) == 'hosting' && $request->segment(2) == 'contract' ? 'menu-open' : '' }}
                        || {{ ($request->segment(3) == 'domain' && $request->segment(2) == 'contract') ? 'menu-open' : '' }}
                        || {{$request->segment(2) == 'contract' ? 'menu-open':''}}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-contract"></i>
                            <p>Hợp đồng <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview " id="nav-item" style="background-color:#347C2C">
                            @can('contract-access')
                                <li class="nav-item  ">
                                    <a href="{{route("admin.contract.index")}}"
                                       class="nav-link {{ (($request->segment(2) == 'contract' &&  ( $request->segment(3) == '')) || ($request->segment(2) == 'contract' &&( $request->segment(4) == 'show' || $request->segment(4) == 'edit'))) ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>Danh sách hợp đồng</p>
                                    </a>
                                </li>
                            @endcan
                            @can('contract-software-access')
                                <li class="nav-item ">
                                    <a href="{{route("admin.contract.software")}}"
                                       class="nav-link {{ $request->segment(3) == 'software' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-registered"></i>
                                        <p>Tạo mới HĐ Thiết kế Web</p>
                                    </a>
                                </li>
                            @endcan
                            @can('contract-vps-access')
                                <li class="nav-item  ">
                                    <a href="{{route("admin.contract.vps")}}"
                                       class="nav-link {{ $request->segment(3) == 'vps' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-registered"></i>
                                        <p>Tạo mới HĐ VPS</p>
                                    </a>
                                </li>
                            @endcan
                            @can('contract-hosting-access')
                                <li class="nav-item  ">
                                    <a href="{{route("admin.contract.hosting")}}"
                                       class="nav-link {{ $request->segment(3) == 'hosting' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-registered"></i>
                                        <p>Tạo mới HĐ Hosting</p>
                                    </a>
                                </li>
                            @endcan
                            @can('contract-domain-access')
                                <li class="nav-item  "
                                    style="margin-bottom: 3px;">
                                    <a href="{{route("admin.contract.domain")}}"
                                       class="nav-link {{ $request->segment(3) == 'domain' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-registered"></i>
                                        <p>Tạo mới HĐ Tên miền</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user-management-access')
                    <li class="nav-item has-treeview {{ ($request->segment(2) == 'roles' ||  $request->segment(2) == 'permissions' ||  $request->segment(2) == 'users') ? 'menu-open' : '' }}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fa fa-users"></i>
                            <p>
                                {{ __('sidebar.user-management') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="background-color: #347C2C">
                            @can('permission-access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.permissions.index') }}"
                                       class="nav-link {{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon far fa-user"></i>
                                        <p>{{ __('sidebar.permissions') }}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('role-access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                       class="nav-link {{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-user-secret"></i>
                                        <p>{{ __('sidebar.roles') }}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('user-access')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}"
                                       class="nav-link {{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon far fa-user"></i>
                                        <p>{{ __('sidebar.users') }}</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                    <a class="nav-link" href="javascript:" onclick="$('#logout').submit();">
                        <i class="fa fa-power-off"></i> <span>  {{ __('sidebar.logout') }}</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>

            </ul>
            <form method="post" id="logout" action="{{route('logout')}}" style="display: none">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
