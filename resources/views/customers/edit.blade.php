@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h4">{{ __('Edit Customer')  }}</div>

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
            <form action="{{ route('customers.update',$customer) }}" method=post>
                <div class="card-body">
                    @method('PATCH')
                    @include('customers.__form')
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ __('Update Customer') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
