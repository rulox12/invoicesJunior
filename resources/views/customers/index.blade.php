@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h4">{{ __('Customers')  }}</div>
                <div class="p-2">
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                               id="search">
                    </form>
                </div>
                <div class="p-2">
                    <a href="{{route('customers.create')}}" class="btn btn btn-primary" role="button"
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
                    <th scope="col">{{__('Name')}}</th>
                    <th scope="col">{{__('Identification')}}</th>
                    <th scope="col">{{__('State')}}</th>
                    <th class="text-center" scope="col">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                    <tr class="text-left">
                        <td>{{ $customer->name ." ". $customer->surname}}</td>
                        <td>{{ $customer->type_document." ". $customer->document }}</td>
                        <td>
                            @if($customer->state)
                                <span class="badge badge-success">{{ __('Enabled') }}</span>
                            @else
                                <span class="badge badge-danger">{{ __('Not Enabled') }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group mr-1" role="group" aria-label="First group">
                                <a class="nav-link" href="{{route('customers.show', $customer)}}">
                                    <span data-feather="eye"></span>
                                </a>

                                <a class="nav-link" href="{{route('customers.edit', $customer)}}">
                                    <span data-feather="edit"></span>
                                </a>


                                @if($customer->state)
                                    <a class="nav-link" href="{{route('customers.toggle', $customer)}}">
                                        <span data-feather="toggle-left"></span>
                                    </a>
                                @else
                                    <a class="btn btn-link" href="{{route('customers.toggle', $customer)}}">
                                        <span
                                            aria-label="{{__('Is inactive')}}"
                                            data-balloon-pos="up-right"
                                            data-feather="toggle-right">
                                        </span>
                                    </a>
                                @endif
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

