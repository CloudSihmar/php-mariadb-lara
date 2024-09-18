<!-- Show delete Modal -->
      <x-jet-confirmation-modal wire:model="confirmItemDeletion">
          <x-slot name="title">
              {{ __('Cancel Leave') }}
          </x-slot>

          <x-slot name="content">
              {{ __('Are you sure you want to cancel?') }}
          </x-slot>

          <x-slot name="footer">
            <x-jet-danger-button class="mr-2" wire:click="destroy({{ $confirmItemDeletion }})" wire:loading.attr="disabled">
                {{ __('Yes') }}
            </x-jet-danger-button>

            <x-jet-secondary-button wire:click="$set('confirmItemDeletion',false)" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-jet-secondary-button>

           
          </x-slot>
      </x-jet-confirmation-modal>