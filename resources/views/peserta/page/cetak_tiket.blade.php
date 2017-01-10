<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tiket {{auth('peserta')->user()->dataPeserta->jenisTiket->nama}} - {{auth('peserta')->user()->dataPeserta->nomorTiket()}}</title>
    <link rel="stylesheet" href="{{url('bootstrap/css/bootstrap.min.css')}}">
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }

        }
        .gambar-tutwuri{
            display: block;
            max-width: 100%;
            height: auto;
            margin: 0 auto;
        }
        .box-name{
            border: 2px solid black;
            padding: 6px 6px;
            font-size: 16px;
        }
    </style>
</head>
<body onload="window.print()">
{{--<body>--}}
<div class="container-fluid">
    <br>
    <br>
    <div class="row">
        <div class="col-xs-12 text-center">
            <h4><strong>BREBES EDUCATION FAIR 2017</strong></h4>
        </div>
        <div class="col-xs-12">
            <table class="table" border="1">
                <tr>
                    <td width="20%">Username</td>
                    <td width="1%">:</td>
                    <td width="40%">{{auth('peserta')->user()->username}}</td>
                    <td rowspan="8" width="40%">
                        <img class="image-resposive" src="{{route('peserta_photo_profile')}}">
                    </td>
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
                <tr>
                    <td>Panitia Lokal</td>
                    <td>:</td>
                    <td>{{auth('peserta')->user()->dataPeserta->panlok->nama}}</td>
                </tr>
                <tr>
                    <td>Tanggal Ujian</td>
                    <td>:</td>
                    <td>
                        {{$data['tanggal']}}
                    </td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td>
                        @if(auth('peserta')->user()->dataPeserta->jenis_tiket_id != 4)
                            {{$data['jam_simulasi']}}
                        @else
                            {{$data['jam_expo']}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Lokasi Ujian</td>
                    <td>:</td>
                    <td>                        {{$data['lokasi']}}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                    @if(auth('peserta')->user()->dataPeserta->jenis_tiket_id != 4)
                        @foreach(auth('peserta')->user()->pilihanUniversitas as $d)
                            {{$d->urutan}}. {{$d->programStudi->kode}} - {{$d->programStudi->nama}} - {{$d->programStudi->universitas->nama}}
                            <br>
                        @endforeach
                    @else
                        Expo Universitas
                    @endif
                    </td>
                    <td>
                        <?php
                            $qr = [
                                'nomor_tiket' => auth('peserta')->user()->dataPeserta->nomorTiket(),
                                'id' => auth('peserta')->user()->dataPeserta->id,
                            ];
                        ?>
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG(json_encode($qr), 'QRCODE',6,6)}}" alt="barcode" class="image-responsive"  />
                    </td>
                </tr>
            </table>
            <div class="col-xs-12 text-center">
                <h6><strong>Jadilah seorang ksatria - anonim</strong></h6>
            </div>
        </div>

    </div>
    <br>
</div>
</body>
</html>