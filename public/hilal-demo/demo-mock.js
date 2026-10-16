/* MOONLIGHT Fleet Control Room — lapisan DEMO (shatomedia.com/hilal-demo/).
   Dimuat SEBELUM skrip dashboard asli; menjawab /api/hilal-fleet di browser dengan armada
   simulasi. Tidak ada koneksi ke Node-RED, MQTT, atau unit sungguhan.
   Snapshot memakai foto arsip nyata sesi 12 Oktober 2026 (unit-01, SHATOMEDIA Sedayu). */
(function () {
  "use strict";
  var SNAP = window.__HILAL_SNAP__ || { unit01: [], demo02: [] };
  var MULAI = Date.now();

  // Armada simulasi: 2 online, 1 offline (menunjukkan tampilan unit terputus), 1 slot kosong.
  var ARMADA = [
    { id: "unit-01", loc: { name: "SHATOMEDIA, Sedayu, Bantul", lat: -7.80814, lon: 110.26499 },
      snap: "unit01", az: 262.4, alt0: 18.2, laju: -0.25, sync: "matahari", online: true },
    { id: "demo-02 (simulasi)", loc: { name: "Lokasi rukyat demo (simulasi)", lat: -8.0213, lon: 110.3201 },
      snap: "demo02", az: 251.3, alt0: 13.4, laju: -0.2, sync: "bulan", online: true },
    { id: "demo-03 (simulasi)", loc: { name: "Lokasi demo (simulasi)", lat: -7.7956, lon: 110.3695 },
      snap: null, az: 0, alt0: 0, laju: 0, sync: "horizontal", online: false }
  ];

  function iso(ms) { return new Date(ms).toISOString(); }

  function riwayat(u, sekarang) {
    // 60 menit terakhir, satu titik per 2 menit: Bulan turun mendekati ufuk barat setelah maghrib
    var titik = [], akhir = u.online ? sekarang : sekarang - 30 * 60000;
    for (var m = 60; m >= 0; m -= 2) {
      var t = akhir - m * 60000;
      var alt = u.online ? u.alt0 + (m * u.laju * -1) + Math.sin(t / 900000) * 0.3 : 12 - (60 - m) * 0.2;
      titik.push({ ts: iso(t), alt: Math.round(alt * 100) / 100 });
    }
    return titik;
  }

  function armada() {
    var sekarang = Date.now(), detik = Math.floor((sekarang - MULAI) / 1000);
    return {
      server_time: iso(sekarang), demo: true,
      units: ARMADA.map(function (u, i) {
        var daftar = u.snap ? SNAP[u.snap] || [] : [];
        var urutan = Math.floor(detik / 5 + i * 3);
        var drift = u.online ? Math.sin(sekarang / 60000 + i) * 0.4 : 0;
        return {
          device_id: u.id,
          status: u.online ? "online" : "offline",
          last_seen_at: iso(u.online ? sekarang - 2000 : sekarang - 30 * 60000),
          telemetry: {
            ts: iso(u.online ? sekarang - 2000 : sekarang - 30 * 60000),
            uptime_sec: u.online ? 3600 * (2 + i) + detik : 0,
            mount: { az: Math.round((u.az + drift) * 10) / 10, alt: Math.round((u.alt0 + drift) * 10) / 10,
                     tracking: u.online, sync_type: u.sync },
            location: u.loc
          },
          snapshot: daftar.length ? { ts: iso(sekarang - (detik % 5) * 1000), image_b64: daftar[urutan % daftar.length] } : {},
          altitude_history: riwayat(u, sekarang)
        };
      })
    };
  }

  var fetchAsli = window.fetch.bind(window);
  window.fetch = function (input, init) {
    var url = typeof input === "string" ? input : (input && input.url) || "";
    if (url.indexOf("/api/hilal-fleet") >= 0) {
      return new Promise(function (ok) {
        setTimeout(function () {
          ok(new Response(JSON.stringify(armada()), { status: 200, headers: { "Content-Type": "application/json" } }));
        }, 150);
      });
    }
    if (url.indexOf("/api/") === 0) {
      return Promise.resolve(new Response(JSON.stringify({ demo: true, error: "Tidak tersedia di versi demo" }),
                                          { status: 403, headers: { "Content-Type": "application/json" } }));
    }
    return fetchAsli(input, init);
  };

  document.addEventListener("DOMContentLoaded", function () {
    var bar = document.createElement("div");
    bar.style.cssText = "position:fixed;left:0;right:0;bottom:0;z-index:2147483645;display:flex;flex-wrap:wrap;gap:6px 14px;" +
      "align-items:center;justify-content:center;padding:7px 12px;background:#0b0f14;color:#e7e9ee;border-top:2px solid #f0c040;" +
      "font:500 13px/1.35 system-ui,Segoe UI,sans-serif;text-align:center";
    bar.innerHTML = '<b style="color:#f0c040;letter-spacing:.04em">VERSI DEMO</b>' +
      "<span>Armada simulasi · snapshot dari rekaman nyata 12 Okt 2026 · tidak terhubung ke unit sungguhan</span>" +
      '<a href="/moonlight" style="color:#8fd6ff">Tentang MOONLIGHT</a>' +
      '<a href="/moonlight-demo/" style="color:#8fd6ff">Dashboard unit</a>' +
      '<a href="/moonlight/replay" style="color:#8fd6ff">Replay sesi</a>';
    document.body.appendChild(bar);
    document.body.style.paddingBottom = (bar.offsetHeight + 36) + "px";
  });
})();
