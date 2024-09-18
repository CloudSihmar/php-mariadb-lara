<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.partials._head')

<body class="font-Ubuntu antialiased">
  <x-top-header />
     <!-- navigation -->
   <x-admin.navigation-menu /> 
  <div x-data="{ sidebarOpen: false}">
      <div class="flex min-h-screen bg-white">
        {{-- <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 opacity-50 transition-opacity lg:hidden"></div> --}}
        <!-- sidebar -->
           @can('is-admin')
            <div class="mt-1">
                <x-admin.admin-sidebar />
            </div>
          @endcan
        <!-- Content -->
        <div class="w-full mx-4 overflow-hidden">
            {{-- <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none  p-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
            </button> --}}
              <!-- documents -->
              {{ $slot }}
        </div>
      </div>
    </div>
  @stack('modals')
  @livewireScripts
  @include('layouts.partials._scripts')
  @stack('scripts')
</body>
</html>