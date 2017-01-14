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
                <span>{{auth('panitia')->user()->role->nama}}</span><br>
                <small>{{auth('panitia')->user()->panlok->nama}}</small>
            </div>
        </div>
        <ul class="sidebar-menu">
            {{--dashboard--}}
            <li class="{{(isset($dashboard))?"active":""}} treeview">
                <a href="{{route('panitia_home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{(isset($peserta_aktif) || isset($peserta_verifikasi) || isset($rekap))?"active":""}}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Data Peserta</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{(isset($peserta_aktif))?"active":""}}"><a href="{{route('panitia_data_peserta_aktif')}}"><i class="fa fa-circle-o"></i> Semua Peserta</a></li>
                    @if(auth('panitia')->user()->role_id != 3)
                        <li class="{{(isset($peserta_verifikasi))?"active":""}}"><a href="{{route('panitia_data_peserta_verifikasi')}}"><i class="fa fa-circle-o"></i> Verifikasi Peserta</a></li>
                        <li class="{{(isset($rekap))?"active":""}}"><a href="{{route('panitia_data_peserta_rekap')}}"><i class="fa fa-circle-o"></i> Rekap Peserta</a></li>
                    @endif
                </ul>
            </li>

            <li class="treeview {{(isset($panitia_all))?"active":""}}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Data Panitia</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{(isset($panitia_all))?"active":""}}"><a href="{{route('panitia_data_panitia_semua')}}"><i class="fa fa-circle-o"></i> Semua Panitia</a></li>
                </ul>
            </li>

            <li class="treeview {{(isset($expo) || isset($expo_tampil))?"active":""}}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Data Universitas Expo</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="{{(isset($expo))?"active":""}}"><a href="{{route('panitia_data_expo')}}"><i class="fa fa-circle-o"></i> Semua Universitas Expo</a></li>
                    {{--<li class="{{(isset($expo_tampil))?"active":""}}"><a href="{{route('panitia_tampil_expo')}}"><i class="fa fa-circle-o"></i> Tampil Expo (Chat App)</a></li>--}}
                </ul>
            </li>

            @if(auth('panitia')->user()->role_id != 3)
            <li class="{{(isset($konfig))?"active":""}} treeview">
                <a href="{{route('panitia_konfigurasi')}}">
                    <i class="fa fa-gear"></i> <span>Konfigurasi</span>
                </a>
            </li>
            @endif

        </ul>
    </section>
</aside>