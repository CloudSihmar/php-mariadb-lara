
<div class="my-6">
  <h1 class="py-2 font-bold text-xl text-cyan-600">Member Attendance Report</h1>
  @if (auth()->user()->can('members.attendance.report'))
      <div class="w-full overflow-x-auto">
          @include('livewire.attendancereports._membersearchbar')
          <div class="w-full">
              <div class="bg-gray-100 shadow p-3 text-gray-600">
                  <table class="w-full whitespace-no-wrap">
                      <thead>
                      <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                          <th class="px-2 py-2">SL#</th>
                          <th class="px-2 py-2">Name</th>
                          <th class="px-2 py-2">Constituency</th>
                          <th class="px-2 py-2">Date</th>
                          <th class="px-2 py-2">Time In</th>
                          <th class="px-2 py-2">Time Out</th>
                          <th class="px-2 py-2">In Remarks</th> 
                          <th class="px-2 py-2">Out Remarks</th>

                      </tr>
                      </thead>
                      <tbody class="bg-white divide-y">
                      @foreach($attendance_reports as $index=>$item)
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

                              <td colspan="5" class="px-2 py-3">
                              </td>
                          @endif

                      </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  @else
      <div class="mt-4 md:mt-10 max-w-3xl mx-auto">
          <div class="flex flex-col text-center bg-red-100 rounded-lg p-4 mb-4 text-red-700 justify-center" role="alert">
              <i class="fa fa-exclamation-triangle fa-lg"></i>    
              <div class="font-bold text-xl py-4"> Unauthorised Access !!! </div> 
              <div class="py-2 text-sm"> You are not authorized to access the resources</div>
          </div>
      </div>
  @endif
</div>
