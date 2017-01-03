@extends('panitia.template', ['expo' => true])

@section('title')
    Data Expo
@endsection

@section('additional-header')
    <link rel="stylesheet" href="{{url('plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('breadcumb')
    <h1>
        Data Expo
        <small>Semua Expo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Expo</a></li>
        <li class="active">Semua Expo</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Expo</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(session('status'))
                        <div class="alert alert-{{session('status')}}">
                            {{session('message')}}
                        </div>
                    @endif
                    <br>
                    @if(auth('panitia')->user()->role_id != 3)
                    <a class="btn btn-primary" href="{{route('panitia_data_expo_create')}}"><span class="fa fa-plus"></span> Tambah Expo</a>
                    <br>
                    <br>
                    @endif
                    <table id="data_peserta" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nama Universitas</th>
                            <th>Tanggal Perubahan</th>
                            <th>Edited By</th>
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
                "url": "{{ route('panitia_data_expo_all') }}",
                "type": "post"
            },
            "Processing": true,
            "ServerSide": true,
            "columnDefs": [ { "targets": 0, "orderable": false } ],
            "columns":
                    [
                        {
                            "data": "nama_universitas",
                            "width": '15%',
                            "render": function(data){
                                return '<h6>'+data+'<h6>';
                            }
                        },

                        {
                            "data": "updated_at",
                            "width": '20%',
                            "render": function(data){
                                return '<h6>'+data+'</h6>';
                            }
                        },

                        {
                            "data": "edited_by",
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
            var a = '<a class="btn btn-warning btn-sm btn-flat resetbutton" role="button" data-toggle="tooltip" data-placement="top" title="Ubah data universitas" href="{{route('panitia_data_expo_edit',['id'=>''])}}/'+data.id+'"><span class="fa fa-pencil"></span></a>'

            var c = '';

            if (role != '3' && data.posisi_id != 1){
                var c = '<a class="btn btn-danger btn-sm btn-flat deletebutton" role="button" data-toggle="tooltip" data-placement="right" title="Hapus Expo"><span class="ion ion-ios-trash"></span></a>'
            }

            return a+c;
        }


        $('#data_peserta tbody').on('click', '.deletebutton', function(){
            var data  = Table.row( $(this).parents('tr') ).data();

            if(confirm("Apakah anda yakin akan menghapus user dari panitia "+data.username+" ?")){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('panitia_data_expo_delete') }}",
                    data: 'id='+data.id,
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

    </script>

@endsection



