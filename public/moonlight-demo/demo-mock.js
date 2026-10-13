/* MOONLIGHT — lapisan DEMO (shatomedia.com/moonlight-demo/).
   Dimuat SEBELUM skrip dashboard asli. Semua panggilan API dijawab di browser dengan
   simulasi; TIDAK ADA koneksi ke teleskop/Pi mana pun. Foto kamera memakai rekaman
   nyata sesi 12 Oktober 2026 (SHATOMEDIA, Sedayu, Bantul).
   Disinkronkan dari repo MOONLIGHT oleh scripts/sync_moonlight_demo.py. */
(function () {
  "use strict";
  var FOTO = "/moonlight-assets/replay-20261012/";
  var KAT = {                      // kategori frame kamera -> nomor foto sesi 12 Oktober 2026
    matahari: [893, 894, 895, 896, 897, 898, 899, 900, 901, 902, 903, 904],
    senja: [905, 906, 907],
    kabut: [908, 909, 910, 911, 912, 913, 914, 915],
    hilal: [919, 920, 921, 922, 923, 924, 925, 926, 927, 928, 929, 930, 931, 932, 933, 934, 935, 936, 937, 938, 939, 940],
    malam: [892]
  };
  var LOK = { lat: -7.80814, lon: 110.26499, alt: 120, name: "SHATOMEDIA, Sedayu, Bantul (Demo)", saved: true };
  var BATAS_LUNAK = 60, BATAS_BAWAH = -15, KECEPATAN = 8;   // deg/detik (simulasi; unit asli lebih lambat)
  var PESAN_KUNCI = "Fitur ini dinonaktifkan di versi demo (perlu unit MOONLIGHT asli).";

  var m = { alt: 0, az: 180, tAlt: 0, tAz: 180, tracking: false, sync: "horizontal", home: "synced" };
  var obs = [], obsId = 100, kamera = null, frameIdx = 0;

  // ── Utilitas ────────────────────────────────────────────────────────────
  function json(body, status) {
    return new Response(JSON.stringify(body), { status: status || 200, headers: { "Content-Type": "application/json" } });
  }
  function kunci() { toast(PESAN_KUNCI); return json({ status: "error", demo: true, message: PESAN_KUNCI }, 403); }
  function acak(a, b) { return a + Math.random() * (b - a); }
  function r1(x, n) { var p = Math.pow(10, n || 1); return Math.round(x * p) / p; }
  function posBenda(nama) {
    var f = nama === "matahari" ? window.sunAltAzNow : window.moonAltAzNow;
    if (typeof f !== "function") return null;
    var p = f(new Date(), LOK.lat, LOK.lon);
    return { alt: p.altApp != null ? p.altApp : p.alt, az: p.az };
  }
  function jarak(a1, z1, a2, z2) {
    var R = Math.PI / 180, c = Math.sin(a1 * R) * Math.sin(a2 * R) + Math.cos(a1 * R) * Math.cos(a2 * R) * Math.cos((z1 - z2) * R);
    return Math.acos(Math.max(-1, Math.min(1, c))) / R;
  }
  function kategoriKamera() {
    var s = posBenda("matahari"), b = posBenda("bulan");
    if (s && s.alt > 0 && jarak(m.alt, m.az, s.alt, s.az) < 6) return "matahari";
    if (b && b.alt > -2 && jarak(m.alt, m.az, b.alt, b.az) < 6) return "hilal";
    if (m.alt < 0) return "malam";
    if (s && s.alt > 0) return "kabut";
    if (s && s.alt > -12) return "senja";
    return "malam";
  }
  function frameSekarang() {
    var k = KAT[kategoriKamera()];
    return FOTO + "obs_" + k[frameIdx % k.length] + ".webp";
  }
  var toastTimer = null, toastEl = null;
  function toast(t) {
    if (!document.body) return;
    if (!toastEl) {
      toastEl = document.createElement("div");
      toastEl.style.cssText = "position:fixed;left:50%;bottom:76px;transform:translateX(-50%);z-index:2147483646;max-width:min(92vw,480px);" +
        "padding:12px 16px;border-radius:10px;background:#1f2937;color:#fff;font:600 14px/1.4 system-ui,Segoe UI,sans-serif;" +
        "box-shadow:0 10px 30px rgba(0,0,0,.4);opacity:0;transition:opacity .2s";
      document.body.appendChild(toastEl);
    }
    toastEl.textContent = "🔒 " + t;
    toastEl.style.opacity = "1";
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function () { toastEl.style.opacity = "0"; }, 4000);
  }

  // ── Mount simulasi: bergerak bertahap menuju target ─────────────────────
  setInterval(function () {
    if (m.tracking && Math.abs(m.alt - m.tAlt) < 0.05 && Math.abs(m.az - m.tAz) < 0.05) {
      m.tAz = (m.tAz + 15 / 3600 * 0.5) % 360;   // ikuti gerak harian kecil
    }
    var langkah = KECEPATAN * 0.5;
    var dA = m.tAlt - m.alt, dZ = ((m.tAz - m.az + 540) % 360) - 180;
    m.alt += Math.abs(dA) <= langkah ? dA : Math.sign(dA) * langkah;
    m.az = (m.az + (Math.abs(dZ) <= langkah ? dZ : Math.sign(dZ) * langkah) + 360) % 360;
    frameIdx++;
  }, 500);

  function setTarget(alt, az, konfirmasi) {
    if (alt < BATAS_BAWAH) return json({ status: "error", message: "Target di bawah batas aman Alt " + BATAS_BAWAH + " deg" }, 400);
    if (alt > BATAS_LUNAK && !konfirmasi) {
      return json({ status: "needs_confirm", limit: BATAS_LUNAK, alt: r1(alt, 2),
        message: "Target Alt " + alt.toFixed(1) + " deg di atas batas hati-hati " + BATAS_LUNAK + " deg (dekat vertikal, risiko mount macet)" }, 409);
    }
    m.tAlt = alt; m.tAz = (az + 360) % 360;
    return json({ status: "ok", alt: r1(alt, 2), az: r1(m.tAz, 2) });
  }

  // ── Data awal: observasi dari sesi nyata 12 Okt 2026 ────────────────────
  [[930, "2026-10-12T17:49", "terlihat"], [925, "2026-10-12T17:45", "terlihat"], [935, "2026-10-12T17:54", "terlihat"],
   [940, "2026-10-12T17:58", "terlihat"], [917, "2026-10-12T17:40", "terlihat"], [897, "2026-10-12T17:16", "foto"]]
    .forEach(function (x) {
      obs.push({ id: x[0], time: x[1], loc: "SHATOMEDIA, Sedayu, Bantul", lat: LOK.lat, lon: LOK.lon, result: x[2],
                 weather: "cerah", note: "Rekaman nyata sesi 12 Okt 2026", alt: 18.17, elong: 21.54, ilum: 3.5,
                 image: "obs_" + x[0] + ".webp", auto: 0, gps_hdop: 0.8, gps_satellites: 9, target_name: x[0] >= 916 ? "Bulan" : "Matahari" });
    });

  // ── Rute ────────────────────────────────────────────────────────────────
  var REKAMAN = window.__ML_DEMO_REKAMAN__ || {};
  var TERKUNCI = [
    /^\/system\/(restart_service|shutdown_safe|backup_now|ota)/, /^\/network\//, /^\/mount\/unlock/, /^\/mount\/axis_calib\//,
    /^\/mount\/compass_/, /^\/mount\/imu_calibrate/, /^\/mount\/zero_here/, /^\/mount\/park/, /^\/mount\/sync_to_sensors/,
    /^\/mount\/titik_tetap\/tandai/, /^\/mount\/pointing_test/, /^\/mount\/debug/, /^\/camera\/flat\/calibrate/,
    /^\/camera\/capture_stack/, /^\/camera\/capture_burst/, /^\/camera\/expose_/, /^\/camera\/focus_assist/, /^\/camera\/autocenter/,
    /^\/location\/gps\/apply/, /^\/tv\/izin/, /^\/observations\/photos\.zip/, /^\/mount\/approach/, /^\/mount\/autogoto/,
    /^\/mount\/installation_mode/, /^\/camera\/tuning/, /^\/camera\/orientation/, /^\/camera\/autocapture/
  ];

  function jawab(metode, url, body) {
    var u = new URL(url, location.origin), p = u.pathname, q = u.searchParams;
    if (p.indexOf("/moonlight") === 0 || p.indexOf("/img/") >= 0) return null;   // berkas statis demo: biarkan
    var tulis = metode !== "GET";

    if (p === "/owner/status") return json({ allowed: true, locked: false, owner: true, demo: true });
    if (p.indexOf("/owner/") === 0) return json({ status: "ok" });

    // Mount
    if (p === "/mount/position") {
      var s = posBenda("matahari");
      return json({ az: r1(m.az, 3), alt: r1(m.alt, 3), tracking: m.tracking, time_synced: true,
                    sync_type: m.sync, imu_tilt_alt_deg: r1(m.alt + acak(-0.4, 0.4), 2), alt_mismatch_deg: r1(acak(0, 0.4), 2),
                    position_suspect: false, demo_sun_alt: s ? r1(s.alt, 1) : null });
    }
    if (p === "/mount/goto") {
      var objek = q.get("objek");
      if (objek) {
        var b = posBenda(objek === "matahari" ? "matahari" : "bulan");
        if (!b) return json({ status: "error", message: "Posisi benda belum bisa dihitung" }, 409);
        if (b.alt < 0) return json({ status: "error", message: (objek === "matahari" ? "Matahari" : "Bulan") + " sedang di bawah ufuk (Alt " + b.alt.toFixed(1) + " deg)" }, 409);
        if (objek === "matahari") toast("Simulasi: di unit asli, GoTo Matahari WAJIB memakai filter ND.");
        return setTarget(b.alt, b.az, q.get("confirm_high") === "1");
      }
      var alt = parseFloat(q.get("alt")), az = parseFloat(q.get("az"));
      if (isNaN(alt) || isNaN(az)) return json({ status: "error", message: "alt/az wajib diisi angka" }, 400);
      return setTarget(alt, az, q.get("confirm_high") === "1");
    }
    if (p === "/mount/nudge") {
      var dir = q.get("dir"), step = parseFloat(q.get("step"));
      if (!/^(up|down|left|right)$/.test(dir) || !(step >= 0.01 && step <= 45)) {
        return json({ status: "error", code: "parameter_tak_valid", message: "dir harus up/down/right/left dan step 0.01..45.0 derajat" }, 400);
      }
      var na = m.tAlt + (dir === "up" ? step : dir === "down" ? -step : 0);
      var nz = m.tAz + (dir === "right" ? step : dir === "left" ? -step : 0);
      var hasil = setTarget(na, nz, q.get("confirm_high") === "1");
      return hasil;
    }
    if (p === "/mount/stop") { m.tAlt = m.alt; m.tAz = m.az; m.tracking = false; return json({ status: "stopped" }); }
    if (p === "/mount/track") { m.tracking = q.get("on") === "1"; return json({ status: "ok", tracking: m.tracking }); }
    if (p === "/mount/home") { m.tAlt = 0; m.tAz = 180; m.home = "synced"; m.sync = "horizontal"; return json({ status: "started", message: "Home otomatis (simulasi)" }); }
    if (p === "/mount/home/status") return json({ status: m.home, message: "Home otomatis selesai (simulasi)" });

    // Kamera
    if (p === "/camera/status") return json({ connected: true, message: "Terhubung (simulasi)", model: "imx477 (demo)" });
    if (p === "/camera/focus_meter") return json({ status: "ok", stream_active: true, focus: r1(acak(38, 62), 1) });
    if (p === "/camera/settings") {
      if (!kamera) kamera = (REKAMAN["/camera/settings"] || {});
      if (tulis && body) { try { Object.assign(kamera, JSON.parse(body)); } catch (e) {} }
      return json(tulis ? Object.assign({ status: "ok" }, kamera) : kamera);
    }
    if (p === "/camera/capture") {
      return fetchAsli(frameSekarang()).then(function (r) { return r.blob(); })
        .then(function (b) { return new Response(b, { status: 200, headers: { "Content-Type": "image/webp" } }); });
    }

    // Sensor (nilai khas sesi 13 Sep 2026 -- sesi 12 Okt tidak mencatat sensor; sedikit berfluktuasi)
    if (p === "/sensors/aht10") return json({ connected: true, temp_c: r1(acak(27.5, 29.5)), humidity_pct: r1(acak(68, 74)),
                                              dew_point_c: r1(acak(21, 23)), dew_risk: false, dew_risk_text: "Aman", at: Date.now() / 1000 });
    if (p === "/sensors/bmp280") return json({ connected: true, pressure_hpa: r1(acak(1004, 1005.5)), temp_c: r1(acak(29, 31)), at: Date.now() / 1000 });
    if (p === "/sensors/compass") return json({ connected: true, heading_deg: r1((m.az + acak(-1.5, 1.5) + 360) % 360), at: Date.now() / 1000 });
    if (p === "/sensors/imu") return json({ connected: true, raw_tilt_deg: r1(m.alt + acak(-0.5, 0.5), 2), tilt_alt_deg: r1(m.alt + acak(-0.4, 0.4), 2), at: Date.now() / 1000 });
    if (p === "/sensors/sqm_estimate") return json({ available: true, sqm: r1(acak(17.8, 18.6), 2), message: "Estimasi (simulasi)" });
    if (p === "/gps/status") return json({ connected: true, fix: true, lat: LOK.lat, lon: LOK.lon, alt: LOK.alt, hdop: r1(acak(0.75, 0.95), 2),
                                           satellites: 9, satellites_in_view: 12, quality: 1, age_sec: 1 });
    if (p === "/location") {
      if (tulis) return kunci();
      return json(LOK);
    }

    // Sistem
    if (p === "/system/status") return json(Object.assign({}, REKAMAN["/system/status"] || {}, {
      code_version: "demo", cpu_temp_c: r1(acak(48, 55)), load_avg: [0.4, 0.5, 0.5], mem_available_mb: 2600, uptime_sec: 86400 }));

    // Observasi
    if (p === "/observations") {
      if (metode === "DELETE") return kunci();
      if (tulis) {
        var o = {}; try { o = JSON.parse(body || "{}"); } catch (e) {}
        var img = frameSekarang().split("/").pop();
        obs.unshift(Object.assign({ id: ++obsId, image: img, auto: 0, gps_hdop: 0.8, gps_satellites: 9 }, o));
        return json({ status: "ok", id: obsId, photo_failed: false, demo: true });
      }
      return json(obs);
    }

    if (TERKUNCI.some(function (r) { return r.test(p); }) && (tulis || /\/(calibrate|apply|tandai|unlock|zip)/.test(p))) return kunci();
    if (tulis && /^\/system\/|^\/tv\//.test(p)) return kunci();

    if (REKAMAN[p] !== undefined && !tulis) return json(REKAMAN[p]);
    if (tulis) return kunci();
    return json({ status: "ok", demo: true });
  }

  // ── Pasang: fetch & src gambar ──────────────────────────────────────────
  var fetchAsli = window.fetch.bind(window);
  window.fetch = function (input, init) {
    var url = typeof input === "string" ? input : (input && input.url) || "";
    var metode = ((init && init.method) || (input && input.method) || "GET").toUpperCase();
    var r = null;
    try { r = jawab(metode, url, init && init.body); } catch (e) { r = json({ status: "error", message: String(e) }, 500); }
    if (r === null) return fetchAsli(input, init);
    var jeda = new Promise(function (ok) { setTimeout(ok, 120 + Math.random() * 180); });   // rasa jaringan
    return jeda.then(function () { return r; });
  };

  function petakanSrc(v) {
    if (typeof v !== "string") return v;
    var p = v.replace(location.origin, "");
    if (p.indexOf("/camera/stream") === 0) return frameSekarang();
    var t = p.match(/^\/observations\/(\d+)\/thumb\.jpg/);
    if (t) { var o = obs.filter(function (x) { return String(x.id) === t[1]; })[0]; return o ? FOTO + "t_" + o.image : v; }
    var c = p.match(/^\/captures\/(.+)$/);
    if (c) return FOTO + c[1].replace(/\.jpe?g$/, ".webp");
    if (p.indexOf("/img/") === 0) return "img/" + p.slice(5);
    return v;
  }
  var desk = Object.getOwnPropertyDescriptor(HTMLImageElement.prototype, "src");
  Object.defineProperty(HTMLImageElement.prototype, "src", {
    configurable: true, enumerable: true,
    get: function () { return desk.get.call(this); },
    set: function (v) {
      var baru = petakanSrc(v);
      if (typeof v === "string" && v.indexOf("/camera/stream") >= 0) this.__mlLive = true;
      desk.set.call(this, baru);
    }
  });
  // Live-view: perbarui frame gambar stream tiap 1,5 detik (MJPEG asli = aliran terus-menerus)
  setInterval(function () {
    var imgs = document.querySelectorAll("img");
    for (var i = 0; i < imgs.length; i++) if (imgs[i].__mlLive) desk.set.call(imgs[i], frameSekarang());
  }, 1500);

  // Pita demo
  document.addEventListener("DOMContentLoaded", function () {
    var bar = document.createElement("div");
    bar.style.cssText = "position:fixed;left:0;right:0;bottom:0;z-index:2147483645;display:flex;flex-wrap:wrap;gap:6px 14px;align-items:center;" +
      "justify-content:center;padding:7px 12px;background:#0b0f14;color:#e7e9ee;border-top:2px solid #ffd166;font:500 13px/1.35 system-ui,Segoe UI,sans-serif;text-align:center";
    bar.innerHTML = '<b style="color:#ffd166;letter-spacing:.04em">VERSI DEMO</b>' +
      "<span>Mount, kamera & sensor disimulasikan · foto dari rekaman nyata 12 Okt 2026 · tidak terhubung ke teleskop</span>" +
      '<a href="/moonlight" style="color:#79d4ff">Tentang MOONLIGHT</a>' +
      '<a href="/moonlight/replay" style="color:#79d4ff">Replay sesi</a>';
    document.body.appendChild(bar);
    document.body.style.paddingBottom = (bar.offsetHeight + 4) + "px";
  });
})();
