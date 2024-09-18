<div>
   @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" integrity="sha512-liDnOrsa/NzR+4VyWQ3fBzsDBzal338A1VfUpQvAcdt+eL88ePCOd3n9VQpdA0Yxi4yglmLy/AmH+Lrzmn0eMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

  <div class="mt-6 w-11/12 mx-auto">
     <nav class="flex justify-between px-5 py-3 mt-4 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="flex items-center">
            <i class="fa fa-cog"></i>
            <a href="{{ route('admin.settings')}}" class="ml-1 font-medium text-gray-700 hover:text-gray-900 md:ml-2">Settings</a>
        </li>
        <li><i class="fa fa-angle-right"></i></li>
        <li>Conference Hall Bookings</li>
      </ol>
      {{-- <x-jet-button wire:click="$toggle('confirmItemAdd')" class="bg-blue-500 hover:bg-blue-700">
          Add New 
      </x-jet-button> --}}
    </nav>

      <!--Session message -->
      <x-utilities.messages />

      <div class="mt-6">
       <div class="bg-white overflow-hidden shadow sm:rounded-lg">
          <!-- New Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Sl#</th>
                    <th class="px-4 py-3">Conference hall Name</th>
                    <th class="px-4 py-3">Booked by</th>
                    <th class="px-4 py-3">Start Date</th>
                    <th class="px-4 py-3">End Date</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  @foreach($bookings as $index => $item)
                  <tr class="text-gray-700">
                    <td class="px-4 py-3">{{ $index+1 }}</td>
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm font-semibold">
                        {{ \App\Models\Admin\Conferencehall::find($item->hall_id)->name }}
                      </div>
                    </td>

                    <td class="px-4 py-3">
                       <div class="flex items-center text-sm">
                        {{ \App\Models\User::find($item->user_id)->name }}
                      </div>
                    </td>

                     <td class="px-4 py-3">
                       <div class="flex items-center text-sm">
                        {{ date('d-M-Y h:i:s a', strtotime($item->start_at))}}
                      </div>
                    </td>

                      <td class="px-4 py-3">
                       <div class="flex items-center text-sm">
                        {{ date('d-M-Y h:i:s a', strtotime($item->end_at))}}
                      </div>
                    </td>


                    <td class="flex justify-end gap-2 p-2">
                      <button wire:click="showEditModal({{ $item->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-sky-500 hover:text-gray-200">
                          <i class="fa fa-pen fa-lg"></i>
                      </button>    
                      
                      <button wire:click="showDeleteModal({{ $item->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-bold focus:border-gray-200 bg-red-500 hover:text-gray-200">
                          <i class="fa fa-trash fa-lg"></i>
                      </button>  
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{ $bookings->links()}}
            </div>
          </div>
        </div>
        <!-- Add/Edit Modal -->
        @include('livewire.admin.manage-conference-hall-booking.partials._add')
          <!--Delete Modal -->
        @include('livewire.admin.manage-conference-hall-booking.partials._delete')
      </div>
  </div>
  @push('scripts')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
   
  @endpush
</div>
