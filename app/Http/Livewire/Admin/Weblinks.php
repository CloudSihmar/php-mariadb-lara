<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Weblink;
use Livewire\Component;
use Livewire\WithPagination;

class Weblinks extends Component
{
  use WithPagination;
  public $weblink;
  public $cat_id;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;
  public $approve = false;

  protected $rules = [
    'weblink.name' => 'required',
    'weblink.url' => 'required',
  ];

  public function mount($cat_id){
    $this->cat_id = $cat_id;
  }

  /**
   * Render page
   * @return void
   */
  public function render()
  {
    $weblinks = Weblink::where('weblinkcategory_id', $this->cat_id)->orderBy('created_at', 'asc')->paginate(15);
    return view('livewire.admin.weblinks.index', compact('weblinks'));
  }

  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    if (isset($this->weblink->id)) {
      $this->weblink->weblinkcategory_id =   $this->cat_id;
      $this->weblink->save();
      session()->flash('message', 'Weblink  successfully updated!');
    } else {
      Weblink::create([
        'name' =>   $this->weblink['name'],
        'weblinkcategory_id' =>   $this->cat_id,
        'url' => $this->weblink['url'],
      ]);
      session()->flash('message', 'Weblink successfully created!');
    }
    $this->reset(['weblink']);
    $this->confirmItemAdd = false;
    $this->approve = false;
    return redirect()->back();
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Weblink $weblink)
  {
    $this->weblink = $weblink;
    $this->confirmItemAdd = true;
    $this->approve = false;
   }

  /**
   * Display confim deletion modal.
   */

  public function showDeleteModal($id)
  {
    $this->confirmItemDeletion = $id;
  }

  /**
   * Delete  item
   * @param  mixed $id
   * @return void
   */
  public function destroy(Weblink $weblink)
  {
    $weblink->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Weblink deleted successfully.');
    $this->reset(['weblink']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['weblink']);
  }

}
