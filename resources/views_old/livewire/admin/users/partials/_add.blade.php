 <!-- Show add/Edit Modal -->
<x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        <span class="font-bold uppercase"> {{ isset($this->user->id) ? 'EDIT' : 'ADD USER' }}</span>
    </x-slot>

    <x-slot name="content">
      <div class="grid gid-cols-1 md:grid-cols-2 gap-4">
        <!-- Agency -->
        <div class="mt-2">
            <x-jet-label for="agency_id" value="{{ __('Select Agency') }}" />
          <select class="form-control" wire:model.lazy="agency_id">
            @foreach ($agencies as $agency)
            <option value="{{ $agency->id }}">{{ $agency->name }} </option>
            @endforeach
          </select>
        </div>

        <!-- department -->
        <div class="mt-2">
          <x-jet-label for="department_id" value="{{ __('Select Parliament *') }}" />
          <select class="form-control" wire:model.lazy="user.department_id">
            <option value=0>--Select--- </option>
            @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }} </option>
            @endforeach
          </select>
           @error('user.department_id') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- division_id -->
        <div class="mt-2">
          <x-jet-label for="division_id" value="{{ __('Select Division/Parliament Member *') }}" />
            <select class="form-control" wire:model.lazy="user.division_id">
                <option value=''>Select Division</option>
                @foreach ($divisions as $item)
                  <option value="{{ $item->id }}">{{ $item->name }} </option>
                @endforeach
            </select>
           @error('user.division_id') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

         <!-- Dzongkhag -->
         <div class="mt-2">
            <x-jet-label for="dzongkhag_id" value="{{ __('Select Dzongkhag *') }}" />
            <select class="form-control" wire:model.lazy="dzongkhag_id">
              <option value=0>Select Dzongkhag</option>
                @foreach ($dzongkhags as $item)
                <option value="{{ $item->id }}">{{ $item->name }} </option>
                @endforeach
            </select>
        </div>
   
         <!-- constituency -->
         <div class="mt-2">
            <x-jet-label for="constituency_id" value="{{ __('Select Constituency') }}" />
            <select class="form-control" wire:model.lazy="constituency_id">
              <option value="0"> -- NA --</option>
                @foreach ($constituencies as $item)
                <option value="{{ $item->id }}">{{ $item->name }} </option>
                @endforeach
            </select>
        </div>

        <!-- Name -->
        <div class="mt-2">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Full Name *') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="user.name" />
                <x-jet-input-error for="user.name" class="mt-2" />
            </div>
        </div>

        <!-- Email -->
        <div class="mt-2">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email *') }}" />
                <x-jet-input type="email"  class="mt-1 block w-full" wire:model.lazy="email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>
        </div>

         <!-- username -->
        <div class="mt-2">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="username" value="{{ __('Username *') }}" />
                <x-jet-input type="text"  class="mt-1 block w-full" wire:model.lazy="username"/>
                 <x-jet-input-error for="username" class="mt-2" />
            </div>
        </div>

         <!-- Contact No -->
         <div class="mt-2">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="contactno" value="{{ __('Contact No *') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="user.contactno" />
                <x-jet-input-error for="user.contactno" class="mt-2" />
            </div>
        </div>

        <!-- positiontitle -->
        <div class="my-2">
            <x-jet-label for="positiontitle" value="{{ __('Position Title') }}" />
          <select class="form-control" wire:model.lazy="positiontitle">
            <option value=0>Select Position Title</option>
            @foreach ($positiontitles as $item)
            <option value="{{ $item->id }}">{{ $item->name }} </option>
            @endforeach
          </select>
        </div>

        <!-- positionlevel -->
         <div class="my-2">
            <x-jet-label for="positionlevel" value="{{ __('Position Level') }}" />
          <select class="form-control" wire:model.lazy="positionlevel">
            <option value=0>Select Position Level</option>
            @foreach ($positionlevels as $item)
            <option value="{{ $item->id }}">{{ $item->name }} </option>
            @endforeach
          </select>
        </div>

        <!-- gender -->
        <div class="my-2">
            <x-jet-label for="gender" value="{{ __('Gender *') }}" />
          <select class="form-control" wire:model.lazy="user.gender">
            <option value=0>Select Gender</option>
            <option value='1'>Male</option>
            <option value='2'>Female</option>
          </select>
          @error('user.gender') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- empid -->
        <div class="mt-2">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="empid" value="{{ __('Employee ID') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="empid" />
                <x-jet-input-error for="empid" class="mt-2" />
            </div>
        </div>

        <!-- cid -->
        <div class="mt-2">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="cid" value="{{ __('CID No') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="cid" />
                <x-jet-input-error for="cid" class="mt-2" />
            </div>
        </div>

         <!-- Status -->
        <div class="mt-2">
          <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="status" value="{{ __('Status *') }}" />
            <select class="form-control" wire:model.lazy="user.status">
                <option value=''>Select Status</option>
                <option value="1">Active</option>
                <option value="2">InActive</option>
            </select>
            @error('user.status') <span class="error text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>
        </div>

        <!-- Display Order -->
        <div class="mt-2">
          <div class="col-span-6 sm:col-span-4">
          <x-jet-label for="display_order" value="{{ __('Display Order') }}" />
          <select class="form-control" wire:model.lazy="display_order">
              <option value='15' selected>15</option>
              <?php 
                  for($i=1; $i<250; $i++){
                    echo "<option value=$i>$i</option>";
                  }
              ?>
          </select>
          </div>
        </div>

          <!-- Password -->
          <div class="mt-2">
            <div class="col-span-6 sm:col-span-4">
              <x-jet-label for="password" value="{{ __('Password') }}" />
              <x-jet-input type="password" class="mt-1 block w-full" wire:model.defer="password" />
              <x-jet-input-error for="password" class="mt-2" />
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="mt-2">
            <div class="col-span-6 sm:col-span-4">
              <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
              <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="password_confirmation" autocomplete="password" />
              <x-jet-input-error for="password_confirmation" class="mt-2" />
            </div>
          </div>
      </div>

    </x-slot>

    <x-slot name="footer">
      <x-jet-button class="mr-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
        {{ isset($this->user->id) ? 'Update' : 'Save' }}
      </x-jet-button>
        
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

      
    </x-slot>
</x-jet-dialog-modal>
