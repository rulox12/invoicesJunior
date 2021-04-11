@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h2">{{ __('Create Customer')  }}</div>

                <div class="p-2">
                    <a href="{{route('customers.index')}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="true">
                        {{__('Back')}}
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <br>
            <div class="container-fluid">
                <form action="{{ route('customers.store') }}" method=post>
                    @include('customers.__form')
                    <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                </form>
            </div>
        </div>
    </div>

@endsection
