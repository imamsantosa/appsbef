@extends('panitia.template', ['panitia_all' => true])

@section('title')
    Data Panitia
@endsection

@section('additional-header')
    <link rel="stylesheet" href="{{url('plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('breadcumb')
    <h1>
        Data Peserta
        <small>Semua Peserta</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Panitia</a></li>
        <li class="active">Semua Panitia</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Semua Panitia</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(session('status'))
                        <div class="alert alert-{{session('status')}}">
                            {{session('message')}}
                        </div>
                    @endif
                    <br>
                    <a class="btn btn-primary" href="{{route('panitia_data_panitia_create')}}"><span class="fa fa-plus"></span> Tambah Peserta</a>
                    <br>
                    <br>
                    <table id="data_peserta" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Telepon</th>
                            <th>Panlok</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-footer')
    <script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script type="application/javascript">
        var Table = $('#data_peserta').DataTable({
            "ajax": {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "url": "{{ route('panitia_data_panitia_all') }}",
                "type": "post"
            },
            "Processing": true,
            "ServerSide": true,
            "columnDefs": [ { "targets": 0, "orderable": false } ],
            "columns":
                    [
                        {
                            "data": "username",
                            "width": '15%',
                            "render": function(data){
                                return '<h6>'+data+'<h6>';
                            }
                        },

                        {
                            "data": "nama_lengkap",
                            "width": '20%',
                            "render": function(data){
                                return '<h6>'+data+'</h6>';
                            }
                        },

                        {
                            "data": "nomor_telepon",
                            "render": function(data){
                                return '<h6>'+data+'</h6>';
                            }
                        },
                        {
                            "data": "panlok",
                            "render": function(data){
                                return '<h6>'+data+'</h6>';
                            }
                        },
                        {
                            "data": null,
                            "width": '15%',
                            "render": function (data) {
                                return '<h6>'+opsi(data)+'</h6>';
                            }
                        }
                    ]
        });

        function opsi(data) {
            var role = "{{auth('panitia')->user()->role_id}}"
            var a = '<button class="btn btn-primary btn-flat btn-sm detailbutton" data-toggle="tooltip" data-placement="top" title="lihat data secara detail"><span class="ion ion-navicon-round"></span></button>'

            var b = '';
            var c = '';

            if (role != '3' && data.posisi_id != 1){
                var b = '<a class="btn btn-warning btn-sm btn-flat resetbutton" role="button" data-toggle="tooltip" data-placement="right" title="Reset Password Peserta"><span class="ion ion-ios-refresh"></span></a>'
                var c = '<a class="btn btn-danger btn-sm btn-flat deletebutton" role="button" data-toggle="tooltip" data-placement="right" title="Delete Peserta"><span class="ion ion-ios-trash"></span></a>'
            }

            return a+b+c;
        }

        $('#data_peserta tbody').on('click', '.detailbutton', function(){
            var data  = Table.row( $(this).parents('tr') ).data();

            $('#nama_lengkap').text(data.nama_lengkap);
            $('#username').text(data.username);
            $('#nomor_telepon').text(data.nomor_telepon);
            $('#panlok').text(data.panlok);
            $('#posisi').text(data.posisi);

            $('#modal-detail').modal('show');
        });

        $('#data_peserta tbody').on('click', '.resetbutton', function(){
            var data  = Table.row( $(this).parents('tr') ).data();

            if(confirm("Apakah anda yakin akan mereset password dari panitia "+data.username+" ?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('panitia_reset_password_panitia') }}",
                    data: 'username='+data.username,
                }).done(function(e){
                    alert(e)
                })
            } else {
                return false;
            }
        });

        $('#data_peserta tbody').on('click', '.deletebutton', function(){
            var data  = Table.row( $(this).parents('tr') ).data();

            if(confirm("Apakah anda yakin akan menghapus user dari panitia "+data.username+" ?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('panitia_delete_panitia') }}",
                    data: 'username='+data.username,
                }).done(function(e){
                    Table.ajax.reload( null, false );

                    alert(e)
                })
            } else {
                return false;
            }
        });
    </script>

    <script type="application/javascript">
        {{--function panlok(a){return""==a.data?"belum memilih panlok":a.data.panlok}function status(a){return 1==a.status_peserta?'<span class="label bg-red">'+a.status_peserta_text+"</span>":2==a.status_peserta?'<span class="label bg-yellow">'+a.status_peserta_text+"</span>":3==a.status_peserta?'<span class="label bg-blue">'+a.status_peserta_text+"</span>":'<span class="label bg-green">'+a.status_peserta_text+"</span>"}function opsi(a){var b="{{auth('panitia')->user()->role_id}}",c='<button class="btn btn-primary btn-flat btn-sm detailbutton" data-toggle="tooltip" data-placement="top" title="lihat data secara detail"><span class="ion ion-navicon-round"></span></button>',d="";if("3"!=b)var d='<a class="btn btn-warning btn-sm btn-flat resetbutton" role="button" data-toggle="tooltip" data-placement="right" title="Reset Password Peserta"><span class="ion ion-ios-refresh"></span></a>';return c+d}var Table=$("#data_peserta").DataTable({ajax:{headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},url:"{{ route('panitia_data_peserta_all') }}",type:"post"},Processing:!0,ServerSide:!0,columnDefs:[{targets:0,orderable:!1}],columns:[{data:"username",width:"15%",render:function(a){return"<h6>"+a+"<h6>"}},{data:"nama_lengkap",width:"20%",render:function(a){return"<h6>"+a+"</h6>"}},{data:"nomor_telepon",render:function(a){return"<h6>"+a+"</h6>"}},{data:"asal_sekolah",render:function(a){return"<h6>"+a+"</h6>"}},{data:null,render:function(a){return"<h6>"+panlok(a)+"</h6>"}},{data:null,width:"15%",render:function(a){return"<h6>"+status(a)+"</h6>"}},{data:null,width:"15%",render:function(a){return"<h6>"+opsi(a)+"</h6>"}}]});$("#data_peserta tbody").on("click",".detailbutton",function(){var a=Table.row($(this).parents("tr")).data();$("#nama_lengkap").text(a.nama_lengkap),$("#username").text(a.username),$("#nomor_telepon").text(a.nomor_telepon),$("#asal_sekolah").text(a.asal_sekolah),$("#status").text(a.status_peserta_text),$("#jenis_tiket").text("-"),$("#panlok").text("-"),$("#kode_pembayaran").text("-"),$("#nomor_tiket").text("-"),$("#status_pembayaran").text("-"),$("#panitia_konfirmasi").text("-"),$("#tanggal_konfirmasi").text("-"),""!=a.data&&($("#jenis_tiket").text(a.data.jenis_tiket),$("#panlok").text(a.data.panlok),$("#kode_pembayaran").text(a.data.kode_pembayaran),$("#nomor_tiket").text(a.data.nomor_tiket),$("#status_pembayaran").text(a.data.status_pembayaran),$("#panitia_konfirmasi").text(a.data.panitia_konfirmasi),$("#tanggal_konfirmasi").text(a.data.tanggal_konfirmasi)),$("#modal-detail").modal("show")}),$("#data_peserta tbody").on("click",".resetbutton",function(){var a=Table.row($(this).parents("tr")).data();return!!confirm("Apakah anda yakin akan mereset password dari peserta "+a.username+" ?")&&void $.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"POST",url:"{{ route('panitia_reset_password') }}",data:"username="+a.username}).done(function(a){alert(a)})});--}}
    </script>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal-detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Detail Peserta</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive">
                        <tbody>
                        <tr>
                            <td width="30%">Nama Lengkap</td>
                            <td width="1%">:</td>
                            <td id="nama_lengkap">bla</td>
                        </tr>
                        <tr>
                            <td width="30%">Username</td>
                            <td width="1%">:</td>
                            <td id="username">bla</td>
                        </tr>
                        <tr>
                            <td width="30%">Nomor Telepon</td>
                            <td width="1%">:</td>
                            <td id="nomor_telepon">bla</td>
                        </tr>
                        <tr>
                            <td width="30%">Panlok</td>
                            <td width="1%">:</td>
                            <td id="panlok">bla</td>
                        </tr>
                        <tr>
                            <td width="30%">Posisi</td>
                            <td width="1%">:</td>
                            <td id="posisi">bla</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection



