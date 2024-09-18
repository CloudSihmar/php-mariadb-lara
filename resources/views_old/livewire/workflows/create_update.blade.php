<div class="p-2 md:mx-2">
    <div class="flex justify-between my-4">
      <h1 class="py-2 uppercase font-bold text-xl text-cyan-600"> {{ isset($workflow) ? 'Update':'Create' }} Workflow</h1>

      <div class="flex gap-4 my-4">
         <a href="{{ route('app.workflow.applications') }}" class="flex items-center text-sm uppercase rounded-full py-2 px-6 bg-cyan-600 text-white hover:bg-cyan-700">
           <i class="fa fa-long-arrow-alt-left fa-lg mr-2"></i>
          <span class="font-bold"> Back</span>
        </a>
      </div>
    </div>

    <!--Session message -->
    <x-utilities.messages-lg />

    <div class="mx-auto mt-1">
      <div class="bg-gray-100 overflow-hidden shadow sm:rounded-lg p-4 pb-10">
        
        <!--Workflow Name -->
        <div class="mt-4 w-1/2">
          <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Workflow Name') }}" />
            <x-jet-input type="text" class="mt-2 block w-full" wire:model.lazy="workflow.name" />
            <x-jet-input-error for="name" class="mt-2" />
          </div>
        </div>

        <!--Content -->
          <div class="mt-4" wire:ignore>
            <x-jet-label for="editor" value="{{ __('Content') }}" />
            <div class="my-2">
              <textarea wire:model.lazy="workflow.content" class="content" name="content"></textarea>
            <x-jet-input-error for="content" class="mt-2" />
          </div>
       

          <div class="flex justify-between mt-4">
          <x-jet-button class="ml-2 bg-blue-400 hover:bg-blue-300 hover:text-gray-700" wire:click="store" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
            
            <a href="{{ route('app.workflow.applications')}}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ml-2 bg-red-600 hover:bg-red-500 hover:text-gray-700">
                {{ __('Cancel') }}
            </a>

           
            </div>
          </div>
      </div>
    </div>
  </div>

  @push('scripts')
     <script>
        tinymce.init({
            selector: 'textarea.content',
            menubar: false,
            branding: false,
            plugins: 'link image code',
            toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code',
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on('change', function (e) {
                    @this.set('workflow.content', editor.getContent());
                });
            }
        });
    </script>
  @endpush