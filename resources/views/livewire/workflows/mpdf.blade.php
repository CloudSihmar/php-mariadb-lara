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
      
  * { box-sizing: border-box;}

    .pt-14{padding-top:14px; }
    .pt-6{padding-top:6px; }
    .pt-4{padding-top:4px; }
    .pt-2{padding-top:2px; }

    .column { float: left;}
    .left, .right { width: 20%;}
    .middle { width: 60%;}

    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    .logo{height: 150px; width: auto;}

    .pt-4{ padding-top: 14px;}   

    .jhomolhari{
      font-family: 'dzongkha', sans-serif;
    }

     .TimesNewRoman{
      font-family: "Times New Roman", Times, serif;
    }
    

    .fontSize-30{font-size:30px;}
    .fontSize-28{font-size:28px;}
    .fontSize-26{font-size:26px;}
    .fontSize-24{font-size:24px;}
    .fontSize-22{font-size:22px;}
    .fontSize-20{font-size:20px;}
    .fontSize-18{font-size: 18px;}
    .fontSize-16{font-size: 16px;}
    .fontSize-14{font-size: 14px;}
    .fontSize-12{font-size: 12px;}

    .text-center{text-align: center;}
    
    .body-content{
      text-align: justify;
      text-justify: inter-word;
      line-height: 1.6;
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
              <img src="{{public_path().'/assets/img/GovTech Logo .png'}}" class="logo">
          </div>
          <div class="column middle">
            <div class="text-center jhomolhari fontSize-30">འབྲུག་གཞུང་འཕྲུལ་རིག་ལས་སྡེ།</div>
            <div class="text-center fontSize-20">GOVTECH AGENCY</div>
          </div>
          <div class="column right">
            <div class="logo">
              <img src="{{public_path().'/assets/img/logo.jpeg'}}" class="rgob logo">
            </div>
          </div>
        </div>
  </htmlpageheader>
    @if ($tempID==1)
        @if ($language=='dz')
            <div style="padding-left:20px" class="jhomolhari pt-14 fontSize-20">དྲུང་ཆེན།</div>
        @else
            <div class="pt-4 font-14" style="padding-left:12px">Secretary</div>
        @endif
        @php $phone = 'Phone: +975 2 336828/321137' @endphp
    @elseif($tempID==2)
        @if ($language=='dz')
            <div class="jhomolhari pt-4 fontSize-20">མདོ༌ཆེན།</div>
        @else
        <div class="pt-4 fontSize-14">
          <div style="padding-left:2px">Director</div>
          </div>
        @endif
        @php $phone = 'PABX: +975 2 336906/975 2 336907/ 336908/ 331380' @endphp
    @elseif($tempID==3)
        @if ($language=='dz')
            <div class="jhomolhari pt-4 fontSize-20">གཙོ༌འཛིན།</div>
        @else
          <div class="pt-4 "> 
            <div style="padding-left:10px">Chief</div>
          </div>
        @endif
        @php $phone = 'Phone: +975 2 336567/336566' @endphp
    @elseif($tempID==4)
        @if ($language=='dz')
            <div class="jhomolhari pt-4 fontSize-20">ཡོངས་ཁྱབ་དྲུང་ཆེན།</div>
        @else
          <div class="pt-4 "> 
            <div style="padding-left:10px">SECRETARY</div>
            <div style="padding-left:16px">GENERAL</div>
          </div>
        @endif
        @php $phone = 'Tel: +975-02-323215' @endphp
      @elseif($tempID==5)
          <div style="padding-top:10px"></div>
          @php $phone = 'Fax: +975-02-328440' @endphp 
      @endif

      <div class="pt-4 body-content fontSize-14" style="padding-left:560px">
        @php $fileindex = \App\Models\Admin\Fileindex::where('id', $fileindex)->get()->first() @endphp  
        @isset($fileindex)
            {{$fileindex->name}}
        @endisset
        
       @php $date = Date('d M Y') @endphp  
       <br/> {{$date}}
      </div>
          
      <div class="{{ $language=='dz' ? 'jhomolhari fontSize-18':'TimesNewRoman fontSize-16'}} body-content">
        {!! $workflow->content !!}
      </div>

  <htmlpagefooter name="page-footer">
    <hr>
      <div class="footer ">
        POST BOX # 482, THIMPHU: BHUTAN, {{ $phone }} <br>
        www.tech.gov.bt https://www.facebook.com/GovTechBhutan
      </div>
  </htmlpagefooter>
</body>
</html>

