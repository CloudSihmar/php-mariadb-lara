  <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="z-50 fixed inset-y-0 left-0 w-72 min-h-screen overflow-y-auto transition duration-300 transform bg-white border-r lg:translate-x-0 lg:static lg:inset-0">
    <nav class="pt-10 ml-2 mr-4 overflow-hidden md:pt-2">
        @foreach ($committees as $item)
        <div class="flex items-center p-2 my-1 space-x-1 text-sm rounded-md hover:bg-gray-100 hover:text-blue-600 cursor-pointer" wire:click="searchDocs({{$item->id}})" wire:loading.attr="disabled">
            <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>
            <span>{{ $item->name }}</span>  
        </div>
        @endforeach
    </nav>
  </div>