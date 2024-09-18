<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\sendMail;
use Livewire\Component;
use App\Models\LeaveLogs;
use App\Models\Attendance;
use App\Models\Admin\Agency;
use App\Models\Notification;
use App\Models\Admin\Holiday;
use App\Models\Admin\Division;
use App\Models\Admin\Dzongkhag;
use App\Models\AttendanceLeave;
use App\Models\Admin\Department;
use App\Models\Admin\Constituency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\DispatchReceiveNumber;

class Utilities extends Component
{
    //Send email 
    public static function sendMail($to, $title, $body)
    {
        $headers = 'Content-type: text/html; charset=WINDOWS-1253;' . "\r\n";

        $details = [
                    'title' => $title,
                    'body' => $body
                ];
        Mail::to($to)->send(new sendMail($details,$headers));
    }

	/* Get Dispatch Number*/
	public static function  getDispatchNumber(){
        $year = Date('Y');
        $result = DispatchReceiveNumber::where('dORr',2)->where('year',$year)->first();
        $drNumber = $result->dr_num;
        $dispatchReceiveNumber = DispatchReceiveNumber::find($result->id);
        $dispatchReceiveNumber->dr_num = $drNumber+1;
        $dispatchReceiveNumber->save();
        $len = '5';
        $length = (int)$len - strlen($drNumber);
        $zeros = "";
        for($i=0;$i<$length;$i++){
            $zeros.="0";
        }
        return $zeros.$drNumber;
    }


	/* Get Dak Number*/
	public static function  getDakNumber(){
        $year = Date('Y');
        $result = DispatchReceiveNumber::where('dORr',1)->where('year',$year)->first();
        $drNumber = $result->dr_num;
        $dispatchReceiveNumber = DispatchReceiveNumber::find($result->id);
        $dispatchReceiveNumber->dr_num = $drNumber+1;
        $dispatchReceiveNumber->save();
        $len = '5';
        $length = (int)$len - strlen($drNumber);
        $zeros = "";
        for($i=0;$i<$length;$i++){
            $zeros.="0";
        }
        return $zeros.$drNumber;
    }
    
    public static function formated_date($date)
    {
     return Carbon::parse($date)->format('Y-m-d');
    }
    

    //Get userName 
    public static function userName($id=null)
    {
        $user = User::find($id);
        return !empty($user->name) ? $user->name : '';
    }
    
      //Get userName 
      public static function approvedBy($id=null)
      {
          $user = User::find($id);
          return !empty($user->name) ? $user->name : '';
      }
  

     //Get Member Consitituncy  
     public static function getMemberConsitituncy($id=null)
     {
        $user = User::find($id);
        if($user->division_id == 6){
            $consitituncy = Dzongkhag::where('id',$user->dzongkhag_id)->get()->first();
            $consitituncy = !empty($consitituncy->name) ? $consitituncy->name : '-';
        }else if($user->division_id == 5){
            $consitituncy = Constituency::where('id',$user->constituency_id)->get()->first();
            $consitituncy = !empty($consitituncy->name) ? $consitituncy->name : '-';
        } else{
            $consitituncy = Division::where('id',$user->division_id)->get()->first();
            $consitituncy = !empty($consitituncy->name) ? $consitituncy->name : '-';
        }
         return $consitituncy;
     }

     //Get memberAttendanceRecord 
     public static function memberAttendanceRecord($userId=null,$fromDate)
     {
        $attendanceRecord = Attendance::with('user')->where('author',$userId)->where('created_at','like',$fromDate.'%')->orderBy('id','desc')->get();
        return  $attendanceRecord;
     }


     //Get staffAttendanceRecord 
     public static function staffAttendanceRecord($userId=null,$fromDate)
     {
        $attendanceRecord = Attendance::with('user')->where('author',$userId)->where('created_at','like',$fromDate.'%')->orderBy('id','desc')->get();
        return  $attendanceRecord;
     }

    //Get Agency Name 
    public static function agencyName($id=null)
    {
        $agency = Agency::find($id);
        return !empty($agency->name) ? $agency->name : 'NA';
    }

    
     //Get Dept Name 
     public static function departmentName($id=null)
     {
         $departmentName = Department::find($id);
         return !empty($departmentName->name) ? $departmentName->name : 'NA';
     }
  
       //Get divisionName  
    public static function divisionName($id=null)
    {
        $div = Division::find($id);
        return !empty($div->name) ? $div->name : '';
    }

    public function numberofDays($date1, $date2)
    {
        dd($date1);
        $date1_ts = strtotime($date1);
        $date2_ts = strtotime($date2);
        $diff = $date2_ts - $date1_ts;
        return round($diff / 86400);
    }

    //Send Notification to the user
    public static function sendNotification($fk, $to, $msg, $route){
        Notification::create([
            'fid' => $fk,
            'flag' => 0,
            'forward_to' => $to,
            'message' => !empty($msg)? $msg : 'No comment provided',
            'route' => $route,
            'author' => Auth::user()->id,
        ]);
    }

    //Update Notification 
    public static function updateNotification($fid){
        $notificationstatus = Notification::where('fid',$fid)->where('forward_to',Auth::user()->id)->orderBy('id','desc')->get()->first();
        if(!empty($notificationstatus)){
          if($notificationstatus->flag ==0 ){
              $notificationstatu_data = array(
              "id"   => $notificationstatus->id,
              "flag" => 1
            );
            $notificationstatus->update($notificationstatu_data);
          }
        }
    }

 //Get Notification Status
    public static function getNotificationStatus($fid){
    $notificationstatus = Notification::where('fid',$fid)->where('forward_to',Auth::user()->id)->orderBy('id','desc')->get()->first();
    if(!empty($notificationstatus)){
      if($notificationstatus->flag==1){
         return 1;
      }else{
          return 0;
      }
    }else{
      return 2;
    }
  }
  
  //The function returns the no. of business days between two dates and it skips the holidays
  public static function getWorkingDays($startDate, $endDate){
    $holidaysList = Holiday::where('year', Date('Y'))->get();
    $holidays_arr = array();
    for($i=0; $i<count($holidaysList); $i++){
      array_push($holidays_arr, $holidaysList[$i]['holiday_date']);
    }
    $holidays = $holidays_arr;
    // do strtotime calculations just once
    $endDate = strtotime($endDate);
    $startDate = strtotime($startDate);

    //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
    //We add one to inlude both dates in the interval.
    $days = ($endDate - $startDate) / 86400 + 1;

    $no_full_weeks = floor($days / 7);
    $no_remaining_days = fmod($days, 7);

    //It will return 1 if it's Monday,.. ,7 for Sunday
    $the_first_day_of_week = date("N", $startDate);
    $the_last_day_of_week = date("N", $endDate);

    //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
    //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
    if ($the_first_day_of_week <= $the_last_day_of_week) {
        if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
        if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
    }
    else {
        // (edit by Tokes to fix an edge case where the start day was a Sunday
        // and the end day was NOT a Saturday)

        // the day of the week for start is later than the day of the week for end
        if ($the_first_day_of_week == 7) {
            // if the start date is a Sunday, then we definitely subtract 1 day
            $no_remaining_days--;

            if ($the_last_day_of_week == 6) {
                // if the end date is a Saturday, then we subtract another day
                $no_remaining_days--;
            }
        }
        else {
            // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
            // so we skip an entire weekend and subtract 2 days
            $no_remaining_days -= 2;
        }
    }

    //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
  //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
  $workingDays = $no_full_weeks * 5;
    if ($no_remaining_days > 0 )
    {
      $workingDays += $no_remaining_days;
    }

    //We subtract the holidays
    foreach($holidays as $holiday){
        $time_stamp=strtotime($holiday);
        //If the holiday doesn't fall in weekend
        if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
            $workingDays--;
    }

    return $workingDays;
  }
}

