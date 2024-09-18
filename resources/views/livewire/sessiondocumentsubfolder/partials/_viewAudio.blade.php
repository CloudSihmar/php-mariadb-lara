<!-- Show delete Modal -->
      <x-jet-dialog-modal wire:model="viewAudio">
          <x-slot name="title">
              {{ __('VIEW AUDIO') }}
          </x-slot>
          <x-slot name="content">
            <hr class="my-4">
            <div class="flex justify-between gap-2">
              <audio controls>
                <source src="{{ asset('uploads/' . $item->document) }}" type="audio/mpeg">
              </audio>

              <div class="mt-2 text-right">
                <button wire:click="download({{ $item->id }})" class="text-xs font-bold uppercase btn-download">
                  Download
                </button>
              </div> 
            </div>   
          </x-slot>

          <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
          </x-slot>
      </x-jet-dialog-modal>