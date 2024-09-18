<div>
  @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/css/pikaday.min.css" integrity="sha512-yFCbJ3qagxwPUSHYXjtyRbuo5Fhehd+MCLMALPAUar02PsqX3LVI5RlwXygrBTyIqizspUEMtp0XWEUwb/huUQ==" crossorigin="anonymous" /> 
  @endpush
  <div class="p-3 bg-gray-100 rounded shadow">
      <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
       <!-- From -->
       <div class="w-full mt-2">
            <div class="col-span-6 sm:col-span-4">
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date('2022-01-01'), maxDate: new Date() })" placeholder="From Starting Date" class="form-control" wire:model.lazy="fromDate" readonly autofocus/>
                <x-jet-input-error for="fromDate" class="mt-2" />
            </div>
        </div>
        

        <!-- To -->
        <div class="w-full mt-2">
            <div class="col-span-6 sm:col-span-4">
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD',maxDate: new Date() })" placeholder="From End Date" class="form-control" wire:model.lazy="toDate" readonly/>
                <x-jet-input-error for="toDate" class="mt-2" />
            </div>
        </div>


        <!-- Search -->
        <div class="flex w-full gap-2 mt-2">   
           <!-- Search -->  
            <x-jet-button class="p-2 font-medium rounded bg-sky-600 hover:bg-sky-500" wire:click="search" wire:loading.attr="disabled">
              <i class="mr-2 fa fa-search fa-lg"></i> {{ __('Search') }}
            </x-jet-button>

            <!-- Report -->
            @can('workflow.report')
              <a href="{{ route('app.workflow.report.applications')}}" class="flex items-center p-2 text-xs font-medium text-white uppercase bg-red-600 rounded hover:bg-red-500">
                <i class="mr-2 fa fa-book-open fa-lg"></i> {{ __('Report') }}
              </a> 
            @endcan

            <a href="{{ route('app.workflow.create') }}" class="flex items-center p-2 text-xs font-medium text-white uppercase bg-green-600 rounded hover:bg-green-500">
             <i class="mr-2 fa fa-plus-circle fa-lg"></i> Create Workflow
            </a>

        </div>
      </div>  
</div>

  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/pikaday.min.js" integrity="sha512-AWC8WaJpos1L8xD++XDtqY3znmqhqDY/o4KZ3wo7kmt1Hx6YjP4ZqPnYDrLg1ymG6iidGzq/UKHS/MxBwVAlwQ==" crossorigin="anonymous"></script>
  @endpush
</div>