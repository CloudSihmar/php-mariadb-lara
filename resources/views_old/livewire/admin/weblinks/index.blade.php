<div>
  <div class="p-2 md:mx-2">
    <nav class="flex justify-between bg-gray-100 p-3 rounded font-sans w-full my-2">
      <ol class="list-reset flex text-grey-dark">
        <li><a href="{{ route('admin.settings') }}" class="text-blue font-bold">System Settings</a></li>
        <li><span class="mx-2">/</span></li>
        <li><a href="{{ route('admin.weblink.categories') }}" class="text-blue font-bold">Web link Categories</a></li>
        <li><span class="mx-2">/</span></li>
        <li>Web Links</li>
      </ol>
      @can('is-admin')
     
      <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-600 hover:bg-blue-700">
        Add New
      </x-jet-button>
      @endcan
    </nav>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mx-auto mt-1">
       <div class="bg-white overflow-hidden shadow sm:rounded-lg">
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Link Name</th>
                    <th class="px-4 py-3">Link url</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  @foreach ($weblinks as $item)
                  <tr class="text-gray-700">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div>
                          <p class="font-semibold">{{ $item->name }}</p>
                        </div>
                      </div>
                  </td>

                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div>
                          <p class="font-semibold">{{ $item->url }}</p>
                        </div>
                      </div>
                    </td>

                      <td class="flex justify-end gap-2 p-2">
                          <button wire:click="showEditModal({{ $item->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-sky-500 hover:text-gray-200">
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
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{ $weblinks->links()}}
            </div>
          </div>
        </div>
      </div>
        <!-- Add/Edit Modal -->
        @include('livewire.admin.weblinks.partials._add')
          <!--Delete Modal -->
        @include('livewire.admin.weblinks.partials._delete')
      </div>
  </div>
</div>
