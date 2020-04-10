@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="mr-auto p-2 h2">{{ __('Users Details') }}</div>
                <div class="p-2">
                    <a href="{{route('users.edit', $user)}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="true">
                        {{ __('Edit') }}
                    </a>
                </div>
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
                <div class="col-md-12 text-center"><h4>{{ $user->name ." ". $user->surname }}</h4></div>
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
                    @if($user->role->name )
                        <dt class="col-md-2 text-left">{{ __('Role') }}:</dt>
                        <dd class="col-md-4 text-left">{{ $user->role->name }}</dd>
                    @endif
                </dl>

            </div>
        </div>


    </div>
@endsection
