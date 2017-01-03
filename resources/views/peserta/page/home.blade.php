@extends('peserta.template')

@section('title')
    Home
@endsection

@section('additional-header')
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
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

                        @if(auth('peserta')->user()->status_peserta_id == 3)
                                @include('peserta.partials.pilih_univ')
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
                                @if(auth('peserta')->user()->dataPeserta->jenis_tiket_id != 4)
                                    @foreach(auth('peserta')->user()->pilihanUniversitas as $d)
                                    <tr>
                                        <td>Pilihan {{$d->urutan}}</td>
                                        <td>:</td>
                                        <td>{{$d->programStudi->kode}} - {{$d->programStudi->nama}} - {{$d->programStudi->universitas->nama}}</td>
                                    </tr>
                                    @endforeach
                                @endif
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

@section('additional-footer')
    {{--<script type="application/javascript">--}}
        {{--$(document).ready(function(){--}}
            {{--$('#univ1').on('change', function(){--}}
                {{--$.ajax({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--},--}}
                    {{--type: "POST",--}}
                    {{--url: "{{ route('peserta_pilih_prodi') }}",--}}
                    {{--dataType: "json",--}}
                    {{--data: 'univ='+$(this).val(),--}}
                    {{--success: function(data) {--}}
                        {{--var options, index, select, option;--}}
                        {{--select = document.getElementById('jurusan1');--}}
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

            {{--$('#univ2').on('change', function(){--}}
                {{--$.ajax({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--},--}}
                    {{--type: "POST",--}}
                    {{--url: "{{ route('peserta_pilih_prodi') }}",--}}
                    {{--dataType: "json",--}}
                    {{--data: 'univ='+$(this).val(),--}}
                    {{--success: function(data) {--}}
                        {{--var options, index, select, option;--}}
                        {{--select = document.getElementById('jurusan2');--}}
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

            {{--$('#univ3').on('change', function(){--}}
                {{--$.ajax({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--},--}}
                    {{--type: "POST",--}}
                    {{--url: "{{ route('peserta_pilih_prodi') }}",--}}
                    {{--dataType: "json",--}}
                    {{--data: 'univ='+$(this).val(),--}}
                    {{--success: function(data) {--}}
                        {{--var options, index, select, option;--}}
                        {{--select = document.getElementById('jurusan3');--}}
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

            {{--$('#isi-univ').on('submit', function(e){--}}
                {{--if(confirm('Apakah data yang anda masukan sudah benar? setelah anda menyimpannya, anda tidak dapat merubah data universitas kembali')){--}}
                    {{--if($('#univ1').val() ==  '-' || $('#jurusan1').val() == '-'){--}}
                        {{--alert('anda belum memilih pilihan 1!');--}}
                        {{--return false;--}}
                    {{--}--}}
                    {{--if($('#univ2').val() !=  '-' && $('#jurusan2').val() == '-'){--}}
                        {{--alert('anda belum memilih prodi piilhan 2!');--}}
                        {{--return false;--}}
                    {{--}--}}
                    {{--if($('#univ3').val() !=  '-' && $('#jurusan3').val() == '-'){--}}
                        {{--alert('anda belum memilih prodi piilhan 3!');--}}
                        {{--return false;--}}
                    {{--}--}}
                {{--} else{--}}
                    {{--return false;--}}
                {{--}--}}
            {{--})--}}

        {{--});--}}
    {{--</script>--}}

    <script type="application/javascript">
        $(document).ready(function(){$("#univ1").on("change",function(){$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"POST",url:"{{ route('peserta_pilih_prodi') }}",dataType:"json",data:"univ="+$(this).val(),success:function(a){var b,c,d,e;for(d=document.getElementById("jurusan1"),d.options.length=0,b=a.options,d.options.add(new Option("-- Pilih Prodi --","-")),c=0;c<b.length;++c)e=b[c],d.options.add(new Option(e.text,e.value))}})}),$("#univ2").on("change",function(){$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"POST",url:"{{ route('peserta_pilih_prodi') }}",dataType:"json",data:"univ="+$(this).val(),success:function(a){var b,c,d,e;for(d=document.getElementById("jurusan2"),d.options.length=0,b=a.options,d.options.add(new Option("-- Pilih Prodi --","-")),c=0;c<b.length;++c)e=b[c],d.options.add(new Option(e.text,e.value))}})}),$("#univ3").on("change",function(){$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"POST",url:"{{ route('peserta_pilih_prodi') }}",dataType:"json",data:"univ="+$(this).val(),success:function(a){var b,c,d,e;for(d=document.getElementById("jurusan3"),d.options.length=0,b=a.options,d.options.add(new Option("-- Pilih Prodi --","-")),c=0;c<b.length;++c)e=b[c],d.options.add(new Option(e.text,e.value))}})}),$("#isi-univ").on("submit",function(a){return!!confirm("Apakah data yang anda masukan sudah benar? setelah anda menyimpannya, anda tidak dapat merubah data universitas kembali")&&("-"==$("#univ1").val()||"-"==$("#jurusan1").val()?(alert("anda belum memilih pilihan 1!"),!1):"-"!=$("#univ2").val()&&"-"==$("#jurusan2").val()?(alert("anda belum memilih prodi piilhan 2!"),!1):"-"!=$("#univ3").val()&&"-"==$("#jurusan3").val()?(alert("anda belum memilih prodi piilhan 3!"),!1):void 0)})});
    </script>
@endsection