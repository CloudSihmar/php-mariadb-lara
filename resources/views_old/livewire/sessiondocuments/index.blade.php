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
            <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2 dark:text-gray-500">NA Sitting</span>
          </div>
        </li>
      </ol>
    </nav>

    <div class="flex items-center justify-between mx-2 my-4">
        <h1 class="py-1 font-bold text-center md:text-xl">NA Sitting Documents</h1>

    <div>
      @can('na.session.document.upload')
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
        @include('livewire.sessiondocuments.partials._sidebar')
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
              <div class="my-2 bg-white border-b divide-y divide-gray-200">
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
                        <td class="px-6 py-3 text-xs border-t border-l-0 border-r-0 whitespace-nowrap "></td>
                        <td class="px-6 py-3 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
                          @isset($selectedCat)
                            <a href="{{ route('app.subfolder.na.session.documents',[$this->sID, $selectedCat->id, $item->id])}}">
                              <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>  {!! $item->name !!} 
                            </a>
                          @endisset
                        </td>
                        <td class="px-2 py-2 text-xs text-right border-t border-l-0 border-r-0 whitespace-nowrap">
                          @can('na.session.document.upload') 
                            <button wire:click="showEditFolder({{ $item->id }})" class="text-xs">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#0818a3" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                              </svg>
                            </button> 

                            <button wire:click="showDeleteFolder({{ $item->id }})" class="text-xs">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#db0b20" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                              </svg>
                            </button>
                          @endcan
                        </td>
                      </tr>
                      @endforeach

                      @foreach ($documents as $index =>$item)
                        <tr>
                          <td class="px-6 py-3 text-xs border-t border-l-0 border-r-0 whitespace-nowrap ">
                          {{ $index+1 }}.
                          </td>
                          <td class="px-6 py-3 text-xs border-t border-l-0 border-r-0">
                            {!! $item->name !!} 
                          </td>
                         
                          <td class="px-6 py-3 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                              @if ($item->extension=='wav'||$item->extension=='mp3')
                                    <button wire:click="showAudioModal({{$item->id}})" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                                    Listen
                                    </button>
                                    @include('livewire.sessiondocuments.partials._viewAudio')
                                @elseif($item->extension=='mp4'||$item->extension=='m4a'||$item->extension=='mpga'||$item->extension=='avi'||$item->extension=='wma')
                                  <iframe width="200" height="120"
                                    src="{{ asset('uploads/'.$item->document) }}" sandbox="" allowfullscreen>
                                  </iframe>  

                                  <button wire:click="download({{ $item->id }})" class="text-xs font-bold uppercase btn-download">
                                    Download
                                  </button>
                                {{-- <button wire:click="showVideoModal({{$item->id}})" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                                      Watch
                                    </button>   --}}
                                    {{-- @include('livewire.sessiondocuments.partials._viewVideo') --}}
                                @elseif($item->extension=='jpg'||$item->extension=='jpeg'||$item->extension=='png'||$item->extension=='gif'||$item->extension=='SVG')
                                    <button wire:click="showImageModal({{$item->id}})" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                                     View
                                    </button>  
                                    @include('livewire.sessiondocuments.partials._viewImage')
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
                                      @include('livewire.sessiondocuments.partials._viewDoc')
                                  </div>
                              @endif
                              @can('na.session.document.delete')
                                    <button wire:click="showDeleteModal({{ $item->id }})" class="btn-delete">
                                    <i class="fa fa-trash-alt fa-lg"></i>
                                  </button> 
                              @endcan  
                            </div>   
                          </td>
                        </tr>
                      @endforeach
                     @endisset  
                    </tbody>
                  </table>
                  <div class="my-4">
                    {{ $documents->links() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      @include('livewire.sessiondocuments.partials._add')
      @include('livewire.sessiondocuments.partials._addFolder')
      @include('livewire.sessiondocuments.partials._delete')
      @include('livewire.sessiondocuments.partials._deleteFolder')
</div>

