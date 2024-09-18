<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{

  public function landing()
  {
    return view('landing');
  }


  public function about()
  {
    return view('about');
  }


  /*
    |--------------------------------------------------------------------------
    | For language switcher
    |--------------------------------------------------------------------------
    **/
  public function langSwitcher(Request $request, $locale)
  {
    session(['APP_LOCALE' => $locale]);
    return back();
  }
}
