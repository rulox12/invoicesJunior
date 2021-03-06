@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h2">{{ __('Edit Seller')  }}</div>

                <div class="p-2">
                    <a href="{{route('sellers.index')}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="true">
                        {{__('Back')}}
                    </a>

                </div>
            </div>
        </div>
        <div class="card-body">
            <br>
            <form action="{{ route('sellers.update',$seller) }}" method=post>
                <div class="card-body">
                    @method('PATCH')
                    @include('sellers.__form')
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ __('Update seller') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
