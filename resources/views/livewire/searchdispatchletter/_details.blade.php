<div>
  <x-jet-dialog-modal wire:model="viewDetails">
    <x-slot name="title">
        <span class="font-bold uppercase"> Dispatch Letter Details</span>
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
          <h1 class="font-bold uppercase text-sm pb-2">Source Details</h1>
          <h1 class="font-bold uppercase text-sm pb-2">Destionation Details</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <!-- column 1  -->
            <div class="bg-gray-100 shadow p-2">
                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="from_department_id" value="{{ __('Department') }}" />
                        <x-jet-input type="text" class="form-control" value="{{ isset($dispatchletter->from_department_id) ? $this->getDepartment($dispatchletter->from_department_id) : '' }}" readonly/>
                    </div>
                </div>

                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="from_division_id" value="{{ __('Division/Member') }}" />
                        <x-jet-input type="text" class="form-control" value="{{ isset($dispatchletter->from_division_id) ? $this->getDivision($dispatchletter->from_division_id) : '' }}" readonly />
                    </div>
                </div>

                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="to_adressed" value="{{ __('Addressed To') }}" />
                        <input type="text" class="form-control" value="{{ isset($dispatchletter->to_adressed) ? $dispatchletter->to_adressed : ''}}" readonly/>
                    </div>
                </div>
                
                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="issue_date" value="{{ __('Dispatch Date') }}" />
                        <x-jet-input type="text" class="form-control"  value="{{ isset($dispatchletter->issue_date) ? $dispatchletter->issue_date : '' }}" readonly/>
                    </div>
                </div>

                <div class="m-2">
                    <div class="col-span-6 sm:col-span-4"e>
                        <x-jet-label for="dispatch_number" value="{{ __('Dispatch Number') }}" /> 
                        <x-jet-input type="text" class="form-control"  value="{{ isset($dispatchletter->dispatch_number) ? $dispatchletter->dispatch_number : '' }}" readonly/>
                    </div>
                </div> 
            </div>
                                    
          <!-- column 2  -->
          <div class="bg-gray-100 shadow p-2">
            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_agency" value="{{ __('Ministry/Agency/Office') }}" />
                <x-jet-input type="text" value="{{ isset($dispatchletter->to_agency) ? $dispatchletter->to_agency : '' }}" class="form-control" readonly/>
              </div>
            </div>

            <div class="m-2">
                 <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="to_department" value="{{ __('Dept/Agency/Office') }}" />
                    <x-jet-input type="text" value="{{ isset($dispatchletter->to_department) ? $dispatchletter->to_department : '' }}" class="form-control" readonly/>
                </div>
            </div>

            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_division" value="{{ __('Division/Agency/Office') }}" />
                <x-jet-input type="text" value="{{ isset($dispatchletter->to_division) ? $dispatchletter->to_division : '' }}" class="form-control" readonly/>
              </div>
            </div>

            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_subject" value="{{ __('Subject of the Letter') }}" />
                <x-jet-input type="text" value="{{ isset($dispatchletter->to_subject) ? $dispatchletter->to_subject : '' }}" class="form-control" readonly/>
              </div>
            </div> 

            <div class="m-2">
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="to_reference_number" value="{{ __('Letter Reference Number') }}" />
                <x-jet-input type="text" value="{{ isset($dispatchletter->to_reference_number) ? $dispatchletter->to_reference_number : '' }}" class="form-control" readonly/>
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