@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <div class="d-flex">
                <div class="mr-auto p-2 h2">{{ __('Sellers')  }}</div>
                <form class="form-inline pull-right" method="GET" action="{{ route('sellers.index') }}">
                    <div class="p-2">
                        <div class="form-group">
                            <select id="type" class="form-control" name="type">
                                <option value="name">{{__("Name")}}</option>
                                <option value="surname">{{__("Surname")}}</option>
                                <option value="document">{{__("Identification")}}</option>
                                <option value="state">{{__("State")}}</option>
                            </select>

                        </div>
                    </div>
                    <div class="p-2">
                        <div class="form-group">
                            <input type="text"
                                   class="form-control"
                                   id="value"
                                   placeholder=""
                                   name="value">
                        </div>
                    </div>
                    <div class="p-2">
                        <button type="submit" class="btn btn-secondary">
                            <span data-feather="search"></span>
                        </button>

                    </div>
                </form>
                @can('seller create')
                    <div class="p-2">
                        <a href="{{route('sellers.create')}}" class="btn btn btn-primary" role="button"
                           aria-disabled="true">
                            {{__('Create')}}
                        </a>
                    </div>
                @endcan
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
                @forelse($sellers as $seller)
                    <tr class="text-left">
                        <td>{{ $seller->name ." ". $seller->surname}}</td>
                        <td>{{ $seller->type_document." ". $seller->document }}</td>
                        <td>
                            @if($seller->state)
                                <span class="badge badge-success">{{ __('Enabled') }}</span>
                            @else
                                <span class="badge badge-danger">{{ __('Not Enabled') }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group mr-1" role="group" aria-label="First group">
                                <a class="nav-link" href="{{route('sellers.show', $seller)}}">
                                    <span data-feather="eye"></span>
                                </a>
                                @can('seller edit')
                                    <a class="nav-link" href="{{route('sellers.edit', $seller)}}">
                                        <span data-feather="edit"></span>
                                    </a>
                                    @if($seller->state)
                                        <a class="nav-link" href="{{route('sellers.toggle', $seller)}}">
                                            <i class="fa fa-toggle-on"></i>
                                        </a>
                                    @else
                                        <a class="nav-link" href="{{route('sellers.toggle', $seller)}}">
                                            <i class="fa fa-toggle-off"></i>
                                        </a>
                                    @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty

                @endforelse

                </tbody>
            </table>
            {{ $sellers->appends($data)->links() }}
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
                        '<option value="true">{{__("Active")}}</option>' +
                        '<option value="false">{{__("Inactive")}}</option>' +
                        '</select>');
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
