<div>
    <div class="p-2 md:mx-2">
      <div class="flex justify-between my-6">
        <h1 class="py-2 uppercase font-bold text-xl text-cyan-600">Holidays</h1>
        <div class="flex gap-4">
        <a href="{{ route('app.leave.applications') }}" class="uppercase text-xs font-bold px-4 py-4 bg-gray-600 hover:bg-gray-500 text-white rounded">
          <i class="fa fa-long-arrow-alt-left"></i> Back
        </a>
          <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-600 hover:bg-blue-700">
            Add Holiday
          </x-jet-button>
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
                    <th class="px-2 py-2 text-left">SL#</th>
                    <th class="px-2 py-2 text-left">Holiday Date</th>
                    <th class="px-2 py-2 text-left">Short Description</th>
                    {{-- @can('is-member') --}}
                    <th class="px-2 py-2 text-left">Action</th>
                    {{-- @endcan --}}
                  </tr>
                </thead>
              
                <tbody class="bg-white divide-y">
                  @foreach ($holidays as $index=>$u)
                  <tr class="text-gray-600">
                    <td>{{ $index+1}}
                    <td class="px-2 py-2  text-center">
                        <div class="flex items-center text-sm">
                          @php 
                          echo date_format(date_create($u->holiday_date),"d M Y");
                          @endphp
                        </div>
                    </td>

                    <td class="px-2 py-2  text-center">
                      <div class="flex items-center text-sm">
                        @if(!empty($u->shortCode))
                          {{ $u->shortCode}}
                        @endif
                      </div>
                    </td>

                    <td class="m-2 p-2 text-center">
                      <div class="flex items-center text-sm">
                        <button wire:click="showEditModal({{ $u->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-green-500 hover:text-gray-200">
                          <i class="fa fa-pen fa-lg"></i>
                        </button> 

                        <button wire:click="showDeleteModal({{ $u->id }})" class="ml-2 p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-red-500 hover:text-gray-200">
                          <i class="fa fa-trash fa-lg"></i>
                        </button>  
                        </div>
                    </td>


                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{ $holidays->links()}}
            </div>
          </div>
        </div>
      </div>
        @include('livewire.holidays.partials._add')
        @include('livewire.holidays.partials._edit')
        @include('livewire.holidays.partials._delete')
    </div>
</div>
