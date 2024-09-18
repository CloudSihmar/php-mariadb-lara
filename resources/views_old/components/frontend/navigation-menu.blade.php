<div class="w-full text-md text-gray-800 bg-gray-50 shadow py-1">
  <div x-data="{ open: false }" class="flex max-w-screen-xl px-4 mx-auto items-center justify-between flex-row ">
      <div class="nav-menu rounded items-center་ "><i class="fa fa-home"></i>
          <a href="{{ route('landing')}}" class="{{ app()->getLocale()=='dz' ? 'font-dz text-lg' : 'text-sm uppercase' }} w-full">
            {{ __('Home') }}
          </a>
        </div>
    <div class="flex">
        <a href="{{ route('lang.switcher','dz')}}" class="text-no-wrap transition-colors duration-200 font-dz block">    
            རྫོང་ཁ
        </a>
        <span class="px-1">|</span>
        <a href="{{ route('lang.switcher','en')}}" class="transition-colors duration-200 block text-xs md:text-sm">    
          English
        </a>
    </div>
  </div>
</div>