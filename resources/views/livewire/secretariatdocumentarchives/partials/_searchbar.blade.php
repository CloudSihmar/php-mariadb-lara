<div class="px-4 pt-2 pb-4 my-4 rounded shadow  mx-auto">
  <div class="grid grid-col-1 md:grid-cols-3 gap-4">
       <!-- Parliament -->
    <div class="w-full mt-2">
      <select name="parliament_id" class="form-control" wire:model.lazy="parliament_id" required>
        <option value=''>Select Parliament</option>
        @foreach ($parliaments as $item)
          <option value={{$item->id}}>{!! $item->name !!}</option>
        @endforeach  
      </select>
      <x-jet-input-error for="parliament_id" class="mt-2" />
    </div>

       <!-- Divisions -->
    <div class="w-full mt-2">
      <select name="division_id" class="form-control" wire:model.lazy="division_id" required>
        <option value=''>Select Division</option>
        @foreach ($divisions as $item)
          <option value={{$item->id}}>{!! $item->name !!}</option>
        @endforeach  
      </select>
      <x-jet-input-error for="division_id" class="mt-2" />
    </div>

      <!-- FileIndex -->
    <div class="mt-2 w-full">
      <select name="file_index" class="form-control" wire:model.lazy="file_index" required>
        <option value=''>File Index</option>
        @foreach ($fileindexes as $item)
          <option value={{$item->id}}>{!! $item->name !!}</option>
        @endforeach  
      </select>
       <x-jet-input-error for="file_index" class="mt-2" />
    </div>
    
    <!-- Start Date -->
    <div class="mt-2 w-full">
        <div class="col-span-6 sm:col-span-4">
            <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date('2022-01-01'), maxDate: new Date() })" placeholder="Start Date" class="form-control" wire:model.lazy="from_date" readonly autofocus/>
            <x-jet-input-error for="from_date" class="mt-2" />
        </div>
    </div>
    
      <!-- End Date -->
    <div class="mt-2 w-full">
        <div class="col-span-6 sm:col-span-4">
            <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD',maxDate: new Date() })" placeholder="End Date" class="form-control" wire:model.lazy="end_date" readonly/>
            <x-jet-input-error for="end_date" class="mt-2" />
        </div>
    </div>
  
    
      <!-- Search Key -->
    <div class="mt-2 w-full">
        <x-jet-input type="text" class="mt-1 block w-full form-control" placeholder="search key" wire:model="search_key" />
       <x-jet-input-error for="search_key" class="mt-2" />
    </div>
  </div>

  <div class="mt-3  text-center">
    <x-jet-button class="py-2 rounded bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="searchArchives" wire:loading.attr="disabled">
      <i class="fa fa-search fa-lg"></i> {{ __('Search') }}
    </x-jet-button>
  </div>
</div>