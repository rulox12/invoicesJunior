@csrf
<div class="form-row">
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="type_document">{{__('Type Document')}}</label>
        <select id="type_document" class="form-control" name="type_document">
            <option>CC</option>
            <option>NIT</option>
        </select>
    </div>
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="document">{{__('Identification')}}</label>
        <input type="number"
               class="form-control"
               id="document"
               placeholder="{{__('Identification')}}"
               name="document"
               value="{{ old('document',$seller->document ?? '') }}"
               required>
    </div>

</div>
<div class="form-row">
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="name">{{__('Name')}}</label>
        <input type="text"
               class="form-control"
               id="name" placeholder="{{__('Name')}}"
               name="name"
               value="{{ old('name',$seller->name ?? '') }}"
               required>
    </div>
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="surname">{{__('Surname')}}</label>
        <input type="text"
               class="form-control"
               id="surname"
               placeholder="{{__('Surname')}}"
               value="{{ old('surname',$seller->surname ?? '') }}"
               name="surname" required>
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

