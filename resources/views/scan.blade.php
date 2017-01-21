
<html>
<head>
    <title>Scan Barcode | Brebes Education Fair 2017</title>
    <meta name="csrf-token" content="{{csrf_token()}}" />

    <style type="text/css">
        body{
            width:100%;
            text-align:center;
        }
        img{
            border:0;
        }
        #main{
            margin: 15px auto;
            background:white;
            overflow: auto;
            width: 100%;
        }
        #header{
            background:white;
            margin-bottom:15px;
        }
        #mainbody{
            background: white;
            width:100%;
            display:none;
        }
        #footer{
            background:white;
        }
        #v{
            width:320px;
            height:240px;
        }
        #qr-canvas{
            display:none;
        }
        #qrfile{
            width:320px;
            height:240px;
        }
        #mp1{
            text-align:center;
            font-size:35px;
        }
        #imghelp{
            position:relative;
            left:0px;
            top:-160px;
            z-index:100;
            font:18px arial,sans-serif;
            background:#f0f0f0;
            margin-left:35px;
            margin-right:35px;
            padding-top:10px;
            padding-bottom:10px;
            border-radius:20px;
        }
        .selector{
            margin:0;
            padding:0;
            cursor:pointer;
            margin-bottom:-5px;
        }
        #outdiv
        {
            width:320px;
            height:240px;
            border: solid;
            border-width: 3px 3px 3px 3px;
        }
        #result{
            border: solid;
            border-width: 1px 1px 1px 1px;
            padding:20px;
            width:70%;
        }

        ul{
            margin-bottom:0;
            margin-right:40px;
        }
        li{
            display:inline;
            padding-right: 0.5em;
            padding-left: 0.5em;
            font-weight: bold;
            border-right: 1px solid #333333;
        }
        li a{
            text-decoration: none;
            color: black;
        }

        #footer a{
            color: black;
        }
        .tsel{
            padding:0;
        }

    </style>
    <script src="{{url('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/llqrcode.js')}}"></script>
    <script type="text/javascript" src="{{url('js/webqr.js')}}"></script>

</head>

<body>
<div id="main">
    <div id="header">
        Brebes Education Fair 2017
    </div>
    <div id="mainbody">
        <table class="tsel" border="0" width="100%">
            <tr>
                <td valign="top" align="center" width="50%">
                    <table class="tsel" border="0">
                        <tr>
                            <td>
                                <img class="selector" id="webcamimg" style="display: none" src="" onclick="setwebcam()" align="left" />
                            </td>
                        <tr>
                            <td colspan="2" align="center">
                                <div id="outdiv">
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <input type="button" value="Scan Lagi" onClick="window.location.reload()">
            <tr>
                <td colspan="3" align="center">
                    <table border="1" style="display: none" id="table-hasil">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td id="nama"></td>
                        </tr>
                        <tr>
                            <td>Asal Sekolah</td>
                            <td>:</td>
                            <td id="asal"></td>
                        </tr>
                        <tr>
                            <td>Nomor</td>
                            <td>:</td>
                            <td id="nomor"></td>
                        </tr>
                        <tr>
                            <td>foto</td>
                            <td>:</td>
                            <td >
                                <img width="100px" src="" id="foto">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>&nbsp;
    <div id="footer">
    </div>
</div>
<canvas id="qr-canvas" width="800" height="600"></canvas>
<script type="text/javascript">load();</script>
</body>

</html>