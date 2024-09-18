<div class="mt-6 w-11/12 mx-auto">
   <nav class="flex justify-between px-5 py-3 mt-4 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="flex items-center">
            <i class="fa fa-cog"></i>
            <a href="{{ route('admin.settings')}}" class="ml-1 font-medium text-gray-700 hover:text-gray-900 md:ml-2">Settings</a>
        </li>
        <li><i class="fa fa-angle-right"></i></li>
        <li>Users</li>
      </ol>
      @can('is-admin')
      <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700">
          Add New 
      </x-jet-button>
      @endcan
    </nav>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mx-auto mt-6">
       <div class="bg-white overflow-hidden shadow sm:rounded-lg">
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
          <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
              <thead>
                <tr class="font-medium text-sm text-left text-gray-700 border-b bg-gray-100">
                  <th class="p-3">Sl#</th>
                  <th class="p-3">Name</th>
                  <th class="p-3">Username</th>
                  <th class="p-3">Division</th>
                  <th class="p-3">Role</th>
                  <th class="p-3">Order</th>
                  <th class="w-56 p-3 text-center">Manage Staff</th>
                  <th class="w-32 p-3 text-center">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y">
                @php $counter = ($users->currentPage() - 1) * $users->perPage(); @endphp

                @foreach ($users as $index => $user)
                <tr class="text-gray-700">
                   <td class="p-3">
                    <div class="flex items-center text-sm">
                        {{ ++$counter }}
                    </div>
                  </td>

                  <td class="p-3">
                    <div class="flex items-center text-sm">
                        {{ $user->name }}
                    </div>
                  </td>

                  <td class="p-3">
                    <div class="flex items-center text-sm">
                      <div class="relative hidden mr-1 rounded-full md:block">
                        {{ $user->username }}
                    </div>
                  </td>

                  <td class="p-3">
                    <div class="flex items-center text-sm">
                      <div class="relative hidden mr-3 rounded-full md:block">
                      @isset($user->division->name)
                        {{ $user->division->name }}
                      @endisset
                      </div>
                    </div>
                  </td>

                  <td class="p-3 text-sm">
                    @foreach ($user->roles as $role)
                      <span class="bg-gray-300 text-xs rounded py-2 px-2 text-gray-700">
                      {{ $role->name }}
                      </span>
                    @endforeach
                  </td>

                  <td class="p-3 text-sm">
                      <div class="hidden rounded-full md:block">
                        @isset($user->display_order)
                          {{ $user->display_order	 }}
                        @endisset
                    </div>
                  </td>

                  <td class="flex flex-grow flex-row p-3 text-sm">
                    <button wire:click="supervisor({{ $user->id }})" class="m-1 p-2 rounded text-gray-50 text-xs font-bold focus:border-gray-200 bg-sky-500 hover:text-gray-200">
                      <span class="flex items-center">
                        <i class="fa fa-user mr-1"></i>Supervisor
                      </span>  
                    </button> 
                    
                    <button wire:click="subordinate({{ $user->id }})" class="m-1 p-2 rounded text-gray-50 text-xs font-bold focus:border-gray-200 bg-green-500 hover:text-gray-200">
                        <span class="flex items-center">
                        <i class="fa fa-user-friends mr-1"></i> Subordinate
                      </span>
                    </button>   
                  </td>

                  <td class="p-2 mt-2">
                    <div class="flex flex-row justify-end gap-1 ">
                      <button wire:click="showAssignRole({{ $user->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-green-500 hover:text-gray-200">
                          <i class="fa fa-user-check fa-lg"></i>
                      </button>   

                      <button wire:click="showEditModal({{ $user->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-sky-500 hover:text-gray-200">
                          <i class="fa fa-pen fa-lg"></i>
                      </button>    
                    
                      <!-- <button wire:click="showDeleteModal({{ $user->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-red-500 hover:text-gray-200">
                          <i class="fa fa-trash fa-lg"></i>
                      </button>   -->
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide uppercase border-t bg-gray-50 min-h-min">
            {{ $users->links()}} 
          </div>
        </div>
      </div>
        <!-- Add/Edit Modal -->
        @include('livewire.admin.users.partials._add')
        <!-- Assign Roles -->
        @include('livewire.admin.users.partials._assignroles')
        <!-- Subordinate Staff -->
        @include('livewire.admin.users.partials._subordinate')
        <!-- Subordinate Staff -->
        @include('livewire.admin.users.partials._supervisor')
          <!--Delete Modal -->
        @include('livewire.admin.users.partials._delete')
      </div>
</div>
