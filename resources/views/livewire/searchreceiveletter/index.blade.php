<div class="container mx-auto md:px-4">
    <div class="my-4 md:my-10 h-5 border-b-2 border-sky-500 text-2xl text-center">
      <span class="bg-white"> 
        <i class="fa fa-mail-bulk text-sky-500 fa-lg"></i>
        Received Letters Report
      </span>
      <a class="text-white rounded-full  uppercase px-6 py-2 text-xs font-bold bg-blue-500 hover:bg-blue-600" 
                href="{{ route('app.receiveletter.applications') }}">
            <i class="fa fa-long-arrow-alt-left mr-2"></i> Back </a>
    </div>
    
    <div class="bg-gray-50 w-full">
      @include('livewire.searchreceiveletter._searchbar')
      @include('livewire.searchreceiveletter._details')
      @include('livewire.searchreceiveletter._attachmentfiles')
      @include('livewire.searchreceiveletter._delete')
        <div class="w-full gap-2">
            <div class="bg-gray-100 w-full shadow text-gray-600">
            @if ($receiveletters->isNotEmpty())
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-3 py-3">Sl#</th>
                    <th class="px-3 py-3">Dak Number</th>
                    <th class="px-3 py-3">Subject </th>
                    <th class="px-3 py-3">From</th>
                    <th class="px-3 py-3">To</th>
                    <th class="px-3 py-3">File Index</th>
                    <th class="px-3 py-3">Receive Date</th>
                    <th class="px-3 py-3">Details</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                @php $sl =1; @endphp
                @foreach ($receiveletters as $item)
                <tr class="text-gray-700">

                    <td class="px-3 py-3">
                        <div class="w-full flex items-center text-sm">
                           @php echo $sl++; @endphp
                        </div>
                    </td>

                    <td class="px-3 py-3">
                        <div class="w-full flex items-center text-sm">
                           @if(isset($item->dak_number)) {{ $item->dak_number }} @endif
                        </div>
                    </td>

                    <td class="px-3 py-3">
                        <div class="flex items-center text-sm">
                        @if(isset($item->to_subject)) {{ $item->to_subject }} @endif
                        </div>
                    </td>

                    <td class="px-3 py-3">
                        <div class="flex items-center text-sm">
                        @if(isset($item->from_agency)) {{ $item->from_agency }} @endif
                        </div>
                    </td>

                    <td class="px-3 py-3">
                        <div class="flex items-center text-sm">
                        @if(isset($item->division->name)) {{ $item->division->name }} @endif
                        </div>
                    </td>

                    <td class="px-3 py-3">
                        <div class="flex items-center text-sm">
                          {{ !empty($item->file_index) ? $item->file_index:''; }}
                        </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                        @if(isset($item->receive_date))
                          {{  \Carbon\Carbon::parse($item->receive_date)->format('d-M-Y') }}
                        @endif
                      </div>
                    </td>

                    <td>
                        <button wire:click="viewFiles({{ $item->id }})" class="p-2 rounded text-gray-50 text-xs focus:border-gray-200 bg-yellow-500 hover:text-gray-200">
                        <i class="fa fa-paperclip mr-1"></i>File
                      </button> 

                        <button wire:click="viewDetails({{ $item->id }})" class="p-2 rounded text-gray-50 text-xs focus:border-gray-200 bg-yellow-500 hover:text-gray-200">
                            <i class="fa fa-eye mr-1"></i>View
                        </button> 
                        @can('receive.delete')
                        <button wire:click="showDeleteModal({{ $item->id }})" class="ml-2 p-2 rounded text-gray-50 text-xs font-bold focus:border-gray-200 bg-red-500 hover:text-gray-200">
                          <i class="fa fa-trash mr-1"></i>Delete
                        </button>  
                        @endcan
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <div class="text-center pb-2">
                    <i class="fa fa-search fa-lg"></i>
                    <p class="text-lg">Sorry!!! No letter record found...</p>
                    <p class="text-sm text-gray-600">Please try another search option</p>
                </div>
            @endif
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{-- {{ $receiveletters->links()}} --}}
            </div>
        </div>
    </div>
   
</div>
