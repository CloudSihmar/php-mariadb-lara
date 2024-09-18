<x-jet-dialog-modal wire:model="showactivity">
    <x-slot name="title">
        <span class="font-bold uppercase"> History of the Letter </span>
    </x-slot>

    <x-slot name="content">
    <ol>
        @if(count($this->activityLogs) == 0)
        <span class="text-red-700">There is no comments for this workflow.</a>
        @endif

        @foreach ($this->activityLogs as $item) 
        <li class="border-l-2 border-sky-600">
          <div class="md:flex flex-start">
            <div class="bg-white-600 w-8 h-8 flex items-center justify-center rounded -ml-3.5">
              <img class="h-8 w-8 rounded-full object-cover" src="{{ $item->user->profile_photo_url }}"/>
            </div>
            <div class="block p-3 rounded-lg bg-gray-100 w-full ml-5 mb-5">
              <div class="flex justify-between mb-4">
                <a href="#!" class="font-medium text-sky-600 hover:text-sky-700 focus:text-sky-800 duration-300 transition ease-in-out text-sm"> 
                  @if($item->user->name == $item->forwardto->name)
                      {{ $item->user->name}} Comments
                  @else
                      {{ $item->user->name}} forwarded to {{ $item->forwardto->name}}
                  @endif
                </a>
                <a href="#!" class="font-medium text-sky-600 hover:text-sky-700 focus:text-sky-800 duration-300 transition ease-in-out text-sm">{{ $item->created_at->diffForHumans() }}</a>
              </div>
              <p class="text-gray-700 mb-6">
              {{ $item->message}}
              </p>
            </div>
          </div>
        </li>
        @endforeach
       
    </ol>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Close') }}
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>