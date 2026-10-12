@php($themeDefault = $themeDefault ?? 'light')
<script>
  (function () {
    var t = null;
    try { t = localStorage.getItem('shato-theme'); } catch (e) {}
    document.documentElement.setAttribute('data-theme', t === 'dark' || t === 'light' ? t : '{{ $themeDefault }}');
  })();
</script>
{{-- Bilah navigasi lintas halaman untuk landing page produk yang berdiri sendiri (tanpa layout utama). --}}
<style>
  .smx-bar { background: #0b0f14; border-bottom: 1px solid rgba(255,255,255,.08); font: 600 13px/1.2 Inter, "Segoe UI", Arial, sans-serif; position: relative; z-index: 60; }
  .smx-inner { width: min(1120px, calc(100% - 32px)); margin: 0 auto; min-height: 40px; display: flex; align-items: center; gap: 18px; }
  .smx-home { display: inline-flex; align-items: center; gap: 6px; color: #fff !important; text-decoration: none !important; white-space: nowrap; font-weight: 800; }
  .smx-home:hover { color: #fbbf24 !important; }
  .smx-links { display: flex; align-items: center; gap: 4px; overflow-x: auto; scrollbar-width: none; margin-left: auto; }
  .smx-links::-webkit-scrollbar { display: none; }
  .smx-links a { color: rgba(255,255,255,.68) !important; text-decoration: none !important; padding: 6px 10px; border-radius: 999px; white-space: nowrap; }
  .smx-links a:hover { color: #fff !important; background: rgba(255,255,255,.08); }
  .smx-links a.smx-active { color: #0b0f14 !important; background: #fbbf24; }
  .smx-label { color: rgba(255,255,255,.4); white-space: nowrap; }
  .smx-theme { flex: none; display: inline-flex; align-items: center; gap: 6px; height: 28px; padding: 0 10px; border-radius: 999px; border: 1px solid rgba(255,255,255,.18); background: transparent; color: rgba(255,255,255,.8); font: inherit; cursor: pointer; white-space: nowrap; }
  .smx-theme:hover { color: #fff; border-color: rgba(255,255,255,.4); }
  @media (max-width: 720px) { .smx-label { display: none; } .smx-inner { gap: 10px; } }
</style>
<div class="smx-bar">
  <div class="smx-inner">
    <a class="smx-home" href="{{ route('beranda') }}" aria-label="Kembali ke beranda Shatomedia">&larr; Shatomedia</a>
    <nav class="smx-links" aria-label="Produk Shatomedia">
      <span class="smx-label">Produk lain:</span>
      <a href="{{ route('taqwa-hub-landing') }}" class="{{ Request::routeIs('taqwa-hub-landing') ? 'smx-active' : '' }}">TAQWA-Hub</a>
      <a href="{{ route('surgery-time-landing') }}" class="{{ Request::routeIs('surgery-time-landing') ? 'smx-active' : '' }}">Surgery Time</a>
      <a href="{{ route('jws-m3-landing') }}" class="{{ Request::routeIs('jws-m3-landing') ? 'smx-active' : '' }}">JWS-M3</a>
      <a href="{{ route('moonlight-landing') }}" class="{{ Request::routeIs('moonlight-landing') ? 'smx-active' : '' }}">MOONLIGHT</a>
      <a href="{{ route('buku-teknologi-landing') }}" class="{{ Request::routeIs('buku-teknologi-landing') ? 'smx-active' : '' }}">Buku</a>
      <a href="{{ route('product') }}">Semua Produk</a>
    </nav>
    <button type="button" class="smx-theme" id="smx-theme" aria-label="Ganti tema gelap/terang"></button>
  </div>
</div>
<script>
  (function () {
    var root = document.documentElement, btn = document.getElementById('smx-theme');
    function label() {
      var dark = root.getAttribute('data-theme') === 'dark';
      btn.innerHTML = dark ? '&#9728;&#65039; Terang' : '&#9790; Gelap';
      btn.title = dark ? 'Pakai tema terang' : 'Pakai tema gelap';
    }
    label();
    btn.addEventListener('click', function () {
      var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      root.setAttribute('data-theme', next);
      try { localStorage.setItem('shato-theme', next); } catch (e) {}
      label();
    });
  })();
</script>
