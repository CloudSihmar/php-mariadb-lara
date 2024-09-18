@if(auth()->user()->id==1)
<x-app-layout>
  <div class="mt-4 md:my-10">
    <x-utilities.messages />
    @include('dashboard.partials._session-type-menu')
  </div>
</x-app-layout>
@else
  <x-user-layout>
    <div class="mt-4 md:my-10">
      <x-utilities.messages />
      @include('dashboard.partials._session-type-menu')
    </div>
  </x-user-layout>
@endif
