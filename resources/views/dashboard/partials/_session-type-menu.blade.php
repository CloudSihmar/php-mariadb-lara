  
  <!-- Breadcrumb -->
  <nav class="flex px-5 py-3 mt-4 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
      <li>
        <div class="flex items-center text-yellow-500">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
          </svg>
          <a href="{{ route('app.list.sessions')}}" class="ml-1 font-medium text-gray-700 hover:text-gray-900 md:ml-2">Session Documents</a>
        </div>
      </li>
      <li aria-current="page">
        <div class="flex items-center">
          <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
          <span class="ml-1 text-gray-700 md:ml-2">{{ \App\Models\Admin\Parliamentsession::findOrFail($sID)->name}}</span>
        </div>
      </li>
    </ol>
  </nav>
    
  <div class="p-6 mt-4 bg-white border border-gray-100 rounded">
    <!--  Documents -->
    <div class="flex flex-col items-center gap-4 md:flex-row">
      <!-- NA Sittings -->
        @can(['na.session.documents'])
          <a href="{{ route('app.na.session.documents',[$sID,1])}}" class="flex items-center w-full row md:w-1/2">
            <div class="px-2 py-1 text-white bg-yellow-500 rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
              </svg>
            </div>
            <div class="ml-3">
                NA Sitting Documents
            </div>
          </a>
        @endcan

          <!-- Joint sitting documents -->
        @can(['joint.sitting.documents'])
          <a href="{{ route('app.joint.sitting.documents',[$sID,1])}}" class="flex items-center w-full row md:w-1/2">
            <div class="px-2 py-1 text-white bg-yellow-500 rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
              </svg>
            </div>
            <div class="ml-3">
                <p>Joint Sitting Documents</p>
            </div>
          </a>
        @endcan
    </div>
  </div>