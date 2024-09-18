<div>
  @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/css/pikaday.min.css" integrity="sha512-yFCbJ3qagxwPUSHYXjtyRbuo5Fhehd+MCLMALPAUar02PsqX3LVI5RlwXygrBTyIqizspUEMtp0XWEUwb/huUQ==" crossorigin="anonymous" /> 
  @endpush
  <div class="p-2 md:mx-2">
    <div class="flex justify-between my-6">
      <h1 class="py-2 uppercase font-bold text-xl text-cyan-600">Leave History</h1>
    </div>

    <div class="flex flex-col md:flex-row justify-between mb-4 gap-2">
        <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-600 hover:bg-blue-700 justify-center text-center">
          <i class="fa fa-paper-plane mr-2"></i>  Apply Leave 
        </x-jet-button>

        <div class="flex flex-col md:flex-row gap-2">
          @can('manage.holiday')
          <a href="{{ route('app.holiday.applications') }}" class="btn-green-xs justify-center">
            Manage Holidays
          </a>
          @endcan

          @can('manage.leave.balance')
          <a href="{{ route('app.leavebalance.applications') }}" class="btn-green-xs justify-center">
            Manage Leave Balance
          </a>
          @endcan

           @if (!empty($divisionHead))
           {{-- <!-- <button wire:click="transfersupervisor(1)" class="p-3 rounded text-gray-50 uppercase text-xs font-bold focus:border-green-200 bg-green-500 hover:text-gray-200">
              <i class="fa fa-user fa-lg mr-1"></i>Assign Officiating Role
            </button>    --> --}}
           @endif

          @can('leave.report')
            <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white justify-center uppercase transition border border-transparent rounded-md bg-red-600 hover:bg-red-700 active:bg-cyan-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25" 
                href="{{ route('app.leavereport.applications')}}">
              <i class="mr-2 fa fa-book-open"></i> Leave Report
            </a>
          @endcan
        </div>
    </div>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mx-auto mt-4 md:mt-10">
       <div class="bg-white overflow-hidden shadow sm:rounded-lg">
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b bg-gray-50">
                    <th class="px-2 py-4"> SL#</th>
                    <th class="px-2 py-4"> Name</th>
                    <th class="px-2 py-4">From Date</th>
                    <th class="px-2 py-4">To Date</th>
                    <th class="px-2 py-4">Duration</th>
                    <th class="px-2 py-4">Leave Type</th>
                    <th class="px-2 py-4">App. Date</th>
                    <th class="px-2 py-4"> Status</th>
                    <th class="px-2 py-4">Employee Remarks</th>
                    <th class="px-2 py-4">Supervisor Remarks</th>
                    <th class="px-2 py-4">Action By</th>
                    <th class="px-2 py-4">Action</th>
                    <th>Notification</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  @foreach ($leaves as $index=>$leave)
                  <tr class="text-gray-600">

                    <td class="p-2  text-center">
                        <div class="flex items-center text-sm">
                            {{ $index+1 }}
                        </div>
                    </td>
                
                    <td class="px-2 py-2  text-center">
                        <div class="flex items-center text-sm">
                          @if(isset($leave->user->name))
                            {{ $leave->user->name }}
                          @endif
                        </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                          {{  \Carbon\Carbon::parse($leave->fromDate)->format('d-M-Y') }}
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                          {{  \Carbon\Carbon::parse($leave->toDate)->format('d-M-Y') }}
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                      @php
                      $duration = App\Http\Livewire\Utilities::getWorkingDays($leave->fromDate,$leave->toDate);
                      @endphp
                      {{ $duration }}
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                         @if(isset($leave->leavetype->name))
                          {{ $leave->leavetype->name }}
                         @endif 
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                          {{ substr($leave->created_at,0,10) }}
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                        @if($leave->status == $this->LEAVE_APPROVED)
                        <span class="px-2 py-1 approved font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:text-red-100 dark:bg-green-700">
                          @if(isset($leave->leavestatus->name))  
                            {{ $leave->leavestatus->name }}
                          @endif
                          </span>
                        @endif
                        @if($leave->status == $this->LEAVE_REJECTED)
                        <span class="px-2 py-1 rejected font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                            {{ $leave->leavestatus->name }}
                          </span>
                        @endif
                        @if($leave->status == $this->LEAVE_PENDING) 
                        <span class="px-2 py-1 pending font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                          @if(isset($leave->leavestatus->name)) 
                          {{ $leave->leavestatus->name }}
                          @endif
                          </span>
                        @endif
                      </div>
                    </td>


                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                          {{ $leave->employeeRemarks }}
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                          @if (!empty($leave->headRemarks)) 
                          <button wire:click="viewremark({{ $leave->id }})" class="p-2 rounded text-gray-50 uppercase text-xs focus:border-gray-200 bg-sky-500 hover:text-gray-200">
                              <i class="fa fa-eye fa-lg mr-1"></i>View
                          </button> 
                          @else
                            -
                          @endif
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                        @if($leave->status == $this->LEAVE_PENDING) 
                        -
                        @else
                        {{ isset($leave->approve->name)?$leave->approve->name:'-' }}
                        @endif
                      </div>
                    </td>

                    <td >
                      @if ($leave->status == $this->LEAVE_PENDING && $leave->author != Auth::user()->id) 
                        @if(!empty($leave->document))
                        <button wire:click="download({{ $leave->id }})" class="p-2 rounded text-gray-50 uppercase text-xs focus:border-gray-200 bg-yellow-500 hover:text-gray-200">
                          <i class="fa fa-paperclip mr-1"></i>File
                        </button> 
                        @endif

                          <button wire:click="approve({{ $leave->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-semibold focus:border-gray-200 bg-sky-500 hover:text-gray-200">
                              <i class="fa fa-check-square fa-lg mr-1"></i>Take Action
                          </button> 

                      @elseif($leave->author == Auth::user()->id) 
                        @if($leave->status == $this->LEAVE_PENDING)
                          <button wire:click="showDeleteModal({{ $leave->id }})" class="p-2 rounded text-red-50 text-xs font-semibold focus:border-red-200 bg-red-500 hover:text-red-200">
                              <i class="fa fa-tash fa-lg mr-1"></i>Cancel
                          </button> 
                        @else
                        <button class="p-2 rounded text-green-50  text-xs font-semibold focus:border-gray-200 bg-green-500 hover:text-gray-200">
                          Completed
                        </button>
                        @endif
                      @else
                      <button class="p-2 rounded text-green-50  text-xs font-semibold focus:border-gray-200 bg-green-500 hover:text-gray-200">
                        Completed
                      </button> 
                      @endif
                    </td>

                    <td class="px-2 py-2  text-center">
                      @php
                        $seenStatus = App\Http\Livewire\Utilities::getNotificationStatus($leave->id);
                      @endphp
                      <div class="flex items-center text-sm">
                      @if($seenStatus == 0)
                        <span class="p-2 rounded text-xs text-green-50 bg-blue-600">Not Seen</span>
                      @elseif($seenStatus == 1)
                        <span class="p-2 rounded text-xs text-green-50 bg-orange-600"> <i class="fa fa-eye mr-2"></i>Seen</span>
                      @else
                      <span class="p-2 rounded">
                      </span>
                      @endif
                      </div>           
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase min-h-min">
              {{ $leaves->links()}}
            </div>
          </div>
        </div>
      </div>
        @include('livewire.leaveapplications.partials._add')
        @include('livewire.leaveapplications.partials._transfersupervisor')
        @include('livewire.leaveapplications.partials._approve')
        @include('livewire.leaveapplications.partials._viewremark')
        @include('livewire.leaveapplications.partials._delete')
      </div>
  </div>
</div>
