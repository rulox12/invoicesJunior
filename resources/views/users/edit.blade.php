@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h4">{{ __('Edit User')  }}</div>

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
            <form action="{{ route('users.update',$user) }}" method=post
                  oninput='password2.setCustomValidity
                      (password2.value != password.value ? "{{__('Passwords do not match')}}" : "")
                      '>
                <div class="card-body-create">
                    @method('PATCH')
                    @include('users.__form')
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ __('Update User') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
