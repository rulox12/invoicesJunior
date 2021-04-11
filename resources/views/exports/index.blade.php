@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <div class="d-flex">
                <div class="mr-auto p-2 h2">{{ __('Export')  }}</div>
                <div class="p-2">
                    <a class="btn btn-excel" id="button-class"
                       href="{{route('exports.generateExportInvoice',\App\Entities\Export::EXCEL)}}">
                        <i class="far fa-file-excel"></i> Excel
                    </a>
                    <a class="btn btn-pdf"
                       href="{{route('exports.generateExportInvoice',\App\Entities\Export::PDF)}}">
                        <i class="fas fa-file-pdf"></i> Pdf
                    </a>
                    <a class="btn btn-txt"
                       href="{{route('exports.generateExportInvoice',\App\Entities\Export::TXT)}}">
                        <i class="fas fa-file-alt"></i> Txt
                    </a>
                    <a class="btn btn-html"
                       href="{{route('exports.generateExportInvoice',\App\Entities\Export::HTML)}}">
                        <i class="fab fa-html5"></i> Html
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="mytable">
                <thead class="thead-dark">
                <tr class="text-left">
                    <th scope="col">{{__('State')}}</th>
                    <th scope="col">{{__('Entity')}}</th>
                    <th scope="col">{{__('Type')}}</th>
                    <th scope="col">{{__('User')}}</th>
                    <th scope="col">{{__('Date')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($exports as $export)
                    <tr class="text-left">
                        @if(\App\Entities\Export::SUCCESSFUL == $export->status)
                            <td style="color: #00b002">
                                <i class="fas fa-check-circle"></i>
                                {{ __($export->status)}}
                            </td>
                        @else
                            <td>{{ $export->status}}</td>
                        @endif
                        <td>{{ $export->entity}}</td>
                        <td>{{ $export->type}}</td>
                        <td>{{ $export->user->name}}</td>
                        <td>{{ $export->created_at}}</td>
                    </tr>
                @empty
                @endforelse

                </tbody>
            </table>
            {{ $exports->appends($data)->links() }}
        </div>
    </div>

@endsection