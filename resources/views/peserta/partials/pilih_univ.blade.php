<div class="alert alert-warning">
    - Anda belum memilih universitas. Silahkan pilih universitas terlebih dahulu agar dapat mencetak kartu.<br>
    - Anda <span class="text-red">tidak dapat</span> memilih universitas kembali apabila telah menyimpan<br>
    - Anda dapat memilih satu universitas saja dengan mengabaikan pilihan 2 dan atau pilihan 3
</div>
<form id="isi-univ" method="POST" action="{{route('peserta_pilih_univ_proses')}}">
    {{csrf_field()}}
    <div class="form-group">
        <label >Universitas Pilihan 1*</label>
        <div class="row">
            <div class="col-md-6">
                <select class="form-control" name="univ[1]" id="univ1">
                    <option value="-">-- Pilih Universitas --</option>
                    @foreach($dataUniv as $data)
                        <option value="{{$data->id}}">{{$data->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-control" name="jurusan[1]" id="jurusan1">
                    <option value="-">-- Pilih Prodi --</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label >Universitas Pilihan 2</label>
        <div class="row">
            <div class="col-md-6">
                <select class="form-control" name="univ[2]" id="univ2">
                    <option value="-">-- Pilih Universitas --</option>
                    @foreach($dataUniv as $data)
                        <option value="{{$data->id}}">{{$data->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-control" name="jurusan[2]" id="jurusan2">
                    <option value="-">-- Pilih Prodi --</option>
                </select>
            </div>
        </div>

    </div>
    <div class="form-group">
        <label >Universitas Pilihan 3</label>
        <div class="row">
            <div class="col-md-6">
                <select class="form-control" name="univ[3]" id="univ3">
                    <option value="-">-- Pilih Universitas --</option>
                    @foreach($dataUniv as $data)
                        <option value="{{$data->id}}">{{$data->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-control" name="jurusan[3]" id="jurusan3">
                    <option value="-">-- Pilih Prodi --</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6LdPMhAUAAAAAHkAvO1GZQ0aee8zOCYNO_bY1nHQ"></div>
    </div>
    <div class="form-group">
        <div class="alert alert-info">
            - Pilihan 1 wajib diisi.<br>
            - Data universitas didapatkan dari situs http://sbmptn.ac.id
        </div>
        <input class="btn btn-block btn-primary" value="Simpan" type="submit">
    </div>
</form>

