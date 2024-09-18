<div class="w-full p-6 mx-auto mt-4 rounded shadow bg-gray-50">
  <div class="w-full mx-auto">
    <div class="grid grid-cols-1 gap-4 mx-4 md:grid-cols-2 lg:grid-cols-3">
      <!-- Mark Attendance -->
      @can(['attendance'])
        <a href="{{ route('app.attendance.applications')}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
          <i class="fa fa-fingerprint"></i></span> 
          </div>
          <div class="ml-3">
            <p>Attendance</p>
            <p class="text-xs">Mark Your Attendance</p>
          </div>
        </a>
      @endcan

      @can(['leave'])
        <a href="{{ route('app.leave.applications')}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
            <i class="fa fa-file-signature"></i>
          </div>
          <div class="ml-3">
              <p>Leave</p>
              <p class="text-xs">Leave for employees</p>
          </div>
        </a>
      @endcan  

      <!-- conferance booking -->
      @can('conference.hall.booking')  
        <a href="{{ route('app.conference.hall.booking')}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
            <i class="fa fa-hotel"></i>
          </div>
          <div class="ml-3">
            <p> Conference Hall Booking</p>
            <p class="text-xs"> Book conference hall here</p>
          </div>
        </a>
      @endcan

      <!-- Letters -->
      @can(['dispatch.letter','receive.letter'])
        <a href="{{ route('app.receiveletter.applications')}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
            <i class="fa fa-mail-bulk"></i>
          </div>
          <div class="ml-3">
              <p> Letters</p>
              <p class="text-xs"> Receive and dispatch letters</p>
          </div>
        </a>
      @endcan
  
      <!-- workflow -->
      @can(['workflow'])
        <a href="{{ route('app.workflow.applications')}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
            <i class="fa fa-bezier-curve"></i>
          </div>
          <div class="ml-3">
            <p> Workflow</p>
            <p class="text-xs"> Workflow</p>
          </div>
        </a>
      @endcan

      <!-- Member Attendance Report -->
      @can(['members.attendance.report'])
        <a href="{{ route('app.report.attendancereport.applications',9)}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
            <i class="ml-1 mr-1 fa fa-chalkboard-teacher"></i> 
          </div>
          <div class="ml-3">
              <p> Member Attendance Report</p>
              <p class="text-xs"> View Parliament Members Attendance Report</p>
          </div>
        </a> 
      @endcan

      <!-- Secretariat Attendance Report -->
      @can(['secretariat.attendance.report'])
        <a href="{{ route('app.report.attendancereport.applications',0)}}" class="flex items-center row outline-btn-cyan ">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
            <i class="ml-1 mr-1 text-lg fa fa-chalkboard-teacher"></i> 
          </div>
          <div class="ml-3">
              <p> Secretariat Attendance Report</p>
              <p class="text-xs"> View Secretariat Attendance Report</p>
          </div>
        </a> 
      @endcan

      <!-- Leave report -->
      {{-- @can(['leave.report'])
        <a href="{{ route('app.leavereport.applications')}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
          <i class="ml-1 mr-1 text-lg fa fa-chair"></i> 
          </div>
          <div class="ml-3">
              <p> Leave Report</p>
              <p class="text-xs"> View Leave Report</p>
          </div>
        </a> 
      @endcan --}}

      <!-- Search Dispatch Letter Repor-->
      {{-- @can(['dispatched.report'])
        <a href="{{ route('app.searchdispatchletter.applications')}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
          <i class="ml-1 mr-1 text-lg fa fa-search"></i> 
          </div>
          <div class="ml-3">
              <p> Search Dispatch</p>
              <p class="text-xs"> Search Dispatch Letter</p>
          </div>
        </a> 
      @endcan --}}
    
      <!-- Search Receive Letter Report-->
      {{-- @can(['received.report'])
        <a href="{{ route('app.searchreceiveletter.applications')}}" class="flex items-center row outline-btn-cyan">
            <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
            <i class="ml-1 mr-1 text-lg fa fa-search"></i> 
            </div>
            <div class="ml-3">
                <p> Search Receive</p>
                <p class="text-xs"> Search Receive Letter</p>
            </div>
        </a> 
      @endcan --}}

      
      <!-- Secretariat Daily Attendancer Report-->
      {{-- @can(['secretariat.dailyattendancereport'])
        <a href="{{ route('app.report.attendancereport.applications',10)}}" class="flex items-center row outline-btn-cyan ">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
            <i class="ml-1 mr-1 text-lg fa fa-chalkboard-teacher"></i> 
          </div>
          <div class="ml-3">
              <p> Daily Attendance Report</p>
              <p class="text-xs"> Daily Secretariat Attendance Report</p>
          </div>
        </a> 
      @endcan --}}
      
    </div>
  </div>
</div>

<div class="w-full p-6 mx-auto mt-4 rounded shadow bg-gray-50">
  <!--  Documents -->
  <div class="grid grid-cols-1 gap-4 mx-4 md:grid-cols-2 lg:grid-cols-3">
      <!-- session documents -->
      @can(['session.documents'])
        <a href="{{ route('app.list.sessions')}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white bg-yellow-500 rounded-lg">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
              </svg>
          </div>
          <div class="ml-3">
              Session Documents
          </div>
        </a>
      @endcan

      <!-- committee documents -->
      @can(['committee.documents'])
        <a href="{{ route('app.committee.documents')}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white bg-yellow-500 rounded-lg">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
              </svg>
          </div>
          <div class="ml-3">
              <p>Committee Documents</p>
          </div>
        </a>
      @endcan

        <!-- Secretariat -->
      @can(['secretariat.documents'])
        <a href="{{ route('app.secretariat.documents')}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white bg-yellow-500 rounded-lg">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
              </svg>
          </div>
          <div class="ml-3">
            <p> Secretariat Documents</p>
          </div>
        </a>
      @endcan

      <!-- Archives -->
      @can(['archive.view'])
        <a href="{{ route('app.session.document.archives',1)}}" class="flex items-center row outline-btn-cyan">
          <div class="px-2 py-1 text-white bg-yellow-500 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>
          </div>
          <div class="ml-3">
              <p> Archives</p>
              <p class="text-xs"> View past documents here</p>
          </div>
        </a>
      @endcan
  </div>
</div>