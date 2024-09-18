<?php

namespace App\Http\Livewire;

use App\Models\Admin\Conferencehall;
use App\Models\Conferencehallbooking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Conferencehallbookings extends Component
{
  public $booking;
  public $start_at;
  public $end_at;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'booking.hall_id' => 'required',
    'booking.purpose' => 'required',
    'start_at'  => 'required|date',
    'end_at'    => 'required|date|after:start_at',
  ];

  protected $messages = [
    'end_at.after'    => 'The end date must be greater than start date',
  ];

  public function render()
  {
    $conferencehalls = Conferencehall::all();
    $bookings = Conferencehallbooking::all();
    $events = [];
    foreach ($bookings as $booking) {
      $hall = Conferencehall::find($booking->hall_id);
      $hallname = isset($hall)? $hall->name :'Hall not found';
      $user = User::find($booking->user_id);
      $bookedby = isset($user) ? $user->name : 'User not found';	    
     $events[] = [
        'id' => $booking->id,
        'title' => $hallname. ' - booked by '.$bookedby.' for '.' - '.$booking->purpose,
        'start' => $booking->start_at,
        'end' => $booking->end_at,
        'booked_by' => $booking->user_id,
        'current_user' => Auth::user()->id,
      ];
    }

    return view('livewire.conferencehallbookings.index', compact('events', 'conferencehalls'))->layout(getLayout());
  }

  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    $start_time = $this->start_at;
    $end_time = $this->end_at; 
      $booking_exist =  Conferencehallbooking::where('hall_id',$this->booking['hall_id'])
      ->where(function ($query) use ($start_time, $end_time) {
        $query
          ->whereBetween('start_at', [$start_time, $end_time])
          ->orWhere(function ($query) use ($start_time, $end_time) {
            $query
              ->whereBetween('end_at', [$start_time, $end_time]);
          });
      })->count();

      if (!$booking_exist) {
          Conferencehallbooking::create([
            'hall_id' => $this->booking['hall_id'],
            'purpose' => $this->booking['purpose'],
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'user_id' => auth()->user()->id,
          ]);
          session()->flash('message', 'Conference hall booked!');
          $this->reset(['booking']);
          $this->confirmItemAdd = false;
          return redirect()->route('app.conference.hall.booking');
      }else{
      return redirect()->route('app.conference.hall.booking')->with('error', 'Conference hall already booked for the selected time slot.
       Please book another time slot!');
      }
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Conferencehallbooking $booking)
  {
    $this->booking = $booking;
    $this->confirmItemAdd = true;
  }

  /**
   * Display confim deletion modal.
   */
  public function showDeleteModal($id)
  {
    $this->confirmItemDeletion = $id;
  }
  
  /**
   * destroy
   * @param  mixed $id
   * @return $id
   */
  public function destroy($id)
  {
    $booking = Conferencehallbooking::find($id);
    if(Auth::user()->id == $booking->user_id){
    if (!$booking) {
      return response()->json([
        'error' => 'Unable to locate the event'
      ], 404);
    }
    $booking->delete();
    }
    return $id;
  }


  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['booking']);
  }

}
