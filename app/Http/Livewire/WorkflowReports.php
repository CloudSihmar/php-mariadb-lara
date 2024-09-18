<?php

namespace App\Http\Livewire;

use PDF;
use Livewire\Component;
use App\Models\Workflow;
use App\Http\Livewire\Utilities;
use Illuminate\Support\Facades\Session;

class WorkflowReports extends Component
{
    public $fromDate;
    public $toDate;
    public $workflowreports;
    
    protected $rules = [
        'fromDate' => 'required',
        'toDate' => 'required',
      ];

  
    /**
     * mount
     * @return void
     */
    public function mount()
    {
        $this->workflowreports = collect();
    }

    /**
    * render
    */
    public function render()
    {
        return view('livewire.workflowreports.index')->layout(getLayout());
    }

    /**
    * search
    */
    public function search()
    {
      $perPage = 25;
        $this->validate([
            'fromDate' => 'required',
            'toDate' => 'required',
          ],[
            'fromDate.required' => 'Please select fromDate',
            'toDate.required' => 'Please select toDate',
          ]);
          
        Session::put('fromDate', Utilities::formated_date($this->fromDate));
        Session::put('toDate', Utilities::formated_date($this->toDate));
        $this->workflowreports = Workflow::with('user')->whereBetween('created_date',[ Utilities::formated_date($this->fromDate), Utilities::formated_date($this->toDate)])->get();
    }


  /**
   * download application in pdf format
   */
  public function downloadPdf()
  {
    $fromDate = Session::get('fromDate');
    $toDate = Session::get('toDate');

    $workflowreports = Workflow::with('user')->whereBetween('created_date',[$fromDate,$toDate])->get();
    $title = 'From: '.$fromDate.' , To '.$toDate;

    $pdf = PDF::loadView(
      'livewire.workflowreports.report',
        compact('workflowreports', 'fromDate', 'toDate', 'title'),
      [],
      [
        'title' => 'Workflow Report',
        'format' => 'A4-L',
        'orientation' => 'L'
      ]
    );
    return $pdf->stream('workflow_report.pdf');
  }
}
