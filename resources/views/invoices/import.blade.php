@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2 h4">{{ __('Import Invoice')  }}</div>

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
            <div class="container-fluid">
                <form action="{{ route('invoices.importSave') }}" method=post enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 text-left">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="select_file" name="select_file" lang="es">
                                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 text-left">
                            <div class="custom-file">
                                <button type="submit" class="btn btn-primary">{{__('Import')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
