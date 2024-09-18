<x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        <div class="col-span-6 sm:col-span-4">
            <span class="font-bold uppercase"> {{ isset( $this->holidayapp->id) ? 'ADD HOLIDAY' : '' }}</span>
        </div>
       
    </x-slot>

    <x-slot name="content">

        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="holiday_date" value="{{ __('Holiday Date') }}" />
                    <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date() })" class="form-control" wire:model.lazy="holidayapp.holiday_date"/>
                <x-jet-input-error for="holidayapp.holiday_date" class="mt-2 form-control" />
            </div>
        </div>


        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="shortCode" value="{{ __('Short Description ') }}" />
                <x-jet-input type="text" class="form-control" wire:model.lazy="holidayapp.shortCode" />
                <x-jet-input-error for="holidayapp.shortCode" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
        {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
            {{ __('Upate') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>