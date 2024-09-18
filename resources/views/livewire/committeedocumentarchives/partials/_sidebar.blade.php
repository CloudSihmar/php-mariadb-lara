  <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="min-h-screen fixed z-30 inset-y-0 left-0 w-64 transition duration-300 border-r bg-white transform overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex flex-col sm:flex-row sm:justify-around">
      <div class="w-full">
        <nav class="flex flex-col pt-10 md:pt-2 ml-2 mr-4 overflow-hidden w-60 bg-gray-50">
           @foreach ($this->parliaments as $item)
            {{-- <a href="{{ route('app.committee.document.archives', $item->id) }}" class="flex items-center space-x-1 rounded-md my-1 p-2 hover:bg-gray-100 hover:text-blue-600 text-sm">
              <i class="fa fa-folder mr-2 text-yellow-500 fa-lg"></i>
              <span>{!! $item->name !!}</span>  
            </a> --}}
            <button class="flex items-center p-2 my-1 space-x-1 text-sm rounded-md hover:bg-gray-100 hover:text-blue-600" wire:click="selectParliament({{$item->id}})" wire:loading.attr="disabled">
                <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>
                <span>{!! $item->name !!}</span>  
            </button>
            @endforeach
        </nav>
      </div>
    </div>
  </div>
