@extends('panitia.template', ['konfig' => true])

@section('title')
    Konfigurasi
@endsection

@section('additional-header')

@endsection

@section('breadcumb')
    <h1>
        Konfigurasi
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Konfigurasi</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        @if(session('status'))
            <div class="col-md-12">
                <div class="alert alert-{{session('status')}}">
                    {{session('message')}}
                </div>
            </div>
        @endif
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Panlok Utara</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" action="{{route('panitia_konfigurasi_save', ['panlok' => 'utara'])}}" method="post">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label >Lokasi</label>
                                <input type="text" class="form-control" value="{{$data['lokasi_utara']}}" name="lokasi_utara" placeholder="Lokasi" required="required">
                            </div>

                            <div class="form-group">
                                <label >Tanggal Kegiatan</label>
                                <input type="text" class="form-control" value="{{$data['tanggal_utara']}}" name="tanggal_utara" placeholder="Lokasi" required="required">
                            </div>

                            <div class="form-group">
                                <label >Jam Kegiatan Simulasi</label>
                                <input type="text" class="form-control" value="{{$data['jam_simulasi_utara']}}" name="jam_simulasi_utara" placeholder="Lokasi" required="required">
                            </div>

                            <div class="form-group">
                                <label >Jam Kegiatan Simulasi</label>
                                <input type="text" class="form-control" value="{{$data['jam_expo_utara']}}" name="jam_expo_utara" placeholder="Lokasi" required="required">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Konfigurasi Panlok Selatan</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" action="{{route('panitia_konfigurasi_save', ['panlok' => 'selatan'])}}" method="post">
                        {{csrf_field()}}

                        <div class="box-body">
                            <div class="form-group">
                                <label >Lokasi</label>
                                <input type="text" class="form-control" value="{{$data['lokasi_selatan']}}" name="lokasi_selatan" placeholder="Lokasi" required="required">
                            </div>

                            <div class="form-group">
                                <label >Tanggal Kegiatan</label>
                                <input type="text" class="form-control" value="{{$data['tanggal_selatan']}}" name="tanggal_selatan" placeholder="Lokasi" required="required">
                            </div>

                            <div class="form-group">
                                <label >Jam Kegiatan Simulasi</label>
                                <input type="text" class="form-control" value="{{$data['jam_simulasi_selatan']}}" name="jam_simulasi_selatan" placeholder="Lokasi" required="required">
                            </div>

                            <div class="form-group">
                                <label >Jam Kegiatan Simulasi</label>
                                <input type="text" class="form-control" value="{{$data['jam_expo_selatan']}}" name="jam_expo_selatan" placeholder="Lokasi" required="required">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

    </div>


@endsection

@section('additional-footer')

@endsection