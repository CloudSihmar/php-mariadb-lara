<!-- Show delete Modal -->
      <x-jet-dialog-modal wire:model="viewVideo">
          <x-slot name="title">
              {{ __('VIEW VIDEO') }}
          </x-slot>
          <x-slot name="content">
            <hr class="my-4">
            <div class="flex flex-col justify-between gap-2">
              <video width="600" height="300" controls>
                <source src="{{ asset('uploads/' . $this->view_file) }}" type="video/{{ $item->extension}}">
              </video>
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