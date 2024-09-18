<div>
  @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/css/pikaday.min.css" integrity="sha512-yFCbJ3qagxwPUSHYXjtyRbuo5Fhehd+MCLMALPAUar02PsqX3LVI5RlwXygrBTyIqizspUEMtp0XWEUwb/huUQ==" crossorigin="anonymous" /> 
  @endpush
  <div class="p-2 md:mx-2">
  <div class="flex justify-between my-6">
      <h1 class="py-2 uppercase font-bold text-xl text-cyan-600">Leave Notification</h1>
      <div class="flex gap-4">
      </div>
    </div>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mx-auto mt-1">
       <div class="bg-white overflow-hidden shadow sm:rounded-lg">
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-2 py-2">Name</th>
                    <th class="px-2 py-2">From Date</th>
                    <th class="px-2 py-2">To Date</th>
                    <th class="px-2 py-2">Duration</th>
                    <th class="px-2 py-2">Leave Type</th>
                    <th class="px-2 py-2">App. Date</th>
                    <th class="px-2 py-2"> Status</th>
                    <th class="px-2 py-2">Employee Remarks</th>
                    @can('is-member')
                    <th class="px-2 py-2">Action</th>
                    @endcan
                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  @foreach ($leaves as $leave)
                  <tr class="text-gray-600">
                    <td class="px-2 py-2  text-center">
                        <div class="flex items-center text-sm">
                          @if(isset($leave->user->name))
                            {{ $leave->user->name }}
                          @endif
                        </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                          {{ $leave->fromDate->format('d-M-Y')}}
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                          {{ $leave->toDate->format('d-M-Y') }}
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                      {{ \Carbon\Carbon::parse( $leave->fromDate )->diffInDays( $leave->toDate ) }}
                      {{ (\Carbon\Carbon::parse( $leave->fromDate )->diffInDays( $leave->toDate ) >1) ? 'Days':'Day' }}
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                          {{ $leave->leavetype->name }}
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                          {{ substr($leave->created_at,0,10) }}
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                        @if($leave->status == 1)
                          <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                            {{ $leave->leavestatus->name }}
                          </span>
                        @endif
                        @if($leave->status == 2)
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            {{ $leave->leavestatus->name }}
                          </span>
                        @endif
                        @if($leave->status == 3)
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                            {{ $leave->leavestatus->name }}
                          </span>
                        @endif
                      </div>
                    </td>


                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                          {{ $leave->employeeRemarks }}
                      </div>
                    </td>

                    @can('is-member')
                    <td>
                      @if ($leave->status == 1) 
                      <button wire:click="approve({{ $leave->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-semibold focus:border-gray-200 bg-sky-500 hover:text-gray-200">
                          <i class="fa fa-check-square fa-lg mr-1"></i>Take Action
                      </button> 
                      @else 
                      <button class="p-2 rounded text-green-50 uppercase text-xs font-semibold focus:border-gray-200 bg-green-500 hover:text-gray-200">
                        <i class="fa fa-check fa-lg mr-1"></i>Completed
                      </button> 
                      @endif
                    </td>
                    @endcan

                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{ $leaves->links()}}
            </div>
          </div>
        </div>
      </div>
      </div>
  </div>


  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/pikaday.min.js" integrity="sha512-AWC8WaJpos1L8xD++XDtqY3znmqhqDY/o4KZ3wo7kmt1Hx6YjP4ZqPnYDrLg1ymG6iidGzq/UKHS/MxBwVAlwQ==" crossorigin="anonymous"></script>
  @endpush
</div>
