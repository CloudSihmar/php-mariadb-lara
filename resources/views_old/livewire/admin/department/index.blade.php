<div>
  <div class="mt-6 w-11/12 mx-auto">
    <nav class="flex justify-between px-5 py-3 mt-4 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="flex items-center">
            <i class="fa fa-cog"></i>
            <a href="{{ route('admin.settings')}}" class="ml-1 font-medium text-gray-700 hover:text-gray-900 md:ml-2">Settings</a>
        </li>
         <li class="flex items-center">
            <i class="fa fa-angle-right"></i>
            <a href="{{ route('admin.agencies')}}" class="ml-1 font-medium text-gray-700 hover:text-gray-900 md:ml-2">Agencies</a>
        </li>
        <li><i class="fa fa-angle-right"></i></li>
        <li>Department</li>
      </ol>
      <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700">
          Add New 
      </x-jet-button>
    </nav>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mt-6">
       <div class="bg-white overflow-hidden shadow sm:rounded-lg">
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                  <th class="px-4 py-3">Agency Name</th>
                  <th class="px-4 py-3">Department</th>
                  <th class="px-4 py-3">Divisions</th>
                  <th class="px-4 py-3 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  @foreach($departments as $item)
                  <tr class="text-gray-700">
                     <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                          <p class="font-semibold">{{ $item->agency->name }}</p>
                      </div>
                    </td>

                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                          <p class="font-semibold">{{ $item->name }}</p>
                      </div>
                    </td>


                     <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <a href="{{ route('admin.department.divisions', $item->id)}}" class="bg-sky-500 px-4 py-2 rounded-full text-white text-sm">
                          <i class="fa fa-border-all fa-lg mr-2"></i>divisions ( {{ $item->divisions->count()}} )
                        </a>
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
               <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
            </div>
            </div>
          </div>
        </div>
        <!-- Add/Edit Modal -->
        @include('livewire.admin.department.partials._add')
          <!--Delete Modal -->
        @include('livewire.admin.department.partials._delete')
      </div>
  </div>
</div>
