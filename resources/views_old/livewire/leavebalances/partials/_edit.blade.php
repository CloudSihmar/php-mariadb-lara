<x-jet-dialog-modal wire:model="confirmItemEdit">
    <x-slot name="title">
        <div class="col-span-6 sm:col-span-4">
            <span class="font-bold uppercase"> {{ isset( $this->leavebalanceapp->id) ? 'UPDATE LEAVE RECORD' : '' }}</span>
        </div>
       
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="casual_leave" value="{{ __('Causal Leave Balance ') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" id="casual_leave" wire:model.lazy="leavebalanceapp.casual_leave" />
                <x-jet-input-error for="leavebalanceapp.casual_leave" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="earn_leave" value="{{ __('Earned Leave Balance') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" id="earn_leave" wire:model.lazy="leavebalanceapp.earn_leave" />
                <x-jet-input-error for="leavebalanceapp.earn_leave" class="mt-2" />
            </div>
        </div>


        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="remarks" value="{{ __('Remarks ') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" id="remarks" wire:model.lazy="leavebalanceapp.remarks" />
                <x-jet-input-error for="leavebalance.remarks" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
        {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="update" wire:loading.attr="disabled">
            {{ __('Upate') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
