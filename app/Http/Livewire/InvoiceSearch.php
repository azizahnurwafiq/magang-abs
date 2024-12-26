<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Livewire\Component;

class InvoiceSearch extends Component
{
    public $keyword;

    public function render()
    {
        if ($this->keyword != null) {
            $data['invoices'] = Invoice::with('pelanggan')
                ->where('kode', 'LIKE', '%' . $this->keyword . '%')
                ->orWhere('no_invoice', 'LIKE', '%' . $this->keyword . '%')
                ->orWhereHas('pelanggan', function ($query) {
                    $query->where('nama', 'LIKE', '%' . $this->keyword . '%');
                })
                ->paginate(5);
        } else {
            $data['invoices'] = Invoice::sortable()->paginate(10);
        }

        return view('livewire.invoice-search', $data);
    }
}
