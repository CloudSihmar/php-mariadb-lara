<div>
  <div class="w-full p-2 md:mx-2">
    <div class="flex justify-between my-4">
      <h1 class="w-full uppercase font-bold text-xl text-cyan-600">Leave History</h1>
      <div class="w-full">
        @include('livewire.leavebalances.partials._searchbar')
      </div>
    </div>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mx-auto mt-1">
       <div class="bg-white overflow-hidden shadow sm:rounded-lg">
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-2 py-2 text-left">Sl#</th>
                    <th class="px-2 py-2 text-left">Name</th>
                    <th class="px-2 py-2 text-left">Casual Leave Balance</th>
                    <th class="px-2 py-2 text-left">Annual Leave Balance</th>
                    <th class="px-2 py-2 text-left">HR Comment</th>
                    <th class="px-2 py-2 text-left">Action</th>
                  </tr>
                </thead>
               
                <tbody class="bg-white divide-y">
                  @foreach($userleavebalances as $index=>$u)
  @if($u->name != "Admin")		  
<tr class="text-gray-600">
                    
                    <td class="px-2 py-2  text-center">
                        <div class="flex items-center text-sm">
                          {{ $index }}
                        </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                        <div class="flex items-center text-sm">
                          {{ $u->name }}
                        </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                        @if(!empty($u->balanceleave->casual_leave))
                          {{ $u->balanceleave->casual_leave}}
                        @endif
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                        @if(isset($u->balanceleave->earn_leave))
                          {{ $u->balanceleave->earn_leave}}
                        @endif
                      </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                        @if(!empty($u->balanceleave->remarks))
                          {{ $u->balanceleave->remarks}}
                        @endif
                      </div>
                    </td>

                     <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                        <button wire:click="showEditModal({{ $u->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-green-500 hover:text-gray-200">
                          <i class="fa fa-pen fa-lg"></i>
                        </button> 
                      </div>
                    </td>

		  </tr>
 @endif
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{-- {{ $leavebalanceapps->links()}} --}}
            </div>
          </div>
        </div>
      </div>
        @include('livewire.leavebalances.partials._edit')
      </div>
  </div>

</div>
