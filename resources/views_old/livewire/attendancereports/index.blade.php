<div class="my-6">
    <h1 class="py-2 font-bold text-xl text-cyan-600">Secretariat Attendance Report</h1>
    <div class="w-full overflow-x-auto">
            @include('livewire.attendancereports._searchbar')
            @php
                use App\Models\Admin\Division;
                use App\Models\Admin\Holiday;
                use App\Models\Attendance;
                use App\Models\Leave;
            @endphp
        <div class="p-3 w-full">
            <div class="bg-gray-100 shadow p-3 text-gray-600">
                <table style='border:1px solid #900; padding:3px;margin:3px;'>
                    <thead>
                        <tr style='border:1px solid #900;padding:3px;margin:3px;'>
                        <td class="p-2" style='border:1px solid #900'>SL# </td>
                        <td class="p-2" style='border:1px solid #900'>Employee </td>
                        <td class="p-2" style='border:1px solid #900'>CID</td>
                        <?php
                            $sl = 1;
                            $yr = !empty($year)? $year:Date('Y');
                            $mn = !empty($month)? $month:Date('n');
                            $days = cal_days_in_month(CAL_GREGORIAN,Date($mn),Date($yr));
                            $monthName = date("F", mktime(0, 0, 0, $mn, 10));

                            if(isset($division_id)){
                                $divisionLabel = Division::find($division_id);
                                if($division_id==0){
                                    echo "Division: ALL | Month:".$monthName." | Year: ".$yr;
                                }else{
                                    echo "Division: ".$divisionLabel->name."| Month:".$monthName." | Year: ".$yr;
                                }
                            }
                            $currentDay = Date('d');
                        
                            for($i=1; $i<=$days; $i++)
                            {
                                $d = $i<10 ? '0'.$i:$i;
                                $dt = $yr.'-'.$mn.'-'.$d;
                                $dt1 = strtotime($dt);
                                $dt2 = date("l", $dt1);
                                $dt3 = strtolower($dt2);
                                if(($dt3 == "saturday" )|| ($dt3 == "sunday"))
                                {
                                    echo "<td class='p-1 text-sm' style='text-align:center;border:1px solid #900;background-color: #7ae69f;'>$d</td>";
                                }else{ 
                                    if($currentDay == $i){
                                        echo "<td class='p-1 text-sm' style='text-align:center;border:1px solid #900;background-color:#f7e40f'>$d</td>";
                                    }else{
                                        echo "<td class='p-1 text-sm' style='text-align:center;border:1px solid #900;'>$d</td>";
                                    }
                                }
                            }
                        ?>
                        </tr>
                    </thead>
                    @if ($attendancereports->isNotEmpty())
                    @foreach($attendancereports as $item)
                    @php
                        $user_id = $item->id;
                    @endphp
                    @if($item->name != 'Admin')
                    <tr style='border:1px solid #900'>
                        <td class="p-2" style='border:1px solid #900'>
                            {{ $sl++ }} 
                        </td>
                        <td class="p-2" style='border:1px solid #900'>
                            {{ $item->name }} 
                        </td>
                        <td class="p-2" style='border:1px solid #900'>
                            {{ isset($item->cid) ? $item->cid:''}}
                        </td>
                        @for($i=1; $i<=$days; $i++)
                            <?php
                                $d = $i<9 ? '0'.$i : $i;
                                $date = $yr.'-'.$mn.'-'.$d;
                                $officeTime = '09:00';
                                // $result = LeaveLogs::with('leavetype')->where('fromdate','<=',$date)->where('todate','>=',$date)->where('user_id',$item->id)->get();
                                $result = Leave::with('leavetype')->where('fromdate','<=',$date)->where('todate','>=',$date)->where('author',$item->id)->get();
                            if(count($result)>0){

                                $timeIn = substr($result[0]->timeIn,11,5);
                                $officeTime = strtotime($officeTime, 0) / 60;
                                $checkInTime = strtotime($timeIn, 0) / 60;

                                // if($checkInTime < $officeTime){
                                //     $label = '#4cbaed';
                                // }else{
                                //     $label = '#f28129';
                                // }
                                $label = '#d4d0cf';
                                if(empty($result[0]->leavetype->leaveCode))
                                {
                                    $status = 'P';
                                }
                                else {
                                    $status = $result[0]->leavetype->leaveCode;
                                    $label = '#d4d0cf';
                                }
                            }
                            else{
                                    $result = Attendance::where('created_at','like',$date.'%')->where('author',$item->id)->get();
                                    if(count($result)>0){
                                        $status = 'P';
                                        $label = '#4cbaed';
                                    }else{
                                        $status = 'A';
                                        $label = '#d16460';
                                    }
                                }

                            $dt1 = strtotime($date);
                            $dt2 = date("l", $dt1);
                            $dt3 = strtolower($dt2);
                            if(($dt3 == "saturday" )|| ($dt3 == "sunday")){
                                $status = '';
                                $label = '#7ae69f';
                            }

                            $holiday = Holiday::where('holiday_date',$date)->take(1)->get();
                            if(count($holiday) > 0)
                            {
                                $status = '';
                                $label = '#287877';
                            }
                        ?>
                        <td class="p-2 text-sm border border-gray-500" style='background-color:<?=$label?>'>{{ $status }}</td>
                        @endfor
                    </tr>
                    @endif
                    @endforeach
                    @else
                    <tr><td colspan="30" class="w-full text-center">
                        <div class="text-center mt-5 py-5">
                            <i class="fa fa-search fa-lg"></i>
                            <p class="text-lg">No attendance record ...</p>
                            <p class="text-sm text-gray-600">Please try with above search option</p>
                        </div>
                    </td><tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="flex w-full">
            <div class="bg-gray-100 w-full shadow p-3 ml-3 text-xs text-gray-600">
                <div class="bg-gray-300 p-3 rounded font-bold text-gray-800 leading-tight">Legend</div>
                 <div class="grid grid-cols-4 mt-4 gap-1">
                   <span class="bg-green-400 px-2 py-2 rounded text-xs text-gray-600">Weekend</span>
                    <!--  <span class="bg-sky-500 px-2 py-2 rounded text-xs text-gray-600">Before 9.00AM</span>
                    <span class="bg-orange-500 px-2 py-2 rounded text-xs text-gray-600">After 9.00AM</span> -->
                    <span class="bg-red-500 px-2 py-2 rounded text-xs text-gray-600">Absent</span>
                    <span class="bg-cyan-600 px-2 py-2 rounded text-xs text-gray-600">Holiday</span>
                    <span class="bg-yellow-500 px-2 py-2 rounded text-xs text-gray-600">Today</span>
                </div> 


                <div class="grid grid-cols-4 mt-4 gap-1">
                    @foreach($leavecategories as $leave)
                    <p class="bg-gray-300  text-xs px-2 py-2 rounded text-gray-900">{{ $leave->leaveCode }} - {{ $leave->name }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
