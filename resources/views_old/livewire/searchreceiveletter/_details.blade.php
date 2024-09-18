<div>
  <x-jet-dialog-modal wire:model="viewDetails">
    <x-slot name="title">
        <span class="font-bold uppercase"> Receive Letter Details</span>
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
          <h1 class="font-bold uppercase text-sm pb-2">Destionation Details</h1>
          <h1 class="font-bold uppercase text-sm pb-2">Source Details</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <!-- column 1 Receiver Details -->
            <div class="bg-gray-100 shadow p-2">
                <div class="m-2">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="to_adressed" value="{{ __('Addressed To') }}" />
                    <x-jet-input type="text" class="form-control" value="{{ isset($receiveletter->to_adressed) ? $receiveletter->to_adressed : '' }}" readonly/>
                </div>
                </div>

                <div class="m-2">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="to_department_id" value="{{ __('Department') }}" />
                    <x-jet-input type="text" class="form-control" value="{{ isset($receiveletter->to_department_id) ? $this->getDepartment($receiveletter->to_department_id) : '' }}" readonly/>
                </div>
                </div>

                <div class="m-2">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="to_division_id" value="{{ __('Division/Member') }}" />
                    <x-jet-input type="text" class="form-control" value="{{ isset($receiveletter->to_division_id) ? $this->getDivision($receiveletter->to_division_id) : '' }}" readonly/>
                </div>
                </div>

                <div class="m-2">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="receive_date" value="{{ __('Letter Receiving Date') }}" />
                    <x-jet-input type="text" class="form-control" value="{{ isset($receiveletter->receive_date) ? $receiveletter->receive_date : '' }}" readonly/>
                </div>
                </div>

                <div class="m-2">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="dak_number" value="{{ __('Dak Number') }}" />
                    <x-jet-input type="text" class="form-control" value="{{ isset($receiveletter->dak_number) ? $receiveletter->dak_number : '' }}" readonly/>
                </div>
                </div> 

            </div>

            <!-- column 2 Sender Details  -->
            <div class="bg-gray-100 shadow p-2">
                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="from_agency" value="{{ __('Ministry/Agency/Office') }}" />
                    <x-jet-input type="text" class="form-control" value="{{ isset($receiveletter->from_agency) ? $receiveletter->from_agency : '' }}" readonly/>
                    </div>
                </div>

                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="from_department" value="{{ __('Dept/Agency/Office') }}" />
                    <x-jet-input type="text" class="form-control" value="{{ isset($receiveletter->from_department) ? $receiveletter->from_department : '' }}" readonly/>
                    </div>
                </div>

                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="from_division" value="{{ __('Division/Agency/Office') }}" />
                    <x-jet-input type="text" class="form-control" value="{{ isset($receiveletter->from_division) ? $receiveletter->from_division : '' }}" readonly/>
                    </div>
                </div>

                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="to_subject" value="{{ __('Subject of the Letter') }}" />
                    <x-jet-input type="text" class="form-control" value="{{ isset($receiveletter->to_subject) ? $receiveletter->to_subject : '' }}" readonly/>
                    </div>
                </div> 

                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="to_reference_number" value="{{ __('Letter Reference Number') }}" />
                    <x-jet-input type="text" class="form-control" value="{{ isset($receiveletter->to_reference_number) ? $receiveletter->to_reference_number : '' }}" readonly/>
                    </div>
                </div> 
            </div>
        </div> 
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Close') }}
        </x-jet-secondary-button>
    </x-slot>
  </x-jet-dialog-modal>
</div>