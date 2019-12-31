@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h4">{{ __('Sellers')  }}</div>
                <div class="p-2">
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                               id="search">
                    </form>
                </div>
                <div class="p-2">
                    <a href="{{route('sellers.create')}}" class="btn btn btn-primary" role="button"
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

                                <a class="nav-link" href="{{route('sellers.edit', $seller)}}">
                                    <span data-feather="edit"></span>
                                </a>


                                @if($seller->state)
                                    <a class="nav-link" href="{{route('sellers.toggle', $seller)}}">
                                        <span data-feather="toggle-left"></span>
                                    </a>
                                @else
                                    <a class="btn btn-link" href="{{route('sellers.toggle', $seller)}}">
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

