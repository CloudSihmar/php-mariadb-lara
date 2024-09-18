
<div>
  <div class="flex  items-center justify-between my-6 mx-2">
      <h1 class="py-1 text-cyan-600 font-bold text-center md:text-xl">Secretariat Documents</h1>
    @can('secretariat.document.upload')
      <button wire:click="$toggle('confirmItemAdd')" class="rounded text-white px-2 md:px-4 py-1 bg-sky-600 hover:bg-sky-700">
        <span class="text-xs uppercase font-medium">
          <i class="fa fa-arrow-circle-up fa-lg mr-2"></i>
                Upload Documents
        </span>
      </button>
    @endcan
  </div>
  

      <!-- content -->
    <div x-data="{ sidebarOpen: false}">
      <div class="flex min-h-screen bg-white">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 opacity-50 transition-opacity lg:hidden"></div>
          <!-- sidebar -->
        @include('livewire.secretariatsubfolderdocuments.partials._sidebar')
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
                  @isset($selectedDiv){{ $selectedDiv->name }} @endisset 
                </span>
            </div>

            <div class="flex flex-row items-center justify-start gap-4 my-2">
              <div class="flex items-center justify-start group">
                <a href="{{ route('app.secretariat.documents')}}">
                  <i class="text-yellow-500 fa fa-level-up-alt fa-lg"></i>
                </a>
                <span class="tool-tip">Level up</span>
              </div>
              <div class="my-2 text-sm"> <i class="mr-2 text-2xl text-yellow-500 fa fa-folder-open"></i>
                @isset($subfolder) {{$subfolder->foldername}} @endisset
              </div> 
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
                              @include('livewire.secretariatsubfolderdocuments.partials._viewDoc')
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
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      @include('livewire.secretariatsubfolderdocuments.partials._add')
      @include('livewire.secretariatsubfolderdocuments.partials._delete')
</div>