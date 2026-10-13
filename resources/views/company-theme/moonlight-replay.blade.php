<!doctype html>
<html lang="id" data-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Replay Observasi Hilal 12 Oktober 2026 — MOONLIGHT</title>
  <meta name="description" content="Putar ulang rekaman nyata sesi observasi hilal MOONLIGHT, 12 Oktober 2026 di SHATOMEDIA Sedayu, Bantul: 53 foto teleskop dari Matahari terbenam sampai sabit hilal terlihat jelas, beserta data posisi hilal.">
  <link rel="canonical" href="https://shatomedia.com/moonlight/replay">
  <meta property="og:title" content="Replay Observasi Hilal — MOONLIGHT">
  <meta property="og:description" content="Rekaman nyata sesi rukyat 12 Oktober 2026: dari Matahari terbenam sampai sabit hilal terlihat jelas.">
  <meta property="og:image" content="{{ asset('moonlight-assets/replay-20261012/obs_930.webp') }}">
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
  <h1>Observasi Hilal <span>12 Oktober 2026</span></h1>
  <div class="label-jujur">● Rekaman nyata sesi observasi di SHATOMEDIA, Sedayu, Bantul — diputar ulang, tidak terhubung ke teleskop.</div>
  <p style="margin:10px 0 0;color:var(--muted);max-width:760px">53 foto teleskop pukul 17:13–18:02 WIB dalam cuaca cerah, masing-masing dengan data yang tercatat saat itu. Tekan <b>Putar</b>, geser linimasa, atau langsung <b>lompat ke saat hilal terlihat</b>. <a href="{{ route('moonlight-landing') }}">← Kembali ke MOONLIGHT</a> · <a href="/moonlight-demo/" target="_blank" rel="noopener">Coba dashboard demo ↗</a></p>
</header>

<main class="wrap">
  <div class="grid">
    <section>
      <div class="stage" id="stage">
        <img id="foto" alt="Foto observasi">
        <div class="ov ov-jam"><span id="jam">--:--</span><small>WIB · 12 Okt 2026</small></div>
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
        <div class="skala"><span>17:13</span><span id="skala-tengah"></span><span>18:02</span></div>
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
        <span>Catatan</span><b id="t-catatan" style="font-size:13px">-</b>
        <span>Lokasi</span><b id="t-lok" style="font-size:12px">-</b>
      </div>
      <div class="sep"></div>
      <p style="margin:0;font-size:13px;color:var(--muted)">Baris "Auto-capture otomatis" adalah foto berkala yang diambil sistem sendiri; baris lain disimpan operator. Data dari log sesi MOONLIGHT.</p>
    </aside>
  </div>

  <h3 class="judul">Alur sesi</h3>
  <div class="fase-list" id="fase-list"></div>

  <h3 class="judul">Semua foto sesi</h3>
  <div class="strip" id="strip"></div>

  <p class="catatan">Sumber: arsip observasi MOONLIGHT (foto teleskop & log sensor), SHATOMEDIA Research &amp; Development. Foto diperkecil untuk web; nilai tinggi, elongasi, dan iluminasi hilal adalah hasil perhitungan sistem untuk sesi ini. Keterangan fase disusun dari isi foto. Lihat juga <a href="{{ route('taqwa-hub-landing') }}">TAQWA-Hub</a> — hasil rukyat MOONLIGHT dapat tampil di TV masjid.</p>
</main>

<script type="application/json" id="data-sesi">{"tanggal":"2026-10-12","lokasi":"SHATOMEDIA, Sedayu, Bantul","frames":[{"no":892,"t":"17:13","img":"obs_892.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":893,"t":"17:14","img":"obs_893.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":894,"t":"17:15","img":"obs_894.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":895,"t":"17:15","img":"obs_895.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":896,"t":"17:15","img":"obs_896.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":897,"t":"17:16","img":"obs_897.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":898,"t":"17:16","img":"obs_898.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":899,"t":"17:17","img":"obs_899.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":900,"t":"17:17","img":"obs_900.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":901,"t":"17:18","img":"obs_901.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":902,"t":"17:19","img":"obs_902.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":903,"t":"17:20","img":"obs_903.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":904,"t":"17:20","img":"obs_904.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":905,"t":"17:20","img":"obs_905.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":906,"t":"17:22","img":"obs_906.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":907,"t":"17:23","img":"obs_907.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":908,"t":"17:24","img":"obs_908.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":909,"t":"17:26","img":"obs_909.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":910,"t":"17:28","img":"obs_910.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":911,"t":"17:30","img":"obs_911.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":912,"t":"17:32","img":"obs_912.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":913,"t":"17:34","img":"obs_913.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":914,"t":"17:36","img":"obs_914.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":915,"t":"17:38","img":"obs_915.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":916,"t":"17:40","img":"obs_916.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":917,"t":"17:40","img":"obs_917.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":918,"t":"17:40","img":"obs_918.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":919,"t":"17:41","img":"obs_919.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":920,"t":"17:42","img":"obs_920.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":921,"t":"17:44","img":"obs_921.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":922,"t":"17:44","img":"obs_922.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":923,"t":"17:44","img":"obs_923.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":924,"t":"17:45","img":"obs_924.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":925,"t":"17:45","img":"obs_925.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":926,"t":"17:46","img":"obs_926.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":927,"t":"17:46","img":"obs_927.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":928,"t":"17:46","img":"obs_928.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":929,"t":"17:48","img":"obs_929.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":930,"t":"17:49","img":"obs_930.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":931,"t":"17:50","img":"obs_931.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":932,"t":"17:52","img":"obs_932.webp","hasil":"foto","cuaca":"-","alt":17.3,"elong":21.56,"ilum":3.5,"catatan":"Auto-capture otomatis","lat":-7.80814,"lon":110.26499},{"no":933,"t":"17:53","img":"obs_933.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":934,"t":"17:53","img":"obs_934.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":935,"t":"17:54","img":"obs_935.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":936,"t":"17:54","img":"obs_936.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":937,"t":"17:55","img":"obs_937.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":938,"t":"17:56","img":"obs_938.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":939,"t":"17:56","img":"obs_939.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":940,"t":"17:58","img":"obs_940.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":941,"t":"17:59","img":"obs_941.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":942,"t":"18:00","img":"obs_942.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":943,"t":"18:00","img":"obs_943.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499},{"no":944,"t":"18:02","img":"obs_944.webp","hasil":"terlihat","cuaca":"cerah","alt":18.17,"elong":21.54,"ilum":3.5,"catatan":"-","lat":-7.80814,"lon":110.26499}],"fase":[{"mulai":"17:13","judul":"Matahari terbenam","ket":"Matahari dipotret lewat filter, lalu tenggelam di balik pepohonan sekitar 17:23."},{"mulai":"17:24","judul":"Mencari hilal di langit senja","ket":"Teleskop diarahkan ke posisi hilal saat langit masih terang."},{"mulai":"17:40","judul":"Hilal mulai tampak","ket":"Sabit tipis mulai terlihat samar di langit senja."},{"mulai":"17:41","judul":"Hilal terlihat jelas","ket":"Sabit hilal tampak jelas dan tajam."},{"mulai":"17:53","judul":"Langit menggelap","ket":"Hilal makin kontras dan tetap terlihat sampai 18:02."}]}</script>
<script>
(function () {
  "use strict";
  var D = JSON.parse(document.getElementById("data-sesi").textContent);
  var F = D.frames, FASE = D.fase;
  var BASE = "{{ asset('moonlight-assets/replay-20261012') }}/";
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

  var geser = $("geser"); geser.max = F.length - 1;
  geser.oninput = function () { berhenti(); tampil(+geser.value); };

  function tampil(i) {
    idx = Math.max(0, Math.min(F.length - 1, i));
    var f = F[idx], k = faseDari(f.t);
    $("foto").src = BASE + f.img;
    $("jam").textContent = f.t;
    $("fase-judul").textContent = FASE[k].judul; $("fase-ket").textContent = FASE[k].ket;
    // Lencana mengikuti fase (isi foto); kolom "Hasil" di log adalah status sesi, bukan isi tiap foto
    var hilal = k >= 2;
    $("hasil").textContent = hilal ? "Hilal terlihat" : FASE[k].judul;
    $("hasil").className = "ov ov-hasil" + (hilal ? " terlihat" : "");
    $("nofoto").textContent = "Foto #" + f.no + " · " + (idx + 1) + "/" + F.length;
    $("t-hasil").textContent = f.hasil; $("t-cuaca").textContent = f.cuaca;
    $("t-alt").textContent = fmt(f.alt, "°", 2); $("t-elong").textContent = fmt(f.elong, "°", 2); $("t-ilum").textContent = fmt(f.ilum, "%", 1);
    $("t-catatan").textContent = f.catatan || "-";
    $("t-lok").textContent = f.lat != null ? f.lat.toFixed(5) + ", " + f.lon.toFixed(5) : "-";
    geser.value = idx;
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
  // Lompat ke foto sabit paling jernih sesi ini (bukan awal fase yang sabitnya masih tipis)
  var FOTO_HILAL = 930;
  $("ke-hilal").onclick = function () {
    var i = F.findIndex(function (f) { return f.no === FOTO_HILAL; });
    if (i < 0) { lompatFase(3); return; }
    berhenti(); tampil(i);
  };
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
  tampil(F.length > 1 ? 1 : 0);   // frame 0 sesi ini hampir hitam (sebelum Matahari masuk bidang pandang)
})();
</script>
</body>
</html>
