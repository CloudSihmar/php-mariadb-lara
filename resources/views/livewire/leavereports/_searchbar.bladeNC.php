<div>
  <div class="bg-gray-100 px-4 pt-2 pb-4 my-4 rounded shadow">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
       <!-- From -->
       <div class="mt-2 w-full">
            <div class="col-span-6 sm:col-span-4">
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date('2022-01-01'), maxDate: new Date() })" placeholder="Start Date" class="form-control" wire:model.lazy="fromDate" readonly autofocus/>
                <x-jet-input-error for="fromDate" class="mt-2" />
            </div>
        </div>
        

        <!-- To -->
        <div class="mt-2 w-full">
            <div class="col-span-6 sm:col-span-4">
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD',maxDate: new Date() })" placeholder="End Date" class="form-control" wire:model.lazy="toDate" readonly/>
                <x-jet-input-error for="toDate" class="mt-2" />
            </div>
        </div>

        <!-- Leave Category -->
        <div class="mt-2 w-full">
          <select name="month" class="form-control" wire:model.defer="leaveType">
          <option value='0'>--Select Leave Type ---</option>
            @foreach ($leavecategories as $ltype)
            <option value={{$ltype->id}}>{{$ltype->name}}</option>
            @endforeach
            <option value=0>All</option>
          </select>
          <x-jet-input-error for="leaveType" class="mt-2" />
        </div>

        @if(in_array(Auth::user()->division_id,[5,6]))
          <!-- NC -->
          <div class="mt-2 w-full">
            <select class="form-control" wire:model.defer="division_id">
                <option value="">Select the filter</option>
                <option value="5">National Council Member(NC)</option>
            </select>
            <x-jet-input-error for="division_id" class="mt-2" />
          </div>
        @else
        <!-- Division  -->
        <div class="mt-2 w-full">
          <select class="form-control" wire:model.defer="division_id">
              <option value='0'>Select Division</option>
                  @foreach ($divisions as $division)
                    @if($division->id !=5)
                      <option value="{{ $division->id }}">{{ $division->name }} </option>
                    @endif
                  @endforeach
                  <option value="0">All</option>
          </select>
          <x-jet-input-error for="division_id" class="mt-2" />
        </div>
        @endif

        <!-- Search -->
        <div class="flex gap-2 mt-2 w-full md:w-6/12">     
            <x-jet-button class="py-2 rounded bg-sky-600 hover:bg-sky-500" wire:click="search" wire:loading.attr="disabled">
              <i class="fa fa-search fa-lg"></i> {{ __('Search') }}
            </x-jet-button>

            <!-- PDF -->
              <a href="{{ route('app.pdf.leave.report')}}" class="flex items-center py-2 px-4 text-white rounded bg-red-600 hover:bg-red-500 text-xs uppercase font-bold" target="_blank">
              <i class="fa fa-file-pdf fa-lg mr-2"></i> <span>{{ __('Export') }}</span>
            </a>
        </div>
      </div>  
</div>
</div>