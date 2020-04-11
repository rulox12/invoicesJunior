@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h2">{{ __('Edit Role')  }}</div>

                <div class="p-2">
                    <a href="{{route('roles.index')}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="true">
                        {{__('Back')}}
                    </a>

                </div>
            </div>
        </div>
        <div class="card-body">
            <br>
            <form action="{{ route('roles.update',$role) }}" method=post>
                <div class="card-body">
                    @method('PATCH')
                    @include('roles.__form')
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ __('Update Role') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
