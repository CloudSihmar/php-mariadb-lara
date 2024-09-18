<div>
@php $view_privilage = false; @endphp
@can('conference.hall.booking')  
@php $view_privilage = true; @endphp
@endcan
@if ($view_privilage)

  @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" integrity="sha512-liDnOrsa/NzR+4VyWQ3fBzsDBzal338A1VfUpQvAcdt+eL88ePCOd3n9VQpdA0Yxi4yglmLy/AmH+Lrzmn0eMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @endpush
  <!-- content -->
  <div class="container mx-auto mt-4 md:mt-6 md:mb-20">
        <h1 class="py-2 font-bold text-center text-2xl text-cyan-600 mb-6">Conference Hall Booking</h1>
    <!-- Message -->
    <x-utilities.messages/>

    @can('conference.hall.booking.report')
     <div class="md:mx-10 mb-4 text-right mx-2">
        <a href="{{ route('app.booking.report')}}" class="font-bold text-sm px-6 py-2 bg-red-600 rounded text-white hover:bg-red-500">
          <i class="fa fa-file-pdf fa-lg"></i>
             Booking Report
        </a>
      </div>
     @endcan 
    <!-- Conference Hall Booking Form -->
      <div class="flex flex-wrap justify-between gap-2">
        <div class="w-full md:w-72">
          <!-- Conference Hall Name -->
          <div class="mt-2">
            <x-jet-label for="role" value="{{ __('Conference Hall Name') }}"/>
            <select name="hall_id" class="form-control" wire:model.defer="booking.hall_id">
                <option value=''>Select Conference Hall Name</option>
                @foreach ($conferencehalls as $booking)
                  <option value="{{ $booking->id }}">{{ $booking->name }} </option>
                @endforeach
            </select>
          </div>
        
          <!-- Purpose -->
          <div class="mt-2">
              <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="purpose" value="{{ __('Purpose of Booking') }}" />
                  <x-jet-input type="text" class="form-control" wire:model.lazy="booking.purpose" />
                  <x-jet-input-error for="booking.purpose" class="mt-2" />
              </div>
          </div>

          <!-- Start Date -->
          <div class="mt-2">
            <div class="col-span-6 sm:col-span-4" wire:ignore>
              <x-jet-label for="start_at" value="{{ __('Select start date and time') }}" />
               <x-input.date-time-picker class="form-control" wire:model.lazy="start_at"/>
            </div>
              <x-jet-input-error for="start_at" class="mt-2" />
          </div>

          <!-- End Date -->
          <div class="mt-2">
            <div class="col-span-6 sm:col-span-4" wire:ignore>
              <x-jet-label for="end_at" value="{{ __('Select end date and time') }}" />
               <x-input.date-time-picker class="form-control" wire:model.lazy="end_at"/>
            </div>
            <x-jet-input-error for="end_at" class="mt-2" />
          </div>

          <!-- Book -->
          <div class="my-4 md:mb-10 text-right">
            <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
              {{ __('Book Now') }}
            </x-jet-button>
          </div>
        </div>

        <div class="flex-1">
          <!-- Full Calendar -->
          <div class="md:mx-10 shadow-lg p-4 border border-gray-100" wire:ignore>
              <div id="calendar" class="pt-6"></div>
          </div>
        </div>
      </div>
    </div>
  </div> 
  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js" integrity="sha512-iusSCweltSRVrjOz+4nxOL9OXh2UA0m8KdjsX8/KUUiJz+TCNzalwE0WE6dYTfHDkXuGuHq3W9YIhDLN7UNB0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>

     <script>
      $(document).ready(function() {
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

        var booking = @json($events);

        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month, listWeek'
            // right: 'month, listWeek, basicWeek, basicDay'
          },

          // businessHours: {
          //   // days of week. an array of zero-based day of week integers (0=Sunday)
          //   daysOfWeek: [ 1, 2, 3, 4,5 ], // Monday - Firday
          //   startTime: '09:00', // a start time (09am)
          //   endTime: '17:00', // an end time (5pm)
          // },

          events: booking,
          // navLinks: true, 
          editable: true,
          selectable: true,
          selectHelper: true,
          //click to delete
          eventClick: function(event){
            var id = event.id;
            if (event.current_user==event.booked_by) {
              Swal.fire(
                    {
                      title: 'Delete booking ?',
                      text: "You won't be able to revert this!",
                      icon: 'question',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                      if (result.isConfirmed) {
                         $.ajax({
                                url:"{{ route('app.booking.destroy', '') }}" +'/'+ id,
                                type:"DELETE",
                                dataType:'json',
                                success:function(response){
                                      $("#calendar").fullCalendar('removeEvents', response);
                                      Swal.fire(
                                        'Deleted!',
                                        'Your conference booking has been deleted.',
                                        'success'
                                      )
                                },
                              error:function(error){
                                  console.log(error)
                              },
                          });
                      }
                    })
            //else
            }else{
              Swal.fire(
                    'You are not authorised',
                    'to delete others booking',
                    'warning'
                  )
            }
          },
        });
      });
    </script>

  @endpush

@else
  <div class="mt-4 md:mt-10 max-w-3xl mx-auto">
    <div class="flex flex-col text-center bg-red-100 rounded-lg p-4 mb-4 text-red-700 justify-center" role="alert">
        <i class="fa fa-exclamation-triangle fa-lg"></i>    
        <div class="font-bold text-xl py-4"> Unauthorised Access !!! </div> 
        <div class="py-2 text-sm"> You are not authorized to access the resources</div>
    </div>
  </div>
@endif

</div>

