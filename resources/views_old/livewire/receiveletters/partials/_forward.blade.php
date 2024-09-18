<div>
<x-jet-dialog-modal wire:model="forward">
<form wire:submit.prevent="submit" enctype="multipart/form-data">
    <x-slot name="title">
        <span class="font-bold uppercase"> Forward Letter </span>
    </x-slot>

    <x-slot name="content">

    <!-- <div class="my-4">
        <div class="col-span-6 sm:col-span-4" wire:ignore>
            <x-jet-label for="from_department_id" value="{{ __('Agency') }}" />
                <select id="department" class="form-control" wire:model.lazy="from_department_id">
                      <option value='' selected>Select Agency</option>
                        @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }} </option>
                        @endforeach
                  </select>
        </div> 
    </div> -->

    <div class="my-4">
        <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="from_division_id" value="{{ __('Division') }}" />
            <select id="from_division_id" class="form-control" wire:model.lazy="from_division_id">
                <option value='' selected>Select Division</option>
                @foreach ($divisions as $d)
                @if(!in_array($d->id,[5,6]))
                    <option value="{{ $d->id }}">{{ $d->name }} </option>
                @endif
                @endforeach
               
            </select>
        </div>               
    </div>

    <div class="my-4">
        <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="user" value="{{ __('Staff') }}" />
            <!-- <select id="user" class="form-control" name="user" wire:model="user"></select> -->
            <select id="user" class="form-control" wire:model="user">
                <option value='' selected>Select User</option>
                @foreach ($usersLists as $u)
                @if($u->id != Auth::user()->id)
                <option value="{{ $u->id }}">{{ $u->name }} </option>
                @endif
                @endforeach
            </select>
            <x-jet-input-error for="user" class="mt-2" />
        </div>               
    </div>

    <div class="mt-4">
        <div class="col-span-6 sm:col-span-4" wire:ignore>
            <x-jet-label for="remarks" value="{{ __('Remarks ') }}" />
            <x-jet-input type="text" class="mt-1 block w-full" wire:model="remarks" />
            <x-jet-input-error for="remarks" class="mt-2" />
        </div>
    </div>
  
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="forwardTo" wire:loading.attr="disabled">
            {{ __('Forward') }}
        </x-jet-button>
    </x-slot>
</form>
</x-jet-dialog-modal>


  @push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#from_agency_id').on('change', function () {
                var idAgency = this.value;
                $.ajax({
                    url: "{{url('/parliament/fetch-department')}}",
                    type: "post",
                    data: {
                        agency_id:idAgency,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $("#from_department_id").html('');
                        $('#from_department_id').html('<option value="">-- Select Department --</option>');
                        $.each(result.departments, function (key, value) {
                            $("#from_department_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

            $('#department').on('change', function () {
                var idDept = this.value;
                $.ajax({
                    url: "{{url('/parliament/fetch-division')}}",
                    type: "post",
                    data: {
                        department_id: idDept,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $("#from_division_id").html('');
                        $('#from_division_id').html('<option value=" " selected>-- Select Division --</option>');
                        $.each(res.divisions, function (key, value) {
                            $("#from_division_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

             $('#from_division_id').on('change', function () {
                var idDept = this.value;
                $.ajax({
                    url: "{{url('/parliament/fetch-staff')}}",
                    type: "post",
                    data: {
                        division_id: idDept,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $("#user").html('');
                        $('#user').html('<option value="" selected>-- Select Staff --</option>');
                        $.each(res.staff, function (key, value) {
                            $("#user").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

            //Dispatch Number
            // $('#issue_date').change(function(){
            // $.ajax({
            //     type: "GET",
            //     url:  "{{url('/parliament/fetch-dispatchnumber') }}",
            //     success:function(res){
            //         $('#dispatch_number').val(res);
            //     } //success
            //     });
            // });

        });
    </script>
@endpush
    </div>