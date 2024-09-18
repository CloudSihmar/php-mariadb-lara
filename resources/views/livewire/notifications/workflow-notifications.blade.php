<div>
  @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/css/pikaday.min.css" integrity="sha512-yFCbJ3qagxwPUSHYXjtyRbuo5Fhehd+MCLMALPAUar02PsqX3LVI5RlwXygrBTyIqizspUEMtp0XWEUwb/huUQ==" crossorigin="anonymous" /> 
  @endpush
  <div class="p-2 md:mx-2">
    <div class="flex justify-between my-6">
      <h1 class="py-2 uppercase font-bold text-xl text-cyan-600">Workflow Notification</h1>
      <div class="flex gap-4">
      </div>
    </div>

      <!--Session message -->
      <x-utilities.messages />
      <div class="mx-auto mt-1">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg">
          <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
              <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                  <th class="px-4 py-2">Subject</th>
                  <th class="px-4 py-2">Content</th>
                  <th class="px-4 py-2">Author</th>
                  <th class="px-4 py-2">Date</th>
                  <th class="px-4 py-2 text-right">Action</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y">
                @foreach ($workflows as $result)
                <tr class="text-gray-600">
                  <td class="px-4 py-2">
                    <div class="text-sm">
                      {{ $result->name}}
                    </div>
                  </td>

                   <td class="px-4 py-2">
                    <div class="text-sm">
                      {!! substr($result->content,0,70) !!}
                    </div>
                  </td>
                  
                  <td class="px-4 py-2">
                    <div class="text-sm">
                      {{ $result->user->name}}
                    </div>
                  </td>
                
                  <td class="px-4 py-2">
                    <div class="text-sm">
                    {{ substr($result->created_at,0,10)}}
                    </div>
                  </td>

                  <td class="flex flex-wrap justify-end gap-2 px-4 py-2">
                    {{-- @can(['workflows.edit']) --}}
                      <button wire:click="editWorkflow({{ $result->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-semibold focus:border-gray-200 bg-green-500 hover:text-gray-200">
                      <i class="fa fa-edit mr-2"></i>Edit
                      </button>
                    {{-- @endcan --}}

                    <button wire:click="forwardModal({{ $result->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-semibold focus:border-gray-200 bg-sky-500 hover:text-gray-200">
                        <i class="fa fa-check-square fa-lg mr-1"></i>Forward
                    </button> 

                     <button wire:click="writeComment({{ $result->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-semibold focus:border-gray-200 bg-green-500 hover:text-gray-200">
                        <i class="fa fa-pen fa-lg mr-1"></i>Comment
                    </button> 

                      <button wire:click="showActivity({{ $result->id }})" class="p-2 rounded text-gray-50 uppercase text-xs font-semibold focus:border-gray-200 bg-orange-500 hover:text-gray-200">
                        <i class="fa fa-eye fa-lg mr-1"></i>Activity
                    </button> 
                  </td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="px-4 py-3 my-4 text-xs font-semibold tracking-wide uppercase border-t bg-gray-50 min-h-min">
            {{ $workflows->links()}} 
          </div>
        </div>
      </div>
  </div>


  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.0/pikaday.min.js" integrity="sha512-AWC8WaJpos1L8xD++XDtqY3znmqhqDY/o4KZ3wo7kmt1Hx6YjP4ZqPnYDrLg1ymG6iidGzq/UKHS/MxBwVAlwQ==" crossorigin="anonymous"></script>
  @endpush
</div>
