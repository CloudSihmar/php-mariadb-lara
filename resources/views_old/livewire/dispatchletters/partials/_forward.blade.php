<div>
    <x-jet-dialog-modal wire:model="forward">
    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <x-slot name="title">
            <span class="font-bold uppercase"> Forward Letter </span>
        </x-slot>

        <x-slot name="content">

        <!-- <div class="my-4">
            <div class="col-span-6 sm:col-span-4" >
                <x-jet-label for="forward_from_department_id" value="{{ __('Agency') }}" wire:ignore />
                    <select class="form-control" wire:model.lazy="forward_from_department_id">
                        <option value='' selected>Select Agency</option>
                        @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }} </option>
                        @endforeach
                    </select>
                </div> 
        </div>  -->

        <div class="my-4">
            <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="forward_from_division_id" value="{{ __('Division') }}" />
                <select class="form-control" wire:model.lazy="forward_from_division_id">
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
                <select id="user" class="form-control" wire:model="user">
                    <option value='' selected>Select User</option>
                    @foreach ($usersLists as $u)
                    @if($u->id != Auth::user()->id)
                    <option value="{{ $u->id }}">{{ $u->name }} </option>
                    @endif
                    @endforeach
                </select>
            </div>               
        </div>

        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4" wire:ignore>
                <x-jet-label for="remarks" value="{{ __('Remarks ') }}" />
                <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="remarks" />
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
</div>