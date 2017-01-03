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
                <h3 class="box-title">Pilih Tiket</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="POST" id="form-jenis-tiket">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Panitia Lokal</label>
                                <select class="form-control" name="panlok" id="panlok">
                                    <option value="-">-- Pilih Lokasi Panlok --</option>
                                    @foreach($panlok as $p)
                                        <option value="{{$p->id}}">{{$p->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis Tiket</label>
                                <select class="form-control" name="jenis_tiket" id="jenis_tiket">
                                    <option value="-">-- Pilih Tiket --</option>
                                    @foreach($jenisTiket as $j)
                                        <option value="{{$j->id}}" data-harga="{{$j->harga}}" data-kuota="{{$j->sisaTiket()}}">{{$j->nama.' - '.$j->harga()}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" required="required" name="sepakat" id="sepakat">
                                        Dengan ini saya mensetujui peraturan yang dibuat oleh panitia
                                    </label>
                                </div>

                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info btn-block" value="Lanjutkan">
                            </div>
                        </form>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#form-jenis-tiket').on('submit', function(){

                if($('#jenis_tiket').val() == '-' || $('#panlok').val() == '-'){
                    alert('Anda belum memilih tiket atau panitia lokal');
                    return false;
                }
                if(confirm('Apakah tiket yang anda masukan sudah benar?')){

                } else {
                    return false;
                }
            });
        });
    </script>

    {{--minify--}}
    <script type="application/javascript">
//        $(document).ready(function(){$("#form-jenis-tiket").on("submit",function(){return"-"==$("#jenis_tiket").val()||$("#panlok").val()?(alert("Anda belum memilih tiket atau panitia lokal"),!1):!!confirm("Apakah tiket yang anda masukan sudah benar?")&&void 0})});
    </script>
@endsection