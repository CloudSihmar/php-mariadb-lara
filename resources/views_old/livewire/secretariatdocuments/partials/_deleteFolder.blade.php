<!-- Show delete Modal -->
      <x-jet-confirmation-modal wire:model="confirmFolderDeletion">
          <x-slot name="title">
            <div class="flex flex-row items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="#b89311" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13.5H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
              </svg>
              @isset($this->folder)
                  {{ $this->folder->foldername }}
              @endisset
                  
           </div>    
          </x-slot>

          <x-slot name="content">
              {{ __('Are you sure you want to delete the folder?') }}
          </x-slot>

          <x-slot name="footer">
              <x-jet-secondary-button wire:click="$set('confirmFolderDeletion',false)" wire:loading.attr="disabled">
                  {{ __('Cancel') }}
              </x-jet-secondary-button>

              <x-jet-danger-button class="ml-2" wire:click="deleteFolder()" wire:loading.attr="disabled">
                  {{ __('Delete') }}
              </x-jet-danger-button>
          </x-slot>
      </x-jet-confirmation-modal>