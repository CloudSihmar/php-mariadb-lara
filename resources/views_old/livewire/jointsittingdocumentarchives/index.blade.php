<div class="container mx-auto">
  <div class="flex justify-between mt-6 mb-2">
      <h1 class="p-2 text-xl font-bold text-center text-cyan-700">Archives</h1>
  </div>
  
    <!-- nav -->
  <div class="flex flex-col md:flex-row p-4 gap-4 text-sm rounded shadow bg-gray-50 md:mb-10">

    @can('session.document.archives')
      <a href="{{ route('app.session.document.archives',1)}}" class="flex items-center space-x-1 text-xs w-full btn-tab-gray md:text-sm">
        <i class="mr-2 text-yellow-400 fa fa-folder-open fa-lg"></i>
        <span>Session Documents</span>
      </a>
   @endcan

   @can('joint.sitting.document.archives')
      <a href="{{ route('app.joint.sitting.document.archives',1)}}" class="flex items-center space-x-1 text-xs w-full btn-tab md:text-sm">
        <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>
        <span>Joint Sitting Documents</span>
      </a>
    @endcan

    @can('secretariat.document.archives')
      <a href="{{ route('app.secretariat.document.archives',1)}}" class="flex items-center space-x-1 text-xs w-full btn-tab-gray md:text-sm">
        <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>
        <span>Secretariat Documents</span>
      </a>
    @endcan

    @can('committee.document.archives')
      <a href="{{ route('app.committee.document.archives',1)}}" class="flex items-center space-x-1 text-xs w-full btn-tab-gray md:text-sm">
        <i class="mr-2 text-yellow-500 fa fa-folder fa-lg"></i>
        <span>Committee Documents</span>
      </a>
    @endcan
  </div>

  <!-- content -->
  <div class="flex min-h-screen bg-white">
    <div class="flex flex-col flex-1 overflow-hidden">
      <!-- main content -->
      <div class="container mx-auto">
        <div class="w-full md:px-4">
          <div class="h-5 mt-2 md:text-2xl text-center border-b-2 border-sky-500">
            <span class="px-5 bg-white"><i class="mr-2 text-yellow-500 fa fa-folder-open fa-lg"></i>
              Joint Sitting Documents
            </span>
        </div>
          <!-- search -->
          <div class="md:py-6">
              @include('livewire.jointsittingdocumentarchives.partials._searchbar')
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
                      Session Name
                    </th>
                    <th class="px-6 py-3 text-xs font-semibold text-right uppercase bg-gray-100 border border-l-0 border-r-0 border-gray-100 border-solid">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $index =>$item)
                  <tr>
                    <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap ">
                      {{ $index+1 }} )
                    </td>
                    <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0">
                      {!! $item->name !!} 
                    </td>
                    <td class="p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
                      {!! \App\Models\Admin\Parliamentsession::where('id', $item->session_id)->first()->name !!}
                    </td>
                    <td class="flex items-center justify-end gap-2 p-4 px-6 text-xs border-t border-l-0 border-r-0 whitespace-nowrap">
                      @if ($item->extension=='wav'||$item->extension=='mp3')
                            <button wire:click="showAudioModal()" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                            Listen
                            </button>
                            @include('livewire.jointsittingdocumentarchives.partials._viewAudio')
                        @elseif($item->extension=='mp4'||$item->extension=='m4a'||$item->extension=='mpga'||$item->extension=='avi'||$item->extension=='wma')
                            <button wire:click="showVideoModal()" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                              Watch
                            </button>  
                            @include('livewire.jointsittingdocumentarchives.partials._viewVideo')
                        @elseif($item->extension=='jpg'||$item->extension=='jpeg'||$item->extension=='png'||$item->extension=='gif'||$item->extension=='SVG')
                            <button wire:click="showImageModal()" class="px-6 py-2 text-xs font-bold border rounded-full border-cyan-500">
                              View
                            </button>  
                            @include('livewire.jointsittingdocumentarchives.partials._viewImage')
                        @else
                          <div class="flex flex-row gap-2">
                            @if ($item->extension=='pdf')
                              <div class="relative group w-max">
                                <button  wire:click="showDocModal({{$item->id}})" class="btn-download">
                                <i class="fa fa-book-reader fa-lg"> </i>  
                                </button>
                                <span class="tool-tip">Read</span>
                              </div>
                            @endif 
                              <div class="relative group w-max">
                                <button wire:click="download({{ $item->id }})" class="text-xs btn-download">
                                    <i class="fa fa-cloud-download-alt fa-lg"></i> 
                                </button>
                                <span class="tool-tip">Download</span>
                              </div>
                              @include('livewire.jointsittingdocumentarchives.partials._viewDoc')
                          </div>
                        @endif
                        @can(['joint.sitting.doc.delete'])
                          <button wire:click="showDeleteModal({{ $item->id }})" class="btn-delete">
                            <i class="fa fa-trash-alt fa-lg"></i>
                          </button> 
                        @endcan   
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td class="col-span-4"></td>
                    <td class="col-span-4"></td>
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

