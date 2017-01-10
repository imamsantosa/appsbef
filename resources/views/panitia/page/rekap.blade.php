@extends('panitia.template', ['rekap' => true])

@section('title')
    Rekap
@endsection

@section('additional-header')
    {{--<link rel="stylesheet" href="{{url('plugins/datatables/dataTables.bootstrap.css')}}">--}}

@endsection

@section('breadcumb')
    <h1>
        Data Peserta
        <small>Rekap Peserta</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Rekap Peserta</a></li>
        <li class="active">Semua Peserta</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Rekap Peserta</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="{{route('panitia_data_peserta_get_rekap', ['t' => 'fix-utara'])}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Data Peserta (Soshum, Saintek, IPC, Expo) Panlok Utara. Data Ini hanya data yang telah mendapatkan nomor peserta atau sudah fix"><span class="fa fa-download"></span> Peserta Fix Utara</a>
                    &nbsp;
                    <a href="{{route('panitia_data_peserta_get_rekap', ['t' => 'fix-selatan'])}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Data Peserta (Soshum, Saintek) Panlok Selatan. Data Ini hanya data yang telah mendapatkan nomor peserta atau sudah fix"><span class="fa fa-download"></span>Peserta Fix Selatan</a>
                    &nbsp;
                    <a href="{{route('panitia_data_peserta_get_rekap', ['t' => 'fix-all'])}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Semua Data (Baik Sudah Fix atau belum)"><span class="fa fa-download"></span>Semua Peserta</a>

                </div>
            </div>

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Unduhan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="{{route('panitia_data_peserta_kartu', ['t' => 'soshum-utara'])}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Unduh Kartu Peserta Soshum Panlok Utara"><span class="fa fa-download"></span> Kartu Meja Peserta Soshum Utara</a>
                    &nbsp;
                    <a href="{{route('panitia_data_peserta_kartu', ['t' => 'saintek-utara'])}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Unduh Kartu Peserta Saintek Panlok Utara"><span class="fa fa-download"></span> Kartu Meja Peserta Saintek Utara</a>
                    &nbsp;
                    <a href="{{route('panitia_data_peserta_kartu', ['t' => 'ipc-utara'])}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Unduh Kartu Peserta IPC Panlok Utara"><span class="fa fa-download"></span> Kartu Meja Peserta IPC Utara</a>
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-footer')

@endsection



