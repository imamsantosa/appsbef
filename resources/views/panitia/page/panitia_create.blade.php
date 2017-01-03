@extends('panitia.template', ['panitia_all' => true])

@section('title')
    Tambah panitia
@endsection

@section('additional-header')
    <script src='https://www.google.com/recaptcha/api.js'></script>

@endsection

@section('breadcumb')
    <h1>
        Data Peserta
        <small>Rekap Peserta</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Panitia</a></li>
        <li class="active">Tambah Pantia</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Panitia</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(session('status'))
                    <div class="alert alert-{{session('status')}}">
                        {{session('message')}}
                    </div>
                    @endif
                    <form role="form" action="{{route('panitia_data_panitia_create_proses')}}" method="POST">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label >Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter email" required="required">
                            </div>
                            <div class="form-group">
                                <label >Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="required">
                            </div>
                            <div class="form-group">
                                <label >Nama Lengkap</label>
                                <input type="text" name="fullname" class="form-control" placeholder="Nama Lengkap" required="required">
                            </div>
                            <div class="form-group">
                                <label >Nomor Telepon</label>
                                <input type="text" class="form-control" name="nomor_telepon" placeholder="Nomor Telepon" required="required">
                            </div>
                            <div class="form-group">
                                <label >Panlok</label>

                                <div class="radio">
                                    <label>
                                        <input type="radio" name="panlok" value="1" required="required">
                                        Utara
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="panlok" value="2" required="required">
                                        Selatan
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label >Posisi</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="posisi" value="2" required="required">
                                        Pusat Data dan Informasi
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="posisi" value="3" required="required">
                                        Panitia
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LdPMhAUAAAAAHkAvO1GZQ0aee8zOCYNO_bY1nHQ"></div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-footer')

@endsection



