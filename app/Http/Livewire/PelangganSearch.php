<?php

namespace App\Http\Livewire;

use App\Models\Pelanggan;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;

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
                ->paginate(5);
        } else {
            $pelanggans = Pelanggan::sortable()->paginate(5);
        }

        $pelanggans->getCollection()->transform(function ($pelanggan) {
            $pelanggan->encrypted_id = Crypt::encryptString($pelanggan->id);
            return $pelanggan;
        });

        return view('livewire.pelanggan-search', compact('pelanggans'));
    }
}
