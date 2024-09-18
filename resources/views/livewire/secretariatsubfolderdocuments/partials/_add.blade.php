 <!-- Show add/Edit Modal -->
<x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        <span class="font-bold uppercase"> {{ isset( $this->secretariatdocument->id) ? 'EDIT' : 'ADD DOCUMENT' }}</span>
    </x-slot>

    <x-slot name="content">
    
      <!-- Document Name -->
    <div class="mt-4">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Document Name *') }}" />
            <x-jet-input type="text" class="block w-full mt-1" wire:model.lazy="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>
    </div>

    <!-- Keyword -->
    <div class="mt-4">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="keyword" value="{{ __('Keyword') }}" />
            <x-jet-input type="text" class="block w-full mt-1" wire:model.lazy="keyword" />
            <x-jet-input-error for="keyword" class="mt-2" />
        </div>
    </div>

    <!-- index -->
     <div class="mt-4">
        <div class="col-span-6 sm:col-span-4">
          <x-jet-label for="file_index" class="font-bold" value="{{ __('File Index') }}" />
          <select name="file_index" wire:model.defer="file_index" class="form-control" >
            <option value="">Select File Index</option>
            @foreach ($fileindexes as $item)
                <option value="{{ $item->name }}">{{ $item->name }}</option>
            @endforeach    
          </select>
          <x-jet-input-error for="csilandlease.gender" class="mt-2" />
        </div>
      </div>

    <!-- File Upload -->
    <div class="relative mt-4">
      <x-jet-label for="description" value="{{ __('Document') }}" />
      <div class="flex w-full"> 
        <div
          x-data="{ isUploading: false, progress: 0 }"
          x-on:livewire-upload-start="isUploading = true"
          x-on:livewire-upload-finish="isUploading = false"
          x-on:livewire-upload-error="isUploading = false"
          x-on:livewire-upload-progress="progress = $event.detail.progress" class="w-full">
          <!-- File Input -->
          <x-jet-input id="document" type="file" class="form-control" wire:model.defer="document" />
          <x-jet-input-error for="document"/>

          <!-- Progress Bar -->
          <div x-show="isUploading">
              <progress max="100" x-bind:value="progress"></progress>
          </div>
        </div>
      </div>
    </div>

    </x-slot>

    <x-slot name="footer">
      <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
          {{ __('Cancel') }}
      </x-jet-secondary-button>

      <x-jet-button class="ml-4 bg-blue-600 hover:bg-blue-500" wire:click.prevent="store" wire:loading.attr="disabled">
        Save
      </x-jet-button> 
    </x-slot>
</x-jet-dialog-modal>