@extends('layouts.app')

@section('content')

    <div class="card text-center">
        <div class="card-header">
            <div class="d-flex">
                <div class="mr-auto p-2 h2">{{ __('Roles')  }}</div>
                <div class="p-2">
                    <a href="{{route('roles.create')}}" class="btn btn btn-primary" role="button"
                       aria-disabled="true">
                        {{__('Create')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="mytable">
                <thead class="thead-dark">
                <tr class="text-left">
                    <th scope="col">{{__('Role')}}</th>
                    <th scope="col">{{__('Guard Name')}}</th>
                    <th scope="col">{{__('Description')}}</th>
                    <th class="text-center" scope="col">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($roles as $role)
                    <tr class="text-left">
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                        <td>{{ $role->description }}</td>

                        <td class="text-center">
                            <div class="btn-group mr-1" role="group" aria-label="First group">
                                <a class="nav-link" href="{{route('roles.edit', $role)}}">
                                    <span data-feather="edit"></span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse

                </tbody>
            </table>
            {!! $roles->render() !!}
        </div>
    </div>

@endsection
