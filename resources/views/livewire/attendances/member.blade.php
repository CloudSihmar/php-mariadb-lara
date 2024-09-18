<div class="mx-auto mt-4 md:mt-10">
    <div class="grid grid-cols-6 mt-2 gap-4">
        <div class="bg-green-400 px-2 py-2 rounded text-xs text-gray-600">
        @if($totalleavePending > 0)
          <a href="{{ route('app.report.attendancereport.applications',4)}}">
        @endif
            <div class="p-3 text-center ">
                <i class="fa fa-clock fa-3x"></i> 
                <br>
                <b>
                  {{ $totalleavePending}}
                </b>
                <br>
                <p class="text-xs">
                Leave Pending Request
                </p>
            </div>
          </a>
        </div>

        <div class="bg-orange-600 px-2 py-2 rounded text-xs text-gray-50">
        @if($totalLateAttendance > 0)
          <a href="{{ route('app.report.attendancereport.applications',5)}}">
        @endif
            <div class="p-3 text-center ">
                <i class="fa fa-fingerprint fa-3x"></i> 
                <br>
                <b>
                {{ $totalLateAttendance}}
                </b>
                <br>
                <p class="text-xs">
                Attendance after 9.00 AM
                </p>
            </div>
          </a>
        </div>

        <div class="bg-sky-600 px-2 py-2 rounded text-xs text-gray-50">
        @if($totalnotusedAttendance > 0)
        <a href="{{ route('app.report.attendancereport.applications',6)}}">
        @endif
          <div class="p-3 text-center ">
              <i class="fa fa-fingerprint fa-3x"></i> 
              <br>
              <b>
              {{ $totalnotusedAttendance}}
              </b>
              <br>
              <p class="text-xs">
              Not used attendance
              </p>
          </div>
          </a>
        </div>

        <div class="bg-red-600 px-2 py-2 rounded text-xs text-gray-50">
        @if($totalstaffLeave > 0)
          <a href="{{ route('app.report.attendancereport.applications',7)}}">
        @endif
            <div class="p-3 text-center ">
                <i class="fa fa-tachometer-alt fa-3x"></i> 
                <br>
                <b>
                {{ $totalstaffLeave}}
                </b>
                <br>
                <p class="text-xs">
                Officials on Leave
                </p>
            </div>
          </a>  
        </div>

        <div class="bg-yellow-600 px-2 py-2 rounded text-xs text-gray-50">
            <div class="p-3 text-center ">
                <i class="fa fa-user fa-3x"></i> 
                <br>
                <b>
                Your supervisor
                </b>
                <br>
                <p class="text-xs">
                {{ isset($supervisor->name)? $supervisor->name:'NA'}}
                </p>
            </div>
        </div>
       
        <div class="bg-gray-600 px-2 py-2 rounded text-xs text-gray-50">
          <div class="p-1 text-center ">Today's Member</div>
            <table width="100%">
              <tr class="border"><td>Total Members Present</td><td> {{$totalmember_present}}</td></tr>
              <tr class="border"><td>Total Members Not Present </td><td> {{$totalmember_absent}}</td></tr>
              <tr class="border"><td class="font-semibold border-t">Total Members </td><td> {{$totalmembers}}</td></tr>
            </table>
        </div>
      </div>

        <div class="flex justify-between">
          @include('livewire.attendances.partials._searchbarmember')
        </div>
      </div>

    
    <!--Session message -->
    <x-utilities.messages />

    <div class="mx-auto mt-2">
      <div class="bg-white overflow-hidden shadow sm:rounded-lg">
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-2 py-2">SL#</th>
                    <th class="px-2 py-2">Name</th>
                    <th class="px-2 py-2">Constituency</th>
                    <th class="px-2 py-2">Date</th>
                    <th class="px-2 py-2">Time In</th>
                    <th class="px-2 py-2">In Status</th>
                    <th class="px-2 py-2">Time Out</th>
                    <th class="px-2 py-2">In Remarks</th> 
                    <th class="px-2 py-2">Out Remarks</th>

                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  @foreach($attendances as $index=>$item)
                  <tr class="text-gray-500">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            {{ $index+1 }}
                        </div>
                      </td>

                    @php
                      $result = $this->memberAttendanceRecord($item->id);
                    @endphp
                    @if(count($result) > 0)
                      <td class="px-2 py-3">
                        <div class="flex items-center text-sm">
                            {{ $result[0]->user->name }}
                        </div>
                      </td>

                      <td class="px-2 py-3">
                        <div class="flex items-center text-sm">
                            {{ $consitituncy = App\Http\Livewire\Utilities::getMemberConsitituncy($result[0]->author) }} 
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
                          @else
                          <span class="bg-cyan-500 rounded py-1 px-2 text-cyan-100 mx-1">
                           NA
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
                @php 
                  $fromDate = Session::get('fromDate'); 
                @endphp
                      <td class="px-2 py-3">
                        <div class="flex items-center text-sm">
                            {{ $item->name }}
                        </div>
                      </td>

                      <td class="px-2 py-3">
                        <div class="flex items-center text-sm">
                            {{ $consitituncy = App\Http\Livewire\Utilities::getMemberConsitituncy($item->id) }} 
                        </div>
                      </td>

                      <td class="px-2 py-3">
                        <div class="flex items-center text-sm">
                            {{ Carbon\Carbon::parse($fromDate)->format('d M Y') }}
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
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
           </div>
          </div>
        </div>
        @include('livewire.attendances.partials._add')
        @include('livewire.attendances.partials._checkoutForm')
        @include('livewire.attendances.partials._delete')
      </div>
    </div>
</div>
