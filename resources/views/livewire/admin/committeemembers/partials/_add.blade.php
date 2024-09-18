 <!-- Show add/Edit Modal -->
<x-jet-dialog-modal wire:model="confirmItemAdd">
    <x-slot name="title">
        <span class="font-bold uppercase"> {{ isset( $this->committeemember->id) ? 'EDIT' : 'ADD NEW' }}</span>
    </x-slot>

    <x-slot name="content">

        <!-- Member type -->
      <div class="my-4">
      <x-jet-label for="committee_member_from" value="{{ __('Committee Member From') }}" />
      <select class="form-control" wire:model.lazy="committee_member_from">
        <option value=0> -- Select Member From --</option>
        @foreach ($departments as $item)
        <option value="{{ $item->id }}">{{ $item->name }} </option>
        @endforeach
      </select>
    </div>
    
    <!-- Committee Member -->
    <div class="my-4">
      <x-jet-label for="committee_id" value="{{ __('Committee Member Name') }}" />
      <select id="user_id" class="form-control" wire:model.lazy="committeemember.user_id">
        <option value=''> -- Select Member Name --</option>
        @foreach ($users as $user)
          @if ($user->department_id ==1)
            @php $divname = \App\Models\Admin\Division::find($user->division_id) @endphp
            <option value="{{ $user->id }}">{{ $user->name .'-'}} 
              @isset($divname ){{ $divname->name }} @endisset
          </option>
          @elseif($user->department_id ==2)
            @php $constituency = \App\Models\Admin\Constituency::find($user->constituency_id) @endphp
            <option value="{{ $user->id }}">{{ $user->name .'-'}} 
                    @isset($constituency ){{ $constituency->name }} @endisset
            </option>
          @endif
        @endforeach
      </select>
    </div>

  <!-- Designation -->
    <div class="mt-4">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="comm_designation" value="{{ __('Designation') }}" />
            <x-jet-input type="text" class="block w-full mt-1" wire:model.lazy="committeemember.comm_designation" />
            <x-jet-input-error for="committeemember.comm_designation" class="mt-2" />
        </div>
    </div>
    </x-slot>

    <x-slot name="footer">
    <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
        {{ __('Cancel') }}
    </x-jet-secondary-button>

    <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
        {{ __('Save') }}
    </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
