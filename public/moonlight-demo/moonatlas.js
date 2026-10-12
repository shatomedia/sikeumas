/* Atlas Bulan (Fase 0, 29 Sep 2026) -- halaman penuh di menu Hilal: piringan Bulan
 * sesuai fase, librasi, dan orientasi pada waktu yang dipilih, dengan nama fitur IAU.
 *
 * Semua hitungan & render jalan di BROWSER (Pi tidak ikut bekerja). Aset dimuat hanya
 * saat atlas pertama dibuka: static/img/moon_nearside.jpg (LROC WAC, domain publik) dan
 * static/moonatlas_names.js (nama IAU, domain publik) -- keduanya dari
 * tools/build_moonatlas_data.py. Nama dikemas .js (bukan .json) karena owner_lock hanya
 * membebaskan ekstensi statis tertentu.
 *
 * Rumus: Meeus, Astronomical Algorithms, bab 53 (librasi optik, sudut posisi sumbu P,
 * posisi selenografis Matahari, koreksi toposentris) dan bab 48 (tepi terang, iluminasi).
 * Librasi FISIK (<0.05 deg) diabaikan. Posisi Bulan/Matahari memakai fungsi yang sudah
 * ada di blok <script> utama index.html (jde, moonPos, sunPos, eclToEq, moonAltAzNow).
 *
 * Konvensi layar: x ke kanan = barat langit, y ke atas = utara langit (tampilan mata
 * telanjang, "utara di atas"). Orientasi lain = rotasi tambahan phi (+ cermin opsional):
 * "zenit di atas" phi = -q (sudut paralaktik); "seperti kamera" phi = rotZ - q, rotZ dari
 * pencocokan foto. Pada mount Alt-Az kamera ikut tabung, jadi rotZ (rotasi kamera
 * terhadap arah zenit) semestinya TETAP selama kamera tidak dilepas/diputar.
 *
 * Fase 1 (29 Sep 2026): mode foto -- foto observasi ditumpuk dengan prediksi atlas.
 * Pusat & radius dari fit lingkaran tepi piringan (RANSAC), rotasi & cermin dari korelasi
 * polar pola terang-gelap foto vs prediksi (maria x pencahayaan). Tanpa kalibrasi mount:
 * autocenter_calib.json di Pi tidak konsisten (kolom Alt & Az nyaris sejajar), tidak dipakai.
 */
const MOON_R_KM = 1737.4;

// --- GEOMETRI (murni, tanpa DOM; dites tests/test_moonatlas_js.py) ---
function _maNorm180(x) { return ((x + 180) % 360 + 360) % 360 - 180; }

// Librasi optik (Meeus 53) untuk arah (lam, bet) ekliptika yang dilihat dari Bulan ke titik itu.
// Dipakai dua kali: arah Bumi (-> l, b) dan arah Matahari (-> l0, b0 = titik subsolar).
function _maOpticalLib(lam, bet, T) {
  const I = 1.54242 * RAD;
  const Om = 125.0445479 - 1934.1362891 * T + 0.0020754 * T * T + T * T * T / 467441 - T * T * T * T / 60616000;
  const F = 93.2720950 + 483202.0175233 * T - 0.0036539 * T * T - T * T * T / 3526000 + T * T * T * T / 863310000;
  const W = (lam - Om) * RAD, b = bet * RAD;
  const A = Math.atan2(Math.sin(W) * Math.cos(b) * Math.cos(I) - Math.sin(b) * Math.sin(I), Math.cos(W) * Math.cos(b));
  return {
    l: _maNorm180(A * DEG - F),
    b: Math.asin(-Math.sin(W) * Math.cos(b) * Math.sin(I) - Math.sin(b) * Math.cos(I)) * DEG,
    Om,
  };
}

// Geometri Bulan pada `date`. loc {lat, lon} -> toposentris (librasi, P, sudut paralaktik q,
// Alt/Az); tanpa loc -> geosentris (sama dgn almanak).
function moonAtlasGeometry(date, loc) {
  const jd = jde(date), T = (jd - 2451545) / 36525;
  const moon = moonPos(jd), sunLon = sunPos(jd);
  const mEq = eclToEq(moon.lon, moon.lat, jd), sEq = eclToEq(sunLon, 0, jd);
  const lib = _maOpticalLib(moon.lon, moon.lat, T);
  let l = lib.l, b = lib.b;

  // Sudut posisi sumbu rotasi Bulan (dari utara langit ke timur).
  const I = 1.54242 * RAD, eps = (23.439291111 - 0.013004167 * T) * RAD, V = lib.Om * RAD;
  const X = Math.sin(I) * Math.sin(V), Y = Math.sin(I) * Math.cos(V) * Math.cos(eps) - Math.cos(I) * Math.sin(eps);
  const om = Math.atan2(X, Y);
  let P = Math.asin(Math.sqrt(X * X + Y * Y) * Math.cos(mEq.ra * RAD - om) / Math.cos(b * RAD)) * DEG;

  // Titik subsolar selenografis (l0, b0): arah Matahari dilihat dari Bulan.
  const M = (357.5291092 + 35999.0502909 * T) * RAD;
  const Rkm = (1.000140 - 0.016708 * Math.cos(M) - 0.000141 * Math.cos(2 * M)) * 149597870.7;
  const dr = moon.dist / Rkm;
  const lamH = sunLon + 180 + dr * DEG * Math.cos(moon.lat * RAD) * Math.sin((sunLon - moon.lon) * RAD);
  const sub = _maOpticalLib(lamH, dr * moon.lat, T);

  // Elongasi, sudut fase, iluminasi, sudut posisi tepi terang (Meeus 48).
  const a0 = sEq.ra * RAD, d0 = sEq.dec * RAD, a = mEq.ra * RAD, d = mEq.dec * RAD;
  const cosPsi = Math.max(-1, Math.min(1, Math.sin(d0) * Math.sin(d) + Math.cos(d0) * Math.cos(d) * Math.cos(a0 - a)));
  const psi = Math.acos(cosPsi);
  const iAng = Math.atan2(Rkm * Math.sin(psi), moon.dist - Rkm * cosPsi);
  const chi = (Math.atan2(Math.cos(d0) * Math.sin(a0 - a),
    Math.sin(d0) * Math.cos(d) - Math.cos(d0) * Math.sin(d) * Math.cos(a0 - a)) * DEG + 360) % 360;

  let q = null, alt = null, az = null;
  if (loc && isFinite(loc.lat) && isFinite(loc.lon)) {
    // Koreksi toposentris (Meeus 53, akhir bab): paralaks Bulan ~1 deg menggeser librasi & P.
    const GMST = 280.46061837 + 360.98564736629 * (jd - 2451545) + 0.000387933 * T * T;
    const H = (GMST + loc.lon - mEq.ra) * RAD, ph = loc.lat * RAD;
    const Q = Math.atan2(Math.cos(ph) * Math.sin(H), Math.cos(d) * Math.sin(ph) - Math.sin(d) * Math.cos(ph) * Math.cos(H));
    const z = Math.acos(Math.max(-1, Math.min(1, Math.sin(d) * Math.sin(ph) + Math.cos(d) * Math.cos(ph) * Math.cos(H))));
    const pp = Math.asin(6378.14 / moon.dist) * (Math.sin(z) + 0.0084 * Math.sin(2 * z));
    const dl = -pp * Math.sin(Q - P * RAD) / Math.cos(b * RAD);
    const db = pp * Math.cos(Q - P * RAD);
    const dP = dl * Math.sin(b * RAD + db) - pp * Math.sin(Q) * Math.tan(d);
    l += dl * DEG; b += db * DEG; P += dP * DEG;
    q = Q * DEG;
    const aa = moonAltAzNow(date, loc.lat, loc.lon);
    alt = aa.altApp; az = aa.az;
  }
  return {
    jd, l, b, P, l0: sub.l, b0: sub.b, chi,
    k: (1 + Math.cos(iAng)) / 2, elong: psi * DEG, phase: iAng * DEG,
    dist: moon.dist, semi: Math.asin(MOON_R_KM / moon.dist) * DEG,
    colong: ((90 - sub.l) % 360 + 360) % 360,
    waxing: ((moon.lon - sunLon) % 360 + 360) % 360 < 180,
    q, alt, az, topo: q !== null,
  };
}

// Parameter proyeksi ortografik. th = rotasi layar total: P + phi (phi = rotasi tambahan
// terhadap "utara di atas", derajat, berlawanan jarum jam).
function moonAtlasView(g, phiDeg) {
  const th = (g.P + (phiDeg || 0)) * RAD;
  return { l: g.l * RAD, b: g.b * RAD, th, cl: Math.cos(g.l * RAD), sl: Math.sin(g.l * RAD),
    cb: Math.cos(g.b * RAD), sb: Math.sin(g.b * RAD), ct: Math.cos(th), st: Math.sin(th) };
}

// Vektor satuan kerangka Bulan (x ke bujur 90 T, y ke kutub utara, z ke bujur 0) -> layar
// satuan piringan {x, y (ke atas), z (>0 = menghadap pengamat)}.
function _maProjVec(bx, by, bz, v) {
  const X = bx * v.cl - bz * v.sl, Z = bx * v.sl + bz * v.cl;
  const Yp = by * v.cb - Z * v.sb, Zp = by * v.sb + Z * v.cb;
  return { x: X * v.ct - Yp * v.st, y: X * v.st + Yp * v.ct, z: Zp };
}
function _maVec(lat, lon) {
  const p = lat * RAD, q = lon * RAD;
  return [Math.cos(p) * Math.sin(q), Math.sin(p), Math.cos(p) * Math.cos(q)];
}
function moonAtlasProject(lat, lon, v) { const n = _maVec(lat, lon); return _maProjVec(n[0], n[1], n[2], v); }
function moonAtlasUnproject(x, y, v) {
  const r2 = x * x + y * y;
  if (r2 > 1) return null;
  const z = Math.sqrt(1 - r2);
  const X = x * v.ct + y * v.st, Yp = -x * v.st + y * v.ct;
  const Y = Yp * v.cb + z * v.sb, Z = -Yp * v.sb + z * v.cb;
  return { lat: Math.asin(Math.max(-1, Math.min(1, Y))) * DEG, lon: _maNorm180((v.l + Math.atan2(X, Z)) * DEG) };
}
// Tinggi Matahari (deg) dilihat dari titik (lat, lon) di permukaan Bulan.
function moonAtlasSunAlt(lat, lon, g) {
  const n = _maVec(lat, lon), s = _maVec(g.b0, g.l0);
  return Math.asin(Math.max(-1, Math.min(1, n[0] * s[0] + n[1] * s[1] + n[2] * s[2]))) * DEG;
}

// PRNG deterministik (hasil fit bisa diulang persis).
function _maRng(seed) { let x = seed >>> 0 || 1; return () => { x ^= x << 13; x ^= x >>> 17; x ^= x << 5; return (x >>> 0) / 4294967296; }; }

// Ambang Otsu dari array intensitas 0..255.
function moonAtlasOtsu(gray) {
  const h = new Float64Array(256);
  for (let i = 0; i < gray.length; i++) h[Math.max(0, Math.min(255, gray[i] | 0))]++;
  let sum = 0; for (let i = 0; i < 256; i++) sum += i * h[i];
  let wB = 0, sB = 0, best = 0, t = 128;
  for (let i = 0; i < 256; i++) {
    wB += h[i]; if (!wB) continue;
    const wF = gray.length - wB; if (!wF) break;
    sB += i * h[i];
    const d = sB / wB - (sum - sB) / wF, v = wB * wF * d * d;
    if (v > best) { best = v; t = i; }
  }
  return t + 0.5;
}

// Fit lingkaran robust: RANSAC (tiga titik -> lingkaran luar) lalu kuadrat terkecil (Kasa)
// pada inlier. pts = [[x,y],...]; tol = jarak inlier (px). Busur terpanjang menang, jadi
// terminator (elips) & tepi bingkai tidak menarik hasil. rMin/rMax (opsional) membatasi
// radius kandidat -- dipakai bila skala kamera sudah diketahui (piringan terpotong).
function moonAtlasCircleFit(pts, tol, iters, seed, rMin, rMax) {
  if (pts.length < 3) return null;
  const rnd = _maRng(seed || 12345);
  let best = null, bestN = 0;
  for (let it = 0; it < (iters || 500); it++) {
    const a = pts[(rnd() * pts.length) | 0], b = pts[(rnd() * pts.length) | 0], c = pts[(rnd() * pts.length) | 0];
    const d = 2 * (a[0] * (b[1] - c[1]) + b[0] * (c[1] - a[1]) + c[0] * (a[1] - b[1]));
    if (Math.abs(d) < 1e-9) continue;
    const a2 = a[0] * a[0] + a[1] * a[1], b2 = b[0] * b[0] + b[1] * b[1], c2 = c[0] * c[0] + c[1] * c[1];
    const ux = (a2 * (b[1] - c[1]) + b2 * (c[1] - a[1]) + c2 * (a[1] - b[1])) / d;
    const uy = (a2 * (c[0] - b[0]) + b2 * (a[0] - c[0]) + c2 * (b[0] - a[0])) / d;
    const r = Math.hypot(a[0] - ux, a[1] - uy);
    if (r < 5 || (rMin && r < rMin) || (rMax && r > rMax)) continue;
    let n = 0;
    for (let i = 0; i < pts.length; i++) if (Math.abs(Math.hypot(pts[i][0] - ux, pts[i][1] - uy) - r) < tol) n++;
    if (n > bestN) { bestN = n; best = [ux, uy, r]; }
  }
  if (!best) return null;
  for (let pass = 0; pass < 3; pass++) {
    // Kasa: x^2+y^2 + D x + E y + F = 0, kuadrat terkecil pada inlier
    let sx = 0, sy = 0, sxx = 0, syy = 0, sxy = 0, sz = 0, sxz = 0, syz = 0, n = 0;
    for (const [x, y] of pts) {
      if (Math.abs(Math.hypot(x - best[0], y - best[1]) - best[2]) >= tol) continue;
      const z = x * x + y * y;
      sx += x; sy += y; sxx += x * x; syy += y * y; sxy += x * y; sz += z; sxz += x * z; syz += y * z; n++;
    }
    if (n < 3) break;
    // [sxx sxy sx; sxy syy sy; sx sy n] [D E F]^T = -[sxz syz sz]^T
    const M = [[sxx, sxy, sx, -sxz], [sxy, syy, sy, -syz], [sx, sy, n, -sz]];
    for (let i = 0; i < 3; i++) {
      let p = i; for (let k = i + 1; k < 3; k++) if (Math.abs(M[k][i]) > Math.abs(M[p][i])) p = k;
      [M[i], M[p]] = [M[p], M[i]];
      if (Math.abs(M[i][i]) < 1e-12) return { cx: best[0], cy: best[1], r: best[2], inliers: bestN, n: pts.length };
      for (let k = 0; k < 3; k++) if (k !== i) { const f = M[k][i] / M[i][i]; for (let j = i; j < 4; j++) M[k][j] -= f * M[i][j]; }
    }
    const D = M[0][3] / M[0][0], E = M[1][3] / M[1][1], F = M[2][3] / M[2][2];
    const cx = -D / 2, cy = -E / 2;
    best = [cx, cy, Math.sqrt(Math.max(0, cx * cx + cy * cy - F))];
  }
  let n = 0;
  for (const [x, y] of pts) if (Math.abs(Math.hypot(x - best[0], y - best[1]) - best[2]) < tol) n++;
  return { cx: best[0], cy: best[1], r: best[2], inliers: n, n: pts.length };
}

// Korelasi polar. pred & photo: Float32Array NR*NA (cincin x sudut 1 derajat/NA), sudut
// diukur berlawanan jarum jam dari +x dengan y KE ATAS. Mencari phi (rotasi pred -> photo)
// dan cermin m (m=-1: x dibalik SETELAH rotasi) yang memaksimalkan korelasi ternormalisasi.
// Tiap cincin dikurangi rata-ratanya (kecerahan radial/limb darkening tidak ikut dicocokkan).
// prior {phi, m, win} (opsional): juga kembalikan puncak terbaik dalam +-win derajat dari
// orientasi yang sudah diketahui (field `prior`) -- dipakai bila puncak bebas meragukan.
function moonAtlasPolarCorr(pred, photo, NR, NA, prior) {
  const norm = a => {
    const o = new Float64Array(a.length);
    let ss = 0;
    for (let r = 0; r < NR; r++) {
      let m = 0; for (let j = 0; j < NA; j++) m += a[r * NA + j]; m /= NA;
      for (let j = 0; j < NA; j++) { const v = a[r * NA + j] - m; o[r * NA + j] = v; ss += v * v; }
    }
    return { o, n: Math.sqrt(ss) || 1 };
  };
  const P = norm(pred), Q = norm(photo);
  const scores = { 1: new Float64Array(NA), '-1': new Float64Array(NA) };
  for (const m of [1, -1]) {
    const sc = scores[m];
    for (let k = 0; k < NA; k++) {
      let s = 0;
      for (let r = 0; r < NR; r++) {
        const pr = r * NA;
        for (let j = 0; j < NA; j++) {
          // sudut foto = rotasi (j+k); cermin: pi - (j+k)
          const jj = m === 1 ? (j + k) % NA : ((NA / 2 - j - k) % NA + NA) % NA;
          s += P.o[pr + j] * Q.o[pr + jj];
        }
      }
      sc[k] = s / (P.n * Q.n);
    }
  }
  let best = { ncc: -2 };
  for (const m of [1, -1]) for (let k = 0; k < NA; k++) if (scores[m][k] > best.ncc) best = { ncc: scores[m][k], k, m };
  // puncak kedua: di luar +-10 derajat puncak utama (atau cermin lainnya)
  const win = Math.round(NA * 10 / 360);
  let second = -2;
  for (const m of [1, -1]) for (let k = 0; k < NA; k++) {
    const dk = Math.min(Math.abs(k - best.k), NA - Math.abs(k - best.k));
    if (m === best.m && dk <= win) continue;
    second = Math.max(second, scores[m][k]);
  }
  // Penghalusan parabola HANYA pada puncak lokal, geseran dibatasi +-0.5 bin (di tepi jendela
  // prior kurvanya bukan puncak -> tanpa batas ini hasil bisa melompat puluhan derajat).
  const refine = (m, k) => {
    const sc = scores[m], y0 = sc[(k - 1 + NA) % NA], y1 = sc[k], y2 = sc[(k + 1) % NA];
    const den = y0 - 2 * y1 + y2;
    const off = den < 0 && y1 >= y0 && y1 >= y2 ? Math.max(-0.5, Math.min(0.5, 0.5 * (y0 - y2) / den)) : 0;
    return _maNorm180((k + off) * 360 / NA);
  };
  const out = { phi: refine(best.m, best.k), m: best.m, ncc: best.ncc, second };
  if (prior && (prior.m === 1 || prior.m === -1)) {
    const k0 = Math.round(((prior.phi % 360) + 360) % 360 * NA / 360), w = Math.round((prior.win || 20) * NA / 360);
    let pk = null;
    for (let d = -w; d <= w; d++) {
      const k = ((k0 + d) % NA + NA) % NA;
      if (pk === null || scores[prior.m][k] > scores[prior.m][pk]) pk = k;
    }
    const sc = scores[prior.m];
    const isPeak = sc[pk] >= sc[(pk - 1 + NA) % NA] && sc[pk] >= sc[(pk + 1) % NA] && Math.abs(((pk - k0) % NA + NA + NA / 2) % NA - NA / 2) < w;
    out.prior = { phi: refine(prior.m, pk), m: prior.m, ncc: sc[pk], isPeak };
  }
  return out;
}
// --- AKHIR GEOMETRI ---

const MA_TYPE = {
  ME: 'Mare (laut)', LC: 'Lacus (danau)', SI: 'Sinus (teluk)', PA: 'Palus (rawa)', OC: 'Oceanus (samudra)',
  PL: 'Planitia (dataran)', AA: 'Kawah', SF: 'Kawah satelit (berhuruf)', MO: 'Mons/Montes (gunung)',
  RI: 'Rima (alur)', DO: 'Dorsum (punggungan)', RU: 'Rupes (tebing)', VA: 'Vallis (lembah)',
  CA: 'Catena (rantai kawah)', PR: 'Promontorium (tanjung)', AL: 'Fitur albedo', LS: 'Situs pendaratan',
};
// Terjemahan nama maria (untuk edukasi/jamaah). Sumber arti: kolom "origin" IAU.
const MA_ID = {
  'Oceanus Procellarum': 'Samudra Badai', 'Mare Frigoris': 'Laut Dingin', 'Mare Imbrium': 'Laut Hujan',
  'Mare Tranquillitatis': 'Laut Ketenangan', 'Mare Serenitatis': 'Laut Keheningan', 'Mare Crisium': 'Laut Krisis',
  'Mare Fecunditatis': 'Laut Kesuburan', 'Mare Nectaris': 'Laut Nektar', 'Mare Nubium': 'Laut Awan',
  'Mare Humorum': 'Laut Kelembapan', 'Mare Vaporum': 'Laut Uap', 'Mare Cognitum': 'Laut yang Dikenal',
  'Mare Insularum': 'Laut Pulau-pulau', 'Mare Spumans': 'Laut Berbuih', 'Mare Undarum': 'Laut Gelombang',
  'Mare Marginis': 'Laut Tepi', 'Mare Smythii': 'Laut Smyth', 'Mare Australe': 'Laut Selatan',
  'Mare Humboldtianum': 'Laut Humboldt', 'Mare Orientale': 'Laut Timur', 'Sinus Iridum': 'Teluk Pelangi',
  'Sinus Medii': 'Teluk Tengah', 'Sinus Aestuum': 'Teluk Mendidih', 'Sinus Roris': 'Teluk Embun',
  'Sinus Amoris': 'Teluk Cinta', 'Sinus Asperitatis': 'Teluk Kekasaran', 'Sinus Concordiae': 'Teluk Kerukunan',
  'Sinus Honoris': 'Teluk Kehormatan', 'Sinus Successus': 'Teluk Keberhasilan', 'Palus Putredinis': 'Rawa Pembusukan',
  'Palus Epidemiarum': 'Rawa Wabah', 'Palus Somni': 'Rawa Tidur', 'Lacus Somniorum': 'Danau Mimpi',
  'Lacus Mortis': 'Danau Kematian', 'Lacus Timoris': 'Danau Ketakutan', 'Lacus Felicitatis': 'Danau Kebahagiaan',
  'Lacus Odii': 'Danau Kebencian', 'Lacus Doloris': 'Danau Kesedihan', 'Lacus Gaudii': 'Danau Kegembiraan',
  'Lacus Lenitatis': 'Danau Kelembutan', 'Lacus Spei': 'Danau Harapan', 'Lacus Temporis': 'Danau Waktu',
  'Lacus Bonitatis': 'Danau Kebaikan', 'Lacus Veris': 'Danau Musim Semi', 'Lacus Autumni': 'Danau Musim Gugur',
  'Lacus Solitudinis': 'Danau Kesunyian', 'Lacus Aestatis': 'Danau Musim Panas', 'Lacus Excellentiae': 'Danau Keunggulan',
};
const MA_LAYERS = [
  ['m', 'Maria, danau, teluk'], ['c', 'Kawah'], ['l', 'Kawah berhuruf'],
  ['r', 'Gunung, alur, punggungan'], ['s', 'Situs pendaratan'],
];

const _ma = {
  built: false, loading: null, tex: null, names: null, timer: null, renderTimer: null,
  time: null,                       // null = live
  zoom: 1, panX: 0, panY: 0,         // pan = geser pusat piringan dari tengah kanvas (px CSS)
  orient: 'north',                  // 'north' | 'zenith' | 'camera' (orientasi hasil pencocokan foto)
  photo: null,                      // mode foto: {obs, img, pw, ph, time, loc, fit, metrics, blend, lines}
  night: 'dim', detail: 14, labelScale: 1, outlines: false, grid: false,
  layers: { m: true, c: true, l: true, r: true, s: true },
  geo: null, view: null, sel: null, placed: [], cache: null,
};
(function loadPrefs() {
  try {
    const p = JSON.parse(localStorage.getItem('ml_moonatlas') || '{}');
    for (const k of ['orient', 'night', 'detail', 'labelScale', 'outlines', 'grid']) if (k in p) _ma[k] = p[k];
    if (p.zenithUp) _ma.orient = 'zenith';          // preferensi versi 29 Sep pagi
    if (p.layers) Object.assign(_ma.layers, p.layers);
  } catch (e) { /* preferensi opsional */ }
})();
function _maSavePrefs() {
  try {
    localStorage.setItem('ml_moonatlas', JSON.stringify({ orient: _ma.orient, night: _ma.night, detail: _ma.detail,
      labelScale: _ma.labelScale, outlines: _ma.outlines, grid: _ma.grid, layers: _ma.layers }));
  } catch (e) { /* abaikan */ }
}

// --- Buka/tutup (dipanggil dari openHilalSection/closeDrawers di index.html) ---
function setMoonAtlas(show) {
  const el = document.getElementById('moonAtlasFull');
  if (!el) return;
  el.classList.toggle('show', show);
  if (_ma.timer) { clearInterval(_ma.timer); _ma.timer = null; }
  if (!show) {
    _ma.photo = null;
    const b = document.querySelector('#hilalMenu [data-hsec="atlas"]');
    if (b) b.classList.remove('sec-on');
    return;
  }
  _maBuildDom();
  _maSyncCamOrient();
  _maLoadAssets().then(() => {
    document.getElementById('maLoading').style.display = 'none';
    _maUpdate();
  }).catch(err => {
    document.getElementById('maLoading').textContent = 'Gagal memuat data atlas: ' + err.message;
  });
  _ma.timer = setInterval(() => { if (_ma.time === null && _ma.tex && !_ma.photo) _maUpdate(); }, 60000);
}
function moonAtlasIsOpen() {
  const el = document.getElementById('moonAtlasFull');
  return !!el && el.classList.contains('show');
}

function _maLoadAssets() {
  if (_ma.loading) return _ma.loading;
  const img = new Promise((res, rej) => {
    const im = new Image();
    im.onload = () => {
      const c = document.createElement('canvas');
      c.width = im.naturalWidth; c.height = im.naturalHeight;
      const x = c.getContext('2d');
      x.drawImage(im, 0, 0);
      _ma.tex = { w: c.width, h: c.height, d: x.getImageData(0, 0, c.width, c.height).data };
      res();
    };
    im.onerror = () => rej(new Error('tekstur Bulan'));
    im.src = 'img/moon_nearside.jpg';
  });
  const names = window.MOON_ATLAS_NAMES ? Promise.resolve() : new Promise((res, rej) => {
    const s = document.createElement('script');
    s.src = 'moonatlas_names.js';
    s.onload = res;
    s.onerror = () => rej(new Error('daftar nama'));
    document.head.appendChild(s);
  });
  _ma.loading = Promise.all([img, names]).then(() => {
    _ma.names = window.MOON_ATLAS_NAMES.map(r => ({
      name: r[0], lat: r[1], lon: r[2], diam: r[3], cat: r[4], code: r[5], origin: r[6],
      id: MA_ID[r[0]] || '', key: _maFold(r[0] + ' ' + (MA_ID[r[0]] || '')),
    }));
  });
  _ma.loading.catch(() => { _ma.loading = null; });
  return _ma.loading;
}

function _maFold(s) { return s.normalize('NFD').replace(/[̀-ͯ]/g, '').toLowerCase(); }

// --- DOM ---
function _maBuildDom() {
  if (_ma.built) return;
  _ma.built = true;
  const css = document.createElement('style');
  css.textContent = `
#moonAtlasFull{padding:0;overflow:hidden;background:#000}
#maCanvas{position:absolute;inset:0;width:100%;height:100%;touch-action:none;cursor:grab;display:block}
#maCanvas.drag{cursor:grabbing}
.ma-float{position:absolute;z-index:3;background:var(--bg2);border:1px solid var(--border2);border-radius:10px;color:var(--txt);box-shadow:var(--shadow)}
.ma-search{top:12px;left:12px;width:min(300px,calc(100% - 24px));padding:6px 8px}
.ma-search input{width:100%;background:var(--bg3);border:1px solid var(--input-border);border-radius:7px;padding:7px 9px;color:var(--txt);font:inherit;font-size:.85rem}
.ma-results{margin-top:4px;max-height:260px;overflow-y:auto}
.ma-results button{display:block;width:100%;text-align:left;background:none;border:none;color:var(--txt);padding:6px 8px;border-radius:6px;font:inherit;font-size:.82rem;cursor:pointer}
.ma-results button:hover,.ma-results button.on{background:var(--bg3)}
.ma-results small{color:var(--txt2)}
.ma-time{left:12px;bottom:12px;padding:8px;display:flex;flex-wrap:wrap;gap:4px;align-items:center;max-width:calc(100% - 24px)}
.ma-time input{background:var(--bg3);border:1px solid var(--input-border);border-radius:7px;padding:4px 6px;color:var(--txt);font:inherit;font-size:.8rem}
.ma-time .btn{padding:4px 9px}
.ma-badge{font-size:.68rem;font-weight:700;color:var(--gold);padding:0 4px}
.ma-zoom{right:12px;bottom:12px;padding:4px;display:flex;gap:4px}
.ma-zoom .btn{padding:4px 10px}
.ma-panel{top:12px;right:12px;width:300px;max-height:calc(100% - 76px);overflow-y:auto;padding:12px;font-size:.8rem}
.ma-panel h4{font-size:.7rem;letter-spacing:.08em;text-transform:uppercase;color:var(--txt2);margin:12px 0 6px}
.ma-panel h4:first-child{margin-top:0}
.ma-row{display:flex;justify-content:space-between;gap:8px;padding:3px 0}
.ma-row span:first-child{color:var(--txt2)}
.ma-row span:last-child{text-align:right;font-variant-numeric:tabular-nums}
.ma-panel label.ma-chk{display:flex;align-items:center;gap:8px;padding:3px 0;cursor:pointer}
.ma-seg{display:flex;background:var(--bg3);border-radius:7px;padding:2px;gap:2px}
.ma-seg button{flex:1;background:none;border:none;color:var(--txt2);padding:5px 4px;border-radius:5px;font:inherit;font-size:.75rem;cursor:pointer}
.ma-seg button.on{background:var(--bg2);color:var(--txt)}
.ma-panel input[type=range]{width:100%}
.ma-panel select{width:100%;background:var(--bg3);border:1px solid var(--input-border);border-radius:7px;padding:5px;color:var(--txt);font:inherit;font-size:.8rem}
.ma-sel{border:1px solid var(--gold);border-radius:8px;padding:8px;margin-bottom:4px}
.ma-sel b{font-size:.95rem}
.ma-sel p{color:var(--txt2);margin:4px 0 0;line-height:1.35}
.ma-credit{color:var(--txt2);font-size:.68rem;line-height:1.35;margin-top:10px}
.ma-panel-btn{display:none;top:12px;right:12px;padding:6px 10px;cursor:pointer;font:inherit;font-size:.8rem}
.ma-photo .ma-btns{display:flex;flex-wrap:wrap;gap:4px;margin-top:8px}
.ma-photo .ma-btns .btn{padding:4px 8px;flex:1 1 auto}
.ma-photo .ma-nudge{display:flex;gap:3px;align-items:center;margin-top:6px;flex-wrap:wrap}
.ma-photo .ma-nudge button{padding:2px 7px}
.ma-ok{color:var(--grn)} .ma-warn{color:var(--gold)} .ma-bad{color:var(--red)}
.ma-loading{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;color:#aaa;z-index:2;font-size:.9rem}
@media (max-width:760px){
  .ma-panel{display:none;top:60px;left:12px;right:12px;width:auto;max-height:calc(100% - 130px)}
  #moonAtlasFull.ma-panel-open .ma-panel{display:block}
  .ma-panel-btn{display:block}
  .ma-zoom{bottom:auto;top:60px;flex-direction:column}
  .ma-search{width:calc(100% - 110px)}
}`;
  document.head.appendChild(css);
  const root = document.getElementById('moonAtlasFull');
  root.innerHTML = `
<canvas id="maCanvas" aria-label="Atlas Bulan"></canvas>
<div class="ma-loading" id="maLoading">Memuat atlas Bulan&hellip;</div>
<div class="ma-float ma-search">
  <input id="maSearch" type="search" placeholder="Cari fitur, mis. Tycho  ( / )" autocomplete="off">
  <div class="ma-results" id="maResults"></div>
</div>
<button type="button" class="ma-float ma-panel-btn" onclick="document.getElementById('moonAtlasFull').classList.toggle('ma-panel-open')">&#9776; Info</button>
<aside class="ma-float ma-panel" id="maPanel">
  <div id="maPhotoBox"></div>
  <div id="maSelBox"></div>
  <h4>Bulan saat ini</h4>
  <div id="maGeo"></div>
  <h4>Lapisan</h4>
  <div id="maLayers"></div>
  <label class="ma-chk"><input type="checkbox" id="maOutlines"> Garis tepi kawah</label>
  <label class="ma-chk"><input type="checkbox" id="maGrid"> Grid lintang/bujur</label>
  <h4>Tampilan</h4>
  <select id="maOrient" title="Orientasi piringan">
    <option value="north">Utara langit di atas (atlas)</option>
    <option value="zenith">Zenit di atas (Alt-Az, kamera tegak)</option>
    <option value="camera" id="maOrientCam">Seperti kamera MOONLIGHT (hasil cocok foto)</option>
  </select>
  <div style="margin:8px 0 4px;color:var(--txt2)">Sisi malam</div>
  <div class="ma-seg" id="maNight">
    <button type="button" data-v="hide">Sembunyikan</button><button type="button" data-v="dim">Redup</button><button type="button" data-v="show">Tampilkan</button>
  </div>
  <div class="ma-row" style="margin-top:8px"><span>Detail</span><span id="maDetailVal"></span></div>
  <input type="range" id="maDetail" min="6" max="80" step="2">
  <div class="ma-row"><span>Ukuran label</span><span id="maLabelVal"></span></div>
  <input type="range" id="maLabel" min="70" max="150" step="5">
  <div class="ma-credit">Tekstur: NASA/GSFC/Arizona State Univ. (LROC WAC, CGI Moon Kit). Nama: IAU/USGS Gazetteer of Planetary Nomenclature. Keduanya domain publik. Geometri: Meeus bab 48 &amp; 53, toposentris untuk lokasi observasi.</div>
</aside>
<div class="ma-float ma-time" id="maTimeBar">
  <input type="datetime-local" id="maTime" step="60" title="Waktu yang ditampilkan">
  <button type="button" class="btn btn-ghost text-sm" onclick="moonAtlasShift(-1440)" title="Mundur 1 hari">&minus;1h</button>
  <button type="button" class="btn btn-ghost text-sm" onclick="moonAtlasShift(-60)" title="Mundur 1 jam">&minus;1j</button>
  <button type="button" class="btn btn-ghost text-sm" onclick="moonAtlasShift(60)" title="Maju 1 jam">+1j</button>
  <button type="button" class="btn btn-ghost text-sm" onclick="moonAtlasShift(1440)" title="Maju 1 hari">+1h</button>
  <button type="button" class="btn btn-ghost text-sm" onclick="moonAtlasMaghrib()" title="Saat maghrib hari ini">&#127751; Maghrib</button>
  <button type="button" class="btn btn-primary text-sm" id="maNowBtn" onclick="moonAtlasNow()" title="Kembali ke waktu sekarang">&#9679; Sekarang</button>
  <span class="ma-badge" id="maBadge"></span>
</div>
<div class="ma-float ma-zoom">
  <button type="button" class="btn btn-ghost text-sm" onclick="moonAtlasZoom(1/1.5)" title="Perkecil">&minus;</button>
  <button type="button" class="btn btn-ghost text-sm" onclick="moonAtlasResetView()" title="Tampilkan seluruh piringan">1&times;</button>
  <button type="button" class="btn btn-ghost text-sm" onclick="moonAtlasZoom(1.5)" title="Perbesar">+</button>
</div>`;

  document.getElementById('maLayers').innerHTML = MA_LAYERS.map(([k, t]) =>
    `<label class="ma-chk"><input type="checkbox" data-layer="${k}"> ${t} <small style="margin-left:auto;color:var(--txt2)" data-count="${k}"></small></label>`).join('');
  root.querySelectorAll('[data-layer]').forEach(cb => {
    cb.checked = _ma.layers[cb.dataset.layer];
    cb.onchange = () => { _ma.layers[cb.dataset.layer] = cb.checked; _maSavePrefs(); _maDraw(); };
  });
  const bindChk = (id, key) => {
    const el = document.getElementById(id);
    el.checked = _ma[key];
    el.onchange = () => { _ma[key] = el.checked; _maSavePrefs(); _maDraw(); };
  };
  bindChk('maOutlines', 'outlines');
  bindChk('maGrid', 'grid');
  const orient = document.getElementById('maOrient');
  if (_ma.orient === 'camera' && !_maCamOrient()) _ma.orient = 'north';
  orient.value = _ma.orient;
  orient.onchange = () => { _ma.orient = orient.value; _maSavePrefs(); _maUpdate(); };
  document.querySelectorAll('#maNight button').forEach(b => {
    b.onclick = () => { _ma.night = b.dataset.v; _maSavePrefs(); _maSyncControls(); _ma.cache = null; _maDraw(); };
  });
  const det = document.getElementById('maDetail'), lab = document.getElementById('maLabel');
  det.value = _ma.detail; lab.value = Math.round(_ma.labelScale * 100);
  det.oninput = () => { _ma.detail = +det.value; _maSyncControls(); _maDraw(); };
  lab.oninput = () => { _ma.labelScale = lab.value / 100; _maSyncControls(); _maDraw(); };
  det.onchange = lab.onchange = _maSavePrefs;
  document.getElementById('maTime').onchange = e => {
    const t = e.target.value ? new Date(e.target.value) : null;
    if (t && !isNaN(t)) { _ma.time = t; _maUpdate(); }
  };
  _maBindSearch();
  _maBindPointer();
  window.addEventListener('resize', () => { if (moonAtlasIsOpen()) { _ma.cache = null; _maDraw(); } });
  document.addEventListener('keydown', e => {
    if (!moonAtlasIsOpen()) return;
    if (e.key === '/' && document.activeElement.tagName !== 'INPUT') { e.preventDefault(); document.getElementById('maSearch').focus(); }
    if (e.key === 'Escape' && _ma.sel) { _ma.sel = null; _maRenderSel(); _maDraw(); }
  });
  _maSyncControls();
}

function _maSyncControls() {
  document.querySelectorAll('#maNight button').forEach(b => b.classList.toggle('on', b.dataset.v === _ma.night));
  document.getElementById('maDetailVal').textContent = 'kawah ≥ ' + _ma.detail + ' px';
  document.getElementById('maLabelVal').textContent = Math.round(_ma.labelScale * 100) + ' %';
}

// --- Waktu ---
function _maNow() { return _ma.photo ? _ma.photo.time : (_ma.time || new Date()); }
function _maLoc() {
  if (_ma.photo && _ma.photo.loc) return _ma.photo.loc;
  return (typeof appLoc !== 'undefined' && appLoc && isFinite(appLoc.lat)) ? appLoc : null;
}

// Orientasi kamera tersimpan (hasil "Simpan orientasi kamera" di mode foto). TD-33: sumber utama = Pi
// (/camera/orientation, cam_orient.json + riwayat riset, sama di semua perangkat); localStorage hanya cadangan/offline.
function _maCamOrientLocal() {
  try { const c = JSON.parse(localStorage.getItem('ml_cam_orient') || 'null'); return c && isFinite(c.rotZ) ? c : null; }
  catch (e) { return null; }
}
function _maCamOrient() {
  return (_ma.camOrient && isFinite(_ma.camOrient.rotZ)) ? _ma.camOrient : _maCamOrientLocal();
}
function _maSetCamOrientCache(c) {
  _ma.camOrient = c;
  try { localStorage.setItem('ml_cam_orient', JSON.stringify(c)); } catch (e) { /* cadangan saja */ }
  const b = document.getElementById('maOrientCam'); if (b) b.disabled = false;
}
async function _maPostCamOrient(rec) {
  const r = await fetch('/camera/orientation', { method: 'POST', headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(rec), signal: AbortSignal.timeout(6000) });
  const d = await r.json();
  if (d.status !== 'ok') throw new Error(d.message || 'gagal');
  return d.current;
}
// Muat dari Pi saat atlas dibuka; orientasi lama yang cuma ada di browser ini dipindahkan (sekali) ke Pi.
async function _maSyncCamOrient() {
  try {
    const d = await (await fetch('/camera/orientation', { signal: AbortSignal.timeout(5000) })).json();
    if (d.current && isFinite(d.current.rotZ)) { _maSetCamOrientCache(d.current); return; }
    const lokal = _maCamOrientLocal();
    if (lokal) _maSetCamOrientCache(await _maPostCamOrient({ ...lokal, sumber: 'migrasi_localstorage' }));
  } catch (e) { /* Pi tak terjangkau: tetap pakai cadangan browser */ }
}
// Rotasi tambahan phi (deg) & cermin untuk tampilan saat ini.
function _maPhi(g) {
  if (_ma.photo) return _ma.photo.fit ? _ma.photo.fit.phi : 0;
  const q = g.q !== null ? g.q : 0;
  if (_ma.orient === 'zenith') return -q;
  if (_ma.orient === 'camera') { const c = _maCamOrient(); return c ? c.rotZ - q : 0; }
  return 0;
}
function _maMirror() {
  if (_ma.photo) return _ma.photo.fit ? _ma.photo.fit.m : 1;
  if (_ma.orient === 'camera') { const c = _maCamOrient(); return c ? c.m : 1; }
  return 1;
}
function _maRefreshView() {
  _ma.view = moonAtlasView(_ma.geo, _maPhi(_ma.geo));
  _ma.cache = null;
}
function moonAtlasShift(min) { _ma.time = new Date(_maNow().getTime() + min * 60000); _maUpdate(); }
function moonAtlasNow() { _ma.time = null; _maUpdate(); }
function moonAtlasMaghrib() {
  const loc = _maLoc();
  if (!loc || typeof maghribJD !== 'function') return;
  const jd = maghribJD(_maNow(), loc.lat, loc.lon);
  _ma.time = new Date((jd - 2440587.5) * 86400000);
  _maUpdate();
}
function _maToLocalInput(d) {
  const p = n => String(n).padStart(2, '0');
  return `${d.getFullYear()}-${p(d.getMonth() + 1)}-${p(d.getDate())}T${p(d.getHours())}:${p(d.getMinutes())}`;
}

// Hitung ulang geometri (waktu/orientasi berubah) lalu gambar.
function _maUpdate() {
  if (!_ma.tex || !_ma.names) return;
  const t = _maNow();
  _ma.geo = moonAtlasGeometry(t, _maLoc());
  _maRefreshView();
  const inp = document.getElementById('maTime');
  if (document.activeElement !== inp) inp.value = _maToLocalInput(t);
  document.getElementById('maBadge').textContent = _ma.time ? 'PRATINJAU' : 'LIVE';
  document.getElementById('maTimeBar').style.display = _ma.photo ? 'none' : '';
  document.getElementById('maOrient').disabled = !!_ma.photo;
  document.getElementById('maOrientCam').disabled = !_maCamOrient();
  _maRenderPhotoBox();
  document.getElementById('maNowBtn').style.display = _ma.time ? '' : 'none';
  _maRenderGeo();
  _maRenderSel();
  _maDraw();
}

function _maFmtLat(v) { return Math.abs(v).toFixed(2) + '° ' + (v >= 0 ? 'U' : 'S'); }
function _maFmtLon(v) { return Math.abs(v).toFixed(2) + '° ' + (v >= 0 ? 'T' : 'B'); }
function _maAgeDays(date, jd) {
  if (typeof newMoonNear !== 'function') return null;
  const y = date.getFullYear(), m = date.getMonth() + 1;
  let nm = newMoonNear(y, m);
  if (nm > jd) nm = newMoonNear(y, m - 1);
  if (jd - nm > 29.6) nm = newMoonNear(y, m + 1);
  return jd - nm;
}

function _maRenderGeo() {
  const g = _ma.geo, t = _maNow();
  const age = _maAgeDays(t, g.jd);
  const pa = typeof moonPhaseAngle === 'function' ? moonPhaseAngle(t) : null;
  const rows = [
    ['Waktu', t.toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })],
    ['Fase', (pa !== null && typeof phaseName === 'function' ? phaseName(pa) : (g.waxing ? 'Menuju purnama' : 'Menuju ijtimak'))],
    ['Iluminasi', (g.k * 100).toFixed(1) + ' %'],
    ['Umur sejak ijtimak', age !== null && age >= 0 ? age.toFixed(2) + ' hari' : '-'],
    ['Elongasi', g.elong.toFixed(2) + '°'],
    ['Diameter semu', (2 * g.semi * 60).toFixed(2) + '′'],
    ['Jarak', Math.round(g.dist).toLocaleString('id-ID') + ' km'],
    ['Librasi bujur', (g.l >= 0 ? '+' : '') + g.l.toFixed(2) + '°'],
    ['Librasi lintang', (g.b >= 0 ? '+' : '') + g.b.toFixed(2) + '°'],
    ['Sudut posisi sumbu (P)', g.P.toFixed(2) + '°'],
    ['Sudut tepi terang (χ)', g.chi.toFixed(1) + '°'],
    ['Kolongitudo Matahari', g.colong.toFixed(2) + '°'],
  ];
  if (g.topo) {
    rows.push(['Alt / Az Bulan', g.alt.toFixed(2) + '° / ' + g.az.toFixed(2) + '°']);
    rows.push(['Sudut paralaktik (q)', g.q.toFixed(1) + '°']);
  }
  document.getElementById('maGeo').innerHTML = rows.map(([k, v]) =>
    `<div class="ma-row"><span>${k}</span><span>${v}</span></div>`).join('') +
    `<div class="ma-credit" style="margin-top:4px">${g.topo ? 'Toposentris untuk ' + _maEsc(_maLoc().name || 'lokasi observasi') : 'Geosentris (lokasi belum diset)'}; librasi fisik (&lt;0,05&deg;) diabaikan.</div>`;
}

function _maEsc(s) { return String(s).replace(/[&<>"]/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c])); }

function _maRenderSel() {
  const box = document.getElementById('maSelBox');
  const f = _ma.sel;
  if (!f || !_ma.geo) { box.innerHTML = ''; return; }
  let html = '';
  if (f.point) {
    html = `<b>Titik di permukaan</b><div class="ma-row"><span>Lintang</span><span>${_maFmtLat(f.lat)}</span></div>
      <div class="ma-row"><span>Bujur</span><span>${_maFmtLon(f.lon)}</span></div>`;
  } else {
    html = `<b>${_maEsc(f.name)}</b>${f.id ? ` <span style="color:var(--txt2)">&middot; ${_maEsc(f.id)}</span>` : ''}
      <div class="ma-row"><span>Jenis</span><span>${MA_TYPE[f.code] || f.code}</span></div>
      ${f.diam ? `<div class="ma-row"><span>Diameter</span><span>${f.diam.toLocaleString('id-ID')} km</span></div>` : ''}
      <div class="ma-row"><span>Lintang</span><span>${_maFmtLat(f.lat)}</span></div>
      <div class="ma-row"><span>Bujur</span><span>${_maFmtLon(f.lon)}</span></div>`;
  }
  const sunAlt = moonAtlasSunAlt(f.lat, f.lon, _ma.geo);
  const p = moonAtlasProject(f.lat, f.lon, _ma.view);
  const cond = sunAlt > 3 ? 'Siang' : sunAlt > -1 ? 'Di terminator (bayangan panjang, kontras tinggi)' : 'Malam';
  html += `<div class="ma-row"><span>Matahari di sana</span><span>${sunAlt.toFixed(1)}&deg; &middot; ${cond}</span></div>`;
  if (p.z <= 0) html += `<p>Saat ini berada di balik tepi piringan (tidak tampak dari Bumi).</p>`;
  else if (p.z < 0.25) html += `<p>Dekat tepi piringan: tampak sangat pipih (terpengaruh librasi).</p>`;
  if (f.origin) html += `<p>Asal nama (IAU): ${_maEsc(f.origin)}</p>`;
  box.innerHTML = `<div class="ma-sel">${html}<button type="button" class="btn btn-ghost text-sm mt8" onclick="_ma.sel=null;_maRenderSel();_maDraw()">Tutup</button></div>`;
}

// --- Render ---
// Tata letak: pusat & radius piringan di layar (px CSS), mx = cermin (+1/-1).
// Mode foto: foto dipaskan ke kanvas lalu di-zoom/geser; piringan mengikuti fit di foto.
function _maLayout() {
  const c = document.getElementById('maCanvas');
  const w = c.clientWidth, h = c.clientHeight, mx = _maMirror();
  const ph = _ma.photo;
  if (ph) {
    const s = Math.min(w / ph.pw, h / ph.ph) * 0.96 * _ma.zoom;
    const ox = w / 2 + _ma.panX - s * ph.pw / 2, oy = h / 2 + _ma.panY - s * ph.ph / 2;
    const f = ph.fit || { cu: ph.pw / 2, cv: ph.ph / 2, R: Math.min(ph.pw, ph.ph) * 0.35 };
    return { c, w, h, mx, s, ox, oy, R: f.R * s, cx: ox + f.cu * s, cy: oy + f.cv * s };
  }
  const R = Math.min(w, h) * 0.44 * _ma.zoom;
  return { c, w, h, mx, R, cx: w / 2 + _ma.panX, cy: h / 2 + _ma.panY };
}

// Gambar tekstur Bulan per piksel ke kanvas offscreen (resolusi dibatasi ~2 jt piksel).
function _maRenderMoon(L) {
  const g = _ma.geo, v = _ma.view, tex = _ma.tex;
  const dpr = window.devicePixelRatio || 1;
  const rs = Math.min(dpr, Math.sqrt(2.0e6 / Math.max(1, L.w * L.h)));
  const W = Math.max(1, Math.round(L.w * rs)), H = Math.max(1, Math.round(L.h * rs));
  const off = document.createElement('canvas');
  off.width = W; off.height = H;
  const ctx = off.getContext('2d');
  const R = L.R * rs, cx = L.cx * rs, cy = L.cy * rs;
  const x0 = Math.max(0, Math.floor(cx - R)), x1 = Math.min(W, Math.ceil(cx + R));
  const y0 = Math.max(0, Math.floor(cy - R)), y1 = Math.min(H, Math.ceil(cy + R));
  if (x1 > x0 && y1 > y0) {
    const img = ctx.createImageData(x1 - x0, y1 - y0), out = img.data;
    const s = _maVec(g.b0, g.l0);
    // dot(normal_bulan, arah_matahari) langsung dari X,Y,Z kerangka-librasi (tanpa trig per piksel)
    const sA = s[0] * v.cl - s[2] * v.sl, sC = s[0] * v.sl + s[2] * v.cl, sB = s[1];
    const photo = !!_ma.photo;   // mode foto: sisi malam transparan (foto tetap terlihat)
    const night = photo ? 0 : _ma.night === 'show' ? 1 : _ma.night === 'dim' ? 0.16 : 0.035;
    const LM = window.MOON_ATLAS_LON_MAX || 100, td = tex.d, tw = tex.w, th = tex.h;
    const uS = tw / (2 * LM), vS = th / 180;
    let o = 0;
    for (let py = y0; py < y1; py++) {
      const sy = -(py + 0.5 - cy) / R;
      for (let px = x0; px < x1; px++, o += 4) {
        const sx = L.mx * (px + 0.5 - cx) / R;
        const r2 = sx * sx + sy * sy;
        if (r2 > 1) { out[o + 3] = 0; continue; }
        const z = Math.sqrt(1 - r2);
        const X = sx * v.ct + sy * v.st, Yp = -sx * v.st + sy * v.ct;
        const Y = Yp * v.cb + z * v.sb, Z = -Yp * v.sb + z * v.cb;
        let lon = (v.l + Math.atan2(X, Z)) * DEG;
        lon = lon > 180 ? lon - 360 : lon < -180 ? lon + 360 : lon;
        const lat = Math.asin(Y > 1 ? 1 : Y < -1 ? -1 : Y) * DEG;
        let r, gg, b;
        const fu = (lon + LM) * uS - 0.5, fv = (90 - lat) * vS - 0.5;
        if (fu < 0 || fu > tw - 1) { r = gg = b = 70; }   // di luar peta sisi dekat (jarang: librasi ekstrem)
        else {
          const iu = fu | 0, iv = Math.max(0, Math.min(th - 2, fv | 0)), du = fu - iu, dv = Math.max(0, Math.min(1, fv - iv));
          const iu1 = Math.min(tw - 1, iu + 1);
          const a = (iv * tw + iu) * 4, bq = (iv * tw + iu1) * 4, c = ((iv + 1) * tw + iu) * 4, d = ((iv + 1) * tw + iu1) * 4;
          const w00 = (1 - du) * (1 - dv), w10 = du * (1 - dv), w01 = (1 - du) * dv, w11 = du * dv;
          r = td[a] * w00 + td[bq] * w10 + td[c] * w01 + td[d] * w11;
          gg = td[a + 1] * w00 + td[bq + 1] * w10 + td[c + 1] * w01 + td[d + 1] * w11;
          b = td[a + 2] * w00 + td[bq + 2] * w10 + td[c + 2] * w01 + td[d + 2] * w11;
        }
        const dot = sA * X + sB * Y + sC * Z;
        const f = dot > 0.02 ? 1 : dot < -0.02 ? 0 : (dot + 0.02) / 0.04;
        const k = night + (1 - night) * f;
        if (photo) { out[o] = r; out[o + 1] = gg; out[o + 2] = b; out[o + 3] = 255 * k; }
        else { out[o] = r * k; out[o + 1] = gg * k; out[o + 2] = b * k; out[o + 3] = 255; }
      }
    }
    ctx.putImageData(img, x0, y0);
  }
  return { canvas: off, R: L.R, cx: L.cx, cy: L.cy, w: L.w, h: L.h, mx: L.mx };
}

function _maDraw() {
  if (!_ma.geo || !moonAtlasIsOpen()) return;
  const L = _maLayout();
  const dpr = window.devicePixelRatio || 1;
  const c = L.c;
  if (c.width !== Math.round(L.w * dpr) || c.height !== Math.round(L.h * dpr)) {
    c.width = Math.round(L.w * dpr); c.height = Math.round(L.h * dpr); _ma.cache = null;
  }
  const ctx = c.getContext('2d');
  ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  ctx.fillStyle = '#000';
  ctx.fillRect(0, 0, L.w, L.h);
  const k = _ma.cache;
  const same = k && k.R === L.R && k.cx === L.cx && k.cy === L.cy && k.w === L.w && k.h === L.h && k.mx === L.mx;
  if (!k) {
    _ma.cache = _maRenderMoon(L);
  } else if (!same) {
    // Sementara zoom/geser: skalakan gambar lama, render penuh setelah diam 150 ms.
    clearTimeout(_ma.renderTimer);
    _ma.renderTimer = setTimeout(() => { _ma.cache = null; _maDraw(); }, 150);
  }
  const m = _ma.cache, sc = L.R / m.R;
  ctx.imageSmoothingEnabled = true;
  const ph = _ma.photo;
  if (ph) {
    ctx.drawImage(ph.img, L.ox, L.oy, ph.pw * L.s, ph.ph * L.s);
    ctx.globalAlpha = ph.blend;
  }
  if (!ph || ph.blend > 0) ctx.drawImage(m.canvas, L.cx - m.cx * sc, L.cy - m.cy * sc, m.w * sc, m.h * sc);
  ctx.globalAlpha = 1;
  if (ph && ph.lines) _maDrawLimbTerminator(ctx, L);
  if (_ma.grid) _maDrawGrid(ctx, L);
  _maDrawLabels(ctx, L);
  _maDrawCompass(ctx, L);
}

function _maToScreen(p, L) { return { x: L.cx + L.mx * p.x * L.R, y: L.cy - p.y * L.R }; }

// Tepi piringan (lingkaran) + terminator prediksi (lingkaran besar tegak lurus arah Matahari).
function _maDrawLimbTerminator(ctx, L) {
  const g = _ma.geo, v = _ma.view, s = _maVec(g.b0, g.l0);
  let u = [s[2], 0, -s[0]];
  const un = Math.hypot(u[0], u[2]);
  u = un < 1e-6 ? [1, 0, 0] : [u[0] / un, 0, u[2] / un];
  const w = [s[1] * u[2] - s[2] * u[1], s[2] * u[0] - s[0] * u[2], s[0] * u[1] - s[1] * u[0]];
  ctx.save();
  ctx.strokeStyle = 'rgba(255,201,77,.9)'; ctx.lineWidth = 1.5; ctx.setLineDash([6, 4]);
  ctx.beginPath(); ctx.arc(L.cx, L.cy, L.R, 0, 2 * Math.PI); ctx.stroke();
  ctx.strokeStyle = 'rgba(120,220,255,.95)';
  ctx.beginPath();
  let pen = false;
  for (let i = 0; i <= 360; i += 2) {
    const t = i * RAD, c = Math.cos(t), sn = Math.sin(t);
    const p = _maProjVec(u[0] * c + w[0] * sn, u[1] * c + w[1] * sn, u[2] * c + w[2] * sn, v);
    if (p.z < 0) { pen = false; continue; }
    const q = _maToScreen(p, L);
    if (pen) ctx.lineTo(q.x, q.y); else { ctx.moveTo(q.x, q.y); pen = true; }
  }
  ctx.stroke();
  ctx.restore();
}

function _maDrawGrid(ctx, L) {
  const v = _ma.view;
  ctx.save();
  ctx.strokeStyle = 'rgba(120,170,255,.35)';
  ctx.lineWidth = 1;
  const line = pts => {
    ctx.beginPath();
    let pen = false;
    for (const [la, lo] of pts) {
      const p = moonAtlasProject(la, lo, v);
      if (p.z < 0) { pen = false; continue; }
      const s = _maToScreen(p, L);
      if (pen) ctx.lineTo(s.x, s.y); else { ctx.moveTo(s.x, s.y); pen = true; }
    }
    ctx.stroke();
  };
  for (let la = -75; la <= 75; la += 15) { const pts = []; for (let lo = -180; lo <= 180; lo += 2) pts.push([la, lo]); line(pts); }
  for (let lo = -180; lo < 180; lo += 15) { const pts = []; for (let la = -90; la <= 90; la += 2) pts.push([la, lo]); line(pts); }
  ctx.restore();
}

// Arah mata angin di tepi piringan: U/T/S/B langit (T = timur, di kiri saat utara di atas).
function _maDrawCompass(ctx, L) {
  const rot = _maPhi(_ma.geo) * RAD;
  const rr = Math.min(L.R + 16, Math.hypot(L.w, L.h));
  ctx.save();
  ctx.font = '600 11px system-ui, sans-serif';
  ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
  ctx.fillStyle = 'rgba(200,200,210,.75)';
  for (const [t, pa] of [['U', 0], ['T', 90], ['S', 180], ['B', 270]]) {
    const a = pa * RAD;
    const x = -Math.sin(a), y = Math.cos(a);
    const xs = x * Math.cos(rot) - y * Math.sin(rot), ys = x * Math.sin(rot) + y * Math.cos(rot);
    const px = L.cx + L.mx * xs * rr, py = L.cy - ys * rr;
    if (px > 8 && px < L.w - 8 && py > 8 && py < L.h - 8) ctx.fillText(t, px, py);
  }
  if (_ma.geo.q !== null && (_ma.photo || _ma.orient !== 'north')) {
    // arah zenit: PA = q dari utara ke timur
    const a = _ma.geo.q * RAD, x = -Math.sin(a), y = Math.cos(a);
    const xs = x * Math.cos(rot) - y * Math.sin(rot), ys = x * Math.sin(rot) + y * Math.cos(rot);
    const px = L.cx + L.mx * xs * (rr + 16), py = L.cy - ys * (rr + 16);
    if (px > 20 && px < L.w - 20 && py > 8 && py < L.h - 8) { ctx.fillStyle = 'rgba(255,210,122,.9)'; ctx.fillText('zenit', px, py); }
  }
  ctx.restore();
}

function _maDrawLabels(ctx, L) {
  const v = _ma.view, g = _ma.geo, sc = _ma.labelScale;
  const s = _maVec(g.b0, g.l0);
  const placed = [], boxes = [];
  const counts = { m: 0, c: 0, l: 0, r: 0, s: 0 };
  const hit = b => boxes.some(o => b.x < o.x + o.w && b.x + b.w > o.x && b.y < o.y + o.h && b.y + b.h > o.y);
  const onScreen = p => p.x > -50 && p.x < L.w + 50 && p.y > -20 && p.y < L.h + 20;
  // maria dulu (selalu diprioritaskan), lalu yang lain urut diameter (sudah diurut di data)
  const order = _ma.names.filter(f => f.cat === 'm').concat(_ma.names.filter(f => f.cat !== 'm'));
  const sel = _ma.sel && !_ma.sel.point ? _ma.sel : null;
  for (const f of order) {
    if (!_ma.layers[f.cat] && f !== sel) continue;
    const n = _maVec(f.lat, f.lon);
    const p = _maProjVec(n[0], n[1], n[2], v);
    if (p.z <= 0.03) continue;
    const scr = _maToScreen(p, L);
    if (!onScreen(scr)) continue;
    const sizePx = f.diam / MOON_R_KM * L.R * Math.sqrt(p.z);
    const lit = n[0] * s[0] + n[1] * s[1] + n[2] * s[2] > 0;
    if (!lit && _ma.night === 'hide' && f !== sel) continue;
    let minPx = _ma.detail;
    if (f.cat === 'm') minPx = Math.min(30, _ma.detail);
    else if (f.cat === 'l') minPx = _ma.detail * 1.6;
    else if (f.cat === 'r') minPx = _ma.detail * 1.4;   // alur/punggungan panjang tapi sempit: jangan kalahkan kawah
    else if (f.cat === 's') minPx = -1;
    if (sizePx < minPx && f !== sel) continue;
    counts[f.cat]++;
    let font, color, text = f.name, ls = 0;
    if (f.cat === 'm') {
      const px = Math.max(10, Math.min(18, 8 + sizePx / 40)) * sc;
      font = `500 ${px}px system-ui, sans-serif`; color = 'rgba(205,215,235,.82)'; text = f.name.toUpperCase(); ls = 0.18 * px;
    } else if (f.cat === 'c') {
      const px = Math.max(10.5, Math.min(15, 9 + sizePx / 30)) * sc;
      font = `600 ${px}px system-ui, sans-serif`; color = '#fff';
    } else if (f.cat === 'l') {
      font = `500 ${9.5 * sc}px system-ui, sans-serif`; color = 'rgba(220,220,225,.8)';
    } else if (f.cat === 'r') {
      font = `italic 500 ${10.5 * sc}px system-ui, sans-serif`; color = 'rgba(235,230,215,.9)';
    } else {
      font = `500 ${10 * sc}px system-ui, sans-serif`; color = '#ffd27a';
    }
    ctx.font = font;
    if ('letterSpacing' in ctx) ctx.letterSpacing = ls + 'px';
    const tw = ctx.measureText(text).width;
    const fh = parseFloat(font.match(/([\d.]+)px/)[1]);
    const isPoint = f.cat === 's';
    const box = isPoint ? { x: scr.x + 6, y: scr.y - fh / 2, w: tw, h: fh } : { x: scr.x - tw / 2, y: scr.y - fh / 2, w: tw, h: fh };
    if (hit(box) && f !== sel) continue;
    boxes.push(box);
    ctx.globalAlpha = !lit && _ma.night === 'dim' ? 0.45 : 1;
    if (_ma.outlines && (f.cat === 'c' || f.cat === 'l')) _maDrawOutline(ctx, L, f, v);
    if (isPoint) {
      ctx.strokeStyle = color; ctx.lineWidth = 1.2;
      ctx.beginPath(); ctx.arc(scr.x, scr.y, 3, 0, 2 * Math.PI); ctx.stroke();
    }
    ctx.textAlign = 'left'; ctx.textBaseline = 'middle';
    ctx.lineWidth = 3; ctx.strokeStyle = 'rgba(0,0,0,.65)'; ctx.lineJoin = 'round';
    ctx.strokeText(text, box.x, scr.y);
    ctx.fillStyle = color;
    ctx.fillText(text, box.x, scr.y);
    placed.push({ f, box, x: scr.x, y: scr.y });
  }
  if ('letterSpacing' in ctx) ctx.letterSpacing = '0px';
  ctx.globalAlpha = 1;
  if (_ma.sel) {
    const p = moonAtlasProject(_ma.sel.lat, _ma.sel.lon, v);
    if (p.z > 0) {
      const scr = _maToScreen(p, L);
      const rad = _ma.sel.point ? 8 : Math.max(8, (_ma.sel.diam || 0) / 2 / MOON_R_KM * L.R);
      ctx.strokeStyle = '#ffc94d'; ctx.lineWidth = 2;
      ctx.beginPath(); ctx.arc(scr.x, scr.y, rad, 0, 2 * Math.PI); ctx.stroke();
    }
  }
  _ma.placed = placed;
  for (const k in counts) { const el = document.querySelector(`[data-count="${k}"]`); if (el) el.textContent = counts[k]; }
}

// Tepi kawah = lingkaran kecil di bola, diproyeksikan (jadi elips dekat tepi piringan).
function _maDrawOutline(ctx, L, f, v) {
  const c = _maVec(f.lat, f.lon), la = f.lat * RAD, lo = f.lon * RAD;
  const e = [Math.cos(lo), 0, -Math.sin(lo)], nn = [-Math.sin(la) * Math.sin(lo), Math.cos(la), -Math.sin(la) * Math.cos(lo)];
  const rho = f.diam / 2 / MOON_R_KM, cr = Math.cos(rho), sr = Math.sin(rho);
  ctx.save();
  ctx.strokeStyle = 'rgba(255,255,255,.4)'; ctx.lineWidth = 1;
  ctx.beginPath();
  for (let i = 0; i <= 36; i++) {
    const t = i / 36 * 2 * Math.PI, ct = Math.cos(t), st = Math.sin(t);
    const p = _maProjVec(c[0] * cr + (e[0] * ct + nn[0] * st) * sr, c[1] * cr + (e[1] * ct + nn[1] * st) * sr,
      c[2] * cr + (e[2] * ct + nn[2] * st) * sr, v);
    const s = _maToScreen(p, L);
    if (i) ctx.lineTo(s.x, s.y); else ctx.moveTo(s.x, s.y);
  }
  ctx.stroke();
  ctx.restore();
}

// --- Interaksi ---
function moonAtlasZoom(f, mx, my) {
  const L = _maLayout();
  const z1 = Math.max(1, Math.min(20, _ma.zoom * f));
  const r = z1 / _ma.zoom;
  if (mx === undefined) { mx = L.w / 2; my = L.h / 2; }
  // titik di bawah kursor tetap di tempat. Posisi layar = w/2 + pan + zoom*K di mode atlas
  // MAUPUN foto, jadi cukup skalakan jarak kursor ke (tengah kanvas + pan).
  _ma.panX = mx - L.w / 2 - (mx - L.w / 2 - _ma.panX) * r;
  _ma.panY = my - L.h / 2 - (my - L.h / 2 - _ma.panY) * r;
  _ma.zoom = z1;
  if (z1 === 1) { _ma.panX = 0; _ma.panY = 0; }
  _maDraw();
}
function moonAtlasResetView() { _ma.zoom = 1; _ma.panX = 0; _ma.panY = 0; _maDraw(); }

function _maBindPointer() {
  const c = document.getElementById('maCanvas');
  const ptrs = new Map();
  let drag = null, pinch = null;
  c.addEventListener('wheel', e => {
    e.preventDefault();
    const r = c.getBoundingClientRect();
    moonAtlasZoom(Math.exp(-e.deltaY * 0.0015), e.clientX - r.left, e.clientY - r.top);
  }, { passive: false });
  c.addEventListener('pointerdown', e => {
    c.setPointerCapture(e.pointerId);
    ptrs.set(e.pointerId, { x: e.clientX, y: e.clientY });
    if (ptrs.size === 1) drag = { x: e.clientX, y: e.clientY, px: _ma.panX, py: _ma.panY, moved: false };
    if (ptrs.size === 2) {
      const [a, b] = [...ptrs.values()];
      pinch = { d: Math.hypot(a.x - b.x, a.y - b.y), z: _ma.zoom };
      drag = null;
    }
  });
  c.addEventListener('pointermove', e => {
    if (!ptrs.has(e.pointerId)) return;
    ptrs.set(e.pointerId, { x: e.clientX, y: e.clientY });
    if (pinch && ptrs.size === 2) {
      const [a, b] = [...ptrs.values()];
      const r = c.getBoundingClientRect();
      const f = pinch.z * Math.hypot(a.x - b.x, a.y - b.y) / pinch.d / _ma.zoom;
      moonAtlasZoom(f, (a.x + b.x) / 2 - r.left, (a.y + b.y) / 2 - r.top);
    } else if (drag) {
      const dx = e.clientX - drag.x, dy = e.clientY - drag.y;
      if (Math.abs(dx) + Math.abs(dy) > 4) { drag.moved = true; c.classList.add('drag'); }
      if (drag.moved) { _ma.panX = drag.px + dx; _ma.panY = drag.py + dy; _maDraw(); }
    }
  });
  const end = e => {
    if (drag && !drag.moved && ptrs.size === 1) {
      const r = c.getBoundingClientRect();
      _maPick(e.clientX - r.left, e.clientY - r.top);
    }
    ptrs.delete(e.pointerId);
    if (ptrs.size < 2) pinch = null;
    if (!ptrs.size) { drag = null; c.classList.remove('drag'); }
  };
  c.addEventListener('pointerup', end);
  c.addEventListener('pointercancel', end);
}

// Klik: label/titik terdekat (<= 12 px), kalau tidak ada -> koordinat titik permukaan.
function _maPick(x, y) {
  let best = null, bd = 12;
  for (const p of _ma.placed) {
    const inBox = x >= p.box.x - 3 && x <= p.box.x + p.box.w + 3 && y >= p.box.y - 3 && y <= p.box.y + p.box.h + 3;
    const d = inBox ? 0 : Math.hypot(x - p.x, y - p.y);
    if (d <= bd) { bd = d; best = p.f; }
  }
  if (!best) {
    const L = _maLayout();
    const u = moonAtlasUnproject(L.mx * (x - L.cx) / L.R, -(y - L.cy) / L.R, _ma.view);
    best = u ? { point: true, lat: u.lat, lon: u.lon } : null;
  }
  _ma.sel = best;
  if (best) document.getElementById('moonAtlasFull').classList.add('ma-panel-open');
  _maRenderSel();
  _maDraw();
}

function _maBindSearch() {
  const inp = document.getElementById('maSearch'), box = document.getElementById('maResults');
  let hits = [], idx = 0;
  const show = () => {
    box.innerHTML = hits.map((f, i) =>
      `<button type="button" data-i="${i}" class="${i === idx ? 'on' : ''}">${_maEsc(f.name)}${f.id ? ' <small>' + _maEsc(f.id) + '</small>' : ''}
       <small style="float:right">${_maEsc((MA_TYPE[f.code] || '').split(' (')[0])}</small></button>`).join('');
    box.querySelectorAll('button').forEach(b => { b.onclick = () => choose(hits[+b.dataset.i]); });
  };
  const choose = f => {
    if (!f) return;
    inp.value = f.name; hits = []; show(); inp.blur();
    moonAtlasFocus(f);
  };
  inp.oninput = () => {
    const q = _maFold(inp.value.trim());
    idx = 0;
    if (!q || !_ma.names) { hits = []; show(); return; }
    const pre = [], mid = [];
    for (const f of _ma.names) {
      const k = f.key.indexOf(q);
      if (k === 0) pre.push(f); else if (k > 0) mid.push(f);
      if (pre.length >= 10) break;
    }
    hits = pre.concat(mid).slice(0, 10);
    show();
  };
  inp.onkeydown = e => {
    if (e.key === 'ArrowDown') { idx = Math.min(hits.length - 1, idx + 1); show(); e.preventDefault(); }
    else if (e.key === 'ArrowUp') { idx = Math.max(0, idx - 1); show(); e.preventDefault(); }
    else if (e.key === 'Enter') choose(hits[idx]);
    else if (e.key === 'Escape') { hits = []; show(); inp.blur(); }
  };
}

// Pusatkan & perbesar ke fitur (diameter tampil ~140 px), tandai sebagai terpilih.
function moonAtlasFocus(f) {
  _ma.sel = f;
  if (_ma.geo) {
    _ma.zoom = 1; _ma.panX = 0; _ma.panY = 0;
    const R1 = _maLayout().R;
    const z = f.diam ? Math.max(1, Math.min(20, 140 / (f.diam / MOON_R_KM * R1))) : 6;
    const p = moonAtlasProject(f.lat, f.lon, _ma.view);
    if (z > 1.01 && p.z > 0) {
      _ma.zoom = z;
      const L = _maLayout(), q = _maToScreen(p, L);
      _ma.panX -= q.x - L.w / 2; _ma.panY -= q.y - L.h / 2;
    }
  }
  document.getElementById('moonAtlasFull').classList.add('ma-panel-open');
  _maRenderSel();
  _maDraw();
}

// ============================================================================
//  MODE FOTO (Fase 1): foto observasi + prediksi atlas
// ============================================================================

// Buka foto observasi `o` (baris dari GET /observations) di atlas.
async function moonAtlasOpenPhoto(o) {
  _maBuildDom();
  const load = document.getElementById('maLoading');
  load.style.display = ''; load.textContent = 'Memuat foto & atlas\u2026';
  try {
    await _maLoadAssets();
    const img = await new Promise((res, rej) => {
      const im = new Image();
      im.onload = () => res(im);
      im.onerror = () => rej(new Error('foto tidak bisa dimuat'));
      im.src = '/captures/' + encodeURIComponent(o.image);
    });
    if (!moonAtlasIsOpen()) return;          // atlas ditutup selagi foto dimuat
    // created_at = saat foto disimpan (UTC, detik) -- lebih presisi dari kolom time (menit, lokal)
    const t = o.created_at ? new Date(o.created_at.replace(' ', 'T') + 'Z') : new Date(o.time);
    const loc = isFinite(o.lat) && isFinite(o.lon) && o.lat !== null ? { lat: +o.lat, lon: +o.lon, name: o.loc || 'lokasi foto' } : null;
    _ma.photo = { obs: o, img, pw: img.naturalWidth, ph: img.naturalHeight, time: t, loc, fit: null, metrics: null,
      blend: 0, lines: true, status: 'Mencocokkan\u2026' };
    _ma.zoom = 1; _ma.panX = 0; _ma.panY = 0; _ma.sel = null;
    load.style.display = 'none';
    _maUpdate();
    setTimeout(() => { _maAutoFit(); _maAfterFit(); }, 30);
  } catch (e) {
    load.style.display = '';
    load.textContent = 'Gagal membuka foto: ' + e.message;
  }
}

function moonAtlasExitPhoto() {
  _ma.photo = null;
  _ma.zoom = 1; _ma.panX = 0; _ma.panY = 0; _ma.sel = null;
  _maUpdate();
}

function _maAfterFit() {
  _maRefreshView();
  _maRenderSel();
  _maRenderPhotoBox();
  _maDraw();
}

// Foto -> abu-abu (lebar maks maxW px) untuk analisis.
function _maGrayPhoto(ph, maxW) {
  const d = Math.min(1, maxW / ph.pw), gw = Math.round(ph.pw * d), gh = Math.round(ph.ph * d);
  const c = document.createElement('canvas');
  c.width = gw; c.height = gh;
  const x = c.getContext('2d');
  x.drawImage(ph.img, 0, 0, gw, gh);
  const px = x.getImageData(0, 0, gw, gh).data, g = new Float32Array(gw * gh);
  for (let i = 0, j = 0; i < g.length; i++, j += 4) g[i] = 0.299 * px[j] + 0.587 * px[j + 1] + 0.114 * px[j + 2];
  return { g, gw, gh, d };
}

// Luminans tekstur (0..255) di (lat, lon) selenografis, tetangga terdekat.
function _maTexLum(lat, lon) {
  const t = _ma.tex, LM = window.MOON_ATLAS_LON_MAX || 100;
  if (Math.abs(lon) > LM) return 70;
  const u = Math.min(t.w - 1, ((lon + LM) / (2 * LM) * t.w) | 0), v = Math.min(t.h - 1, ((90 - lat) / 180 * t.h) | 0);
  const i = (v * t.w + u) * 4;
  return 0.299 * t.d[i] + 0.587 * t.d[i + 1] + 0.114 * t.d[i + 2];
}

const MA_NR = 30, MA_NA = 360;

// Fit otomatis: lingkaran tepi -> pusat/radius, lalu korelasi polar -> rotasi & cermin.
function _maAutoFit() {
  const ph = _ma.photo;
  if (!ph) return;
  const G = _maGrayPhoto(ph, 1000), g = G.g, gw = G.gw, gh = G.gh;
  const t = moonAtlasOtsu(g);
  const pts = [];
  for (let y = 2; y < gh - 2; y++) for (let x = 2; x < gw - 2; x++) {
    const i = y * gw + x;
    if (g[i] > t && (g[i - 1] <= t || g[i + 1] <= t || g[i - gw] <= t || g[i + gw] <= t)) pts.push([x, y]);
  }
  const step = Math.max(1, Math.ceil(pts.length / 4000));
  const sub = step > 1 ? pts.filter((_, i) => i % step === 0) : pts;
  // Acuan dari orientasi kamera tersimpan: radius harapan (skala) & rotasi (rotZ - q)
  const cam = _maCamOrient();
  // skala (detik busur/px) berlaku utk lebar foto saat disimpan; resolusi lain -> diskalakan
  const rExp = cam && cam.arcsecPerPx > 0
    ? _ma.geo.semi * 3600 / cam.arcsecPerPx * (cam.pw ? ph.pw / cam.pw : 1) * G.d : null;
  const cFree = moonAtlasCircleFit(sub, 2.0, 700, 7);
  const cLim = rExp ? moonAtlasCircleFit(sub, 2.0, 700, 7, rExp * 0.95, rExp * 1.05) : null;
  // batas radius hanya membantu piringan terpotong; jangan dipakai bila jauh lebih sedikit titik tepi cocok
  const usedScale = !!(cLim && cLim.inliers >= 40 && (!cFree || cLim.inliers >= 0.8 * cFree.inliers));
  const c = usedScale ? cLim : cFree;
  if (!c || c.inliers < 40 || c.r < 15) {
    ph.fit = null; ph.metrics = null;
    ph.status = 'Tepi piringan tidak ditemukan (Bulan terlalu kecil/terpotong/tertutup awan?). Atur manual di bawah.';
    ph.fit = { cu: ph.pw / 2, cv: ph.ph / 2, R: Math.min(ph.pw, ph.ph) * 0.35, phi: 0, m: 1, auto: false };
    return;
  }
  // Sampel polar: foto (sudut dari +x, y ke atas) & prediksi (utara di atas, tanpa cermin)
  const photo = new Float32Array(MA_NR * MA_NA), pred = new Float32Array(MA_NR * MA_NA);
  const v0 = moonAtlasView(_ma.geo, 0), s = _maVec(_ma.geo.b0, _ma.geo.l0);
  for (let r = 0; r < MA_NR; r++) {
    const rr = 0.1 + 0.8 * r / (MA_NR - 1);
    for (let j = 0; j < MA_NA; j++) {
      const a = j * 2 * Math.PI / MA_NA, ca = Math.cos(a), sa = Math.sin(a);
      const X = c.cx + c.r * rr * ca, Y = c.cy - c.r * rr * sa;
      let val = t;
      if (X >= 0 && Y >= 0 && X < gw - 1 && Y < gh - 1) {
        const x0 = X | 0, y0 = Y | 0, fx = X - x0, fy = Y - y0, i = y0 * gw + x0;
        val = g[i] * (1 - fx) * (1 - fy) + g[i + 1] * fx * (1 - fy) + g[i + gw] * (1 - fx) * fy + g[i + gw + 1] * fx * fy;
      }
      photo[r * MA_NA + j] = val;
      const u = moonAtlasUnproject(rr * ca, rr * sa, v0);
      const n = _maVec(u.lat, u.lon), dot = n[0] * s[0] + n[1] * s[1] + n[2] * s[2];
      pred[r * MA_NA + j] = _maTexLum(u.lat, u.lon) * (dot > 0.02 ? 1 : dot < -0.02 ? 0 : (dot + 0.02) / 0.04);
    }
  }
  const prior = cam && _ma.geo.q !== null ? { phi: cam.rotZ - _ma.geo.q, m: cam.m, win: 20 } : null;
  const k = moonAtlasPolarCorr(pred, photo, MA_NR, MA_NA, prior);
  const confident = k.ncc > 0.35 && k.ncc - k.second > 0.05;
  const usePrior = !confident && k.prior && k.prior.isPeak && k.prior.ncc > 0.2;
  const sel = usePrior ? k.prior : k;
  ph.fit = { cu: c.cx / G.d, cv: c.cy / G.d, R: c.r / G.d, phi: sel.phi, m: sel.m, ncc: sel.ncc, second: k.second,
    inliers: c.inliers, edgeN: c.n, auto: true, usedPrior: !!usePrior, usedScale };
  // Metrik teramati: fraksi piringan yang terang & arah titik berat bagian terang
  let n = 0, lit = 0, sx = 0, sy = 0;
  const r2 = (c.r * 0.98) ** 2;
  for (let y = Math.max(0, Math.floor(c.cy - c.r)); y < Math.min(gh, Math.ceil(c.cy + c.r)); y++)
    for (let x = Math.max(0, Math.floor(c.cx - c.r)); x < Math.min(gw, Math.ceil(c.cx + c.r)); x++) {
      const dx = x - c.cx, dy = y - c.cy;
      if (dx * dx + dy * dy > r2) continue;
      n++;
      if (g[y * gw + x] > t) { lit++; sx += dx; sy += dy; }
    }
  ph.metrics = { litFrac: n ? lit / n : null, cdx: lit ? sx / lit / c.r : 0, cdy: lit ? sy / lit / c.r : 0,
    inside: n / (Math.PI * r2) };
  const below = _ma.geo.alt !== null && _ma.geo.alt < -1;
  ph.status = below ? `Bulan di BAWAH ufuk saat foto ini (${_ma.geo.alt.toFixed(0)}\u00b0) \u2014 kemungkinan bukan foto Bulan (mis. Matahari berfilter)`
    : confident ? 'Cocok otomatis'
    : usePrior ? 'Cocok dibantu orientasi kamera tersimpan (foto sendiri kurang jelas) \u2014 periksa visual'
      : 'Cocok otomatis, keyakinan RENDAH \u2014 periksa visual (geser "Campur prediksi")';
  if (usedScale) ph.status += ' \u00b7 radius dibatasi skala tersimpan';
}

// Arah titik berat bagian terang (vektor foto, satuan radius) -> sudut posisi di langit.
function _maObservedLimbPA() {
  const ph = _ma.photo, f = ph && ph.fit, m = ph && ph.metrics;
  if (!f || !m || Math.hypot(m.cdx, m.cdy) < 0.02) return null;
  const xm = f.m * m.cdx, ym = -m.cdy, a = -f.phi * RAD;             // buang cermin, lalu putar balik phi
  const x = xm * Math.cos(a) - ym * Math.sin(a), y = xm * Math.sin(a) + ym * Math.cos(a);
  return (Math.atan2(-x, y) * DEG + 360) % 360;
}

function _maPhotoResult() {
  const ph = _ma.photo, f = ph.fit, g = _ma.geo;
  if (!f) return null;
  const pa = _maObservedLimbPA();
  return {
    obs_id: ph.obs.id, image: ph.obs.image, time_utc: ph.time.toISOString(), loc: ph.loc,
    fit: { center_px: [+f.cu.toFixed(1), +f.cv.toFixed(1)], radius_px: +f.R.toFixed(1), auto: !!f.auto,
      rot_north_deg: +f.phi.toFixed(2), mirror: f.m === -1,
      rot_camera_vs_zenith_deg: g.q !== null ? +_maNorm180(f.phi + g.q).toFixed(2) : null,
      arcsec_per_px: +(g.semi * 3600 / f.R).toFixed(4),
      ncc: f.ncc != null ? +f.ncc.toFixed(3) : null, ncc_second: f.second != null ? +f.second.toFixed(3) : null,
      limb_inliers: f.inliers ?? null, limb_points: f.edgeN ?? null,
      used_saved_orientation: !!f.usedPrior, used_saved_scale: !!f.usedScale },
    predicted: { illum_frac: +g.k.toFixed(4), bright_limb_pa_deg: +g.chi.toFixed(2), P_deg: +g.P.toFixed(2),
      libration_l: +g.l.toFixed(3), libration_b: +g.b.toFixed(3), parallactic_q_deg: g.q !== null ? +g.q.toFixed(2) : null,
      alt_deg: g.alt !== null ? +g.alt.toFixed(3) : null, az_deg: g.az !== null ? +g.az.toFixed(3) : null,
      semi_diameter_arcmin: +(g.semi * 60).toFixed(3) },
    observed: ph.metrics ? { lit_frac_approx: ph.metrics.litFrac !== null ? +ph.metrics.litFrac.toFixed(4) : null,
      bright_limb_pa_deg: pa !== null ? +pa.toFixed(1) : null } : null,
  };
}

function _maRenderPhotoBox() {
  const box = document.getElementById('maPhotoBox');
  if (!box) return;
  const ph = _ma.photo;
  if (!ph) { box.innerHTML = ''; return; }
  const f = ph.fit, g = _ma.geo, res = f ? _maPhotoResult() : null;
  const row = (k, v) => `<div class="ma-row"><span>${k}</span><span>${v}</span></div>`;
  const cls = !f ? '' : /BAWAH/.test(ph.status) ? 'ma-bad' : !f.auto ? 'ma-warn' : /RENDAH|dibantu/.test(ph.status) ? 'ma-warn' : 'ma-ok';
  let h = `<b>Foto observasi #${_maEsc(ph.obs.id)}</b>
    <div style="color:var(--txt2)">${ph.time.toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'medium' })} &middot; ${ph.pw}&times;${ph.ph}</div>
    <div class="${cls}" style="margin:4px 0">${_maEsc(f && !f.auto && ph.status === 'Cocok otomatis' ? 'Disesuaikan manual' : ph.status)}</div>`;
  if (f && res) {
    const r = res.fit, o = res.observed;
    h += row('Pusat (px)', `${r.center_px[0]}, ${r.center_px[1]}`) + row('Radius', `${r.radius_px} px`) +
      row('Skala', `${r.arcsec_per_px.toFixed(3)}\u2033/px`) +
      row('Rotasi thd utara (\u03c6)', `${r.rot_north_deg.toFixed(1)}\u00b0`) +
      (r.rot_camera_vs_zenith_deg !== null ? row('Rotasi kamera thd zenit', `<b>${r.rot_camera_vs_zenith_deg.toFixed(1)}\u00b0</b>`) : '') +
      row('Cermin', r.mirror ? 'ya' : 'tidak') +
      (r.ncc !== null ? row('Korelasi (puncak 2)', `${r.ncc.toFixed(2)} (${r.ncc_second.toFixed(2)})`) : '') +
      (r.limb_inliers !== null ? row('Titik tepi cocok', `${r.limb_inliers}/${r.limb_points}`) : '');
    if (o) {
      h += row('Iluminasi prediksi / teramati', `${(g.k * 100).toFixed(1)}% / ${o.lit_frac_approx !== null ? (o.lit_frac_approx * 100).toFixed(1) + '%' : '-'}`);
      if (g.k < 0.97 && o.bright_limb_pa_deg !== null) {
        const d = _maNorm180(o.bright_limb_pa_deg - g.chi);
        h += row('Tepi terang prediksi / teramati', `${g.chi.toFixed(1)}\u00b0 / ${o.bright_limb_pa_deg.toFixed(1)}\u00b0 (${d >= 0 ? '+' : ''}${d.toFixed(1)}\u00b0)`);
      }
    }
  }
  h += `<div class="ma-row" style="margin-top:6px"><span>Campur prediksi</span><span id="maBlendVal">${Math.round(ph.blend * 100)}%</span></div>
    <input type="range" id="maBlend" min="0" max="100" step="5" value="${Math.round(ph.blend * 100)}">
    <label class="ma-chk"><input type="checkbox" id="maLines" ${ph.lines ? 'checked' : ''}> Garis tepi (kuning) &amp; terminator (biru)</label>`;
  if (f) {
    h += `<div class="ma-row" style="margin-top:4px"><span>Rotasi manual</span><span id="maRotVal">${f.phi.toFixed(1)}\u00b0</span></div>
      <input type="range" id="maRot" min="-180" max="180" step="0.1" value="${f.phi.toFixed(1)}">
      <label class="ma-chk"><input type="checkbox" id="maMirror" ${f.m === -1 ? 'checked' : ''}> Cermin (optik dgn diagonal/terbalik)</label>
      <div class="ma-nudge"><span style="color:var(--txt2)">Geser</span>
        <button type="button" class="btn btn-ghost text-sm" data-nd="-1,0">&#9664;</button><button type="button" class="btn btn-ghost text-sm" data-nd="1,0">&#9654;</button>
        <button type="button" class="btn btn-ghost text-sm" data-nd="0,-1">&#9650;</button><button type="button" class="btn btn-ghost text-sm" data-nd="0,1">&#9660;</button>
        <span style="color:var(--txt2);margin-left:6px">Radius</span>
        <button type="button" class="btn btn-ghost text-sm" data-nr="-1">&minus;</button><button type="button" class="btn btn-ghost text-sm" data-nr="1">+</button></div>`;
  }
  h += `<div class="ma-btns">
    <button type="button" class="btn btn-ghost text-sm" id="maRefit">&#8635; Cocokkan ulang</button>
    <button type="button" class="btn btn-ghost text-sm" id="maSaveCam" ${f && g.q !== null && !/BAWAH|RENDAH|tidak ditemukan/.test(ph.status) ? '' : 'disabled'} title="Dipakai atlas untuk orientasi 'Seperti kamera MOONLIGHT'. Nonaktif bila hasil tak layak (keyakinan rendah / bukan foto Bulan) -- sesuaikan manual dulu.">&#128190; Simpan orientasi kamera</button>
    <button type="button" class="btn btn-ghost text-sm" id="maCopy" ${f ? '' : 'disabled'}>&#128203; Salin hasil (JSON)</button>
    <button type="button" class="btn btn-primary text-sm" id="maExitPhoto">Keluar mode foto</button></div>`;
  box.innerHTML = `<div class="ma-sel ma-photo">${h}</div>`;

  const q = id => document.getElementById(id);
  q('maBlend').oninput = e => { ph.blend = e.target.value / 100; q('maBlendVal').textContent = e.target.value + '%'; _maDraw(); };
  q('maLines').onchange = e => { ph.lines = e.target.checked; _maDraw(); };
  q('maRefit').onclick = () => { ph.status = 'Mencocokkan\u2026'; _maRenderPhotoBox(); setTimeout(() => { _maAutoFit(); _maAfterFit(); }, 30); };
  q('maExitPhoto').onclick = moonAtlasExitPhoto;
  q('maCopy').onclick = () => {
    const txt = JSON.stringify(_maPhotoResult(), null, 2);
    const done = ok => { if (typeof toast === 'function') toast(ok ? 'Hasil pencocokan disalin' : 'Gagal menyalin', ok ? 'ok' : 'err'); };
    (navigator.clipboard ? navigator.clipboard.writeText(txt).then(() => done(true), () => done(false)) : done(false));
  };
  q('maSaveCam').onclick = async () => {
    const r = _maPhotoResult();
    const rec = { rotZ: r.fit.rot_camera_vs_zenith_deg, m: r.fit.mirror ? -1 : 1, arcsecPerPx: r.fit.arcsec_per_px, pw: ph.pw,
      obsId: r.obs_id, photoTime: r.time_utc, savedAt: new Date().toISOString(), sumber: 'atlas_mode_foto', hasil: r };
    const msg = 'Orientasi kamera disimpan (rotasi ' + r.fit.rot_camera_vs_zenith_deg.toFixed(1) + '\u00b0 thd zenit)';
    try {
      _maSetCamOrientCache(await _maPostCamOrient(rec));
      if (typeof toast === 'function') toast(msg + ' di Pi', 'ok');
    } catch (e) {
      const { hasil, ...ringkas } = rec;
      _maSetCamOrientCache(ringkas);   // Pi tak terjangkau: tetap berlaku di browser ini, dipindah ke Pi saat atlas dibuka lagi
      if (typeof toast === 'function') toast(msg + ' HANYA di browser ini (Pi tak terjangkau: ' + e.message + ')', 'err');
    }
  };
  if (!f) return;
  const manual = () => { f.auto = false; ph.status = 'Disesuaikan manual'; _maAfterFit(); };
  q('maRot').oninput = e => { f.phi = +e.target.value; q('maRotVal').textContent = f.phi.toFixed(1) + '\u00b0'; f.auto = false; ph.status = 'Disesuaikan manual'; _maRefreshView(); _maDraw(); };
  q('maRot').onchange = manual;
  q('maMirror').onchange = e => { f.m = e.target.checked ? -1 : 1; manual(); };
  box.querySelectorAll('[data-nd]').forEach(b => {
    b.onclick = () => { const [dx, dy] = b.dataset.nd.split(',').map(Number), st = Math.max(1, f.R * 0.004); f.cu += dx * st; f.cv += dy * st; manual(); };
  });
  box.querySelectorAll('[data-nr]').forEach(b => { b.onclick = () => { f.R *= 1 + 0.003 * Number(b.dataset.nr); manual(); }; });
}
