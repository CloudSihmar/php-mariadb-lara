<x-user-layout>
<div>
  <div class="flex justify-between my-6">
      <h1 class="py-2 uppercase font-bold text-center text-xl">Committee Documents</h1>
  </div>

<!-- page -->
  <main class="w-full text-gray-700" x-data="layout">
    <!-- header page -->
    <div class="flex">
      <!-- aside -->
      @include('livewire.committeedocuments.partials._sidebar')
      
      <!-- main content -->
      <div class="bg-white w-full px-4">
         <div class="h-5 border-b-2 border-sky-500 text-2xl text-center">
            <span class="bg-gray-50 px-5"> {{ $selcommittee->name }} - Committe Members </span>
        </div>
        <!-- header page -->
        <div class="px-4">
            <!-- profile -->
           <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-12">
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($members as $item)
                  <div class="w-full bg-white rounded-lg p-12 flex flex-col justify-center items-center">
                      <div class="mb-8">
                          <img class="object-center object-cover rounded-full h-36 w-36" src="{{ asset(\App\Models\User::find($item->user_id)->profile_photo_url)}}" alt="photo">
                      </div>
                      <div class="text-left">
                          <p class="text-gray-700 mb-2"><b>Name:</b> {{ \App\Models\User::find($item->user_id)->name}}</p>
                          <p class="text-base text-gray-700 font-normal"><b>Designation:</b> {{ \App\Models\Admin\Committeemember::where('user_id',$item->user_id)->first()->comm_designation}}</p>
                          <p class="text-base text-gray-700 font-normal"><b>Constituency:</b> {{ \App\Models\Admin\Committeemember::where('user_id',$item->user_id)->first()->constituency}}</p>
                          <p class="text-base text-gray-700 font-normal"><b>Contact No:</b> {{ \App\Models\User::find($item->user_id)->contactno}}</p>
                          <p class="text-base text-gray-700 font-normal"><b>Email:</b> {{ \App\Models\User::find($item->user_id)->email}}</p>
                    </div>
                  </div>
                  @endforeach
              </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

</x-user-layout>