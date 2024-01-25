@php $editing = isset($diver) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="full_name"
            label="Full Name"
            :value="old('full_name', ($editing ? $diver->full_name : ''))"
            maxlength="255"
            placeholder="Full Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="licence"
            label="Licence"
            :value="old('licence', ($editing ? $diver->licence : ''))"
            maxlength="255"
            placeholder="Licence"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
