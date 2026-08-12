<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisperindagKeluhanController extends Controller
{
    public function index()
    {
        $keluhans = \App\Models\Keluhan::latest()->get();
        return view('disperindag.keluhan.index', compact('keluhans'));
    }

    public function update(Request $request, \App\Models\Keluhan $keluhan)
    {
        $request->validate([
            'status_keluhan' => 'required|string',
            'tindak_lanjut' => 'nullable|string'
        ]);

        $keluhan->update($request->only(['status_keluhan', 'tindak_lanjut']));

        return redirect()->back()->with('success', 'Status keluhan berhasil diperbarui!');
    }
}
