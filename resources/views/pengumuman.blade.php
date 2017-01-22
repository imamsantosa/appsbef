@extends('peserta.template')

@section('title')
    Pengumuman
@endsection

@section('additional-header')
@endsection

@section('content')
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="@if(!isset($_GET['is_registration'])) active @endif"><a href="#saintek" data-toggle="tab">SAINTEK & SOSHUM</a></li>
                <li class="@if(isset($_GET['is_registration'])) active @endif"><a href="#ipc" data-toggle="tab">IPC</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane @if(!isset($_GET['is_registration'])) active @endif" id="saintek">
                    <a href="https://drive.google.com/file/d/0B3MURh5vKcKTcFFDSTlycnJUM2s/view?usp=sharing" class="btn btn-primary">Download</a><br><br>
                    <iframe src="https://drive.google.com/file/d/0B3MURh5vKcKTcFFDSTlycnJUM2s/preview?usp=sharing" style="width: 100%; height: 500px"></iframe>
                </div>

                <div class="tab-pane @if(isset($_GET['is_registration'])) active @endif" id="ipc">
                    <a href="https://drive.google.com/file/d/0B3MURh5vKcKTWnN0dVdxVlZlZ3M/view?usp=sharing" class="btn btn-primary">Download</a><br><br>
                    <iframe src="https://drive.google.com/file/d/0B3MURh5vKcKTWnN0dVdxVlZlZ3M/preview?usp=sharing" style="width: 100%; height: 500px"></iframe>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-footer')

@endsection