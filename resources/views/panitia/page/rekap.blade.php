@extends('panitia.template', ['rekap' => true])

@section('title')
    Rekap
@endsection

@section('additional-header')
    {{--<link rel="stylesheet" href="{{url('plugins/datatables/dataTables.bootstrap.css')}}">--}}

@endsection

@section('breadcumb')
    <h1>
        Data Peserta
        <small>Rekap Peserta</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Rekap Peserta</a></li>
        <li class="active">Semua Peserta</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Rekap Peserta</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="alert alert-warning">Mohon maaf. masih dalam pengembangan</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-footer')

@endsection



