<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Conferencehall;
use App\Models\Conferencehallbooking;
use Livewire\Component;
use Livewire\WithPagination;

class ManageConferencehallbookings extends Component
{
  use WithPagination;
  public $booking;
  public $start_at;
  public $end_at;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'booking.hall_id' => 'required',
    'start_at'  => 'required|date',
    'end_at'    => 'required|date|after:start_at',
  ];

  protected $messages = [
    'end_at.after'    => 'The end date must be greater than start date',
  ];

  public function render()
  {
    $bookings = Conferencehallbooking::paginate(15);
    $conferencehalls = Conferencehall::paginate(15);
    return view('livewire.admin.manage-conference-hall-booking.index', compact('conferencehalls','bookings'));
  }

  /**
   * store  data
   *
   * @return void
   */
  public function store()
  {
    $this->validate();
    if (isset($this->booking->id)) {
      $this->booking->start_at = $this->start_at;
      $this->booking->end_at = $this->end_at;
      $this->booking->save();
      session()->flash('message', 'Booking updated!');
    }
    $this->reset(['booking']);
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Conferencehallbooking $booking)
  {
    $this->booking = $booking;
    $this->start_at = $booking->start_at;
    $this->end_at = $booking->end_at;
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
  public function destroy(Conferencehallbooking $booking)
  {
    $booking->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Booking deleted successfully.');
    $this->reset(['booking']);
    return redirect()->back();
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
