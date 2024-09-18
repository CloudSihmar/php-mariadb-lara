<div>
  <div class="mt-6 w-11/12 mx-auto">
     <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 mt-4 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li>
          <div class="flex items-center text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
            <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Acts of Bhutan</a>
          </div>
        </li>
      </ol>
    </nav>

    <div class="flex items-center justify-end my-6 mx-2">
        @can('act.upload')
          <div class="gap-2">
            <button wire:click="$toggle('confirmItemAdd')" class="px-2 py-1 text-white rounded md:px-4 bg-sky-600 hover:bg-sky-700">
              <span class="text-xs font-medium uppercase">
                <i class="mr-2 fa fa-arrow-circle-up fa-lg"></i>
                      Upload Documents
              </span>
            </button>
          </div>
        @endcan
      </div>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mt-6">
        <!-- content -->
      <div class="flex min-h-screen bg-white">
        <div class="fixed z-20 inset-0 opacity-50 transition-opacity lg:hidden"></div>
        <div class="flex-1 flex flex-col overflow-hidden">
          <div class="container mx-auto px-4">
            <div class="h-5 border-b-2 border-sky-500 text-2xl text-center">
                <span class="bg-white px-5"> <i class="fa fa-folder-open mr-2 text-yellow-500 fa-lg"></i>
                  Acts
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
                    @isset($documents)   
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
                                  <button  wire:click="showDocModal({{$item->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                  </button>
                                  <span class="tool-tip">
                                    Read
                                  </span>
                                </div>
                              @endif 
                                <div class="relative group w-max">
                                  <button wire:click="download({{ $item->id }})" class="text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                  </button>
                                  <span class="tool-tip">
                                    Download
                                  </span>
                                </div>
                              @include('livewire.acts.partials._viewDoc')
                            </div>

                             @can('act.upload')
                              <div class="text-right">
                                <button wire:click="showEditModal({{ $item->id }})">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#0818a3" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                              </svg>
                                </button> 
                              </div>
                            @endcan 

                            @can('act.delete')
                              <div class="text-right">
                                <button wire:click="showDeleteModal({{ $item->id }})">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#db0b20" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                  </svg>
                                </button> 
                              </div>
                            @endcan  
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td class="py-10 border-t px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"></td>
                        <td class="py-10 border-t px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"></td>
                        <td class="py-10 border-t px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            <div class="flex items-center">
                            <i class="fa fa-search fa-lg text-emerald-500 mr-4"></i>
                            <p class="text-lg">Sorry!!! No documents found...</p>
                            </div>
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
       
        <!-- Add/Edit Modal -->
        @include('livewire.acts.partials._add')
          <!--Delete Modal -->
        @include('livewire.acts.partials._delete')
      </div>
  </div>
</div>
