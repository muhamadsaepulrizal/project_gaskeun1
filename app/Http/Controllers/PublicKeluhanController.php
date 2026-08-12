<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicKeluhanController extends Controller
{
    public function create()
    {
        return view('public.keluhan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_keluhan' => 'required|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'foto_bukti' => 'nullable|image|max:5120', // max 5MB
        ]);

        $data = $request->only(['isi_keluhan', 'latitude', 'longitude']);
        $data['status_keluhan'] = 'pending';
        $data['user_id'] = auth()->id(); // Link to logged-in Publik

        if ($request->hasFile('foto_bukti')) {
            $data['foto_bukti'] = $request->file('foto_bukti')->store('keluhan', 'public');
        }

        \App\Models\Keluhan::create($data);

        return redirect()->back()->with('success', 'Keluhan berhasil dikirim!');
    }
}
