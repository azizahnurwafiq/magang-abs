<?php

namespace App\Http\Livewire;

use App\Models\Pelanggan;
use Livewire\Component;

class PelangganSearch extends Component
{
    public $kataKunci;

    public function render()
    {
        if ($this->kataKunci != null) {
            $pelanggans = Pelanggan::where('nama', 'like', '%' . $this->kataKunci . '%')
                ->orWhere('email', 'like', '%' . $this->kataKunci . '%')
                ->orWhere('no_WA', 'like', '%' . $this->kataKunci . '%')
                ->orWhere('alamat', 'like', '%' . $this->kataKunci . '%')
                ->paginate(3);
        } else {
            $pelanggans = Pelanggan::sortable()->paginate(3);
        }
        return view('livewire.pelanggan-search', compact('pelanggans'));
    }
}
