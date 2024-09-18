<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin\Weblink;

class InternalWeblinks extends Component
{

    public function render()
    {
        $weblinks = Weblink::all();
        return view('livewire.internalweblinks.index', compact('weblinks'));
    }
}
