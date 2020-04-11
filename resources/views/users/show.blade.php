@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="mr-auto p-2 h2">{{ $user->name ." ". $user->surname }}</div>
                @can('user edit')
                    <div class="p-2">
                        <a href="{{route('users.edit', $user)}}" class="btn btn btn-secondary" role="button"
                           aria-disabled="true">
                            {{ __('Edit') }}
                        </a>
                    </div>
                @endcan
                <div class="p-2">
                    <a href="{{route('users.index')}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="false">
                        {{ __('Back') }}
                    </a>
                </div>

            </div>
        </div>

        <div class="card-body">
            <div class="container-fluid">
                <br>
                <dl class="row text-center">
                    <dt class="col-md-2 text-left">{{ __('Identification') }}:</dt>
                    <dd class="col-md-4 text-left">{{ $user->document }}</dd>
                    @if($user->email)
                        <dt class="col-md-2 text-left">{{ __('Email') }}:</dt>
                        <dd class="col-md-4 text-left">{{ $user->email }}</dd>
                    @endif
                    @if($user->email)
                        <dt class="col-md-2 text-left">{{ __('Type Document') }}:</dt>
                        <dd class="col-md-4 text-left">{{ $user->type_document }}</dd>
                    @endif
                    @if(!empty($user->getRoleNames()))
                        <dt class="col-md-2 text-left">{{ __('Type Document') }}:</dt>
                        @foreach($user->getRoleNames() as $roleName)
                            <label class="badge badge-success">{{ $roleName }}</label>
                        @endforeach
                    @endif
                </dl>

            </div>
        </div>


    </div>
@endsection
