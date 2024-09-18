<div class="mx-auto mt-4 md:mt-10">
  
  <div class="flex flex-col md:flex-row mt-2 gap-4 mx-4 md:mx-0">
    <div class="flex flex-row justify-center m-auto bg-gradient-to-r from-green-700 via-green-800 to-green-900 py-6 px-2 gap-8 rounded-lg w-full h-full md:flex-grow">
      @if($totalleavePending > 0)
        @if(in_array($this->user_division,[5,6]))
        <a href="{{ route('app.report.attendancereport.applications',4)}}">
        @else
        <a href="{{ route('app.report.attendancereport.applications',8)}}">
        @endif
      @endif
        <div class="flex flex-row items-center justify-between space-x-2 text-center text-white">
          <div>
            <p class="font-bold text-xl">{{ $totalleavePending}}</p>
            <p class="text-xs ">Leave Pending Request</p>
          </div>
          <div class="text-green-300 my-auto bg-gradient-to-l from-green-700 via-green-800 to-green-900 rounded-full p-2">
            <i class="fa fa-user-clock fa-2x"></i> 
          </div>
        </div>
        </a>
    </div>

    <div class="flex flex-row justify-center m-auto bg-gradient-to-r from-orange-700 via-orange-800 to-orange-900 py-6 px-2 gap-8 rounded-lg w-full md:flex-grow">
      @if($totalLateAttendance > 0)
        @if(Auth::check())
          <a href="{{ route('app.report.attendancereport.applications',5)}}">
        @else
          <a href="{{ route('app.report.attendancereport.applications',1)}}">
        @endif
      @endif
        <div class="flex flex-row items-center justify-center space-x-2 text-center text-white">
          <div>
            <p class="font-bold text-xl">{{ $totalLateAttendance}}</p>
            <p class="text-xs ">Attendance after 9.00 AM</p>
          </div>
          <div class="text-orange-300 my-auto bg-gradient-to-l from-orange-700 via-orange-800 to-orange-900 rounded-full p-2">
            <i class="fa fa-user-lock fa-2x"></i> 
          </div>
        </div>
      </a>
    </div>

    <div class="flex flex-row justify-center m-auto bg-gradient-to-r from-sky-700 via-sky-800 to-sky-900 py-6 px-2 gap-8 rounded-lg w-full h-full md:flex-grow">
      @if($totalnotusedAttendance > 0)
        @if(in_array($this->user_division,[5,6]))
          <a href="{{ route('app.report.attendancereport.applications',6)}}">
        @else
          <a href="{{ route('app.report.attendancereport.applications',3)}}">
        @endif
      @endif
        <div class="flex flex-row items-center justify-center space-x-2 text-center text-white">
          <div>
            <p class="font-bold text-xl">{{ $totalnotusedAttendance}}</p>
            <p class="text-xs ">Attendance not used</p>
          </div>    
          <div class="text-sky-300 my-auto bg-gradient-to-l from-sky-700 via-sky-800 to-sky-900 rounded-full p-2">
            <i class="fa fa-user-alt-slash fa-2x"></i> 
          </div>
        </div>
        </a>
    </div>

    <div class="flex flex-row justify-center m-auto bg-gradient-to-r from-red-700 via-red-800 to-red-900 py-6 px-2 gap-8 rounded-lg w-full md:flex-grow">
      @if($totalstaffLeave > 0)
        @if(in_array($this->user_division,[5,6]))
          <a href="{{ route('app.report.attendancereport.applications',7)}}">
        @else
          <a href="{{ route('app.report.attendancereport.applications',2)}}">
        @endif
      @endif
        <div class="flex flex-row items-center justify-center space-x-2 text-center text-white">
            <div>
            <p class="font-bold text-xl">{{ $totalstaffLeave}}</p>
            <p class="text-xs ">Officials on Leave</p>
            </div>
            <div class="text-red-300 my-auto bg-gradient-to-l from-red-700 via-red-800 to-red-900 rounded-full p-2">
            <i class="fa fa-user-minus fa-2x"></i> 
          </div>
        </div>
      </a>
    </div>

     <div class="flex flex-row justify-center m-auto bg-gradient-to-r from-yellow-700 via-yellow-800 to-yellow-900 py-6 px-2 gap-8 rounded-lg w-full md:flex-grow">
        <div class="flex flex-row items-center space-x-2 text-center text-white">
          <div>
            <p class="text-xs">Your supervisor</p>
            <p class="font-bold text-xs">{{ isset($supervisor->name)? $supervisor->name:'NA'}}</p>
          </div>
          <div class="text-yellow-300 my-auto bg-gradient-to-l from-yellow-700 via-yellow-800 to-yellow-900 rounded-full p-2">
            <i class="fa fa-user-tag fa-2x"></i> 
          </div>
        </div>
    </div>


      <div class="bg-gray-600 px-2 py-2 rounded text-xs text-gray-50 w-full md:flex-grow">
        <div class="p-1 text-center ">Today's Staff Statistic</div>
          <table width="100%">
            <tr class="border"><td>Total Staffs Present</td><td> {{$totalmember_present}}</td></tr>
            <tr class="border"><td>Total Staffs Not Present </td><td> {{$totalmember_absent}}</td></tr>
            <tr class="border"><td class="font-semibold border-t">Total Staffs </td><td> {{$totalmembers}}</td></tr>
          </table>
      </div>
  
  </div>

  @include('livewire.attendances.partials._searchbar')
  
  <!--Session message -->
  <x-utilities.messages />

  <div class="mx-auto mt-2 md:mt-10">
      <div class="bg-white overflow-hidden shadow sm:rounded-lg">
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
          <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
              <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                  <th class="p-4">SL#</th>
                  <th class="p-4">Name</th>
                  <th class="p-4">Division</th>
                  <th class="p-4">Date</th>
                  <th class="p-4">Time In</th>
                  <th class="p-4">Status</th>
                  <th class="p-4">Time Out</th>
                  <th class="p-4">In Remarks</th> 
                  <th class="p-4">Out Remarks</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y">
                @php $sl =1; @endphp
                @foreach($attendances as $index=>$item)
                @if($item->name != 'Admin')
                <tr class="text-gray-500">
                @php
                  $result = $this->secretariatAttendanceRecord($item->id);
                @endphp
                @if(count($result) > 0)
                    <td class="px-2 py-3">
                        <div class="flex items-center text-sm">
                            {{ $sl++ }}
                        </div>
                    </td>

                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                          {{ $result[0]->user->name }}
                      </div>
                    </td>

                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                          {{ $division = App\Http\Livewire\Utilities::getMemberConsitituncy($result[0]->author) }} 
                      </div>
                    </td>


                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                          <?=date('d M Y', $result[0]['checkIn']); ?>
                      </div>
                    </td>

                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                        @if(empty($result[0]['checkIn']))
                            <span class="bg-orange-500 shadow rounded py-1 px-3 text-gray-100 mx-1">
                            &nbsp;&nbsp;&nbsp;
                          </span>
                        @else
                          @if($result[0]['inStatus'] == 'Late')
                            <span class="bg-orange-500 shadow rounded py-1 px-3 text-gray-100 mx-1">
                              <?=date('h:i:s A', $result[0]['checkIn']); ?>
                          </span>
                          @else
                            <span class="bg-green-500 shadow rounded py-1 px-3 text-gray-100 mx-1">
                              <?=date('h:i:s A', $result[0]['checkIn']); ?>
                            </span>
                          @endif
                        @endif
                      </div>
                    </td>
                  
                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                        @if(!empty($item->userstatus->name))
                          <span class="bg-cyan-500 rounded py-1 px-2 text-cyan-100 mx-1">
                          {{  $item->userstatus->name  }}
                          </span>
                        @endif
                    </td>

                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                          
                        @if(empty($result[0]['checkOut']))
                        Haven't Checked Out
                        @else
                          @if($result[0]['outStatus'] == 'Early')
                              <span class="bg-orange-500 shadow rounded py-1 px-3 text-gray-100 mx-1">
                              {{ date('h:i:s A', $result[0]->checkOut) }}
                              </span>
                            @else
                              <span class="bg-green-500 shadow rounded py-1 px-3 text-gray-100 mx-1">
                                  {{ date('h:i:s A', $result[0]->checkOut) }}
                              </span>
                            @endif
                        
                        @endif
                      </div>
                    </td>

                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                        {{ $result[0]->inNotes }}
                      </div>
                    </td>

                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                        {{ $result[0]->outNotes }}
                      </div>
                    </td>
                @else
                    <td class="px-2 py-3">
                        <div class="flex items-center text-sm">
                            {{ $sl++ }}
                        </div>
                    </td>
                    
                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                          {{ $item->name }}
                      </div>
                    </td>

                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                          {{ $division = App\Http\Livewire\Utilities::getMemberConsitituncy($item->id) }} 
                      </div>
                    </td>

                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                          <?php echo date('d M Y');?>
                      </div>
                    </td>
                    
                    <td class="px-2 py-3">
                      <div class="flex items-center text-sm">
                        <span class="bg-cyan-500 rounded py-1 px-2 text-gray-100 mx-1">
                            NA
                        </span>
                      </div>
                    </td>

                    <td class="px-2 py-3">
                    </td>
              @endif
              </tr>
              @endif
              @endforeach
              </tbody>
            </table>
          </div>
          <div class="px-2 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
          </div>
        </div>
      </div>
      @include('livewire.attendances.partials._add')
      @include('livewire.attendances.partials._checkoutForm')
      @include('livewire.attendances.partials._delete')
    </div>
  </div>
</div>
