<div>
  @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/css/pikaday.min.css" integrity="sha512-yFCbJ3qagxwPUSHYXjtyRbuo5Fhehd+MCLMALPAUar02PsqX3LVI5RlwXygrBTyIqizspUEMtp0XWEUwb/huUQ==" crossorigin="anonymous" /> 
  @endpush
  <div class="bg-gray-100 px-4 pt-2 pb-4 my-4 rounded shadow">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">

       <!-- From -->
       <div class="mt-2 w-full">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="start_at" value="{{ __('Start Date') }}" />
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date('2022-01-01') })" placeholder="Start Date" class="form-control" wire:model.lazy="start_at" readonly autofocus/>
              <x-jet-input-error for="start_at" class="mt-2" />
            </div>
        </div>

        <!-- To -->
        <div class="mt-2 w-full">
            <div class="col-span-6 sm:col-span-4">
               <x-jet-label for="end_at" value="{{ __('End Date') }}" />
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD' })" placeholder="End Date" class="form-control" wire:model.lazy="end_at" readonly/>
              <x-jet-input-error for="end_at" class="mt-2" />
            </div>
        </div>

           <!-- Conference Halls -->
        <div class="mt-2 w-full">
          <x-jet-label for="start_at" value="{{ __('Select Conference halls') }}" />
          <select name="hall_id" class="form-control" wire:model.defer="hall_id">
          <option value=''> All halls </option>
            @foreach ($conferencehalls as $hall)
            <option value='{{$hall->id}}'>{{$hall->name}}</option>
            @endforeach
          </select>
          <x-jet-input-error for="hall_id" class="mt-2" />
        </div>

        <!-- Search -->
        <div class="flex gap-2 mt-6 w-full md:w-6/12">     
            <x-jet-button class="py-2 rounded bg-sky-600 hover:bg-sky-500" wire:click="search" wire:loading.attr="disabled">
              <i class="fa fa-search fa-lg"></i> {{ __('Search') }}
            </x-jet-button>

            <!-- PDF -->
            <a href="{{ route('app.pdf.booking.report')}}" class="flex items-center py-2 px-4 text-white rounded bg-red-600 hover:bg-red-500 text-xs uppercase font-bold" target="_blank">
              <i class="fa fa-file-pdf fa-lg mr-2"></i> {{ __('Export') }}
            </a>
        </div>
      </div>  
</div>

  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/pikaday.min.js" integrity="sha512-AWC8WaJpos1L8xD++XDtqY3znmqhqDY/o4KZ3wo7kmt1Hx6YjP4ZqPnYDrLg1ymG6iidGzq/UKHS/MxBwVAlwQ==" crossorigin="anonymous"></script>
  @endpush
</div>