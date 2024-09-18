<x-jet-dialog-modal wire:model="viewremark">
    <x-slot name="title">
        <span class="font-bold uppercase"> Comment by the supervisor</span>
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="headRemarks" value="{{ __('Comment/Remark ') }}" />
                <x-jet-input type="text" class="bg-gray-50 mt-1 block w-full" wire:model.lazy="leaveapp.headRemarks" readonly/>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="updateRemark" wire:loading.attr="disabled">
            {{ __('Close') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>


@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#agency_id').on('change', function () {
                var idAgency = this.value;
                $("#department_id").html('');
                $.ajax({
                    url: "{{url('/parliament/fetch-department')}}",
                    type: "post",
                    data: {
                        agency_id:idAgency,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#department_id').html('<option value="">-- Select Department --</option>');
                        $.each(result.departments, function (key, value) {
                            $("#department_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#division_id').html('<option value="">-- Select Divison --</option>');
                    }
                });
            });
  
            $('#department_id').on('change', function () {
                var idDept = this.value;
                $("#division_id").html('');
                $.ajax({
                    url: "{{url('/parliament/fetch-division')}}",
                    type: "post",
                    data: {
                        department_id: idDept,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#division_id').html('<option value="">-- Select Division --</option>');
                        $.each(res.divisions, function (key, value) {
                            $("#division_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
  
        });
    </script>
@endpush
