<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin\Holiday;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Holidays extends Component
{
  use WithPagination;
    public $holidayapp;
    public $confirmItemEdit = false;
    public $confirmItemAdd = false;
    public $confirmItemDeletion = false;

  protected $rules = [
    'holidayapp.holiday_date' => 'required',
    'holidayapp.shortCode' => 'nullable',
  ];

    public function render()
    {
        $perPage = 20;
        $holidays = Holiday::with('user')->orderBy('created_at', 'desc')->paginate($perPage);
        return view('livewire.holidays.index', compact('holidays'))->layout(getLayout());
    }

 /**
   * store  data
   *
   * @return void
   */
    public function store()
    {
        $this->validate();
        $userResult = Holiday::create([
            'holiday_date' => $this->holidayapp['holiday_date'],
            'shortCode' =>  !empty($this->holidayapp['shortCode']) ? $this->holidayapp['shortCode'] : '',
            'author' => Auth::user()->id,
            'year' => substr($this->holidayapp['holiday_date'],0,4),
        ]);

        session()->flash('message', 'Holiday successfully added!');
        $this->reset(['holidayapp']);
        $this->confirmItemAdd = false;
        return redirect()->back();
    }

    public function update()
    {
        $this->validate();
        $this->holidayapp->save();

        session()->flash('message', 'Holiday updated successfully.');
        $this->reset(['holidayapp']);
        $this->confirmItemEdit = false;
        $this->confirmItemAdd = false;
        return redirect()->back();
    }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Holiday $holidays)
  {
    $this->holidayapp = $holidays;
    $this->confirmItemEdit = true;
    $this->confirmItemAdd = false;
  }


  /**
   * Delete  item
   *
   * @param  mixed $id
   * @return void
   */
  public function destroy(Holiday $holiday)
  {
    $holiday->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Holiday deleted successfully.');
    $this->reset(['holidayapp']);
    return redirect()->back();
  }


  /**
   * Display confim deletion modal.
   */
  public function showDeleteModal($id)
  {
    $this->confirmItemDeletion = $id;
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->reset(['holidayapp']);
    $this->confirmItemEdit = false;
    $this->confirmItemAdd = false;
  }
}
