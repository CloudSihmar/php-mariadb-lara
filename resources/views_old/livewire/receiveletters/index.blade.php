<div class="container md:px-4 mx-auto">
    <div class="mt-10 h-5 border-b-2 border-sky-500 text-2xl text-center">
      <span class="bg-white text-cyan-600 font-medium"> 
        <i class="fa fa-mail-bulk fa-lg"></i>
            Letters
      </span>
    </div>
      <div class="flex justify-end gap-4 py-4 items-center">
          <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-sky-600 hover:bg-sky-700">
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
           Receive New Letter 
          </x-jet-button>
        </div>

    <!--Session message -->
    <x-utilities.messages />

    <!-- page -->
    <div class="w-full text-gray-700">
       <div class="flex flex-col">
          <div class="flex flex-row gap-2 mb-4">
          <a href="{{ route('app.receiveletter.applications')}}" class="flex items-center space-x-1 rounded-md p-2 text-white bg-gray-600 hover:bg-gray-500">
              <i class="fa fa-envelope-open-text fa-lg mr-1"></i>
              <span class="text-sm font-medium">Letters Received</span>
            </a>

            <a href="{{ route('app.displatchletter.applications')}}" class="flex items-center space-x-1 rounded-md p-2 text-gray-600 bg-gray-300 hover:bg-gray-600 hover:text-white">
              <i class="fa fa-envelope fa-lg mr-1"></i>
              <span class="text-sm font-medium">Letters Dispatched</span>
            </a>
            @can('received.report')
            <a class="inline-flex items-center px-4 py-2 bg-green-600 rounded-md font-medium text-sm text-white tracking-widest hover:bg-green-700" href="{{ route('app.searchreceiveletter.applications')}}">
              <i class="fa fa-book-open mr-2"></i> Receive Report
            </a>
          @endcan
        </div>
          <div class="flex items-center my-4 text-cyan-700">
            <i class="mr-1 fa fa-envelope fa-lg"></i>
            <span class="font-medium">Letters Received</span>
          </div>
       </div>

      <div class="flex">
          <div class="w-full mb-8 overflow-hidden rounded-lg bg-gray-100">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 border-b">
                      <th class="p-4">SL#</th>
                      <th class="p-4">Dak#</th>
                      <th class="p-4">From</th>
                      <th class="p-4">To</th>
                      <th class="p-4">Addressed To</th>
                      <th class="p-4">Subject</th>
                      <th class="p-4">Receive Date</th>
                      {{-- <th class="p-4">File Index</th> --}}
                      <th class="p-4"></th>
                      <th>Notification</th>
                    </tr>
                  </thead>
                  <tbody class="bg-gray-50 divide-y">
                    @foreach ($receiveletters as $index=>$result)
                    <tr class="text-gray-600">
                      <td class="px-4 py-1text-center">
                        <div class="flex items-center text-sm">
                        {{$index+1}}
                        </div>
                      </td>

                      <td class="px-1 py-1text-center">
                        <div class="flex items-center text-sm">
                          {{ $result->dak_number}}
                        </div>
                      </td>

                      <td class="px-1 py-1 text-center">
                        <div class="flex items-center text-sm">
                        {{ $result->from_agency }}
                        </div>
                      </td>
                      
                      <td class="px-1 py-1 text-center">
                        <div class="flex items-center text-sm">
                        @php
                          $division = App\Http\Livewire\Utilities::divisionName($result->to_division_id);
                        @endphp
                          {{ $division}}
                        </div>
                      </td>
                      
                      <td class="px-1 py-1 text-center">
                        <div class="flex items-center text-sm">
                        {{ $result->to_adressed}}
                        </div>
                      </td>
                      
                      <td class="px-1 py-1 text-center">
                        <div class="flex items-center text-sm">
                        {{ $result->to_subject}}
                        </div>
                      </td>
                      
                      <td class="px-1 py-1 text-center">
                        <div class="flex items-center text-sm">
                        {{ $result->receive_date}}
                        </div>
                      </td>
                      
                      {{-- <td class="px-1 py-1 text-center">
                        <div class="flex items-center text-sm">
                          @php $fileindex = \App\Models\Admin\Fileindex::where('id', $result->file_index)->get()->first() @endphp  
                          {{ !empty($fileindex->name) ? $fileindex->name:''; }}
                        </div>
                      </td> --}}

                      <td class="flex flex-grow gap-2 p-2 text-right">
                      @if($result->author == Auth::user()->id)
                      <button wire:click="showEditModal({{ $result->id }})" class="relative group text-center w-10 h-10 p-2 mb-1 text-xs bg-green-600 rounded text-gray-50 focus:border-gray-200 hover:text-gray-200">
                        <i class="mr-1 fa fa-edit fa-xl"></i>
                        <span class="tool-tip">Edit</span>
                      </button> 
                      @endif
                      <button wire:click="viewFiles({{ $result->id }})" class="relative group text-center w-10 h-10 p-2 text-xs bg-yellow-600 rounded text-gray-50 focus:border-gray-200 hover:text-gray-200">
                        <i class="mr-1 fa fa-paperclip fa-xl"></i>
                        <span class="tool-tip">Attachment</span>
                      </button> 

                      <button wire:click="forwardModal({{ $result->id }})" class="relative group text-center w-10 h-10 p-2 text-xs rounded text-gray-50 focus:border-gray-200 bg-sky-600 hover:text-gray-200">
                           <i class="fa fa-share-square fa-xl"></i>
                           <span class="tool-tip">Forward</span>
                      </button> 

                      <button wire:click="writeComment({{ $result->id }})" class="relative group text-center w-10 h-10 p-2 text-xs bg-blue-600 rounded text-gray-50 focus:border-gray-200 hover:text-gray-200">
                          <i class="mr-1 fa fa-comment fa-xl"></i>
                          <span class="tool-tip">Comment</span>
                      </button> 

                      @php 
                      $notificationCount = \App\Models\Notification::where('fid', $result->id)->where('route','receiveletter')->count();
                      @endphp  
                      <button wire:click="showActivity({{ $result->id }})" class="relative group text-center w-10 h-10 p-2 mb-1 text-xs bg-orange-600 rounded text-gray-50 focus:border-gray-200 hover:text-gray-200">
                          <i class="mr-1 fa fa-history fa-xl"></i>
                          <span class="tool-tip">Activity</span>
                      </button> 
                    </td>

                    <td class="px-2 py-2  text-center">
                      @php
                        $seenStatus = App\Http\Livewire\Utilities::getNotificationStatus($result->id);
                      @endphp
                      <div class="flex items-center text-sm">
                      @if($seenStatus == 0)
                        <span class="p-2 rounded text-xs text-green-50 bg-blue-600">Not Seen</span>
                      @elseif($seenStatus == 1)
                        <span class="p-2 rounded text-xs text-green-50 bg-orange-600"> <i class="fa fa-eye"></i>Seen</span>
                      @else
                        <span class="p-2 rounded"></span>
                      @endif
                      </div>           
                    </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>

            <div class="flex justify-between float-right py-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t">
               {{ $receiveletters->links()}} 
            </div>
          </div>
      </div>    
        @include('livewire.receiveletters.partials._add')
        @include('livewire.receiveletters.partials._forward')
        @include('livewire.receiveletters.partials._activity')
        @include('livewire.receiveletters.partials._comment')
        @include('livewire.receiveletters.partials._attachmentfiles')
        @include('livewire.receiveletters.partials._delete')
    </div>
</div>