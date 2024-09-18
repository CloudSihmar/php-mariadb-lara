<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Workflow;
use Auth;

class WorkflowCreateUpdate extends Component
{
    public $workflow;

    protected $rules = [
      'workflow.name' => 'required',
      'workflow.content' => 'required',
    ];
    
    /**
     * mount
     * @return void
     */
    function mount($id = null)
    {
      if (auth()->user()->can('workflow')) {
        $id = decryptInteger($id);
        if($id){
          $this->workflow = Workflow::findOrFail($id);
        }
      }
    }
    /**
     * render
     * @return void
     */
    public function render()
    {
      return view('livewire.workflows.create_update')->layout(getLayout());
    }

        
    /**
     * store
     * @return void
     */
    public function store()
    {
      $this->validate();

      if (isset($this->workflow->id)) {
        // $content = str_replace('<p>','<br>',$this->workflow['content']);
        // $this->workflow['content'] = str_replace('</p>','',$content);
        $this->workflow->save();
        session()->flash('message', 'Workflow successfully updated!');
      } else {
        // $content = str_replace('<p>','<br>',$this->workflow['content']);
        // $content = str_replace('</p>','',$content);
        Workflow::create([
            'name' => $this->workflow['name'],
            'content' => $this->workflow['content'],
            'created_date' => Date('Y-m-d'),
            'author'    => Auth::user()->id
          ]);
        session()->flash('message', 'Workflow created. Now Forward it...!');
      }
      $this->reset(['workflow']);
      return redirect()->route('app.workflow.applications');
    }
}
