@extends('peserta.template')

@section('title')
    Konfirmasi Tiket
@endsection

@section('additional-header')

@endsection

@section('content')
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Upload Foto</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('status'))
                            <div class="alert alert-{{session('status')}}">
                                {{session('message')}}
                            </div>
                        @endif
                        <br>
                        <form method="POST" action="{{route('peserta_upload_foto_proses')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Pilih Foto</label>
                                <input type="file" id="image" name="image" accept="image/*">
                                <p class="help-block">hanya .PNG atau .JPG atau .JPEG dengan ukuran maksimal 100kb yang dapat diunggah</p>
                            </div>
                            <div class="form-group">
                                <img style="display: none" id="preview" src="#" class="img-responsive" alt="Bukti Pembayaran" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info btn-block" value="Upload Bukti Pembayaran">
                            </div>
                        </form>
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
<script>
    $(document).ready(function(){function a(a){if(a.files&&a.files[0]){var b=new FileReader;b.onload=function(a){$("#preview").attr("src",a.target.result)},b.readAsDataURL(a.files[0])}}$("#image").change(function(){a(this),$("#preview").show()})});
</script>
@endsection