<?php

namespace App\Http\Livewire;

use PDF;
use App\Models\Leave;
use Livewire\Component;
use App\Models\Filemanager;
use App\Models\Admin\Division;
use App\Models\Dispatchletter;
use App\Http\Livewire\Utilities;
use App\Models\Admin\Department;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class SearchDispatchLetters extends Component
{
    public $dispatchNumber;
    public $dispatchletter;
    public $fromDate;
    public $toDate;
    public $viewDetails = false;
    public $viewfiles = false;
    public $attachmentFiles;
    public $confirmItemDeletion = false;
    
    public function mount()
    {
        if (auth()->user()->can('dispatched.report')) {
            $this->dispatchletters = collect();
        }else{
            abort(401);
        }
    }

    public function render()
    {
        return view('livewire.searchdispatchletter.index')->layout(getLayout());
    }

    public function search()
    {
        Session::put('fromDate', Utilities::formated_date($this->fromDate));
        Session::put('toDate', Utilities::formated_date($this->toDate));
        Session::put('dispatchNumber', $this->dispatchNumber);

        if(!empty($this->dispatchNumber)){
            $this->dispatchletters = Dispatchletter::with('user')->with('division')->where('dispatch_number',$this->dispatchNumber)->get();
        }else{
            $this->dispatchletters = Dispatchletter::with('user')->with('division')->whereBetween('issue_date',[Utilities::formated_date($this->fromDate),Utilities::formated_date($this->toDate)])->get();
        }
        $this->viewDetails = false;
    }

    public function viewDetails(Dispatchletter $dispatchletter)
    {
        $this->dispatchletter = $dispatchletter;
        $this->viewDetails = true;
        $this->viewfiles = false;
    }
    

     /**
     * display activity logs
     */
    public function viewFiles($id)
    {
      $dispatchletterList = Dispatchletter::find($id);
      $this->attachmentFiles = Filemanager::where('doc_id','=',$dispatchletterList->doc_id)->get();
      $this->viewfiles = true;
      $this->viewDetails = false;
    }


    public function getDepartment($id){
        $department =  Department::find($id)->first();
        return $department->name;
    }

    public function getDivision($id){
        $division =  Division::find($id)->first();
        return $division->name;
    }


    /**
     * download
     * @param  mixed $id
     * @return void
     */
    public function download($id)
    {
      $attachmentdoc = Filemanager::where('id', $id)->firstOrFail();
      $file_path = public_path('uploads/' . $attachmentdoc->filepath);
      return response()->download($file_path);
    }

    
    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->viewDetails = false;
      $this->viewfiles = false;
      $this->confirmItemDeletion = false;
      $this->reset('fromDate');
      $this->reset('toDate');
      $this->reset('dispatchNumber');
      
    }


  /**
   * download application in pdf format
   */
  public function downloadPdf()
  {
    $fromDate = Session::get('fromDate');
    $toDate = Session::get('toDate');
    $dispatchNumber = Session::get('dispatchNumber');
    
    if(!empty($dispatchNumber)){
        $dispatchletters = Dispatchletter::with('user')->with('division')->where('dispatch_number',$dispatchNumber)->get();
    }else{
        $dispatchletters = Dispatchletter::with('user')->with('division')->whereBetween('issue_date',[$fromDate,$toDate])->get();
    }
    $title = 'From: '.$fromDate.' , To '.$toDate;
    $pdf = PDF::loadView(
        'livewire.searchdispatchletter.report',
        compact('dispatchletters','fromDate','toDate','title'),
        [],
        [
            'title' => 'Dispatch Report',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]
    );
    return $pdf->stream('dispatch_report.pdf');
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
   *
   * @param  mixed $id
   * @return void
   */
  public function destroy(Dispatchletter $dispatchletter)
  {
    $dispatchletter->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Dispatchletter deleted successfully.');
    return redirect()->route('app.searchdispatchletter.applications');
  }

}
