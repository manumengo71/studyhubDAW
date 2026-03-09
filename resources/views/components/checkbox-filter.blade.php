@props(['id', 'name' => "", 'label', 'value' => ''])

<label class="flex items-center mr-4">
    <input type="checkbox" id="{{ $id }}" name="{{ $name }}" class="form-checkbox rounded-md p-2"
        {{ $value ? 'checked' : '' }}>
    <span class="ml-2">{{ $label }}</span>
</label>

