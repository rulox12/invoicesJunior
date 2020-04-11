@extends('layouts.app')

@section('content')
    <div class="container-fluid-login">


        <div class="card text-center">
            <div class="card-body">
                <div class="title">
                    @if($payment->state == \Dnetix\Redirection\Entities\Status::ST_APPROVED)
                        <span class="approved-icon" data-feather="check-circle"></span>
                    @elseif($payment->state == \Dnetix\Redirection\Entities\Status::ST_PENDING)
                        <span class="pending-icon" data-feather="alert-circle"></span>
                    @else
                        <span class="default-icon" data-feather="x-square"></span>
                    @endif

                </div>
                <h2 class="card-title">{{ __($payment->state) }}</h2>
                <p class="card-text">{{ __($payment->state) }}</p>
            </div>
            <div class="card-footer">
                <a href="{{$payment->getReturnUrl()}}" type="button" class="btn btn-secondary">
                    <span data-feather="chevron-left"></span>
                    {{__('back')}}
                </a>
                <a href="{{route('invoices.show', $payment->getInvoiceId())}}" type="button" class="btn btn-secondary">
                    {{__('Invoice')}}
                </a>

            </div>
        </div>
    </div>
@endsection
