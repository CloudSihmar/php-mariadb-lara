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
                @if($label == 'JS')
                    <img src="{{public_path().'/assets/img/parliament-logo.png'}}" class="logo">
                @endif
                @if($label == 'NA')
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

                @if($label == 'NA')
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
    </div>  
</htmlpageheader>
<main class="main">
  <div class="row content">
    <div class="column date"><?=$title?> </div>
  <div>
    
  <div class="w-full">
    <div class="bg-gray-100 shadow text-gray-600">
        <table class="styled-table">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50">
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
                <tr style='border:1px solid #c0c0c0'>
                    <td class="px-2 py-3">
                        <div class="flex items-center text-sm">
                            {{ $index+1 }}
                        </div>
                    </td>

                    @php
                        $fromDate = Session::get('fromDate'); 
                        $result = App\Http\Livewire\Utilities::memberAttendanceRecord($item->id,$fromDate);
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
  

