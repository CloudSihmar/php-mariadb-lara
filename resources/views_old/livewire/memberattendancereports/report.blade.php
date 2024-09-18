<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Members Attendance Report</title>
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
          margin: 10px 0;
          font-size: 0.7em;
          font-family: sans-serif;
          width: 100%;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }
      .styled-table-st {
          border-collapse: collapse;
          margin: 25px 0;
          font-size: 0.7em;
          font-family: sans-serif;
          width: 30%;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }
      .styled-table-st th,
      .styled-table-st td {
          padding: 5px;
          text-align: left;
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

      .general-spacing{
        padding-top: 20px;
      }

      .footer{
         font-size: 12px;
          padding: 10px 10px 40px 10px;
          text-align: center;
      } 
    </style>
<body>
  <htmlpageheader name="page-header">
      <div class="row">
        <div class="column left">
           <div class="logo">
            @if($label == 'JS')
              <img src="{{public_path().'/assets/img/parliament-logo.png'}}" class="logo">
            @endif
            @if($label == 'MP')
              <img src="{{public_path().'/assets/img/na-logo.png'}}" class="logo">
            @endif
            @if($label == 'NC')
              <img src="{{public_path().'/assets/img/nc-logo.png'}}" class="logo">
            @endif
          </div>
        </div>
        <div class="column middle">
          <!-- @if($label == 'JS')
            <div class="jhomolhari font-xl">འབྲུག་གི་སྤྱི་ཚོག།</div>
            <div class="times font-md">PARLIAMENT OF BHUTAN</div>
          @endif

          @if($label == 'MP')
            <div class="jhomolhari font-xl">འབྲུག་གི་རྒྱལ་ཡོངས་ཚོགས་འདུ།</div>
            <div class="times font-md">NATIONAL ASSEMBLY OF BHUTAN</div>
          @endif

          @if($label == 'NC')
            <div class="jhomolhari font-xl">འབྲུག་གི་རྒྱལ་ཡོངས་ཚོགས་སྡེ།</div>
            <div class="times font-md">NATIONAL COUNCIL OF BHUTAN</div>
          @endif -->
           <div class="jhomolhari font-xl">འབྲུག་གི་རྒྱལ་ཡོངས་ཚོགས་འདུ།</div>
           <div class="times font-md">NATIONAL ASSEMBLY OF BHUTAN</div>
        </div>
        <div class="column right">
           <div class="logo">
            <img src="{{public_path().'/assets/img/logo.jpeg'}}" class="rgob logo">
          </div>
        </div>
      </div>
</htmlpageheader>

  <div class="row">
    <div class="column date"><?=$title?> </div>
  <div>
      <table class="styled-table-st">
      <tr style='border:1px solid #c0c0c0'><td colspan="2"><b><center>Summary Report</center></b></td></tr>
      <tr style='border:1px solid #c0c0c0'><td>Total Members Present</td><td> {{$totalmember_present}}</td></tr>
      <tr style='border:1px solid #c0c0c0'><td>Total Members Not Present </td><td> {{$totalmember_absent}}</td></tr>
      <tr style='border:1px solid #c0c0c0'><td>Total Members </td><td> {{$totalmembers}}</td></tr>
    </table>
    
    @if ($attendancereports->isNotEmpty())
    <table class="styled-table">
        <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50">
            <th>SL#</th>
            <th class="px-3 py-3">Name</th>
            <th class="px-3 py-3">Member</th>
            <th class="px-3 py-3">Consitituncy</th>
            <th class="px-3 py-3">Date</th>
            <th class="px-3 py-3">Check In Time</th>
            <th class="px-3 py-3">Check Out Time</th>
            <!-- <th class="px-3 py-3">Status</th> -->
        </tr>
        </thead>  
        @foreach($attendancereports as $index=>$item) 
        <tr style='border:1px solid #c0c0c0'>
            <td class="px-3 py-3">
            {{ $index+1 }}
            </td>

            <td class="px-3 py-3">
            {{ $item->name }}
            </td>

            <td class="px-3 py-3">
            {{ $item->title->name}}
            </td>

            <td class="px-3 py-3">
            {{ $consitituncy = App\Http\Livewire\Utilities::getMemberConsitituncy($item->id); }}
            </td>

            @php
              $fromDate = Date('Y-m-d');
              $result = App\Http\Livewire\Utilities::memberAttendanceRecord($item->id,$fromDate);
              echo "<pre>";
                print_r($result);
            @endphp
          
            @if(count($result) > 0)
              <td class="px-3 py-3">
              {{ substr($result[0]->created_at,0,10) }}
              </td>

              <td class="px-3 py-3">
                {{ Date('H:i:s',$result[0]->checkIn) }}
              </td>

              <td class="px-3 py-3">
                @php echo empty($result[0]->checkOut)? 'NA':Date('H:i:s',$result[0]->checkOut); @endphp
              </td>

              <!-- <td class="px-3 py-3">
                @php echo ($result[0]->status ==1)? 'P':'A'; @endphp
              </td> -->

            @else
              <td class="px-3 py-3">
              {{ $fromDate}}
              </td>
              <td class="px-3 py-3">
                NA
              </td>
              <td class="px-3 py-3">
                NA
              </td>
             
              <!-- <td class="px-3 py-3">
                A
              </td> -->
            @endif
            </tr>
        @endforeach
    </table>
    @else
      <p class="font-lg">No attendance record ...</p>
      <p class="text-base text-gray-600">Please try with above search option</p>
    @endif

    <htmlpagefooter name="page-footer">
      <hr>
        <div class="footer times">
          POST BOX # 139, THIMPHU: BHUTAN <br>
          www.nab.gov.bt www.facebook.com/NABhutan
        </div>
    </htmlpagefooter>
  </body>
  </html>
  
