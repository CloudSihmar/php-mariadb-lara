<?php

namespace App\Http\Controllers;

use App\Models\Admin\Parliament;

class DashboardController extends Controller
{
  public $totalNotification;
  /**
   * dashboard
   *
   * @return void
   */

  public function render()
  {
    return view('dashboard.admin-dashboard');
  }

  public function adminDashboard()
  {
    return view('dashboard.admin-dashboard');
  }

  // /**
  //  * sessionDocumentMenu
  //  * @return void
  //  */
  public function ListSessions()
  {
    $currentParliament = Parliament::latest()->first();
    $parliamentsessions = $currentParliament->parliamentsessions;
    return view('dashboard.session-list', compact('parliamentsessions'));
  }

  /**
   * sessionDocumentMenu
   * @return void
   */
  public function ListSessionType($sID)
  {
    return view('dashboard.session-type', compact('sID'));
  }


  // public function ListCommittes()
  // {
  //   $currentParliament = Parliament::latest()->first();
  //   $committees = $currentParliament->committees;
  //   return view('dashboard.list-committes', compact('committees'));
  // }
  
  /**
   * adminSettings
   * @return void
   */
  public function adminSettings()
  {
    return view('dashboard.admin-settings');
  }
  
  /**
   * secretariatDashboard
   * @return void
   */
  public function dashboard()
  {
    $this->totalNotification = 10;
    return view('dashboard.user-dashboard');
  }

  /**
   * sessionDocuments
   * @return void
   */
  public function sessionDocuments()
  {
    return view('livewire.sessiondocuments.agenda');
  }


  /**
   * sessionAgenda
   * @return void
   */
  public function sessionAgenda()
  {
    return view('livewire.sessiondocuments.agenda');
  }

  /**
   * businessOrder
   * @return void
   */
  public function sessionOrderBusinesss()
  {
    return view('livewire.sessiondocuments.business-order');
  }
  
  
}
