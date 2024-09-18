  
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Conference hall booking report</title>
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
          font-size: 0.7em;
          font-family: sans-serif;
          width: 100%;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }

      .styled-table thead tr th {
          background-color: #009879;
          color: #ffffff;
      }

      .styled-table th,
      .styled-table td {
          padding: 12px 15px;
          text-align: left;
      }

      .styled-table tbody tr td {
            border-bottom: 1px solid #c0c0c0;
        }
   
      .column {
        float: left;
      }

      .left,.right {
        width: 15%;
      }

      .middle {
        width: 69%;
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
        
      .header{
        padding-top: 20px;
      } 

      .center{
        text-align: center;
      }

      .main{
        padding-top:2px;
        text-align: justify;
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
  </head>
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
    <h5 class="center">Conference hall Booking Report</h5>
    @if ($bookings->isNotEmpty())
    <table class="styled-table">
      <thead>
        <tr>
          <th>SL#</th>
          <th class="px-3 py-3">Conference Hall Name</th>
          <th class="px-3 py-3">Booked by</th>
          <th class="px-3 py-3">Division</th>
          <th class="px-3 py-3">From </th>
          <th class="px-3 py-3">To</th>
          <th class="px-3 py-3">Purpose</th>
        </tr>  
      </thead>
      <tbody>
        @foreach ($bookings as $index => $item)
        <tr>
          <td>{{ $index+1 }}
          <td class="px-4 py-2">
            <div class="text-sm">
              {{ \App\Models\Admin\Conferencehall::find($item->hall_id)->name }} 
            </div>
          </td>
            @php $user = \App\Models\User::find($item->user_id); @endphp
            <td class="px-4 py-2">
            <div class="text-sm">
              {{  $user->name }} 
            </div>
          </td>
          
          <td class="px-4 py-2">
            <div class="text-sm">
              {{ \App\Models\Admin\Division::find($user->division_id)->name }} 
            </div>
          </td>
        
          <td class="px-4 py-2">
            <div class="text-sm">
              {{ date('d-m-Y h:i:s A', strtotime($item->start_at));}}
            </div>
          </td>

           <td class="px-4 py-2">
            <div class="text-sm">
              {{ date('d-m-Y h:i:s A', strtotime($item->end_at));}}
            </div>
          </td>

           <td class="px-4 py-2">
            <div class="text-sm">
              {{ $item->purpose }}
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
      @else
        <div class="text-center pb-2">
          <i class="fa fa-search fa-lg"></i>
          <p class="text-lg">Sorry!!! No leave record found...</p>
          <p class="text-sm text-gray-600">Please try another search option</p>
        </div>
      @endif
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

