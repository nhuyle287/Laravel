@inject('request', 'Illuminate\Http\Request')

<aside class="main-sidebar sidebar-dark-light elevation-5"
       style="background-image: linear-gradient(to top, #83abda, rgb(22, 53, 138));box-shadow: 0 5rem   #83abda!important">
    <!-- Brand Logo -->
    <a href="#" class="brand-link image" style="background-color: rgb(22, 53, 138);">
        <img src="images/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-2"
            >
        <span class="brand-text font-weight-light text-capitalize">{{Auth::user()->name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
{{--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--            <div class="image">--}}
{{--                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
{{--            </div>--}}
{{--            <div class="info">--}}
{{--                <a href="#" class="d-block"></a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @can('customer-access')
                    <li class="nav-item has-treeview " style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="{{route("admin.customers.index")}}"
                           class="nav-link {{ $request->segment(2) == 'customers' ? 'active active-sub' : '' }}">
                            <i class="fa fa-child"></i>
                            <p>
                                Khách hàng
                            </p>
                        </a>
                    </li>
                @endcan
                @can('medicine-access')
                    <li class="nav-item has-treeview " style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="{{route("admin.medicines.index")}}"
                           class="nav-link {{ $request->segment(2) == 'medicines' ? 'active active-sub' : '' }}">
                            <i class="fas fa-pills"></i>
                            <p>
                                Thuốc
                            </p>
                        </a>
                    </li>
                @endcan
                @can('list-medicine-management-access')
                    <li class="nav-item has-treeview {{ ($request->segment(2) == 'history-examinations' || $request->segment(2) == 'medical-examinations' ) ? 'menu-open' : '' }}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fas fa-briefcase-medical"></i>
                            <p>
                                Quản lý khám bệnh
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview " style="background-color: rgb(22, 53, 138)">
                            @can('list-medicine-access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.history-examinations.index") }}"
                                       class="nav-link {{ $request->segment(2) == 'history-examinations' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-user-friends"></i>
                                        <p>Lịch sử khám</p>
                                    </a>
                                </li>

                            @endcan
                            @can('medical-examination-access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.medical-examinations.index") }}"
                                       class="nav-link {{ $request->segment(2) == 'medical-examinations' ? 'active active-sub' : '' }}">
                                        <i class="nav-icon fas fa-users-cog"></i>
                                        <p>Danh sách khám bệnh</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan
                @can('customer-access')
                    <li class="nav-item has-treeview " style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="{{ route("admin.expenditure.index") }}"
                           class="nav-link {{ $request->segment(2) == 'expenditure' ? 'active active-sub' : '' }}">
                            <i class="fa fa-child"></i>
                            <p>Quản lý phiếu chi</p>
                        </a>
                    </li>
                @endcan

                @can('staff-management-access')
                    <li class="nav-item has-treeview {{ ($request->segment(2) == 'staffs' || $request->segment(2) == 'positions' ) ? 'menu-open' : '' }}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-tie"></i>
                            <p>
                                Quản lý nhân viên
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview " style="background-color: rgb(22, 53, 138)">
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
                {{--

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
                @endcan --}}
                @can('user-management-access')
                    <li class="nav-item has-treeview {{ ($request->segment(2) == 'roles' ||  $request->segment(2) == 'permissions' ||  $request->segment(2) == 'users') ? 'menu-open' : '' }}" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
                        <a href="#" class="nav-link">
                            <i class="fa fa-users"></i>
                            <p>
                                {{ __('sidebar.user-management') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="background-color: rgb(22, 53, 138)">
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
                <li class="nav-item" style="background-color: #a9a9a95e; margin-bottom: 0.25rem">
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
