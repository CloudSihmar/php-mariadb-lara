<div class="min-h-screen bg-gray-100 rounded-r">
  <div class="sidebar min-h-screen w-[3.35rem] overflow-hidden border-r hover:w-72 hover:bg-white hover:shadow-lg">
    <div class="flex flex-col h-screen pt-2 pb-10">
        <ul class="pb-2 space-y-2 text-sm tracking-wide">
          <!-- Leave Management -->
          <li class="min-w-max">
            <a href="{{ route('app.leave.applications')}}" class="flex items-center mx-1 group menu-item">
              <i class="mr-2 fa fa-clock fa-lg"></i>
              <span class="group-hover:text-gray-700">Leave</span>
            </a>
          </li>
          <!-- Attendance Management -->
          <li class="min-w-max">
            <a href="{{ route('app.attendance.applications')}}" class="flex items-center mx-1 group menu-item">
               <i class="mr-2 fa fa-fingerprint fa-lg"></i> 
              <span class="group-hover:text-gray-700">Attendance</span>
            </a>
          </li>
           <!-- Letter Management -->
          <li class="min-w-max">
            <a href="{{ route('app.displatchletter.applications')}}" class="flex items-center mx-1 group menu-item">
              <i class="mr-2 fa fa-envelope fa-lg"></i> 
              <span class="group-hover:text-gray-700">Letters</span>
            </a>
          </li>
           <!-- Work Flow -->
          <li class="min-w-max">
            <a href="{{ route('app.workflow.applications')}}" class="flex items-center mx-1 group menu-item">
              <i class="fa fa-sitemap fa-lg"></i>
              <span class="group-hover:text-gray-700">Work Flow</span>
            </a>
          </li>
              <!--  Session Documents -->
           <li class="min-w-max">
            <a href="{{ route('app.list.sessions')}}" class="flex items-center mx-1 group menu-item">
              <i class="mr-2 fa fa-book fa-lg"></i>
              <span class="group-hover:text-gray-700">Sessions Documents</span>
            </a>
          </li>
          <!-- Committee Documents -->
           <li class="min-w-max">
            <a href="{{ route('app.committee.documents')}}" class="flex items-center mx-1 group menu-item">
              <i class="fa fa-user-friends fa-lg"></i>
              <span class="group-hover:text-gray-700">Committee Documents</span>
            </a>
          </li>

           <!-- Secretariat Documents -->
           <li class="min-w-max">
            <a href="{{ route('app.secretariat.documents')}}" class="flex items-center mx-1 group menu-item">
              <i class="mr-2 fa fa-book fa-lg"></i>
              <span class="group-hover:text-gray-700">Secretariat Documents</span>
            </a>
          </li>

           <!-- Archives Documents -->
           <li class="min-w-max">
            <a href="{{ route('app.session.document.archives',1)}}" class="flex items-center mx-1 group menu-item">
              <i class="mr-2 fa fa-archive fa-lg"></i>
              <span class="group-hover:text-gray-700">Document Archives</span>
            </a>
          </li>

           <!-- Conference Hall Booking -->
           <li class="min-w-max">
            <a href="{{ route('app.conference.hall.booking')}}" class="flex items-center mx-1 group menu-item">
              <i class="mr-2 fa fa-building fa-lg"></i>
              <span class="group-hover:text-gray-700">Conference Hall Booking</span>
            </a>
          </li>
        </ul>
        
        <!--  System Settings -->
      {{-- <ul class="pb-2 space-y-2 text-sm tracking-wide">
        <li class="min-w-max">
          <a href="{{ route('admin.settings')}}" class="flex items-center mx-1 group menu-item">
            <i class="fa fa-cogs fa-lg"></i>
            <span class="text-sm font-medium uppercase group-hover:text-gray-700">System Settings</span>
          </a>
        </li>  
      </ul> --}}
    </div>
  </div>
</div>