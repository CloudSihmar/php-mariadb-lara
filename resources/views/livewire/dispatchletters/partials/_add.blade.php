<div>
  <x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        <span class="font-bold uppercase"> {{ isset($this->dispatchletter->id) ? 'EDIT Dispatch Letter' : 'Dispatch Letter Form' }}</span>
    </x-slot>

    <x-slot name="content">
       
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
          <h1 class="font-bold uppercase text-sm pb-2">Source Details</h1>
          <h1 class="font-bold uppercase text-sm pb-2">Destination Details</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            
            <!-- column 1  -->
            <div class="bg-gray-100 shadow p-2">
                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="from_department_id" value="{{ __('Department') }}" />
                        <select class="form-control" wire:model.lazy="from_department_id">
			            <option value=0 selected>Select Department</option>        
                        @foreach ($departments as $dept)        
                                <option value="{{ $dept->id }}">{{ $dept->name }} </option>
                                @endforeach 
		<!--		<option value="1" selected>Secretariat </option> -->
                                 
                        </select>
                    
                    </div>
                    <x-jet-input-error for="from_department_id" class="mt-2" />
                </div>

                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="from_division_id" value="{{ __('Division') }}" />
                        <select class="form-control" wire:model.lazy="from_division_id">
                            @if(isset($from_division_id))
                                <option value={{$from_division_id}} selected> 
                                {{ $division = App\Http\Livewire\Utilities::divisionName($from_division_id);}}
                                </option>
                            @endif
                            <option value=0 selected> Select Division</option>
                                @foreach ($divisions as $item)
                                @if(!in_array($item->id,[5,6]))
                                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                                @endif
                                @endforeach
                        </select>
                        <x-jet-input-error for="from_division_id" class="mt-2" />
                    </div>  
                </div>

                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="to_adressed" value="{{ __('Addressed To') }}" />
                        <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="to_adressed" />
                        <x-jet-input-error for="to_adressed" class="mt-2" />
                    </div>
                </div>
                
                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="issue_date" value="{{ __('Dispatch Date') }}" />
                        <input type="text" id="issue_date" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD',  minDate: new Date('2022-01-01'), maxDate: new Date() })" class="form-control" wire:model.lazy="issue_date" readonly/>
                        <x-jet-input-error for="issue_date" class="mt-2" />
                    </div>
                </div>

            @if(empty($this->dispatchletter->id))
                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4" wire:ignore>
                        <x-jet-label for="name" value="{{ __('Dispatch Number') }}" /> 
                        <x-jet-input type="text" wire:model="dispatch_number" class="form-control" readonly/>
                        <x-jet-input-error for="dispatch_number" class="mt-2" />
                    </div>
                </div> 
            @else
            <div class="m-2">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Dispatch Number') }}" /> 
                    <x-jet-input type="text" wire:model="dispatch_number" class="form-control" readonly/>
                </div>
            </div> 
            @endif
            </div>
                                    
          <!-- column 2  -->
          <div class="bg-gray-100 shadow p-2">
            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_agency" value="{{ __('Ministry/Agency/Office') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="to_agency" />
                <x-jet-input-error for="to_agency" class="mt-2" />
              </div>
            </div>

            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_department" value="{{ __('Dept/Agency/Office') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="to_department" value="{{ $to_department}}"/>
              </div>
            </div>

            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_division" value="{{ __('Division/Agency/Office') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="to_division" />
              </div>
            </div>

            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_subject" value="{{ __('Subject of the Letter') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="to_subject" />
                <x-jet-input-error for="to_subject" class="mt-2" />
              </div>
            </div> 


            <div class="m-2">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="file_index" value="{{ __('File Index') }}" />
                    <select class="form-control" wire:model.lazy="file_index">
                        <option value='' selected> Select File Index</option>
                            @foreach ($fileIndexs as $fileIndex)
                            <option value="{{ $fileIndex->id }}">{{ $fileIndex->name }} </option>
                            @endforeach
                    </select>
                
                </div>
                <x-jet-input-error for="file_index" class="mt-2" />
            </div>
            <!-- <div class="m-2">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="file_index" value="{{ __('File Index') }}" />
                    <x-jet-input type="text" class="mt-1 block w-full" wire:model="file_index"  value="{{ $file_index}}"/>
                    <div class="relative">
                        <div class="absolute w-full bg-white shadow z-50">
                        @foreach ($fileindexes as $item)
                        <div class="p-2 hover:bg-gray-100 text-gray-800 border-b" wire:click="setValue('{{$item->name}}')">
                            {{ $item->name }}
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>  -->


          </div>
        </div> 

        <!-- File upload  -->
        
        <div class="my-2">
        @if(isset($this->dispatchletter->id))
            @livewire('filemanagers', ['docID' => $docID, 'directory_name' => 'DispatchedLetters'])
        @else
            @livewire('filemanagers', ['docID' => $docID, 'directory_name' => 'DispatchedLetters'])
        @endif
        </div>
       
    </x-slot>

    <x-slot name="footer">
        <x-jet-button class="mr-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
            {{ isset($this->dispatchletter->id) ? 'Update' : 'Save Draft' }}
        </x-jet-button>

          <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
    </x-slot>
  </x-jet-dialog-modal>

  {{-- @push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
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
        });
    </script>
  @endpush --}}
</div>
