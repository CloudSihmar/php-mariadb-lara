<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Leave Balance Report</title>
</head>
<style>
    @page {
        header: page-header;
        footer: page-footer;
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
      

      .jhomolhari{
        font-family: 'dzongkha', sans-serif;
      }

     
        
      .header{
        padding-top: 20px;
      } 

      .content{
        padding-top:80px;
        padding-bottom:120px;
        text-align: justify;
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

        table {
          border-collapse: collapse;
          width: 100%;
        }

        th, td {
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
          background-color: #04AA6D;
          color: white;
        }

      .footer{
         font-size: 12px;
          text-align: center;
      } 
</style>
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

<table>
  <thead>
    <tr>
      <th> Sl#</th>
      <th> Name</th>
      <th> Division</th>
      <th>Casual Leave Balance</th>
      <th>Earned Leave Balance</th>
      <th>HR Comment</th>
    </tr>
  </thead>
  <tbody>
    @foreach($userleavebalances as $index=>$u)
      <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $u->name }}</td>
        <td>{{ $u->division->name }}</td>
        <td>
           @if(!empty($u->balanceleave->casual_leave))
                {{ $u->balanceleave->casual_leave}}
              @endif
        </td>
        <td>
           @if(isset($u->balanceleave->earn_leave))
              {{ $u->balanceleave->earn_leave}}
            @endif
        </td>

        <td>
            @if(!empty($u->balanceleave->remarks))
                {{ $u->balanceleave->remarks}}
              @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<htmlpagefooter name="page-footer">
    <div class="footer times">
      <hr>
      POST BOX # 139, THIMPHU: BHUTAN <br>
      www.nab.gov.bt www.facebook.com/NABhutan
    </div>
</htmlpagefooter>
  </body>
  </html>
