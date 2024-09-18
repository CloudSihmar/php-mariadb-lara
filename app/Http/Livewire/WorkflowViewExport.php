<?php

namespace App\Http\Livewire;

use PDF;
use Livewire\Component;
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Workflow;
use App\Models\Admin\Fileindex;
use Illuminate\Support\Facades\Session;

class WorkflowViewExport extends Component
{
  public $workflow;
  public $wid;
  public $language = 'dz';
  public $letterhead = 5;
  public $fileIndexs;
  public $file_index;
  
  /*** mount*/
  function mount($id = null)
  {
    $this->fileIndexs = collect();
    if (auth()->user()->can('workflow')) {
      $id = decryptInteger($id);
      $this->wid = $id;
      $this->fileIndexs = Fileindex::orderBy('name','asc')->get();
      Session::put('language', $this->language);
    }else{
      abort(401);
    }
    
  }
    
  /**
   * render
   * @return void
   */
  public function render()
  {
    $this->workflow = Workflow::find($this->wid);
    Session::put('workflow', $this->workflow);
    return view('livewire.workflows.workflow-view-export');
  }


  function updatedLanguage()
  {
    Session::put('language', $this->language);
  }

  function updatedFileIndex()
  {
    Session::put('file_index', $this->file_index);
  }


  /**
   * download application in pdf format
   */
  public function exportPDF($tempID)
  {
    $letterHeaders = [1,2,3,4,5];
    $fileIndex = $this->file_index;
  

    if(in_array($tempID, $letterHeaders)){
        $workflow = Session::get('workflow');
        $language = Session::get('language');
        $fileindex = Session::get('file_index');
        $pdf = PDF::loadView('livewire.workflows.mpdf', compact('workflow', 'tempID', 'language','fileindex'), [], [
          'format' => 'A4-P'
        ]);
        return $pdf->stream("workflow_" . time() . ".pdf");
      }else{
        abort(404);
      }
  }
}
