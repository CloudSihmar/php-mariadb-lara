<x-jet-dialog-modal wire:model="subordinate">
    <x-slot name="title">
        <span class="font-bold uppercase">Select Staff under you </span>
    </x-slot>

    <x-slot name="content">
        <div class="my-2">
            <select class="form-control" wire:model.lazy="userdivision">
                <option value=''>Select Division/Office</option>
                @foreach($divisions as $item)
                <option value={{$item->id}}>{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        @if(isset( $this->user->id))
            <table class="w-full whitespace-no-wrap">
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                <th class="p-2">Select</th>
                <th class="p-2">Name</th>
                <th class="p-2">Division</th>
                </tr>
                <tbody class="bg-white divide-y">
                @foreach($userList as $u)
                @if($u->id != $this->user->id)
                <tr>
                    <td class="p-2">
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" wire:model.lazy="users_id.{{ $u->id }}"> 
                    </td>
                    <td class="p-2">
                        {{ $u->name}}
                    </td>
                    <td class="p-2">
                        {{ $u->division->name ?? "-" }}
                    </td>
                </tr>
                @endif
                @endforeach
                </tbody>
            </table>
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="subordinateUpdate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>