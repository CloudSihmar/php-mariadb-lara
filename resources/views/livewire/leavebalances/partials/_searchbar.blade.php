<div class="bg-gray-100 px-4 pt-2 pb-4 my-4 rounded shadow">
      <div class="w-full flex flex-col md:flex-row items-center">
        <!-- Division -->
        <div class="mt-2 w-full">
          <select name="division_id" class="form-control" wire:model.defer="division_id">
           <option value=''>Select Division</option>
              @foreach($divisions as $item)
              @if($item->id<19)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endif
              @endforeach
<!--<option value="5">Member</option>-->
              <option value="0">All</option>
          </select>
            
          <x-jet-input-error for="division_id" class="mt-2" />
        </div>

        <!-- Search -->
        <div class="flex gap-2 ml-2 mt-2 w-full md:w-6/12">            
            <x-jet-button class="py-2 rounded bg-sky-600 hover:bg-sky-500" wire:click="search" wire:loading.attr="disabled">
              <i class="fa fa-search fa-lg"></i> {{ __('Search') }}
            </x-jet-button>

          <!-- PDF -->
              <a href="{{ route('app.pdf.leavebalance.report')}}" class="flex py-2 px-2 text-white rounded bg-red-600 hover:bg-red-500 text-xs uppercase font-bold" target="_blank">
		<div class="flex flex-row items-center">
                  <i class="fa fa-file-pdf fa-lg mr-2"></i> {{ __('Export') }}
                </div>
 	      </a>

            <!-- Back -->
            <a href="{{ route('app.leave.applications') }}" class="flex py-2 px-4 text-white rounded bg-gray-600 hover:bg-gray-500 text-xs uppercase font-bold">
                <i class="fa fa-arrow fa-lg"></i> {{ __('Back') }}
              </a>
              
        </div> 
      </div>  
<!-- </form> -->
</div>
