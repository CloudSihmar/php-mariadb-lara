<div>
  <div class="w-11/12 mx-auto mt-6">
     <nav class="flex justify-between px-5 py-3 mt-4 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="flex items-center">
            <i class="fa fa-cog"></i>
            <a href="{{ route('admin.settings')}}" class="ml-1 font-medium text-gray-700 hover:text-gray-900 md:ml-2">Settings</a>
        </li>
        <li><i class="fa fa-angle-right"></i></li>
        <li>Roles</li>
      </ol>
      <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700">
          Add New 
      </x-jet-button>
    </nav>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mx-auto mt-6">
       <div class="overflow-hidden bg-white shadow sm:rounded-lg">
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Role Name</th>
                    <th class="px-4 py-3 text-center">Permissions Assigned</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  @foreach ($roles as $role)
                  <tr class="text-gray-700">
                   <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                      <div class="relative hidden mr-3 rounded-full md:block"><i class="fa fa-user"></i></div>
                        {{ $role->name }}
                      </div>
                    </td>

                    <td class="px-4 py-3 text-sm">
                      <div class="grid grid-cols-4 gap-2">
                        @foreach ($role->permissions as $permission)
                          <p class="px-2 py-1 text-xs text-center text-white bg-green-500 rounded-full">
                          {{ $permission->name }}
                          </p>
                        @endforeach
                      </div>
                    </td>

                      <td class="flex justify-end gap-2 p-2">
                          <button wire:click="showAssignPermission({{ $role->id }})" class="p-2 text-xs font-bold uppercase bg-green-500 rounded text-gray-50 focus:border-gray-200 hover:text-gray-200">
                              <i class="fa fa-user-check fa-lg"></i>
                          </button>   

                          <button wire:click="showEditModal({{ $role->id }})" class="p-2 text-xs font-bold uppercase rounded text-gray-50 focus:border-gray-200 bg-sky-500 hover:text-gray-200">
                              <i class="fa fa-pen fa-lg"></i>
                          </button>    
                          
                          <button wire:click="showDeleteModal({{ $role->id }})" class="p-2 text-xs font-bold uppercase bg-red-500 rounded text-gray-50 focus:border-gray-200 hover:text-gray-200">
                              <i class="fa fa-trash fa-lg"></i>
                          </button>  
                        </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{ $roles->links()}}
            </div>
          </div>
        </div>
        <!-- AssignPermission -->
        @include('livewire.admin.roles.partials._managePermission')
        <!-- Add/Edit Modal -->
        @include('livewire.admin.roles.partials._add')
          <!--Delete Modal -->
        @include('livewire.admin.roles.partials._delete')
      </div>
  </div>
</div>
