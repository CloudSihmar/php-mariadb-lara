<div>
  <div class="flex justify-between my-4 mx-2">
      <h1 class="py-2 font-bold text-xl text-cyan-600">Leave Report
        <hr class="border border-cyan-600">
      </h1>
      <div class="flex gap-4 py-4 items-center">
        <a class="text-white rounded-full  uppercase px-6 py-2 text-xs font-bold bg-blue-500 hover:bg-blue-600" 
            href="{{ route('app.leave.applications') }}">
          <i class="fa fa-long-arrow-alt-left mr-2"></i> Back
        </a>
      </div>
  </div>

    <!-- main content -->
    <div class="bg-gray-50 w-full p-3">
      @include('livewire.leavereports._searchbar')
        <div class="w-full">
            <div class="bg-gray-100 w-full shadow text-gray-600">
                @if ($leavereports->isNotEmpty())
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th>SL#</th>
                        <th class="px-3 py-3">Employee</th>
                        <th class="px-3 py-3">Office</th>
                        <th class="px-3 py-3">Leave Type</th>
                        <th class="px-3 py-3">From</th>
                        <th class="px-3 py-3">To</th>
                        <th class="px-3 py-3">Duration</th>
                        <th class="px-3 py-3">Leave Status</th>
                        <th class="px-3 py-3">Employee Remarks</th>
                        <th class="px-3 py-3">Supervisor Remarks</th>
                        <th class="px-3 py-3">Action By</th>
                        </tr>
                    </thead>
                <tbody class="bg-white divide-y">
            
                    @foreach ($leavereports as $index=>$item)
                    <tr class="text-gray-700">
                        <td>{{ $index+1}}</td>
                        <td class="px-3 py-3">
                            <div class="w-full flex items-center text-sm">
                            @if(isset($item->userName)) {{ $item->userName }} @endif
                            @if(isset($item->user->name)) {{ $item->user->name }} @endif
                            </div>
                        </td>

                        <td class="px-3 py-3">
                            <div class="flex items-center text-sm">
                            @if(isset($item->divisionName)) {{ $item->divisionName }} @endif
                            @if(isset($item->division->name)) {{ $item->division->name }} @endif
                            </div>
                        </td>

                        <td class="px-3 py-3 text-center">
                            <div class="flex items-center text-sm">
                            @if(isset($item->leavetype->name)) {{ $item->leavetype->name }} @endif
                            </div>
                        </td>


                        <td class="px-2 py-2  text-center">
                        <div class="flex items-center text-sm">
                            @if(isset($item->leaveType))
                            {{  \Carbon\Carbon::parse($item->fromDate)->format('d-M-Y') }}
                            @endif
                        </div>
                        </td>

                        <td class="px-2 py-2  text-center">
                        <div class="flex items-center text-sm">
                            @if(isset($item->leaveType))
                            {{  \Carbon\Carbon::parse($item->toDate)->format('d-M-Y') }}
                            @endif
                            </div>
                        </td>

                        <td class="px-2 py-2  text-center">
                        <div class="flex items-center text-sm">
                        @if(isset($item->leaveType))
                        @php
                        $duration = App\Http\Livewire\Utilities::getWorkingDays($item->fromDate,$item->toDate);
                        @endphp
                        {{ $duration }}
                        @endif
                            </div>
                        </td>

                        <td class="px-3 py-3 text-center">
                            <div class="flex items-center text-sm">
                            @if(isset($item->leaveType))
                                {{ $item->leavestatus->name }}
                            @endif
                            </div>
                        </td>

                        <td class="px-3 py-3 text-center">
                            <div class="flex items-center text-sm">
                            @if(isset($item->leaveType))
                                {{ $item->employeeRemarks }}
                            @endif
                            </div>
                        </td>

                        <td class="px-3 py-3 text-center">
                            <div class="flex items-center text-sm">
                            @if(isset($item->leaveType))
                                {{ $item->headRemarks }}
                            @endif
                            </div>
                        </td>

                        <td class="px-3 py-3 text-center">
                            <div class="flex items-center text-sm">
                            @if(isset($item->actionby))
                            {{ $approvedBy = App\Http\Livewire\Utilities::approvedBy($item->actionby) }} 
                            @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                @else
                    <div class="text-center pb-2">
                        <i class="fa fa-search fa-lg"></i>
                        <p class="text-lg">Sorry!!! No leave record found...</p>
                        <p class="text-sm text-gray-600">Please try another search option</p>
                    </div>
                @endif
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{-- {{ $leavereports->links()}} --}}
            </div>
        </div>
    </div>

  </div>