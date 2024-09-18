 <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GOVACT') }}</title>

        <!-- Fonts -->
        <link href="{{ asset('fonts/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('fonts/fontawesome/css/solid.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/pikaday.css') }}" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 
              'resources/js/app.js'
              ])
        <!-- Styles -->
        <style>
          [x-cloak] {
            display: none;
          }
        </style>
        {{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css"> --}}
        {{-- @trixassets --}}
        @livewireStyles
        @stack('styles')
    </head>
