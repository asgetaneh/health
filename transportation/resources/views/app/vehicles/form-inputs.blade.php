@php $editing = isset($vehicle) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $vehicle->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="plante_number"
            label="Plante Number"
            :value="old('plante_number', ($editing ? $vehicle->plante_number : ''))"
            maxlength="255"
            placeholder="Plante Number"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="level"
            label="Level"
            :value="old('level', ($editing ? $vehicle->level : ''))"
            max="255"
            placeholder="Level"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="total_seats"
            label="Total Seats"
            :value="old('total_seats', ($editing ? $vehicle->total_seats : ''))"
            max="255"
            placeholder="Total Seats"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $vehicle->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="diver_id" label="Diver">
            @php $selected = old('diver_id', ($editing ? $vehicle->diver_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Diver</option>
            @foreach($divers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
