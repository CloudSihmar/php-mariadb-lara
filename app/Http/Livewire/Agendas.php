<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agenda;
use App\Models\Admin\Agency;
use Livewire\WithPagination;

class Agendas extends Component
{
  use WithPagination;
    public $agendapp;
    public $confirmItemEdit = false;
    public $confirmItemAdd = false;
    public $confirmItemDeletion = false;

  protected $rules = [
    'agendapp.parliament_id' => 'required',
    'agendapp.session_id' => 'required',
    'agendapp.shortCode' => 'nullable',
  ];

    public function render()
    {
        $perPage = 20;
        $agencies = Agency::all();
        dd($agencies);
        
        $agendas = Agenda::with('user')->orderBy('created_at', 'desc')->paginate($perPage);
        return view('livewire.agendas.index', compact('agendas','agencies'))->layout(getLayout());
    }

 /**
   * store  data
   *
   * @return void
   */
    public function store($id=null)
    {
        $this->validate();
        if ($id) { //edit
            $this->docID = $id;
          } else { //create new letter
            $this->docID = $this->IDGenerator(new Agenda(), 'doc_id', 'AG', 5);
          }

        $userResult = Agenda::create([
            'doc_id' => $this->docID,
            'parliament_id' => $this->agendapp['parliament_id'],
            'session_id' => $this->agendapp['session_id'],
            'shortCode' =>  !empty($this->agendapp['shortCode']) ? $this->agendapp['shortCode'] : '',
            'author' => Auth::user()->id,
        ]);

        session()->flash('message', 'Agenda successfully added!');
        $this->reset(['agendapp']);
        $this->confirmItemAdd = false;
        return redirect()->back();
    }

    public function update()
    {
        $this->validate();
        $this->agendapp->save();

        session()->flash('message', 'Agenda updated successfully.');
        $this->reset(['agendapp']);
        $this->confirmItemEdit = false;
        $this->confirmItemAdd = false;
        return redirect()->back();
    }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Agenda $agendas)
  {
    $this->agendapp = $agendas;
    $this->confirmItemEdit = true;
    $this->confirmItemAdd = false;
  }


  /**
   * Delete  item
   *
   * @param  mixed $id
   * @return void
   */
  public function destroy(Agenda $agenda)
  {
    $agenda->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Agenda deleted successfully.');
    $this->reset(['agendapp']);
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
    $this->reset(['agendapp']);
    $this->confirmItemEdit = false;
    $this->confirmItemAdd = false;
  }
}
