<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Attendance Report</title>
</head>
 <style>
   @page {
            header: page-header;
            footer: page-footer;
        }
        * {
            box-sizing: border-box;
        }


        h2{
         padding: 2px;
         font-size: 18px;
       }

       h3{
         padding: 2px;
         font-size: 16px;
       }
       p{
         padding: 1px;
       }
      .styled-table {
          border-collapse: collapse;
          margin: 25px 0;
          font-size: 0.7em;
          font-family: sans-serif;
          width: 100%;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }

      .styled-table thead tr {
          background-color: #009879;
          color: #ffffff;
      }

      .styled-table th,
      .styled-table td {
          padding: 12px 15px;
          text-align: left;
      }

      .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .row:after {
          content: "";
          display: table;
          clear: both;
        }
       
        .divider {
            border-bottom: 2px solid #009879;
        }
        .column {
        float: left;
      }

      .left,.right {
        width: 18%;
      }

      .middle {
        width: 58%;
        text-align: center;
      }

      .row:after {
        content: "";
        display: table;
        clear: both;
      }

      .logo{
            height: 100px;
            width: auto;
            float: right;
          }
       .tname{
            padding-top: 20px;
          }   

      .jhomolhari{
        font-family: 'dzongkha', sans-serif;
      }

        .times{
        font-family: 'times', sans-serif;
      }
        
      .font-xl{
          font-size: 30px;
      }

      .font-lg{
          font-size: 26px;
      }

      .font-md{
          font-size: 20px;
      }

      .font-base{
          font-size: 18px;
      }

      .font-content{
          font-size: 16px;
      }

      .footer{
         font-size: 12px;
          padding: 10px 10px 40px 10px;
          text-align: center;
      } 
</style>
<body>
  <htmlpageheader name="page-header">
    <div class="header">
      <div class="row">
        <div class="column left">
           <div class="logo">
            <img src="{{public_path().'/assets/img/na-logo.png'}}" class="logo">
          </div>
        </div>
        <div class="column middle">
          <div class="jhomolhari font-xl">འབྲུག་གི་རྒྱལ་ཡོངས་ཚོགས་འདུ།</div>
          <div class="times font-md">NATIONAL ASSEMBLY OF BHUTAN</div>
        </div>
        <div class="column right">
           <div class="logo">
            <img src="{{public_path().'/assets/img/logo.jpeg'}}" class="rgob logo">
          </div>
        </div>
      </div>
     </div>  
</htmlpageheader>
<main class="main">
      @php
          use App\Models\Admin\Division;
          use App\Models\Admin\Holiday;
          use App\Models\Leave;
          use App\Models\Attendance;
          
      @endphp
    <?php
        $yr = !empty($year)? $year:Date('Y');
        $mn = !empty($month)? $month:Date('n');
       
        $monthName = date("F", mktime(0, 0, 0, $mn, 10));
        $title='';
        if(isset($division_id)){
            if($division_id==0){
                $title = " Division: ALL | Month:".$monthName." | Year: ".$yr;
            }else{
                $divisionLabel = Division::find($division_id);
                $title = " Division: ".$divisionLabel->name."| Month:".$monthName." | Year: ".$yr;
            }
        }
    ?>
  <div class="row content">
    <div class="column">Attendance Report </div>
    <div class="column date"><?=$title?> </div>
  </div>

      <table class="font-sm" style='border:1px solid #c0c0c0; padding:3px;margin:3px;'>
        <thead>
            <tr style='border:1px solid #c0c0c0;padding:3px;margin:3px;'>
            <td class="p-2" style='border:1px solid #c0c0c0'><b>Sl#</b></td>
            <td class="p-2" style='border:1px solid #c0c0c0'><b>Employee</b></td>
            <td class="p-2" style='border:1px solid #c0c0c0'><b>EID/CID</b></td>
            <?php
                $sl=1;
                $days = cal_days_in_month(CAL_GREGORIAN,Date($mn),Date($yr));
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
                        echo "<td class='p-1 text-sm' style='text-align:center;border:1px solid #c0c0c0;background-color: #7ae69f;'>$d</td>";
                    }else{ 
                        if($currentDay == $i){
                            echo "<td class='p-1 text-sm' style='text-align:center;border:1px solid #c0c0c0;background-color:#f7e40f'>$d</td>";
                        }else{
                            echo "<td class='p-1 text-sm' style='text-align:center;border:1px solid #c0c0c0;'>$d</td>";
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
          <tr style='border:1px solid #c0c0c0'>
            <td class="p-2" style='border:1px solid #c0c0c0'>{{ $sl++ }}</td>
            <td class="p-2" style='border:1px solid #c0c0c0'>{{ $item->name }}</td>
            <td class="p-2" style='border:1px solid #c0c0c0'> 
            @if($item->department_id  == 2)
            {{ isset($item->cid) ? $item->cid:''}}
            @else
            {{ isset($item->empid) ? $item->empid:''}}
            @endif
            </td>
            
              @for($i=1; $i<=$days; $i++)
                  <?php
                      $d = $i<9 ? '0'.$i : $i;
                      $date = $yr.'-'.$mn.'-'.$d;
                      $officeTime = '09:00';
                      
                    //   $result = AttendanceLogs::with('leavetype')->where('dated',$date)->where('user_id',$item->id)->get();
                    //   $result = LeaveLogs::with('leavetype')->where('fromdate','<=',$date)->where('todate','>=',$date)->where('user_id',$item->id)->get();
                      $result = Leave::with('leavetype')->where('fromdate','<=',$date)->where('todate','>=',$date)->where('author',$item->id)->get();
                      if(count($result)>0){
                        $timeIn = substr($result[0]->timeIn,11,5);
                        $officeTime = strtotime($officeTime, 0) / 60;
                        $checkInTime = strtotime($timeIn, 0) / 60;

                        if($checkInTime < $officeTime){
                            $label = '#4cbaed';
                        }else{
                            $label = '#f28129';
                        }
                        
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

    <table style='border:0px solid #900; padding:3px;margin:3px;'>
    <tr style='border:0px solid #900;padding:3px;margin:3px; font-size:12px'><td colspan="10"><b>Legend</b></td></tr>
        @foreach($leavecategories as $index=>$leave)
        @if($index %4 ==0)
        <tr style='border:0px solid #c0c0c0;padding:3px;margin:3px;'>
        @endif
        <td class="p-2 font-xs" style='border:1px solid #c0c0c0;width:200px;'>{{ $leave->leaveCode }}-{{ $leave->name }}</td>
        @endforeach
        </tr>
    </table>
</main>

<htmlpagefooter name="page-footer">
   <hr>
    <div class="footer times">
      POST BOX # 139, THIMPHU: BHUTAN <br>
      www.nab.gov.bt www.facebook.com/NABhutan
    </div>
</htmlpagefooter>
  </body>
  </html>
  
