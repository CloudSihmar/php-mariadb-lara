<div>
<x-jet-dialog-modal wire:model="edit">
    <x-slot name="title">
        <span class="font-bold uppercase"> {{ isset( $this->workflow->id) ? 'Edit Work Flow' : 'New' }}</span>
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Workflow Name') }}" />
            <x-jet-input type="text" class="mt-1 block w-full" wire:model.lazy="workflow.name" />
            <x-jet-input-error for="workflow.name" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-jet-label for="workflow" value="{{ __('Content') }}" />
             <div class="rounded-md shadow-sm">
                <div class="mt-1 bg-white">                      
                <div class="body-content" wire:ignore>                            
                <trix-editor
                    class="trix-content"
                    x-ref="trix"
                    x-data
                    x-on:trix-change="$dispatch('input', event.target.value)"
                    wire:model.defer="workflow.content"
                    wire:key="trix-workflow-unique-key">
                </trix-editor>
                </div>
                </div>
            </div>
            <x-jet-input-error for="workflow.content" class="mt-2" />
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
</div>