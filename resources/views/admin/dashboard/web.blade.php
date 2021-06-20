@extends('layouts.admin.main')
@section('title', 'Dashboard')
@section('content')
    <div class="row" style="margin-left: 1%;margin-right: 1%;">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Pengurus
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pengurus_aktif}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Mahasiswa / {{$ldate = date('Y')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$mahasiswa}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Agenda / {{$ldate = date('Y')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlah_agenda}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Jumlah Pendaftar / {{$ldate = date('Y')}}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pendaftar}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <section>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-bottom: 20px;">
                        <div class="card p-4 mt-3" style="width: 100%; height: 100%">
                            <h4 class="card-header" style="text-align: center; font-size: 15pt; background: none;">
                                GRAFIK TOTAL PENGURUS /
                                TAHUN </h4>
                            <canvas class="card-body" id="chartpengurus"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var ctx = document.getElementById('chartpengurus').getContext('2d');
            var pengeluaran = <?php echo $jumlah; ?>;
            var bulan = <?php echo $tahun; ?>;
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: bulan,
                    datasets: [{
                        label: 'Pengurus',
                        borderColor: '#2C73D2',
                        backgroundColor: '#2C73D2',
                        fill: false,
                        tension: 0,
                        radius: 5,
                        borderWidth: 2,
                        data: pengeluaran
                    }]
                },

                // Configuration options go here
                options: {}
            });
        </script>
    </section>
{{--    chart agenda--}}
    <section>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-bottom: 20px;">
                        <div class="card p-4 mt-3" style="width: 100%; height: 100%">
                            <h4 class="card-header" style="text-align: center; font-size: 15pt; background: none;">
                                GRAFIK TOTAL AGENDA /
                                TAHUN </h4>
                            <canvas class="card-body" id="chartagenda"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var ctx = document.getElementById('chartagenda').getContext('2d');
            var pengeluaran = <?php echo $agenda; ?>;
            var bulan = <?php echo $tahun_agenda; ?>;
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: bulan,
                    datasets: [{
                        label: 'Agenda',
                        borderColor: '#2C73D2',
                        backgroundColor: '#2C73D2',
                        fill: false,
                        tension: 0,
                        radius: 5,
                        borderWidth: 2,
                        data: pengeluaran
                    }]
                },

                // Configuration options go here
                options: {
                    scales:{
                        yAxes:[{
                            ticks:{
                                stepSize:1
                            }
                        }]
                    }
                }
            });
        </script>
    </section>
@endsection
