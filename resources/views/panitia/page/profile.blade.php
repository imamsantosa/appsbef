@extends('panitia.template', ['dashboard' => true])

@section('title')
    Dashboard
@endsection

@section('additional-header')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('breadcumb')
    <h1>
        Dashboard
        <small>Profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{route('panitia_photo_profile')}}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{auth('panitia')->user()->username}}</h3>
                    <h3 class="profile-username text-center">{{auth('panitia')->user()->fullname}}</h3>

                    <p class="text-muted text-center">{{auth('panitia')->user()->role->nama}}</p>
                    <p class="text-muted text-center">{{auth('panitia')->user()->panlok->nama}}</p>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <div class="col-md-8">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#biodata" data-toggle="tab">Biodata</a></li>
                    <li><a href="#foto" data-toggle="tab">Foto</a></li>
                    <li><a href="#password" data-toggle="tab">Password</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="biodata">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('status'))
                            <div class="alert alert-{{session('status')}}">
                                {{session('message')}}
                            </div>
                        @endif
                        <br>
                        <form role="form" method="POST" action="{{route('panitia_update_biodata')}}">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label >Username</label>
                                    <input type="email" class="form-control" disabled="disabled" value="{{auth('panitia')->user()->username}}">
                                </div>
                                <div class="form-group">
                                    <label >Nama Lengkap</label>
                                    <input type="text" class="form-control" name="fullname" value="{{auth('panitia')->user()->fullname}}" placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group">
                                    {{--<div class="g-recaptcha" data-sitekey="6LdPMhAUAAAAAHkAvO1GZQ0aee8zOCYNO_bY1nHQ"></div>--}}
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Perbarui Data</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="foto">
                        <form method="POST" action="{{route('panitia_upload_foto')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Pilih Foto</label>
                                <input type="file" id="image" name="image" accept="image/*">
                                <p class="help-block">hanya .PNG atau .JPG atau .JPEG dengan ukuran maksimal 100kb yang dapat diunggah</p>
                            </div>
                            <div class="form-group">
                                <img style="display: none" id="preview" src="#" class="img-responsive" alt="Bukti Pembayaran" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info btn-block" value="Unggah Foto">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="password">
                        <form role="form" method="POST" action="{{route('panitia_ganti_password')}}">
                            {{csrf_field()}}

                            <div class="box-body">
                                <div class="form-group">
                                    <label >Password Lama</label>
                                    <input type="password" class="form-control" name="password" placeholder="password lama">
                                </div>
                                <div class="form-group">
                                    <label >Password Baru</label>
                                    <input type="password" class="form-control" name="password1" placeholder="password baru">
                                </div>
                                <div class="form-group">
                                    <label >Ulangi Password Baru</label>
                                    <input type="password" class="form-control" name="password2" placeholder="password baru">
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-footer')
    <script>
        $(document).ready(function(){function a(a){if(a.files&&a.files[0]){var b=new FileReader;b.onload=function(a){$("#preview").attr("src",a.target.result)},b.readAsDataURL(a.files[0])}}$("#image").change(function(){a(this),$("#preview").show()})});
    </script>
@endsection