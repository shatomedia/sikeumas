<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SurgeryTime - Sistem Manajemen Waktu Kamar Bedah</title>
  <meta name="description" content="SurgeryTime membantu rumah sakit memantau jadwal operasi, timer tiap fase, monitor semua ruang OK, alarm overtime, dan laporan PDF dari satu sistem lokal.">
  <style>
    :root {
      --ink: #102033;
      --muted: #617083;
      --blue-950: #0d1b2d;
      --blue-900: #1e3a5f;
      --blue-800: #1e40af;
      --blue-100: #dbeafe;
      --green: #16a34a;
      --amber: #f59e0b;
      --red: #dc2626;
      --soft: #f3f6fb;
      --line: #d7e0ea;
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
    .brand { display: flex; align-items: center; gap: 10px; font-weight: 900; color: var(--blue-900); text-decoration: none; }
    .mark { width: 36px; height: 36px; border-radius: 9px; display: grid; place-items: center; background: var(--blue-900); color: #fff; font-size: 14px; font-weight: 900; }
    .nav-links { display: flex; align-items: center; gap: 18px; font-size: 14px; font-weight: 700; color: var(--blue-900); }
    .nav-links a { text-decoration: none; }

    .btn { display: inline-flex; align-items: center; justify-content: center; min-height: 46px; padding: 0 18px; border-radius: 8px; border: 1px solid transparent; text-decoration: none; font-weight: 800; line-height: 1.2; text-align: center; }
    .btn-primary { background: var(--green); color: #fff; }
    .btn-blue { background: var(--blue-900); color: #fff; }
    .btn-ghost { background: #fff; color: var(--blue-900); border-color: var(--line); }

    .hero { background: linear-gradient(135deg, var(--blue-950), var(--blue-900) 52%, var(--blue-800)); color: #fff; overflow: hidden; }
    .hero-grid { min-height: 660px; display: grid; grid-template-columns: 1fr 1fr; gap: 44px; align-items: center; padding: 74px 0; }
    .eyebrow { display: inline-flex; align-items: center; min-height: 32px; padding: 0 12px; border-radius: 999px; background: rgba(255,255,255,.12); color: rgba(255,255,255,.88); font-size: 13px; font-weight: 800; margin-bottom: 18px; }
    h1, h2, h3 { margin: 0; line-height: 1.08; }
    h1 { font-size: clamp(40px, 6vw, 68px); max-width: 660px; }
    h2 { font-size: clamp(30px, 4vw, 44px); color: var(--blue-900); }
    h3 { font-size: 20px; color: var(--blue-900); }
    .lead { margin: 20px 0 0; max-width: 620px; color: rgba(255,255,255,.84); font-size: 18px; }
    .hero-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 30px; }
    .hero-note { margin-top: 18px; color: rgba(255,255,255,.7); font-size: 14px; }

    .browser { border-radius: 18px; background: #0b1524; padding: 12px; box-shadow: 0 30px 80px rgba(0,0,0,.35); transform: rotate(1.2deg); }
    .browser-bar { height: 30px; display: flex; align-items: center; gap: 7px; padding: 0 6px; }
    .dot { width: 10px; height: 10px; border-radius: 50%; background: #64748b; }
    .browser img { border-radius: 10px; height: 380px; width: 100%; object-fit: cover; object-position: top left; background: #fff; }

    section { padding: 82px 0; }
    .section-head { display: grid; grid-template-columns: .8fr 1fr; gap: 28px; align-items: end; margin-bottom: 28px; }
    .section-head p { margin: 0; color: var(--muted); font-size: 16px; }
    .soft { background: var(--soft); }
    .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; }
    .box { border: 1px solid var(--line); border-radius: 8px; background: #fff; padding: 22px; }
    .box p { margin: 10px 0 0; color: var(--muted); }
    .problem b { color: var(--red); }

    .flow { display: grid; grid-template-columns: repeat(6, 1fr); gap: 12px; align-items: stretch; }
    .step { min-height: 176px; border: 1px solid var(--line); border-radius: 8px; background: #fff; padding: 18px; position: relative; }
    .num { width: 34px; height: 34px; border-radius: 50%; display: grid; place-items: center; background: var(--blue-800); color: #fff; font-weight: 900; margin-bottom: 12px; }
    .step p { margin: 8px 0 0; color: var(--muted); font-size: 14px; line-height: 1.45; }

    .feature-list { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
    .feature { display: flex; gap: 12px; align-items: flex-start; border-bottom: 1px solid var(--line); padding: 14px 0; }
    .check { flex: none; width: 26px; height: 26px; border-radius: 50%; display: grid; place-items: center; background: #dcfce7; color: var(--green); font-weight: 900; }
    .feature b { display: block; color: var(--blue-900); }
    .feature span { display: block; color: var(--muted); margin-top: 3px; font-size: 14px; }

    .shot-card { overflow: hidden; padding: 0; }
    .shot-card img { width: 100%; height: 230px; object-fit: cover; object-position: top left; background: var(--soft); border-bottom: 1px solid var(--line); }
    .shot-card div { padding: 16px; }

    .price { display: flex; flex-direction: column; gap: 16px; }
    .price strong { display: block; color: var(--blue-900); font-size: 24px; line-height: 1.2; }
    .price ul { margin: 0; padding-left: 18px; color: var(--muted); }
    .highlight { border: 2px solid var(--blue-800); background: #f8fbff; }

    .faq details { border-bottom: 1px solid var(--line); padding: 18px 0; }
    .faq summary { cursor: pointer; color: var(--blue-900); font-weight: 900; font-size: 18px; }
    .faq p { color: var(--muted); margin-bottom: 0; }

    .cta { background: var(--blue-950); color: #fff; text-align: center; }
    .cta h2 { color: #fff; max-width: 780px; margin: 0 auto; }
    .cta p { max-width: 680px; margin: 18px auto 0; color: rgba(255,255,255,.76); font-size: 18px; }
    .cta .hero-actions { justify-content: center; }

    footer { padding: 28px 0; background: #08111f; color: rgba(255,255,255,.7); font-size: 14px; }
    .footer-inner { display: flex; justify-content: space-between; gap: 18px; flex-wrap: wrap; }

    @media (max-width: 920px) {
      .hero-grid, .section-head, .grid-2 { grid-template-columns: 1fr; }
      .grid-3 { grid-template-columns: 1fr; }
      .flow { grid-template-columns: repeat(2, 1fr); }
      .feature-list { grid-template-columns: 1fr; }
      .nav-links { display: none; }
      .browser { transform: none; }
    }

    @media (max-width: 560px) {
      section { padding: 58px 0; }
      .hero-grid { padding: 54px 0; }
      .flow { grid-template-columns: 1fr; }
      .browser img { height: 260px; }
    }
  </style>
</head>
<body>
  <nav class="nav">
    <div class="wrap nav-inner">
      <a class="brand" href="#top" aria-label="SurgeryTime">
        <span class="mark">ST</span>
        <span>SurgeryTime</span>
      </a>
      <div class="nav-links">
        <a href="#alur">Alur</a>
        <a href="#fitur">Fitur</a>
        <a href="#harga">Harga</a>
        <a href="#faq">FAQ</a>
        <a class="btn btn-primary" href="https://wa.me/6285743909116?text=Halo%20Shatomedia%2C%20saya%20ingin%20demo%20SurgeryTime%20untuk%20rumah%20sakit%2Fklinik." target="_blank" rel="noopener">Demo WhatsApp</a>
      </div>
    </div>
  </nav>

  <header id="top" class="hero">
    <div class="wrap hero-grid">
      <div>
        <span class="eyebrow">Sistem Manajemen Waktu Kamar Bedah</span>
        <h1>Pantau Jadwal, Timer, Alarm, dan Laporan Operasi dari Satu Sistem</h1>
        <p class="lead">SurgeryTime membantu rumah sakit dan klinik memantau alur operasi secara real-time: mulai dari input jadwal, timer tiap fase, monitor kepala ruangan, alarm overtime, sampai laporan PDF siap cetak.</p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="https://wa.me/6285743909116?text=Halo%20Shatomedia%2C%20saya%20ingin%20demo%20SurgeryTime%20untuk%20rumah%20sakit%2Fklinik." target="_blank" rel="noopener">Minta Demo Gratis</a>
          <a class="btn btn-ghost" href="#alur">Lihat Alur Penggunaan</a>
        </div>
        <div class="hero-note">Berjalan lokal di jaringan RS. Dapat diakses dari PC, tablet, atau HP.</div>
      </div>
      <div class="browser" aria-label="Screenshot Portal SurgeryTime">
        <div class="browser-bar"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
        <img src="{{ asset('surgery-time-full/screenshots/portal.png') }}" alt="Portal utama SurgeryTime">
      </div>
    </div>
  </header>

  <section class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Masalah yang Sering Terjadi di Kamar Operasi</h2>
        <p>Banyak rumah sakit masih mengandalkan papan tulis, kertas, chat manual, atau file terpisah untuk memantau jadwal dan durasi operasi.</p>
      </div>
      <div class="grid-3">
        <div class="box problem"><b>Jadwal tidak terpusat</b><p>Jadwal operasi tersebar di beberapa tempat sehingga sulit dilihat cepat oleh seluruh tim.</p></div>
        <div class="box problem"><b>Overtime terlambat diketahui</b><p>Keterlambatan operasi sering baru terlihat setelah mengganggu jadwal berikutnya.</p></div>
        <div class="box problem"><b>Laporan disusun ulang</b><p>Data durasi fase dan catatan operasi membutuhkan waktu untuk dirapikan setelah tindakan selesai.</p></div>
      </div>
    </div>
  </section>

  <section id="alur">
    <div class="wrap">
      <div class="section-head">
        <h2>Alur Penggunaan SurgeryTime</h2>
        <p>Dari input jadwal sampai laporan selesai, SurgeryTime mengikuti alur kerja yang mudah dipahami tim OK.</p>
      </div>
      <div class="flow">
        <div class="step"><div class="num">1</div><h3>Input Operasi</h3><p>Masukkan pasien, tim medis, ruang OK, jadwal, estimasi, dan fase operasi.</p></div>
        <div class="step"><div class="num">2</div><h3>Jadwal Tampil</h3><p>Operasi muncul di daftar, jadwal harian, mingguan, dan tampilan per dokter.</p></div>
        <div class="step"><div class="num">3</div><h3>Mulai di OK</h3><p>Tim memilih operasi dari dashboard TV atau browser ruang operasi.</p></div>
        <div class="step"><div class="num">4</div><h3>Timer Fase</h3><p>Setiap fase dipantau dengan countdown, progress, dan status durasi.</p></div>
        <div class="step"><div class="num">5</div><h3>Monitor Semua OK</h3><p>Kepala ruangan melihat status semua kamar operasi dari satu layar.</p></div>
        <div class="step"><div class="num">6</div><h3>Laporan PDF</h3><p>Setelah selesai, laporan siap dicetak untuk arsip dan administrasi.</p></div>
      </div>
    </div>
  </section>

  <section id="fitur" class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Fitur Utama</h2>
        <p>SurgeryTime dibangun untuk kebutuhan operasional kamar bedah: cepat dipahami, mudah diakses, dan relevan untuk staf medis maupun administrasi.</p>
      </div>
      <div class="feature-list">
        <div class="feature"><span class="check">OK</span><div><b>Penjadwalan Operasi</b><span>Input data pasien, dokter, ruang OK, tanggal, jam, dan estimasi durasi.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Timer Real-Time per Fase</b><span>Pantau durasi tiap fase operasi dan potensi overtime.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Monitor Kepala Ruangan</b><span>Semua ruang operasi terlihat dalam satu layar monitoring.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Alarm Overtime</b><span>Peringatan otomatis saat operasi melewati estimasi.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Laporan PDF Siap Cetak</b><span>Data pasien, tim, durasi fase, catatan, dan area tanda tangan.</span></div></div>
        <div class="feature"><span class="check">OK</span><div><b>Akses Jaringan Lokal</b><span>Dibuka dari PC, tablet, atau HP tanpa install aplikasi di setiap perangkat.</span></div></div>
      </div>
    </div>
  </section>

  <section>
    <div class="wrap">
      <div class="section-head">
        <h2>Tampilan Aplikasi</h2>
        <p>Screenshot asli aplikasi SurgeryTime untuk membantu calon pengguna memahami bentuk sistemnya.</p>
      </div>
      <div class="grid-2">
        <div class="box shot-card"><img src="{{ asset('surgery-time-full/screenshots/input-operasi.png') }}" alt="Input Operasi SurgeryTime"><div><h3>Input Operasi Baru</h3><p>Form input untuk data pasien, tim medis, ruang OK, dan fase operasi.</p></div></div>
        <div class="box shot-card"><img src="{{ asset('surgery-time-full/screenshots/monitor-kepala-ruangan.png') }}" alt="Monitor Kepala Ruangan SurgeryTime"><div><h3>Monitor Kepala Ruangan</h3><p>Semua kamar operasi terlihat dalam satu layar monitoring.</p></div></div>
        <div class="box shot-card"><img src="{{ asset('surgery-time-full/screenshots/laporan-operasi.png') }}" alt="Laporan Operasi SurgeryTime"><div><h3>Laporan Operasi</h3><p>Laporan PDF siap cetak setelah tindakan selesai.</p></div></div>
        <div class="box shot-card"><img src="{{ asset('surgery-time-full/screenshots/portal.png') }}" alt="Portal SurgeryTime"><div><h3>Portal Utama</h3><p>Ringkasan status ruang operasi dan akses cepat fitur utama.</p></div></div>
      </div>
    </div>
  </section>

  <section id="harga" class="soft">
    <div class="wrap">
      <div class="section-head">
        <h2>Paket SurgeryTime</h2>
        <p>Harga ditampilkan sebagai estimasi awal. Penawaran resmi dapat disesuaikan dengan kebutuhan implementasi, jumlah ruang, lokasi, dan dukungan.</p>
      </div>
      <div class="grid-3">
        <div class="box price">
          <h3>Demo</h3>
          <strong>Gratis</strong>
          <p>Untuk evaluasi awal dan demo alur penggunaan SurgeryTime.</p>
          <ul><li>Simulasi input operasi</li><li>Simulasi monitor OK</li><li>Simulasi laporan</li></ul>
          <a class="btn btn-blue" href="https://wa.me/6285743909116?text=Halo%20Shatomedia%2C%20saya%20ingin%20demo%20SurgeryTime." target="_blank" rel="noopener">Coba Demo</a>
        </div>
        <div class="box price highlight">
          <h3>FULL Mandiri</h3>
          <strong>Mulai Rp 4 juta tahun pertama</strong>
          <p>Untuk RS/klinik yang sudah memiliki PC/server dan staf IT sendiri.</p>
          <ul><li>Software SurgeryTime</li><li>Dongle ESP32</li><li>Sensor, RTC, dan buzzer</li></ul>
          <a class="btn btn-primary" href="https://wa.me/6285743909116?text=Halo%20Shatomedia%2C%20saya%20ingin%20penawaran%20Paket%20FULL%20Mandiri%20SurgeryTime." target="_blank" rel="noopener">Minta Penawaran</a>
        </div>
        <div class="box price">
          <h3>FULL Lengkap</h3>
          <strong>Mulai Rp 10 juta tahun pertama</strong>
          <p>Untuk RS/klinik yang ingin sistem siap pakai tanpa menyiapkan server sendiri.</p>
          <ul><li>Server OrangePi</li><li>SurgeryTime terinstall</li><li>Pelatihan dan dukungan awal</li></ul>
          <a class="btn btn-blue" href="https://wa.me/6285743909116?text=Halo%20Shatomedia%2C%20saya%20ingin%20penawaran%20Paket%20FULL%20Lengkap%20SurgeryTime." target="_blank" rel="noopener">Minta Penawaran</a>
        </div>
      </div>
    </div>
  </section>

  <section id="faq" class="faq">
    <div class="wrap">
      <div class="section-head">
        <h2>Pertanyaan Umum</h2>
        <p>Beberapa hal yang biasanya ditanyakan saat demo awal.</p>
      </div>
      <details open><summary>Apakah SurgeryTime harus terhubung internet?</summary><p>Tidak untuk operasional harian. SurgeryTime dapat berjalan di jaringan lokal rumah sakit. Internet hanya dibutuhkan untuk update atau dukungan remote jika diperlukan.</p></details>
      <details><summary>Apakah setiap komputer harus diinstall aplikasi?</summary><p>Tidak. SurgeryTime cukup berjalan di satu server/PC/perangkat utama. Staf lain dapat mengakses dari browser di jaringan yang sama.</p></details>
      <details><summary>Apakah bisa dibuka dari tablet atau HP?</summary><p>Bisa. SurgeryTime dapat diakses melalui browser dari PC, laptop, tablet, atau HP di jaringan rumah sakit.</p></details>
      <details><summary>Apakah data operasi disimpan di server Shatomedia?</summary><p>Tidak. Data operasi tersimpan di perangkat atau server milik rumah sakit.</p></details>
      <details><summary>Apakah bisa mencoba dulu?</summary><p>Bisa. Kami menyediakan demo untuk memperlihatkan alur SurgeryTime dari input jadwal sampai laporan PDF.</p></details>
    </div>
  </section>

  <section class="cta">
    <div class="wrap">
      <h2>Ingin Melihat SurgeryTime Bekerja di Alur Kamar Operasi Anda?</h2>
      <p>Kami dapat menyiapkan demo singkat 15 menit untuk memperlihatkan alur penjadwalan, monitoring timer, alarm overtime, dan laporan operasi.</p>
      <div class="hero-actions">
        <a class="btn btn-primary" href="https://wa.me/6285743909116?text=Halo%20Shatomedia%2C%20saya%20ingin%20demo%20SurgeryTime%20untuk%20rumah%20sakit%2Fklinik." target="_blank" rel="noopener">Minta Demo via WhatsApp</a>
        <a class="btn btn-ghost" href="mailto:shatomedia@gmail.com?subject=Demo%20SurgeryTime">Email Shatomedia</a>
      </div>
    </div>
  </section>

  <footer>
    <div class="wrap footer-inner">
      <span>(c) 2026 Shatomedia - SurgeryTime</span>
      <span>WhatsApp: +62 857-4390-9116 | Email: shatomedia@gmail.com</span>
    </div>
  </footer>
</body>
</html>
