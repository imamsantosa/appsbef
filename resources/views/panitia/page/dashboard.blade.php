@extends('panitia.template', ['dashboard' => true])

@section('title')
    Dashboard
@endsection

@section('additional-header')

@endsection

@section('breadcumb')
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('panitia_home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <h4><strong>Selamat Datang {{auth('panitia')->user()->fullname}}</strong></h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{$data['status_registrasi_utara']}}</h3>

                    <p>Status Registrasi Utara</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-done"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{$data['status_registrasi_selatan']}}</h3>

                    <p>Status Registrasi Selatan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-done"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{$data['status_registrasi']}}</h3>

                    <p>Status Registrasi Global</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-done"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Panlok Utara</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <td>Status Registrasi</td>
                            <td>:</td>
                            <td>{{$data['status_registrasi_utara']}}</td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td>:</td>
                            <td>{{$data['lokasi_utara']}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Kegiatan</td>
                            <td>:</td>
                            <td>{{$data['tanggal_utara']}}</td>
                        </tr>
                        <tr>
                            <td>Jam Kegiatan Simulasi</td>
                            <td>:</td>
                            <td>{{$data['jam_simulasi_utara']}}</td>
                        </tr>
                        <tr>
                            <td>Jam Kegiatan Expo</td>
                            <td>:</td>
                            <td>{{$data['jam_expo_utara']}}</td>
                        </tr>
                        <tr>
                            <td>Total Peserta</td>
                            <td>:</td>
                            <td>{{$data['peserta_utara']}}</td>
                        </tr>
                        <tr>
                            <td>Total Peserta Saintek</td>
                            <td>:</td>
                            <td>{{$data['saintek_utara']}}</td>
                        </tr>
                        <tr>
                            <td>Total Peserta Soshum</td>
                            <td>:</td>
                            <td>{{$data['soshum_utara']}}</td>
                        </tr>
                        <tr>
                            <td>Total Peserta IPC</td>
                            <td>:</td>
                            <td>{{$data['ipc_utara']}}</td>
                        </tr>
                        <tr>
                            <td>Total Expo</td>
                            <td>:</td>
                            <td>{{$data['expo_utara']}}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Panlok Selatan</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <td>Status Registrasi</td>
                            <td>:</td>
                            <td>{{$data['status_registrasi_selatan']}}</td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td>:</td>
                            <td>{{$data['lokasi_selatan']}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Kegiatan</td>
                            <td>:</td>
                            <td>{{$data['tanggal_selatan']}}</td>
                        </tr>
                        <tr>
                            <td>Jam Kegiatan Simulasi</td>
                            <td>:</td>
                            <td>{{$data['jam_simulasi_selatan']}}</td>
                        </tr>
                        <tr>
                            <td>Jam Kegiatan Expo</td>
                            <td>:</td>
                            <td>{{$data['jam_expo_selatan']}}</td>
                        </tr>
                        <tr>
                            <td>Total Peserta</td>
                            <td>:</td>
                            <td>{{$data['peserta_selatan']}}</td>
                        </tr>
                        <tr>
                            <td>Total Peserta Saintek</td>
                            <td>:</td>
                            <td>{{$data['saintek_selatan']}}</td>
                        </tr>
                        <tr>
                            <td>Total Peserta Soshum</td>
                            <td>:</td>
                            <td>{{$data['soshum_selatan']}}</td>
                        </tr>
                        <tr>
                            <td>Total Peserta IPC</td>
                            <td>:</td>
                            <td>{{$data['ipc_selatan']}}</td>
                        </tr>
                        <tr>
                            <td>Total Expo</td>
                            <td>:</td>
                            <td>{{$data['expo_selatan']}}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistik</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>


    <!-- /.row -->

@endsection

@section('additional-footer')
    <script src="{{url('plugins/chartjs/Chart.min.js')}}"></script>

    <script type="application/javascript">
        $(function(){
            var peserta_utara = "{{$data['peserta_utara']}}";
            var peserta_selatan = "{{$data['peserta_selatan']}}";
            var panitia_utara = "{{$data['panitia_utara']}}";
            var panitia_selatan = "{{$data['panitia_selatan']}}";
            var expo_utara = "{{$data['expo_utara']}}";
            var expo_selatan = "{{$data['expo_selatan']}}";

            var saintek_utara = "{{$data['saintek_utara']}}";
            var saintek_selatan = "{{$data['saintek_selatan']}}";
            var soshum_utara = "{{$data['soshum_utara']}}";
            var soshum_selatan = "{{$data['soshum_selatan']}}";
            var ipc_utara = "{{$data['ipc_utara']}}";
            var ipc_selatan = "{{$data['ipc_selatan']}}";
            var peserta_expo_utara = "{{$data['peserta_expo_utara']}}";
            var peserta_expo_selatan = "{{$data['peserta_expo_selatan']}}";

            var areaChartData = {
                labels: ["Peserta", "Panitia", "Expo Universitas", "Saintek", "Soshum", "IPC", "Peserta Expo"],
                datasets: [
                    {
                        label: "Utara",
                        fillColor: "rgba(210, 214, 222, 1)",
                        strokeColor: "rgba(210, 214, 222, 1)",
                        pointColor: "rgba(210, 214, 222, 1)",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [peserta_utara, panitia_utara, expo_utara,saintek_utara, soshum_utara,ipc_utara,peserta_expo_utara]
                    },
                    {
                        label: "Selatan",
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: [peserta_selatan, panitia_selatan, expo_selatan,saintek_selatan, soshum_selatan,ipc_selatan,peserta_expo_selatan]

                    }
                ]
            };

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData = areaChartData;
            barChartData.datasets[1].fillColor = "#00a65a";
            barChartData.datasets[1].strokeColor = "#00a65a";
            barChartData.datasets[1].pointColor = "#00a65a";
            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                {{--legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",--}}
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
        })
  
    </script>
@endsection