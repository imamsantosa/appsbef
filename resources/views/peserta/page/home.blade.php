@extends('peserta.template')

@section('title')
    Home
@endsection

@section('additional-header')

@endsection

@section('content')
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Selamat Datang {{auth('peserta')->user()->fullname}}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('status'))
                            <div class="alert alert-{{session('status')}}">
                                {{session('message')}}
                            </div>
                            <br>
                        @endif
                        @if(auth('peserta')->user()->dataPeserta->jenis_tiket_id != 4)
                        <div class="alert alert-warning">
                            Mohon maaf. untuk memilih universitas belum bisa dilakukan dikarenakan belum mendapatkan data universitas se-Indonesia. secepatnya akan kami dapatkan. terima kasih :)
                        </div>
                        @else
                            <div class="alert alert-success">
                                Terima Kasih telah mendaftar di Brebes Education Fair. :)
                            </div>
                            <label>Berikut Informasi Tiket Anda :</label>
                            <table class="table table-responsive">
                                <tr>
                                    <td width="20%">Username</td>
                                    <td width="1%">:</td>
                                    <td>{{auth('peserta')->user()->username}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>:</td>
                                    <td>{{auth('peserta')->user()->fullname}}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Tiket</td>
                                    <td>:</td>
                                    <td>{{auth('peserta')->user()->dataPeserta->jenisTiket->nama}}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Tiket</td>
                                    <td>:</td>
                                    <td>{{auth('peserta')->user()->dataPeserta->nomorTiket()}}</td>
                                </tr>
                            </table>
                            <a class="btn btn-primary btn-block" role="button" href="{{route('peserta_cetak_tiket')}}" target="_blank"><span class="fa fa-print"></span> Cetak Tiket</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-4">
        @include('peserta.partials.contact')
    </div>
@endsection