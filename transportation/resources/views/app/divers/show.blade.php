@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('divers.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.divers.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.divers.inputs.full_name')</h5>
                    <span>{{ $diver->full_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.divers.inputs.licence')</h5>
                    <span>{{ $diver->licence ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('divers.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Diver::class)
                <a href="{{ route('divers.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
