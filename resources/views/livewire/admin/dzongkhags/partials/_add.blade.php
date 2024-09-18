 <!-- Show add/Edit Modal -->
<x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        <span class="font-bold uppercase"> {{ isset( $this->dzongkhag->id) ? 'EDIT' : 'ADD NEW' }}</span>
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="dzongkhag" value="{{ __('Dzongkhag') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="dzongkhag.name" />
                <x-jet-input-error for="dzongkhag.name" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="shortCode" value="{{ __('Short Desc') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="dzongkhag.shortCode" />
                <x-jet-input-error for="dzongkhag.shortCode" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
    <x-jet-button class="mr-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
        {{ __('Save') }}
    </x-jet-button>

    <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
        {{ __('Cancel') }}
    </x-jet-secondary-button>

 
    </x-slot>
</x-jet-dialog-modal>
