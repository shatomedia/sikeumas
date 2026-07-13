@extends('layouts.company_master')
@section('title', 'TAQWA-Hub — Smart Mosque Audio | Shatomedia')
@push('meta-seo')
    <meta name="description"
        content="TAQWA-Hub: satu perangkat yang menyatukan jadwal sholat, kontrol audio 8-kanal, tampilan TV masjid, dan notifikasi WhatsApp pengurus — tanpa internet.">
    <meta property="og:title" content="TAQWA-Hub — Smart Mosque Audio" />
    <meta property="og:image" content="{{ asset('taqwa-hub-assets/hero.png') }}" />
@endpush

@section('company-content')
<style>
    .tqh {
        --bg: #07131f;
        --blue: #2698ff;
        --cyan: #35e6d0;
        --gold: #f6bf35;
        --white: #f7fbff;
        --muted: rgba(230, 244, 255, 0.74);
        --line: rgba(73, 177, 255, 0.24);
        background: #02070c;
        color: var(--white);
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;
    }

    .tqh-slide {
        position: relative;
        padding: 72px 24px;
        overflow: hidden;
        background:
            radial-gradient(circle at 16% 10%, rgba(38, 152, 255, 0.2), transparent 28%),
            radial-gradient(circle at 84% 20%, rgba(53, 230, 208, 0.15), transparent 24%),
            linear-gradient(135deg, #08192a 0%, #07131f 50%, #040d16 100%);
        border-bottom: 1px solid var(--line);
    }

    .tqh-inner {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .tqh-brand {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 40px;
    }

    .tqh-brand img {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 0 34px rgba(243, 112, 33, 0.28);
    }

    .tqh-brand b {
        display: block;
        color: #4bb0ff;
        font-size: 22px;
        line-height: 1;
    }

    .tqh-brand span {
        display: block;
        margin-top: 4px;
        color: var(--muted);
        font-size: 12px;
        font-weight: 800;
    }

    .tqh-kicker {
        color: var(--gold);
        font-size: 14px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }

    .tqh h1 {
        margin: 0 0 20px;
        font-size: clamp(30px, 5vw, 56px);
        line-height: 1.08;
        font-weight: 800;
    }

    .tqh h1 span { color: #4bb0ff; }

    .tqh-lead {
        max-width: 700px;
        color: var(--muted);
        font-size: clamp(17px, 2vw, 22px);
        line-height: 1.4;
        font-weight: 550;
        margin-bottom: 36px;
    }

    .tqh-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    @media (max-width: 640px) {
        .tqh-grid { grid-template-columns: 1fr; }
    }

    .tqh-card {
        padding: 22px;
        border: 1px solid rgba(73, 177, 255, 0.24);
        background: linear-gradient(145deg, rgba(12, 32, 51, 0.86), rgba(5, 19, 31, 0.72));
    }

    .tqh-card b {
        display: block;
        margin-bottom: 8px;
        color: var(--white);
        font-size: 19px;
    }

    .tqh-card p {
        margin: 0;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.35;
        font-weight: 550;
    }

    .tqh-screen {
        margin-top: 8px;
        border: 1px solid rgba(73, 177, 255, 0.38);
        overflow: hidden;
        background: #08192a;
        box-shadow: 0 20px 54px rgba(0, 0, 0, 0.32), 0 0 28px rgba(38, 152, 255, 0.14);
    }

    .tqh-screen img {
        width: 100%;
        display: block;
    }

    .tqh-chips {
        display: flex;
        gap: 10px;
        margin-top: 18px;
        flex-wrap: wrap;
    }

    .tqh-chip {
        padding: 9px 12px;
        border: 1px solid rgba(53, 230, 208, 0.36);
        background: rgba(5, 19, 31, 0.72);
        color: rgba(247, 251, 255, 0.88);
        font-size: 13px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .tqh-hero-img {
        width: 100%;
        max-width: 380px;
        border-radius: 12px;
        margin: 0 auto 32px;
        display: block;
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    }

    .tqh-step {
        display: grid;
        grid-template-columns: 52px 1fr;
        gap: 16px;
        align-items: center;
        padding: 18px;
        border: 1px solid rgba(73, 177, 255, 0.24);
        background: rgba(12, 32, 51, 0.8);
        margin-bottom: 12px;
    }

    .tqh-step i {
        width: 52px;
        height: 52px;
        display: grid;
        place-items: center;
        color: #092238;
        background: var(--gold);
        font-style: normal;
        font-size: 22px;
        font-weight: 950;
    }

    .tqh-step b {
        display: block;
        font-size: 19px;
        margin-bottom: 4px;
    }

    .tqh-step span {
        color: var(--muted);
        font-size: 15px;
        font-weight: 550;
    }

    .tqh-cta {
        margin-top: 40px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 24px;
        padding: 28px;
        background: linear-gradient(135deg, rgba(246, 191, 53, 0.98), rgba(255, 239, 170, 0.98));
        color: #092238;
    }

    .tqh-cta h2 {
        margin: 0 0 8px;
        font-size: 28px;
    }

    .tqh-cta p {
        margin: 0;
        color: rgba(9, 34, 56, 0.76);
        font-size: 17px;
        font-weight: 800;
    }

    .tqh-qr {
        width: 108px;
        height: 108px;
        padding: 8px;
        background: #fff;
        border: 6px solid #092238;
        flex-shrink: 0;
    }

    .tqh-qr img { width: 100%; height: 100%; display: block; }

    .tqh-btn {
        display: inline-block;
        margin-top: 16px;
        padding: 14px 28px;
        background: #092238;
        color: #fff;
        font-weight: 800;
        text-decoration: none;
        border-radius: 4px;
    }

    .tqh-btn:hover { background: #123d5f; color: #fff; }

    .tqh-quote {
        background: #123d2c;
        border: 1px solid rgba(53, 230, 208, 0.24);
        padding: 32px;
        margin-top: 8px;
    }
    .tqh-quote p {
        margin: 0 0 12px;
        font-size: 20px;
        line-height: 1.5;
        font-weight: 600;
        color: var(--white);
    }
    .tqh-quote span {
        color: var(--muted);
        font-size: 14px;
    }

    .tqh-faq details {
        border-bottom: 1px solid rgba(73, 177, 255, 0.24);
        padding: 18px 0;
    }
    .tqh-faq summary {
        cursor: pointer;
        color: var(--white);
        font-weight: 800;
        font-size: 17px;
        list-style: none;
    }
    .tqh-faq summary::-webkit-details-marker { display: none; }
    .tqh-faq p {
        margin: 12px 0 0;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.5;
    }
</style>

<div class="tqh">

    <!-- Slide 1: Masalah -->
    <section class="tqh-slide">
        <div class="tqh-inner">
            <div class="tqh-brand">
                <img src="{{ asset('taqwa-hub-assets/logo.png') }}" alt="Logo TAQWA">
                <div><b>TAQWA-Hub</b><span>Smart Mosque Audio</span></div>
            </div>
            <img class="tqh-hero-img" src="{{ asset('taqwa-hub-assets/hero.png') }}" alt="TAQWA-Hub">
            <div class="tqh-kicker">Masalah harian pengurus masjid</div>
            <h1>Masjid tidak harus bergantung pada <span>satu operator.</span></h1>
            <p class="tqh-lead">Jadwal, audio, TV, pengumuman, dan kabar pengurus sering tersebar di banyak alat. TAQWA-Hub menyatukannya.</p>
            <div class="tqh-grid">
                <div class="tqh-card"><b>Jadwal manual</b><p>Rawan lupa update dan tidak selalu sinkron dengan tampilan TV.</p></div>
                <div class="tqh-card"><b>Mixer rumit</b><p>Tidak semua takmir nyaman mengatur banyak kanal audio.</p></div>
                <div class="tqh-card"><b>TV terpisah</b><p>Banner, iqomah, dan informasi jamaah perlu operator sendiri.</p></div>
                <div class="tqh-card"><b>Tidak ada alert</b><p>Gangguan sering baru diketahui saat jamaah mulai merasakan.</p></div>
            </div>
        </div>
    </section>

    <!-- Slide 2: Solusi -->
    <section class="tqh-slide">
        <div class="tqh-inner">
            <div class="tqh-kicker">Solusi satu dashboard</div>
            <h1>Satu UI untuk <span>operasional masjid.</span></h1>
            <p class="tqh-lead">Takmir cukup membuka dashboard dari HP, tablet, atau laptop yang tersambung ke jaringan masjid.</p>
            <div class="tqh-grid">
                <div class="tqh-card"><b>Jadwal Sholat</b><p>Waktu sholat dan iqomah tampil otomatis untuk kebutuhan harian.</p></div>
                <div class="tqh-card"><b>Audio DSP</b><p>Kontrol kanal imam, muadzin, khatib, kajian, pengumuman, dan murottal.</p></div>
                <div class="tqh-card"><b>TV Display</b><p>Atur tampilan jadwal, banner event, background, dan overlay adzan/iqomah.</p></div>
                <div class="tqh-card"><b>WA Alert</b><p>Pengurus mendapat kabar otomatis saat jadwal atau sistem perlu perhatian.</p></div>
            </div>
        </div>
    </section>

    <!-- Slide 3: Audio -->
    <section class="tqh-slide">
        <div class="tqh-inner">
            <div class="tqh-kicker">Screenshot nyata dashboard</div>
            <h1>Kontrol audio masjid <span>lebih jelas.</span></h1>
            <div class="tqh-screen">
                <img src="{{ asset('taqwa-hub-assets/screenshot-audio.png') }}" alt="Screenshot mixer audio TAQWA-Hub">
            </div>
            <div class="tqh-chips">
                <span class="tqh-chip">Imam</span><span class="tqh-chip">Muadzin</span><span class="tqh-chip">Khatib</span><span class="tqh-chip">Kajian</span><span class="tqh-chip">Murottal</span>
            </div>
        </div>
    </section>

    <!-- Slide 4: TV Display -->
    <section class="tqh-slide">
        <div class="tqh-inner">
            <div class="tqh-kicker">Jamaah melihat informasi yang rapi</div>
            <h1>TV masjid otomatis, <span>modern, dan hidup.</span></h1>
            <div class="tqh-screen">
                <img src="{{ asset('taqwa-hub-assets/screenshot-tv.png') }}" alt="Screenshot TV jadwal sholat TAQWA-Hub">
            </div>
            <div class="tqh-chips">
                <span class="tqh-chip">Jadwal Sholat</span><span class="tqh-chip">Iqomah</span><span class="tqh-chip">Event Banner</span><span class="tqh-chip">Info Jamaah</span>
            </div>
        </div>
    </section>

    <!-- Slide 4.5: Manfaat, Testimoni, FAQ -->
    <section class="tqh-slide">
        <div class="tqh-inner">
            <div class="tqh-kicker">Manfaat untuk takmir</div>
            <h1>Semua beres, <span>tanpa harus ada orang jaga terus.</span></h1>
            <p class="tqh-lead">Dibuat untuk pengurus masjid — bukan untuk teknisi.</p>
            <div class="tqh-grid">
                <div class="tqh-card"><b>Cukup dari HP</b><p>Tidak perlu komputer atau aplikasi rumit — buka lewat browser HP seperti membuka Instagram.</p></div>
                <div class="tqh-card"><b>Update Sendiri</b><p>Kalau ada perbaikan atau fitur baru, tinggal satu tombol "Perbarui" — tidak perlu teknisi datang.</p></div>
                <div class="tqh-card"><b>Atur Sekali di Awal</b><p>Isi nama masjid, jadwal kajian, dan nomor WhatsApp pengurus — selesai, sistem jalan sendiri.</p></div>
                <div class="tqh-card"><b>Pantau dari Mana Saja</b><p>Cek status masjid, ganti pengumuman, atau nyalakan mode kajian — dari rumah sekalipun.</p></div>
            </div>
            <div class="tqh-quote">
                <p>"Sejak pakai ini, jadwal sholat dan suara masjid jalan sendiri. Pengurus tidak perlu lagi bolak-balik cek amplifier tiap mau sholat."</p>
                <span>— Pengalaman pengguna di masjid percontohan</span>
            </div>
        </div>
    </section>

    <!-- Slide 4.6: FAQ -->
    <section class="tqh-slide">
        <div class="tqh-inner">
            <div class="tqh-kicker">Pertanyaan umum</div>
            <h1>Yang biasanya <span>ditanyakan takmir.</span></h1>
            <div class="tqh-faq">
                <details open><summary>Apakah harus ada internet?</summary><p>Tidak. Jadwal sholat, suara, dan tampilan TV tetap jalan tanpa internet. Internet hanya dipakai kalau ingin notifikasi WhatsApp otomatis.</p></details>
                <details><summary>Apakah rumit dipakai untuk pengurus yang tidak paham teknologi?</summary><p>Tidak. Tampilan dibuat sesederhana membuka halaman web di HP — tombol besar, bahasa Indonesia, tanpa istilah teknis.</p></details>
                <details><summary>Bagaimana kalau ada masalah atau alat rusak?</summary><p>Sistem otomatis mengirim peringatan ke WhatsApp grup pengurus kalau ada speaker atau bagian yang bermasalah — jadi bisa ditangani sebelum jamaah menyadari.</p></details>
                <details><summary>Apakah bisa dipasang di masjid dengan speaker yang sudah ada?</summary><p>Bisa. Unit ini disambungkan ke sistem suara yang sudah terpasang di masjid, tidak perlu ganti speaker lama.</p></details>
            </div>
        </div>
    </section>

    <!-- Slide 5: CTA -->
    <section class="tqh-slide" style="border-bottom:none;">
        <div class="tqh-inner">
            <div class="tqh-kicker">Cara mulai paling mudah</div>
            <h1>Lihat demo 10 menit. <span>Putuskan bersama pengurus.</span></h1>
            <div style="margin-top:32px;">
                <div class="tqh-step"><i>1</i><div><b>Buka dashboard</b><span>Lihat jadwal, audio, dan TV display dari satu tampilan.</span></div></div>
                <div class="tqh-step"><i>2</i><div><b>Coba mode audio</b><span>Adzan, sholat, kajian, dan pengumuman cukup dipilih dari UI.</span></div></div>
                <div class="tqh-step"><i>3</i><div><b>Tentukan kebutuhan masjid</b><span>Jumlah TV, zona speaker, dan alur kerja pengurus disesuaikan.</span></div></div>
            </div>
            <div class="tqh-cta">
                <div style="flex:1; min-width:200px;">
                    <h2>Scan untuk konsultasi</h2>
                    <p>WA CS: +62 857-4390-9116</p>
                    <a href="https://wa.me/6285743909116?text={{ urlencode('Halo, saya tertarik dengan TAQWA-Hub') }}" target="_blank" class="tqh-btn">Chat WhatsApp Sekarang</a>
                </div>
                <div class="tqh-qr"><img src="{{ asset('taqwa-hub-assets/qr-wa.png') }}" alt="QR WhatsApp CS TAQWA-Hub"></div>
            </div>
        </div>
    </section>

</div>
@endsection
