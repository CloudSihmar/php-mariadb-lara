<div class="bg-gray-100 px-4 pt-2 pb-4 my-4 rounded shadow">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">

        <!-- Division -->
     <div class="mt-2 w-full">
	  <select name="division_id" class="form-control" wire:model.defer="division_id">
            <option value=0 selected> Select Division</option>
                    @foreach ($divisions as $division)
                    <!-- <option value="{{ $division->id }}">{{ $division->name }} </option> -->
                      @if(!in_array($division->id,[5,6]))
                          <option value="{{ $division->id }}">{{ $division->name }} </option>
                      @endif
                    @endforeach
      <!--      <option value=''>Select Division</option>
            <option value="7">Digital Service Operation & Maintenance</option>
            <option value="8">Digital Service Transformation</option>
	    <option value="9">Digital Service Development</option>
            
            <option value="4">Hansard and Research Division</option>
             <option value="5">Member</option> 
            <option value="0">All </option>-->
          
          </select>
          <x-jet-input-error for="division_id" class="mt-2" />
	</div> 
<!--<div class="m-2 w-full">
                <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="to_division_id" value="{{ __('Division') }}" />
                  <select class="form-control" wire:model.lazy="to_division_id">
                    @if(isset($to_division_id))
                    <option value={{$to_division_id}} selected>
                    {{ $division = App\Http\Livewire\Utilities::divisionName($to_division_id);}}
                    </option>
                    @endif
                    <option value=0 selected> Select Division</option>
                    @foreach ($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->name }} </option> 
                      @if(!in_array($division->id,[5,6]))
                          <option value="{{ $division->id }}">{{ $division->name }} </option>
                      @endif
                    @endforeach

             </select>
                  <x-jet-input-error for="to_division_id" class="mt-2" />
                </div>
            </div>-->



        <!-- Year -->
        <div class="mt-2 w-full">
          <select name="year" class="form-control" wire:model.defer="year">
          <option value=''>Select Year</option>
            @php
             $start = '2023';
             $end = Date('Y');
            @endphp
            @for($y=$start; $y<=$end; $y++)
            <option value='{{$y}}'>{{$y}}</option>
            @endfor
          </select>
          <x-jet-input-error for="year" class="mt-2" />
        </div>
        
        <!-- Month -->
        <div class="mt-2 w-full">
          <select name="month" class="form-control" wire:model.defer="month">
            <option value=''>Select Month</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
          <x-jet-input-error for="month" class="mt-2" />
        </div>

        <!-- Search -->
        <div class="flex gap-2 mt-2 w-full md:w-6/12">            
            <x-jet-button class="py-2 rounded bg-sky-600 hover:bg-sky-500" wire:click="search" wire:loading.attr="disabled">
              <i class="fa fa-search fa-lg"></i> {{ __('Search') }}
            </x-jet-button>

          <!-- PDF -->
            <a href="{{ route('app.pdf.attendance.report')}}" class="flex items-center py-2 px-4 text-white rounded bg-red-600 hover:bg-red-500 text-xs uppercase font-bold" target="_blank">
              <i class="fa fa-file-pdf fa-lg mr-2"></i> {{ __('Export') }}
            </a>

              <!-- Back -->
          <a href="{{ route('app.attendance.applications') }}" class="flex items-center text-sm uppercase rounded py-2 px-4 bg-cyan-600 text-white hover:bg-cyan-700">
            <i class="fa fa-long-arrow-alt-left fa-lg mr-2"></i>
            <span class="font-bold"> Back</span>
          </a>
          
        </div> 
      </div>  
<!-- </form> -->
</div>
