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
            <p>Attendances</p>
            <p class="text-xs">Mark Your Attendance</p>
          </div>
        </a>
      @endcan
@can(['manage'])
<a href="{{ route('admin.users')}}" class="flex items-center row outline-btn-cyan">
    <div class="px-2 py-1 text-white rounded-lg bg-blue-400">
<i class="fa fa-fingerprint"></i></span>
    </div>
    <div class="ml-3">
        <p>Manage Users</p>
        <p class="text-xs text-cyan-800">Manage and edit users</p>
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
      <!-- 
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
-->

      <!-- Secretariat Attendance Report -->
      @can(['secretariat.attendance.report'])
        <a href="{{ route('app.report.attendancereport.applications',0)}}" class="flex items-center row outline-btn-cyan ">
          <div class="px-2 py-1 text-white rounded-lg bg-cyan-600">
            <i class="ml-1 mr-1 text-lg fa fa-chalkboard-teacher"></i> 
          </div>
          <div class="ml-3">
              <p> Staff Attendance Report</p>
              <p class="text-xs"> View Staff Attendance Report</p>
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

