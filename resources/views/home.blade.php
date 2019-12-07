@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('We are in development with this section')}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">{{__('Export')}}</button>
            </div>
        </div>
    </div>

    <canvas class="my-4" id="myChart" width="900" height="380"></canvas>

@endsection
