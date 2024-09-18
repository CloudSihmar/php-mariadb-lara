<div>
  <div class="bg-gray-100 px-4 pt-2 pb-4 my-4 rounded shadow">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">

       <!-- From -->
       <div class="mt-2 w-full">
            <div class="col-span-6 sm:col-span-4">
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date('2022-01-01'), maxDate: new Date() })" placeholder="Receive Starting Date" class="form-control" wire:model.lazy="fromDate" readonly autofocus/>
              <x-jet-input-error for="fromDate" class="mt-2 form-control" />
            </div>
        </div>

        <!-- From -->
        <div class="mt-2 w-full">
            <div class="col-span-6 sm:col-span-4">
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD',maxDate: new Date() })" placeholder="Receive End Date" class="form-control" wire:model.lazy="toDate" readonly/>
              <x-jet-input-error for="toDate" class="mt-2 form-control" />
            </div>
        </div>

        <!-- Dispatch Number -->
        <div class="mt-2 w-full">
        <x-jet-input type="text" placeholder="Dak Number" class="mt-1 block w-full" wire:model.lazy="dakNumber" />
        </div>

      
        <div class="flex gap-2 mt-2 w-full md:w-6/12">   
            <!-- Search -->
            <x-jet-button class="py-2 rounded bg-sky-600 hover:bg-sky-500" wire:click="search" wire:loading.attr="disabled">
              <i class="fa fa-search fa-lg"></i> {{ __('Search') }}
            </x-jet-button>

              <!-- PDF -->
              <a href="{{ route('app.pdf.searchreceiveletter.report')}}" class="flex items-center py-2 px-4 text-white rounded bg-red-600 hover:bg-red-500 text-xs uppercase font-bold" target="_blank">
                <i class="fa fa-file-pdf fa-lg mr-2"></i> <span>{{ __('Export') }}</span>
              </a>

        </div>
      </div>  
</div>
</div>