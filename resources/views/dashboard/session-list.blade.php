@if(auth()->user()->id==1)
  <x-app-layout>
    <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 mt-10 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li aria-current="page">
          <div class="flex items-center">
            <span class="ml-1 font-medium text-gray-700 md:ml-2">Sessions</span>
          </div>
        </li>
      </ol>
    </nav>

    <div class="p-4 mt-4 border border-gray-100 rounded md:my-10">
      <div class="grid gap-4 grid-col1 md:grid-cols-4">
        @foreach ($parliamentsessions as $item)
          <a href="{{ route('app.session.type', $item->id)}}" class="flex items-center w-full my-4">
            <div class="px-2 py-1 text-white bg-yellow-500 rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
              </svg>
            </div>
            <div class="ml-3">
                {{$item->name }}
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </x-app-layout>
@else
  <x-user-layout>
     <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 mt-4 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li>
          <div class="flex items-center text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
            <a href="#" class="ml-1 font-medium text-gray-700 hover:text-gray-900 md:ml-2">Session Documents</a>
          </div>
        </li>
      </ol>
    </nav>
    

    <div class="p-4 mt-4 border border-gray-100 rounded md:my-10">
      <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
        @foreach ($parliamentsessions as $item)
          <a href="{{ route('app.session.type', $item->id)}}" class="flex items-center w-full my-4">
              <div class="px-2 py-1 text-white bg-yellow-500 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
              </div>
              <div class="ml-3">
                  {{$item->name }}
              </div>
            </a>
        @endforeach
     </div>
    </div>
  </x-user-layout>
@endif
