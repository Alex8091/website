@extends('layouts.master')
@section('additional-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/Chart.min.js') }}"></script>
@stop
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-50">
            <h2>Chosen times</h2>
            <div id="chosenTimesData" data-t1="{{{ $times->t1 }}}" data-t2="{{{ $times->t2 }}}" data-t3="{{{ $times->t3 }}}"></div>
            <canvas id="chosenTimes"></canvas>
        </div>
        <div class="grid-50">
            <h2>Confirmed apps</h2>
            <div id="confirmedAppsData" data-co="{{{ $confirmed->co }}}" data-uc="{{{ $confirmed->uc }}}"></div>
            <canvas id="confirmedApps"></canvas>
        </div>
        <div class="grid-100">
            <h2>Point donations</h2>
            <canvas id="pointData" width="1180" height="600"></canvas>
        </div>
    </div>
</div>
@stop
@section('post-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/charts.js') }}"></script>
@stop