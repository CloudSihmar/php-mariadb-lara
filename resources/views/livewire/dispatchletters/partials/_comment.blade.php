<div>
<x-jet-dialog-modal wire:model="writecomment">
    <x-slot name="title">
        <span class="font-bold uppercase"> Write short comment(if any)</span>
    </x-slot>

    <x-slot name="content">
        <div class="m-2">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_division" value="{{ __('Comment/Remark') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="comment" />
                <x-jet-input-error for="comment" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="savecomment" wire:loading.attr="disabled">
            {{ __('Save Comment') }}
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
                        $('#department_id').html('<option value="" selected>-- Select Department --</option>');
                        $.each(result.departments, function (key, value) {
                            $("#department_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
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
                        $('#division_id').html('<option value="" selected>-- Select Division --</option>');
                        $.each(res.divisions, function (key, value) {
                            $("#division_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

            //Dispatch Number
            $('#issue_date').change(function(){
            $.ajax({
                type: "GET",
                url:  "{{url('/parliament/fetch-dispatchnumber') }}",
                success:function(res){
                    $('#dispatch_number').val(res);
                } 
                });
            });

        });
    </script>
@endpush
</div>