<!-- component -->
  <div class="mb-4 shadow bg-gray-50 md:px-6">
      <nav class="container flex flex-col md:flex-row justify-between py-1 mx-auto text-gray-800">
        <div class="flex items-center items-center་ text-center">
          <a href="{{ route('user.dashboard')}}" class="{{ app()->getLocale()=='dz' ? 'font-dz text-xl' : 'font-base' }} w-full rounded px-4 py-2">
           <i class="fa fa-home"></i> {{ __('Home') }}
            <span class="ml-2 font-medium"> ({!! getCurrentParliament()->name !!})</span>
          </a>  
        </div>
        <!-- User Status -->
        <div class="items-center hidden px-4 py-2 text-sm font-bold text-green-600 uppercase md:flex">
          <?php try{ ?> 
              @php $userstatusDtl = \App\Models\User::with('userstatus')->where('id', auth()->user()->id)->get()->first() @endphp  
            <?php }catch(\Exception $e){ ?>
            <?php } ?>

            @isset($userstatusDtl)
              Status - {{ !empty($userstatusDtl->userstatus->name) ? $userstatusDtl->userstatus->name:'-'}}
            @endisset
        </div>
        
      <!-- content -->
      <div class="flex items-center justify-center gap-4">
          <!-- Notification  Menu-->
          <div @click.away="open = false" class="relative z-50" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-end w-full px-4 py-2 rounded hover:text-gray-700">
              <div class="flex items-center "> <span class="mr-2 text-sm">{{ __('Notification') }} </span>
                <a type="button" class="p-1 text-white rounded-full bg-sky-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                  <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                  </svg>
                </a>
                <span class="flex items-center justify-center w-5 h-5 -mt-6 -ml-2 text-xs text-white bg-red-500 rounded-full">
                  <?php try{ ?> 
                 @php
                    $notification = \App\Models\Notification::where('flag',0)->where('forward_to', Auth::user()->id)->get()->count();
                    $leave    = \App\Models\Notification::where('flag',0)->where('route', 'like','%leave%')->where('forward_to', Auth::user()->id)->get()->count();
                    $letter   = \App\Models\Notification::where('flag',0)->where('route', 'like','%letter%')->where('forward_to', Auth::user()->id)->get()->count();
                    $workflow = \App\Models\Notification::where('flag',0)->where('route', 'like','%workfl%')->where('forward_to', Auth::user()->id)->get()->count(); 
                    echo $notification;
                  @endphp
                  <?php }catch(\Exception $e){ ?>
                  <?php } ?>
                </span>
              </div>
            </button>
            
            <div x-show="open" x-transition:enter="transition ease-out duration-100" 
                               x-transition:enter-start="transform opacity-0 scale-95" 
                               x-transition:enter-end="transform opacity-100 scale-100" 
                               x-transition:leave="transition ease-in duration-75" 
                               x-transition:leave-start="transform opacity-100 scale-100" 
                               x-transition:leave-end="transform opacity-0 scale-95" 
                               class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48"
                               x-cloak>
                <div class="px-2 py-2 text-gray-800 capitalize bg-white rounded-md shadow">
                  <a href="{{ route('app.leave.applications')}}" class="flex justify-between px-4 py-2 mt-2 text-sm bg-transparent rounded md:mt-0 hover:text-gray-900 hover:bg-gray-200">
                    <span>Leave</span>
                    <span> ( @isset($leave){{ $leave }} @endisset )</span>
                  </a>
                  <div class="border-t border-gray-100"></div>
                  <a href="{{ route('app.receiveletter.applications')}}" class="flex justify-between px-4 py-2 mt-2 text-sm bg-transparent rounded md:mt-0 hover:text-gray-900 hover:bg-gray-200">
                    <span>Letters</span>
                    <span> ( @isset($letter){{ $letter }} @endisset )</span>
                  </a>
                  <div class="border-t border-gray-100"></div>
                    <a href="{{ route('app.workflow.applications')}}" class="flex justify-between px-4 py-2 mt-2 text-sm bg-transparent rounded md:mt-0 hover:text-gray-900 hover:bg-gray-200" >
                      <span>Workflow</span>
                      <span> ( @isset($workflow){{ $workflow }} @endisset )</span>
                    </a>
                </div>
            </div>
          </div> 
        
          <!-- Profile  Menu-->
          <div @click.away="open = false" class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center w-20 md:w-full">
              <div class="flex items-center space-x-2">
                @isset(Auth::user()->name)
                <h2 class="hidden text-sm sm:block">{{ __(Auth::user()->name) }}</h2>
                <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
              @endisset
              </div>
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-100" 
                              x-transition:enter-start="transform opacity-0 scale-95" 
                              x-transition:enter-end="transform opacity-100 scale-100" 
                              x-transition:leave="transition ease-in duration-75" 
                              x-transition:leave-start="transform opacity-100 scale-100" 
                              x-transition:leave-end="transform opacity-0 scale-95" 
                              class="absolute right-0 z-50 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48"
                              x-cloak>
              <div class="px-2 py-2 capitalize bg-white rounded-md shadow">
                <a class="block py-2 mt-2 text-sm text-gray-900 bg-transparent rounded md:px-4 md:mt-0 hover:bg-gray-200" 
                    href="{{ route('profile.show') }}">Profile
                </a>

                <div class="border-t border-gray-100"></div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a class="text-sm text-gray-800 md:px-4" href="{{ route('logout') }}" onclick="event.preventDefault();
                                      this.closest('form').submit();">
                    {{ __('Log Out') }}
                  </a>
                </form>
              </div>
            </div>
          </div> 
      </div>
    </nav>
  </div>