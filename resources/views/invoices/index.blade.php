@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h4">{{ __('Invoices')  }}</div>
                <div class="p-2">
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                               id="search">
                    </form>
                </div>
                <div class="p-2">
                    <a href="{{route('invoices.import')}}" class="btn btn btn-primary" role="button"
                       aria-disabled="true">
                        {{__('Import')}}
                    </a>
                    <a href="{{route('invoices.create')}}" class="btn btn btn-primary" role="button"
                       aria-disabled="true">
                        {{__('Create')}}
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
                                <a class="nav-link" href="{{route('invoices.edit.status', $invoice)}}">
                                    <span data-feather="arrow-right-circle"></span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty

                @endforelse

                </tbody>
            </table>

        </div>
    </div>

@endsection

