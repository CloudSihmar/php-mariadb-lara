
<div>
  <!-- Breadcrumb -->
  <div class="p-4 container mx-auto">
     <nav class="flex px-5 py-3 mt-4 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li>
          <div class="flex items-center text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
            <a href="{{ route('app.committee.documents')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Committe Documents</a>
          </div>
        </li>
        <li>
          <div class="flex items-center">/
             <h1 class="ml-2 text-gray-700"> @isset($selectedCommittee){{ $selectedCommittee->name }} @endisset </h1>
          </div>
        </li>
      </ol>
    </nav>

   @if ($this->IsMember==true)
    <div class="flex items-center justify-end  my-2 md:my-4">
        <div>
          @can('committee.document.upload')
            <button wire:click="$toggle('confirmItemAdd')" class="px-2 py-1 text-white rounded md:px-4 bg-sky-600 hover:bg-sky-700">
              <span class="text-xs font-medium uppercase">
                <i class="mr-2 fa fa-arrow-circle-up fa-lg"></i>
                  Upload Documents
              </span>
            </button>
          @endcan
        </div>
    </div>
    <div x-data="{ sidebarOpen: false}">
        <div class="flex min-h-screen bg-white shadow p-2 rounded">
          <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity opacity-50 lg:hidden"></div>
            <!-- sidebar -->
          @include('livewire.committeesubfolderdocuments.partials._sidebar')
          <!-- Content -->
          <div class="flex flex-col flex-1 overflow-hidden">
            <div class="flex items-center space-x-4 lg:space-x-0">
              <button @click="sidebarOpen = true" class="p-4 text-gray-500 focus:outline-none lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
              </button>
            </div>
             
            <div class="relative pb-10">
              <div class="py-2 h-5 text-2xl text-center border-b-2 border-sky-500">
                <span class="px-5 bg-white"> <i class="mr-2 text-yellow-500 fa fa-folder-open fa-lg"></i>
                  @isset($this->selectedCommittee){{ $this->selectedCommittee->name }} @endisset 
                </span>
              </div>
              <div class="flex flex-row items-center justify-start gap-4 mt-4 ml-6 ">
                <div class="flex items-center justify-start relative group ">
                  <a href="{{ route('app.committee.documents')}}">
                    <i class="text-yellow-600 fa fa-level-up-alt fa-lg"></i>
                  </a>
                  <span class="tool-tip text-xs">Up One Level</span>
                </div>
                <div class="my-2 text-gray-600"> <i class="mr-2 text-2xl text-yellow-500 fa fa-folder-open"></i>
                  @isset($selectedFolder){{ $selectedFolder->foldername }} @endisset
                </div> 
              </div>
            </div>

                <!-- documents -->
            <div class="bg-white border-b divide-y divide-gray-200">
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
                    @isset($documents)  
                    @forelse ($documents as $index =>$item)
                      <tr>
                        <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0">
                          {{ $index+1 }} )
                        </td>
                        <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 items-center">
                          <i class="fa fa-file-alt fa-lg mr-2 text-gray-700"></i> {!! $item->name !!} 
                        </td>
                      
                        <td class="flex items-center justify-end gap-2 p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
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
                            @include('livewire.committeesubfolderdocuments.partials._viewDoc')
                          </div>

                          @can('committee.document.delete')
                            <div class="text-right">
                              <button wire:click="showDeleteModal({{ $item->id }})" class="btn-delete">
                                <i class="fa fa-trash-alt fa-lg"></i>
                              </button> 
                            </div>
                            @endcan
                        </td>
                      </tr>
                      @empty
                      <tr></tr>
                    @endforelse
                  @endisset  
                </tbody>
              </table>
            </div>
          </div>
          </div>
        </div>
      </div>

    @include('livewire.committeesubfolderdocuments.partials._add')
    @include('livewire.committeesubfolderdocuments.partials._delete')
    @else
    <div class="container mx-auto mt-10 md:pb-40">
      <h1 class="py-1 font-bold text-center uppercase md:text-xl">Committee Documents</h1>
         <div class="w-10/12 mx-auto"> 
           <x-utilities.messages-lg />
         </div>
    </div>
    @endif
  </div>
</div>
