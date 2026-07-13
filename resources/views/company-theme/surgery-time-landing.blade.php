@extends('layouts.company_master')
@section('title', 'Surgery Time — Sistem Manajemen Waktu Kamar Bedah | Shatomedia')
@push('meta-seo')
    <meta name="description"
        content="Surgery Time: pantau, jadwalkan, dan laporkan seluruh kamar operasi dari satu layar — timer real-time, monitor kepala ruangan, laporan PDF instan, tanpa perlu staf IT.">
    <meta property="og:title" content="Surgery Time — Sistem Manajemen Waktu Kamar Bedah" />
    <meta property="og:image" content="{{ asset('surgery-time-assets/hero.png') }}" />
@endpush

@section('company-content')
<style>
    .srt {
        --blue: #1e40af;
        --blue-deep: #1e3a5f;
        --gold: #f6bf35;
        --white: #f7fbff;
        --muted: rgba(230, 240, 255, 0.74);
        --line: rgba(30, 64, 175, 0.28);
        background: #050b16;
        color: var(--white);
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;
    }

    .srt-slide {
        position: relative;
        padding: 72px 24px;
        background:
            radial-gradient(circle at 16% 10%, rgba(30, 64, 175, 0.28), transparent 28%),
            radial-gradient(circle at 84% 20%, rgba(53, 130, 230, 0.16), transparent 24%),
            linear-gradient(135deg, #0b1a33 0%, #0a1526 50%, #050b16 100%);
        border-bottom: 1px solid var(--line);
    }

    .srt-inner { max-width: 900px; margin: 0 auto; position: relative; z-index: 2; }

    .srt-brand { display: flex; align-items: center; gap: 14px; margin-bottom: 40px; }
    .srt-brand img { width: 52px; height: 52px; border-radius: 50%; background: #fff; box-shadow: 0 0 34px rgba(30, 64, 175, 0.4); }
    .srt-brand b { display: block; color: #6ea8ff; font-size: 22px; line-height: 1; }
    .srt-brand span { display: block; margin-top: 4px; color: var(--muted); font-size: 12px; font-weight: 800; }

    .srt-kicker { color: var(--gold); font-size: 14px; font-weight: 950; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; }
    .srt h1 { margin: 0 0 20px; font-size: clamp(30px, 5vw, 56px); line-height: 1.08; font-weight: 800; }
    .srt h1 span { color: #6ea8ff; }
    .srt-lead { max-width: 700px; color: var(--muted); font-size: clamp(17px, 2vw, 22px); line-height: 1.4; font-weight: 550; margin-bottom: 36px; }

    .srt-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
    @media (max-width: 640px) { .srt-grid { grid-template-columns: 1fr; } }

    .srt-card { padding: 22px; border: 1px solid var(--line); background: linear-gradient(145deg, rgba(30, 64, 175, 0.16), rgba(10, 21, 38, 0.6)); }
    .srt-card b { display: block; margin-bottom: 8px; color: var(--white); font-size: 19px; }
    .srt-card p { margin: 0; color: var(--muted); font-size: 15px; line-height: 1.35; font-weight: 550; }

    .srt-screen { margin-top: 8px; border: 1px solid var(--line); overflow: hidden; background: #0b1a33; box-shadow: 0 20px 54px rgba(0, 0, 0, 0.32), 0 0 28px rgba(30, 64, 175, 0.2); }
    .srt-screen img { width: 100%; display: block; }

    .srt-chips { display: flex; gap: 10px; margin-top: 18px; flex-wrap: wrap; }
    .srt-chip { padding: 9px 12px; border: 1px solid rgba(110, 168, 255, 0.4); background: rgba(10, 21, 38, 0.72); color: rgba(247, 251, 255, 0.88); font-size: 13px; font-weight: 900; text-transform: uppercase; }

    .srt-hero-img { width: 100%; max-width: 420px; border-radius: 12px; margin: 0 auto 32px; display: block; box-shadow: 0 20px 60px rgba(0,0,0,0.4); }

    .srt-pkg { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-top: 20px; }
    @media (max-width: 640px) { .srt-pkg { grid-template-columns: 1fr; } }
    .srt-pkg-card { padding: 24px; border: 1px solid var(--line); background: rgba(10, 21, 38, 0.7); }
    .srt-pkg-card.featured { border-color: var(--gold); background: linear-gradient(145deg, rgba(246,191,53,0.1), rgba(10,21,38,0.7)); }
    .srt-pkg-card b { display: block; font-size: 20px; margin-bottom: 6px; }
    .srt-pkg-card .price { color: var(--gold); font-size: 26px; font-weight: 800; margin: 10px 0; }
    .srt-pkg-card ul { margin: 0; padding-left: 18px; color: var(--muted); font-size: 14px; line-height: 1.6; }

    .srt-cta { margin-top: 40px; display: flex; flex-wrap: wrap; align-items: center; gap: 24px; padding: 28px; background: linear-gradient(135deg, rgba(246, 191, 53, 0.98), rgba(255, 239, 170, 0.98)); color: #092238; }
    .srt-cta h2 { margin: 0 0 8px; font-size: 28px; }
    .srt-cta p { margin: 0; color: rgba(9, 34, 56, 0.76); font-size: 17px; font-weight: 800; }
    .srt-qr { width: 108px; height: 108px; padding: 8px; background: #fff; border: 6px solid #092238; flex-shrink: 0; }
    .srt-qr img { width: 100%; height: 100%; display: block; }
    .srt-btn { display: inline-block; margin-top: 16px; padding: 14px 28px; background: #092238; color: #fff; font-weight: 800; text-decoration: none; border-radius: 4px; }
    .srt-btn:hover { background: #123d5f; color: #fff; }
</style>

<div class="srt">

    <!-- 1: Masalah -->
    <section class="srt-slide">
        <div class="srt-inner">
            <div class="srt-brand">
                <img src="{{ asset('surgery-time-assets/logo.png') }}" alt="Logo Surgery Time">
                <div><b>Surgery Time</b><span>Sistem Manajemen Waktu Kamar Bedah</span></div>
            </div>
            <img class="srt-hero-img" src="{{ asset('surgery-time-assets/hero.png') }}" alt="Surgery Time">
            <div class="srt-kicker">Apakah RS Anda masih mengalami ini?</div>
            <h1>Waktu operasi masih dicatat di <span>papan tulis?</span></h1>
            <p class="srt-lead">Pantau. Jadwalkan. Laporkan. Semua dari satu layar — mudah digunakan, tidak perlu keahlian teknis apapun.</p>
            <div class="srt-grid">
                <div class="srt-card"><b>Catatan manual</b><p>Waktu operasi dicatat di papan tulis atau kertas, rawan salah dan hilang.</p></div>
                <div class="srt-card"><b>Sulit dipantau</b><p>Kepala ruangan kesulitan memantau semua kamar operasi sekaligus.</p></div>
                <div class="srt-card"><b>Koordinasi terganggu</b><p>Pergantian shift sering membuat informasi terputus antar tim.</p></div>
                <div class="srt-card"><b>Laporan lambat</b><p>Menyusun laporan operasi butuh waktu lama, keterlambatan tidak terdeteksi.</p></div>
            </div>
        </div>
    </section>

    <!-- 2: Fitur utama -->
    <section class="srt-slide">
        <div class="srt-inner">
            <div class="srt-kicker">Solusi digitalnya</div>
            <h1>Semua fungsi kamar operasi <span>dalam satu sistem.</span></h1>
            <p class="srt-lead">Terinstall di satu PC/server kecil di RS. Seluruh staf akses lewat browser tablet/laptop masing-masing — tanpa install apapun, tanpa internet.</p>
            <div class="srt-grid">
                <div class="srt-card"><b>Timer Real-Time</b><p>Countdown otomatis setiap fase operasi, alert kalau overtime.</p></div>
                <div class="srt-card"><b>Monitor Kepala Ruangan</b><p>Semua kamar OK tampil dalam satu layar sekaligus.</p></div>
                <div class="srt-card"><b>Laporan PDF Instan</b><p>Siap cetak dalam detik setelah operasi selesai.</p></div>
                <div class="srt-card"><b>Penjadwalan Mudah</b><p>Input 4 langkah, atau import massal via Excel.</p></div>
            </div>
        </div>
    </section>

    <!-- 3: Screenshot Monitor -->
    <section class="srt-slide">
        <div class="srt-inner">
            <div class="srt-kicker">Screenshot nyata dashboard</div>
            <h1>Kendali penuh <span>ruang operasi Anda.</span></h1>
            <div class="srt-screen"><img src="{{ asset('surgery-time-assets/screenshot-monitor.png') }}" alt="Monitor Kepala Ruangan Surgery Time"></div>
            <div class="srt-chips">
                <span class="srt-chip">Status Ruang</span><span class="srt-chip">Alarm Aktif</span><span class="srt-chip">Sensor Suhu & Kelembapan</span>
            </div>
        </div>
    </section>

    <!-- 4: Screenshot Input -->
    <section class="srt-slide">
        <div class="srt-inner">
            <div class="srt-kicker">Mudah dipakai, tanpa pelatihan panjang</div>
            <h1>Input operasi baru <span>4 langkah sederhana.</span></h1>
            <div class="srt-screen"><img src="{{ asset('surgery-time-assets/screenshot-input.png') }}" alt="Input Operasi Surgery Time"></div>
            <div class="srt-chips">
                <span class="srt-chip">Data Pasien</span><span class="srt-chip">Tim Medis</span><span class="srt-chip">Fase Operasi</span><span class="srt-chip">Konfirmasi</span>
            </div>
        </div>
    </section>

    <!-- 5: Paket & CTA -->
    <section class="srt-slide" style="border-bottom:none;">
        <div class="srt-inner">
            <div class="srt-kicker">Paket & harga</div>
            <h1>Mulai dari <span>Rp 4 juta/tahun.</span></h1>
            <div class="srt-pkg">
                <div class="srt-pkg-card">
                    <b>Paket Mandiri</b>
                    <p style="color:var(--muted); font-size:14px; margin:0;">Untuk RS yang sudah punya PC/server sendiri</p>
                    <div class="price">± Rp 4.000.000<span style="font-size:14px;">/tahun pertama</span></div>
                    <ul>
                        <li>Dongle ESP32</li>
                        <li>Software installer</li>
                        <li>Buku manual PDF</li>
                        <li>Dukungan WhatsApp</li>
                    </ul>
                </div>
                <div class="srt-pkg-card featured">
                    <b>Paket Lengkap ★ Rekomendasi</b>
                    <p style="color:var(--muted); font-size:14px; margin:0;">Untuk RS tanpa staf IT — langsung jalan</p>
                    <div class="price">± Rp 10.000.000<span style="font-size:14px;">/tahun pertama</span></div>
                    <ul>
                        <li>Server OrangePi siap pakai</li>
                        <li>Dongle ESP32 + buku manual cetak</li>
                        <li>Pelatihan 2 jam</li>
                        <li>Dukungan remote</li>
                    </ul>
                </div>
            </div>
            <div class="srt-cta">
                <div style="flex:1; min-width:200px;">
                    <h2>Minta demo gratis</h2>
                    <p>WA: +62 857-4390-9116 &middot; Demo 15 menit, tanpa biaya</p>
                    <a href="https://wa.me/6285743909116?text={{ urlencode('Halo, saya tertarik dengan Surgery Time') }}" target="_blank" class="srt-btn">Chat WhatsApp Sekarang</a>
                </div>
                <div class="srt-qr"><img src="{{ asset('surgery-time-assets/qr-wa.png') }}" alt="QR WhatsApp CS Surgery Time"></div>
            </div>
        </div>
    </section>

</div>
@endsection
