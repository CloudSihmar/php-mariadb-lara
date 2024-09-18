  
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Workflow Report</title>
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
        
      .header{
        padding-top: 20px;
      } 

      .content{
        padding: 20px 20px; 
        margin-top:10px;
        text-align: justify;
      }

      .main{
        padding: 65px 20px; 
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
  <div class="row content">
    <div class="column">Work Flow Report </div>
    <div class="column date">{{$title}} </div>
  </div>

  <div class="bg-gray-100 w-full shadow text-gray-600">
                @if ($workflowreports->isNotEmpty())
                <table class="styled-table">
              <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                  <th>SL#</th>
                  <th class="px-4 py-2">Subject</th>
                  <th class="px-4 py-2">Content</th>
                  <th class="px-4 py-2">Created By</th>
                  <th class="px-4 py-2">Created Date</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y">
                @foreach ($workflowreports as $index=>$result)
                <tr style='border:1px solid #c0c0c0'>
                  <td>{{ $index+1 }}
                  <td class="px-4 py-2">
                    <div class="text-sm">
                      {{ $result->name}}
                    </div>
                  </td>

                   <td class="px-4 py-2">
                    <div class="text-sm">
                      {!! substr($result->content,0,70) !!}
                    </div>
                  </td>
                  
                  <td class="px-4 py-2">
                    <div class="text-sm">
                      @php
                        $username = App\Http\Livewire\Utilities::userName($result->author);
                      @endphp
                      {{ $username}}
                    </div>
                  </td>
                
                  <td class="px-4 py-2">
                    <div class="text-sm">
                    {{ $result->created_date }}
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

