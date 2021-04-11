@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h2">{{ __('Create Customer')  }}</div>

                <div class="p-2">
                    <a href="{{route('users.index')}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="true">
                        {{__('Back')}}
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <br>
            <div class="container-fluid">
                <form action="{{ route('users.store') }}" method=post
                      oninput='password2.setCustomValidity
                          (password2.value != password.value ? "{{__('Passwords do not match')}}" : "")'>
                    {{ csrf_field() }}
                    @include('users.__form')
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">{{ __('Create User') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
