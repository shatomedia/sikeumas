<!doctype html>
<html lang="id" data-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Replay Observasi Hilal 13 September 2026 — MOONLIGHT</title>
  <meta name="description" content="Putar ulang rekaman nyata sesi observasi hilal MOONLIGHT, 13 September 2026 di SHATOMEDIA Sedayu, Bantul: 54 foto teleskop dengan telemetri waktu, cuaca, posisi hilal, suhu, kelembapan, IMU, dan GPS.">
  <link rel="canonical" href="https://shatomedia.com/moonlight/replay">
  <meta property="og:title" content="Replay Observasi Hilal — MOONLIGHT">
  <meta property="og:description" content="Rekaman nyata sesi rukyat 13 September 2026: dari Matahari terbenam sampai sabit hilal terlihat.">
  <meta property="og:image" content="{{ asset('moonlight-assets/replay-20260913/obs_468.webp') }}">
  <link rel="icon" href="{{ asset('taqwa-hub-full/logo.png') }}">
  <style>
    :root {
      --bg: #f5f7fb; --panel: #ffffff; --ink: #172033; --muted: #59657b; --line: #dce3ef;
      --gold: #b7791f; --cyan: #1976a3; --chip: #eef2f8; --stage: #0b0f17;
    }
    html[data-theme="dark"] {
      --bg: #0b0e15; --panel: #141925; --ink: #e6e9ef; --muted: #9aa4b5; --line: #263041;
      --gold: #ffd166; --cyan: #79d4ff; --chip: #1c2332; --stage: #05070b;
    }
    * { box-sizing: border-box; }
    body { margin: 0; background: var(--bg); color: var(--ink); font-family: -apple-system, "Segoe UI", Inter, Arial, sans-serif; line-height: 1.55; }
    a { color: var(--cyan); }
    .wrap { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }
    header.top { padding: 26px 0 14px; }
    .kicker { font: 800 12px ui-monospace, Consolas, monospace; letter-spacing: .12em; text-transform: uppercase; color: var(--cyan); }
    h1 { margin: 6px 0 6px; font-size: clamp(26px, 4vw, 40px); line-height: 1.1; }
    h1 span { color: var(--gold); }
    .label-jujur { display: inline-flex; gap: 8px; align-items: center; padding: 6px 12px; border-radius: 999px; background: var(--chip); border: 1px solid var(--line); color: var(--muted); font-size: 13px; }
    .grid { display: grid; grid-template-columns: minmax(0, 1fr) 330px; gap: 18px; margin: 16px 0 28px; }
    .stage { position: relative; background: var(--stage); border-radius: 14px; overflow: hidden; aspect-ratio: 4 / 3; border: 1px solid var(--line); }
    .stage img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: contain; transition: opacity .35s; }
    .ov { position: absolute; padding: 6px 12px; border-radius: 10px; background: rgba(5,7,11,.72); color: #fff; backdrop-filter: blur(6px); }
    .ov-jam { top: 12px; left: 12px; font: 800 26px ui-monospace, Consolas, monospace; }
    .ov-jam small { display: block; font: 600 11px system-ui, sans-serif; color: #aab4c5; letter-spacing: .04em; }
    .ov-fase { top: 12px; right: 12px; max-width: 55%; text-align: right; font-weight: 700; font-size: 14px; }
    .ov-fase small { display: block; font-weight: 500; color: #c8d0dc; font-size: 12px; }
    .ov-hasil { bottom: 12px; left: 12px; font: 800 12px system-ui, sans-serif; letter-spacing: .08em; text-transform: uppercase; }
    .ov-hasil.terlihat { background: rgba(22,163,74,.85); }
    .ov-foto { bottom: 12px; right: 12px; font: 600 12px ui-monospace, monospace; color: #c8d0dc; }
    .controls { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin-top: 12px; }
    .btn { border: 1px solid var(--line); background: var(--panel); color: var(--ink); border-radius: 9px; padding: 8px 12px; font: 700 14px system-ui, sans-serif; cursor: pointer; }
    .btn:hover { border-color: var(--cyan); }
    .btn.utama { background: var(--gold); color: #1d1404; border-color: transparent; min-width: 96px; }
    .btn.aktif { border-color: var(--cyan); color: var(--cyan); }
    .btn.hilal { margin-left: auto; }
    .linimasa { position: relative; margin-top: 12px; }
    .fasebar { display: flex; height: 8px; border-radius: 99px; overflow: hidden; margin-bottom: 6px; }
    .fasebar div { cursor: pointer; }
    input[type=range] { width: 100%; accent-color: var(--gold); }
    .skala { display: flex; justify-content: space-between; font: 12px ui-monospace, monospace; color: var(--muted); }
    .panel { background: var(--panel); border: 1px solid var(--line); border-radius: 14px; padding: 16px; }
    .panel h2 { margin: 0 0 10px; font-size: 15px; letter-spacing: .02em; }
    .kv { display: grid; grid-template-columns: 1fr auto; gap: 7px 10px; font-size: 14px; }
    .kv span { color: var(--muted); }
    .kv b { font-variant-numeric: tabular-nums; text-align: right; }
    .sep { height: 1px; background: var(--line); margin: 12px 0; }
    .spark { width: 100%; height: 58px; display: block; }
    .spark-label { display: flex; justify-content: space-between; font-size: 12px; color: var(--muted); margin-top: 8px; }
    .fase-list { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin: 6px 0 22px; }
    .fase-item { background: var(--panel); border: 1px solid var(--line); border-radius: 12px; padding: 12px; cursor: pointer; border-top: 4px solid var(--c); }
    .fase-item.aktif { box-shadow: 0 0 0 2px var(--c) inset; }
    .fase-item b { display: block; font-size: 14px; }
    .fase-item small { color: var(--muted); font-size: 12px; }
    .strip { display: grid; grid-template-columns: repeat(auto-fill, minmax(86px, 1fr)); gap: 6px; margin-bottom: 26px; }
    .strip button { padding: 0; border: 2px solid transparent; border-radius: 8px; overflow: hidden; background: var(--stage); cursor: pointer; aspect-ratio: 4/3; position: relative; }
    .strip button.aktif { border-color: var(--gold); }
    .strip img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .strip span { position: absolute; left: 3px; bottom: 2px; font: 700 10px ui-monospace, monospace; color: #fff; text-shadow: 0 1px 2px #000; }
    .catatan { font-size: 13px; color: var(--muted); padding-bottom: 36px; }
    h3.judul { margin: 6px 0 10px; font-size: 18px; }
    @media (max-width: 920px) {
      .grid { grid-template-columns: 1fr; }
      .fase-list { grid-template-columns: 1fr 1fr; }
      .btn.hilal { margin-left: 0; }
    }
    @media (max-width: 560px) {
      .ov-jam { font-size: 20px; }
      .ov-fase { font-size: 12px; }
      .fase-list { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
@include('company-theme.partials.site-bar', ['themeDefault' => 'dark'])

<header class="top wrap">
  <div class="kicker">MOONLIGHT · Replay sesi nyata</div>
  <h1>Observasi Hilal <span>13 September 2026</span></h1>
  <div class="label-jujur">● Rekaman nyata sesi observasi di SHATOMEDIA, Sedayu, Bantul — diputar ulang, tidak terhubung ke teleskop.</div>
  <p style="margin:10px 0 0;color:var(--muted);max-width:760px">54 foto teleskop pukul 16:43–19:32 WIB, masing-masing dengan telemetri yang tercatat saat itu. Tekan <b>Putar</b>, geser linimasa, atau langsung <b>lompat ke saat hilal terlihat</b>. <a href="{{ route('moonlight-landing') }}">← Kembali ke MOONLIGHT</a></p>
</header>

<main class="wrap">
  <div class="grid">
    <section>
      <div class="stage" id="stage">
        <img id="foto" alt="Foto observasi">
        <div class="ov ov-jam"><span id="jam">--:--</span><small>WIB · 13 Sep 2026</small></div>
        <div class="ov ov-fase"><span id="fase-judul">-</span><small id="fase-ket"></small></div>
        <div class="ov ov-hasil" id="hasil">-</div>
        <div class="ov ov-foto" id="nofoto">-</div>
      </div>
      <div class="controls">
        <button class="btn utama" id="putar">▶ Putar</button>
        <button class="btn" id="mundur" title="Foto sebelumnya">⟨</button>
        <button class="btn" id="maju" title="Foto berikutnya">⟩</button>
        <button class="btn kec" data-k="1">1×</button>
        <button class="btn kec" data-k="2">2×</button>
        <button class="btn kec" data-k="4">4×</button>
        <button class="btn hilal" id="ke-hilal">🌙 Lompat ke hilal terlihat</button>
      </div>
      <div class="linimasa">
        <div class="fasebar" id="fasebar"></div>
        <input type="range" id="geser" min="0" value="0" aria-label="Linimasa sesi">
        <div class="skala"><span>16:43</span><span id="skala-tengah"></span><span>19:32</span></div>
      </div>
    </section>

    <aside class="panel">
      <h2>Telemetri saat foto diambil</h2>
      <div class="kv">
        <span>Status log</span><b id="t-hasil">-</b>
        <span>Cuaca</span><b id="t-cuaca">-</b>
        <span>Tinggi hilal</span><b id="t-alt">-</b>
        <span>Elongasi</span><b id="t-elong">-</b>
        <span>Iluminasi</span><b id="t-ilum">-</b>
      </div>
      <div class="sep"></div>
      <div class="kv">
        <span>Suhu udara</span><b id="t-suhu">-</b>
        <span>Kelembapan</span><b id="t-rh">-</b>
        <span>Tekanan (BMP280)</span><b id="t-hpa">-</b>
        <span>Tilt IMU</span><b id="t-tilt">-</b>
        <span>GPS</span><b id="t-gps">-</b>
        <span>Lokasi</span><b id="t-lok" style="font-size:12px">-</b>
      </div>
      <div class="sep"></div>
      <div class="spark-label"><span>Suhu (°C)</span><span id="sp-suhu"></span></div>
      <svg class="spark" id="spark-suhu" viewBox="0 0 300 58" preserveAspectRatio="none"></svg>
      <div class="spark-label"><span>Kelembapan (%)</span><span id="sp-rh"></span></div>
      <svg class="spark" id="spark-rh" viewBox="0 0 300 58" preserveAspectRatio="none"></svg>
    </aside>
  </div>

  <h3 class="judul">Alur sesi</h3>
  <div class="fase-list" id="fase-list"></div>

  <h3 class="judul">Semua foto sesi</h3>
  <div class="strip" id="strip"></div>

  <p class="catatan">Sumber: arsip observasi MOONLIGHT (foto teleskop & log sensor), SHATOMEDIA Research &amp; Development. Foto diperkecil untuk web; nilai tinggi, elongasi, dan iluminasi hilal adalah hasil perhitungan untuk sesi ini. Keterangan fase disusun dari isi foto. Lihat juga <a href="{{ route('taqwa-hub-landing') }}">TAQWA-Hub</a> — hasil rukyat MOONLIGHT dapat tampil di TV masjid.</p>
</main>

<script type="application/json" id="data-sesi">{"tanggal":"2026-09-13","lokasi":"SHATOMEDIA, Sedayu, Bantul","frames":[{"no":433,"t":"16:43","img":"obs_433.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.74,"sat":10.0,"suhu":33.0,"rh":54.9,"tilt":11.46,"hpa":1002.9,"lat":-7.8081415,"lon":110.26498966666666},{"no":434,"t":"16:44","img":"obs_434.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.91,"sat":7.0,"suhu":33.4,"rh":54.0,"tilt":11.18,"hpa":1002.9,"lat":-7.8081415,"lon":110.26498966666666},{"no":435,"t":"16:45","img":"obs_435.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.95,"sat":7.0,"suhu":32.6,"rh":56.1,"tilt":10.88,"hpa":1003.0,"lat":-7.8081415,"lon":110.26498966666666},{"no":436,"t":"16:46","img":"obs_436.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.72,"sat":10.0,"suhu":33.1,"rh":55.1,"tilt":10.96,"hpa":1003.0,"lat":-7.8081415,"lon":110.26498966666666},{"no":437,"t":"16:50","img":"obs_437.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.69,"sat":11.0,"suhu":32.0,"rh":58.2,"tilt":9.63,"hpa":1003.1,"lat":-7.8081415,"lon":110.26498966666666},{"no":438,"t":"16:52","img":"obs_438.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.84,"sat":9.0,"suhu":31.7,"rh":58.6,"tilt":9.38,"hpa":1003.1,"lat":-7.8081415,"lon":110.26498966666666},{"no":439,"t":"17:09","img":"obs_439.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.95,"sat":9.0,"suhu":29.8,"rh":64.3,"tilt":5.06,"hpa":1003.4,"lat":-7.8081415,"lon":110.26498966666666},{"no":440,"t":"17:11","img":"obs_440.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.8,"sat":9.0,"suhu":29.9,"rh":63.9,"tilt":4.86,"hpa":1003.4,"lat":-7.8081415,"lon":110.26498966666666},{"no":441,"t":"17:17","img":"obs_441.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.78,"sat":10.0,"suhu":29.9,"rh":64.6,"tilt":3.32,"hpa":1003.4,"lat":-7.8081415,"lon":110.26498966666666},{"no":442,"t":"17:19","img":"obs_442.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.93,"sat":9.0,"suhu":29.8,"rh":64.8,"tilt":2.94,"hpa":1003.4,"lat":-7.8081415,"lon":110.26498966666666},{"no":443,"t":"17:21","img":"obs_443.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.96,"sat":8.0,"suhu":29.1,"rh":66.4,"tilt":3.35,"hpa":1003.5,"lat":-7.8081415,"lon":110.26498966666666},{"no":444,"t":"17:23","img":"obs_444.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":1.02,"sat":7.0,"suhu":29.1,"rh":67.3,"tilt":2.3,"hpa":1003.6,"lat":-7.8081415,"lon":110.26498966666666},{"no":445,"t":"17:22","img":"obs_445.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.73,"sat":9.0,"suhu":29.2,"rh":66.8,"tilt":2.06,"hpa":1003.5,"lat":-7.8081415,"lon":110.26498966666666},{"no":446,"t":"17:25","img":"obs_446.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.91,"sat":10.0,"suhu":29.1,"rh":67.4,"tilt":1.63,"hpa":1003.5,"lat":-7.8081415,"lon":110.26498966666666},{"no":447,"t":"17:27","img":"obs_447.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.76,"sat":10.0,"suhu":28.9,"rh":67.4,"tilt":1.16,"hpa":1003.6,"lat":-7.8081415,"lon":110.26498966666666},{"no":448,"t":"17:27","img":"obs_448.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.76,"sat":10.0,"suhu":28.9,"rh":67.4,"tilt":1.16,"hpa":1003.6,"lat":-7.8081415,"lon":110.26498966666666},{"no":449,"t":"17:29","img":"obs_449.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.94,"sat":8.0,"suhu":29.0,"rh":67.6,"tilt":25.4,"hpa":1003.7,"lat":-7.8081415,"lon":110.26498966666666},{"no":450,"t":"17:31","img":"obs_450.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.91,"sat":10.0,"suhu":29.1,"rh":67.0,"tilt":25.18,"hpa":1003.7,"lat":-7.8081415,"lon":110.26498966666666},{"no":451,"t":"17:33","img":"obs_451.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":1.02,"sat":7.0,"suhu":29.2,"rh":67.0,"tilt":24.53,"hpa":1003.7,"lat":-7.8081415,"lon":110.26498966666666},{"no":452,"t":"17:35","img":"obs_452.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.76,"sat":9.0,"suhu":29.3,"rh":65.6,"tilt":24.04,"hpa":1003.7,"lat":-7.8081415,"lon":110.26498966666666},{"no":453,"t":"17:37","img":"obs_453.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.93,"sat":10.0,"suhu":28.7,"rh":68.1,"tilt":23.81,"hpa":1003.8,"lat":-7.8081415,"lon":110.26498966666666},{"no":454,"t":"17:39","img":"obs_454.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.75,"sat":10.0,"suhu":29.2,"rh":66.5,"tilt":22.81,"hpa":1003.8,"lat":-7.8081415,"lon":110.26498966666666},{"no":455,"t":"17:39","img":"obs_455.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.75,"sat":10.0,"suhu":29.2,"rh":66.5,"tilt":22.81,"hpa":1003.8,"lat":-7.8081415,"lon":110.26498966666666},{"no":456,"t":"17:41","img":"obs_456.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.96,"sat":8.0,"suhu":29.1,"rh":67.1,"tilt":22.38,"hpa":1003.9,"lat":-7.8081415,"lon":110.26498966666666},{"no":458,"t":"17:46","img":"obs_458.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":null,"sat":null,"suhu":29.5,"rh":65.9,"tilt":21.2,"hpa":1003.9,"lat":-7.8081415,"lon":110.26498966666666},{"no":459,"t":"17:48","img":"obs_459.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.74,"sat":10.0,"suhu":29.0,"rh":66.4,"tilt":17.3,"hpa":1003.9,"lat":-7.8081415,"lon":110.26498966666666},{"no":460,"t":"17:50","img":"obs_460.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.74,"sat":10.0,"suhu":28.3,"rh":70.0,"tilt":21.29,"hpa":1004.0,"lat":-7.8081415,"lon":110.26498966666666},{"no":461,"t":"17:52","img":"obs_461.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.79,"sat":9.0,"suhu":28.7,"rh":68.5,"tilt":21.35,"hpa":1004.0,"lat":-7.8081415,"lon":110.26498966666666},{"no":462,"t":"17:54","img":"obs_462.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.77,"sat":10.0,"suhu":28.6,"rh":68.0,"tilt":19.87,"hpa":1004.0,"lat":-7.8081415,"lon":110.26498966666666},{"no":463,"t":"17:56","img":"obs_463.webp","hasil":"foto","cuaca":"-","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.81,"sat":9.0,"suhu":29.6,"rh":66.3,"tilt":18.51,"hpa":1004.1,"lat":-7.8081415,"lon":110.26498966666666},{"no":464,"t":"17:57","img":"obs_464.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.78,"sat":10.0,"suhu":29.2,"rh":66.0,"tilt":18.03,"hpa":1004.1,"lat":-7.8081415,"lon":110.26498966666666},{"no":465,"t":"18:00","img":"obs_465.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.84,"sat":9.0,"suhu":29.1,"rh":66.9,"tilt":17.27,"hpa":1004.1,"lat":-7.8081415,"lon":110.26498966666666},{"no":466,"t":"18:03","img":"obs_466.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.95,"sat":8.0,"suhu":28.7,"rh":68.5,"tilt":16.96,"hpa":1004.1,"lat":-7.8081415,"lon":110.26498966666666},{"no":467,"t":"18:12","img":"obs_467.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.93,"sat":8.0,"suhu":28.7,"rh":69.7,"tilt":14.71,"hpa":1004.3,"lat":-7.8081415,"lon":110.26498966666666},{"no":468,"t":"18:12","img":"obs_468.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.93,"sat":8.0,"suhu":28.7,"rh":69.7,"tilt":14.71,"hpa":1004.3,"lat":-7.8081415,"lon":110.26498966666666},{"no":469,"t":"18:13","img":"obs_469.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.77,"sat":9.0,"suhu":28.7,"rh":70.3,"tilt":14.71,"hpa":1004.3,"lat":-7.8081415,"lon":110.26498966666666},{"no":470,"t":"18:13","img":"obs_470.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.77,"sat":9.0,"suhu":28.7,"rh":70.3,"tilt":14.71,"hpa":1004.3,"lat":-7.8081415,"lon":110.26498966666666},{"no":471,"t":"18:15","img":"obs_471.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.75,"sat":10.0,"suhu":28.4,"rh":70.9,"tilt":14.17,"hpa":1004.3,"lat":-7.8081415,"lon":110.26498966666666},{"no":472,"t":"18:15","img":"obs_472.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.75,"sat":10.0,"suhu":28.4,"rh":70.9,"tilt":14.17,"hpa":1004.3,"lat":-7.8081415,"lon":110.26498966666666},{"no":473,"t":"18:16","img":"obs_473.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.78,"sat":10.0,"suhu":28.3,"rh":71.1,"tilt":13.7,"hpa":1004.4,"lat":-7.8081415,"lon":110.26498966666666},{"no":474,"t":"18:17","img":"obs_474.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.79,"sat":9.0,"suhu":27.8,"rh":73.2,"tilt":13.51,"hpa":1004.4,"lat":-7.8081415,"lon":110.26498966666666},{"no":475,"t":"18:24","img":"obs_475.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.7,"sat":11.0,"suhu":27.1,"rh":76.8,"tilt":11.95,"hpa":1004.6,"lat":-7.8081415,"lon":110.26498966666666},{"no":476,"t":"18:25","img":"obs_476.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.82,"sat":9.0,"suhu":27.2,"rh":77.0,"tilt":11.94,"hpa":1004.5,"lat":-7.8081415,"lon":110.26498966666666},{"no":477,"t":"18:26","img":"obs_477.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.75,"sat":10.0,"suhu":27.1,"rh":76.9,"tilt":11.57,"hpa":1004.6,"lat":-7.8081415,"lon":110.26498966666666},{"no":478,"t":"18:29","img":"obs_478.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.71,"sat":11.0,"suhu":27.3,"rh":76.1,"tilt":10.89,"hpa":1004.7,"lat":-7.8081415,"lon":110.26498966666666},{"no":479,"t":"18:36","img":"obs_479.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.76,"sat":10.0,"suhu":28.1,"rh":73.8,"tilt":8.97,"hpa":1004.7,"lat":-7.8081415,"lon":110.26498966666666},{"no":480,"t":"18:50","img":"obs_480.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.8,"sat":9.0,"suhu":26.9,"rh":79.0,"tilt":6.27,"hpa":1005.0,"lat":-7.8081415,"lon":110.26498966666666},{"no":481,"t":"19:08","img":"obs_481.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.83,"sat":9.0,"suhu":26.9,"rh":78.4,"tilt":13.79,"hpa":1005.2,"lat":-7.8081415,"lon":110.26498966666666},{"no":482,"t":"19:15","img":"obs_482.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.84,"sat":9.0,"suhu":26.8,"rh":79.3,"tilt":12.47,"hpa":1005.3,"lat":-7.8081415,"lon":110.26498966666666},{"no":483,"t":"19:19","img":"obs_483.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.89,"sat":8.0,"suhu":26.7,"rh":79.9,"tilt":11.44,"hpa":1005.4,"lat":-7.8081415,"lon":110.26498966666666},{"no":484,"t":"19:25","img":"obs_484.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.85,"sat":9.0,"suhu":27.1,"rh":78.5,"tilt":9.89,"hpa":1005.5,"lat":-7.8081415,"lon":110.26498966666666},{"no":485,"t":"19:31","img":"obs_485.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.91,"sat":8.0,"suhu":28.8,"rh":71.9,"tilt":8.54,"hpa":1005.4,"lat":-7.8081415,"lon":110.26498966666666},{"no":486,"t":"19:31","img":"obs_486.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.91,"sat":8.0,"suhu":28.8,"rh":71.9,"tilt":8.54,"hpa":1005.4,"lat":-7.8081415,"lon":110.26498966666666},{"no":487,"t":"19:32","img":"obs_487.webp","hasil":"terlihat","cuaca":"mendung","alt":25.34,"elong":28.77,"ilum":6.2,"hdop":0.86,"sat":9.0,"suhu":28.6,"rh":72.3,"tilt":8.35,"hpa":1005.5,"lat":-7.8081415,"lon":110.26498966666666}],"fase":[{"mulai":"16:43","judul":"Uji arah dengan Matahari","ket":"Matahari jingga dipotret lewat filter; makin redup menjelang terbenam."},{"mulai":"17:19","judul":"Senja & awan tebal","ket":"Teleskop diarahkan menembus awan dan kabut setelah Matahari terbenam."},{"mulai":"17:33","judul":"Mencari hilal di balik kabut","ket":"Pukul 17:39 sabit tipis mulai samar terlihat."},{"mulai":"17:56","judul":"Hilal terlihat","ket":"Sabit hilal tampak jelas, lalu close-up dengan tekstur permukaan."},{"mulai":"18:50","judul":"Pengamatan lanjutan","ket":"Setelah gelap: langit malam dan satu objek titik terang."}]}</script>
<script>
(function () {
  "use strict";
  var D = JSON.parse(document.getElementById("data-sesi").textContent);
  var F = D.frames, FASE = D.fase;
  var BASE = "{{ asset('moonlight-assets/replay-20260913') }}/";
  var WARNA = ["#f97316", "#a78bfa", "#94a3b8", "#22c55e", "#38bdf8"];
  var $ = function (id) { return document.getElementById(id); };
  var menit = function (t) { return +t.slice(0, 2) * 60 + +t.slice(3, 5); };
  var idx = 0, main = false, kec = 1, timer = null;

  function faseDari(t) {
    var k = 0;
    for (var i = 0; i < FASE.length; i++) if (menit(t) >= menit(FASE[i].mulai)) k = i;
    return k;
  }
  function fmt(v, s, d) { return v == null ? "-" : (d != null ? v.toFixed(d) : v) + s; }

  // Linimasa fase (lebar sebanding jumlah foto per fase)
  var jumlah = FASE.map(function () { return 0; });
  F.forEach(function (f) { jumlah[faseDari(f.t)]++; });
  FASE.forEach(function (fs, i) {
    var seg = document.createElement("div");
    seg.style.flex = jumlah[i]; seg.style.background = WARNA[i]; seg.title = fs.mulai + " — " + fs.judul;
    seg.onclick = function () { lompatFase(i); };
    $("fasebar").appendChild(seg);
    var it = document.createElement("div");
    it.className = "fase-item"; it.style.setProperty("--c", WARNA[i]);
    it.innerHTML = "<small>" + fs.mulai + " WIB</small><b>" + fs.judul + "</b><small>" + fs.ket + "</small>";
    it.onclick = function () { lompatFase(i); };
    $("fase-list").appendChild(it);
  });
  $("skala-tengah").textContent = FASE[3].mulai + " hilal";

  // Strip foto
  F.forEach(function (f, i) {
    var b = document.createElement("button");
    b.innerHTML = '<img loading="lazy" src="' + BASE + "t_" + f.img + '" alt="Foto ' + f.no + '"><span>' + f.t + "</span>";
    b.onclick = function () { berhenti(); tampil(i); window.scrollTo({ top: $("stage").getBoundingClientRect().top + scrollY - 70, behavior: "smooth" }); };
    $("strip").appendChild(b);
  });

  // Grafik kecil
  function spark(svgId, key, warna) {
    var v = F.map(function (f) { return f[key]; }), mn = Math.min.apply(0, v), mx = Math.max.apply(0, v);
    var x = function (i) { return i / (F.length - 1) * 300; }, y = function (a) { return 52 - (a - mn) / ((mx - mn) || 1) * 46; };
    var d = v.map(function (a, i) { return (i ? "L" : "M") + x(i).toFixed(1) + " " + y(a).toFixed(1); }).join(" ");
    $(svgId).innerHTML = '<path d="' + d + '" fill="none" stroke="' + warna + '" stroke-width="2" vector-effect="non-scaling-stroke"/>' +
      '<line id="' + svgId + '-m" y1="0" y2="58" stroke="currentColor" stroke-opacity=".5" stroke-width="1" vector-effect="non-scaling-stroke"/>';
    return { x: x, mn: mn, mx: mx };
  }
  var spS = spark("spark-suhu", "suhu", "#f97316"), spR = spark("spark-rh", "rh", "#38bdf8");
  $("sp-suhu").textContent = spS.mn + "–" + spS.mx; $("sp-rh").textContent = spR.mn + "–" + spR.mx;

  var geser = $("geser"); geser.max = F.length - 1;
  geser.oninput = function () { berhenti(); tampil(+geser.value); };

  function tampil(i) {
    idx = Math.max(0, Math.min(F.length - 1, i));
    var f = F[idx], k = faseDari(f.t);
    $("foto").src = BASE + f.img;
    $("jam").textContent = f.t;
    $("fase-judul").textContent = FASE[k].judul; $("fase-ket").textContent = FASE[k].ket;
    // Lencana mengikuti fase (isi foto); kolom "Hasil" di log adalah status sesi, bukan isi tiap foto
    var hilal = k === 3;
    $("hasil").textContent = hilal ? "Hilal terlihat" : FASE[k].judul;
    $("hasil").className = "ov ov-hasil" + (hilal ? " terlihat" : "");
    $("nofoto").textContent = "Foto #" + f.no + " · " + (idx + 1) + "/" + F.length;
    $("t-hasil").textContent = f.hasil; $("t-cuaca").textContent = f.cuaca;
    $("t-alt").textContent = fmt(f.alt, "°", 2); $("t-elong").textContent = fmt(f.elong, "°", 2); $("t-ilum").textContent = fmt(f.ilum, "%", 1);
    $("t-suhu").textContent = fmt(f.suhu, " °C", 1); $("t-rh").textContent = fmt(f.rh, " %", 1);
    $("t-hpa").textContent = fmt(f.hpa, " hPa", 1); $("t-tilt").textContent = fmt(f.tilt, "°", 2);
    $("t-gps").textContent = (f.sat != null ? f.sat + " satelit" : "-") + (f.hdop != null ? " · HDOP " + f.hdop.toFixed(2) : "");
    $("t-lok").textContent = f.lat != null ? f.lat.toFixed(5) + ", " + f.lon.toFixed(5) : "-";
    geser.value = idx;
    ["spark-suhu", "spark-rh"].forEach(function (s) { var m = $(s + "-m"); m.setAttribute("x1", spS.x(idx)); m.setAttribute("x2", spS.x(idx)); });
    var bs = $("strip").children; for (var j = 0; j < bs.length; j++) bs[j].classList.toggle("aktif", j === idx);
    var fl = $("fase-list").children; for (var q = 0; q < fl.length; q++) fl[q].classList.toggle("aktif", q === k);
    if (F[idx + 1]) { var pre = new Image(); pre.src = BASE + F[idx + 1].img; }
  }

  function jalan() {
    clearTimeout(timer);
    if (!main) return;
    timer = setTimeout(function () {
      if (idx >= F.length - 1) { berhenti(); return; }
      tampil(idx + 1); jalan();
    }, 1600 / kec);
  }
  function berhenti() { main = false; clearTimeout(timer); $("putar").textContent = "▶ Putar"; }
  function lompatFase(i) { berhenti(); tampil(F.findIndex(function (f) { return faseDari(f.t) === i; })); }

  $("putar").onclick = function () {
    if (main) { berhenti(); return; }
    if (idx >= F.length - 1) tampil(0);
    main = true; $("putar").textContent = "❚❚ Jeda"; jalan();
  };
  $("maju").onclick = function () { berhenti(); tampil(idx + 1); };
  $("mundur").onclick = function () { berhenti(); tampil(idx - 1); };
  $("ke-hilal").onclick = function () { lompatFase(3); };
  Array.prototype.forEach.call(document.querySelectorAll(".kec"), function (b) {
    b.onclick = function () {
      kec = +b.dataset.k;
      Array.prototype.forEach.call(document.querySelectorAll(".kec"), function (x) { x.classList.toggle("aktif", x === b); });
      jalan();
    };
    if (+b.dataset.k === 1) b.classList.add("aktif");
  });
  document.addEventListener("keydown", function (e) {
    if (e.target.tagName === "INPUT") return;
    if (e.key === "ArrowRight") { berhenti(); tampil(idx + 1); }
    if (e.key === "ArrowLeft") { berhenti(); tampil(idx - 1); }
    if (e.key === " ") { e.preventDefault(); $("putar").click(); }
  });
  tampil(0);
})();
</script>
</body>
</html>
