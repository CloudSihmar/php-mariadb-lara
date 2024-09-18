<?php

namespace App\Http\Livewire;

use App\Models\Admin\Conferencehall;
use Livewire\Component;
use App\Models\Conferencehallbooking;
use PDF;
use Illuminate\Support\Facades\Session;


class BookingReports extends Component
{

  public $bookings;
  public $hall_id;
  public $start_at;
  public $end_at;
  
  /**
   * mount
   * @return void
   */
  function mount(){
    $this->bookings = Conferencehallbooking::latest()->take(3)->get();
    Session::put('bookings', $this->bookings);
  }
    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        $conferencehalls = Conferencehall::all();
        return view('livewire.booking-reports.index', compact('conferencehalls'));
    }

  
    /**
     * search
     *
     * @return void
     */
  public function search()
  {
    $this->validate([
      'start_at' => 'required',
      'end_at' => 'required',
    ], [
      'start_at.required' => 'Please select start date',
      'end_at.required' => 'Please select end date',
    ]);

    $start_time = $this->start_at;
    $end_time = $this->end_at; 
    
    $this->bookings =  Conferencehallbooking::where('hall_id', 'LIKE', '%' . "$this->hall_id" . '%')
    ->where(function ($query) use ($start_time, $end_time) {
      $query
        ->whereBetween('start_at', [$start_time, $end_time])
        ->orWhere(function ($query) use ($start_time, $end_time) {
          $query
            ->whereBetween('end_at', [$start_time, $end_time]);
        });
    })->get();

    Session::put('start_at', $this->start_at);
    Session::put('end_at', $this->end_at);
    Session::put('bookings', $this->bookings);
  }


    /**
     * download application in pdf format
     */
  public function downloadPdf()
  {
    $start_at = Session::get('start_at');
    $end_at = Session::get('end_at');
    $bookings = Session::get('bookings');

    $pdf = PDF::loadView(
      'livewire.booking-reports.pdf',
      compact('bookings', 'start_at', 'end_at'),
      [],
      [
        'title' => 'Conference Booking Report',
        'format' => 'A4-P',
        'orientation' => 'P'
      ]
    );
    return $pdf->stream('conference_booking_report.pdf');
  }
    
  }
