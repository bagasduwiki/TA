<div class="ml-auto" style="width: max-content;">
    <nav style=" right:25px; top:20px; padding-left:10px; padding-right:10px;">
        <ul class="navbar-nav ml-auto">
            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->nama_pendek }}</span>
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                </a>
                <!-- Dropdown - User Information -->
            {{--                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">--}}

            {{--        <a type="button" style="outline: none;" class="dropdown-item" href="{{ route('profile.show') }}">--}}
            {{--            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>--}}
            {{--            Edit Profile--}}
            {{--          </a> --}}
            <!-- <div class="dropdown-divider"></div> -->

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('showProfile')}}"> <i
                            class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile</a>
                    <a class="dropdown-item" href="{{route('indexSandi')}}"><i
                            class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i> Ubah Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
                {{--                    <form method="POST" action="{{ route('logout') }}">--}}
                {{--                        @csrf--}}
                {{--                        <a class="dropdown-item" href="{{ route('logout') }}"--}}
                {{--                           onclick="event.preventDefault(); this.closest('form').submit();">--}}

                {{--                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>--}}
                {{--                            {{ __('Logout') }}--}}
                {{--                        </a>--}}
                {{--                    </form>--}}
                {{--                </div>--}}
            </li>

        </ul>
    </nav>
</div>
