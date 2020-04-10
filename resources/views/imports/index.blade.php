@extends('layouts.app')

@section('content')
    @include('imports.modal.__form-import')
    @include('imports.modal.__form-export')
    <div class="card ">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h2">{{ __('Import or Export')  }}</div>
                <div class="p-2">
                    <a href="{{route('home.index')}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="true">
                        {{__('Back')}}
                    </a>

                </div>
            </div>
        </div>
        <div class="card-body">
            <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-center">
                            <div class="card-header">
                                {{ __('Import')  }}
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ __('Important that your file is well created')  }}</p>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                        data-target="#importModal"
                                        data-toggle="modal">
                                    {{ __('Go')  }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="card text-center">
                            <div class="card-header">
                                {{ __('Export')  }}
                            </div>
                            <div class="card-body">
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                        data-target="#exportModal"
                                        data-toggle="modal">
                                    {{ __('Go')  }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
@endsection
