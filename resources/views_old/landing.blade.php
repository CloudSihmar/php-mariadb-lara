
<x-guest-layout>
  <div class="md:mt-20 justify-center sm:items-center sm:pt-0 py-20">
    <div class="container mx-auto flex-wrap h-full md:px-10 lg:px-40 text-gray-800">
      <div class="block shadow rounded-lg">
        <div class="flex flex-wrap w-full">
          <div class="w-full md:w-6/12 lg:rounded-l-lg rounded-b-lg lg:rounded-br-none bg-no-repeat bg-center bg-cover" style="background-image: url('../assets/img/na-hall.jpeg')"></div>
          <div class="mt-2 md:mt-0 w-full md:w-6/12 px-4 md:px-0 ">
        {{-- <x-jet-validation-errors class="mb-4" /> --}}

            <div class="p-2 md:py-6 md:mx-6">
                @if (session('status'))
                  <div class="mb-4 font-medium text-sm text-green-600">
                      {{ session('status') }}
                  </div>
              @endif
              <!-- Form -->
              <form method="POST" action="{{ route('login') }}">
                  @csrf
                <p class="mb-4 text-xs uppercase font-bold">{{ __('Please login to your account') }}</p>
                   <div>
                      <x-jet-label class="{{ app()->getLocale()=='dz' ? 'font-dz text-lg' : 'text-xs uppercase font-bold' }}" for="username" value="{{ __('Username') }}" />
                      <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
                      <x-jet-input-error for="username" class="mt-2" />
                    </div>

                  <div class="mt-4">
                      <div class="py-2" x-data="{ show: true }">
                        <x-jet-label class="{{ app()->getLocale()=='dz' ? 'font-dz text-lg' : 'text-xs uppercase font-bold' }}" for="password" value="{{ __('Password') }}" />
                        <div class="relative">
                          <input id="password" name="password" :type="show ? 'password' : 'text'" class="text-md px-3 py-2 rounded-lg w-full" required autocomplete="current-password">
                          <div class="absolute inset-y-0 right-0 flex items-center text-sm p-2">
                            <i class="fa fa-eye fa-lg" @click="show = !show" :class="{'hidden': !show, 'block':show }"></i>
                            <i class="fa fa-eye-slash fa-lg" @click="show = !show" :class="{'block': !show, 'hidden':show }"></i>
                          </div>
                          <x-jet-input-error for="password" class="mt-2" />
                        </div>
                      </div>
                  </div>

                  <div class="block mt-4">
                      <label for="remember_me" class="flex items-center">
                          <x-jet-checkbox id="remember_me" name="remember" />
                          <span class="ml-2 {{ app()->getLocale()=='dz' ? 'font-dz text-lg' : 'text-sm' }} text-gray-600">{{ __('Remember me') }}</span>
                      </label>
                  </div>

                  <div class="my-4">
                      @if (Route::has('password.request'))
                          <a class="underline {{ app()->getLocale()=='dz' ? 'font-dz text-lg' : 'text-sm' }} text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                              {{ __('Forgot your password?') }}
                          </a>
                      @endif

                      <x-jet-button class="mt-2 w-full px-4 bg-blue-500 hover:bg-blue-700 justify-center {{ app()->getLocale()=='dz' ? 'font-dz text-xl' : 'text-sm' }}">
                          {{ __('Log in') }}
                      </x-jet-button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
