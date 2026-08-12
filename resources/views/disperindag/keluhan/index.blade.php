@extends('layouts.app')
@section('title', 'Keluhan Masyarakat')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#F59E0B; letter-spacing:0.1em;">// LAYANAN PUBLIK</p>
        <h1 class="page-title">Keluhan Masyarakat</h1>
        <p class="page-subtitle">Verifikasi dan tindak lanjuti laporan kelangkaan distribusi LPG.</p>
    </div>
</div>

<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Pelapor & Waktu</th>
                    <th>Detail Keluhan</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($keluhans as $k)
                <tr x-data="{ openDetail: false }" class="align-top">
                    <td style="padding-top:1.25rem;">
                        <p class="font-semibold text-sm" style="color:#CBD5E1;">{{ $k->user->name ?? 'Publik Anonim' }}</p>
                        <p class="text-xs mt-1" style="color:#475569; font-family:'JetBrains Mono',monospace;">{{ $k->created_at->format('d M Y · H:i') }}</p>
                        @if($k->latitude && $k->longitude)
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $k->latitude }},{{ $k->longitude }}"
                           target="_blank"
                           class="inline-flex items-center gap-1 mt-2 text-xs font-semibold transition-colors"
                           style="color:#06B6D4;"
                           onmouseover="this.style.textDecoration='underline'"
                           onmouseout="this.style.textDecoration='none'">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            Lihat Lokasi
                        </a>
                        @endif
                    </td>
                    <td style="padding-top:1.25rem; max-width:280px;">
                        <p class="text-sm leading-relaxed" style="color:#94A3B8; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">{{ $k->isi_keluhan }}</p>
                    </td>
                    <td style="padding-top:1.25rem;">
                        @php
                            $cls = match($k->status_keluhan) {
                                'pending'    => 'badge-pending',
                                'verifikasi' => 'badge-info',
                                'selesai'    => 'badge-active',
                                default      => 'badge-pending'
                            };
                        @endphp
                        <span class="{{ $cls }}">{{ strtoupper($k->status_keluhan) }}</span>
                        @if($k->tindak_lanjut)
                            <p class="text-xs mt-2 leading-relaxed" style="color:#475569; max-width:140px;">{{ \Str::limit($k->tindak_lanjut, 50) }}</p>
                        @endif
                    </td>
                    <td class="text-right" style="padding-top:1.25rem;">
                        <button @click="openDetail = true" class="btn-edit" style="padding:0.375rem 0.875rem; font-size:0.75rem;">
                            Tindak Lanjuti
                        </button>

                        <!-- Detail Modal -->
                        <div x-show="openDetail" x-cloak
                             class="fixed inset-0 z-50 flex items-center justify-center p-4"
                             style="background:rgba(0,0,0,0.75); backdrop-filter:blur(10px);">
                            <div @click.away="openDetail = false"
                                 class="glass-card w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]"
                                 x-transition>

                                <!-- Modal Header -->
                                <div class="px-6 py-4 flex items-center justify-between shrink-0" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                                    <div>
                                        <p class="text-xs font-mono" style="color:#F59E0B; letter-spacing:0.08em;">// DETAIL KELUHAN</p>
                                        <h3 class="font-bold text-sm mt-0.5" style="color:#F1F5F9;">{{ $k->user->name ?? 'Publik Anonim' }}</h3>
                                    </div>
                                    <button type="button" @click="openDetail = false" style="color:#334155;" onmouseover="this.style.color='#94A3B8'" onmouseout="this.style.color='#334155'">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>

                                <!-- Modal Body -->
                                <div class="p-6 overflow-y-auto grow">
                                    <div class="grid grid-cols-2 gap-4 mb-6">
                                        <div class="p-4 rounded-xl" style="background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.05);">
                                            <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Info Laporan</p>
                                            <p class="text-xs mb-1" style="color:#94A3B8;"><span style="color:#64748B;">Pelapor:</span> {{ $k->user->name ?? 'Publik' }}</p>
                                            <p class="text-xs mb-1" style="color:#94A3B8; font-family:'JetBrains Mono',monospace;"><span style="color:#64748B;">Waktu:</span> {{ $k->created_at->format('d F Y, H:i') }}</p>
                                            @if($k->latitude)
                                                <a href="https://www.google.com/maps/search/?api=1&query={{ $k->latitude }},{{ $k->longitude }}" target="_blank" class="text-xs" style="color:#06B6D4;">📍 Buka di Maps</a>
                                            @endif
                                        </div>
                                        <div class="p-4 rounded-xl" style="background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.05);">
                                            <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Isi Keluhan</p>
                                            <p class="text-sm leading-relaxed" style="color:#94A3B8;">{{ $k->isi_keluhan }}</p>
                                        </div>
                                    </div>

                                    @if($k->foto_bukti)
                                    <div class="mb-6">
                                        <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#475569;">Foto Bukti</p>
                                        <div class="rounded-xl overflow-hidden" style="max-height:200px; background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.05);">
                                            <img src="{{ asset('storage/' . $k->foto_bukti) }}" alt="Bukti" class="w-full object-contain">
                                        </div>
                                    </div>
                                    @endif

                                    <div class="neon-divider my-4"></div>

                                    <form action="{{ route('disperindag.keluhan.update', $k->id) }}" method="POST" class="space-y-4">
                                        @csrf @method('PUT')
                                        <div>
                                            <label class="label-field">Update Status Keluhan</label>
                                            <div class="relative mt-1">
                                                <select name="status_keluhan" class="select-field pr-10">
                                                    <option value="pending" style="background:#141E2E;" {{ $k->status_keluhan=='pending'?'selected':'' }}>⏳ Pending (Menunggu)</option>
                                                    <option value="verifikasi" style="background:#141E2E;" {{ $k->status_keluhan=='verifikasi'?'selected':'' }}>🔍 Verifikasi (Diproses)</option>
                                                    <option value="selesai" style="background:#141E2E;" {{ $k->status_keluhan=='selesai'?'selected':'' }}>✅ Selesai (Ditangani)</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                                    <svg class="w-4 h-4" style="color:#475569;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="label-field">Catatan Tindak Lanjut</label>
                                            <textarea name="tindak_lanjut" rows="3" class="input-field mt-1"
                                                      placeholder="Tuliskan hasil investigasi atau solusi...">{{ $k->tindak_lanjut }}</textarea>
                                        </div>
                                        <div class="flex justify-end gap-3 pt-2">
                                            <button type="button" @click="openDetail = false" class="btn-secondary">Tutup</button>
                                            <button type="submit" class="btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-12" style="color:#334155;">
                        <svg class="w-8 h-8 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        Belum ada laporan keluhan masyarakat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
