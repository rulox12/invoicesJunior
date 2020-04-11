@csrf
<div class="form-row">
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="name">{{__('Name')}}</label>
        <input type="text"
               class="form-control"
               id="name"
               placeholder="{{__('Name')}}"
               name="name"
               value="{{ old('document',$role->name ?? '') }}"
               required>
    </div>
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="description">{{__('Description')}}</label>
        <input type="text"
               class="form-control"
               id="description"
               placeholder="{{__('Description')}}"
               value="{{ old('description',$role->description ?? '') }}"
               name="description" required>
    </div>

    <div class="form-group col-md-12">
        <h3 style="">{{__('Permissions')}}</h3>
        <div class="card">
            <div class="card-body">
                @foreach($permission as $value)
                    <div class="form-check-inline col-md-3">
                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox"
                                       class="form-check-input"
                                       name="permission[]"
                                       value="{{ $value->id  }}"
                                        {{ in_array($value->id, $rolePermissions) ? 'checked="checked"' : '' }}>
                                {{ $value->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
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

