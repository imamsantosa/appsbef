@extends('panitia.template', ['expo' => true])

@section('title')
    Tambah Expo
@endsection

@section('additional-header')
    <link rel="stylesheet" href="{{url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

@endsection

@section('breadcumb')
    <h1>
        Data Expo
        <small>Tambah Expo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Expo</a></li>
        <li class="active">Tambah Expo</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Expo
                    </h3>
                    {{--<!-- tools box -->--}}
                    {{--<div class="pull-right box-tools">--}}
                        {{--<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">--}}
                            {{--<i class="fa fa-minus"></i></button>--}}
                        {{--<button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">--}}
                            {{--<i class="fa fa-times"></i></button>--}}
                    {{--</div>--}}
                    {{--<!-- /. tools -->--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    @if(session('status'))
                        <div class="alert alert-{{session('status')}}">
                            {{session('message')}}
                        </div>
                    @endif
                    <form role="form" action="{{route('panitia_data_expo_create_process')}}" method="POST">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nama Universitas</label>
                                <input type="text" name="universitas" class="form-control" placeholder="Nama Universitas" required="required">
                            </div>
                            <div class="form-group">
                                <label >Keterangan</label>
                                <textarea class="textarea" name="content" required="required" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Keberadaan</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="utara" value="1">
                                        Utara
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="selatan" value="1">
                                        Selatan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                    <form>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-footer')
    <script src="{{url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script>
        $(".textarea").wysihtml5({
                    "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
                    "emphasis": true, //Italics, bold, etc. Default true
                    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                    "html": false, //Button which allows you to edit the generated HTML. Default false
                    "link": true, //Button to insert a link. Default true
                    "image": true, //Button to insert an image. Default true,
                    "color": false, //Button to change color of font
                    "blockquote": true, //Blockquote
                    "size": '<buttonsize>' //default: none, other options are xs, sm, lg
        });
    </script>
@endsection



