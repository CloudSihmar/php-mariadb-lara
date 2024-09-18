<x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        <div class="col-span-6 sm:col-span-4">
            <span class="font-bold uppercase"> {{ isset( $this->leaveapp->id) ? 'EDIT' : 'APPLY NEW LEAVE' }}</span>
        </div>
        <div class="bg-gray-200 rounded flex p-2 col-span-6 sm:col-span-4">
            <i class="fa fa-info-circle fa-lg p-1"></i> 
            Earned Leave Balance:<strong> {{$this->eLeaveBalance}} </strong> &nbsp;&nbsp;
            Casual Leave Balance:<strong> {{$this->cLeaveBalance}} </strong>
            
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="fromDate" value="{{ __('Starting Date') }}" />
                    <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date() })" class="form-control" wire:model.lazy="leaveapp.fromDate"/>
                <x-jet-input-error for="fromDate" class="mt-2 form-control" />
            </div>
        </div>

        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="toDate" value="{{ __('End Date') }}" />
                    <input type="text" x-data x-init="new Pikaday({ field: $el, format:'YYYY-MM-DD', minDate: new Date() })" class="form-control" wire:model.lazy="leaveapp.toDate"/>
                <x-jet-input-error for="toDate" class="mt-2 form-control" />
            </div>
        </div>

        <div class="my-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="leave_category_id" value="{{ __('Leave Type') }}" />
                <select name="leave_category_id" class="form-control" wire:model.defer="leaveapp.leave_category_id" required>
                    <option>Select Leave</option>
                    @foreach ($leavecategories as $cat)
                        @if($cat->id == $CASUAL_LEAVE)
                            @if($this->cLeaveBalance > 0)
                            <option value="{{ $cat->id }}">{{ $cat->leaveCode }} - {{ $cat->name }} </option>
                            @endif
                        @elseif($cat->id == $EARNED_LEAVE)
                            @if($this->eLeaveBalance > 0)
                            <option value="{{ $cat->id }}">{{ $cat->leaveCode }} - {{ $cat->name }} </option>
                            @endif
                        @else
                            <option value="{{ $cat->id }}">{{ $cat->leaveCode }} - {{ $cat->name }} </option>
                        @endif
                    @endforeach
                </select>
                <x-jet-input-error for="leaveapp.leave_category_id" class="mt-2" />
            </div>
        </div>

    @if(!empty($this->subStaffIds)) 
        <!-- <div class="my-4">
            <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="division_id_" value="{{ __('Officiating Division') }}"  />
            <select class="form-control" wire:model.lazy="division_id">
                <option value='' selected>Select Officiating User Division</option>
                    @foreach ($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->name }} </option>
                    @endforeach
            </select>
            </div>
        </div> -->
        <!-- Offgt Staff List-->
        <div class="my-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="supervisoruser" value="{{ __('Officiating User') }}" />
                <select class="form-control" wire:model.lazy="supervisoruser">
                    <option value=''>Select Officiating User</option>
                    @foreach($staffLists as $item)
                    @if($item->id != Auth::user()->id)
                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endif
                    @endforeach
             </select>
            </div>               
        </div>
    @endif

        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="employeeRemarks" value="{{ __('Remarks ') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" id="employeeRemarks" wire:model.lazy="leaveapp.employeeRemarks" />
                <x-jet-input-error for="leaveapp.employeeRemarks" class="mt-2" />
            </div>
        </div>

        <!-- File Upload -->
        <div class="mt-4">
            <x-jet-label for="description" value="{{ __('Supporting Document (Optional)') }}" />
            <div class="flex w-full"> 
                <div
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress" class="w-full">
                <!-- File Input -->
                <x-jet-input id="document" type="file" class="form-control" wire:model.defer="document" />
                <x-jet-input-error for="document"/>

                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
                </div>
            </div>
        </div>
      
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
        {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
            {{ __('Submit') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>

