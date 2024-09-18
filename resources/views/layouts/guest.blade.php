<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   @include('layouts.partials._head')
    <body class="font-sans text-gray-900 antialiased bg-white">
      <x-top-header />
      <x-frontend.navigation-menu />
      
      <!--content  -->
      <div class="mt-2 my-10 min-h-[520px]">
        {{ $slot }}
      </div>
     <x-footer-landing/>    
</body>
</html>
