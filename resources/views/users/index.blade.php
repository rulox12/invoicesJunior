@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h4">{{ __('Users')  }}</div>
                <div class="p-2">
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                               id="search">
                    </form>
                </div>
                <div class="p-2">
                    <a href="{{route('users.create')}}" class="btn btn btn-primary" role="button" aria-disabled="true">
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
                    <th scope="col">{{__('Email')}}</th>
                    <th scope="col">{{__('State')}}</th>
                    <th class="text-center" scope="col">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr class="text-left">
                        <td>{{ $user->name ." ". $user->surname}}</td>
                        <td>{{ $user->type_document." ". $user->document }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->state)
                                <span class="badge badge-success">{{ __('Enabled') }}</span>
                            @else
                                <span class="badge badge-danger">{{ __('Not Enabled') }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group mr-1" role="group" aria-label="First group">
                                <a class="nav-link" href="{{route('users.show', $user)}}">
                                    <span data-feather="eye"></span>
                                </a>

                                <a class="nav-link" href="{{route('users.edit', $user)}}">
                                    <span data-feather="edit"></span>
                                </a>
                                @if($user->state)
                                    <a class="nav-link" href="{{route('users.delete', $user)}}">
                                        <span data-feather="user-x"></span>
                                    </a>
                                @else
                                    <a class="btn btn-link" href="{{route('users.delete', $user)}}">
                                        <span
                                            aria-label="{{__('Is inactive')}}"
                                            data-balloon-pos="up-right"
                                            data-feather="user-check">
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

