<div class="container mx-auto">
    <div class="flex justify-between w-10/12 mx-auto mt-4">
      <h1 class="py-2 text-xl font-bold uppercase text-cyan-600">Workflow</h1>

      <div class="flex gap-4 my-4">
         <a href="{{ route('app.workflow.applications') }}" class="flex items-center px-6 py-2 text-sm text-white uppercase rounded-full bg-cyan-500 hover:bg-cyan-500">
           <i class="mr-2 fa fa-long-arrow-alt-left fa-lg"></i>
          <span class="font-bold"> Back</span>
        </a>
      </div>
    </div>

    <!--Session message -->
    <x-utilities.messages-lg />
    
    <div class="container mx-auto mt-1">
      <div class="grid w-10/12 grid-cols-1 p-4 mx-auto overflow-hidden border md:grid-cols-3 sm:rounded-lg">
        <div class="mt-2">
            <p class="my-2 font-bold">Language</p>
            <fieldset class="flex flex-col">
                <div class="flex items-center py-2">
                    <input type="radio" wire:model.lazy="language" value="en" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                    <label class="block ml-2 text-sm text-gray-900">
                        English
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="radio" wire:model="language" value="dz" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                    <label class="block ml-2 text-sm text-gray-900">
                          Dzongkha
                    </label>
                </div>
            </fieldset>
        </div>
        <!-- PDF -->
        <div class="mt-2">
          <div class="py-2 font-bold">Select Letterhead</div>
            <div class="flex flex-col gap-2 mt-2">
              <div class="flex flex-wrap items-center">
                <input type="radio" wire:model.lazy="letterhead" value=1 class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                <label class="block ml-2 text-sm text-gray-900">
                    Secretary
                </label>
              </div>

              <div class="flex items-center">
                <input type="radio" wire:model="letterhead" value=2 class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                <label class="block ml-2 text-sm text-gray-900">
                  Director
                </label>
              </div>

              <div class="flex items-center">
                <input type="radio" wire:model="letterhead" value=3 class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                <label class="block ml-2 text-sm text-gray-900">
                  Chief
                </label>
              </div>

              <div class="flex items-center">
                <input type="radio" wire:model="letterhead" value=4 class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                <label class="block ml-2 text-sm text-gray-900">
                test
                </label>
              </div>

              <div class="flex items-center">
                <input type="radio" wire:model="letterhead" value=5 class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                <label class="block ml-2 text-sm text-gray-900">
                  General
                </label>
              </div>
            </div>
        </div>   

         <div class="mt-2">
            <p class="font-bold">File Index</p>
            <fieldset class="flex space-x-2">
              <div class="w-80">
                <select class="form-control" wire:model="file_index">
                  <option value=''>-- Select --</option>
                  @foreach ($fileIndexs as $fileIndex)
                  <option value="{{ $fileIndex->id }}">{{ $fileIndex->name }} </option>
                  @endforeach
                </select>
                <x-jet-input-error for="file_index" class="mt-2" />
              </div>
            </fieldset>

            <div class="py-4">
              <a href="{{ route('app.pdf.workflow',$letterhead)}}" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-center text-white uppercase bg-red-600 rounded hover:bg-red-500 w-80" target="_blank">
                <i class="mr-2 fa fa-file-pdf"></i> {{ __('Export to PDF') }}
                <i class="ml-2 fa fa-long-arrow-alt-right"></i>
              </a>
            </div>
        </div>
      </div>

      <div class="w-10/12 p-6 pb-10 mx-auto mt-4 overflow-hidden bg-white border sm:rounded-lg">
          <!-- PDF -->
          <div class="{{ app()->getLocale()=='dz' ? 'font-dz text-lg' : '' }}">
                {!! $workflow->content !!}
          </div>
      </div>
    </div>
  </div>

