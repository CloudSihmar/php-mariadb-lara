<div class="flex flex-wrap mt-2 rounded gap-1 md:gap-2 justify-between bg-gray-100 p-4">
   <div class="w-6/12">
      <div class="my-2 w-full">
          <label class="text-gray-600 text-sm font-bold"> <i class="fa fa-paperclip"></i> Attachments </label> 
          <input id="filename" type="text" placeholder="File Name" class="border border-gray-300 text-sm text-gray-500 py-2 px-4 mt-1 block w-full rounded" wire:model.defer="filename" required>
          <x-jet-input-error for="filename" class="mt-2"/>
      </div>
      <div class="flex w-full"> 
        <div
          x-data="{ isUploading: false, progress: 0 }"
          x-on:livewire-upload-start="isUploading = true"
          x-on:livewire-upload-finish="isUploading = false"
          x-on:livewire-upload-error="isUploading = false"
          x-on:livewire-upload-progress="progress = $event.detail.progress">
          <!-- File Input -->
          <x-jet-input id="attachment" type="file" class="bg-white rounded-none rounded-l border  text-xs text-gray-500 py-2 px-2  block w-full" wire:model.defer="attachment" />
          <x-jet-input-error for="attachment"/>

          <!-- Progress Bar -->
          <div x-show="isUploading">
              <progress max="100" x-bind:value="progress"></progress>
          </div>

           <!-- File Attaxchement Error-->
            <!-- <x-jet-input-error for="attachment"/> -->
        </div>

        <button class="flex text-xs font-bold uppercase items-center  bg-cyan-500 text-white px-2 rounded-r" wire:click.prevent="store" wire:loading.attr="disabled">
          <i class="fa fa-cloud-upload-alt fa-lg pr-2"></i> Upload
        </button> 
      </div>
    </div>

    <div class="w-5/12 mt-4">
        <x-jet-label for="overview" class="text-sm pb-2 font-normal" value="{{ __('Attached Files') }}" />
        <ul role="list" class="divide-y divide-gray-200 sm:col-span-2 border rounded-md">
          @foreach ($attachments as $item)
          <li class="hover:bg-gray-50 px-2 py-1 flex items-center justify-between text-sm">
            <div class="w-0 flex-1 flex items-center">
              <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
              </svg>
              <span class="ml-2 flex-1 w-0 truncate"> {{ $item->filename }}</span>
            </div>
            <button class=" flex m-1 px-2 text-gray-700 gap-2 items-center uppercase text-xs" wire:click.prevent="destroy({{$item->id}})" wire:loading.attr="disabled">
            <i class="fa fa-trash-alt text-red-600 text-lg"></i> remove
          </button>
          </li>
            @endforeach
        </ul>
    </div>
</div>