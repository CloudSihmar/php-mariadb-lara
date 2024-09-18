<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.partials._head')

<body class="font-Ubuntu antialiased ">
  <div class="min-h-screen bg-white">
    <!-- Page Content -->
      <x-top-header />
       <x-users.navigation-menu />
      <div x-data="{ sidebarOpen: false}">
        <div class="flex pb-20 md:pb-32">
            <div class="container mx-auto min-h-[510px]">
              {{ $slot }}
            </div>
        </div>
         <x-footer/>
      </div>
  </div>
  @stack('modals')
  @livewireScripts
  @include('layouts.partials._scripts')
  @stack('scripts')
</body>

</html>