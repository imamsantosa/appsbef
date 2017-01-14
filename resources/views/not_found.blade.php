@extends('peserta.template')

@section('title')
    404 not found
@endsection

@section('additional-header')

@endsection

@section('content')
    <div class="col-md-12">
        <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>

            <div class="error-content" style="padding-top: 26px;">
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Halaman Tidak Ditemukan.</h3>

                <p>
                    Kami tidak dapat menemukan apa yang anda inginkan
                </p>
            </div>
            <!-- /.error-content -->
        </div>
    </div>
@endsection