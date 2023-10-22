<div class="navigationbar">
    <ul class="vertical-menu">
        <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
            <a href="{{route('dashboard')}}">
                <i class="fa fa-dashboard"></i><span>Dashboard</span>
            </a>
        </li>

        @can('can-view-clinic')
        <li class="nav-item {{ (request()->is('clinics*')) ? 'active' : '' }}">
            <a href="{{route('clinics.index')}}">
                <i class="fa fa-building"></i><span>Clinics</span>
            </a>
        </li>
        @endcan

        @can('can-view-role')
        <li class="nav-item {{ (request()->is('roles*')) ? 'active' : '' }}">
            <a href="{{route('roles.index')}}">
                <i class="fa fa-vcard"></i><span>Roles</span>
            </a>
        </li>
        @endcan

        @can('can-view-user')
        <li class="nav-item {{ (request()->is('users*')) ? 'active' : '' }}">
            <a href="{{route('users.index')}}">
                <i class="fa fa-users"></i><span>Users</span>
            </a>
        </li>
        @endcan

        @can('can-view-appointment')
        <li class="nav-item {{ (request()->is('appointments*')) ? 'active' : '' }}">
            <a href="{{route('appointments.index')}}">
                <i class="fa fa-file-text"></i><span>Appointments</span>
            </a>
        </li>
        @endcan

        <li>
            <a href="javaScript:void();">
                <i class="fa fa-list-alt"></i><span>Page Operations</span><i class="feather icon-chevron-right pull-right"></i>
            </a>
            <ul class="vertical-submenu">
                @can('can-view-clinic-alert')
                <li class="nav-item {{ (request()->is('clinic-alerts*')) ? 'active' : '' }}">
                    <a href="{{route('clinic-alerts.index')}}">
                        <i class="fa fa-bell"></i><span>Clinic Alerts</span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>

    </ul>
</div>
