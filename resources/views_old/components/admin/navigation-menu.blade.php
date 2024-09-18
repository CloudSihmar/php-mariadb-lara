<!-- component -->
    <nav class="grid grid-cols-1 md:grid-cols-3 gap-2 bg-gray-100 items-center md:px-10">
        <div class="text-center sm:text-left py-2">
          <a href="{{ route('admin.dashboard')}}" class="{{ app()->getLocale()=='dz' ? 'font-dz text-xl' : 'font-base' }} w-full rounded px-4 py-2">
           <i class="fa fa-home"></i> {{ __('Home') }}
           <span class="ml-2 font-medium"> ({!! getCurrentParliament()->name !!})</span>
          </a>  
        </div>

        <!-- User Status -->
        <div class="hidden md:block px-4 py-2 text-sm font-bold text-green-600 uppercase text-center">
          <?php try{ ?> 
              @php $userstatusDtl = \App\Models\User::with('userstatus')->where('id', auth()->user()->id)->get()->first() @endphp  
            <?php }catch(\Exception $e){ ?>
            <?php } ?>

            @isset($userstatusDtl)
              Status: {{ !empty($userstatusDtl->userstatus->name) ? $userstatusDtl->userstatus->name:'-'}}
            @endisset
        </div>

        <!-- menu -->
        <div class="flex items-center justify-end gap-4 z-40">

            <!-- Report  Menu-->
              <div @click.away="open = false" class="relative z-40 " x-data="{ open: false }">
                <button @click="open = ! open" type="button" class="group p-4 inline-flex items-center font-medium rounded-md text-sm hover:text-gray-700" aria-expanded="false">
                    <span>Reports</span>
                    <svg :class="{'rotate-180 duration-300': open, 'duration-300' : !open}" class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div 
                    x-show="open" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="absolute sm:left-1/2 z-full mt-3 w-screen max-w-md sm:-translate-x-1/2 transform px-2 sm:px-0"
                    x-cloak>

                    <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                      <a href="{{ route('app.leavereport.applications')}}" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                        <i class="fa fa-angle-double-right mt-1"></i>
                        <div class="ml-4">
                            <p class="text-base font-medium text-gray-900">Leave Report</p>
                            <p class="mt-1 text-sm text-gray-500">Generate Leave report</p>
                        </div>
                      </a>

                      <a href="{{ route('app.report.attendancereport.applications',0)}}" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                         <i class="fa fa-angle-double-right mt-1"></i>
                        <div class="ml-4">
                            <p class="text-base font-medium text-gray-900"> Secretariat Attendance Report</p>
                            <p class="mt-1 text-sm text-gray-500">Attendance Report for Secretariat</p>
                        </div>
                      </a>

                      <a href="{{ route('app.report.attendancereport.applications',9)}}" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                        <i class="fa fa-angle-double-right mt-1"></i>
                        <div class="ml-4">
                            <p class="text-base font-medium text-gray-900">Members Attendance Report</p>
                            <p class="mt-1 text-sm text-gray-500">Attendance Report for Member of Parliament</p>
                        </div>
                      </a>

                      <a href="{{ route('app.searchdispatchletter.applications')}}" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                        <i class="fa fa-angle-double-right mt-1"></i>
                        <div class="ml-4">
                            <p class="text-base font-medium text-gray-900">Dispatched Letter Report</p>
                            <p class="mt-1 text-sm text-gray-500">Report on Letters Dispatched </p>
                        </div>
                      </a>

                      <a href="{{ route('app.searchreceiveletter.applications')}}" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                        <i class="fa fa-angle-double-right mt-1"></i>
                        <div class="ml-4">
                          <p class="text-base font-medium text-gray-900">Received Letter Report</p>
                          <p class="mt-1 text-sm text-gray-500">Report on Letters Received</p>
                        </div>
                      </a>

                      <a href="{{ route('app.workflow.report.applications')}}" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                        <i class="fa fa-angle-double-right mt-1"></i>
                        <div class="ml-4">
                            <p class="text-base font-medium text-gray-900">Workflow Report</p>
                            <p class="mt-1 text-sm text-gray-500">Report on Workflow</p>
                        </div>
                      </a>

                      <a href="{{ route('app.booking.report')}}" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                         <i class="fa fa-angle-double-right mt-1"></i>
                        <div class="ml-4">
                            <p class="text-base font-medium text-gray-900">Conference Hall Booking</p>
                            <p class="mt-1 text-sm text-gray-500">Report on Workflow</p>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

            <!-- Notification  Menu-->
            <div @click.away="open = false" class="relative" x-data="{ open: false }">
              <button @click="open = !open" class="flex items-end w-full px-4 py-2 rounded hover:text-gray-700">
                <div class="flex items-center "> <span class="mr-2 text-sm font-medium">{{ __('Notification') }} </span>
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