    <div>
      <div class="mt-4 md:mt-10 mb-4 text-right">
        <a href="{{ route('app.conference.hall.booking')}}" class="font-medium px-4 py-2 text-sm rounded-full bg-cyan-600 hover:bg-cyan-500 text-white">
          <i class="fa fa-long-arrow-alt-left"></i>
          Conference Hall Booking
        </a>
      </div>
  
        @include('livewire.booking-reports._searchbar')
        <div class="w-full">
            <div class="bg-gray-100 w-full text-gray-600">
                @if ($this->bookings->isNotEmpty())
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-3 py-3">Sl.#</th>
                        <th class="px-3 py-3">Hall Name</th>
                        <th class="px-3 py-3">Booked By</th>
                        <th class="px-3 py-3">Division</th>
                        <th class="px-3 py-3">From </th>
                        <th class="px-3 py-3">To</th>
                        <th class="px-3 py-3">Purpose</th>
                        </tr>
                    </thead>
                  <tbody class="bg-white divide-y">
                    @isset($bookings)
                    @foreach ($bookings as $index => $item)
                      <tr class="text-gray-700">
                          <td class="px-3 py-3">
                            {{ $index+1 }}
                          </td>

                         <td class="px-3 py-3">
                              {{ \App\Models\Admin\Conferencehall::find($item->hall_id)->name }} 
                          </td>

                          @php $user = \App\Models\User::find($item->user_id); @endphp
                          <td class="px-3 py-3">
                              {{  $user->name }} 
                          </td>

                            <td class="px-3 py-3">
                              {{ \App\Models\Admin\Division::find($user->division_id)->name }} 
                          </td>

                          <td class="px-3 py-3">
                             {{ date('d-M-Y h:i:s a', strtotime($item->start_at))}}
                          </td>

                           <td class="px-3 py-3">
                            {{ date('d-M-Y h:i:s a', strtotime($item->end_at))}}
                          </td>

                           <td class="px-3 py-3">
                            {{ $item->purpose }}
                          </td>
                        </tr>
                      @endforeach
                    @endisset
                  </tbody>
                </table>
                @else
                  <div class="text-center pb-2">
                    <i class="fa fa-search fa-lg"></i>
                    <p class="text-lg">Sorry!!! No booking record found...</p>
                    <p class="text-sm text-gray-600">Please try another search option</p>
                  </div>
                @endif
            </div>
            <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 min-h-min">
              {{-- {{ $this->bookings->links()}} --}}
            </div>
        </div>
    </div>