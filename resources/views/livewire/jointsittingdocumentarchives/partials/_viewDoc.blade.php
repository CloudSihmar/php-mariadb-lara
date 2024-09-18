<!-- Show delete Modal -->
      <x-jet-dialog-modal wire:model="viewDoc" maxWidth="full">
          <x-slot name="title">
            <div class="flex flex-row justify-between">
              <div>
                 {{ __('View Document') }}
              </div>
              <div>
                 <x-jet-danger-button wire:click="closeModal" wire:loading.attr="disabled">
                  X
                </x-jet-danger-button>
              </div>
            </div>

          </x-slot>
          <x-slot name="content">
            <hr class="my-4">
            <div class="mx-auto">
              <embed height="700" width="100%" src="{{ asset("uploads/$this->view_file") }}" alt="documents">
            </div>   
          </x-slot>
          <x-slot name="footer"></x-slot>
      </x-jet-dialog-modal>