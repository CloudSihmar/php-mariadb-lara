<div>
<x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        <span class="font-bold uppercase"> {{ isset( $this->receiveletter->id) ? 'EDIT Letter' : 'Receive Letter Form' }}</span>
    </x-slot>

    <x-slot name="content">
      <div class="grid gird-cols-2 md:grid-cols-2 gap-2">
        <h1 class="font-bold uppercase text-sm pb-2">Receiver Details</h1>
        <h1 class="font-bold uppercase text-sm pb-2">Sender Details</h1>
      </div>
      <div class="grid gird-cols-2 md:grid-cols-2 gap-2">
        <!-- column 1 Receiver Details -->
        <div class="bg-gray-100 shadow p-2">
            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_department_id" value="{{ __('Agency') }}" />
                  <select class="form-control" wire:model.lazy="to_department_id">
                      <!-- <option value=0 selected>Select Agency</option>
                        @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}">{{$dept->id}}{{ $dept->name }} </option>
                        @endforeach -->
                        <option value="1" selected>Secretariat </option>
                  </select>
                  <x-jet-input-error for="to_department_id" class="mt-2" />
              </div>
            </div>

            <div class="m-2">
                <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="to_division_id" value="{{ __('Division') }}" />
                  <select class="form-control" wire:model.lazy="to_division_id">
                    @if(isset($to_division_id))
                    <option value={{$to_division_id}} selected> 
                    {{ $division = App\Http\Livewire\Utilities::divisionName($to_division_id);}}
                    </option>
                    @endif
                    <option value=0 selected> Select Division</option>
                    @foreach ($divisions as $division)
                    <!-- <option value="{{ $division->id }}">{{ $division->name }} </option> -->
                      @if(!in_array($division->id,[5,6]))
                          <option value="{{ $division->id }}">{{ $division->name }} </option>
                      @endif
                    @endforeach
                    
                  </select>
                  <x-jet-input-error for="to_division_id" class="mt-2" />
                </div>  
            </div>

            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_adressed" value="{{ __('Addressed To') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="to_adressed"/>
                <x-jet-input-error for="to_adressed" class="mt-2" />
              </div>
            </div>

            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="receive_date" value="{{ __('Letter Receiving Date') }}" />
                <input type="text" id="receive_date" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD',  minDate: new Date('2022-01-01'), maxDate: new Date() })" class="form-control" wire:model.lazy="receive_date" readonly/>
                <x-jet-input-error for="receive_date" class="mt-2" />
              </div>
            </div>

          @if(empty($this->receiveletter->id))
            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Dak Number') }}" />
                <x-jet-input type="text" wire:model.lazy="dak_number" class="form-control" readonly/>
                <x-jet-input-error for="dak_number" class="mt-2" />
              </div>
            </div> 
            @else
            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Dak Number') }}" />
                <x-jet-input type="text" wire:model="dak_number" class="form-control" readonly/>
              </div>
            </div> 
           @endif
        </div>

        <!-- column 2 Sender Details  -->
        <div class="bg-gray-100 shadow p-2">
          <div class="m-2">
            <div class="col-span-6 sm:col-span-4">
              <x-jet-label for="from_agency" value="{{ __('Ministry/Agency/Office') }}" />
              <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="from_agency"/>
              <x-jet-input-error for="from_agency" class="mt-2" />
            </div>
          </div>

          <div class="m-2">
            <div class="col-span-6 sm:col-span-4">
              <x-jet-label for="from_department" value="{{ __('Dept/Agency/Office') }}" />
              <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="from_department" value="{{ $from_department }}"/>
            </div>
          </div>

          <div class="m-2">
            <div class="col-span-6 sm:col-span-4">
              <x-jet-label for="from_division" value="{{ __('Division/Agency/Office') }}" />
              <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="from_division" value="{{ $from_division }}" />
            </div>
          </div>

          <div class="m-2">
            <div class="col-span-6 sm:col-span-4">
              <x-jet-label for="to_subject" value="{{ __('Subject of the Letter') }}" />
              <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="to_subject" value="{{ $to_subject }}" />
              <x-jet-input-error for="to_subject" class="mt-2" />
            </div>
          </div> 

          <div class="m-2">
            <div class="col-span-6 sm:col-span-4">
              <x-jet-label for="file_index" value="{{ __('File Number') }}" />
              <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="file_index" value="{{ $file_index }}" />
              <x-jet-input-error for="file_index" class="mt-2" />
            </div>
          </div> 

          <!--
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
        
          <div class="m-2">
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
            </div>  
            -->

        </div>
      </div>

      <!-- File upload  -->
      <div class="my-2">
      @if(isset($this->receiveletter->id))
          @livewire('filemanagers', ['docID' => $docID, 'directory_name' => 'ReceivedLetters'])
      @else
          @livewire('filemanagers', ['docID' => $docID, 'directory_name' => 'ReceivedLetters'])
      @endif
      </div> 

    </x-slot>

    <x-slot name="footer">
        <x-jet-button class="mr-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
            {{ isset($this->receiveletter->id) ? 'Update' : 'Save Draft' }}
        </x-jet-button>

          <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
</div>
