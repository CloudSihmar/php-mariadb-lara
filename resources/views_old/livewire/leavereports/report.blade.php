<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
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
<div>
  @php
    use App\Models\Admin\Division;
    use App\Models\Admin\Holiday;
    use Illuminate\Foundation\Auth\User;
    $title = 'From: '.$fromDate.' , To '.$toDate;
    $sl=1;
@endphp
  <div class="row">
    <div class="column">Leave Report </div>
    <div class="column date"><?=$title?> </div>
  </div>
  <div>
    @if ($leavereports->isNotEmpty())
    <table class="styled-table">
        <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
            <th class="px-3 py-3">SL#</th>
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

        @foreach ($leavereports as $item)
        <tr style='border:1px solid #c0c0c0'>
            <td class="px-3 py-3">
                <div class="flex items-center text-sm">
                    @php echo $sl++; @endphp
                </div>
            </td>
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
      <p class="font-lg">Sorry!!! No leave record found...</p>
      <p class="font-base text-gray-600">Please try another search option</p>
    @endif
  </div>

<htmlpagefooter name="page-footer">
   <hr>
    <div class="footer times">
      POST BOX # 139, THIMPHU: BHUTAN <br>
      www.nab.gov.bt www.facebook.com/NABhutan
    </div>
</htmlpagefooter>
</body>
</html>

