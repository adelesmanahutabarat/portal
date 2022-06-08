@extends('layouts.vertical',['isDark'=>true])


@section('css')
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-4 col-xl-6">
        <h4 class="mb-1 mt-0">Dashboard</h4>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-xl-16">
        <div class="card">
            <div class="card-body p-0">
                <div class="media p-3">
                    <div class="media-body">
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Hello, Welcome back</span>
                        <h2 class="mb-0" style="text-transform: capitalize;">{{ Auth::user()->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body p-0">
                <div class="media p-3">
                    <div class="media-body">
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Saldo</span>
                        <h2 class="mb-0">${{$saldo}}</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body p-0">
                <div class="media p-3">
                    <div class="media-body">
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Revenue
                            {{$month['twomonthago']}}</span>
                        <h2 class="mb-0">${{$revenue['twomonthago']}}</h2>
                    </div>
                    <div class="align-self-center">
                        {!! checkPersentaseDashboard($revenue['threemonthago'], $revenue['twomonthago']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body p-0">
                <div class="media p-3">
                    <div class="media-body">
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Revenue
                            {{$month['lastmonth']}}</span>
                        <h2 class="mb-0">${{$revenue['lastmonth']}}</h2>
                    </div>
                    <div class="align-self-center">
                        {!! checkPersentaseDashboard($revenue['twomonthago'], $revenue['lastmonth']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body p-0">
                <div class="media p-3">
                    <div class="media-body">
                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Revenue
                            {{$month['thismonth']}}</span>
                        <h2 class="mb-0">${{$revenue['thismonth']}}</h2>
                    </div>
                    <div class="align-self-center">
                        {!! checkPersentaseDashboard($revenue['lastmonth'], $revenue['thismonth']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- stats + charts -->
<div class="row">

    <div class="col-xl-3">
        <div class="card">
            <div class="card-body p-0">
                <h5 class="card-title border-bottom p-3 mb-0">Overview</h5>
                <!-- stat 1 -->
                <div class="media px-3 py-4 border-bottom">
                    <div class="media-body">
                        <h4 class="mt-0 mb-1 font-size-22">{{count($label)}}</h4>
                        <span class="text-muted">Total Label</span>
                    </div>
                    <i data-feather="disc" class="align-self-center icon-dual icon-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-9">
        <div class="card">
            <div class="card-body pb-0">
                
                <h5 class="card-title mb-0">Revenue Chart</h5>

                <!-- <div id="data-chart" class="apex-charts" dir="ltr"></div> -->
                <canvas id="report-chart" width="400" height="200"></canvas>

            </div>
        </div>
    </div>

</div>
<!-- row -->

@endsection

@push('before-scripts')
<!-- optional plugins -->
<script src="{{ URL::asset('assets/libs/moment/moment.min.js') }}"></script>
<!-- <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
    integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('after-scripts')
<!-- init js -->
<!-- <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script> -->

<script>
const chart = <?= $chart ?>;

const label_chart = <?= $label_chart ?>;
const barChart = new Chart(document.getElementById('report-chart'), {
    type: 'bar',
    data: {
    labels : label_chart,
    datasets : [
      {
        label:'Income',
        backgroundColor : 'rgb(60, 155, 120, 1)',
        borderColor : 'rgba(151, 187, 205, 0.8)',
        highlightFill : 'rgba(151, 187, 205, 0.75)',
        highlightStroke : 'rgba(151, 187, 205, 1)',
        data : chart
      }
    ]
  },
    options: {
        responsive: true,
        maintainAspectRatio: true
    }
})
</script>
@endpush