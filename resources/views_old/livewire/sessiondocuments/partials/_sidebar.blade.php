  <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 min-h-screen overflow-y-auto transition duration-300 transform bg-white border-r lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex flex-col sm:flex-row sm:justify-around">
      <div class="w-full">
        <nav class="flex flex-col pt-10 ml-2 mr-4 overflow-hidden md:pt-2">
           @foreach ($categories as $item)
            <a href="{{ route('app.na.session.documents', [$this->sID, $item->id])}}" class="flex items-center p-2 my-1 space-x-1 text-sm rounded-md hover:bg-gray-100 hover:text-blue-600">
                <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>
                <span>{{ $item->name }}</span>  
            </a>
            @endforeach
        </nav>
      </div>
    </div>
  </div>