<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Livewire\Admin\Committeetypes;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\Admin\Roles;
use App\Http\Livewire\Admin\Parliaments;
use App\Http\Livewire\Admin\Parliamentsessions;
use App\Http\Livewire\Admin\Agencies;
use App\Http\Livewire\Admin\Committeemembers;
use App\Http\Livewire\Admin\Committees;
use App\Http\Livewire\Admin\Departments;
use App\Http\Livewire\Admin\Divisions;
use App\Http\Livewire\Admin\DivisionSubfolders;
use App\Http\Livewire\Admin\LeaveCategories;
use App\Http\Livewire\Admin\Conferencehalls;
use App\Http\Livewire\Admin\SessiondocCategories;
use App\Http\Livewire\Admin\SessiondocumentSubCategories;
use App\Http\Livewire\Admin\Weblinkcategories;
use App\Http\Livewire\Admin\Weblinks;
use App\Http\Livewire\Admin\Fileindexes;
use App\Http\Livewire\Admin\Constituencies;
use App\Http\Livewire\Admin\Ipranges;
use App\Http\Livewire\Admin\Dzongkhags;
use App\Http\Livewire\Admin\JointsessionDocumentCategories;
use App\Http\Livewire\Admin\JointSessiondocumentSubCategories;
use App\Http\Livewire\Admin\PositionTitles;
use App\Http\Livewire\Admin\PositionLevels;
use App\Http\Livewire\Admin\ManageConferencehallbookings;

//app routes
use App\Http\Livewire\Leaveapplications;
use App\Http\Livewire\Conferencehallbookings;
use App\Http\Livewire\Workflows;
use App\Http\Livewire\Dispatchletters;
use App\Http\Livewire\LeaveBalances;
use App\Http\Livewire\Attendances;
use App\Http\Livewire\CommitteedocumentArchives;
use App\Http\Livewire\CommitteesubdocumentArchives;
use App\Http\Livewire\Committeedocuments;
use App\Http\Livewire\Committeesubdocuments;
use App\Http\Livewire\Receiveletters;
use App\Http\Livewire\Holidays;
use App\Http\Livewire\SessiondocumentArchives;
use App\Http\Livewire\SessiondocumentsubfolderArchives;
use App\Http\Livewire\Sessiondocuments;
use App\Http\Livewire\Sessiondocumentsubfolders;
use App\Http\Livewire\Secretariatdocuments;
use App\Http\Livewire\Secretariatsubdocuments;
use App\Http\Livewire\SecretariatdocumentArchives;
use App\Http\Livewire\AttendanceReports;
use App\Http\Livewire\WorkflowCreateUpdate;
use App\Http\Livewire\LeaveReports;
use App\Http\Livewire\BookingReports;
use App\Http\Livewire\SearchDispatchLetters;
use App\Http\Livewire\SearchReceiveLetters;
use App\Http\Livewire\InternalWeblinks;
use App\Http\Livewire\WorkflowViewExport;
use App\Http\Livewire\WorkflowReports;
use App\Http\Livewire\JoinsittingdocumentArchives;
use App\Http\Livewire\Joinsittingdocuments;
use App\Http\Livewire\JointsittingSubdocuments;
use App\Http\Livewire\Acts;

/*
|--------------------------------------------------------------------------
| Localisation
|--------------------------------------------------------------------------
*/
Route::get('/locale/{locale}', [FrontendController::class, 'langSwitcher'])->name('lang.switcher');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [FrontendController::class, 'landing'])->name('landing');
Route::get('/about', [FrontendController::class, 'about'])->name('about');


/*---------------------------------------------------------------------------------------
  | Route for admin user class
  |--------------------------------------------------------------------------------------*/
Route::prefix('admin')->middleware('auth','role:admin')->name('admin.')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
  Route::get('/settings', [DashboardController::class, 'adminSettings'])->name('settings');

  //   livewire routes
  Route::get('/users', Users::class)->name('users');
  Route::post('/users/fetch-department', [Users::class, 'fetchDepartment']);
  Route::post('/users/fetch-division', [Users::class, 'fetchDivision']);
  Route::post('/users/fetch-constituency', [Users::class, 'fetchConstituency']);
  Route::get('/roles', Roles::class)->name('roles');

  Route::get('/tech', Parliaments::class)->name('parliament');
  Route::get('/parliament-sessions/{pID}', Parliamentsessions::class)->name('parliament.session');
  Route::get('/conference-hall', Conferencehalls::class)->name('conference.hall');
  Route::get('/manage-conference-hall-bookings', ManageConferencehallbookings::class)->name('manage.conference.hall.booking');
  
  Route::get('/session-document-categories', SessiondocCategories::class)->name('session.document.categories');
  Route::get('/session-document-sub-folders/{catID}', SessiondocumentSubCategories::class)->name('session.doc.subfolders');
  Route::get('/joint-sitting-document-categories', JointsessionDocumentCategories::class)->name('joint.session.document.categories');
  Route::get('/joint-sitting-document-sub-folders/{dirID}', JointSessiondocumentSubCategories::class)->name('joint.session.doc.subfolders');

  Route::get('/parliament-committees/{pID}', Committees::class)->name('parliament.committees');
  Route::get('/committee-members/{parID}/{cID}', Committeemembers::class)->name('committee.members');

  //  Added 
  Route::get('/attendances', Attendances::class)->name('attendances');
  Route::get('/conference-hall', Conferencehalls::class)->name('conference.hall');
  Route::get('/leavecategory', LeaveCategories::class)->name('leavecategory');
  Route::get('/agency', Agencies::class)->name('agencies');
  Route::get('/agency/departments/{agencyID}', Departments::class)->name('agency.departments');
  Route::get('/agency/department/divisions/{deptID}', Divisions::class)->name('department.divisions');
  Route::get('/agency/department/divisions/folders/{divID}', DivisionSubfolders::class)->name('division.subfolders');
  
  //Position Title & Level
  Route::get('/positiontitles', PositionTitles::class)->name('positiontitles');
  Route::get('/positionlevels', PositionLevels::class)->name('positionlevels');
  
  //Constituency
  Route::get('/constituencies', Constituencies::class)->name('constituencies');
  Route::get('/iprange', Ipranges::class)->name('iprange');

  //Dzongkhag
  Route::get('/dzongkhags', Dzongkhags::class)->name('dzongkhags');
  
  //weblinks
  Route::get('/web-link-categories', Weblinkcategories::class)->name('weblink.categories');
  Route::get('/web-link/category/{cat_id}', Weblinks::class)->name('web.link');
  Route::get('/file-indexes', Fileindexes::class)->name('file.indexes');

});

/*---------------------------------------------------------------------------------------
  | Route for secretariat and member user class
  |--------------------------------------------------------------------------------------*/
Route::prefix('user')->middleware('auth')->name('user.')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

});

/*---------------------------------------------------------------------------------------
  | Route for Common user class
  |--------------------------------------------------------------------------------------*/

Route::prefix('tech')->middleware('auth')->name('app.')->group(function () {
  Route::get('/sessions', [DashboardController::class, 'ListSessions'])->name('list.sessions');
  Route::get('/sessions/type/{sid}', [DashboardController::class, 'ListSessionType'])->name('session.type');

  Route::get('/leave-application', Leaveapplications::class)->name('leave.applications');
  Route::get('/attendance', Attendances::class)->name('attendance.applications')->middleware('blockIP');
  Route::get('/attendance', Attendances::class)->name('attendance.applications');
  Route::get('/dispatch-letter', Dispatchletters::class)->name('displatchletter.applications');
  Route::get('/receive-letter', Receiveletters::class)->name('receiveletter.applications');
  Route::get('/leave-balance', LeaveBalances::class)->name('leavebalance.applications');
  Route::get('/holidays', Holidays::class)->name('holiday.applications');
  
  Route::get('/work-flows', Workflows::class)->name('workflow.applications');
  Route::get('/work-flow/create', WorkflowCreateUpdate::class)->name('workflow.create');
  Route::get('/work-flow/edit/{id}', WorkflowCreateUpdate::class)->name('workflow.edit');
  Route::get('/work-flow/view/{id}', WorkflowViewExport::class)->name('workflow.view');
  Route::get('/work-flow/view/export/pdf/{tempID}', [WorkflowViewExport::class, 'exportPDF'])->name('pdf.workflow');
  
  #Work-flow-report
  Route::get('/workflow-report', WorkflowReports::class)->name('workflow.report.applications');
  Route::get('/workflow-report/pdf', [WorkflowReports::class, 'downloadPdf'])->name('pdf.workflow.report');

  #leave-balance-report
  Route::get('/leave-balance-report/pdf', [LeaveBalances::class,'downloadPdf'])->name('pdf.leavebalance.report');

  #Secretariat AttendanceReports
  Route::get('/attendance-report', AttendanceReports::class)->name('attendancereport.applications');
  Route::post('/attendance-report/search', [AttendanceReports::class,'search'])->name('search.attendancereport.applications');
  Route::get('/attendance-report/pdf', [AttendanceReports::class, 'downloadPdf'])->name('pdf.attendance.report');
  Route::get('/attendance-report/{catID}', AttendanceReports::class)->name('report.attendancereport.applications');
  Route::get('/daily-attendance-report/pdf', [AttendanceReports::class, 'exportdailyreportPdf'])->name('pdf.dailyattendancereport.report');

  #Members AttendanceReports
  Route::get('/member-attendance-report', AttendanceReports::class)->name('memberattendancereport.applications');
  Route::get('/member-attendance-report/pdf', [AttendanceReports::class, 'downloadMemberPdf'])->name('pdf.memberattendancereport.report');
  Route::get('/member-attendance-report/{catID}', AttendanceReports::class)->name('report.memberattendancereport.applications');

  Route::get('/memberattendance-report/pdf', [Attendances::class, 'memberPdf'])->name('pdf.member-attendance-report.report');
  Route::get('/members-report/pdf', [Attendances::class, 'memberreportPdf'])->name('pdf.members-report.report');

  Route::get('/members-export-report/pdf', [AttendanceReports::class, 'memberexportreportPdf'])->name('pdf.membersexport.report');

  Route::get('/leave-report', LeaveReports::class)->name('leavereport.applications');
  Route::post('/leave-report/search', [LeaveReports::class,'search'])->name('search.leavereport.applications');
  Route::get('/leave-report/pdf', [LeaveReports::class, 'downloadPdf'])->name('pdf.leave.report');

  Route::post('/fetch-department', [Users::class, 'fetchDepartment']);
  Route::post('/fetch-division', [Users::class, 'fetchDivision']);
  Route::post('/fetch-staff', [Users::class, 'fetchStaff']);
  Route::post('/users/fetch-constituency', [Users::class, 'fetchConstituency']);

    //Conference hall Booking 
  Route::get('/conference-hall-booking', Conferencehallbookings::class)->name('conference.hall.booking');
  Route::delete('conference-hall-booking/destroy/{id}', [Conferencehallbookings::class, 'destroy'])->name('booking.destroy');
  Route::get('/booking-report', BookingReports::class)->name('booking.report');
  Route::post('/booking-report/search', [BookingReports::class, 'search'])->name('search.bookings');
  Route::get('/booking-report/pdf', [BookingReports::class, 'downloadPdf'])->name('pdf.booking.report');

  //search letter
  Route::get('/search-dispatch', SearchDispatchLetters::class)->name('searchdispatchletter.applications');
  Route::get('/search-receive', SearchReceiveLetters::class)->name('searchreceiveletter.applications');
  
  //Letter export pdf
  Route::get('/search-dispatch/pdf', [SearchDispatchLetters::class, 'downloadPdf'])->name('pdf.searchdispatchletter.report');
  Route::get('/search-receive/pdf', [SearchReceiveLetters::class, 'downloadPdf'])->name('pdf.searchreceiveletter.report');

  // documents
  Route::get('/committee-documents', Committeedocuments::class)->name('committee.documents');
  Route::get('/committee/members/{committeeID}', [Committeedocuments::class, 'memberProfile'])->name('committee.member.profile');
  Route::get('/committee-documents/sub-folder/{parID}/{comID}/{subdirID}', Committeesubdocuments::class)->name('committee.subfolder.documents');
  Route::get('/committee-documents-archive/{parID}', CommitteedocumentArchives::class)->name('committee.document.archives');
  Route::get('/committee-documents-archive/sub-folder/{parID}/{comID}/{subdirID}', CommitteesubdocumentArchives::class)->name('committee.subfolder.documents.archive');

  //Session Documents
  Route::get('/na-session-documents/{sID}/{catID}', Sessiondocuments::class)->name('na.session.documents');
  Route::get('/session-documents/sub-folder/{sID}/{catID}/{subCatID}', Sessiondocumentsubfolders::class)->name('subfolder.na.session.documents');
  
  Route::get('/archives', SessiondocumentArchives::class)->name('archives');
  Route::get('/session-documents-archive/{catID}', SessiondocumentArchives::class)->name('session.document.archives');
  Route::get('/session-documents-archive/sub-folder/{parID}/{sID}/{catID}/{subCatID}', SessiondocumentsubfolderArchives::class)->name('subfolder.session.document.archives');
  
  //Join Sititng Documents
  Route::get('/joint-sitting-documents/{sID}/{dirID}', Joinsittingdocuments::class)->name('joint.sitting.documents');
  Route::get('/joint-sitting-documents/sub-folder/{sID}/{dirID}/{subdirID}', JointsittingSubdocuments::class)->name('subfolder.joint.session.documents');
  Route::get('/joint-sitting-documents-archive/{dirID}', JoinsittingdocumentArchives::class)->name('joint.sitting.document.archives');


 //act documents
  Route::get('/acts', Acts::class)->name('acts');

//Secretariat Documents
  Route::get('/secretariat-documents', Secretariatdocuments::class)->name('secretariat.documents');
  Route::get('/secretariat-documents/sub-folder/{parID}/{divID}/{subdirID}', Secretariatsubdocuments::class)->name('secretariat.subfolder.documents');
  Route::get('/secretariat-documents-archive/{catID}', SecretariatdocumentArchives::class)->name('secretariat.document.archives');
  //Web Links
  Route::get('/weblinks', InternalWeblinks::class)->name('weblink.applications');
});
