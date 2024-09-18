<div class="bg-white overflow-hidden shadow sm:rounded-lg">
    <div class="w-full ml-4 flex my-4">
    <div class="bg-orange-600 text-white  uppercase p-3 sm:rounded">
        Report - Late attendance
    </div>

        <a href="{{ route('app.attendance.applications') }}" class="ml-4 flex items-center text-sm uppercase rounded py-2 px-4 bg-sky-600 text-white hover:bg-sky-700">
           <i class="fa fa-long-arrow-alt-left fa-lg mr-2"></i>
          <span class="font-bold"> Back</span>
        </a>
    </div>

    <div class="w-full overflow-x-auto">
        <div class="p-3 w-full">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                 <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-3 py-3">SL# </th>
                        <th class="px-3 py-3">Employee </th>
                        <th class="px-3 py-3">CID</th>
                        <th class="px-3 py-3">EID</th>
                        <th class="px-3 py-3">Division</th>
                        <th class="px-3 py-3">Contact#</th>
                        <th class="px-3 py-3">Check In</th>
                    </tr>
                    </thead>
                    @if ($attendancereports->isNotEmpty())
                
                    @foreach($attendancereports as $index=>$item)
                    <tr class="text-gray-700">
                        <td class="px-2 py-2">
                            <div class="flex items-center text-sm">
                            {{ $index+1}}
                            </div>
                        </td>

                        <td class="px-2 py-2">
                            <div class="flex items-center text-sm">
                            {{ $item->user->name }} 
                            </div>
                        </td>

                        <td class="px-2 py-2">
                            <div class="flex items-center text-sm">
                            {{ isset($item->user->cid) ? $item->user->cid:''}}
                            </div>
                        </td>
                       
                        <td class="px-2 py-2">
                            <div class="flex items-center text-sm">
                            {{ isset($item->user->empid) ? $item->user->empid:''}}
                            </div>
                        </td>
                        
                        <td class="px-2 py-2">
                            <div class="flex items-center text-sm">
                            {{ $division = App\Http\Livewire\Utilities::getMemberConsitituncy($item->author) }} 
                            </div>
                        </td>
                       
                        <td class="px-2 py-2">
                            <div class="flex items-center text-sm">
                            {{ $item->user->contactno }} 
                            </div>
                        </td>
                       
                        <td class="px-2 py-2">
                            <div class="flex items-center text-sm">
                            <?=date('h:i:s A', $item->checkIn); ?>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr><td colspan="10" class="w-full text-center">
                        <div class="text-center mt-5 py-5">
                            <i class="fa fa-search fa-lg"></i>
                            <p class="text-lg">No attendance record ...</p>
                        </div>
                    </td><tr>
                @endif
                </table>
            </div>
        </div>
    </div>
</div>
