@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Route::class)
                <a href="{{ route('routes.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.routes.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.routes.inputs.vehicle_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.routes.inputs.departure_time')
                            </th>
                            <th class="text-left">
                                @lang('crud.routes.inputs.expected_arrival_time')
                            </th>
                            <th class="text-right">
                                @lang('crud.routes.inputs.tariff')
                            </th>
                            <th class="text-right">
                                @lang('crud.routes.inputs.service_charge')
                            </th>
                            <th class="text-left">
                                @lang('crud.routes.inputs.departure_station')
                            </th>
                            <th class="text-left">
                                @lang('crud.routes.inputs.arrival_station')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($routes as $route)
                        <tr>
                            <td>
                                {{ optional($route->vehicle)->name ?? '-' }}
                            </td>
                            <td>{{ $route->departure_time ?? '-' }}</td>
                            <td>{{ $route->expected_arrival_time ?? '-' }}</td>
                            <td>{{ $route->tariff ?? '-' }}</td>
                            <td>{{ $route->service_charge ?? '-' }}</td>
                            <td>
                                {{ optional($route->departureStation)->name ??
                                '-' }}
                            </td>
                            <td>
                                {{ optional($route->arrivalStation)->name ?? '-'
                                }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $route)
                                    <a
                                        href="{{ route('routes.edit', $route) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $route)
                                    <a
                                        href="{{ route('routes.show', $route) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $route)
                                    <form
                                        action="{{ route('routes.destroy', $route) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">{!! $routes->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
