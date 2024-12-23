<?php

namespace App\Http\Livewire;

use App\Models\InvoiceArsip;
use Livewire\Component;

class ArsipSearch extends Component
{
    public $keyword;

    public function render()
    {
        if ($this->keyword != null) {
            $data['arsips'] = InvoiceArsip::with('pelanggan')
                ->where('kode', 'LIKE', '%' . $this->keyword . '%')
                ->orWhere('no_invoice', 'LIKE', '%' . $this->keyword . '%')
                ->orWhereHas('pelanggan', function ($query) {
                    $query->where('nama', 'LIKE', '%' . $this->keyword . '%');
                })
                ->paginate(5);
        } else {
            $data['arsips'] = InvoiceArsip::sortable()->paginate(10);
        }

        return view('livewire.arsip-search', $data);
    }
}
