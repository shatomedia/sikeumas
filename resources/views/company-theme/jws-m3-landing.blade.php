<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jadwal Waktu Sholat JWS-M3 - Shatomedia</title>
  <meta name="description" content="Jam Sholat Digital JWS-M3: tampilan 7-segment untuk 5 waktu sholat, imsak, dan syuruq, dilengkapi alarm adzan otomatis dan running text pengumuman. Dipercaya 10.000+ pelanggan.">
  <style>
    :root {
      --ink: #241a05;
      --muted: #6b5a35;
      --amber-950: #241a05;
      --amber-900: #5c3d0a;
      --amber-800: #a16207;
      --gold: #f6bf35;
      --green: #16a34a;
      --red: #dc2626;
      --soft: #fdf8ef;
      --line: #ecdfc0;
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
    .brand { display: flex; align-items: center; gap: 10px; font-weight: 900; color: var(--amber-800); text-decoration: none; }
    .nav-links { display: flex; align-items: center; gap: 18px; font-size: 14px; font-weight: 700; color: var(--amber-800); }
    .nav-links a { text-decoration: none; }

    .btn { display: inline-flex; align-items: center; justify-content: center; min-height: 46px; padding: 0 18px; border-radius: 8px; border: 1px solid transparent; text-decoration: none; font-weight: 800; line-height: 1.2; text-align: center; }
    .btn-primary { background: var(--green); color: #fff; }
    .btn-amber { background: var(--amber-800); color: #fff; }
    .btn-ghost { background: #fff; color: var(--amber-800); border-color: var(--line); }

    .hero { background: linear-gradient(135deg, var(--amber-950), var(--amber-900) 52%, var(--amber-800)); color: #fff; overflow: hidden; }
    .hero-grid { min-height: 600px; display: grid; grid-template-columns: 1fr 1fr; gap: 44px; align-items: center; padding: 74px 0; }
    .eyebrow { display: inline-flex; align-items: center; min-height: 32px; padding: 0 12px; border-radius: 999px; background: rgba(255,255,255,.12); color: rgba(255,255,255,.88); font-size: 13px; font-weight: 800; margin-bottom: 18px; }
    h1, h2, h3 { margin: 0; line-height: 1.1; }
    h1 { font-size: clamp(34px, 5vw, 54px); max-width: 600px; }
    h1 span { color: var(--gold); }
    h2 { font-size: clamp(28px, 4vw, 40px); color: var(--amber-800); }
    h3 { font-size: 20px; color: var(--amber-800); }
    .lead { margin: 20px 0 0; max-width: 600px; color: rgba(255,255,255,.84); font-size: 18px; }
    .hero-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 30px; }
    .hero-note { margin-top: 18px; color: rgba(255,255,255,.7); font-size: 14px; }

    .browser { border-radius: 18px; background: #1a1203; padding: 12px; box-shadow: 0 30px 80px rgba(0,0,0,.35); transform: rotate(1.2deg); }
    .browser img { border-radius: 10px; width: 100%; display: block; background: #fff; }

    section { padding: 82px 0; }
    .section-head { display: grid; grid-template-columns: .8fr 1fr; gap: 28px; align-items: end; margin-bottom: 28px; }
    .section-head p { margin: 0; color: var(--muted); font-size: 16px; }
    .soft { background: var(--soft); }
    .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
    .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .box { border: 1px solid var(--line); border-radius: 8px; background: #fff; padding: 22px; }
    .box p { margin: 10px 0 0; color: var(--muted); }
    .problem b { color: var(--red); }

    .flow { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; align-items: stretch; }
    .step { min-height: 150px; border: 1px solid var(--line); border-radius: 8px; background: #fff; padding: 18px; position: relative; }
    .num { width: 34px; height: 34px; border-radius: 50%; display: grid; place-items: center; background: var(--amber-800); color: #fff; font-weight: 900; margin-bottom: 12px; }
    .step p { margin: 8px 0 0; color: var(--muted); font-size: 14px; line-height: 1.45; }

    .feature-list { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
    .feature { display: flex; gap: 12px; align-items: flex-start; border-bottom: 1px solid var(--line); padding: 14px 0; }
    .check { flex: none; width: 26px; height: 26px; border-radius: 50%; display: grid; place-items: center; background: #fdf3e3; color: var(--amber-800); font-weight: 900; font-size: 13px; }
    .feature b { display: block; color: var(--amber-800); }
    .feature span { display: block; color: var(--muted); margin-top: 3px; font-size: 14px; }

    .shot-card { overflow: hidden; padding: 0; }
    .shot-card img { width: 100%; height: 220px; object-fit: cover; object-position: center; background: var(--soft); border-bottom: 1px solid var(--line); }
    .shot-card div { padding: 16px; }

    .stat { text-align: center; padding: 26px 18px; border: 1px solid var(--line); background: #fff; }
    .stat b { display: block; font-size: 30px; color: var(--amber-800); }
    .stat span { color: var(--muted); font-size: 14px; font-weight: 600; }

    .faq details { border-bottom: 1px solid var(--line); padding: 18px 0; }
    .faq summary { cursor: pointer; color: var(--amber-800); font-weight: 900; font-size: 18px; list-style: none; }
    .faq summary::-webkit-details-marker { display: none; }
    .faq p { color: var(--muted); margin-bottom: 0; }

    .cta { background: var(--amber-950); color: #fff; text-align: center; }
    .cta h2 { color: #fff; max-width: 780px; margin: 0 auto; }
    .cta p { max-width: 680px; margin: 18px auto 0; color: rgba(255,255,255,.76); font-size: 18px; }
    .cta .hero-actions { justify-content: center; }

    footer { padding: 28px 0; background: #120c02; color: rgba(255,255,255,.7); font-size: 14px; }
    .footer-inner { display: flex; justify-content: space-between; gap: 18px; flex-wrap: wrap; }

    @media (max-width: 920px) {
      .hero-grid, .section-head { grid-template-columns: 1fr; }
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
    }
  </style>
</head>
<body>
  <nav class="nav">
    <div class="wrap nav-inner">
      <a class="brand" href="#top" aria-label="JWS-M3">
        <span>Jadwal Waktu Sholat JWS-M3</span>
      </a>
      <div class="nav-links">
        <a href="#fitur">Fitur</a>
        <a href="#varian">Varian Lain</a>
        <a href="#faq">FAQ</a>
        <a class="btn btn-primary" href="https://wa.me/6285743909116?text={{ urlencode('Halo, saya tertarik dengan Jadwal Waktu Sholat JWS-M3') }}" target="_blank" rel="noopener">Pesan via WhatsApp</a>
      </div>
    </div>
  </nav>

  <header id="top" class="hero">
    <div class="wrap hero-grid">
      <div>
        <span class="eyebrow">Jadwal Waktu Sholat 7-Segment</span>
        <h1>Jadwal Sholat Masjid <span>Tanpa Ribet Update Manual</span></h1>
        <p class="lead">Tampilan digital 7-segment terang untuk 5 waktu sholat, imsak, dan syuruq — dilengkapi tanggal, jam real-time, dan running text pengumuman. Nama & lokasi masjid Anda bisa dicetak langsung di panel.</p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="https://wa.me/6285743909116?text={{ urlencode('Halo, saya tertarik dengan Jadwal Waktu Sholat JWS-M3') }}" target="_blank" rel="noopener">Pesan untuk Masjid Anda</a>
          <a class="btn btn-ghost" href="#fitur">Lihat Fitur</a>
        </div>
        <div class="hero-note">Dipercaya 10.000+ pelanggan di seluruh Indonesia.</div>
      </div>
      <div class="browser" aria-label="Foto JWS-M3 terpasang di masjid">
        <img src="{{ asset('jws-full/jws-m3.jpg') }}" alt="Jam Sholat Digital JWS-M3 terpasang di masjid">
      </div>
    </div>
  </header>

  <section class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Masih Andalkan Kertas Jadwal yang Ditempel?</h2>
        <p>Masjid pada umumnya masih mengelola jadwal sholat dan pengumuman secara manual dan terpisah-pisah.</p>
      </div>
      <div class="grid-3">
        <div class="box problem"><b>Jadwal cetak cepat usang</b><p>Kertas jadwal sholat perlu diganti tiap bulan mengikuti perubahan waktu.</p></div>
        <div class="box problem"><b>Adzan terlewat</b><p>Tidak ada pengingat otomatis, rawan terlambat kalau tidak ada yang mengingatkan.</p></div>
        <div class="box problem"><b>Pengumuman manual</b><p>Info kegiatan jamaah harus ditempel atau diumumkan lisan setiap kali ada perubahan.</p></div>
      </div>
    </div>
  </section>

  <section id="fitur">
    <div class="wrap">
      <div class="section-head">
        <h2>Semua yang Dibutuhkan Takmir</h2>
        <p>Satu panel digital menggantikan kertas jadwal, pengingat manual, dan papan pengumuman.</p>
      </div>
      <div class="feature-list">
        <div class="feature"><span class="check">OK</span><div><b>Alarm Adzan Otomatis</b><span>Bisa di-on/off-kan sesuai kebutuhan, tidak perlu ada yang mengingatkan manual.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Jeda Iqomah</b><span>Bisa diatur tersendiri untuk tiap waktu sholat.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Pilihan Tilawah</b><span>Murottal bisa diputar otomatis sebelum masuk waktu sholat.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Running Text</b><span>Papan informasi berjalan untuk pengumuman jamaah dan kegiatan masjid.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Tampilan 7-Segment Terang</b><span>Angka besar dan jelas, terbaca dari jarak jauh bahkan di ruangan terang.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Nama Masjid Tercetak</b><span>Panel bisa dicetak dengan nama dan alamat masjid Anda.</span></div></div>
      </div>
    </div>
  </section>

  <section id="varian" class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Varian Lain di Lini JWS</h2>
        <p>Pilih ukuran dan gaya panel sesuai kebutuhan ruang masjid Anda.</p>
      </div>
      <div class="grid-3">
        <div class="box shot-card"><img src="{{ asset('jws-full/jws-m3.jpg') }}" alt="JWS-M3"><div><h3>JWS-M3</h3><p>Panel bingkai emas ukir, latar foto Masjidil Haram/Nabawi, 6 waktu sholat.</p></div></div>
        <div class="box shot-card"><img src="{{ asset('jws-full/jws-01.jpeg') }}" alt="JWS-01"><div><h3>JWS-01</h3><p>Dilengkapi remote kontrol, opsional adzan dan tilawah otomatis.</p></div></div>
        <div class="box shot-card"><img src="{{ asset('jws-full/jws-018.jpg') }}" alt="JWS-018"><div><h3>JWS-018</h3><p>Jam sholat digital dengan fungsi inti serupa JWS-01.</p></div></div>
      </div>
    </div>
  </section>

  <section>
    <div class="wrap">
      <div class="section-head">
        <h2>Bukan Produk Baru Coba-Coba</h2>
        <p>Sudah terbukti dan dipercaya luas di seluruh Indonesia.</p>
      </div>
      <div class="grid-4">
        <div class="stat"><b>10.000+</b><span>Pelanggan di seluruh Indonesia</span></div>
        <div class="stat"><b>3 Tahun</b><span>Garansi perlindungan produk</span></div>
        <div class="stat"><b>7-Segment</b><span>Angka terang, terbaca dari jauh</span></div>
        <div class="stat"><b>Custom</b><span>Nama & alamat masjid bisa dicetak</span></div>
      </div>
    </div>
  </section>

  <section id="faq" class="faq soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Pertanyaan Umum</h2>
        <p>Yang biasanya ditanyakan sebelum pemesanan.</p>
      </div>
      <details open><summary>Apakah nama masjid saya bisa dicetak di panel?</summary><p>Bisa. Kirimkan nama dan alamat masjid Anda saat pemesanan, akan dicetak langsung di panel seperti contoh foto di atas.</p></details>
      <details><summary>Berapa lama garansinya?</summary><p>3 tahun garansi perlindungan produk dari Shatomedia.</p></details>
      <details><summary>Apakah perlu instalasi khusus?</summary><p>Tidak. Cukup dipasang di dinding dan disambungkan ke listrik — tidak perlu internet atau jaringan khusus.</p></details>
      <details><summary>Bagaimana cara memesan?</summary><p>Hubungi kami via WhatsApp untuk konsultasi ukuran, desain panel, dan estimasi harga sesuai kebutuhan masjid Anda.</p></details>
    </div>
  </section>

  <section class="cta">
    <div class="wrap">
      <h2>Pesan Jadwal Sholat Digital untuk Masjid Anda</h2>
      <p>Konsultasikan ukuran dan desain panel masjid Anda langsung dengan tim kami.</p>
      <div class="hero-actions">
        <a class="btn btn-primary" href="https://wa.me/6285743909116?text={{ urlencode('Halo, saya tertarik dengan Jadwal Waktu Sholat JWS-M3') }}" target="_blank" rel="noopener">Pesan via WhatsApp</a>
        <a class="btn btn-ghost" href="mailto:shatomedia@gmail.com?subject=Pemesanan%20JWS-M3">Email Shatomedia</a>
      </div>
    </div>
  </section>

  <footer>
    <div class="wrap footer-inner">
      <span>(c) 2026 Shatomedia - Jadwal Waktu Sholat JWS-M3</span>
      <span>WhatsApp: +62 857-4390-9116 | Email: shatomedia@gmail.com</span>
    </div>
  </footer>
</body>
</html>
