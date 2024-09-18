 <!-- Show add/Edit Modal -->
<x-jet-dialog-modal wire:model="addNewFolder">
    <x-slot name="title">
        <span class="font-bold uppercase"> {{ isset( $this->sessiondoc->id) ? 'Rename' : 'New Folder' }}</span>
    </x-slot>

    <x-slot name="content">
    
      <!-- Folder Name -->
    <div class="mt-4">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="foldername" value="{{ __('Folder Name *') }}" />
            <x-jet-input type="text" class="block w-full mt-1" wire:model.lazy="foldername" />
            <x-jet-input-error for="foldername" class="mt-2" />
        </div>
    </div>

    </x-slot>

    <x-slot name="footer">
      <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
          {{ __('Cancel') }}
      </x-jet-secondary-button>

      <x-jet-button class="ml-4 bg-blue-600 hover:bg-blue-500" wire:click.prevent="newfolder" wire:loading.attr="disabled">
        Save
      </x-jet-button> 
    </x-slot>
</x-jet-dialog-modal>
