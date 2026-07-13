@extends('layouts.company_master')
@section('title', 'Jadwal Waktu Sholat JWS-M3 | Shatomedia')
@push('meta-seo')
    <meta name="description"
        content="Jam Sholat Digital JWS-M3: tampilan 7-segment untuk 5 waktu sholat, imsak, dan syuruq, dilengkapi alarm adzan otomatis dan running text pengumuman. Dipercaya 10.000+ pelanggan.">
    <meta property="og:title" content="Jadwal Waktu Sholat JWS-M3" />
    <meta property="og:image" content="{{ asset('products/1709590121148.jpg') }}" />
@endpush

@section('company-content')
<style>
    .jws {
        --gold: #a16207;
        --gold-bright: #f6bf35;
        --white: #f7fbff;
        --muted: rgba(60, 40, 10, 0.72);
        --line: rgba(161, 98, 7, 0.28);
        background: #fdf8ef;
        color: #241a05;
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;
    }

    .jws-slide {
        position: relative;
        padding: 72px 24px;
        border-bottom: 1px solid var(--line);
        background: linear-gradient(180deg, #fdf8ef 0%, #fbf1dc 100%);
    }

    .jws-slide.dark {
        background: linear-gradient(135deg, #241a05 0%, #1a1203 100%);
        color: var(--white);
    }

    .jws-inner { max-width: 900px; margin: 0 auto; position: relative; z-index: 2; }

    .jws-brand { display: flex; align-items: center; gap: 14px; margin-bottom: 40px; }
    .jws-brand b { display: block; color: var(--gold); font-size: 22px; line-height: 1; }
    .jws-brand span { display: block; margin-top: 4px; color: var(--muted); font-size: 12px; font-weight: 800; }

    .jws-kicker { color: var(--gold); font-size: 14px; font-weight: 950; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; }
    .jws-slide.dark .jws-kicker { color: var(--gold-bright); }
    .jws h1 { margin: 0 0 20px; font-size: clamp(30px, 5vw, 52px); line-height: 1.1; font-weight: 800; }
    .jws h1 span { color: var(--gold); }
    .jws-slide.dark h1 span { color: var(--gold-bright); }
    .jws-lead { max-width: 700px; color: var(--muted); font-size: clamp(17px, 2vw, 21px); line-height: 1.4; font-weight: 550; margin-bottom: 36px; }
    .jws-slide.dark .jws-lead { color: rgba(247, 251, 255, 0.78); }

    .jws-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
    @media (max-width: 640px) { .jws-grid { grid-template-columns: 1fr; } }

    .jws-card { padding: 22px; border: 1px solid var(--line); background: rgba(255, 255, 255, 0.6); }
    .jws-slide.dark .jws-card { background: rgba(255,255,255,0.06); border-color: rgba(246,191,53,0.3); }
    .jws-card b { display: block; margin-bottom: 8px; font-size: 19px; }
    .jws-card p { margin: 0; color: var(--muted); font-size: 15px; line-height: 1.35; font-weight: 550; }
    .jws-slide.dark .jws-card p { color: rgba(247, 251, 255, 0.7); }

    .jws-hero-img { width: 100%; max-width: 620px; border-radius: 12px; margin: 0 auto 32px; display: block; box-shadow: 0 20px 60px rgba(0,0,0,0.25); }

    .jws-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 20px; }
    @media (max-width: 640px) { .jws-stats { grid-template-columns: 1fr; } }
    .jws-stat { text-align: center; padding: 24px; border: 1px solid rgba(246,191,53,0.3); }
    .jws-stat b { display: block; font-size: 32px; color: var(--gold-bright); }
    .jws-stat span { color: rgba(247, 251, 255, 0.7); font-size: 14px; font-weight: 600; }

    .jws-cta { margin-top: 40px; display: flex; flex-wrap: wrap; align-items: center; gap: 24px; padding: 28px; background: linear-gradient(135deg, #a16207, #d68910); color: #fff; }
    .jws-cta h2 { margin: 0 0 8px; font-size: 28px; }
    .jws-cta p { margin: 0; color: rgba(255,255,255,0.85); font-size: 17px; font-weight: 700; }
    .jws-btn { display: inline-block; margin-top: 16px; padding: 14px 28px; background: #fff; color: #a16207; font-weight: 800; text-decoration: none; border-radius: 4px; }
    .jws-btn:hover { background: #fdf8ef; color: #a16207; }
</style>

<div class="jws">

    <!-- 1: Hero -->
    <section class="jws-slide">
        <div class="jws-inner">
            <div class="jws-brand">
                <div><b>Jadwal Waktu Sholat JWS-M3</b><span>7-Segment Digital Display</span></div>
            </div>
            <img class="jws-hero-img" src="{{ asset('products/1709590121148.jpg') }}" alt="Jam Sholat Digital JWS-M3 terpasang di masjid">
            <div class="jws-kicker">Terpasang di masjid nyata di seluruh Indonesia</div>
            <h1>Jadwal sholat masjid <span>tanpa ribet update manual.</span></h1>
            <p class="jws-lead">Tampilan digital 7-segment terang untuk 5 waktu sholat, imsak, dan syuruq — dilengkapi tanggal, jam real-time, dan running text pengumuman. Nama & lokasi masjid Anda bisa dicetak di panel, seperti contoh di atas.</p>
        </div>
    </section>

    <!-- 2: Fitur -->
    <section class="jws-slide">
        <div class="jws-inner">
            <div class="jws-kicker">Fitur lengkap dalam satu box</div>
            <h1>Semua yang dibutuhkan <span>takmir masjid.</span></h1>
            <div class="jws-grid">
                <div class="jws-card"><b>Alarm Adzan Otomatis</b><p>Bisa di-on/off-kan sesuai kebutuhan, tidak perlu ada yang mengingatkan manual.</p></div>
                <div class="jws-card"><b>Jeda Iqomah</b><p>Bisa diatur tersendiri untuk tiap waktu sholat.</p></div>
                <div class="jws-card"><b>Pilihan Tilawah</b><p>Murottal bisa diputar otomatis sebelum masuk waktu sholat.</p></div>
                <div class="jws-card"><b>Running Text</b><p>Papan informasi berjalan untuk pengumuman jamaah dan kegiatan masjid.</p></div>
            </div>
        </div>
    </section>

    <!-- 3: Bukti/Trust -->
    <section class="jws-slide dark">
        <div class="jws-inner">
            <div class="jws-kicker">Sudah dipercaya luas</div>
            <h1>Bukan produk baru coba-coba.</h1>
            <div class="jws-stats">
                <div class="jws-stat"><b>10.000+</b><span>Pelanggan di seluruh Indonesia</span></div>
                <div class="jws-stat"><b>3 Tahun</b><span>Garansi perlindungan produk</span></div>
                <div class="jws-stat"><b>7-Segment</b><span>Angka terang, terbaca dari jauh</span></div>
            </div>
        </div>
    </section>

    <!-- 4: CTA -->
    <section class="jws-slide" style="border-bottom:none;">
        <div class="jws-inner">
            <div class="jws-kicker">Pesan untuk masjid Anda</div>
            <h1>Nama masjid Anda bisa <span>dicetak di panel.</span></h1>
            <p class="jws-lead">Konsultasikan kebutuhan ukuran dan desain panel masjid Anda langsung dengan tim kami.</p>
            <div class="jws-cta">
                <div style="flex:1; min-width:200px;">
                    <h2>Konsultasi & Pemesanan</h2>
                    <p>WA: +62 857-4390-9116</p>
                    <a href="https://wa.me/6285743909116?text={{ urlencode('Halo, saya tertarik dengan Jadwal Waktu Sholat JWS-M3') }}" target="_blank" class="jws-btn">Chat WhatsApp Sekarang</a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
