    <div class="flex flex-col sm:flex-row sm:justify-around">
      <div class="w-full">
        <nav class="flex flex-col pt-10 md:pt-2 ml-2 mr-4 overflow-hidden">
           @foreach ($categories as $item)
            <a href="{{ route('app.session.document.archives', $item->id)}}" class="flex items-center space-x-1 rounded-md my-1 p-2 hover:bg-gray-100 hover:text-blue-600 text-sm">
              <i class="fa fa-folder mr-2 text-yellow-500 fa-lg"></i>
              <span>{{ $item->name }}</span>  
          </a>
            @endforeach
        </nav>
      </div>
    </div>