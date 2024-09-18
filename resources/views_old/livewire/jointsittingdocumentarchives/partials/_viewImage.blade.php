<!-- Show delete Modal -->
      <x-jet-dialog-modal wire:model="viewImage">
          <x-slot name="title">
              {{ __('VIEW PHOTO') }}
          </x-slot>
          <x-slot name="content">
            <hr class="my-4">
            <div class="my-2">
              <img src="{{ asset('uploads/' . $item->document) }}" alt="image">
            </div>   

              <div class="mt-2 text-right">
                <button wire:click="download({{ $item->id }})" class="btn-download text-xs uppercase font-bold">
                  Download
                </button>
              </div>
          </x-slot>

          <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
          </x-slot>
      </x-jet-dialog-modal>