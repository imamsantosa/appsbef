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
                <h3 class="box-title">Konfirmasi Pembayaran</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Berikut data pembayaran anda</h4>
                        <table class="table table-responsive ">
                            <tr>
                                <td>Kode Pembayaran</td>
                                <td>:</td>
                                <td>{{$data->kode_pembayaran}}</td>
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
                            <tr>
                                <td>Status Pembayaran</td>
                                <td>:</td>
                                <td><strong>{{$data->statusPembayaran->nama}}</strong></td>
                            </tr>
                        </table>
                        <div class="alert alert-info text-justify">
                            <h4>Lakukan Pembayaran sesuai dengan nominal yang tertera diatas melalui cara yang ada pada keterangan disebelah kanan.</h4>
                        </div>
                        <div class="alert alert-warning">
                            <h4>Setelah melakukan pembayaran, lakukan konfirmasi melalui kontak yang berada disebelah kanan dengan menyebutkan kode pembayaran atau menggunakan form upload bukti pembayaran dibawah</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Form Konfirmasi Pembayaran</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('status-upload'))
                            <div class="alert alert-{{session('status-upload')}}">
                                {{session('message')}}
                            </div>
                        @endif
                        @if($data->bukti != null)
                            <div class="alert alert-success">
                                Terima kasih telah melakukan konfirmasi pembayaran. silahkan tunggu maksimal 2 X 24 Jam untuk panitia melakukan verifikasi. Anda dapat mengubah bukti pembayaran dengan mengunggah ulang dengan form dibawah ini
                            </div>
                        @endif
                    </div>

                    <div class="col-md-{{($data->bukti == null)? '12' : '6'}}">
                        <form method="POST" action="{{route('peserta_konfirmasi_pembayaran_proses')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Pilih bukti pembayaran</label>
                                <input type="file" id="bukti" name="bukti" accept="image/*">
                                <p class="help-block">hanya .PNG atau .JPG atau .JPEG dengan ukuran maksimal 200kb yang dapat diunggah</p>
                            </div>
                            <div class="form-group">
                                <img style="display: none" id="preview" src="#" class="img-responsive" alt="Bukti Pembayaran" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info btn-block" value="Upload Bukti Pembayaran">
                            </div>
                        </form>
                    </div>
                    @if($data->bukti != null)
                    <div class="col-md-6">
                        <img src="{{route('peserta_bukti_pembayaran_image', ['url'=>$data->bukti])}}" class="img-responsive" alt="Bukti Pembayaran" />

                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Keterangan</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <strong>Silahkan Lakukan Pembayaran Melalui :</strong>
                        <br>
                        <br>
                        <strong>Transfer Bank</strong>
                        <ul>
                            <li>Bank Rakyat Indonesia - Unit Tanjung</li>
                            <li>An. Vitri Widhianingsih</li>
                            <li><strong>1447 01 002082 53 2</strong></li>

                        </ul>
                        <strong>Bayar Tunai</strong>
                        <ul>
                            <li>Hubungi Kontak Dibawah ini</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @include('peserta.partials.contact')
    </div>
@endsection

@section('additional-footer')
    {{--<script>--}}
        {{--$(document).ready(function(){--}}
            {{--function readURL(input) {--}}

                {{--if (input.files && input.files[0]) {--}}
                    {{--var reader = new FileReader();--}}

                    {{--reader.onload = function (e) {--}}
                        {{--$('#preview').attr('src', e.target.result);--}}
                    {{--}--}}

                    {{--reader.readAsDataURL(input.files[0]);--}}
                {{--}--}}
            {{--}--}}

            {{--$("#bukti").change(function(){--}}
                {{--readURL(this);--}}
                {{--$('#preview').show();--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
    <script type="application/javascript">
        $(document).ready(function(){function a(a){if(a.files&&a.files[0]){var b=new FileReader;b.onload=function(a){$("#preview").attr("src",a.target.result)},b.readAsDataURL(a.files[0])}}$("#bukti").change(function(){a(this),$("#preview").show()})});
    </script>
@endsection