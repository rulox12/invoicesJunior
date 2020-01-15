<div class="modal fade" id="importModal">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__('Import')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('imports.store') }}" method=post enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6 text-left">
                        <div class="custom-file">
                            <select id="type" class="form-control" name="type">
                                @foreach($types as $type)
                                    <option value="{{ $type['import'] }}">
                                        {{ __($type['name'])  }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 text-left">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" lang="es">
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
</div>
