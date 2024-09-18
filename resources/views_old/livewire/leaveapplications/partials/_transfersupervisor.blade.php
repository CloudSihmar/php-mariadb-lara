<x-jet-dialog-modal wire:model="supervisorModel">
<form wire:submit.prevent="submit" enctype="multipart/form-data">
    <x-slot name="title">
        <span class="font-bold uppercase"> Assign an Officiating Role  </span>
    </x-slot>

    <!-- Office -->
    <x-slot name="content">
        <div class="my-4">
            <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="division_id_" value="{{ __('Office') }}"  />
            <select id="division_id_" class="form-control">
                <option value='' selected>Select Division</option>
                    @foreach ($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->name }} </option>
                    @endforeach
            </select>
            </div>
        </div>

        <!-- Staff -->
        <div class="my-4">
            <div class="col-span-6 sm:col-span-4" wire:ignore>
            <x-jet-label for="supervisoruser" value="{{ __('Staff') }}" />
                <select id="supervisoruser" class="form-control" name="user" wire:model="supervisoruser"></select>
            </div>               
        </div>

        <!-- From -->
        <div class="mt-2 w-full">
            <div class="col-span-6 sm:col-span-4" wire:ignore>
            <x-jet-label for="offciateFromDate" value="{{ __('Starting From') }}" />
                <input type="text" id="offciateFromDate" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date() })" placeholder="Start Date" class="form-control" wire:model.lazy="offciateFromDate" required readonly/>
                <x-jet-input-error for="offciateFromDate" class="mt-2" />
            </div>
        </div>
        

        <!-- To -->
        <div class="mt-2 w-full">
            <div class="col-span-6 sm:col-span-4" wire:ignore>
            <x-jet-label for="offciateToDate" value="{{ __('To') }}" />
                <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD',minDate: new Date() })" placeholder="End Date" class="form-control" wire:model.lazy="offciateToDate" required readonly/>
                <x-jet-input-error for="offciateToDate" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="textRemarks" value="{{ __('Remarks ') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" name="textRemarks" wire:model="textRemarks" />
            </div>
        </div>


    </x-slot>

    <x-slot name="footer">

        <x-jet-button class="mr-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="updateSupervisor" wire:loading.attr="disabled">
            {{ __('Assign') }}
        </x-jet-button>

        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

    </x-slot>
</form>
</x-jet-dialog-modal>


  @push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('#division_id_').on('change', function () {
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
                    $("#supervisoruser").html('');
                    $('#supervisoruser').html('<option value="" selected>-- Select Staff --</option>');
                    $.each(res.staff, function (key, value) {
                        $("#supervisoruser").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });

    </script>
@endpush