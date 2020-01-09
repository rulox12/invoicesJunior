<div class="modal fade" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Filter')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('invoices.filter.date') }}">
                    <div class="form-group">
                        <label class="h6" for="document">{{__('Select')}}</label>
                        <select id="type-date" class="form-control" name="type">
                            <option value="due_date">{{__('Due Date')}}</option>
                            <option value="expedition_date">{{__('Expedition Date')}}</option>
                            <option value="received_date">{{__('Received Date')}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="h6" for="type_document">{{__('From')}}</label>
                        <input type="date"
                               class="form-control"
                               id="from"
                               name="from"
                               required>
                    </div>
                    <div class="form-group">
                        <label class="h6" for="type_document">{{__('To')}}</label>
                        <input type="date"
                               class="form-control"
                               id="to"
                               name="to"
                               required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            {{__('Search')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
