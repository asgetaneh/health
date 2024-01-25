@php $editing = isset($ticket) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="route_id" label="Route" required>
            @php $selected = old('route_id', ($editing ? $ticket->route_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Route</option>
            @foreach($routes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="ticket_number"
            label="Ticket Number"
            :value="old('ticket_number', ($editing ? $ticket->ticket_number : ''))"
            maxlength="255"
            placeholder="Ticket Number"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="customer_name"
            label="Customer Name"
            :value="old('customer_name', ($editing ? $ticket->customer_name : ''))"
            maxlength="255"
            placeholder="Customer Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $ticket->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
