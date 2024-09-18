<div>
  <div class="w-full p-2 mt-4 md:mt-10 md:mx-2">
         <h1 class="py-2 text-xl font-bold text-cyan-600">Work Flow</h1>
    <div class="justify-between w-full ">
    @include('livewire.workflows.partials._searchbar')
    </div>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mx-auto mt-2">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
          <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
              <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                  <th class="px-4 py-2">SL#</th>
                  <th class="px-4 py-2">Subject</th>
                  <th class="px-4 py-2">Author</th>
                  <th class="px-4 py-2 text-right">Created Date</th>
                  <th class="px-4 py-2 text-right">Action</th>
                  <th>Notification</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y">
                @foreach ($workflows as $index=>$result)
                <tr class="text-gray-600">
                  <td class="px-4 py-2">{{ $index+1 }}</td>
                  <td class="px-4 py-2 text-sm"> {{ $result->name}}</td>
                  <td class="px-4 py-2 text-sm">
                      @php
                        $username = App\Http\Livewire\Utilities::userName($result->author);
                      @endphp
                      {{ $username }}
                  </td>
                
                  <td class="px-4 py-2 text-sm text-right">
                    {{ $result->created_date }}
                  </td>

                  <td class="flex flex-wrap justify-end gap-2 px-4 py-2">
                      <a href="{{ route('app.workflow.edit',encryptInteger($result->id)) }}" class="flex items-center px-4 py-1 my-1 text-sm bg-gray-500 rounded up text-gray-50 focus:border-gray-200 hover:text-gray-200">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                        Edit
                      </a>

                    <button wire:click="forwardModal({{ $result->id }})" class="flex items-center px-4 py-1 my-1 text-sm rounded text-gray-50 focus:border-gray-200 bg-sky-600 hover:text-gray-200">
                       Forward 
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                      </svg>
                    </button> 

                     <button wire:click="writeComment({{ $result->id }})" class="flex items-center px-4 py-1 my-1 text-sm bg-green-600 rounded text-gray-50 focus:border-gray-200 hover:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                        Comment
                    </button> 

                      <button wire:click="showActivity({{ $result->id }})" class="flex items-center px-4 py-1 my-1 text-sm bg-orange-600 rounded text-gray-50 focus:border-gray-200 hover:text-gray-200">
                        <i class="mr-1 fa fa-history fa-lg"></i>Activity
                      </button> 
                      <a href="{{ route('app.workflow.view',encryptInteger($result->id)) }}" class="flex items-center px-4 my-1  text-sm rounded text-gray-50 focus:border-gray-200 bg-cyan-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="ml-2">View</span>
                      </a>
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
          <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide uppercase border-t bg-gray-50 min-h-min">
            {{-- {{ $workflows->links()}}  --}}
          </div>
        </div>
      </div>
        @include('livewire.workflows.partials._edit')
        @include('livewire.workflows.partials._forward')
        @include('livewire.workflows.partials._activity')
        @include('livewire.workflows.partials._comment')
        @include('livewire.workflows.partials._delete')
  </div>

</div>