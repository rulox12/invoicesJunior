@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="mr-auto p-2 h4">{{ __('Invoice Details') }}</div>
                <div class="p-2">
                    <a href="{{route('invoices.edit', $invoice)}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="true">
                        {{ __('Edit') }}
                    </a>
                </div>
                <div class="p-2">
                    <a href="{{route('invoices.index')}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="false">
                        {{ __('Back') }}
                    </a>
                </div>

            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card-body">
            <div class="container-fluid">
                <br>
                <dl class="row text-center">
                    <dt class="col-md-2 text-left">{{ __('Expedition Date') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->expedition_date }}</dd>
                    <dt class="col-md-2 text-left">{{ __('Due Date') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->due_date }}</dd>
                    <dt class="col-md-2 text-left">{{ __('Type') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->type }}</dd>
                    <dt class="col-md-2 text-left">{{ __('Tax') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->tax }}</dd>
                    <dt class="col-md-2 text-left">{{ __('Description') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->description }}</dd>
                    <dt class="col-md-2 text-left">{{ __('Total') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->total }}</dd>
                    <dt class="col-md-2 text-left">{{ __('State') }}:</dt>
                    <dd class="col-md-4 text-left">{{ __($invoice->state) }}</dd>
                    <dt class="col-md-2 text-left">{{ __('Consecutive') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->consecutive }}</dd>
                    @if($invoice->received_date)
                        <dt class="col-md-2 text-left">{{ __('Received') }}:</dt>
                        <dd class="col-md-2 text-left">{{ $invoice->received_date }}</dd>
                    @else
                        <dt class="col-md-2 text-left">{{ __('Received') }}:</dt>
                        <dd class="col-md-2 text-left">{{ __('Not Received') }}</dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
    <!--Customer-->
    <div class="card card-default">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="mr-auto p-2 h4">{{ __('Customer Details') }}</div>
            </div>
        </div>

        <div class="card-body">
            <div class="container-fluid">
                <br>
                <dl class="row text-center">
                    <dt class="col-md-2 text-left">{{ __('Name') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->customer->name ." ". $invoice->customer->surname }}</dd>
                    <dt class="col-md-2 text-left">{{ __('Identification') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->customer->type_document . " " .$invoice->customer->document }}</dd>
                    @if($invoice->customer->state )
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
    <!--Seller-->
    <div class="card card-default">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="mr-auto p-2 h4">{{ __('Seller Details') }}</div>
            </div>
        </div>

        <div class="card-body">
            <div class="container-fluid">
                <br>
                <dl class="row text-center">
                    <dt class="col-md-2 text-left">{{ __('Name') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->seller->name ." ". $invoice->seller->surname }}</dd>
                    <dt class="col-md-2 text-left">{{ __('Identification') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $invoice->seller->type_document . " " .$invoice->seller->document }}</dd>
                    @if($invoice->seller->state )
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
