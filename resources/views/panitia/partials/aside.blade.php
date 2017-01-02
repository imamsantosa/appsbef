<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{route('panitia_photo_profile')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth('panitia')->user()->fullname}}</p>
                <span>{{auth('panitia')->user()->role->nama}}</span>
            </div>
        </div>
        <ul class="sidebar-menu">
            {{--dashboard--}}
            <li class="{{(isset($dashboard))?"active":""}} treeview">
                <a href="{{route('panitia_home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{(isset($peserta_aktif) || isset($peserta_verifikasi))?"active":""}}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Data Peserta</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{(isset($peserta_aktif))?"active":""}}"><a href="{{route('panitia_data_peserta_aktif')}}"><i class="fa fa-circle-o"></i> Semua Peserta</a></li>
                    <li class="{{(isset($peserta_verifikasi))?"active":""}}"><a href="{{route('panitia_data_peserta_verifikasi')}}"><i class="fa fa-circle-o"></i> Verifikasi Peserta</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Data Panitia</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Semua Panitia</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Data Universitas Expo</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Semua Universitas Expo</a></li>
                </ul>
            </li>

        </ul>
    </section>
</aside>