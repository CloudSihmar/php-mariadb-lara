<div>
  <div class="w-11/12 p-2 mx-auto">
    <nav class="flex items-center justify-between w-full p-3 my-2 font-sans font-medium bg-gray-100 rounded">
      <ol class="flex list-reset text-grey-dark">
        <li><a href="{{ route('admin.settings') }}" class="font-gray-800 hover:underline">System Settings</a></li>
        <li><span class="mx-2">/</span></li>
        <li><a href="{{ route('admin.session.document.categories') }}" class="hover:underline">Session Document Categories</a></li>
        <li><span class="mx-2">/</span></li>
        <li class="text-gray-500">{{ \App\Models\Admin\SessiondocCategory::findOrFail($this->catID)->name }}</li>
      </ol>
      <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-600 focus:border-none">
        <i class="text-xl text-yellow-400 fa fa-folder-plus"></i>  <span class="ml-2 text-white">Add New Folder</span>
      </x-jet-button>
    </nav>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mt-6">
       <div class="overflow-hidden bg-white shadow sm:rounded-lg">
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Folder Name</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  @foreach($subcategorys as $item)
                  <tr class="text-gray-700 hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i> {!! $item->name !!}
                    </td>

                    <td class="flex justify-end gap-2 p-2">
                      <button wire:click="showEditModal({{ $item->id }})" class="p-2 text-xs font-bold uppercase rounded text-gray-50 focus:border-gray-200 bg-sky-500 hover:text-gray-200">
                          <i class="fa fa-pen fa-lg"></i>
                      </button>    
                      
                      <button wire:click="showDeleteModal({{ $item->id }})" class="p-2 text-xs font-bold uppercase bg-red-500 rounded text-gray-50 focus:border-gray-200 hover:text-gray-200">
                          <i class="fa fa-trash fa-lg"></i>
                      </button>  
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{ $subcategorys->links()}}
            </div>
          </div>
        </div>
        <!-- Add/Edit Modal -->
        @include('livewire.admin.sessiondocumentsubcategory.partials._add')
          <!--Delete Modal -->
        @include('livewire.admin.sessiondocumentsubcategory.partials._delete')
      </div>
  </div>
</div>
