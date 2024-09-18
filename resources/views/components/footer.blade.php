<footer style="background: #28282B">
    <div class="container p-6 mx-auto">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
          @php $linkcategories = \App\Models\Admin\Weblinkcategory::all() @endphp
          @foreach ($linkcategories as $item)
            <div>
                <h3 class="text-gray-50 font-bold">{{ $item->name}}</h3>
                 @foreach ($item->weblink as $link)
                 <div class="flex items-center mt-2 text-gray-50">
                   <i class="fa fa-angle-double-right mr-2"></i><a href="{{ $link->url }}" target="_blank" class="block text-sm hover:underline">{{$link->name }}</a>
                 </div>
                @endforeach
            </div>
          @endforeach
        </div>

        <hr class="h-px my-6 bg-gray-100 border-none">
       <div class="mt-4 text-sm text-center p-2 text-gray-50"><!--<span>© Copyright <?php echo date("Y"); ?>. All rights reserved.</span> !-->
            <a href="https://tech.gov.bt/">GovTech Agency</a>
          </div>
    </div>
</footer>
