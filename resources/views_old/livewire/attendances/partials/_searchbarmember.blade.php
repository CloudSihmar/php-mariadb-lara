  <div class="w-full bg-gray-100 p-2 my-4 rounded shadow">
      <div class="flex w-full flex-col md:flex-row items-center justify-between gap-4">
        <!-- Profile Status Update -->
        <div class="w-full md:w-4/12 my-2">
          <select name="userstatus_id" class="form-control" wire:model="userstatus_id">
            <option value=''>Select My  Status</option>
            @foreach($attendancestatusList as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="flex flex-col md:flex-row gap-2">
          <x-jet-button class="rounded bg-green-500 hover:bg-green-700 text-xs" wire:click="updateMemberStatus" wire:loading.attr="disabled">
            {{ __('Update') }}
          </x-jet-button>
        </div>

        <!-- Division -->
        <div class="w-full md:w-8/12 my-2">
          <select name="division_id" class="form-control" wire:model.defer="division_id">
          <option value="">Select the filter</option>
            <option value="5">Member of Parliament(NA)</option>
            <option value="6">National Council Member(NC)</option>
            <option value="7">Join Sitting</option>
          </select>
          <x-jet-input-error for="division_id" class="mt-2" />
        </div>
        
        <!-- Search -->
        <div class="flex flex-col md:flex-row gap-2 w-full">
          <x-jet-button class="rounded bg-gray-400 hover:bg-gray-700 text-xs" wire:click="searchMember" wire:loading.attr="disabled">
            <i class="fa fa-search fa-lg"></i> {{ __('Search') }}
          </x-jet-button>
          
          <!-- PDF -->
          <a href="{{ route('app.pdf.member-attendance-report.report')}}" class="flex py-2 px-4 text-white rounded bg-sky-600 hover:bg-sky-500 text-xs uppercase font-bold" target="_blank">
              <i class="fa fa-file-pdf fa-lg mr-2"></i> {{ __('Export') }}
            </a>

        <!-- button -->
          @if($leaveButton == 0)
            @if($this->resultCount == 0)
                <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700">
                  CheckIn
                </x-jet-button>
            @else
          
              @if($this->attendanceStatus == 0)
                <x-jet-button class="bg-orange-500 hover:bg-orange-700">
                  You have already checkout for the day...
                </x-jet-button>
              @else
                <x-jet-button wire:click="$toggle('checkoutFormModal')" class="bg-orange-500 hover:bg-orange-700">
                  CheckOut
                </x-jet-button>
              @endif
            @endif
          @endif
        </div>
      </div>  
  </div>