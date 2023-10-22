<div class="topbar">
    <!-- Start row -->
    <div class="row align-items-center">
        <!-- Start col -->
        <div class="col-md-12 align-self-center">
            <div class="togglebar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <div class="menubar">
                            <a class="menu-hamburger" href="javascript:void();">
                               <img src="{{asset('admin/assets/images/svg-icon/collapse.svg')}}" class="img-fluid menu-hamburger-collapse" alt="collapse">
                               <img src="{{asset('admin/assets/images/svg-icon/close.svg')}}" class="img-fluid menu-hamburger-close" alt="close">
                             </a>
                         </div>
                    </li>
                </ul>
            </div>
            <div class="infobar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item mt-2">
                        <div class="profilebar">
                            <div class="dropdown">
                              <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('admin/assets/images/users/profile.svg')}}" class="img-fluid" alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                    <div class="dropdown-item">
                                        <div class="profilename">
                                          <h5>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h5>
                                        </div>
                                    </div>
                                    <div class="userbox">
                                        <ul class="list-unstyled mb-0">
                                            @if (Auth::user()->isSuperAdmin())
                                                <li class="d-flex p-2 mt-1  dropdown-item">
                                                    <a href="{{route('profile.index')}}" class="profile-icon"><img src="{{asset('admin/assets/images/svg-icon/user.svg')}}" class="img-fluid" alt="user">My Profile</a>
                                                </li>
                                            @endif
                                            <li class="d-flex p-2 mt-1  dropdown-item">
                                                <a href="#" class="profile-icon" data-bs-toggle="modal" data-bs-target=".bd-logout-modal-sm"><img src="{{asset('admin/assets/images/svg-icon/logout.svg')}}" class="img-fluid" alt="logout">Logout</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
