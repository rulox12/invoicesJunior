@extends('layouts.app')

@section('content')
    @include('invoices.filter.__modal-filter')
    <div class="card text-center">
        <div class="card-header">
            <div class="d-flex">
                <div class="mr-auto p-2 h4">{{ __('Invoices')  }}</div>
                @include('invoices.filter.__filter')
                <div class="p-2">
                    <a href="{{route('invoices.create')}}" class="btn btn btn-primary" role="button"
                       aria-disabled="true">
                        {{__('Create')}}
                    </a>
                </div>
                <div class="p-2">
                    <a href="{{route('imports.index')}}" class="btn btn btn-primary" role="button"
                       aria-disabled="true">
                        {{__('Import')}}
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table" id="mytable">
                <thead class="thead-dark">
                <tr class="text-left">
                    <th scope="col">{{__('Consecutive')}}</th>
                    <th scope="col">{{__('Expedition Date')}}</th>
                    <th scope="col">{{__('Type')}}</th>
                    <th scope="col">{{__('Total')}}</th>
                    <th scope="col">{{__('Customer')}}</th>
                    <th scope="col">{{__('State')}}</th>
                    <th class="text-center" scope="col">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($invoices as $invoice)
                    <tr class="text-left">
                        <td>{{ $invoice->consecutive}}</td>
                        <td>{{ $invoice->expedition_date}}</td>
                        <td>{{ $invoice->type }}</td>
                        <td>{{ $invoice->total }}</td>
                        <td>{{ $invoice->customer->name }}</td>
                        <td>
                            @if($invoice->state == 'Approved' )
                                <span class="badge badge-success">{{ __('Approved') }}</span>
                            @elseif($invoice->state == 'Rejected' )
                                <span class="badge badge-danger">{{ __('Rejected') }}</span>
                            @elseif($invoice->state == 'Failed' )
                                <span class="badge badge-danger">{{ __('Failed') }}</span>
                            @elseif($invoice->state == 'Pending')
                                <span class="badge badge-warning">{{ __('Pending') }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group mr-1" role="group" aria-label="First group">
                                <a class="nav-link" href="{{ route('invoices.show', $invoice) }}">
                                    <span data-feather="eye"></span>
                                </a>
                                <a class="nav-link" href="{{route('invoices.edit', $invoice)}}">
                                    <span data-feather="edit"></span>
                                </a>
                                <a class="nav-link" href="{{route('payments.store', $invoice)}}">
                                    <span data-feather="dollar-sign"></span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty

                @endforelse

                </tbody>
            </table>
            {{ $invoices->appends($data)->links() }}
        </div>
    </div>

@endsection
@section('state')
    <script>
        $(document).ready(function () {
            $('#type').on('change', function () {
                if ($(this).val() == "state") {
                    $('#value').replaceWith('' +
                        '<select id="value" name="value" class="form-control">' +
                        '@foreach(Config::get('invoices.state') as $state)' +
                        '<option value="{{ $state }}">{{ __($state) }}</option>' +
                        '@endforeach' +
                        '</select>');
                } else if ($(this).val() == "type") {
                    $('#value').replaceWith('' +
                        '<select id="value" class="form-control" name="value">' +
                        '@foreach(Config::get('invoices.type') as $type)' +
                        '<option value="{{ $type }}">{{ $type  }}</option>' +
                        '@endforeach' +
                        '</select>');
                } else if ($(this).val() == "customer_id") {
                    $('#value').replaceWith('' +
                        '<select id="value" class="form-control" name="value">' +
                        '@foreach($customers as $customer)' +
                        '<option value="{{ $customer->id }}">{{ $customer->name  }}</option>' +
                        '@endforeach' +
                        '</select>');
                } else if ($(this).val() == "seller_id") {
                    $('#value').replaceWith('' +
                        '<select id="value" class="form-control" name="value">' +
                        '@foreach($sellers as $seller)' +
                        '<option value="{{ $seller->id }}">{{ $seller->name  }}</option>' +
                        '@endforeach' +
                        '</select>');
                } else if ($(this).val() == "other") {
                    $("#myModal").modal();
                    $('#value').replaceWith(''+
                        '<input id="value" name="value" type="hidden" value="">');
                } else {
                    $('#value').replaceWith('' +
                        '<input type="text"' +
                        'class="form-control"' +
                        'id="value"' +
                        'name="value">'
                    )
                }
            })
        })
    </script>
@endsection



