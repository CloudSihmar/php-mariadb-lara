    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="min-h-screen fixed z-30 inset-y-0 left-0 w-80 transition duration-300 shadow bg-white transform overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex flex-col sm:flex-row sm:justify-around">
      <div class="w-full">
        <nav class="flex flex-col pt-10 md:pt-2 ml-2 mr-4 overflow-hidden">
           @foreach ($weblinks as $item)
            <a href="{{ route('app.committee.documents', $item->id)}}" class="flex items-center space-x-1 rounded-md my-1 p-2 hover:bg-gray-100 hover:text-blue-600 text-sm">
                <i class="fa fa-arrow-alt-circle-right mr-2"></i>
              <span>{{ $item->name }}</span>  
          </a>
            @endforeach
        </nav>
      </div>
    </div>
  </div>