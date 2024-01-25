@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('tickets.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.tickets.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.tickets.inputs.route_id')</h5>
                    <span>{{ optional($ticket->route)->id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.tickets.inputs.ticket_number')</h5>
                    <span>{{ $ticket->ticket_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.tickets.inputs.customer_name')</h5>
                    <span>{{ $ticket->customer_name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('tickets.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Ticket::class)
                <a href="{{ route('tickets.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
