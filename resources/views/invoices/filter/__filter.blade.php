<form class="form-inline pull-right" method="GET" action="{{ route('invoices.index') }}">
    <div class="p-2">
        <div class="form-group">
            <select id="type" class="form-control" name="type">
                <option value="consecutive">{{__("Consecutive")}}</option>
                <option value="type">{{__("Type")}}</option>
                <option value="state">{{__("State")}}</option>
                <option value="total">{{__("Total")}}</option>
                <option value="description">{{__("Description")}}</option>
                <option value="customer_id">{{__("Customer")}}</option>
                <option value="seller_id">{{__("Seller")}}</option>
                <option value="other">{{__("Other")}}</option>
            </select>
        </div>
    </div>
    <div id="filter">
        <div class="p-2">
            <div class="form-group">
                <input type="text"
                       class="form-control"
                       id="value"
                       placeholder=""
                       name="value">
            </div>
        </div>
    </div>
    <div class="p-2">
        <button type="submit" class="btn btn-success">
            <span data-feather="search"></span>
        </button>
    </div>
</form>
