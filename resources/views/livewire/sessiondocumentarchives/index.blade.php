<div class="container mx-auto">
 <div class="md:mt-6 mb-2">
      <h1 class="p-2 text-xl font-bold text-center text-cyan-700 md:text-left">Archives</h1>
  </div>
  
    <!-- nav -->
  <div class="flex flex-col md:flex-row p-4 gap-4 text-sm rounded shadow bg-gray-50 md:mb-10">
    @can('session.document.archives')
      <a href="{{ route('app.session.document.archives',1)}}" class="flex items-center space-x-1 text-xs w-full btn-tab md:text-sm">
        <i class="mr-2 text-yellow-400 fa fa-folder-open fa-lg"></i>
        <span>Session Documents</span>
      </a>
   @endcan

   @can('joint.sitting.document.archives')
      <a href="{{ route('app.joint.sitting.document.archives',1)}}" class="flex items-center space-x-1 w-full text-xs btn-tab-gray md:text-sm">
        <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>
        <span>Joint Sitting Documents</span>
      </a>
    @endcan

   @can('secretariat.document.archives')
      <a href="{{ route('app.secretariat.document.archives',1)}}" class="flex items-center space-x-1 w-full text-xs btn-tab-gray md:text-sm">
       <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>
       <span>Secretariat Documents</span>
      </a>
    @endcan

    @can('committee.document.archives')
      <a href="{{ route('app.committee.document.archives',1)}}" class="flex items-center space-x-1 w-full text-xs btn-tab-gray md:text-sm">
        <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>
        <span>Committee Documents</span>
      </a>
    @endcan
  </div>

  <!-- content -->
  <div class="flex min-h-screen bg-white">
    <div class="flex flex-col flex-1 overflow-hidden">
            <!-- main content -->
        <div class="w-full md:px-4">
          <div class="h-5 mt-2 md:text-2xl text-center border-b-2 border-sky-500">
            <span class="px-5 bg-white"><i class="mr-2 text-yellow-500 fa fa-folder-open fa-lg"></i>
              Session Documents
            </span>
          </div>
          <!-- search -->
          <div class="md:py-6">
              @include('livewire.sessiondocumentarchives.partials._searchbar')
          </div>

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
                    <th class="px-6 py-3 text-xs font-semibold text-left uppercase bg-gray-100 border border-l-0 border-r-0 border-gray-100 border-solid">
                      Parliament Name
                    </th>
                    <th class="px-6 py-3 text-xs font-semibold text-left uppercase bg-gray-100 border border-l-0 border-r-0 border-gray-100 border-solid">
                      Session Name
                    </th>
                    <th class="px-6 py-3 text-xs font-semibold text-right uppercase bg-gray-100 border border-l-0 border-r-0 border-gray-100 border-solid">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($subfolders as $index =>$item)
                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 text-xs border-t border-l-0 border-r-0 whitespace-nowrap "></td>
                    <td class="px-6 py-3 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
                      <a href="{{ route('app.subfolder.session.document.archives',[$this->parliament_id, $this->session_id, $this->category_id, $item->id])}}">
                        <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>  {!! $item->name !!} 
                      </a>
                    </td>
                    <td class="px-2 py-4 text-xs border-t border-l-0 border-r-0 whitespace-nowrap"></td>
                    <td class="px-2 py-4 text-xs border-t border-l-0 border-r-0 whitespace-nowrap"></td>
                    <td class="px-2 py-4 text-xs border-t border-l-0 border-r-0 whitespace-nowrap"></td>
                  </tr>
                  @endforeach
                  
                    @forelse ($documents as $index =>$item)
                    <tr>
                    <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap ">
                      {{ $index+1 }} )
                    </td>
                    <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0">
                      {!! $item->name !!} 
                    </td>

                      <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
                      {!! \App\Models\Admin\Parliament::where('id', $item->parliament_id)->first()->name !!}
                    </td>
                    
                    <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
                      {!! \App\Models\Admin\Parliamentsession::where('id', $item->session_id)->first()->name !!}
                    </td>
                    <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
                      <div class="flex items-center justify-end gap-2">
                        @if ($item->extension=='wav'||$item->extension=='mp3')
                            <button wire:click="showAudioModal()" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                            Listen
                            </button>
                            @include('livewire.sessiondocuments.partials._viewAudio')
                        @elseif($item->extension=='mp4'||$item->extension=='m4a'||$item->extension=='mpga'||$item->extension=='avi'||$item->extension=='wma')
                            <button wire:click="showVideoModal()" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                              Watch
                            </button>  
                            @include('livewire.sessiondocuments.partials._viewVideo')
                        @elseif($item->extension=='jpg'||$item->extension=='jpeg'||$item->extension=='png'||$item->extension=='gif'||$item->extension=='SVG')
                            <button wire:click="showImageModal()" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
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
                        @can(['session.doc.delete'])
                          <button wire:click="showDeleteModal({{ $item->id }})" class="btn-delete">
                            <i class="fa fa-trash-alt fa-lg"></i>
                          </button> 
                        @endcan 
                      </div>  
                    </td>
                  </tr>
                    @empty
                    <tr>
                    {{-- <td class="col-span-4"></td>
                    <td class="col-span-4"></td>
                    <td class="col-span-4 p-4 px-6 py-10 text-xs align-middle border-t border-l-0 border-r-0 whitespace-nowrap">
                        <div class="flex items-center">
                        <i class="mr-4 fa fa-search fa-lg text-emerald-500"></i>
                        <p class="text-lg">Sorry!!! No documents found...</p>
                        </div>
                        <p class="ml-12 text-sm text-gray-600">Please try another search option</p>
                    </td> --}}
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
            @include('livewire.sessiondocumentarchives.partials._delete')
        </div>
    </div>
  </div>
</div>

