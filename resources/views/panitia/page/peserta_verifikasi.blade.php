@extends('panitia.template', ['peserta_verifikasi' => true])

@section('title')
    Peserta Verifikasi
@endsection

@section('additional-header')
    {{--<link rel="stylesheet" href="{{url('plugins/datatables/dataTables.bootstrap.css')}}">--}}
@endsection

@section('breadcumb')
    <h1>
        Data Peserta
        <small>Verifikasi Peserta</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Peserta</a></li>
        <li class="active">Verifikasi Peserta</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if(isset($_GET['kode']) || isset($_GET['username']))
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Pencarian kode pembayaran "{{$_GET['kode']}}" atau username "{{$_GET['username']}}"</h3>
                    <br>
                    <br>
                    @if(session('status'))
                        <div class="alert alert-{{session('status')}}">
                            {{session('message')}}
                        </div>
                    @endif
                    @if($dataPencarian == null)
                        <div class="alert alert-danger">
                            @if($errormessage != null)
                                {{$errormessage}}
                            @else
                                Data tidak ditemukan :(
                            @endif
                        </div>
                    @else
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <td width="30%">Username</td>
                                <td width="1%">:</td>
                                <td>{{$dataPencarian->peserta->fullname}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Status Peserta</td>
                                <td width="1%">:</td>
                                <td>{{$dataPencarian->peserta->statusPeserta->nama}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Kode Pembayaran</td>
                                <td width="1%">:</td>
                                <td>{{$dataPencarian->kode_pembayaran}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Jenis Tiket</td>
                                <td width="1%">:</td>
                                <td>{{$dataPencarian->jenisTiket->nama}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Total Pembayaran</td>
                                <td width="1%">:</td>
                                <td>{{$dataPencarian->jenisTiket->harga()}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Status Pembayaran</td>
                                <td width="1%">:</td>
                                <td>{{$dataPencarian->statusPembayaran->nama}}</td>
                            </tr>
                            @if($dataPencarian->bukti != null)
                            <tr>
                                <td width="30%">Bukti Upload</td>
                                <td width="1%">:</td>
                                <td><img src="{{route('panitia_data_peserta_bukti', ['filename' => $dataPencarian->bukti])}}" class="img-responsive"></td>
                            </tr>
                            @endif
                        </table>
                        @if($dataPencarian->status_pembayaran_id != 3)
                        <a class="btn btn-warning btn-block" href="{{route('panitia_konfirmasi_peserta_proses', ['kode' => $_GET['kode']])}}" onclick="return confirm('Apakah anda yakin akan melakukan konfirmasi pembayaran pada peserta tersebut?')">Konfirmasi Pembayaran</a>
                        @endif
                    @endif
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                </div>
            </div>
            @endif

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Menunggu Diverifikasi</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Kode Pembayaran</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($dataverifikasi as $d)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$d->peserta->username}}</td>
                            <td>{{$d->peserta->fullname}}</td>
                            <td>{{$d->kode_pembayaran}}</td>
                            <td><a href="{{route('panitia_data_peserta_verifikasi',['kode' => $d->kode_pembayaran, 'username'=>''])}}">Lihat Data</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Pencarian Peserta</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="get" action="">
                        <div class="box-body">
                            <div class="form-group">
                                <label >Kode Pembayaran</label>
                                <input type="text" class="form-control" name="kode" placeholder="Masukan Kode Pembayaran">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Masukan Username">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Cari Peserta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-footer')

@endsection



