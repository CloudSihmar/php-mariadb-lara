<div>
    <div class="mt-3">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    @include('livewire.memberattendancereports._searchbar')
                    <div class="p-3 w-full">
                        <div class="bg-gray-100 shadow p-3 text-gray-600">
                        @if ($attendancereports->isNotEmpty())
                            <table style='border:1px solid #900; padding:3px;margin:3px;'>
                                <thead>
                                <tr style='border:1px solid #900;padding:3px;margin:3px;'>
                                    <th>SL#</th>
                                    <th class="p-2" style='border:1px solid #900'> Name</th>
                                    <th class="p-2" style='border:1px solid #900'> CID</th>
                                    <th class="p-2" style='border:1px solid #900'> Member</th>
                                    <th class="p-2" style='border:1px solid #900'>Contact#</th>
                                    <th class="p-2" style='border:1px solid #900'>Consitituncy</th>
                                    <th class="p-2" style='border:1px solid #900'>Date</th>
                                    <th class="p-2" style='border:1px solid #900'>Attendance Time</th>
                                </tr>
                                </thead>  
                                @foreach($attendancereports as $index=>$item) 
                                <tr style='border:1px solid #900'>
                                    <td class="p-2" style='border:1px solid #900'>
                                    {{ $index+1 }}
                                    </td>
                                    <td class="p-2" style='border:1px solid #900'>
                                    {{ $item->name }}
                                    </td>

                                    <td class="p-2" style='border:1px solid #900'>
                                    {{ $item->cid }}
                                    </td>
                                    
                                    <td class="p-2" style='border:1px solid #900'>
                                    {{ ($item->division_id == 5) ? 'NC':'MP'}}
                                    </td>

                                    <td class="p-2" style='border:1px solid #900'>
                                    {{ $item->contactno }}
                                    </td>

                                    <td class="p-2" style='border:1px solid #900'>
                                    {{ $consitituncy = App\Http\Livewire\Utilities::getMemberConsitituncy($item->id) }}
                                    </td>

                                    @php
                                        $result = $this->memberAttendanceRecord($item->id);
                                    @endphp
                                    @if(count($result) > 0)
                                    <td class="p-2" style='border:1px solid #900'>
                                    {{ substr($item->created_at,0,10) }}
                                    </td>
                                    
                                    <td class="p-2" style='border:1px solid #900'>
                                    {{ substr($item->created_at,11,10) }}
                                    </td>
                                    @else
                                    <td class="p-2" style='border:1px solid #900'>
                                    -
                                    </td>
                                    
                                    <td class="p-2" style='border:1px solid #900'>
                                    NA
                                    </td>
                                    @endif

                                    </tr>
                                    @endforeach
                            </table>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>