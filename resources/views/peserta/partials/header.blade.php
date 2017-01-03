<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{route('peserta_home')}}" class="navbar-brand"><b>Brebes Education Fair</b> 2017</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">Expo Universitas</a></li>

                </ul>
            </div>
            <div class="navbar-custom-menu">
                @if(auth('peserta')->check())
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{route('peserta_photo_profile')}}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{auth('peserta')->user()->fullname}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="{{route('peserta_photo_profile')}}" class="img-circle" alt="User Image">

                                    <p>
                                        {{auth('peserta')->user()->fullname}}
                                        <small>{{auth('peserta')->user()->StatusPeserta->nama}}</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{route('peserta_profile')}}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{route('peserta_logout')}}" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>