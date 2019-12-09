@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h4">{{ __('Edit Invoice')  }}</div>

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
            <form action="{{ route('invoices.update.status', $invoice->id) }}" method="post"
                  @submit.prevent="$root.validateFirst">
                <div class="card-body">
                    @method('PATCH')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 text-left">
                            <label class="h6" for="state">{{__('State')}}</label>
                            <select id="state" class="form-control" name="state">
                                @foreach($states as $status)
                                    <option value="{{$status}}">
                                        {{ __($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ __('Update Invoice') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
