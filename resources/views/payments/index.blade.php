@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-body">
            <div class="card-header">
                <div class="d-flex">
                    <div class="mr-auto p-2 h2">{{ __('Payments')  }}</div>
                </div>
            </div>
            <table class="table table-hover" id="mytable">
                <thead class="thead-dark">
                <tr class="text-left">
                    <th scope="col">{{__('Reference')}}</th>
                    <th scope="col">{{__('Date')}}</th>
                    <th scope="col">{{__('State')}}</th>
                    <th scope="col">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($payments as $payment)
                    <tr class="text-left">
                        <td>{{ $payment->reference}}</td>
                        <td>{{ $payment->reference }}</td>
                        <td>
                            @if($payment->state == \Dnetix\Redirection\Entities\Status::ST_APPROVED )
                                <span class="badge badge-success">{{ __('Approved') }}</span>
                            @elseif($payment->state == \Dnetix\Redirection\Entities\Status::ST_PENDING )
                                <span class="badge badge-warning">{{ __('Pending') }}</span>
                            @else()
                                <span class="badge badge-danger">{{ __($payment->state) }}</span>
                            @endif
                        </td>
                        @can('payment detail')
                            <td class="text-left">
                                <div class="btn-group mr-1" role="group" aria-label="First group">
                                    <a class="nav-link" href="{{ $payment->return_url }}">
                                        <span data-feather="fast-forward"></span>
                                    </a>
                                </div>
                            </td>
                        @endcan
                    </tr>
                @empty
                @endforelse

                </tbody>
            </table>
            {{ $payments->appends($data)->links() }}
        </div>
    </div>

@endsection