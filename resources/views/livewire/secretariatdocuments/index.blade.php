
<div>
  <div class="flex items-center justify-between my-6 mx-2">
      <h1 class="py-1 text-cyan-600 font-bold text-center md:text-xl">Secretariat Documents</h1>
    @can('secretariat.document.upload')
      <div class="gap-2">
        <button wire:click="showAddFolder()" class="px-2 py-1 bg-yellow-600 rounded text-gray-50 md:px-4 hover:bg-yellow-500">
          <span class="text-xs font-medium uppercase">
            <i class="mr-2 fa fa-folder-plus fa-lg"></i>
                  New Folder
          </span>
        </button>

      <button wire:click="$toggle('confirmItemAdd')" class="rounded text-white px-2 md:px-4 py-1 bg-sky-600 hover:bg-sky-700">
        <span class="text-xs uppercase font-medium">
          <i class="fa fa-arrow-circle-up fa-lg mr-2"></i>
                Upload Documents
        </span>
      </button>
        </div>
    @endcan
  </div>
  

      <!-- content -->
    <div x-data="{ sidebarOpen: false}">
      <div class="flex min-h-screen bg-white">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 opacity-50 transition-opacity lg:hidden"></div>
          <!-- sidebar -->
        @include('livewire.secretariatdocuments.partials._sidebar')
        <!-- Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
          <div class="flex items-center space-x-4 lg:space-x-0">
            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden p-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
            </button>
          </div>
              <!-- documents -->
          <div class="container mx-auto px-4">
            <div class="h-5 border-b-2 border-sky-500 text-2xl text-center">
                <span class="bg-white px-5"> <i class="fa fa-folder-open mr-2 text-yellow-500 fa-lg"></i>
                  @isset($division){{ $division->name }} @endisset 
                </span>
            </div>
            <div class="md:mt-12 pl-4">
              <!-- documents -->
            <div class="bg-white divide-y divide-gray-200 border-b my-2">
                <div class="block w-full overflow-x-auto">
                <table class="items-center bg-transparent w-full border-collapse ">
                  <thead>
                    <tr>
                      <th class="px-6 border bg-gray-100 border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-left">
                        Sl#
                      </th>
                      <th class="px-6 border bg-gray-100 border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-left">
                        Title
                      </th>
                      <th class="px-6 border bg-gray-100 border-solid border-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-right">
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
                          @isset($selectedDiv)
                            <a href="{{ route('app.secretariat.subfolder.documents',[$this->parID, $selectedDiv->id, $item->id])}}">
                              <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>  {!! $item->foldername !!} 
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

                      @forelse ($documents as $index =>$item)
                      <tr>
                        <td class="border-t px-6 border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                          {{ $index+1 }} )
                        </td>
                        <td class="border-t px-6 border-l-0 border-r-0 text-xs p-4">
                          {!! $item->name !!} 
                        </td>
                      
                        <td class="flex items-center gap-2 border-t px-4 justify-end border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
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
                              @include('livewire.secretariatdocuments.partials._viewDoc')
                            </div>


                        @can('secretariat.document.delete')
                          <div class="text-right">
                            <button wire:click="showDeleteModal({{ $item->id }})" class="btn-delete">
                              <i class="fa fa-trash-alt fa-lg"></i>
                            </button> 
                          </div>
                          @endcan  
                        </td>
                      </tr>
                      @empty
                      <tr>
                      <td class="col-span-4"></td>
                      <td class="col-span-4"></td>
                      <td class="col-span-4 py-10 border-t px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                          <div class="flex items-center">
                          <i class="fa fa-search fa-lg text-emerald-500 mr-4"></i>
                          <p class="text-lg">Sorry!!! No documents found...</p>
                          </div>
                          <p class="text-sm text-gray-600 ml-12">Please try another search option</p>
                      </td>
                      </tr>
                      @endforelse
                    @endisset  
                  </tbody>
                </table>
              </div>
            </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
      @include('livewire.secretariatdocuments.partials._add')
      @include('livewire.secretariatdocuments.partials._addFolder')
      @include('livewire.secretariatdocuments.partials._deleteFolder')
      @include('livewire.secretariatdocuments.partials._delete')
</div>