<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TAQWA-Hub - Sistem Digital Manajemen Masjid</title>
  <meta name="description" content="TAQWA-Hub v1.7: satu perangkat untuk tiga pilar masjid — Riayah (audio 8-kanal, jadwal sholat, TV masjid), Imarah (falak, kegiatan, SIM TPQ, paket Ramadan), dan Idarah (keuangan, zakat, aset, pengguna & hak akses) — bekerja penuh tanpa internet.">
  <link rel="canonical" href="https://shatomedia.com/taqwa-hub">
  <meta name="theme-color" content="#111216">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Shatomedia">
  <meta property="og:title" content="TAQWA-Hub v1.7: Sistem Digital Manajemen Masjid">
  <meta property="og:description" content="Satu perangkat untuk audio 8-kanal, jadwal sholat, TV masjid, falak, SIM TPQ, keuangan, dan zakat. Bekerja tanpa internet, tanpa biaya langganan, update gratis. Mulai Rp 3,5 juta.">
  <meta property="og:url" content="https://shatomedia.com/taqwa-hub">
  <meta property="og:image" content="https://shatomedia.com/taqwa-hub-full/screenshots/2026-10/mode.jpg">
  <meta property="og:locale" content="id_ID">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="icon" href="{{ asset('taqwa-hub-full/logo.png') }}">
  <style>
    :root {
      color-scheme: dark;
      --ink: #e7e9ee;
      --muted: #9ba3af;
      --bg: #111216;
      --card: #1b1c21;
      --blue: #4c9bf5;
      --green-950: #0b0c0f;
      --green-900: #15241d;
      --green-800: #3fbf8f;
      --gold: #d9a441;
      --gold-deep: #a1770f;
      --red: #dc2626;
      --soft: #16171c;
      --line: #2b2d34;
      --white: #ffffff;
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body { margin: 0; color: var(--ink); background: var(--bg); font-family: Inter, "Segoe UI", Arial, sans-serif; line-height: 1.6; }
    a { color: inherit; }
    img { max-width: 100%; display: block; }
    .wrap { width: min(1120px, calc(100% - 32px)); margin: 0 auto; }

    .nav { position: sticky; top: 0; z-index: 10; background: rgba(17,18,22,.92); border-bottom: 1px solid var(--line); backdrop-filter: blur(10px); }
    .nav-inner { min-height: 66px; display: flex; align-items: center; justify-content: space-between; gap: 18px; }
    .brand { display: flex; align-items: center; gap: 10px; font-weight: 900; color: var(--green-800); text-decoration: none; }
    .brand img { width: 32px; height: 32px; border-radius: 8px; }
    .nav-links { display: flex; align-items: center; gap: 18px; font-size: 14px; font-weight: 700; color: var(--green-800); }
    .nav-links a { text-decoration: none; }

    .btn { display: inline-flex; align-items: center; justify-content: center; min-height: 46px; padding: 0 18px; border-radius: 8px; border: 1px solid transparent; text-decoration: none; font-weight: 800; line-height: 1.2; text-align: center; }
    .btn-primary { background: var(--gold); color: #241a05; }
    .btn-green { background: var(--green-800); color: #08130e; }
    .btn-ghost { background: var(--card); color: var(--green-800); border-color: var(--line); }

    .hero { background: radial-gradient(circle at 80% 20%, rgba(76,155,245,.18), transparent 45%), linear-gradient(135deg, #0b0c0f, #15241d 60%, #10261d); border-bottom: 1px solid var(--line); color: #fff; overflow: hidden; }
    .hero-grid { min-height: 640px; display: grid; grid-template-columns: 1fr 1fr; gap: 44px; align-items: center; padding: 74px 0; }
    .eyebrow { display: inline-flex; align-items: center; min-height: 32px; padding: 0 12px; border-radius: 999px; background: rgba(255,255,255,.12); color: rgba(255,255,255,.88); font-size: 13px; font-weight: 800; margin-bottom: 18px; }
    h1, h2, h3 { margin: 0; line-height: 1.1; }
    h1 { font-size: clamp(36px, 5.5vw, 60px); max-width: 620px; }
    h1 span { color: var(--gold); }
    h2 { font-size: clamp(28px, 4vw, 40px); color: var(--green-800); }
    h3 { font-size: 20px; color: var(--green-800); }
    .lead { margin: 20px 0 0; max-width: 600px; color: rgba(255,255,255,.84); font-size: 18px; }
    .hero-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 30px; }
    .hero-note { margin-top: 18px; color: rgba(255,255,255,.7); font-size: 14px; }

    .browser { border-radius: 18px; background: #0a0b0d; border: 1px solid var(--line); padding: 12px; box-shadow: 0 30px 80px rgba(0,0,0,.35); transform: rotate(1.2deg); }
    .browser-bar { height: 30px; display: flex; align-items: center; gap: 7px; padding: 0 6px; }
    .dot { width: 10px; height: 10px; border-radius: 50%; background: #64748b; }
    .browser img { border-radius: 10px; height: 380px; width: 100%; object-fit: cover; object-position: top; background: var(--card); }

    section { padding: 82px 0; }
    .section-head { display: grid; grid-template-columns: .8fr 1fr; gap: 28px; align-items: end; margin-bottom: 28px; }
    .section-head p { margin: 0; color: var(--muted); font-size: 16px; }
    .soft { background: var(--soft); }
    .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
    .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; }
    .box { border: 1px solid var(--line); border-radius: 8px; background: var(--card); padding: 22px; }
    .box p { margin: 10px 0 0; color: var(--muted); }
    .problem b { color: #f87171; }

    .flow { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; align-items: stretch; }
    .step { min-height: 156px; border: 1px solid var(--line); border-radius: 8px; background: var(--card); padding: 18px; position: relative; }
    .num { width: 34px; height: 34px; border-radius: 50%; display: grid; place-items: center; background: var(--green-800); color: #08130e; font-weight: 900; margin-bottom: 12px; }
    .step p { margin: 8px 0 0; color: var(--muted); font-size: 14px; line-height: 1.45; }

    .feature-list { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
    .feature { display: flex; gap: 12px; align-items: flex-start; border-bottom: 1px solid var(--line); padding: 14px 0; }
    .check { flex: none; width: 26px; height: 26px; border-radius: 50%; display: grid; place-items: center; background: rgba(217,164,65,.14); color: var(--gold-deep); font-weight: 900; font-size: 13px; }
    .feature b { display: block; color: var(--green-800); }
    .feature span { display: block; color: var(--muted); margin-top: 3px; font-size: 14px; }

    .shot-card { overflow: hidden; padding: 0; }
    .shot-card img { width: 100%; height: 200px; object-fit: cover; object-position: top; background: var(--soft); border-bottom: 1px solid var(--line); }
    .shot-card div { padding: 16px; }

    .stat { text-align: center; padding: 26px 18px; border: 1px solid var(--line); background: var(--card); }
    .stat b { display: block; font-size: 30px; color: var(--gold); }
    .stat span { color: var(--muted); font-size: 14px; font-weight: 600; }

    .price-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
    .price-card { display: flex; flex-direction: column; border: 1px solid var(--line); border-radius: 8px; background: var(--card); padding: 22px; }
    .price-card.featured { border-color: var(--gold); box-shadow: 0 16px 34px rgba(217,164,65,.2); }
    .price-card .sub { color: var(--muted); font-size: 12px; font-weight: 800; text-transform: uppercase; margin-bottom: 8px; }
    .price-card .price { font-size: 26px; font-weight: 900; color: var(--green-800); margin-bottom: 16px; }
    .price-card.featured .price { color: var(--gold-deep); }
    .price-card ul { list-style: none; margin: 0; padding: 0; display: grid; gap: 9px; flex: 1; }
    .price-card li { font-size: 13px; line-height: 1.4; color: var(--muted); padding-left: 20px; position: relative; }
    .price-card li::before { content: "\2713"; position: absolute; left: 0; top: 0; color: var(--green-800); font-weight: 900; }
    .price-card.featured li::before { color: var(--gold-deep); }
    .price-note { margin-top: 22px; padding: 18px 20px; border: 1px solid var(--line); border-radius: 8px; background: var(--soft); color: var(--muted); font-size: 14px; }
    .price-note b { color: var(--green-800); }

    .warranty-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
    .warranty-card { border: 1px solid var(--line); border-radius: 8px; background: var(--card); padding: 22px; }
    .warranty-card .icon { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: rgba(217,164,65,.14); color: var(--gold-deep); font-weight: 900; margin-bottom: 12px; }
    .warranty-card b { display: block; color: var(--green-800); font-size: 17px; margin-bottom: 6px; }
    .warranty-card p { margin: 0; color: var(--muted); font-size: 14px; line-height: 1.45; }
    .badge-draft { display: inline-block; margin-left: 6px; padding: 2px 8px; border-radius: 999px; background: rgba(248,113,113,.15); color: #f87171; font-size: 11px; font-weight: 800; text-transform: uppercase; vertical-align: 2px; }

    .compare-table-wrap { overflow-x: auto; border: 1px solid var(--line); border-radius: 8px; background: var(--card); }
    table.compare { width: 100%; border-collapse: collapse; min-width: 620px; }
    table.compare th, table.compare td { padding: 16px 18px; text-align: left; font-size: 14px; border-bottom: 1px solid var(--line); }
    table.compare thead th { background: var(--green-900); color: #fff; font-weight: 800; }
    table.compare thead th:first-child { border-top-left-radius: 8px; }
    table.compare thead th:last-child { border-top-right-radius: 8px; }
    table.compare td { color: var(--muted); }
    table.compare tbody th { color: var(--ink); font-weight: 800; white-space: nowrap; }
    table.compare td.manual { color: #f87171; }
    table.compare td.manual::before { content: "\2717  "; }
    table.compare td.taqwa { color: var(--green-800); font-weight: 700; }
    table.compare td.taqwa::before { content: "\2713  "; }
    table.compare tbody tr:last-child th, table.compare tbody tr:last-child td { border-bottom: none; }

    .quote { background: var(--green-900); border: 1px solid var(--line); color: #f2ede0; border-radius: 16px; padding: 44px 40px; text-align: center; }
    .quote p { font-size: 22px; line-height: 1.5; font-weight: 600; max-width: 640px; margin: 0 auto 16px; }
    .quote span { font-size: 14px; opacity: .75; font-weight: 600; }

    .faq details { border-bottom: 1px solid var(--line); padding: 18px 0; }
    .faq summary { cursor: pointer; color: var(--green-800); font-weight: 900; font-size: 18px; list-style: none; }
    .faq summary::-webkit-details-marker { display: none; }
    .faq p { color: var(--muted); margin-bottom: 0; }

    .cta { background: #0b0c0f; border-top: 1px solid var(--line); color: #fff; text-align: center; }
    .cta h2 { color: #fff; max-width: 780px; margin: 0 auto; }
    .cta p { max-width: 680px; margin: 18px auto 0; color: rgba(255,255,255,.76); font-size: 18px; }
    .cta .hero-actions { justify-content: center; }
    .cta-qr { width: 108px; height: 108px; padding: 8px; background: var(--card); border: 6px solid var(--gold); margin: 24px auto 0; }
    .cta-qr img { width: 100%; height: 100%; }

    .pillar { border-top: 4px solid var(--green-800); }
    .pillar.imarah { border-top-color: var(--gold); }
    .pillar.idarah { border-top-color: var(--blue); }
    .pillar h3 { margin-top: 6px; }
    .pillar ul { margin: 12px 0 0; padding-left: 18px; color: var(--muted); font-size: 14px; }
    .pillar li { margin: 4px 0; }
    .pillar .tag { font-size: 12px; font-weight: 800; text-transform: uppercase; color: var(--muted); letter-spacing: .04em; }
    .gallery { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .gallery .shot-card img { height: 200px; cursor: zoom-in; transition: opacity .2s; }
    .gallery .shot-card img:hover { opacity: .85; }
    .gallery .shot-card { display: flex; flex-direction: column; }
    .gallery .shot-card > div { display: flex; flex-direction: column; gap: 4px; flex: 1; }
    .shot-loc { font-size: 11px; font-weight: 800; letter-spacing: .05em; text-transform: uppercase; color: var(--blue); }
    .shot-card ul { margin: 10px 0 0; padding: 10px 0 0 18px; border-top: 1px dashed var(--line); color: var(--muted); font-size: 13px; line-height: 1.5; }
    .shot-card li { margin: 3px 0; }
    .shot-card li b { color: var(--ink); font-weight: 700; }
    .gallery-intro { margin: -6px 0 14px; color: var(--muted); font-size: 14px; max-width: 760px; }
    .gallery .shot-card h3 { font-size: 17px; }
    .gallery .shot-card p { margin: 6px 0 0; font-size: 14px; }
    .gallery-group { margin: 40px 0 10px; font-size: 13px; font-weight: 900; text-transform: uppercase; letter-spacing: .06em; color: var(--gold); }
    .lightbox { position: fixed; inset: 0; z-index: 50; display: none; align-items: center; justify-content: center; padding: 16px; background: rgba(0,0,0,.88); cursor: zoom-out; }
    .lightbox.open { display: flex; }
    .lightbox img { max-height: 92vh; border-radius: 8px; }
    .updates { display: grid; gap: 12px; }
    .update { display: grid; grid-template-columns: 130px 1fr; gap: 16px; border: 1px solid var(--line); border-radius: 8px; background: var(--card); padding: 16px 18px; }
    .update time { font-weight: 900; color: var(--gold); font-size: 14px; }
    .update b { color: var(--green-800); }
    .update p { margin: 4px 0 0; color: var(--muted); font-size: 14px; }

    .trust { background: var(--card); border-bottom: 1px solid var(--line); }
    .trust-inner { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; padding: 18px 0; }
    .trust-item { display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 700; color: var(--ink); }
    .trust-item span { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: rgba(63,191,143,.14); color: var(--green-800); font-weight: 900; }
    .price-card .btn { margin-top: 18px; min-height: 42px; font-size: 14px; }
    .mid-cta { margin-top: 36px; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; padding: 24px 26px; border: 1px solid var(--line); border-radius: 12px; background: linear-gradient(135deg, #15241d, var(--card)); }
    .mid-cta b { display: block; font-size: 20px; color: var(--ink); }
    .mid-cta p { margin: 4px 0 0; color: var(--muted); }
    .wa-float { position: fixed; right: 16px; bottom: 16px; z-index: 40; display: inline-flex; align-items: center; gap: 8px; min-height: 52px; padding: 0 18px; border-radius: 999px; background: #25d366; color: #062b14; font-weight: 900; text-decoration: none; box-shadow: 0 10px 30px rgba(0,0,0,.45); }
    .wa-float svg { width: 22px; height: 22px; }

    footer { padding: 28px 0; background: #08090b; border-top: 1px solid var(--line); color: rgba(255,255,255,.7); font-size: 14px; }
    .footer-inner { display: flex; justify-content: space-between; gap: 18px; flex-wrap: wrap; }

    @media (max-width: 920px) {
      .hero-grid, .section-head, .grid-2 { grid-template-columns: 1fr; }
      .grid-3, .grid-4, .price-grid, .warranty-grid { grid-template-columns: 1fr 1fr; }
      .flow { grid-template-columns: repeat(2, 1fr); }
      .feature-list { grid-template-columns: 1fr; }
      .gallery { grid-template-columns: 1fr 1fr; }
      .trust-inner { grid-template-columns: 1fr 1fr; }
      .nav-links { display: none; }
      .browser { transform: none; }
    }

    @media (max-width: 560px) {
      section { padding: 58px 0; }
      .hero-grid { padding: 54px 0; }
      .flow, .grid-3, .grid-4, .price-grid, .warranty-grid, .gallery { grid-template-columns: 1fr; }
      .update { grid-template-columns: 1fr; gap: 4px; }
      .wa-float span { display: none; }
      .wa-float { padding: 0 15px; }
      .browser img { height: 260px; }
    }
  </style>
</head>
<body>
  <nav class="nav">
    <div class="wrap nav-inner">
      <a class="brand" href="#top" aria-label="TAQWA-Hub">
        <img src="{{ asset('taqwa-hub-full/logo.png') }}" alt="Logo TAQWA-Hub">
        <span>TAQWA-Hub</span>
      </a>
      <div class="nav-links">
        <a href="#pilar">3 Pilar</a>
        <a href="#terbaru">Terbaru</a>
        <a href="#tampilan">Tampilan</a>
        <a href="#sim-tpq">SIM TPQ</a>
        <a href="#harga">Harga</a>
        <a href="#garansi">Garansi</a>
        <a href="#perbandingan">Perbandingan</a>
        <a href="#faq">FAQ</a>
        <a class="btn btn-primary" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin konsultasi TAQWA-Hub untuk masjid.') }}" target="_blank" rel="noopener">Konsultasi WhatsApp</a>
      </div>
    </div>
  </nav>

  <header id="top" class="hero">
    <div class="wrap hero-grid">
      <div>
        <span class="eyebrow">Versi 1.7 &middot; Pembaruan Oktober 2026</span>
        <h1>Urus Masjid <span>Lebih Tenang</span>, dari HP di Tangan</h1>
        <p class="lead">TAQWA-Hub kini mencakup tiga pilar pengelolaan masjid: <b>Riayah</b> (audio 8-kanal, jadwal sholat, TV masjid), <b>Imarah</b> (falak, kegiatan, SIM TPQ, paket Ramadan), dan <b>Idarah</b> (keuangan, zakat, aset, hak akses pengurus). Semuanya dalam satu perangkat dan bekerja penuh tanpa internet.</p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin konsultasi TAQWA-Hub untuk masjid.') }}" target="_blank" rel="noopener">Konsultasi untuk Masjid Anda</a>
          <a class="btn btn-ghost" href="#tampilan">Lihat Tampilan Aplikasi</a>
        </div>
        <div class="hero-note">Harga mulai <b style="color:var(--gold)">Rp 3,5 juta</b>, sekali beli. Update software gratis selamanya. Sudah berjalan aktif di masjid produksi sejak Juni 2026.</div>
      </div>
      <div class="browser" aria-label="Screenshot Dashboard TAQWA-Hub">
        <div class="browser-bar"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
        <img src="{{ asset('taqwa-hub-full/screenshots/2026-10/mode.jpg') }}" alt="Dashboard Mode Ibadah TAQWA-Hub v1.7">
      </div>
    </div>
  </header>

  <div class="trust">
    <div class="wrap trust-inner">
      <div class="trust-item"><span>&#10003;</span>Jalan penuh tanpa internet</div>
      <div class="trust-item"><span>&#10003;</span>Tanpa biaya langganan</div>
      <div class="trust-item"><span>&#10003;</span>Update software gratis</div>
      <div class="trust-item"><span>&#10003;</span>Pakai speaker yang sudah ada</div>
    </div>
  </div>

  <section class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Masalah Harian Pengurus Masjid</h2>
        <p>Jadwal, audio, TV, pengumuman, dan kabar pengurus sering tersebar di banyak alat berbeda.</p>
      </div>
      <div class="grid-4">
        <div class="box problem"><b>Jadwal manual</b><p>Rawan lupa update dan tidak selalu sinkron dengan tampilan TV.</p></div>
        <div class="box problem"><b>Mixer rumit</b><p>Tidak semua takmir nyaman mengatur banyak kanal audio.</p></div>
        <div class="box problem"><b>TV terpisah</b><p>Banner, iqomah, dan informasi jamaah perlu operator sendiri.</p></div>
        <div class="box problem"><b>Tidak ada alert</b><p>Gangguan sering baru diketahui saat jamaah mulai merasakan.</p></div>
      </div>
    </div>
  </section>

  <section id="pilar">
    <div class="wrap">
      <div class="section-head">
        <h2>Tiga Pilar dalam Satu Dashboard</h2>
        <p>Menu dikelompokkan mengikuti tiga pilar manajemen masjid. Setiap pengurus hanya melihat menu yang menjadi wewenangnya.</p>
      </div>
      <div class="grid-3">
        <div class="box pillar"><span class="tag">Riayah &middot; Pemeliharaan</span><h3>Suara, Jadwal &amp; Perangkat</h3>
          <ul>
            <li>Mixer digital 8 kanal dengan DSP (EQ, kompresor, gate, anti-feedback)</li>
            <li>Mode ibadah sekali tekan: Umum, Adzan, Sholat, Murottal, Kajian, Jum'at</li>
            <li>Zona speaker, kalibrasi batas kenyaringan, dan kesehatan suara per zona</li>
            <li>Analitik SPL, tren komunikasi, laporan harian, dan log kontrol</li>
            <li>Waktu sholat, jadwal mode otomatis, tilawah terjadwal, dan TV Display</li>
            <li>Mode pantau kepatuhan pengeras suara luar sesuai SE Menag 05/2022</li>
          </ul></div>
        <div class="box pillar imarah"><span class="tag">Imarah &middot; Kemakmuran</span><h3>Falak, Kegiatan &amp; TPQ</h3>
          <ul>
            <li>Paket Falak: kalender Hijriah, fase bulan, puasa sunnah, arah kiblat, Rashdul Kiblat, gerhana</li>
            <li>Malam Rukyat, simulasi hilal, dan hasil rukyat MOONLIGHT yang tampil otomatis</li>
            <li>Pengumuman berita duka (lelayu) ke TV dan WhatsApp</li>
            <li>Jadwal petugas pekanan dan arsip rekaman kajian &amp; khutbah</li>
            <li>Paket Ramadan: imsakiyah, jadwal tarawih &amp; takjil, pendaftaran i'tikaf</li>
            <li>SIM TPQ terintegrasi dengan satu pintu login</li>
          </ul></div>
        <div class="box pillar idarah"><span class="tag">Idarah &middot; Administrasi</span><h3>Keuangan, Aset &amp; Pengguna</h3>
          <ul>
            <li>Saldo per dana (infaq, lainnya, wakaf, zakat) dan pencatatan transaksi</li>
            <li>Laporan bulanan unduh Excel dan teks Laporan Kas Jum'at siap dibacakan</li>
            <li>Program Panitia Zakat (per asnaf) dan Panitia Pembangunan</li>
            <li>Inventaris aset masjid dan peminjaman barang</li>
            <li>Pengguna &amp; hak akses berbasis peran, PIN, dan kode darurat</li>
            <li>Cadangan &amp; pemulihan, serta pembaruan aplikasi sekali klik</li>
          </ul></div>
      </div>
    </div>
  </section>

  <section id="terbaru">
    <div class="wrap">
      <div class="section-head">
        <h2>Yang Baru Sejak Versi 1.7</h2>
        <p>Pembaruan dikirim lewat software, tanpa ganti perangkat. Berikut ringkasan rilis terbaru.</p>
      </div>
      <div class="updates">
        <div class="update"><time>Okt 2026</time><div><b>Paket Ramadan &amp; Kegiatan</b><p>Imsakiyah, jadwal tarawih &amp; takjil, pendaftaran i'tikaf 10 malam terakhir dengan kapasitas L/P, jadwal petugas pekanan, arsip kajian &amp; khutbah, serta berita duka ke TV dan WhatsApp.</p></div></div>
        <div class="update"><time>Okt 2026</time><div><b>Administrasi Masjid</b><p>Laporan Kas Jum'at otomatis, peminjaman barang masjid, kesehatan suara per zona, dan mode pantau kepatuhan pengeras luar (SE Menag 05/2022), termasuk pengecualian takbiran dan salat Id.</p></div></div>
        <div class="update"><time>Okt 2026</time><div><b>Integrasi MOONLIGHT</b><p>Hasil rukyat dari teleskop MOONLIGHT tampil otomatis di menu Imarah.</p></div></div>
        <div class="update"><time>Sep 2026</time><div><b>Navigasi 3 Pilar &amp; Hak Akses</b><p>Dashboard ditata ulang menjadi Riayah, Imarah, dan Idarah. Ada manajemen pengguna berbasis peran dan satu pintu login untuk PIN utama dan SIM TPQ.</p></div></div>
        <div class="update"><time>Sep 2026</time><div><b>Paket Falak</b><p>Kalender Hijriah, fase bulan, puasa sunnah, arah kiblat &amp; Rashdul Kiblat, Malam Rukyat, simulasi hilal, dan kalkulator gerhana, lengkap dengan slide TV dan pengumuman WhatsApp terjadwal.</p></div></div>
        <div class="update"><time>Sep 2026</time><div><b>Perangkat &amp; TV</b><p>Tab Zona baru, tema, display 7-segment pada Node, slide aktivitas MOONLIGHT, dan TV kiosk yang otomatis memuat slide terbaru.</p></div></div>
      </div>
    </div>
  </section>

  <section id="sim-tpq" class="soft">
    <div class="wrap">
      <div class="section-head">
        <div>
          <span class="eyebrow" style="color:var(--green-800); background:rgba(63,191,143,.12);">Terintegrasi di Imarah</span>
          <h2>Sistem Informasi Manajemen TPQ</h2>
        </div>
        <p>Untuk masjid yang mengelola TPQ/TPA — data santri, presensi, hafalan, dan pembayaran dalam satu sistem, menggantikan buku catatan dan grup WhatsApp yang tercecer.</p>
      </div>
      <div class="grid-4">
        <div class="box"><b>Manajemen Santri</b><p>Data lengkap santri, kelas, wali, dan status aktif/lulus/pindah.</p></div>
        <div class="box"><b>Presensi Digital</b><p>Hadir, izin, sakit, alfa — rekap otomatis harian sampai per semester.</p></div>
        <div class="box"><b>Perkembangan Bacaan</b><p>Catatan Iqra/Al-Qur'an, jilid, tajwid, dan makhraj per santri.</p></div>
        <div class="box"><b>Hafalan & Doa Harian</b><p>Target dan capaian surat pendek, doa harian, serta bacaan shalat.</p></div>
        <div class="box"><b>Pembayaran/Infaq</b><p>Rekap SPP, buku Iqra, seragam, dan status lunas/belum lunas.</p></div>
        <div class="box"><b>Laporan Otomatis</b><p>Rekap santri, presensi, bacaan, hafalan, dan pembayaran siap cetak.</p></div>
        <div class="box"><b>Kelas & Pengajar</b><p>Jadwal, kapasitas kelas, serta data ustadz/ustadzah yang mengajar.</p></div>
        <div class="box"><b>Kabar Wali via WhatsApp</b><p>Info perkembangan santri dan pengingat pembayaran ke wali santri.</p></div>
      </div>
    </div>
  </section>

  <section id="alur">
    <div class="wrap">
      <div class="section-head">
        <h2>Mulai Pakai dalam 4 Langkah</h2>
        <p>Dibuat untuk pengurus masjid — bukan untuk teknisi.</p>
      </div>
      <div class="flow">
        <div class="step"><div class="num">1</div><h3>Unit Dipasang Sekali</h3><p>Tim teknis memasang Unit Utama dan menyambungkannya ke speaker masjid yang sudah ada.</p></div>
        <div class="step"><div class="num">2</div><h3>Buka dari HP</h3><p>Takmir cukup buka alamat web dari HP atau tablet mana saja yang terhubung ke WiFi masjid.</p></div>
        <div class="step"><div class="num">3</div><h3>Atur Sekali di Awal</h3><p>Isi nama masjid, jadwal kajian, dan nomor WhatsApp grup pengurus — sistem jalan sendiri setelahnya.</p></div>
        <div class="step"><div class="num">4</div><h3>Pantau dari Mana Saja</h3><p>Cek status masjid, ganti pengumuman, atau nyalakan mode kajian — dari rumah sekalipun.</p></div>
      </div>
    </div>
  </section>

  <section id="fitur" class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Fitur Utama</h2>
        <p>Dibangun untuk kebutuhan operasional masjid sehari-hari — cepat dipahami dan mudah diakses.</p>
      </div>
      <div class="feature-list">
        <div class="feature"><span class="check">OK</span><div><b>Jadwal Sholat Otomatis</b><span>Perhitungan ephemeris presisi (VSOP87), akurat tanpa internet.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Audio 8 Kanal DSP</b><span>Imam, khatib, muadzin, kajian, murottal, dan cadangan — kontrol per kanal.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>TV Masjid Otomatis</b><span>Jadwal, info kajian, QR infaq, dan overlay iqomah berganti sendiri.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Notifikasi WhatsApp</b><span>Kabar otomatis ke pengurus saat adzan, iqomah, atau ada node offline.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Telemetri Suara</b><span>Sensor SPL per zona speaker via ESP32, deteksi otomatis zona mati.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Update Satu Klik</b><span>Pembaruan aplikasi tanpa perlu teknisi datang ke lokasi.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>SIM TPQ</b><span>Data santri, presensi, hafalan, dan pembayaran TPQ dalam satu sistem.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Falak &amp; Rukyat</b><span>Kalender Hijriah, arah kiblat, gerhana, dan hasil rukyat MOONLIGHT.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Keuangan Masjid</b><span>Saldo per dana, laporan bulanan Excel, dan Laporan Kas Jum'at.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Hak Akses Pengurus</b><span>Peran per pengguna, sehingga bendahara, takmir, dan ustadz TPQ hanya membuka menunya masing-masing.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Paket Ramadan</b><span>Imsakiyah, tarawih &amp; takjil, serta pendaftaran i'tikaf.</span></div></div>
      </div>
    </div>
  </section>

  <section id="tampilan">
    <div class="wrap">
      <div class="section-head">
        <h2>Tampilan Aplikasi</h2>
        <p>Tangkapan layar asli TAQWA-Hub v1.7 (Oktober 2026). Setiap kartu menunjukkan letak menu di dashboard dan isinya. Klik gambar untuk memperbesar.</p>
      </div>
      <div class="gallery-group">Riayah: Audio &amp; Perangkat</div>
      <p class="gallery-intro">Menu harian takmir untuk mengatur suara masjid. Semua bisa dioperasikan dari HP tanpa menyentuh mixer fisik.</p>
      <div class="gallery">
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/mode.jpg') }}" alt="Mode Ibadah — TAQWA-Hub"><div><span class="shot-loc">Riayah › Mode</span><h3>Mode Ibadah</h3><p>Enam preset siap pakai. Satu ketukan mengatur ulang semua kanal dan zona speaker.</p><ul><li><b>Umum, Adzan, Sholat, Murottal, Kajian, Jum'at</b>, masing-masing dengan rute speaker dalam/serambi/luar</li><li>Tabel status kanal per mode: mana yang aktif, mana yang dibisukan</li><li>Bisa berganti otomatis mengikuti jadwal sholat</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/mixer.jpg') }}" alt="Mixer &amp; DSP 8 Kanal — TAQWA-Hub"><div><span class="shot-loc">Riayah › Mixer</span><h3>Mixer &amp; DSP 8 Kanal</h3><p>Imam, muadzin, khatib, pengumuman, kajian 1/2, murottal, dan cadangan dalam satu layar.</p><ul><li>Fader, meter level, dan tombol mute per kanal</li><li><b>EQ 4-band + high-pass</b>, noise gate, kompresor, delay, dan reverb</li><li><b>Notch anti-feedback</b> untuk meredam dengung mikrofon</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/zona.jpg') }}" alt="Zona Speaker — TAQWA-Hub"><div><span class="shot-loc">Riayah › Zona</span><h3>Zona Speaker</h3><p>Kendali tiap zona speaker: mihrab, depan, tengah, belakang, serambi, dan luar.</p><ul><li>Gain dan treble per zona, pilihan preset P1/P2</li><li><b>Mute grup</b> sekali tekan, misalnya mematikan semua speaker luar</li><li>Ringkasan zona aktif, terputus, bisu, dan peringatan</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/analitik.jpg') }}" alt="Analitik &amp; Telemetri — TAQWA-Hub"><div><span class="shot-loc">Riayah › Analitik</span><h3>Analitik &amp; Telemetri</h3><p>Pantau kesehatan jaringan Node speaker dan level suara secara langsung.</p><ul><li>Kartu ringkas: zona online, <b>rata-rata SPL</b>, SPL tertinggi, jumlah peringatan</li><li>Statistik komunikasi Node: siklus, ACK, gagal, timeout, uptime</li><li>Grafik tren 1 jam s.d. 24 jam, ekspor CSV, laporan harian, dan log kontrol</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/kalibrasi-zona.jpg') }}" alt="Kalibrasi Kenyaringan — TAQWA-Hub"><div><span class="shot-loc">Pengaturan › Zona &amp; Kenyaringan</span><h3>Kalibrasi Kenyaringan</h3><p>Menjaga suara tetap nyaman dan sesuai aturan di setiap area masjid.</p><ul><li>Penamaan zona sesuai denah masjid</li><li><b>Batas minimum, target, dan maksimum dB</b> per zona</li><li>Penyesuaian otomatis dan koreksi manual, mendukung kepatuhan SE Menag 05/2022</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/status.jpg') }}" alt="Status &amp; Info — TAQWA-Hub"><div><span class="shot-loc">Pengaturan › Status</span><h3>Status &amp; Info</h3><p>Halaman pertama saat ada keluhan, berisi kondisi seluruh sistem dalam satu pandangan.</p><ul><li>Kondisi, paket perangkat, mode aktif, gateway, zona menyala, audio</li><li><b>QR alamat dashboard</b> untuk dibuka cepat dari HP pengurus</li><li>Panduan cepat 5 langkah untuk pengurus baru</li></ul></div></div>
      </div>
      <div class="gallery-group">Riayah: Jadwal, TV &amp; Sistem</div>
      <p class="gallery-intro">Pengaturan sekali di awal, setelah itu sistem berjalan sendiri. Perawatan dilakukan jarak jauh.</p>
      <div class="gallery">
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/waktu-sholat.jpg') }}" alt="Waktu Sholat &amp; Identitas Masjid — TAQWA-Hub"><div><span class="shot-loc">Pengaturan › Waktu Sholat</span><h3>Waktu Sholat &amp; Identitas Masjid</h3><p>Jadwal dihitung sendiri oleh perangkat dan tetap akurat tanpa internet.</p><ul><li>Nama, alamat, dan teks berjalan masjid untuk TV</li><li><b>Koordinat, zona waktu, sudut subuh</b> mengikuti organisasi yang dipakai</li><li>Kalender Hijriah (perhitungan astronomi atau MABIMS) dan pilihan puasa sunnah</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/tv-display.jpg') }}" alt="TV Display — TAQWA-Hub"><div><span class="shot-loc">Pengaturan › TV Display</span><h3>TV Display</h3><p>Mengatur tampilan TV masjid dari HP, tanpa remote dan tanpa laptop.</p><ul><li><b>Kontrol darurat</b>: bersihkan layar, muat ulang, uji tampilan adzan</li><li>Ukuran tulisan, gambar latar, dan banner berjalan dengan pilihan warna</li><li>Slide jadwal, iqomah, falak, kegiatan, dan QR infaq bergantian otomatis</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/tilawah.jpg') }}" alt="Tilawah Terjadwal — TAQWA-Hub"><div><span class="shot-loc">Pengaturan › Tilawah</span><h3>Tilawah Terjadwal</h3><p>Murottal diputar otomatis tanpa operator.</p><ul><li>Pustaka file MP3, unggah langsung dari HP</li><li><b>Jadwal bebas</b> 5 slot per hari untuk tiap hari dalam sepekan</li><li>Tilawah <b>sebelum waktu sholat</b> (menit sebelumnya per waktu), berhenti otomatis saat adzan</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/jaringan.jpg') }}" alt="Jaringan &amp; Waktu — TAQWA-Hub"><div><span class="shot-loc">Pengaturan › Jaringan</span><h3>Jaringan &amp; Waktu</h3><p>Perangkat tetap bisa diakses walau WiFi masjid bermasalah.</p><ul><li>Jam sistem dengan sinkron internet atau atur manual</li><li><b>Mode jaringan otomatis</b>: ikut WiFi masjid, jika gagal membuat hotspot sendiri</li><li>Daftar WiFi tersimpan dan pemantauan jarak jauh ke TAQWA-Central</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/pembaruan.jpg') }}" alt="Pembaruan Sekali Klik — TAQWA-Hub"><div><span class="shot-loc">Pengaturan › Pembaruan</span><h3>Pembaruan Sekali Klik</h3><p>Fitur baru masuk tanpa teknisi datang ke lokasi.</p><ul><li>Cek pembaruan aplikasi Hub beserta catatan perubahannya</li><li><b>Pembaruan firmware Master Node</b> dari jarak jauh atau dari berkas</li><li>Versi terpasang dan versi terbaru ditampilkan berdampingan</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/keamanan.jpg') }}" alt="Keamanan &amp; Pengguna — TAQWA-Hub"><div><span class="shot-loc">Pengaturan › Keamanan</span><h3>Keamanan &amp; Pengguna</h3><p>Setiap pengurus punya akun dan wewenangnya sendiri.</p><ul><li><b>Kode darurat sekali pakai</b> jika PIN lupa</li><li>Ganti PIN admin dengan konfirmasi</li><li>Tambah pengguna dan centang hak akses per menu (audio, jadwal, aset, jaringan, dan lain-lain)</li></ul></div></div>
      </div>
      <div class="gallery-group">Imarah &amp; Idarah</div>
      <p class="gallery-intro">Kegiatan, pendidikan, dan administrasi masjid. Data tersimpan di perangkat masjid sendiri dan ikut dicadangkan.</p>
      <div class="gallery">
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/falak.jpg') }}" alt="Falak — TAQWA-Hub"><div><span class="shot-loc">Imarah › Falak</span><h3>Falak</h3><p>Ilmu falak praktis untuk jamaah, tersaji otomatis di dashboard dan TV.</p><ul><li>Kalender Hijriah hari ini</li><li><b>Arah kiblat</b> dan jadwal Rashdul Kiblat berikutnya</li><li>Malam rukyat berikutnya serta perkiraan gerhana bulan dan matahari</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/kegiatan.jpg') }}" alt="Kegiatan Masjid — TAQWA-Hub"><div><span class="shot-loc">Imarah › Kegiatan</span><h3>Kegiatan Masjid</h3><p>Satu tempat untuk semua informasi kegiatan yang perlu diumumkan.</p><ul><li><b>Berita duka (lelayu)</b> langsung tampil di TV dan terkirim ke WhatsApp</li><li>Hasil rukyat dari teleskop MOONLIGHT dan jadwal petugas pekanan</li><li>Arsip rekaman kajian &amp; khutbah serta imsakiyah Ramadan</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/sim-tpq.jpg') }}" alt="SIM TPQ — TAQWA-Hub"><div><span class="shot-loc">Imarah › TPQ</span><h3>SIM TPQ</h3><p>Sistem Informasi Manajemen TPQ terpadu, cukup satu kali login.</p><ul><li>Menu santri, kelas, pengajar, jadwal, presensi, hafalan, pembayaran, raport</li><li><b>Catatan perkembangan bacaan</b>: Iqra/Al-Qur'an, jilid, halaman, kelancaran, tajwid</li><li>Riwayat bacaan yang bisa diekspor ke CSV dan PDF</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/keuangan.jpg') }}" alt="Keuangan Masjid — TAQWA-Hub"><div><span class="shot-loc">Idarah › Keuangan</span><h3>Keuangan Masjid</h3><p>Pembukuan kas masjid yang rapi dan transparan.</p><ul><li><b>Saldo per dana</b>: infaq, lain-lain, wakaf (terikat), dan zakat (terikat)</li><li>Catat pemasukan/pengeluaran, laporan bulanan unduh Excel</li><li><b>Laporan Kas Jum'at</b> otomatis, siap disalin dan dibacakan</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/zakat.jpg') }}" alt="Panitia Zakat — TAQWA-Hub"><div><span class="shot-loc">Idarah › Program</span><h3>Panitia Zakat</h3><p>Pencatatan zakat yang tertib sesuai asnaf.</p><ul><li>Ringkasan jumlah data dan total dana</li><li>Input nama, <b>asnaf</b> (fakir, miskin, dan lainnya), jumlah, keterangan</li><li>Juga tersedia program Panitia Pembangunan dengan status pekerjaan</li></ul></div></div>
        <div class="box shot-card"><img loading="lazy" src="{{ asset('taqwa-hub-full/screenshots/2026-10/aset.jpg') }}" alt="Aset &amp; Peminjaman — TAQWA-Hub"><div><span class="shot-loc">Pengaturan › Aset Masjid</span><h3>Aset &amp; Peminjaman</h3><p>Inventaris barang masjid tidak lagi tercecer di buku.</p><ul><li>Daftar aset dengan kategori, kondisi, lokasi, dan tahun perolehan</li><li><b>Peminjaman barang</b>: nama peminjam, nomor WA, tanggal kembali</li><li>Pengingat pengembalian via WhatsApp dan riwayat peminjaman</li></ul></div></div>
      </div>
    </div>
  </section>
  <div class="wrap mid-cta" style="margin-bottom:60px;">
    <div><b>Ingin melihatnya berjalan langsung?</b><p>Demo 10 menit: dashboard, kontrol audio, dan tampilan TV, cukup lewat video call atau datang ke lokasi.</p></div>
    <a class="btn btn-primary" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin jadwalkan demo 10 menit TAQWA-Hub.') }}" target="_blank" rel="noopener">Jadwalkan Demo</a>
  </div>
  <div class="lightbox" id="lightbox" aria-hidden="true"><img alt=""></div>

  <section id="manfaat" class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Bukan Janji, Sudah Terbukti Berjalan</h2>
        <p>Hasil pengujian dan penerapan nyata di masjid produksi.</p>
      </div>
      <div class="grid-4">
        <div class="stat"><b>3 Pilar</b><span>Riayah, Imarah, Idarah dalam satu perangkat</span></div>
        <div class="stat"><b>0</b><span>Dropout audio pada 8 kanal penuh</span></div>
        <div class="stat"><b>Sejak Jun 2026</b><span>Aktif di masjid produksi tanpa insiden kritis</span></div>
        <div class="stat"><b>3 Platform</b><span>SBC dibenchmark (RPi4, RPi3, Orange Pi Zero 3)</span></div>
      </div>
      <div class="quote" style="margin-top:28px;">
        <p>"Sejak pakai ini, jadwal sholat dan suara masjid jalan sendiri. Pengurus tidak perlu lagi bolak-balik cek amplifier tiap mau sholat."</p>
        <span>— Pengalaman pengguna di masjid percontohan</span>
      </div>
    </div>
  </section>

  <section id="harga" class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Spesifikasi & Harga Paket</h2>
        <p>Beli perangkatnya sekali — kemampuannya terus berkembang lewat update software, tanpa ganti hardware.</p>
      </div>
      <div class="price-grid">
        <div class="price-card">
          <h3>Harga Perangkat</h3>
          <div class="sub">Unit dasar</div>
          <div class="price">Rp 3.500.000</div>
          <ul>
            <li>Mesin utama TAQWA-Hub</li>
            <li>Fondasi awal digitalisasi masjid</li>
            <li>Bisa tampil di TV masjid</li>
            <li>Basis peningkatan fitur berikutnya</li>
            <li>Cocok untuk mulai bertahap</li>
            <li>Termasuk Sistem Informasi Manajemen TPQ</li>
          </ul>
          <a class="btn btn-ghost" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin tanya TAQWA-Hub Harga Perangkat untuk masjid kami.') }}" target="_blank" rel="noopener">Tanya paket ini</a>
        </div>
        <div class="price-card">
          <h3>Paket Ekonomis</h3>
          <div class="sub">2 kanal produksi</div>
          <div class="price">Rp 5.500.000</div>
          <ul>
            <li>Unit komputasi utama 2GB+ atau setara</li>
            <li>USB soundcard 2 kanal</li>
            <li>Mic 4-6 masuk mixer analog kecil</li>
            <li>Output bus dalam dan luar/horn</li>
            <li>Cocok untuk masjid kecil-menengah</li>
            <li>Termasuk Sistem Informasi Manajemen TPQ</li>
          </ul>
          <a class="btn btn-ghost" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin tanya TAQWA-Hub Paket Ekonomis untuk masjid kami.') }}" target="_blank" rel="noopener">Tanya paket ini</a>
        </div>
        <div class="price-card featured">
          <h3>Paket Rekomendasi</h3>
          <div class="sub">4 kanal pilot/produksi</div>
          <div class="price">Rp 7.000.000</div>
          <ul>
            <li>Unit komputasi utama 2GB+</li>
            <li>USB soundcard 4 kanal</li>
            <li>Imam, khatib, muadzin, kajian</li>
            <li>Sample rate 48 kHz</li>
            <li>Lebih terpisah, tetap ekonomis</li>
            <li>Termasuk Sistem Informasi Manajemen TPQ</li>
          </ul>
          <a class="btn btn-primary" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin tanya TAQWA-Hub Paket Rekomendasi untuk masjid kami.') }}" target="_blank" rel="noopener">Tanya paket ini</a>
        </div>
        <div class="price-card">
          <h3>Paket Advance</h3>
          <div class="sub">8 kanal riset/besar</div>
          <div class="price">Rp 9.500.000</div>
          <ul>
            <li>Unit komputasi utama atau setara kuat</li>
            <li>Behringer UMC1820 atau setara</li>
            <li>Imam, muadzin, khatib, pengumuman</li>
            <li>Kajian 1/2, murottal, cadangan</li>
            <li>Cocok untuk masjid besar/kompleks</li>
            <li>Termasuk Sistem Informasi Manajemen TPQ</li>
          </ul>
          <a class="btn btn-ghost" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin tanya TAQWA-Hub Paket Advance untuk masjid kami.') }}" target="_blank" rel="noopener">Tanya paket ini</a>
        </div>
      </div>
      <div class="price-note"><b>Update software</b> dapat menambah fitur dan memperbaiki sistem tanpa ganti hardware — selama fitur baru tidak membutuhkan perangkat fisik tambahan. Contoh: stabilitas audio, TV display tambahan, AP fallback, OTP WhatsApp, tombol reboot, diagnostik, dan peningkatan notifikasi.</div>
    </div>
  </section>

  <section id="garansi" class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Garansi dan Dukungan</h2>
        <p>Perangkat bergaransi, software didukung selama dipakai, dan bantuan teknis cukup lewat WhatsApp.</p>
      </div>
      <div class="warranty-grid">
        <div class="warranty-card">
          <div class="icon">1Y</div>
          <b>Garansi Perangkat</b>
          <p>1 tahun sejak tanggal pemasangan, mencakup kerusakan hardware unit utama di luar kesalahan pemakaian.</p>
        </div>
        <div class="warranty-card">
          <div class="icon">SW</div>
          <b>Dukungan Software</b>
          <p>Selama unit aktif digunakan. Update fitur dan perbaikan sistem dikirim gratis selamanya lewat pembaruan aplikasi — tidak ada biaya langganan.</p>
        </div>
        <div class="warranty-card">
          <div class="icon">TK</div>
          <b>Kunjungan Teknisi</b>
          <p>Termasuk 1x kunjungan untuk pemasangan awal dan pelatihan singkat pengurus. Kunjungan perbaikan selama masa garansi gratis dalam radius 30 km dari kantor Shatomedia; di luar itu atau di luar masa garansi dikenakan biaya transport sesuai jarak, mulai Rp 150.000.</p>
        </div>
        <div class="warranty-card">
          <div class="icon">WA</div>
          <b>Remote Support via WhatsApp</b>
          <p>Konsultasi dan bantuan teknis jarak jauh melalui WhatsApp CS, Senin–Sabtu pukul 08.00–17.00 WIB. Pesan dibalas paling lambat 1x24 jam kerja; gangguan yang membuat adzan atau sholat terganggu diprioritaskan.</p>
        </div>
        <div class="warranty-card">
          <div class="icon">UP</div>
          <b>Update Gratis atau Berbayar?</b>
          <p>Update software <b>gratis selamanya</b>, termasuk dalam harga perangkat. Perangkat fisik tambahan (jika suatu saat diperlukan fitur baru) dihitung terpisah.</p>
        </div>
        <div class="warranty-card">
          <div class="icon">?</div>
          <b>Di Luar Cakupan Garansi</b>
          <p>Kerusakan akibat petir, tegangan listrik tidak stabil, air/kelembapan, jatuh atau benturan, pembongkaran atau instalasi ulang oleh pihak lain, serta bencana alam. Perbaikan tetap dapat dilayani dengan biaya suku cadang dan jasa.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="perbandingan">
    <div class="wrap">
      <div class="section-head">
        <h2>Perbandingan dengan Cara Manual</h2>
        <p>Ringkasan perbedaan operasional sebelum dan sesudah memakai TAQWA-Hub.</p>
      </div>
      <div class="compare-table-wrap">
        <table class="compare">
          <thead>
            <tr>
              <th>Aspek</th>
              <th>Cara Manual</th>
              <th>Dengan TAQWA-Hub</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Kontrol Audio</th>
              <td class="manual">Atur mixer manual tiap kanal, rawan salah setting saat buru-buru</td>
              <td class="taqwa">Preset mode (Adzan, Sholat, Kajian, Jum'at) — tinggal pilih satu tombol</td>
            </tr>
            <tr>
              <th scope="row">Jadwal Sholat</th>
              <td class="manual">Jadwal tempel/cetak, rawan lupa update tiap bulan</td>
              <td class="taqwa">Jadwal otomatis dari perhitungan ephemeris, selalu akurat tanpa update manual</td>
            </tr>
            <tr>
              <th scope="row">Tampilan TV Masjid</th>
              <td class="manual">TV statis atau tidak terpakai, info diumumkan lisan/manual</td>
              <td class="taqwa">TV dinamis: jadwal, countdown iqomah, banner event, dan QR infaq bergantian otomatis</td>
            </tr>
            <tr>
              <th scope="row">Gangguan Speaker</th>
              <td class="manual">Diketahui telat, biasanya setelah jamaah komplain saat sholat</td>
              <td class="taqwa">Notifikasi WhatsApp otomatis ke pengurus saat ada zona speaker bermasalah</td>
            </tr>
            <tr>
              <th scope="row">Kas &amp; Laporan</th>
              <td class="manual">Buku kas tulis tangan, laporan Jum'at disusun manual</td>
              <td class="taqwa">Saldo per dana otomatis, laporan bulanan Excel, dan teks Kas Jum'at siap dibacakan</td>
            </tr>
            <tr>
              <th scope="row">Kalender &amp; Falak</th>
              <td class="manual">Menunggu info awal bulan dan arah kiblat dari pihak luar</td>
              <td class="taqwa">Kalender Hijriah, Rashdul Kiblat, gerhana, dan hasil rukyat tampil di TV</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section id="faq" class="faq">
    <div class="wrap">
      <div class="section-head">
        <h2>Pertanyaan Umum</h2>
        <p>Yang biasanya ditanyakan takmir saat konsultasi awal.</p>
      </div>
      <details open><summary>Apakah harus ada internet?</summary><p>Tidak. Jadwal sholat, suara, dan tampilan TV tetap jalan tanpa internet. Internet hanya dipakai kalau ingin notifikasi WhatsApp otomatis.</p></details>
      <details><summary>Apakah rumit dipakai untuk pengurus yang tidak paham teknologi?</summary><p>Tidak. Tampilan dibuat sesederhana membuka halaman web di HP — tombol besar, bahasa Indonesia, tanpa istilah teknis.</p></details>
      <details><summary>Bagaimana kalau ada masalah atau alat rusak?</summary><p>Sistem otomatis mengirim peringatan ke WhatsApp grup pengurus kalau ada speaker atau bagian yang bermasalah — jadi bisa ditangani sebelum jamaah menyadari.</p></details>
      <details><summary>Apakah bisa dipasang di masjid dengan speaker yang sudah ada?</summary><p>Bisa. Unit ini disambungkan ke sistem suara yang sudah terpasang di masjid, tidak perlu ganti speaker lama.</p></details>
      <details><summary>Apakah bisa lihat demo dulu?</summary><p>Bisa. Kami menyediakan demo 10 menit untuk memperlihatkan dashboard, kontrol audio, dan tampilan TV secara langsung.</p></details>
      <details><summary>Apakah pengurus lain bisa ikut mengakses tanpa membuka semua menu?</summary><p>Bisa. Setiap pengurus punya akun dengan PIN sendiri. Bendahara bisa diberi akses keuangan saja, ustadz TPQ akses SIM TPQ saja, dan seterusnya.</p></details>
      <details><summary>Apakah pemilik unit lama ikut mendapat fitur baru?</summary><p>Ya. Fitur Falak, Ramadan, keuangan, dan hak akses dikirim lewat pembaruan software gratis tanpa ganti perangkat.</p></details>
    </div>
  </section>

  <section class="cta">
    <div class="wrap">
      <h2>Ingin Masjid Anda Lebih Mudah Diurus?</h2>
      <p>Lihat demo 10 menit, lalu putuskan bersama pengurus. Scan QR atau hubungi langsung via WhatsApp.</p>
      <div class="hero-actions">
        <a class="btn btn-primary" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin konsultasi TAQWA-Hub untuk masjid.') }}" target="_blank" rel="noopener">Konsultasi via WhatsApp</a>
        <a class="btn btn-ghost" href="mailto:shatomedia@gmail.com?subject=Konsultasi%20TAQWA-Hub">Email Shatomedia</a>
      </div>
      <div class="cta-qr"><img src="{{ asset('taqwa-hub-full/qr-wa.png') }}" alt="QR WhatsApp CS TAQWA-Hub"></div>
    </div>
  </section>

  <a class="wa-float" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin konsultasi TAQWA-Hub untuk masjid.') }}" target="_blank" rel="noopener" aria-label="Konsultasi via WhatsApp"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2Zm0 18.2a8.2 8.2 0 0 1-4.2-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2Zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1l-.8 1c-.1.2-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.2-.4.7-1.4.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.7 11.8 11.8 0 0 0 4.5 4c1.7.7 2.3.8 3.2.6a2.7 2.7 0 0 0 1.8-1.2 2.2 2.2 0 0 0 .2-1.3c-.1-.1-.3-.2-.5-.3Z"/></svg><span>Konsultasi</span></a>

  <footer>
    <div class="wrap footer-inner">
      <span>(c) 2026 Shatomedia - TAQWA-Hub</span>
      <span>WhatsApp: +62 857-4390-9116 | Email: shatomedia@gmail.com</span>
    </div>
  </footer>
  <script>
    (function () {
      var lb = document.getElementById('lightbox'), img = lb.querySelector('img');
      document.querySelectorAll('.gallery img').forEach(function (el) {
        el.addEventListener('click', function () { img.src = el.src; img.alt = el.alt; lb.classList.add('open'); });
      });
      lb.addEventListener('click', function () { lb.classList.remove('open'); });
      document.addEventListener('keydown', function (e) { if (e.key === 'Escape') lb.classList.remove('open'); });
    })();
  </script>
</body>
</html>
