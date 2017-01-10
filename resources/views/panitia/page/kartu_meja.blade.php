<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Meja</title>
    <link rel="stylesheet" href="{{url('bootstrap/css/bootstrap.min.css')}}">
    <style>
        @page {
            size: A4;
            /*margin: 0;*/
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }
            .page {
                /*margin: 0;*/
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
            <table class="table" border="2">
                @foreach($datapeserta as $d)
                <tr>
                    <td width="15%" class="text-center">
                        <img src="{{url('image/logobef.png')}}" class="image-responsive"><br>
                        <h6>BEF 2017</h6>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td width="25%">Nama</td>
                                <td width="1%">&nbsp;:&nbsp;</td>
                                <td>{{strtoupper($d->peserta->fullname)}}</td>
                            </tr>
                            <tr>
                                <td>Nomor Peserta</td>
                                <td width="1%">&nbsp;:&nbsp;</td>
                                <td>{{$d->nomorTiket()}}</td>
                            </tr>
                            <tr>
                                <td>Panita Lokal</td>
                                <td width="1%">&nbsp;:&nbsp;</td>
                                <td>{{strtoupper($d->panlok->nama)}}</td>
                            </tr>
                            <tr>
                                <td>Asal Sekolah</td>
                                <td width="1%">&nbsp;:&nbsp;</td>
                                <td>{{strtoupper($d->peserta->school)}}</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <hr>
                                    @if($d->jenis_tiket_id != 4)
                                        @foreach($d->peserta->pilihanUniversitas as $z)
                                            <p style="font-size: 10px">{{$z->urutan}}. {{$z->programStudi->kode}} - {{$z->programStudi->nama}} - {{$z->programStudi->universitas->nama}}</p>
                                            {{--<br>--}}
                                        @endforeach
                                    @else
                                        Expo Universitas
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="15%">
                        <img src="{{route('panitia_photo_peserta', ['id' => $d->peserta->id])}}" class="image-responsive">
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="col-xs-12 text-center">

            </div>
        </div>

    </div>
    <br>
</div>
</body>
</html>