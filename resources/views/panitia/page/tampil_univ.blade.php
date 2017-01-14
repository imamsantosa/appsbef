@extends('panitia.template', ['expo_tampil' => true])

@section('title')
    Tampil Expo
@endsection

@section('additional-header')

@endsection

@section('breadcumb')
    <h1>
        Data Expo
        <small>Tampil Expo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Expo</a></li>
        <li class="active">Tampil Expo</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Expo Universitas</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(session('status'))
                        <div class="alert alert-{{session('status')}}">
                            {{session('message')}}
                        </div>
                    @endif
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Universitas</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;?>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><a href="{{route('panitia_tampil_expo_universitas', ['id' => $d->id])}}" role="button">{{strtoupper($d->nama)}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="{{route('panitia_tampil_expo_universitas', ['id' => $univ->id])}}" >Informasi</a></li>
                    <li class=""><a href="{{route('panitia_tampil_expo_universitas_chat', ['id' => $univ->id])}}" >Chat</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <h4><strong>{{strtoupper($univ->nama)}}</strong></h4>
                        {!! $univ->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-footer')

@endsection



