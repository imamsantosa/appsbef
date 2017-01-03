<form enctype="multipart/form-data" method="POST" action="{{route('ExportProcess')}}">
    {{csrf_field()}}
    <input name="file" type="file">
    <input type="submit" value="kirim">
</form>