@csrf
<div class="form-row">
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="type_document">{{__('Due Date')}}</label>
        <input type="datetime-local"
               class="form-control"
               id="due_date"
               @if(isset($invoice))
               value="{{ date('Y-m-d', strtotime($invoice->due_date)).'T'.date('H:i:s', strtotime($invoice->due_date)) }}"
               @endif
               name="due_date"
               required>
    </div>
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="document">{{__('Customers')}}</label>
        <select id="customer_id" class="form-control" name="customer_id">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }} " {{ old('role_id',$invoice->role_id ?? '' ) ==
                        $customer->id ? ' selected' : '' }}>
                    {{ $customer->name  }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="type">{{__('Type')}}</label>
        <select id="type" class="form-control" name="type">
            <option>{{__('Sales Invoice')}}</option>
        </select>
    </div>
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="tax">{{__('Tax')}}</label>
        <input type="number"
               class="form-control"
               id="tax"
               placeholder="{{__('Tax')}}"
               name="tax"
               value="{{ old('total',$invoice->tax ?? '') }}"
               required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="description">{{__('Description')}}</label>
        <textarea type="text"
                  class="form-control"
                  id="description"
                  placeholder="{{__('Description')}}"
                  name="description"
                  required>{{ old('description',$invoice->description ?? '') }}
        </textarea>
    </div>
    <div class="form-group col-md-6 text-left">
        <label class="h6" for="total">{{__('Total')}}</label>
        <input type="number"
               class="form-control"
               id="total"
               placeholder="{{__('Total')}}"
               name="total"
               value="{{ old('total',$invoice->total ?? '') }}"
               required>
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
