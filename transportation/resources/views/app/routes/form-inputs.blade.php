@php $editing = isset($route) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="vehicle_id" label="Vehicle" required>
            @php $selected = old('vehicle_id', ($editing ? $route->vehicle_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Vehicle</option>
            @foreach($vehicles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime
            name="departure_time"
            label="Departure Time"
            value="{{ old('departure_time', ($editing ? optional($route->departure_time)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime
            name="expected_arrival_time"
            label="Expected Arrival Time"
            value="{{ old('expected_arrival_time', ($editing ? optional($route->expected_arrival_time)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="tariff"
            label="Tariff"
            :value="old('tariff', ($editing ? $route->tariff : ''))"
            max="255"
            step="0.01"
            placeholder="Tariff"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="service_charge"
            label="Service Charge"
            :value="old('service_charge', ($editing ? $route->service_charge : ''))"
            max="255"
            step="0.01"
            placeholder="Service Charge"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="departure_station"
            label="Departure Station"
            required
        >
            @php $selected = old('departure_station', ($editing ? $route->departure_station : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Station Or Town</option>
            @foreach($stationOrTowns as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="arrival_station"
            label="Arrival Station"
            required
        >
            @php $selected = old('arrival_station', ($editing ? $route->arrival_station : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Station Or Town</option>
            @foreach($stationOrTowns as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="Created By">
            @php $selected = old('user_id', ($editing ? $route->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
