@props(['options' => []])

@php
    $options = array_merge([
                    'dateFormat' => 'Y-m-d H:i:s',
                    'enableTime' => true,
                    'altFormat' =>  'j F Y H:i:s',
                    'altInput' => true
                    ], $options);
@endphp

<div wire:ignore>
    <input
        x-data="{
             value: @entangle($attributes->wire('model')), 
             instance: undefined,
             init() {
                 $watch('value', value => this.instance.setDate(value, false));
                 this.instance = flatpickr(this.$refs.input, {{ json_encode((object)$options) }});
             }
        }"
        x-ref="input"
        x-bind:value="value"
        type="text"
        {{ $attributes->merge(['class' => 'form-input w-full rounded-md shadow-sm']) }}
    />
</div>