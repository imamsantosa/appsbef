@extends('peserta.template')

@section('title')
    Login
@endsection

@section('additional-header')
    <script src='https://www.google.com/recaptcha/api.js'></script>
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

    </div>

    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Contact Person</h3>
            </div>
        </div>
    </div>
@endsection