<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword != null) {
            $data['pekerjaans'] = Pekerjaan::where('jenis_pekerjaan', 'LIKE', '%' . $keyword . '%')
                ->paginate(5);
        } else {
            $data['pekerjaans'] = Pekerjaan::sortable()->paginate(5);
        }

        return view('pekerjaan.index', $data);
    }

    public function create()
    {
        return view('pekerjaan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_pekerjaan' => 'required'
        ], [
            'jenis_pekerjaan.required' => 'Jenis pekerjaan wajib diisi!',
        ]);

        Pekerjaan::create($validatedData);

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pekerjaan = Pekerjaan::find($id);
        return view('pekerjaan.edit', compact('pekerjaan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'jenis_pekerjaan' => 'required'
        ]);

        $data = [
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
        ];

        Pekerjaan::where('id', $request->id)->update($data);

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan berhasil diupdate');
    }

    public function destroy($id)
    {
        $hapus = Pekerjaan::find($id);
        $hapus->delete();

        return response()->json(['status' => 'Data pekerjaan berhasil dihapus!']);
    }
}
