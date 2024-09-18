<x-jet-dialog-modal wire:model="viewfiles">
    <x-slot name="title">
        <span class="font-bold uppercase"> Attachment files </span>
    </x-slot>

    <x-slot name="content">
        @if(count($this->attachmentFiles) == 0)
        <span class="text-red-700">There is no attachment.</a>
        @endif
        <ul role="list" class="divide-y divide-gray-200 sm:col-span-2 border rounded-md">
          @foreach ($attachmentFiles as $item)
          <li class="hover:bg-gray-50 px-2 py-1 flex items-center justify-between text-sm">
            <div class="w-0 flex-1 flex items-center">
              <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
              </svg>
              <span class="ml-2 flex-1 w-0 truncate"> {{ $item->filename }}</span>
            </div>

            <button class=" flex m-1 px-2 text-gray-700 gap-2 items-center uppercase text-xs" wire:click="download({{ $item->id }})" target="_blank">
                <i class="fa fa-cloud-download-alt text-green-600 text-lg"></i> Download
            </button>

            @if($item->author == Auth::user()->id)
            <button class=" flex m-1 px-2 text-gray-700 gap-2 items-center uppercase text-xs" wire:click.prevent="destroyFile({{$item->id}})" wire:loading.attr="disabled">
                <i class="fa fa-trash-alt text-red-600 text-lg"></i> remove
            </button>
            @endif
          </li>
            @endforeach
        </ul>
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Close') }}
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>