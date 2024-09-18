 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="assignRole">
          <x-slot name="title">
             <span class="font-bold uppercase">Assign Roles </span>
          </x-slot>

          <x-slot name="content">

                 <div class="mt-4">
                  <div class="col-span-6 sm:col-span-4">
                      <x-jet-label for="name" value="{{ __('User Name') }}" />
                      <span class="flex form-control w-full bg-gray-100"> {{ isset( $this->user->id) ?  $this->user->name : '' }}</span>
                  </div>
              </div>

              <!-- role -->
               <div class="my-4">
                <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="role" value="{{ __('Roles') }}" />
                  <select name="role" class="form-control" wire:model.defer="role_id">
                      <option value=''>Select Role</option>
                      @foreach ($this->roles as $role)
                       <option value="{{ $role->id }}">{{ $role->name }} </option>
                      @endforeach
                  </select>
                </div>
              </div>

          </x-slot>

          <x-slot name="footer">
              <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                  {{ __('Cancel') }}
              </x-jet-secondary-button>

              <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="assignRole" wire:loading.attr="disabled">
                  {{ __('Save') }}
              </x-jet-button>
          </x-slot>
      </x-jet-dialog-modal>