@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/css/pikaday.min.css" integrity="sha512-yFCbJ3qagxwPUSHYXjtyRbuo5Fhehd+MCLMALPAUar02PsqX3LVI5RlwXygrBTyIqizspUEMtp0XWEUwb/huUQ==" crossorigin="anonymous" /> 
@endpush
<x-jet-dialog-modal wire:model="approve">
    <x-slot name="title">
        <span class="font-bold uppercase"> Take Action on Leave</span>
    </x-slot>

    <x-slot name="content">
        
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="fromDate" value="{{ __('Starting Date') }}"/>
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date() })" class="form-control" wire:model.lazy="leaveapp.fromDate"/>
                <x-jet-input-error for="fromDate" class="mt-2 form-control" />
            </div>
        </div>

        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="toDate" value="{{ __('End Date') }}" />
                    <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date() })" class="form-control" wire:model.lazy="leaveapp.toDate"/>
                <x-jet-input-error for="toDate" class="mt-2 form-control" />
            </div>
        </div>

        <div class="my-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="status"/>Leave Action <font color="red">*</font>
                
                <select name="status" class="form-control" wire:model="leaveapp.status">
                    <option value=''>Select Action</option>
                    <option value="1">Approved </option>
                    <option value="2">Rejected </option>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="headRemarks" value="{{ __('Your Remarks ') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="leaveapp.headRemarks" />
            </div>
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="update" wire:loading.attr="disabled">
            {{ __('Submit') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/pikaday.min.js" integrity="sha512-AWC8WaJpos1L8xD++XDtqY3znmqhqDY/o4KZ3wo7kmt1Hx6YjP4ZqPnYDrLg1ymG6iidGzq/UKHS/MxBwVAlwQ==" crossorigin="anonymous"></script>
@endpush
