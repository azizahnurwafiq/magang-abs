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
            'jenis_pekerjaan' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/'
        ], [
            'jenis_pekerjaan.required' => 'jenis pekerjaan wajib diisi!',
            'jenis_pekerjaan.string' => 'jenis pekerjaan harus berupa teks !!',
            'jenis_pekerjaan.max' => 'jenis pekerjaan tidak boleh lebih dari 100 karakter !!',
            'jenis_pekerjaan.regex' => 'jenis pekerjaan hanya boleh mengandung huruf dan spasi !!',
        ]);

        Pekerjaan::create($validatedData);

        if (auth()->user()->role === 'manager') {
            return redirect()->route('manager.pekerjaan.index')->with('success', 'Data pekerjaan berhasil ditambahkan');
        } else if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.pekerjaan.index')->with('success', 'Data pekerjaan berhasil ditambahkan');
        }
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

        if (auth()->user()->role === 'manager') {
            return redirect()->route('manager.pekerjaan.index')->with('success', 'Data pekerjaan berhasil diupdate');
        } else if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.pekerjaan.index')->with('success', 'Data pekerjaan berhasil diupdate');
        }
    }

    public function destroy($id)
    {
        $hapus = Pekerjaan::find($id);
        $hapus->delete();

        return response()->json(['status' => 'Data pekerjaan berhasil dihapus!']);
    }
}
