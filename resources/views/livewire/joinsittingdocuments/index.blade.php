<div>

  <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 mt-4 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li>
          <div class="flex items-center text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
            <a href="{{ route('app.list.sessions')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Session Documents</a>
          </div>
        </li>
        <li>
          <div class="flex items-center text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
            <a href="{{ route('app.session.type',$this->sID)}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">{{ \App\Models\Admin\Parliamentsession::findOrFail($this->sID)->name}}</a>
          </div>
        </li>
        <li aria-current="page">
          <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2 dark:text-gray-500">Joint Sitting</span>
          </div>
        </li>
      </ol>
    </nav>
    
  <div class="flex items-center justify-between mx-2 my-6">
      <h1 class="py-1 font-bold text-center md:text-xl">Joint Sitting Documents</h1>
    <div>
      @can('joint.sitting.document.upload')
        <button wire:click="showAddFolder()" class="px-2 py-1 bg-yellow-600 rounded text-gray-50 md:px-4 hover:bg-yellow-500">
          <span class="text-xs font-medium uppercase">
            <i class="mr-2 fa fa-folder-plus fa-lg"></i>
                  New Folder
          </span>
        </button>
    
        <button wire:click="$toggle('confirmItemAdd')" class="px-2 py-1 text-white rounded md:px-4 bg-sky-600 hover:bg-sky-700">
          <span class="text-xs font-medium uppercase">
            <i class="mr-2 fa fa-arrow-circle-up fa-lg"></i>
                  Upload Documents
          </span>
        </button>
      @endcan
    </div>
    
  </div>
  

      <!-- content -->
    <div x-data="{ sidebarOpen: false}">
      <div class="flex min-h-screen bg-white">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity opacity-50 lg:hidden"></div>
          <!-- sidebar -->
        @include('livewire.joinsittingdocuments.partials._sidebar')
        <!-- Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
          <div class="flex items-center space-x-4 lg:space-x-0">
            <button @click="sidebarOpen = true" class="p-4 text-gray-500 focus:outline-none lg:hidden">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
            </button>
          </div>
              <!-- documents -->
          <div class="container px-4 mx-auto">
            <div class="h-5 text-2xl text-center border-b-2 border-sky-500">
                <span class="px-5 bg-white"> <i class="mr-2 text-yellow-500 fa fa-folder-open fa-lg"></i>
                  @isset($selectedCat){{ $selectedCat->name }} @endisset
                </span>
            </div>
             
            <div class="px-4 py-4">
              <!-- documents -->
              <div class="my-2 bg-white divide-y divide-gray-200">
                 <div class="block w-full overflow-x-auto">
                  <table class="items-center w-full bg-transparent border-collapse ">
                    <thead>
                      <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase bg-gray-100 border border-l-0 border-r-0 border-gray-100 border-solid">
                          Sl#
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase bg-gray-100 border border-l-0 border-r-0 border-gray-100 border-solid">
                          Title
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-right uppercase bg-gray-100 border border-l-0 border-r-0 border-gray-100 border-solid">
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    @isset($subfolders) 
                      @foreach ($subfolders as $index =>$item)
                        <tr class="hover:bg-gray-50">
                          <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap "></td>
                          <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
                            @isset($selectedCat)
                              <a href="{{ route('app.subfolder.joint.session.documents',[$this->sID, $selectedCat->id, $item->id])}}">
                                <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>  {!! $item->name !!} 
                              </a>
                             @endisset
                          </td>
                          <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap"></td>
                        </tr>
                      @endforeach
                      
                      @foreach ($documents as $index =>$item)
                        <tr>
                          <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap ">
                          {{ $index+1 }} )
                          </td>
                          <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0">
                            {!! $item->name !!} 
                          </td>
                          
                          <td class="flex items-center justify-end gap-2 p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
                            @if ($item->extension=='wav'||$item->extension=='mp3')
                                  <button wire:click="showAudioModal()" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                                  Listen
                                  </button>
                                  @include('livewire.joinsittingdocuments.partials._viewAudio')
                              @elseif($item->extension=='mp4'||$item->extension=='m4a'||$item->extension=='mpga'||$item->extension=='avi'||$item->extension=='wma')
                                  <button wire:click="showVideoModal()" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                                    Watch
                                  </button>  
                                  @include('livewire.joinsittingdocuments.partials._viewVideo')
                              @elseif($item->extension=='jpg'||$item->extension=='jpeg'||$item->extension=='png'||$item->extension=='gif'||$item->extension=='SVG')
                                  <button wire:click="showImageModal()" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                                    View
                                  </button>  
                                  @include('livewire.joinsittingdocuments.partials._viewImage')
                              @else
                                  <div class="flex flex-row gap-2">
                                    @if ($item->extension=='pdf')
                                        <div class="relative group w-max">
                                           <button  wire:click="showDocModal({{$item->id}})" class="btn-download">
                                            <i class="fa fa-book-reader fa-lg"> </i>  
                                            </button>
                                            <span class="tool-tip">
                                              Read
                                            </span>
                                        </div>
                                    @endif 
                                        <div class="relative group w-max">
                                           <button wire:click="download({{ $item->id }})" class="text-xs btn-download">
                                              <i class="fa fa-cloud-download-alt fa-lg"></i> 
                                            </button>
                                            <span class="tool-tip">
                                              Download
                                            </span>
                                        </div>
                                      @include('livewire.joinsittingdocuments.partials._viewDoc')
                                  </div>
                              @endif
                            @can('joint.sitting.document.delete')
                                <button wire:click="showDeleteModal({{ $item->id }})" class="btn-delete">
                                  <i class="fa fa-trash-alt fa-lg"></i>
                                </button> 
                              @endcan   
                          </td>
                        </tr>
                      @endforeach
                    @endisset  
                    </tbody>
                  </table>
                </div>
                 <div class="my-4">
                    {{ $documents->links() }}
                  </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
      @include('livewire.joinsittingdocuments.partials._add')
      @include('livewire.joinsittingdocuments.partials._addFolder')
      @include('livewire.joinsittingdocuments.partials._delete')
</div>

