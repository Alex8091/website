@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container streams">
        <div class="grid-100">
            <h2>All online streamers</h2>
            @if (count($twitch) == 0)
                <p>There are no online streams.</p>
            @else
                <p>This page lists all online streams. This data is updated every ten minutes.</p>
            @endif
        </div>
        @if (count($twitch) != 0)
            @include("partials.twitch", array("full" => true))
        @endif
    </div>
</div>
@stop