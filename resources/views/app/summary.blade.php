<!doctype html>
<meta charset="utf-8">
<meta name="viewport">
<title>Ringkasan</title>


@if(!empty($kategori))
  <p>(Kategori: {{ $kategori }})</p>
@endif

@if($informasi)
  @php $waktu = $informasi->tanggal ?? $informasi->created_at; @endphp
  <p>
    Saldo: Rp {{ number_format($saldoAkhir, 0, ',', '.') }} — 
    Acara: {{ $informasi->judul }}
  </p>
  @if(!empty($informasi->gambar))
    <img src="{{ \Illuminate\Support\Str::startsWith($informasi->gambar, ['http://','https://']) ? $informasi->gambar : asset($informasi->gambar) }}" style="max-width:100%;height:auto;">
  @endif
  <p>{{ $informasi->konten }}</p>
@else
  <p>Saldo: Rp {{ number_format($saldoAkhir, 0, ',', '.') }} — Acara: Belum ada informasi.</p>
@endif

