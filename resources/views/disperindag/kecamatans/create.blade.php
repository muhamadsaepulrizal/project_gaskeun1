@extends('layouts.app')
@section('title', 'Tambah Kecamatan')
@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#10B981; letter-spacing:0.1em;">// MASTER DATA</p>
        <h1 class="page-title">Tambah Data Kecamatan</h1>
    </div>
    <a href="{{ route('disperindag.kecamatans.index') }}" class="btn-secondary">← Kembali</a>
</div>
<div class="card p-8 max-w-xl">
    <form action="{{ route('disperindag.kecamatans.store') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="label-field">Nama Kecamatan</label>
            <input type="text" name="nama_kecamatan" required class="input-field mt-1" placeholder="Nama kecamatan">
            @error('nama_kecamatan')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
        </div>
        <div class="pt-2 flex justify-end gap-3" style="border-top:1px solid rgba(255,255,255,0.05);">
            <a href="{{ route('disperindag.kecamatans.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Data</button>
        </div>
    </form>
</div>
@endsection