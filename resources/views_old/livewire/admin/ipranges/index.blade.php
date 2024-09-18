<div>
  <div class="mt-6 w-11/12 mx-auto">
     <nav class="flex justify-between px-5 py-3 mt-4 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="flex items-center">
            <i class="fa fa-cog"></i>
            <a href="{{ route('admin.settings')}}" class="ml-1 font-medium text-gray-700 hover:text-gray-900 md:ml-2">Settings</a>
        </li>
        <li><i class="fa fa-angle-right"></i></li>
        <li>Whitelist IP Range</li>
      </ol>
      <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700">
          Add New 
      </x-jet-button>
    </nav>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mt-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-center">
              <div class="mt-4">
                <x-jet-label for="start_ip" value="{{ __('Start IP Address') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="iprange.start_ip" />
                <x-jet-input-error for="iprange.name" class="mt-2" />
              </div>

              <div class="mt-4">
                <x-jet-label for="end_ip" value="{{ __('End IP Address') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="iprange.end_ip" />
                <x-jet-input-error for="iprange.end_ip" class="mt-2" />
              </div>
              <div class="mt-4 md:mt-10">
                <x-jet-button class="px-10 py-3 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
              </div>
            </div>
            


       <div class="bg-white overflow-hidden shadow sm:rounded-lg mt-2 md:mt-10">
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Start IP</th>
                    <th class="px-4 py-3">End IP</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  @foreach($ipranges as $item)
                  <tr class="text-gray-700">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div>
                          <p class="font-semibold">{!! $item->start_ip !!}</p>
                        </div>
                      </div>
                    </td>

                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div>
                          <p class="font-semibold">{!! $item->end_ip !!}</p>
                        </div>
                      </div>
                    </td>

                    <td class="flex justify-end gap-2 p-2">
                      <button wire:click="edit({{ $item->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-sky-500 hover:text-gray-200">
                          <i class="fa fa-pen fa-lg"></i>
                      </button>    
                      
                      <button wire:click="showDeleteModal({{ $item->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-red-500 hover:text-gray-200">
                          <i class="fa fa-trash fa-lg"></i>
                      </button>  
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
               <!--Delete Modal -->
              @include('livewire.admin.ipranges.partials._delete')
          </div>
        </div>
      </div>
  </div>
</div>
