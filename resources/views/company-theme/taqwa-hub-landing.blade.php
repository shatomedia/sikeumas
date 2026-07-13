<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TAQWA-Hub - Sistem Digital Manajemen Masjid</title>
  <meta name="description" content="TAQWA-Hub: satu perangkat yang menyatukan jadwal sholat, kontrol audio 8-kanal, tampilan TV masjid, dan notifikasi WhatsApp pengurus — bekerja penuh tanpa internet.">
  <style>
    :root {
      --ink: #16241c;
      --muted: #56705f;
      --green-950: #0d1912;
      --green-900: #123d2c;
      --green-800: #1f6b4d;
      --gold: #d9a441;
      --gold-deep: #a1770f;
      --red: #dc2626;
      --soft: #f4f8f5;
      --line: #dbe6de;
      --white: #ffffff;
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body { margin: 0; color: var(--ink); background: var(--white); font-family: Inter, "Segoe UI", Arial, sans-serif; line-height: 1.6; }
    a { color: inherit; }
    img { max-width: 100%; display: block; }
    .wrap { width: min(1120px, calc(100% - 32px)); margin: 0 auto; }

    .nav { position: sticky; top: 0; z-index: 10; background: rgba(255,255,255,.95); border-bottom: 1px solid var(--line); backdrop-filter: blur(10px); }
    .nav-inner { min-height: 66px; display: flex; align-items: center; justify-content: space-between; gap: 18px; }
    .brand { display: flex; align-items: center; gap: 10px; font-weight: 900; color: var(--green-800); text-decoration: none; }
    .brand img { width: 32px; height: 32px; border-radius: 8px; }
    .nav-links { display: flex; align-items: center; gap: 18px; font-size: 14px; font-weight: 700; color: var(--green-800); }
    .nav-links a { text-decoration: none; }

    .btn { display: inline-flex; align-items: center; justify-content: center; min-height: 46px; padding: 0 18px; border-radius: 8px; border: 1px solid transparent; text-decoration: none; font-weight: 800; line-height: 1.2; text-align: center; }
    .btn-primary { background: var(--gold); color: #241a05; }
    .btn-green { background: var(--green-800); color: #fff; }
    .btn-ghost { background: #fff; color: var(--green-800); border-color: var(--line); }

    .hero { background: linear-gradient(135deg, var(--green-950), var(--green-900) 52%, var(--green-800)); color: #fff; overflow: hidden; }
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

    .browser { border-radius: 18px; background: #0a140f; padding: 12px; box-shadow: 0 30px 80px rgba(0,0,0,.35); transform: rotate(1.2deg); }
    .browser-bar { height: 30px; display: flex; align-items: center; gap: 7px; padding: 0 6px; }
    .dot { width: 10px; height: 10px; border-radius: 50%; background: #64748b; }
    .browser img { border-radius: 10px; height: 380px; width: 100%; object-fit: cover; object-position: top; background: #fff; }

    section { padding: 82px 0; }
    .section-head { display: grid; grid-template-columns: .8fr 1fr; gap: 28px; align-items: end; margin-bottom: 28px; }
    .section-head p { margin: 0; color: var(--muted); font-size: 16px; }
    .soft { background: var(--soft); }
    .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
    .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; }
    .box { border: 1px solid var(--line); border-radius: 8px; background: #fff; padding: 22px; }
    .box p { margin: 10px 0 0; color: var(--muted); }
    .problem b { color: var(--red); }

    .flow { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; align-items: stretch; }
    .step { min-height: 156px; border: 1px solid var(--line); border-radius: 8px; background: #fff; padding: 18px; position: relative; }
    .num { width: 34px; height: 34px; border-radius: 50%; display: grid; place-items: center; background: var(--green-800); color: #fff; font-weight: 900; margin-bottom: 12px; }
    .step p { margin: 8px 0 0; color: var(--muted); font-size: 14px; line-height: 1.45; }

    .feature-list { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
    .feature { display: flex; gap: 12px; align-items: flex-start; border-bottom: 1px solid var(--line); padding: 14px 0; }
    .check { flex: none; width: 26px; height: 26px; border-radius: 50%; display: grid; place-items: center; background: #fdf3e3; color: var(--gold-deep); font-weight: 900; font-size: 13px; }
    .feature b { display: block; color: var(--green-800); }
    .feature span { display: block; color: var(--muted); margin-top: 3px; font-size: 14px; }

    .shot-card { overflow: hidden; padding: 0; }
    .shot-card img { width: 100%; height: 200px; object-fit: cover; object-position: top; background: var(--soft); border-bottom: 1px solid var(--line); }
    .shot-card div { padding: 16px; }

    .stat { text-align: center; padding: 26px 18px; border: 1px solid var(--line); background: #fff; }
    .stat b { display: block; font-size: 30px; color: var(--gold-deep); }
    .stat span { color: var(--muted); font-size: 14px; font-weight: 600; }

    .quote { background: var(--green-900); color: #f2ede0; border-radius: 16px; padding: 44px 40px; text-align: center; }
    .quote p { font-size: 22px; line-height: 1.5; font-weight: 600; max-width: 640px; margin: 0 auto 16px; }
    .quote span { font-size: 14px; opacity: .75; font-weight: 600; }

    .faq details { border-bottom: 1px solid var(--line); padding: 18px 0; }
    .faq summary { cursor: pointer; color: var(--green-800); font-weight: 900; font-size: 18px; list-style: none; }
    .faq summary::-webkit-details-marker { display: none; }
    .faq p { color: var(--muted); margin-bottom: 0; }

    .cta { background: var(--green-950); color: #fff; text-align: center; }
    .cta h2 { color: #fff; max-width: 780px; margin: 0 auto; }
    .cta p { max-width: 680px; margin: 18px auto 0; color: rgba(255,255,255,.76); font-size: 18px; }
    .cta .hero-actions { justify-content: center; }
    .cta-qr { width: 108px; height: 108px; padding: 8px; background: #fff; border: 6px solid var(--gold); margin: 24px auto 0; }
    .cta-qr img { width: 100%; height: 100%; }

    footer { padding: 28px 0; background: #060c08; color: rgba(255,255,255,.7); font-size: 14px; }
    .footer-inner { display: flex; justify-content: space-between; gap: 18px; flex-wrap: wrap; }

    @media (max-width: 920px) {
      .hero-grid, .section-head, .grid-2 { grid-template-columns: 1fr; }
      .grid-3, .grid-4 { grid-template-columns: 1fr 1fr; }
      .flow { grid-template-columns: repeat(2, 1fr); }
      .feature-list { grid-template-columns: 1fr; }
      .nav-links { display: none; }
      .browser { transform: none; }
    }

    @media (max-width: 560px) {
      section { padding: 58px 0; }
      .hero-grid { padding: 54px 0; }
      .flow, .grid-3, .grid-4 { grid-template-columns: 1fr; }
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
        <a href="#manfaat">Manfaat</a>
        <a href="#alur">Alur</a>
        <a href="#fitur">Fitur</a>
        <a href="#faq">FAQ</a>
        <a class="btn btn-primary" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin konsultasi TAQWA-Hub untuk masjid.') }}" target="_blank" rel="noopener">Konsultasi WhatsApp</a>
      </div>
    </div>
  </nav>

  <header id="top" class="hero">
    <div class="wrap hero-grid">
      <div>
        <span class="eyebrow">Sistem Digital Manajemen Masjid</span>
        <h1>Urus Masjid <span>Lebih Tenang</span>, dari HP di Tangan</h1>
        <p class="lead">TAQWA-Hub menyatukan jadwal sholat, kontrol audio 8-kanal, tampilan TV masjid, dan notifikasi WhatsApp pengurus — bekerja penuh tanpa internet, tanpa perlu ada operator yang selalu berjaga.</p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="https://wa.me/6285743909116?text={{ urlencode('Halo Shatomedia, saya ingin konsultasi TAQWA-Hub untuk masjid.') }}" target="_blank" rel="noopener">Konsultasi untuk Masjid Anda</a>
          <a class="btn btn-ghost" href="#alur">Lihat Cara Kerjanya</a>
        </div>
        <div class="hero-note">Sudah berjalan aktif di masjid produksi sejak Juni 2026.</div>
      </div>
      <div class="browser" aria-label="Screenshot Dashboard TAQWA-Hub">
        <div class="browser-bar"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
        <img src="{{ asset('taqwa-hub-full/screenshots/mode.png') }}" alt="Dashboard Mode Ibadah TAQWA-Hub">
      </div>
    </div>
  </header>

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
      </div>
    </div>
  </section>

  <section>
    <div class="wrap">
      <div class="section-head">
        <h2>Tampilan Aplikasi</h2>
        <p>Screenshot asli dashboard TAQWA-Hub untuk membantu takmir memahami bentuk sistemnya.</p>
      </div>
      <div class="grid-2">
        <div class="box shot-card"><img src="{{ asset('taqwa-hub-full/screenshots/mode.png') }}" alt="Mode Ibadah TAQWA-Hub"><div><h3>Mode Ibadah</h3><p>Pilih mode Umum, Adzan, Sholat, Murottal, Kajian, atau Jum'at dalam satu tombol.</p></div></div>
        <div class="box shot-card"><img src="{{ asset('taqwa-hub-full/screenshots/mixer.png') }}" alt="Mixer Audio TAQWA-Hub"><div><h3>Kontrol Audio</h3><p>Atur kanal imam, muadzin, khatib, kajian, dan murottal dari satu layar.</p></div></div>
        <div class="box shot-card"><img src="{{ asset('taqwa-hub-full/screenshots/tv.png') }}" alt="TV Display TAQWA-Hub"><div><h3>TV Display Masjid</h3><p>Jadwal sholat, iqomah, dan banner event tampil otomatis dan modern.</p></div></div>
        <div class="box shot-card"><img src="{{ asset('taqwa-hub-full/screenshots/analitik.png') }}" alt="Analitik Telemetri TAQWA-Hub"><div><h3>Analitik & Telemetri</h3><p>Pantau SPL tiap zona speaker, dapat peringatan otomatis jika ada gangguan.</p></div></div>
      </div>
    </div>
  </section>

  <section id="manfaat" class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Bukan Janji, Sudah Terbukti Berjalan</h2>
        <p>Hasil pengujian dan penerapan nyata di masjid produksi.</p>
      </div>
      <div class="grid-4">
        <div class="stat"><b>458/458</b><span>Test case lulus (unit, fungsional, keamanan)</span></div>
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

  <footer>
    <div class="wrap footer-inner">
      <span>(c) 2026 Shatomedia - TAQWA-Hub</span>
      <span>WhatsApp: +62 857-4390-9116 | Email: shatomedia@gmail.com</span>
    </div>
  </footer>
</body>
</html>
