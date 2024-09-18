  
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Received Letter Report</title>
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
</htmlpageheader>
  <div class="row">
    <div class="column">Received Letter Report </div>
    <div class="column date">{{$title}} </div>
  </div>

        @if ($receiveletters->isNotEmpty())
            <table class="styled-table">
            <thead>
              <tr>
                <th>Sl#</th>
                <th>Dak Number</th>
                <th>Subject </th>
                <th>From</th>
                <th>To</th>
                <th>File Index</th>
                <th>Received Date</th>
                <th>Received By</th>
              </tr>
            </thead>
            <tbody>
                @php $sl =1; @endphp
                @foreach ($receiveletters as $item)
                <tr style='border:1px solid #c0c0c0'>
                    <td>
                           @php echo $sl++; @endphp
                    </td>

                    <td>
                           @if(isset($item->dak_number)) {{ $item->dak_number }} @endif
                    </td>

                    <td>
                        @if(isset($item->to_subject)) {{ $item->to_subject }} @endif
                    </td>

                    <td>
                        @if(isset($item->from_agency)) {{ $item->from_agency }} @endif
                    </td>

                    <td>
                        @if(isset($item->division->name)) {{ $item->division->name }} @endif
                    </td>

                    <td>
                          {{ !empty($item->file_index) ? $item->file_index:''; }}
                    </td>

                    <td>
                        @if(isset($item->receive_date))
                          {{  \Carbon\Carbon::parse($item->receive_date)->format('d-M-Y') }}
                        @endif
                    </td>

                     <td>
                        @if(isset($item->author)) {{ $item->user->name }} @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            @else
            <p class="font-lg">Sorry!!! No letter record found...</p>
            <p class="font-base">Please try another search option</p>
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

  
