<?php

namespace App\Http\Livewire;

use PDF;
use App\Models\Leave;
use Livewire\Component;
use App\Models\Filemanager;
use App\Models\Receiveletter;
use App\Models\Admin\Division;
use App\Http\Livewire\Utilities;
use App\Models\Admin\Department;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class SearchReceiveLetters extends Component
{
    public $dakNumber;
    public $receiveletter;
    public $fromDate;
    public $toDate;
    public $viewDetails = false;
    public $viewfiles = false;
    public $attachmentFiles;
    public $confirmItemDeletion = false;
    
    public function mount()
    {
        if (auth()->user()->can('received.report')) {
            $this->receiveletters = collect();
        }else{
            abort(401);
        }
    }

    public function render()
    {
        return view('livewire.searchreceiveletter.index')->layout(getLayout());
    }

    public function search()
    {
        Session::put('fromDate', Utilities::formated_date($this->fromDate));
        Session::put('toDate', Utilities::formated_date($this->toDate));
        Session::put('dakNumber', $this->dakNumber);

        if(!empty($this->dakNumber)){
            $this->receiveletters = Receiveletter::with('user')->with('division')->where('dak_number',$this->dakNumber)->get();
        }else{
            $this->receiveletters = Receiveletter::with('user')->with('division')->whereBetween('receive_date',[Utilities::formated_date($this->fromDate),Utilities::formated_date($this->toDate)])->get();
        }
        $this->viewDetails = false;
    }

    public function viewDetails(Receiveletter $receiveletter)
    {
        $this->receiveletter = $receiveletter;
        $this->viewDetails = true;
        $this->viewfiles = false;
    }
    

     /**
     * display activity logs
     */
    public function viewFiles($id)
    {
      $letterList = Receiveletter::find($id);
      $this->attachmentFiles = Filemanager::where('doc_id','=',$letterList->doc_id)->get();
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
      $this->reset('dakNumber');
      
    }


  /**
   * download application in pdf format
   */
  public function downloadPdf()
  {
    $fromDate = Session::get('fromDate');
    $toDate = Session::get('toDate');
    $dakNumber = Session::get('dakNumber');

    if(!empty($dakNumber)){
        $receiveletters = Receiveletter::with('user')->with('division')->where('dak_number',$dakNumber)->get();
    }else{
        $receiveletters = Receiveletter::with('user')->with('division')->whereBetween('receive_date',[$fromDate,$toDate])->get();
    }
    $title = 'From: '.$fromDate.' , To '.$toDate;
    $pdf = PDF::loadView(
        'livewire.searchreceiveletter.report',
        compact('receiveletters','fromDate','toDate','title'),
        [],
        [
            'title' => 'Received Letters Report',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]
    );
    return $pdf->stream('received_report.pdf');
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
  public function destroy(Receiveletter $receiveletter)
  {
    $receiveletter->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Received deleted successfully.');
    return redirect()->route('app.searchreceiveletter.applications');
  }
  
}

