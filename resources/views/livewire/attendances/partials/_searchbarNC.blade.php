<div class="w-full bg-gray-100 p-2 my-4 rounded shadow">
  <div class="flex w-full flex-col md:flex-row items-center justify-between gap-4">
    <div class="flex flex-col md:flex-row gap-2 w-full">
      <!-- Profile Status Update -->
      <div class="flex flex-row items-center gap-2 w-full">
        <div class="w-full">
            <select name="userstatus_id" class="form-control w-96" wire:model="userstatus_id">
            <option value=''>Select Status</option>
            @foreach($attendancestatusList as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
            </select>
        </div>
        <div class="my-1">
          <x-jet-button class="rounded bg-green-500 hover:bg-green-700 text-xs" wire:click="updateStatus" wire:loading.attr="disabled">
            {{ __('Update') }}
          </x-jet-button>
        </div>
      </div>

      <!-- Division -->
      <div class="flex flex-grow items-center flex-row gap-2 w-full">
        @if(Auth::user()->id ==1)
          <div class="w-full my-2">
            <select name="division_id" class="form-control" wire:model.defer="division_id">
              <option value=''>Select Division</option>
              @foreach($divisions as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
              <option value="0">All Secretariat Staff</option>
            </select>
            <x-jet-input-error for="division_id" class="mt-2" />
          </div>
        @else
          @if(in_array($user_division,[5]))
          <!-- NC -->
          <div class="flex flex-row gap-2 w-full">
              <select name="division_id" class="form-control" wire:model.defer="division_id">
              <option value="">Select</option>
                <option value="5">National Council Member(NC)</option>
              </select>
              <x-jet-input-error for="division_id" class="mt-2" />
          </div>
          @else
          <!-- Division -->
          <div class="w-full my-2">
            <select name="division_id" class="form-control" wire:model.defer="division_id">
              <option value='0'>Select Division</option>
              @foreach($divisions as $item)
              @if($item->id<5)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endif
              @endforeach
              <option value="0">All Secretariat Staff</option>
            </select>
            <x-jet-input-error for="division_id" class="mt-2" />
          </div>
          @endif
        @endif
      </div>
      
      @if($user_division ==5)
        <div class="flex items-center flex-row gap-2">
          <x-jet-button class="rounded bg-green-500 hover:bg-green-700 text-xs" wire:click="searchMember" wire:loading.attr="disabled">
            <i class="fa fa-search fa-lg mr-1 hidden md:block"></i> {{ __('Search') }}
          </x-jet-button>
          
          <!-- <a href="{{ route('app.pdf.member-attendance-report.report')}}" class="flex items-center my-1 py-1 px-4 text-white rounded bg-red-600 hover:bg-red-500 text-xs uppercase font-bold" target="_blank">
              <i class="fa fa-file-pdf fa-lg mr-2"></i> {{ __('Export') }}
          </a> 

          <a class="flex items-center justify-between rounded px-6 py-2 uppercase text-xs font-bold text-gray-50 bg-blue-600 hover:bg-blue-700" href="{{ route('app.report.attendancereport.applications',9)}}">
            <i class="fa fa-book-open mr-2"></i>
            Report
          </a> -->
        </div>
      @else <!-- Search for Secretariat -->
        <div class="flex items-center flex-row gap-2">
          <x-jet-button class="rounded bg-green-500 hover:bg-green-700 text-xs" wire:click="search" wire:loading.attr="disabled">
            <i class="fa fa-search fa-lg hidden md:block"></i> {{ __('Search') }}
          </x-jet-button>

          <a class="flex items-center justify-between rounded px-6 py-2 uppercase text-xs font-bold text-gray-50 bg-sky-600 hover:bg-sky-700" href="{{ route('app.report.attendancereport.applications',0)}}">
            <i class="fa fa-book-open mr-2"></i>
            Report
          </a>
        </div>
      @endif
    </div> 
      <!-- Report for NC-->
      <div class="flex flex-row justify-between gap-2 w-full md:w-6/12">
          @if(Auth::user()->id !=1)
            @if($leaveButton == 0)
              @if($this->resultCount == 0)
                  <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700">
                    <i class="fa fa-fingerprint fa-lg mr-1"></i>
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
          @endif

           @can(['secretariat.dailyattendancereport'])
          <a class="flex rounded p-2 uppercase text-xs font-bold text-gray-50 bg-sky-600 hover:bg-sky-700" href="{{ route('app.report.attendancereport.applications',10)}}">
            <i class="fa fa-book-open mr-2"></i>
            Daily&nbsp;Attendance&nbsp;Report
          </a>
          @endcan
      </div>

    </div>  
  </div>
