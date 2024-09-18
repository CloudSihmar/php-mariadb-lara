 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="assignPermission">
          <x-slot name="title">
             <span class="font-bold uppercase">Manage Permissions </span>
          </x-slot>

          <x-slot name="content">

                <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="name" value="{{ __('Role Name') }}" />
                      <span class="flex form-control w-full bg-gray-100"> {{ isset( $this->role->id) ?  $this->role->name : '' }}</span>
                  </div>
                </div>

              <!-- Permission -->
              <div class="my-4 bg-gray-100 shadow rounded p-2">
                <x-jet-label for="selecedpermissions" value="{{ __('Permissions') }}" />
                <div class="my-4 grid grid-cols-3">
                  @foreach ($this->permissions as $index => $permission)
                    <label class="inline-flex items-center mt-3 text-xs">
                      <input type="checkbox" class="focus-within:hidden h-5 w-5 text-green-600 mr-2" wire:model.lazy="selecedpermissions" value="{{$permission->slug}}" <span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                    </label>
                  @endforeach
                </div>
              </div>

          </x-slot>

          <x-slot name="footer">
              <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                  {{ __('Cancel') }}
              </x-jet-secondary-button>

              <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300" wire:click="assignPermission" wire:loading.attr="disabled">
                  {{ __('Save') }}
              </x-jet-button>
          </x-slot>
      </x-jet-dialog-modal>


  @push('scripts')
  @endpush