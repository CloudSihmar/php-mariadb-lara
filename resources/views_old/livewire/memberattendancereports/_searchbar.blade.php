<div class="m-3 w-full ">
  @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/css/pikaday.min.css" integrity="sha512-yFCbJ3qagxwPUSHYXjtyRbuo5Fhehd+MCLMALPAUar02PsqX3LVI5RlwXygrBTyIqizspUEMtp0XWEUwb/huUQ==" crossorigin="anonymous" /> 
  @endpush
  <div class="bg-gray-100 w-full p-3 pt-2 pb-4 rounded shadow">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="w-full text-bold"> Attendance Log</div>
           <!-- From -->
          <div class="mt-2 w-1/2" wire:ignore>
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date('2022-01-01'), maxDate: new Date() })" placeholder="Select Date" class="form-control" wire:model.lazy="fromDate" readonly autofocus/>
              <x-jet-input-error for="fromDate" class="mt-2 form-control" />
        </div>


        <!-- Search -->
        <div class="flex gap-2 mt-2 w-full md:w-6/12">     
            <x-jet-button class="py-2 rounded bg-sky-600 hover:bg-sky-500" wire:click="searchMember" wire:loading.attr="disabled">
              <i class="fa fa-search fa-lg"></i> {{ __('Search') }}
            </x-jet-button>

            <!-- PDF -->
            <a href="{{ route('app.pdf.memberattendancereport.report')}}" class="flex py-2 px-4 text-white rounded bg-red-600 hover:bg-red-500 text-xs uppercase font-bold" target="_blank">
              <i class="fa fa-file-pdf fa-lg mr-2"></i> {{ __('Export') }}
            </a>

            <!-- Back -->
          <a href="{{ route('app.attendance.applications') }}" class="flex items-center text-sm uppercase rounded py-2 px-4 bg-cyan-600 text-white hover:bg-cyan-700">
            <i class="fa fa-long-arrow-alt-left fa-lg mr-2"></i>
            <span class="font-bold"> Back</span>
          </a>

        </div>

      </div>  
  </div>

  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/pikaday.min.js" integrity="sha512-AWC8WaJpos1L8xD++XDtqY3znmqhqDY/o4KZ3wo7kmt1Hx6YjP4ZqPnYDrLg1ymG6iidGzq/UKHS/MxBwVAlwQ==" crossorigin="anonymous"></script>
  @endpush

</div>