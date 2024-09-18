 <!-- Show add/Edit Modal -->
<x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        <span class="font-bold uppercase"> {{ isset( $this->booking->id) ? 'EDIT' : 'ADD NEW' }}</span>
    </x-slot>

    <x-slot name="content">
    <div class="mt-2">
            <x-jet-label for="role" value="{{ __('Conference Hall Name') }}"/>
            <select name="hall_id" class="form-control" wire:model.defer="booking.hall_id">
                <option value=''>Select Conference Hall Name</option>
                @foreach ($conferencehalls as $booking)
                  <option value="{{ $booking->id }}">{{ $booking->name }} </option>
                @endforeach
            </select>
          </div>

    <!-- Start Date -->
      <div class="mt-2">
        <div class="col-span-6 sm:col-span-4" wire:ignore>
          <x-jet-label for="start_at" value="{{ __('Select start date and time') }}" />
            <x-input.date-time-picker class="form-control" wire:model.lazy="start_at"/>
        </div>
          <x-jet-input-error for="start_at" class="mt-2" />
      </div>

      <!-- End Date -->
      <div class="mt-2">
        <div class="col-span-6 sm:col-span-4" wire:ignore>
          <x-jet-label for="end_at" value="{{ __('Select end date and time') }}" />
            <x-input.date-time-picker class="form-control" wire:model.lazy="end_at"/>
        </div>
        <x-jet-input-error for="end_at" class="mt-2" />
      </div>
    </x-slot>

    <x-slot name="footer">
    <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
        {{ __('Cancel') }}
    </x-jet-secondary-button>

    <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
        {{ __('Save') }}
    </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
