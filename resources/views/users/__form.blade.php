@csrf
<div class="form-row">
    <div class="form-group col-md-4 text-left">
        <label class="h6" for="type_document">{{__('Type Document')}}</label>
        <select id="type_document" class="form-control" name="type_document">
            <option>CC</option>
            <option>NIT</option>
        </select>
    </div>
    <div class="form-group col-md-4 text-left">
        <label class="h6" for="document">{{__('Identification')}}</label>
        <input type="number"
               class="form-control"
               id="document"
               placeholder="{{__('Identification')}}"
               value="{{ old('document',$user->document ?? '') }}"
               name="document"
               required>
    </div>
    <div class="form-group col-md-4 text-left">
        <label class="h6" for="name">{{__('Name')}}</label>
        <input type="text"
               class="form-control"
               id="name"
               placeholder="{{__('Name')}}"
               name="name"
               value="{{ old('name',$user->name ?? '') }}"
               required>
    </div>

</div>
<div class="form-row">

    <div class="form-group col-md-4 text-left">
        <label class="h6" for="surname">{{__('Surname')}}</label>
        <input type="text"
               class="form-control"
               id="surname"
               placeholder="{{__('Surname')}}"
               name="surname"
               value="{{ old('surname',$user->surname ?? '') }}"
               required>
    </div>
    <div class="form-group col-md-4 text-left">
        <label class="h6" for="email">{{__('Email')}}</label>
        <input type="text"
               class="form-control"
               id="email"
               placeholder="{{__('Email')}}"
               value="{{ old('email',$user->email ?? '') }}"
               name="email"
               required>
    </div>

    @if(isset($index))
        <div class="form-group col-md-4 text-left">
            <label class="h6" for="password">{{__('Password')}}</label>
            <input type="password" class="form-control" id="password" placeholder="{{__('Password')}}"
                   name="password" required>
        </div>
        <div class="form-group col-md-4 text-left">
            <label class="h6" for="password2">{{__('Confirm password')}}</label>
            <input type="password" class="form-control" id="password2" placeholder="{{__('Confirm password')}}"
                   name="password2" required>
        </div>
    @endif

    <div class="form-group col-md-4 text-left">
        <label class="h6" for="role_id">{{__('Role')}}</label>
        <select class="custom-select" multiple data-live-search="true" name="roles[]">
            @foreach($roles as $role)
                <option value="{{ $role }}"
                        {{ in_array($role, $userRole) ? 'selected' : '' }}>
                    {{ $role  }}
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
