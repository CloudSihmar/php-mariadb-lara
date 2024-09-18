<div class="px-4 pt-2 pb-4 my-4 bg-gray-100 rounded shadow">
  <div class="flex flex-col justify-between gap-4 md:flex-row">
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

        <!-- Session -->
    <div class="w-full mt-2">
      <select name="session_id" class="form-control" wire:model.lazy="session_id" required>
        <option value=''>Select Session</option>
        @foreach ($parSessions as $item)
          <option value={{$item->id}}>{!! $item->name !!}</option>
        @endforeach  
      </select>
       <x-jet-input-error for="session_id" class="mt-2" />
    </div>

       <!-- categories -->
    <div class="w-full mt-2">
      <select name="category_id" class="form-control" wire:model.lazy="category_id" required>
        <option value=''>Select Categories</option>
        @foreach ($categories as $item)
          <option value={{$item->id}}>{!! $item->name !!}</option>
        @endforeach  
      </select>
      <x-jet-input-error for="category_id" class="mt-2" />
    </div>

     <!-- Search Key -->
    <div class="w-full mt-2">
        <x-jet-input type="text" class="w-full mt-1 form-control" placeholder="search by keyword" wire:model="search_key" />
       <x-jet-input-error for="search_key" class="mt-2" />
    </div>

    <div class="mt-3 w-72">
    <x-jet-button class="py-2 bg-blue-400 rounded hover:bg-blue-300 hover:text-gray-700" wire:click="searchArchives" wire:loading.attr="disabled">
       <i class="fa fa-search fa-lg"></i> {{ __('Search') }}
    </x-jet-button>
    </div>
  </div>
</div>