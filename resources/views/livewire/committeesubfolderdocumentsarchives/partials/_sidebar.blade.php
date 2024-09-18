  <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="min-h-screen fixed z-30 inset-y-0 left-0 w-64 transition duration-300 border-r bg-white transform overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex flex-col sm:flex-row sm:justify-around">
      <div class="w-full">
        <nav class="flex flex-col pt-10 md:pt-2 ml-2 mr-4 overflow-hidden w-60 ">
           @foreach ($this->parliaments as $item)
            <button class="flex items-center p-2 my-1 space-x-1 text-sm text-gray-400 rounded-md cursor-not-allowed bg-gray-100">
                <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>
                <span>{!! $item->name !!}</span>  
            </button>
            @endforeach
        </nav>
      </div>
    </div>
  </div>
