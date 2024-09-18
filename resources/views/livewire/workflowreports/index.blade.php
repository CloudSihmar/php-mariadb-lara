<div class="my-6">
  <h1 class="py-2 font-bold text-xl text-cyan-600">Work Flow Report</h1>
    <!-- main content -->
    <div class="bg-gray-50 w-full p-3">
      @include('livewire.workflowreports._searchbar')
        <div class="w-full">
            <div class="bg-gray-100 w-full shadow text-gray-600">
                @if ($workflowreports->isNotEmpty())
                <table class="w-full whitespace">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th>SL#</th>
                        <th class="px-3 py-3">Subject</th>
                        <th class="px-3 py-3">Content</th>
                        <th class="px-3 py-3">Created On</th>
                        <th class="px-3 py-3">Created By</th>
                        </tr>
                    </thead>
                <tbody class="bg-white divide-y">
            
                    @foreach ($workflowreports as $index=>$item)
                    <tr class="text-gray-700">
                        <td>{{ $index+1}}</td>
                        <td class="px-3 py-3">
                            <div class="w-full flex items-center text-sm">
                            {{ isset($item->name)? $item->name : ''}} 
                            </div>
                        </td>

                        <td class="px-3 py-3">
                            <div class="flex items-center text-sm">
                            {!! isset($item->content)? $item->content : '' !!} 
                            </div>
                        </td>

                        <td class="px-3 py-3 text-center">
                            <div class="flex items-center text-sm">
                            {{ substr($item->created_at,1,10) }} 
                            </div>
                        </td>

                        <td class="px-3 py-3 text-center">
                            <div class="flex items-center text-sm">
                            {{ $item->user->name }} 
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
                </table>
                @else
                    <div class="text-center pb-2">
                        <i class="fa fa-search fa-lg"></i>
                        <p class="text-lg">Sorry!!! No work flow record found...</p>
                        <p class="text-sm text-gray-600">Please try another search option</p>
                    </div>
                @endif
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{-- {{ $workflowreports->links()}} --}}
            </div>
        </div>
    </div>

  </div>