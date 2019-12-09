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

                </dl>
            </div>
        </div>


    </div>
@endsection
