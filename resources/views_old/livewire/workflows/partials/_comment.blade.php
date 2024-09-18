<div>
<x-jet-dialog-modal wire:model="writecomment">
    <x-slot name="title">
        <span class="font-bold uppercase"> Write short comment(if any)</span>
    </x-slot>

    <x-slot name="content">
        <div class="m-2">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_division" value="{{ __('Comment/Remark') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="comment" />
                <x-jet-input-error for="comment" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="savecomment" wire:loading.attr="disabled">
            {{ __('Save Comment') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
</div>