@if (session()->has('message'))
  <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 4000)">
    <div class="p-3 text-white bg-green-600 rounded">
        {{ session()->get('message') }}
    </div>
  </div>
@endif
