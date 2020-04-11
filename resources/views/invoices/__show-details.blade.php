<div id="accordion">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <button class="btn btn-secondary mr-auto h4" style="margin-top: 4px" data-toggle="collapse"
                        data-target="#collapseHome"
                        aria-expanded="false"
                        aria-controls="collapseHome">{{ __('Invoice Details') }}</button>
                @can('invoice edit')
                    <div class="p-2">
                        <a href="{{route('invoices.edit', $invoice)}}" class="btn btn btn-secondary" role="button"
                           aria-disabled="true">
                            {{ __('Edit') }}
                        </a>
                    </div>
                @endcan
                <div class="p-2">
                    <a href="{{route('invoices.index')}}" class="btn btn btn-secondary" role="button"
                       aria-disabled="false">
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
        <div id="collapseHome" class="collapse show" aria-labelledby="headingHome" data-parent="#accordion">

            <div class="card text-center">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="container-fluid">
                        <br>
                        <dl class="row text-center">
                            <dt class="col-md-2 text-left">{{ __('Expedition Date') }}:</dt>
                            <dd class="col-md-4 text-left">{{ $invoice->expedition_date }}</dd>
                            <dt class="col-md-2 text-left">{{ __('Due Date') }}:</dt>
                            <dd class="col-md-4 text-left">{{ $invoice->due_date }}</dd>
                            <dt class="col-md-2 text-left">{{ __('Type') }}:</dt>
                            <dd class="col-md-4 text-left">{{ $invoice->type }}</dd>
                            <dt class="col-md-2 text-left">{{ __('Tax') }}:</dt>
                            <dd class="col-md-4 text-left">{{ $invoice->tax }}</dd>
                            <dt class="col-md-2 text-left">{{ __('Description') }}:</dt>
                            <dd class="col-md-4 text-left">{{ $invoice->description }}</dd>
                            <dt class="col-md-2 text-left">{{ __('Total') }}:</dt>
                            <dd class="col-md-4 text-left">{{ $invoice->total }}</dd>
                            <dt class="col-md-2 text-left">{{ __('State') }}:</dt>
                            <dd class="col-md-4 text-left">{{ __($invoice->state) }}</dd>
                            <dt class="col-md-2 text-left">{{ __('Consecutive') }}:</dt>
                            <dd class="col-md-4 text-left">{{ $invoice->consecutive }}</dd>
                            @if($invoice->received_date)
                                <dt class="col-md-2 text-left">{{ __('Received') }}:</dt>
                                <dd class="col-md-2 text-left">{{ $invoice->received_date }}</dd>
                            @else
                                <dt class="col-md-2 text-left">{{ __('Received') }}:</dt>
                                <dd class="col-md-2 text-left">{{ __('Not Received') }}</dd>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <button class="btn btn-warning" style="margin-top: 4px;color:white" data-toggle="collapse"
                        data-target="#collapseOne"
                        aria-expanded="false"
                        aria-controls="collapseOne">{{ __('Customer Details') }}</button>
            </div>

        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <!--Customer-->
                <div class="card card-default">
                    <div class="card-body">
                        <div class="container">
                            <br>
                            <dl class="row text-center">
                                <dt class="col-md-2 text-left">{{ __('Name') }}:</dt>
                                <dd class="col-md-4 text-left">{{ $invoice->customer->name ." ". $invoice->customer->surname }}</dd>
                                <dt class="col-md-2 text-left">{{ __('Identification') }}:</dt>
                                <dd class="col-md-4 text-left">{{ $invoice->customer->type_document . " " .$invoice->customer->document }}</dd>
                                @if($invoice->customer->state )
                                    <dt class="col-md-2 text-left">{{ __('State') }}:</dt>
                                    <dd class="col-md-2 text-left">{{ __('Active') }}</dd>
                                @else
                                    <dt class="col-md-2 text-left">{{ __('State') }}:</dt>
                                    <dd class="col-md-2 text-left">{{ __('Inactive') }}</dd>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <div class="d-flex justify-content-between">
                <button class="btn btn-info mr-auto h4" style="margin-top: 4px" data-toggle="collapse"
                        data-target="#collapseTwo"
                        aria-expanded="false"
                        aria-controls="collapseTwo">{{ __('Seller Details') }}</button>
            </div>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <!--Seller-->
                <div class="card card-default">


                    <div class="card-body">
                        <div class="container-fluid">
                            <br>
                            <dl class="row text-center">
                                <dt class="col-md-2 text-left">{{ __('Name') }}:</dt>
                                <dd class="col-md-4 text-left">{{ $invoice->seller->name ." ". $invoice->seller->surname }}</dd>
                                <dt class="col-md-2 text-left">{{ __('Identification') }}:</dt>
                                <dd class="col-md-4 text-left">{{ $invoice->seller->type_document . " " .$invoice->seller->document }}</dd>
                                @if($invoice->seller->state )
                                    <dt class="col-md-2 text-left">{{ __('State') }}:</dt>
                                    <dd class="col-md-2 text-left">{{ __('Active') }}</dd>
                                @else
                                    <dt class="col-md-2 text-left">{{ __('State') }}:</dt>
                                    <dd class="col-md-2 text-left">{{ __('Inactive') }}</dd>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree">
            <button class="btn btn-success mr-auto h4" style="margin-top: 4px" data-toggle="collapse"
                    data-target="#collapseThree"
                    aria-expanded="false"
                    aria-controls="collapseThree">{{ __('Payments') }}</button>

        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
                <!--Payments-->
                <div class="card card-default">
                    <table class="table table-hover" id="mytable">
                        <thead class="thead-dark">
                        <tr class="text-left">
                            <th scope="col">{{__('Reference')}}</th>
                            <th scope="col">{{__('Date')}}</th>
                            <th scope="col">{{__('State')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($payments as $payment)
                            <tr class="text-left">
                                <td>{{ $payment->reference}}</td>
                                <td>{{ $payment->reference }}</td>
                                <td>
                                    @if($payment->state == \Dnetix\Redirection\Entities\Status::ST_APPROVED )
                                        <span class="badge badge-success">{{ __('Approved') }}</span>
                                    @elseif($payment->state == \Dnetix\Redirection\Entities\Status::ST_PENDING )
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    @else()
                                        <span class="badge badge-danger">{{ __($payment->state) }}</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>