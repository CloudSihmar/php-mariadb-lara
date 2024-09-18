<div>
  <div class="flex  items-center justify-between my-4 mx-2">
      <h1 class="py-1 uppercase font-bold text-center md:text-xl">Internal Web Links</h1>
  </div>

    <div x-data="{ sidebarOpen: false}">
      <div class="flex min-h-screen bg-white">
        
          <div class="w-full">
          <nav class="flex flex-col pt-10 md:pt-2 ml-2 overflow-hidden">
            @foreach ($weblinks as $item)
              @php
               echo "<a href=$item->url target='_blank'><i class='fa fa-arrow-alt-circle-right mt-3 mr-2'></i><span> $item->name</a>"; 
              @endphp
         </span>  
            @endforeach
          </nav>
        </div>
        
      </div>
    </div>
</div>
@push('scripts')
<script>
function show_my_receipt(url) {
         // open the page as popup //
        //  var page = 'http://www.test.com';
         var myWindow = window.open(url, "_blank");
         
         // focus on the popup //
         myWindow.focus();
         
         // if you want to close it after some time (like for example open the popup print the receipt and close it) //
         
        //  setTimeout(function() {
        //    myWindow.close();
        //  }, 1000);
        
       }
  </script>
  @endpush