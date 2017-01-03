@extends('peserta.template')

@section('title')
    Konfirmasi Tiket
@endsection

@section('additional-header')

@endsection

@section('content')
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Konfirmasi Tiket</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <td>Panitia Lokal</td>
                                <td> : </td>
                                <td> {{$data->panlok->nama}}</td>
                            </tr>
                            <tr>
                                <td>Jenis Tiket</td>
                                <td> : </td>
                                <td> {{$data->jenisTiket->nama}}</td>
                            </tr>
                            <tr>
                                <td width="40%">Total yang harus dibayarkan</td>
                                <td> : </td>
                                <td> {{$data->jenisTiket->harga()}}</td>
                            </tr>
                        </table>
                        <label>*) Apabila anda telah mengkonfirmasi tiket, maka anda <span class="text-red">tidak dapat</span> mengganti tiket</label>
                        <a class="btn btn-warning btn-block" href="{{route('peserta_pilih_tiket')}}" onclick="return confirm('Apakah anda yakin untuk kembali memilih tiket?')">Kembali memilih tiket</a>
                        <a class="btn btn-info btn-block" href="{{route('peserta_konfirmasi_tiket_proses')}}" onclick="return confirm('Apakah anda data yang anda masukan sudah benar?')">Konfirmasi Tiket Saya</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Keterangan</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <strong>Fasilitas Simulasi (Soshum/Saintek/IPC)</strong>
                        <ul>
                            <li>Simulasi SBMPTN 2017</li>
                            <li>Snack</li>
                            <li>Talkshow</li>
                            <li>Expo Universitas</li>
                            <li>Aplikasi Chating dengan Mahasiswa Brebes yang berada di PTN/PT</li>
                        </ul>
                        <strong>Fasilitas Expo</strong>
                        <ul>
                            <li>Talkshow</li>
                            <li>Expo Universitas</li>
                            <li>Aplikasi Chating dengan Mahasiswa Brebes yang berada di PTN/PT</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @include('peserta.partials.contact')
    </div>
@endsection

@section('additional-footer')

@endsection