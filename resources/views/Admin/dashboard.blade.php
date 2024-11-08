@extends('admin.layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="row">
    <div class="col-md-12">
        <h3 class="font-weight-bold">Welcome, {{ Auth::user()->name }}</h3>
        <h6 class="font-weight-normal mb-4">This dashboard represents current data on our Rental (Bot Rental)</h6>
    </div>
</div>

<div class="row">
    <!-- Metrics Cards -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-2">Total Active Users</p>
                        <h3 class="mb-0"></h3>
                    </div>
                    <i class="fas fa-users fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-2">Total Active Drivers</p>
                        <h3 class="mb-0"></h3>
                    </div>
                    <i class="fas fa-car fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-2">Total Active Admins</p>
                        <h3 class="mb-0"></h3>
                    </div>
                    <i class="fas fa-user-shield fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-2">Total Active Operators</p>
                        <h3 class="mb-0"></h3>
                    </div>
                    <i class="fas fa-user-cog fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Favorite Rent Cars for {{ date('M Y') }}</h4>
                <div class="row">
                    <!-- Pie Chart -->
                    <div class="col-md-6">
                        <div id="pieChart"></div>
                    </div>

                    <!-- Car Table -->
                    {{--  <div class="col-md-6">
                        <table class="table table-borderless report-table">
                            @foreach ($mostBookedCar as $value)
                            <tr>
                                <td>{{ $value->car->car_name }}</td>
                                <td class="w-100">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                             style="width: {{ $value->percentage }}%"
                                             aria-valuenow="{{ $value->percentage }}"
                                             aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $value->total_bookings }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $series = array();
    $labels = array();
?>

{{--  @foreach ($mostBookedCar as $value)
<?php
    $series[] = $value->total_bookings;
    $labels[] = $value->car->car_name;
?>  --}}
{{--  @endforeach  --}}

<script type="text/javascript">
    var options = {
        chart: {
            type: 'pie',
            height: 350
        },
        series: {!! json_encode($series) !!},
        labels: {!! json_encode($labels) !!},
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 300
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#pieChart"), options);
    chart.render();
</script>
@endsection
