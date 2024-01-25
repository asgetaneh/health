@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('routes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.routes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.routes.inputs.vehicle_id')</h5>
                    <span>{{ optional($route->vehicle)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.routes.inputs.departure_time')</h5>
                    <span>{{ $route->departure_time ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.routes.inputs.expected_arrival_time')</h5>
                    <span>{{ $route->expected_arrival_time ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.routes.inputs.tariff')</h5>
                    <span>{{ $route->tariff ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.routes.inputs.service_charge')</h5>
                    <span>{{ $route->service_charge ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.routes.inputs.departure_station')</h5>
                    <span
                        >{{ optional($route->departureStation)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.routes.inputs.arrival_station')</h5>
                    <span
                        >{{ optional($route->arrivalStation)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('routes.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Route::class)
                <a href="{{ route('routes.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
