@extends('peserta.template')

@section('title')
    Home
@endsection

@section('additional-header')
    <meta name="csrf-token" content="{{csrf_token()}}" />
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
                        <strong>Fasilitas Simulasi (Soshum/Saintek/IPC) Panlok Utara</strong>
                        <ul>
                            <li>Simulasi SBMPTN 2017</li>
                            <li>Snack</li>
                            <li>Talkshow</li>
                            <li>Expo Universitas</li>
                            <li>Aplikasi Chating dengan Mahasiswa Brebes yang berada di PTN/PT</li>
                        </ul>
                        <strong>Fasilitas Simulasi (Soshum/Saintek) Panlok Selatan</strong>
                        <ul>
                            <li>simulasi SBMPTN 2017</li>
                            <li>Brebes Edukasi Talkshow</li>
                            <li>Expo Kampus</li>
                            <li>Hiburan</li>
                            <li>Makan Siang</li>
                            <li>Doorprize</li>
                            <li>Hadiah dan piagam penghargaan bagi juara 1, 2, 3 nilai simulasi tertinggi.</li>
                            <li>Aplikasi Chating dengan Mahasiswa Brebes yang berada di PTN/PT</li>
                        </ul>
                        <strong>Fasilitas Expo Panlok Utara</strong>
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
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function(){--}}
            {{--$('#form-jenis-tiket').on('submit', function(){--}}

                {{--if($('#jenis_tiket').val() == '-' || $('#panlok').val() == '-'){--}}
                    {{--alert('Anda belum memilih tiket atau panitia lokal');--}}
                    {{--return false;--}}
                {{--}--}}
                {{--if(confirm('Apakah tiket yang anda masukan sudah benar?')){--}}

                {{--} else {--}}
                    {{--return false;--}}
                {{--}--}}
            {{--});--}}

            {{--$('#panlok').on('change', function(){--}}
                {{--$.ajax({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--},--}}
                    {{--type: "POST",--}}
                    {{--url: "{{ route('peserta_get_tiket') }}",--}}
                    {{--dataType: "json",--}}
                    {{--data: 'panlok='+$(this).val(),--}}
                    {{--success: function(data) {--}}
                        {{--var options, index, select, option;--}}
                        {{--select = document.getElementById('jenis_tiket');--}}
                        {{--select.options.length = 0;--}}
                        {{--options = data.options;--}}
                        {{--select.options.add(new Option("-- Pilih Prodi --", "-"));--}}
                        {{--for (index = 0; index < options.length; ++index) {--}}
                            {{--option = options[index];--}}
                            {{--select.options.add(new Option(option.text, option.value));--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}

        {{--});--}}
    {{--</script>--}}

    {{--minify--}}
    <script type="application/javascript">
        $(document).ready(function(){$("#form-jenis-tiket").on("submit",function(){return"-"==$("#jenis_tiket").val()||"-"==$("#panlok").val()?(alert("Anda belum memilih tiket atau panitia lokal"),!1):!!confirm("Apakah tiket yang anda masukan sudah benar?")&&void 0}),$("#panlok").on("change",function(){$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"POST",url:"{{ route('peserta_get_tiket') }}",dataType:"json",data:"panlok="+$(this).val(),success:function(a){var b,c,d,e;for(d=document.getElementById("jenis_tiket"),d.options.length=0,b=a.options,d.options.add(new Option("-- Pilih Prodi --","-")),c=0;c<b.length;++c)e=b[c],d.options.add(new Option(e.text,e.value))}})})});
    </script>
@endsection