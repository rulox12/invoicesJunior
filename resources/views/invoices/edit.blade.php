@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h2">{{ __('Edit Invoice')  }}</div>

                <div class="p-2">
                    <a href="{{route('invoices.index')}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="true">
                        {{__('Back')}}
                    </a>

                </div>
            </div>
        </div>
        <div class="card-body">
            <br>
            <form action="{{ route('invoices.update', $invoice) }}" method="post"
                  @submit.prevent="$root.validateFirst">
                <div class="card-body">
                    @method('PATCH')
                    @include('invoices.__form')
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ __('Update Invoice') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
