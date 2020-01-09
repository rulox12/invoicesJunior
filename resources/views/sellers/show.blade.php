@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="mr-auto p-2 h4">{{ __('Seller Details') }}</div>
                <div class="p-2">
                    <a href="{{route('sellers.edit', $seller)}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="true">
                        {{ __('Edit') }}
                    </a>
                </div>
                <div class="p-2">
                    <a href="{{route('sellers.index')}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="false">
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="container-fluid">
                <br>
                <dl class="row text-center">
                    <dt class="col-md-2 text-left">{{ __('Name') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $seller->name ." ". $seller->surname }}</dd>
                    <dt class="col-md-2 text-left">{{ __('Identification') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $seller->type_document . " " .$seller->document }}</dd>
                    @if($seller->state )
                        <dt class="col-md-2 text-left">{{ __('State') }}:</dt>
                        <dd class="col-md-2 text-left">{{ __('Active') }}</dd>
                    @else
                        <dt class="col-md-2 text-left">{{ __('State') }}:</dt>
                        <dd class="col-md-2 text-left">{{ __('Inactive') }}</dd>
                    @endif
                </dl>
            </div>
        </div>


    </div>
@endsection
