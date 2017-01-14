@extends('peserta.template')

@section('title')
    Login
@endsection

@section('additional-header')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="{{url('plugins/FlipClock-master/compiled/flipclock.min.css')}}">
@endsection

@section('content')
    <div class="col-md-8">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="@if(!isset($_GET['is_registration'])) active @endif"><a href="#tab_login" data-toggle="tab">Login</a></li>
                <li class="@if(isset($_GET['is_registration'])) active @endif"><a href="#tab_registration" data-toggle="tab">Registrasi</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane @if(!isset($_GET['is_registration'])) active @endif" id="tab_login">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('status-login'))
                        <div class="alert alert-{{session('status-login')}}">
                            {{session('message')}}
                        </div>
                    @endif
                    <form action="{{route('peserta_login')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Masuk</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>

                <div class="tab-pane @if(isset($_GET['is_registration'])) active @endif" id="tab_registration">
                    <form action="{{route('peserta_register')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        @if(session('status'))
                            <div class="alert alert-{{session('status')}}">
                                {{session('message')}}
                            </div>
                        @endif
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="username" class="form-control" name="username" required="required" placeholder="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" required="required" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_lengkap" required="required" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Asal Sekolah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="asal_sekolah" required="required" placeholder="Asal Sekolah">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" required="required" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="telepon" required="required" placeholder="Nomor Telepon">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <div class="g-recaptcha" data-sitekey="6LdPMhAUAAAAAHkAvO1GZQ0aee8zOCYNO_bY1nHQ"></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <img src="{{url('image/tatacara.jpeg')}}" class="img-responsive">
        <br>
        <br>
    </div>

    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Menuju Brebes Education Fair 2017</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="count-down" style="zoom: 0.45;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('peserta.partials.contact')
    </div>
@endsection

@section('additional-footer')
    <script src="{{url('plugins/FlipClock-master/compiled/flipclock.min.js')}}"></script>
    {{--<script>--}}
        {{--var date = new Date(2017, 0, 22);--}}
        {{--var now = new Date();--}}
        {{--var diff = (date.getTime()/1000) - (now.getTime()/1000);--}}
        {{--var clock = $('#count-down').FlipClock(diff,{--}}
            {{--clockFace: 'DailyCounter',--}}
            {{--countdown: true,--}}
            {{--language:'indonesian',--}}
        {{--});--}}
    {{--</script>--}}
    <script>
        var date=new Date(2017,0,22),now=new Date,diff=date.getTime()/1e3-now.getTime()/1e3,clock=$("#count-down").FlipClock(diff,{clockFace:"DailyCounter",countdown:!0,language:"indonesian"});
    </script>
@endsection