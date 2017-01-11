@extends('panitia.template', ['expo_tampil' => true])

@section('title')
    Chat Expo
@endsection

@section('additional-header')

@endsection

@section('breadcumb')
    <h1>
        Data Expo
        <small>Chat Expo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Expo</a></li>
        <li class="active">Chat Expo</li>
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
                    <li class=""><a href="{{route('panitia_tampil_expo_universitas', ['id' => $univ->id])}}" >Informasi</a></li>
                    <li class="active"><a href="{{route('panitia_tampil_expo_universitas_chat', ['id' => $univ->id])}}" >Chat</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="direct-chat-messages" id="message-list" style="height: 380px;">


                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <form id="form">
                        <div class="input-group">
                            <input class="form-control" maxlength="250" id="msg" placeholder="Type message...">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success"><i class="fa fa-send"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-footer')
    <div id="sound"></div>
    <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>

    <script>
        var socket = io('192.168.1.70:3000');
        var expo_id = '{{$univ->id}}';
        var user_id = '{{auth('panitia')->user()->id}}';
        var fullname = '{{auth('panitia')->user()->fullname}}';
        var baseurlimagepanitia = '{{route("panitia_photo_panitia_general", ["id" => ""])}}'
        var baseurlimagepeserta = '{{route("panitia_photo_peserta", ["id" => ""])}}'

        $('form').submit(function(){
            var message = $('#msg').val();
            var data = {
                expo_id: expo_id,
                user_id: user_id,
                chat: message,
                fullname: fullname,
            }

            console.log(message)

            if(message != '' || message != null){
                socket.emit('panitia', data);

            }


            $('#msg').val('');
            scrolldown();

            return false;

        });

        socket.on('chat message panitia', function(msg){
            console.log(msg);
            if(msg.user_id == user_id){
                $('#message-list').append(
                        '<div class="row">' +
                        '<div class="col-md-9 col-md-offset-3">' +
                        '<div class="direct-chat-msg right">'+
                        '<div class="direct-chat-info clearfix">' +
                        '<span class="direct-chat-name pull-right text-blue">' +
                        msg.fullname +
                        '</span> ' +
                        '<span class="direct-chat-timestamp pull-left">-</span> ' +
                        '</div> ' +
                        '<img class="direct-chat-img" src="'+baseurlimagepanitia+'/'+msg.user_id+'"> ' +
                        '<div class="direct-chat-text text-right ">' +
                        msg.chat +
                        '</div> ' +
                        '</div>'+
                        '</div>' +
                        '</div>'
                );
            } else {
                $('#message-list').append(

                        '<div class="row">' +
                        '<div class="col-md-9">' +
                        '<div class="direct-chat-msg">'+
                        '<div class="direct-chat-info clearfix">' +
                        '<span class="direct-chat-name pull-left text-blue">' +
                        msg.fullname +
                        '</span> ' +
                        '<span class="direct-chat-timestamp pull-right">-</span> ' +
                        '</div> ' +
                        '<img class="direct-chat-img" src="'+baseurlimagepanitia+'/'+msg.user_id+'"> ' +
                        '<div class="direct-chat-text text-left ">' +
                        msg.chat +
                        '</div> ' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                );

            }
            soundNotif();
            scrolldown();

//            $("#message-list").prop("scrollHeight")



        });

        function scrolldown(){
            var d = $('#message-list');
            d.scrollTop(d.prop("scrollHeight"));
        }

        function soundNotif()
        {
            document.getElementById("sound").innerHTML='<audio autoplay="autoplay"><source src="{{url('notif.mp3')}}" type="audio/mpeg" /><embed hidden="true" autostart="true" loop="false" src="{{url('notif.mp3')}}" /></audio>';
        }
    </script>

@endsection

{{--other peserta --}}
{{--<div class="direct-chat-msg">--}}
    {{--<div class="direct-chat-info clearfix">--}}
        {{--<span class="direct-chat-name pull-left text-green">Alexander Pierce</span>--}}
        {{--<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>--}}
    {{--</div>--}}
    {{--<img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->--}}
    {{--<div class="direct-chat-text">--}}
        {{--Is this template really for free? That's unbelievable!--}}
    {{--</div>--}}
{{--</div>--}}

{{--me peserta--}}
{{--<div class="direct-chat-msg right">--}}
    {{--<div class="direct-chat-info clearfix">--}}
        {{--<span class="direct-chat-name pull-right text-green">Sarah Bullock</span>--}}
        {{--<span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>--}}
    {{--</div>--}}
    {{--<img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->--}}
    {{--<div class="direct-chat-text">--}}
        {{--You better believe it!--}}
    {{--</div>--}}
{{--</div>--}}

{{--other panitia--}}
{{--<div class="direct-chat-msg">--}}
    {{--<div class="direct-chat-info clearfix">--}}
        {{--<span class="direct-chat-name pull-left text-blue">Other</span>--}}
        {{--<span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>--}}
    {{--</div>--}}
    {{--<img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->--}}
    {{--<div class="direct-chat-text">--}}
        {{--Working with AdminLTE on a great new app! Wanna join?--}}
    {{--</div>--}}
{{--</div>--}}

{{--me panitia--}}
{{--<div class="direct-chat-msg right">--}}
    {{--<div class="direct-chat-info clearfix">--}}
        {{--<span class="direct-chat-name pull-right text-blue">Me</span>--}}
        {{--<span class="direct-chat-timestamp pull-left">-</span>--}}
    {{--</div>--}}
    {{--<img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->--}}
    {{--<div class="direct-chat-text">--}}
        {{--I would love to.--}}
    {{--</div>--}}
{{--</div>--}}



