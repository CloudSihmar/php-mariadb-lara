 <!-- Show add/Edit Modal -->
      <x-jet-dialog-modal wire:model="confirmItemAdd">
          <x-slot name="title">
              <span class="font-bold uppercase"> Attendance - CheckIn</span>
          </x-slot>

          <x-slot name="content">
            <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Check In Date Time') }}" />
                    @php
                        $current_date_time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', now())->setTimezone('Asia/Thimphu');
                    @endphp
                    <x-jet-input type="text" class="mt-1 bg-gray-200 block w-full" placeholder="{{ $current_date_time}}" disabled readonly/>
                </div>
            </div>


            <div class="mt-4">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="inNotes" value="{{ __('Notes') }}" />
                    <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="attendance.inNotes" />
                    <x-jet-input-error for="attendance.inNotes" class="mt-2" />
                </div>
            </div>

          </x-slot>
  
          <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="checkIn" wire:loading.attr="disabled">
                {{ __('CheckIn') }}
            </x-jet-button>
          </x-slot>
      </x-jet-dialog-modal>