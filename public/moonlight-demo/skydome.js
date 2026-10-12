/* Peta Langit -- kubah langit 2D (proyeksi azimuthal sederhana) menampilkan
 * Matahari, Bulan, bintang terang, dan dua vektor posisi mount (software vs
 * terverifikasi IMU). Dimuat sebagai file terpisah (bukan inline seperti
 * sisa index.html) karena katalog bintang + kode render menambah beban
 * berarti ke file utama yang sudah >3000 baris -- satu-satunya pengecualian
 * dari konvensi "semua inline" di dashboard ini, sengaja dijaga tetap
 * vanilla JS tanpa library (dimuat via <script src>, sebelum blok <script>
 * utama supaya fungsi di sini sudah terdefinisi saat dipanggil dari init()).
 *
 * Reuse math astronomi yang SUDAH ADA di blok <script> utama (jde, moonPos,
 * sunPos, eclToEq, altAz, moonAltAzNow, sunAltAzNow, calcHilal, refraction,
 * RAD/DEG) -- TIDAK menulis ulang, cuma mengonsumsi. Fungsi-fungsi itu
 * didefinisikan di <script> utama yang dimuat SETELAH file ini, tapi karena
 * body function di bawah baru dieksekusi saat benar-benar dipanggil (bukan
 * saat didefinisikan), urutan ini aman -- global itu sudah ada di saat
 * renderSkyDome() sungguhan jalan.
 */

// Daftar objek yang tergambar di render TERAKHIR (posisi layar + alt/az),
// diisi ulang tiap renderSkyDome() -- dipakai hit-test klik untuk pilih
// objek (lihat _skyDomeOnClick di bawah).
let _skyDomeObjects = [];
let _skyDomeSelected = null;

// Preview waktu -- null = live (ikut jam sekarang, auto-update tiap render).
// Kalau diisi (lewat skyDomeShiftPreview()/skyDomeSetPreviewMaghrib()),
// kubah membeku menampilkan posisi pada waktu itu, BUKAN waktu sungguhan --
// dipakai buat rencanakan sesi rukyat (mis. cek posisi Bulan saat maghrib
// nanti tanpa harus menunggu). Goto tetap boleh jalan saat preview -- itu
// artinya "goto ke posisi objek pada waktu yang di-preview", valid dan
// berguna (pre-aim mount sebelum maghrib sungguhan tiba), BUKAN bug.
let _skyDomePreviewTime = null;

// Zoom -- kelipatan radius proyeksi, 1 = tampilan normal (horizon pas di
// tepi kanvas), makin besar makin dekat ke zenith yang diperbesar (horizon
// "keluar" kanvas, wajar). Zoom berpusat di zenith (tengah) SECARA DEFAULT,
// tapi begitu di-zoom operator boleh geser pusat pandang (pan) lewat
// drag/swipe -- lihat _skyDomePanX/_skyDomePanY & pointer handler di bawah.
let _skyDomeZoom = (() => { try { const z = parseFloat(localStorage.getItem('ml_sky_zoom')); return z >= 1 && z <= 4 ? z : 1; } catch (e) { return 1; } })();
const SKY_DOME_ZOOM_MIN = 1, SKY_DOME_ZOOM_MAX = 4, SKY_DOME_ZOOM_STEP = 0.5;

// Pan (geser pusat pandang) -- offset piksel dari tengah kanvas, cuma
// relevan saat _skyDomeZoom > 1 (di zoom 1 seluruh horizon sudah pas di
// kanvas, geser tidak ada gunanya). Di-clamp di _skyDomeClampPan() memakai
// _skyDomeLastBaseR (radius proyeksi SEBELUM dikalikan zoom, diisi tiap
// renderSkyDome()) supaya operator tidak bisa menggeser zenith sampai
// hilang jauh dari kanvas.
let _skyDomePanX = 0, _skyDomePanY = 0;
let _skyDomeLastBaseR = 100;

function _skyDomeClampPan() {
  const maxPan = _skyDomeLastBaseR * Math.max(0, _skyDomeZoom - 1);
  _skyDomePanX = Math.max(-maxPan, Math.min(maxPan, _skyDomePanX));
  _skyDomePanY = Math.max(-maxPan, Math.min(maxPan, _skyDomePanY));
}

function _skySavePrefs() { try { localStorage.setItem('ml_sky_zoom', String(_skyDomeZoom)); } catch (e) { /* abaikan */ } }

function skyDomeZoomIn() {
  _skyDomeZoom = Math.min(SKY_DOME_ZOOM_MAX, _skyDomeZoom + SKY_DOME_ZOOM_STEP);
  _skyDomeClampPan();
  _skySavePrefs();
  renderSkyDome();
}

function skyDomeZoomOut() {
  _skyDomeZoom = Math.max(SKY_DOME_ZOOM_MIN, _skyDomeZoom - SKY_DOME_ZOOM_STEP);
  _skyDomeClampPan();
  _skySavePrefs();
  renderSkyDome();
}

function skyDomeZoomReset() {
  _skyDomeZoom = 1;
  _skyDomePanX = 0; _skyDomePanY = 0;
  _skySavePrefs();
  renderSkyDome();
}

// Garis rasi bintang -- HANYA pakai pasangan bintang yang SUDAH ada di
// SKY_STAR_CATALOG (tidak menambah data bintang baru) supaya bentuknya
// kadang tidak 100% lengkap secara astronomis (mis. Orion tanpa Mintaka),
// tapi cukup buat bantu orang awam kenali pola familiar sekilas.
//
// Dikelompokkan per rasi (bukan cuma daftar pasangan datar) -- tiap rasi
// dapat warna sendiri + nama dilabel di tengah bintang-bintangnya, supaya
// yang sedang belajar langsung tahu "oh ini pola yang mana", bukan cuma
// lihat garis putih polos tak bernama.
const SKY_CONSTELLATIONS = [
  { name: 'Orion', color: '#7ec8ff', lines: [
    ['Betelgeuse', 'Bellatrix'], ['Bellatrix', 'Alnilam'], ['Alnilam', 'Alnitak'],
    ['Betelgeuse', 'Alnitak'], ['Alnilam', 'Rigel'], ['Rigel', 'Saiph'], ['Saiph', 'Alnitak'],
  ] },
  { name: 'Salib Selatan', color: '#ff6b6b', lines: [
    ['Acrux', 'Gacrux'], ['Acrux', 'Mimosa'],
  ] },
  { name: 'Scorpius', color: '#ff9f5b', lines: [
    ['Antares', 'Shaula'], ['Shaula', 'Sargas'],
  ] },
  { name: 'Gemini', color: '#c9a0ff', lines: [
    ['Castor', 'Pollux'],
  ] },
  { name: 'Centaurus', color: '#5bd9c0', lines: [
    ['Rigil Kentaurus', 'Hadar'],
  ] },
  { name: 'Canis Major', color: '#ffe066', lines: [
    ['Sirius', 'Mirzam'], ['Sirius', 'Adhara'], ['Adhara', 'Wezen'],
  ] },
  { name: 'Ursa Major', color: '#8ecae6', lines: [
    ['Dubhe', 'Alioth'], ['Alioth', 'Alkaid'],
  ] },
  { name: 'Leo', color: '#ffb703', lines: [
    ['Regulus', 'Algieba'], ['Algieba', 'Zosma'], ['Zosma', 'Chertan'],
    ['Chertan', 'Regulus'], ['Zosma', 'Denebola'],
  ] },
  { name: 'Taurus', color: '#e07a5f', lines: [
    ['Aldebaran', 'Elnath'],
  ] },
  { name: 'Cassiopeia', color: '#c77dff', lines: [
    ['Caph', 'Schedar'], ['Schedar', 'Gamma Cassiopeiae'], ['Gamma Cassiopeiae', 'Ruchbah'], ['Ruchbah', 'Segin'],
  ] },
  { name: 'Ursa Minor', color: '#90e0ef', lines: [
    ['Polaris', 'Kochab'], ['Kochab', 'Pherkad'],
  ] },
  { name: 'Cygnus', color: '#ffafcc', lines: [
    ['Deneb', 'Sadr'], ['Sadr', 'Albireo'], ['Delta Cygni', 'Sadr'], ['Sadr', 'Gienah Cygni'],
  ] },
  { name: 'Aquila', color: '#bde0fe', lines: [
    ['Tarazed', 'Altair'], ['Altair', 'Alshain'],
  ] },
];

// Warna kelas spektral (astronomi sungguhan) -- bintang panas (O/B) putih
// kebiruan, sedang (A/F) putih, mirip Matahari (G) kuning, sejuk (K)
// oranye, paling sejuk (M) merah. Dipetakan per bintang di kolom ke-5
// katalog (klasifikasi umum, best-effort dari referensi astronomi umum --
// akurasi cukup untuk edukasi visual, bukan katalog riset).
const SKY_SPECTRAL_COLOR = {
  B: '#aac4ff',  // biru-putih (panas): Rigel, Spica, Regulus, dll
  W: '#ffffff',  // putih (A/F, paling umum)
  Y: '#fff2b0',  // kuning (G, mirip Matahari)
  O: '#ffc879',  // oranye (K)
  R: '#ff7a54',  // merah (M, paling sejuk)
};

// Katalog ~55 bintang terang (mirip daftar bintang navigasi) -- RA/Dec J2000
// derajat, magnitudo visual. Dikoreksi presesi ke tanggal lewat skyPrecess() (J2000 ->
// 2026 = 0.2-0.4 deg, cukup utk bintang keluar dari FOV saat GoTo). Proper motion
// diabaikan (< 0.01 deg utk bintang di daftar ini kecuali Rigil Kentaurus ~0.1 deg).
const SKY_STAR_CATALOG = [
  ["Sirius", 101.287, -16.716, -1.46, 'B'], ["Canopus", 95.988, -52.696, -0.74, 'W'],
  ["Rigil Kentaurus", 219.902, -60.834, -0.27, 'Y'], ["Arcturus", 213.915, 19.182, -0.05, 'O'],
  ["Vega", 279.234, 38.784, 0.03, 'B'], ["Capella", 79.172, 45.998, 0.08, 'Y'],
  ["Rigel", 78.634, -8.202, 0.13, 'B'], ["Procyon", 114.825, 5.225, 0.34, 'W'],
  ["Achernar", 24.428, -57.237, 0.46, 'B'], ["Betelgeuse", 88.793, 7.407, 0.50, 'R'],
  ["Hadar", 210.956, -60.373, 0.61, 'B'], ["Altair", 297.696, 8.868, 0.77, 'W'],
  ["Acrux", 186.650, -63.099, 0.77, 'B'], ["Aldebaran", 68.980, 16.509, 0.85, 'O'],
  ["Antares", 247.352, -26.432, 0.96, 'R'], ["Spica", 201.298, -11.161, 0.97, 'B'],
  ["Pollux", 116.329, 28.026, 1.14, 'O'], ["Fomalhaut", 344.412, -29.622, 1.16, 'W'],
  ["Deneb", 310.358, 45.280, 1.25, 'W'], ["Mimosa", 191.930, -59.689, 1.25, 'B'],
  ["Regulus", 152.093, 11.967, 1.36, 'B'], ["Adhara", 104.656, -28.973, 1.50, 'B'],
  ["Castor", 113.650, 31.888, 1.58, 'B'], ["Gacrux", 187.791, -57.113, 1.63, 'R'],
  ["Shaula", 263.402, -37.104, 1.63, 'B'], ["Bellatrix", 81.283, 6.350, 1.64, 'B'],
  ["Elnath", 81.573, 28.608, 1.65, 'B'], ["Miaplacidus", 138.300, -69.717, 1.67, 'W'],
  ["Alnilam", 84.053, -1.202, 1.69, 'B'], ["Alnair", 332.058, -46.961, 1.73, 'B'],
  ["Alnitak", 85.190, -1.943, 1.74, 'B'], ["Alioth", 193.507, 55.960, 1.77, 'B'],
  ["Dubhe", 165.932, 61.751, 1.79, 'O'], ["Mirfak", 51.081, 49.861, 1.79, 'W'],
  ["Wezen", 107.098, -26.393, 1.83, 'W'], ["Sargas", 264.330, -42.998, 1.86, 'W'],
  ["Kaus Australis", 276.043, -34.385, 1.85, 'B'], ["Avior", 125.628, -59.510, 1.86, 'O'],
  ["Alkaid", 206.885, 49.313, 1.86, 'B'], ["Menkalinan", 89.882, 44.947, 1.90, 'W'],
  ["Atria", 252.166, -69.028, 1.91, 'O'], ["Alhena", 99.428, 16.399, 1.93, 'B'],
  ["Peacock", 306.412, -56.735, 1.94, 'B'], ["Polaris", 37.955, 89.264, 1.98, 'W'],
  ["Mirzam", 95.675, -17.956, 1.98, 'B'], ["Alphard", 141.897, -8.659, 1.98, 'O'],
  ["Hamal", 31.793, 23.462, 2.00, 'O'], ["Algieba", 154.993, 19.842, 2.01, 'O'],
  ["Diphda", 10.897, -17.987, 2.04, 'O'], ["Nunki", 283.816, -26.297, 2.05, 'B'],
  ["Menkent", 211.671, -36.370, 2.06, 'O'], ["Mirach", 17.433, 35.621, 2.07, 'R'],
  ["Alpheratz", 2.097, 29.091, 2.07, 'B'], ["Rasalhague", 263.734, 12.560, 2.08, 'W'],
  ["Kochab", 222.676, 74.156, 2.07, 'O'], ["Saiph", 86.939, -9.670, 2.07, 'B'],
  ["Denebola", 177.265, 14.572, 2.14, 'W'],
  // Susulan (5 Sep 2026) -- lengkapi Leo, Taurus, Cassiopeia, Ursa Minor,
  // Cygnus, Aquila supaya garis rasinya (SKY_CONSTELLATIONS) tidak cuma
  // jadi 1-2 segmen saja.
  ["Zosma", 168.527, 20.524, 2.56, 'W'], ["Chertan", 168.560, 15.429, 3.34, 'W'],
  ["Alcyone", 56.871, 24.105, 2.87, 'B'],
  ["Schedar", 10.127, 56.537, 2.24, 'O'], ["Caph", 2.295, 59.150, 2.28, 'W'],
  ["Gamma Cassiopeiae", 14.177, 60.717, 2.47, 'B'], ["Ruchbah", 21.454, 60.235, 2.68, 'W'],
  ["Segin", 28.599, 63.670, 3.38, 'B'],
  ["Pherkad", 230.182, 71.834, 3.05, 'W'],
  ["Sadr", 305.557, 40.257, 2.23, 'W'], ["Gienah Cygni", 311.553, 33.970, 2.46, 'O'],
  ["Delta Cygni", 296.244, 45.131, 2.87, 'B'], ["Albireo", 292.680, 27.960, 3.18, 'O'],
  ["Tarazed", 296.565, 10.613, 2.72, 'O'], ["Alshain", 298.828, 6.407, 3.71, 'Y'],
];

// Gambar Bulan sebagai sabit/gibbous sungguhan (bukan bulat polos) --
// teknik "terminator ellipse" standar: setengah lingkaran terang di satu
// sisi (kanan kalau waxing, kiri kalau waning), lalu elips di tengah yang
// MENAMBAH terang (gibbous, k>0.5) atau MEMOTONG jadi sabit (crescent,
// k<0.5). k = fraksi iluminasi (0=baru, 1=purnama), waxing = fase naik
// (dLon mentah < 180°, dari purnama berikutnya belum lewat).
function _skyDomeDrawMoonPhase(ctx, cx, cy, r, k, waxing, brightColor, darkColor) {
  ctx.save();
  ctx.beginPath(); ctx.arc(cx, cy, r, 0, 2 * Math.PI); ctx.clip();
  ctx.fillStyle = darkColor;
  ctx.fillRect(cx - r, cy - r, r * 2, r * 2);
  ctx.fillStyle = brightColor;
  ctx.beginPath();
  if (waxing) ctx.arc(cx, cy, r, -Math.PI / 2, Math.PI / 2, false);  // separuh kanan terang
  else ctx.arc(cx, cy, r, Math.PI / 2, -Math.PI / 2, false);  // separuh kiri terang
  ctx.fill();
  const ex = r * Math.abs(2 * k - 1);
  ctx.beginPath();
  ctx.ellipse(cx, cy, ex, r, 0, 0, 2 * Math.PI);
  ctx.fillStyle = k > 0.5 ? brightColor : darkColor;  // gibbous: elips nambah terang: crescent: elips motong jadi gelap
  ctx.fill();
  ctx.restore();
}

function _skyDomeColors(night) {
  if (night) {
    // Mode malam tetap merah-saja (jaga night vision), tapi Bulan dibedakan
    // dari bintang lewat kecerahan (lebih terang) bukan hue lain (hue lain
    // akan merusak night vision, itu justru alasan mode ini ada).
    return { horizon: '#3a0000', ring: '#2a0000', label: '#a00', star: '#c00', sun: '#a00', moon: '#ff3b3b', mountSw: '#c00', mountImu: '#800' };
  }
  const cs = getComputedStyle(document.documentElement);
  return {
    // [DIUBAH <gaya peta langit antik>, 2026-09-24] horizon/ring digeser ke
    // hue keemasan pudar (bukan biru-abu polos) supaya cincin+garis radial
    // baru (_skyDomeDrawGrid()) terasa seperti peta langit klasik (referensi:
    // atlas bintang gaya lama, garis tipis emas di atas langit gelap) --
    // TIDAK menyentuh warna bintang/rasi/Matahari/Bulan/mount (fungsional,
    // dipakai bedakan objek, operator sudah puas dgn tampilan itu).
    horizon: 'rgba(214,178,110,0.55)', ring: 'rgba(214,178,110,0.22)',
    label: cs.getPropertyValue('--txt2').trim() || '#889',
    // Bulan sengaja beda hue dari bintang (biru-perak vs putih polos) supaya
    // langsung kebeda sekilas, tidak cuma beda ukuran titik.
    star: '#eee', sun: '#f0c040', moon: '#9fc9f0',
    mountSw: cs.getPropertyValue('--acc2').trim() || '#8fd6ff',
    mountImu: cs.getPropertyValue('--gold').trim() || '#f0c040',
  };
}

// Proyeksi azimuthal equidistant: r=0 di zenith (alt 90), r=R di horizon (alt 0).
// Utara di atas, Timur di kanan (konvensi peta langit umum menghadap ke atas).
function _skyProject(altDeg, azDeg, cx, cy, R) {
  const r = R * (90 - altDeg) / 90;
  const th = azDeg * Math.PI / 180;
  return { x: cx + r * Math.sin(th), y: cy - r * Math.cos(th) };
}

// --- Presesi J2000 -> tanggal (Meeus 21.3, ketat) ---
// Katalog bintang & elemen planet di file ini berkerangka J2000; langit sebenarnya sudah
// bergeser ~50"/tahun (0.37 deg di 2026). Wajib utk target GoTo, bukan cuma tampilan.
function skyPrecess(ra, dec, jd) {
  const T = (jd - 2451545.0) / 36525;
  const zeta = (2306.2181 * T + 0.30188 * T * T + 0.017998 * T * T * T) / 3600 * RAD;
  const z = (2306.2181 * T + 1.09468 * T * T + 0.018203 * T * T * T) / 3600 * RAD;
  const th = (2004.3109 * T - 0.42665 * T * T - 0.041833 * T * T * T) / 3600 * RAD;
  const a = ra * RAD, d = dec * RAD;
  const A = Math.cos(d) * Math.sin(a + zeta);
  const B = Math.cos(th) * Math.cos(d) * Math.cos(a + zeta) - Math.sin(th) * Math.sin(d);
  const C = Math.sin(th) * Math.cos(d) * Math.cos(a + zeta) + Math.cos(th) * Math.sin(d);
  return { ra: ((Math.atan2(A, B) + z) * DEG % 360 + 360) % 360, dec: Math.asin(C) * DEG };
}

// --- Planet (Merkurius s.d. Saturnus) ---
// Elemen Keplerian aproksimasi JPL (E.M. Standish, "Keplerian Elements for
// Approximate Positions of the Major Planets", Tabel 1, valid 1800-2050,
// akurasi ~menit busur -- cukup utk penanda peta langit & goto visual, BUKAN
// efemeris presisi). Tiap elemen: [nilai J2000, laju per abad]. Urutan:
// a (AU), e, I (deg), L (deg), bujur perihelion (deg), bujur node naik (deg).
// Bumi = baris EM Bary. Koordinat hasil = ekuatorial J2000 (sama dgn katalog
// bintang di file ini -- konsisten, tidak dikoreksi presesi ke tanggal).
const SKY_PLANET_ELEMENTS = {
  Bumi:     [[1.00000261, 0.00000562], [0.01671123, -0.00004392], [-0.00001531, -0.01294668], [100.46457166, 35999.37244981], [102.93768193, 0.32327364], [0, 0]],
  Merkurius:[[0.38709927, 0.00000037], [0.20563593, 0.00001906], [7.00497902, -0.00594749], [252.25032350, 149472.67411175], [77.45779628, 0.16047689], [48.33076593, -0.12534081]],
  Venus:    [[0.72333566, 0.00000390], [0.00677672, -0.00004107], [3.39467605, -0.00078890], [181.97909950, 58517.81538729], [131.60246718, 0.00268329], [76.67984255, -0.27769418]],
  Mars:     [[1.52371034, 0.00001847], [0.09339410, 0.00007882], [1.84969142, -0.00813131], [-4.55343205, 19140.30268499], [-23.94362959, 0.44441088], [49.55953891, -0.29257343]],
  Jupiter:  [[5.20288700, -0.00011607], [0.04838624, -0.00013253], [1.30439695, -0.00183714], [34.39644051, 3034.74612775], [14.72847983, 0.21252668], [100.47390909, 0.20469106]],
  Saturnus: [[9.53667594, -0.00125060], [0.05386179, -0.00050991], [2.48599187, 0.00193609], [49.95424423, 1222.49362201], [92.59887831, -0.41897216], [113.66242448, -0.28867794]],
};
// Magnitudo dasar (r=Δ=1AU, fase 0) + koefisien fase i, i^2, i^3 (Astronomical Almanac).
const SKY_PLANET_MAG = {
  Merkurius: [-0.42, 0.0380, -0.000273, 0.000002], Venus: [-4.40, 0.0009, 0.000239, -0.00000065],
  Mars: [-1.52, 0.016, 0, 0], Jupiter: [-9.40, 0.005, 0, 0], Saturnus: [-8.88, 0, 0, 0],
};
const SKY_PLANET_COLOR = { Merkurius: '#b9b9b9', Venus: '#fff1c1', Mars: '#ff7b4d', Jupiter: '#ffd7a0', Saturnus: '#e6cf8a' };

function _skyHelioEcl(name, jd) {
  const T = (jd - 2451545.0) / 36525;
  const el = SKY_PLANET_ELEMENTS[name].map(([v, r]) => v + r * T);
  const [a, e, I, L, wbar, Om] = el;
  const M = (((L - wbar) % 360) + 540) % 360 - 180;
  let E = M * RAD + e * Math.sin(M * RAD);
  for (let k = 0; k < 8; k++) E -= (E - e * Math.sin(E) - M * RAD) / (1 - e * Math.cos(E));
  const xp = a * (Math.cos(E) - e), yp = a * Math.sqrt(1 - e * e) * Math.sin(E);
  const w = (wbar - Om) * RAD, O = Om * RAD, i = I * RAD;
  const cw = Math.cos(w), sw = Math.sin(w), cO = Math.cos(O), sO = Math.sin(O), ci = Math.cos(i), si = Math.sin(i);
  return {
    x: (cw * cO - sw * sO * ci) * xp + (-sw * cO - cw * sO * ci) * yp,
    y: (cw * sO + sw * cO * ci) * xp + (-sw * sO + cw * cO * ci) * yp,
    z: (sw * si) * xp + (cw * si) * yp,
  };
}

// Posisi geosentris semua planet: ra/dec (deg), alt/az, jarak Bumi, elongasi
// dari Matahari, sudut fase, magnitudo tampak.
function skyPlanetPositions(jd, lat, lon) {
  const earth = _skyHelioEcl('Bumi', jd);
  const eps = 23.43928 * RAD;
  const out = [];
  Object.keys(SKY_PLANET_MAG).forEach(name => {
    const p = _skyHelioEcl(name, jd);
    const gx = p.x - earth.x, gy = p.y - earth.y, gz = p.z - earth.z;
    const dist = Math.hypot(gx, gy, gz);
    const ex = gx, ey = gy * Math.cos(eps) - gz * Math.sin(eps), ez = gy * Math.sin(eps) + gz * Math.cos(eps);
    const { ra, dec } = skyPrecess(((Math.atan2(ey, ex) * DEG) + 360) % 360, Math.asin(ez / dist) * DEG, jd);
    const aa = altAz(ra, dec, lat, lon, jd);
    const rSun = Math.hypot(p.x, p.y, p.z), rEarth = Math.hypot(earth.x, earth.y, earth.z);
    const elong = Math.acos(Math.max(-1, Math.min(1, (dist * dist + rEarth * rEarth - rSun * rSun) / (2 * dist * rEarth)))) * DEG;
    const iPh = Math.acos(Math.max(-1, Math.min(1, (rSun * rSun + dist * dist - rEarth * rEarth) / (2 * rSun * dist)))) * DEG;
    const [m0, c1, c2, c3] = SKY_PLANET_MAG[name];
    const mag = m0 + 5 * Math.log10(rSun * dist) + c1 * iPh + c2 * iPh * iPh + c3 * iPh * iPh * iPh;
    out.push({ name, ra, dec, alt: aa.alt, az: aa.az, dist, elong, mag });
  });
  return out;
}

// Kartu "Fenomena Langit" (index.html) -- planet di atas horizon + Bulan
// terdekat ke planet mana (konjungsi). Dipanggil dari updateHome() tiap 60 dtk.
function updatePlanetCard() {
  const listEl = document.getElementById('planetList');
  if (!listEl || typeof appLoc === 'undefined' || typeof appLoc.lat !== 'number') return;
  const now = new Date(), jd = jde(now);
  const planets = skyPlanetPositions(jd, appLoc.lat, appLoc.lon);
  const up = planets.filter(p => p.alt > 0).sort((a, b) => a.mag - b.mag);
  // Matahari di atas -6° (di atas senja sipil) = langit terlalu terang, planet
  // (kecuali Venus/Jupiter yang kadang tampak siang dgn bantuan teleskop/
  // kamera) praktis tidak terlihat mata -- tandai supaya tidak menyesatkan.
  const daylight = sunAltAzNow(now, appLoc.lat, appLoc.lon).alt > -6;
  listEl.innerHTML = up.length
    ? up.map(p => {
        const tag = daylight ? ' · siang, tidak terlihat' : (p.elong < 15 ? ' · dekat Matahari' : '');
        return `<div class="status-row" style="${daylight ? 'opacity:.55' : ''}"><span class="k">${p.name}</span><span class="val">Alt ${p.alt.toFixed(0)}° · mag ${p.mag.toFixed(1)}${tag}</span></div>`;
      }).join('')
    : '<div class="text-sm" style="color:var(--txt2)">Tidak ada planet di atas horizon sekarang.</div>';
  const m = moonPos(jd), mEq = eclToEq(m.lon, m.lat, jd);
  // Kandidat konjungsi: planet + bintang terang (mag<1.5) dari katalog.
  const candidates = planets.map(p => ({ name: p.name, ra: p.ra, dec: p.dec }))
    .concat(SKY_STAR_CATALOG.filter(s => s[3] < 1.5).map(s => ({ name: s[0], ra: s[1], dec: s[2] })));
  let best = null;
  candidates.forEach(p => {
    const a1 = mEq.ra * RAD, d1 = mEq.dec * RAD, a2 = p.ra * RAD, d2 = p.dec * RAD;
    const sep = Math.acos(Math.max(-1, Math.min(1, Math.sin(d1) * Math.sin(d2) + Math.cos(d1) * Math.cos(d2) * Math.cos(a1 - a2)))) * DEG;
    if (!best || sep < best.sep) best = { name: p.name, sep };
  });
  const conjEl = document.getElementById('moonPlanetConj');
  if (conjEl && best) {
    // Peringatan: <2° = konjungsi dekat (sorot emas + toast sekali per objek per
    // sesi), <0.6° = mendekati okultasi (geosentris -- paralaks Bulan hingga ~1°
    // membuat okultasi sungguhan bergantung lokasi, jadi ini hanya isyarat).
    const alert = best.sep < 0.6 ? ' ⚠ okultasi mungkin' : best.sep < 2 ? ' ★ konjungsi' : '';
    conjEl.textContent = `${best.name} · ${best.sep.toFixed(1)}°${alert}`;
    conjEl.style.color = alert ? 'var(--gold)' : '';
    if (alert && !_skyConjNotified.has(best.name) && typeof toast === 'function') {
      _skyConjNotified.add(best.name);
      const msg = `Bulan${alert.replace(/^ [^ ]+/, '')} dengan ${best.name} (${best.sep.toFixed(1)}°)`;
      toast(msg, 'ok');
      _skyNotify('🌙 Fenomena langit', msg);
    }
  }
}
const _skyConjNotified = new Set();

// Notifikasi browser via fireNotif() milik dashboard -- hanya jika operator sudah
// mengaktifkan notifikasi di pengaturan (ml_notif_enabled), sama seperti trigger hilal.
function _skyNotify(title, body) {
  try {
    if (localStorage.getItem('ml_notif_enabled') === '1' && typeof fireNotif === 'function') fireNotif(title, body);
  } catch (e) { /* localStorage bisa diblokir -- abaikan */ }
}

// Kalender fenomena 30 hari ke depan: 4 fase utama Bulan + ekuinoks/solstis
// (Matahari melintasi bujur ekliptika 0/90/180/270) + gerhana berikutnya
// dari /gerhana/berikutnya (yang sudah ada, ditampilkan kalau jatuh <=60 hari).
// Waktu lintasan dicari: langkah 3 jam lalu bisection ke ketelitian ~1 menit.
function _skyFindCrossing(fn, targetDeg, startMs, days) {
  const diff = ms => (((fn(new Date(ms)) - targetDeg) % 360) + 540) % 360 - 180;  // -180..180, melewati 0 saat lintasan
  const STEP = 3 * 3600000;
  let prev = diff(startMs);
  for (let t = startMs + STEP; t <= startMs + days * 86400000; t += STEP) {
    const cur = diff(t);
    if (prev < 0 && cur >= 0 && cur - prev < 90) {
      let lo = t - STEP, hi = t;
      for (let k = 0; k < 12; k++) { const mid = (lo + hi) / 2; if (diff(mid) < 0) lo = mid; else hi = mid; }
      return new Date(hi);
    }
    prev = cur;
  }
  return null;
}

async function updatePhenomenaCalendar() {
  const el = document.getElementById('phenomenaList');
  if (!el) return;
  const startMs = Date.now(), items = [];
  [['Bulan Baru', 0], ['Kuartir Pertama', 90], ['Bulan Purnama', 180], ['Kuartir Terakhir', 270]].forEach(([n, a]) => {
    const t = _skyFindCrossing(moonPhaseAngle, a, startMs, 31); if (t) items.push({ t, n });
  });
  [['Ekuinoks Maret', 0], ['Solstis Juni', 90], ['Ekuinoks September', 180], ['Solstis Desember', 270]].forEach(([n, a]) => {
    const t = _skyFindCrossing(d => sunPos(jde(d)), a, startMs, 31); if (t) items.push({ t, n });
  });
  try {
    const r = await fetch('/gerhana/berikutnya', { signal: AbortSignal.timeout(8000) });
    const d = await r.json();
    if (d.status === 'ok') {
      [['Gerhana Bulan', d.gerhana_bulan], ['Gerhana Matahari', d.gerhana_matahari]].forEach(([n, g]) => {
        if (!g) return;
        const t = new Date(g.waktu_puncak_utc.endsWith('Z') || /[+-]\d\d:?\d\d$/.test(g.waktu_puncak_utc) ? g.waktu_puncak_utc : g.waktu_puncak_utc + 'Z');
        if (t - startMs <= 60 * 86400000) items.push({ t, n: `${n}${g.jenis ? ' (' + g.jenis + ')' : ''}` });
      });
    }
  } catch (e) { /* endpoint gerhana opsional -- kalender tetap tampil tanpa itu */ }
  items.sort((a, b) => a.t - b.t);
  el.innerHTML = items.length
    ? items.map(i => `<div class="status-row"><span class="k">${i.n}</span><span class="val">${i.t.toLocaleString('id-ID', { day: '2-digit', month: 'short', hour: '2-digit', minute: '2-digit' })}</span></div>`).join('')
    : '<div class="text-sm" style="color:var(--txt2)">Tidak ada fenomena utama dalam 30 hari.</div>';
}

// --- Jadwal terbit / transit / terbenam + senja + skor kelayakan observasi ---
// Pemindaian tinggi tiap 10 mnt sepanjang hari lokal (00:00-24:00) lalu bisection
// ~1 mnt di tiap lintasan ambang. Ambang: Matahari -0.833°, Bulan -0.833° (moonAltAzNow
// sudah toposentris sejak 2026-09-27, jadi paralaks tak perlu masuk ambang lagi),
// planet -0.567° (refraksi saja). Datanya perkiraan utk perencanaan
// observasi, BUKAN jadwal resmi (mis. maghrib resmi tetap dari calcHilal()).
const SKY_RS_THRESHOLD = { Matahari: -0.833, Bulan: -0.833 };
let _skyRiseSet = null;   // hasil terakhir, dipakai updateObsScore()

function _skyAllAlts(date, lat, lon) {
  const out = { Matahari: sunAltAzNow(date, lat, lon).alt, Bulan: moonAltAzNow(date, lat, lon).alt };
  skyPlanetPositions(jde(date), lat, lon).forEach(p => { out[p.name] = p.alt; });
  return out;
}

function _skyRefineCrossing(name, lo, hi, thr, lat, lon) {
  const f = ms => _skyAllAlts(new Date(ms), lat, lon)[name] - thr;
  const upward = f(lo) < 0;
  for (let k = 0; k < 8; k++) {
    const mid = (lo + hi) / 2, v = f(mid);
    if ((v < 0) === upward) lo = mid; else hi = mid;
  }
  return new Date((lo + hi) / 2);
}

function computeRiseSet(lat, lon) {
  const d0 = new Date(); d0.setHours(0, 0, 0, 0);
  const start = d0.getTime(), STEP = 10 * 60000, N = 144;
  const samples = [];
  for (let k = 0; k <= N; k++) samples.push(_skyAllAlts(new Date(start + k * STEP), lat, lon));
  const names = Object.keys(samples[0]), res = {};
  names.forEach(name => {
    const thr = SKY_RS_THRESHOLD[name] != null ? SKY_RS_THRESHOLD[name] : -0.567;
    const r = { rise: null, set: null, transit: null, maxAlt: -90 };
    for (let k = 1; k <= N; k++) {
      const a = samples[k - 1][name], b = samples[k][name];
      const t0 = start + (k - 1) * STEP, t1 = start + k * STEP;
      if (a < thr && b >= thr && !r.rise) r.rise = _skyRefineCrossing(name, t0, t1, thr, lat, lon);
      if (a >= thr && b < thr && !r.set) r.set = _skyRefineCrossing(name, t0, t1, thr, lat, lon);
      if (b > r.maxAlt) { r.maxAlt = b; r.transit = new Date(t1); }
    }
    r.alwaysUp = samples.every(s => s[name] >= thr);
    r.neverUp = r.maxAlt < thr;
    res[name] = r;
  });
  // Senja: Matahari turun melewati -6/-12/-18 (malam) & naik (pagi).
  const tw = { evening: {}, morning: {} };
  [[-6, 'sipil'], [-12, 'nautika'], [-18, 'astronomis']].forEach(([thr, n]) => {
    for (let k = 1; k <= N; k++) {
      const a = samples[k - 1].Matahari, b = samples[k].Matahari;
      const t0 = start + (k - 1) * STEP, t1 = start + k * STEP;
      if (a >= thr && b < thr && !tw.evening[n]) tw.evening[n] = _skyRefineCrossing('Matahari', t0, t1, thr, lat, lon);
      if (a < thr && b >= thr && !tw.morning[n]) tw.morning[n] = _skyRefineCrossing('Matahari', t0, t1, thr, lat, lon);
    }
  });
  _skyRiseSet = { res, tw };
  return _skyRiseSet;
}

function _skyFmtT(d) { return d ? d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) : '--'; }

function updateRiseSetCard() {
  const el = document.getElementById('riseSetList');
  if (!el || typeof appLoc === 'undefined' || typeof appLoc.lat !== 'number') return;
  const { res, tw } = computeRiseSet(appLoc.lat, appLoc.lon);
  const row = (k, v) => `<div class="status-row"><span class="k">${k}</span><span class="val">${v}</span></div>`;
  let html = '';
  Object.keys(res).forEach(n => {
    const r = res[n];
    html += row(n, r.neverUp ? 'tidak terbit hari ini'
      : `↑ ${r.alwaysUp ? '--' : _skyFmtT(r.rise)} · ✦ ${_skyFmtT(r.transit)} (${r.maxAlt.toFixed(0)}°) · ↓ ${r.alwaysUp ? '--' : _skyFmtT(r.set)}`);
  });
  html += '<div class="text-sm" style="color:var(--txt2);margin:8px 0 2px">Senja malam ini (Matahari −6° / −12° / −18°)</div>';
  html += row('Sipil · Nautika · Astronomis', `${_skyFmtT(tw.evening.sipil)} · ${_skyFmtT(tw.evening.nautika)} · ${_skyFmtT(tw.evening.astronomis)}`);
  const sunset = res.Matahari.set;
  if (sunset && tw.evening.astronomis) {
    const mins = Math.round((tw.evening.astronomis - sunset) / 60000);
    html += row('Durasi senja (terbenam → gelap penuh)', `${Math.floor(mins / 60)} j ${mins % 60} mnt`);
  }
  el.innerHTML = html;
  updateObsScore();
}

// Skor kelayakan observasi 0-100 pada waktu acuan = sekarang kalau sudah gelap, atau 30 mnt setelah senja astronomis
// malam ini. [TD-22, 2026-09-30] RUMUS DIHITUNG SERVER (sky_score.py via /sky/score) -- satu sumber dgn skor yang
// disimpan ke data observasi (dulu dua salinan yang sudah menyimpang). Browser cuma menentukan waktu acuan & menampilkan.
let _obsScoreSeq = 0;
async function updateObsScore() {
  const el = document.getElementById('obsScore');
  if (!el || !_skyRiseSet || typeof appLoc === 'undefined') return;
  const now = new Date(), { tw } = _skyRiseSet;
  const sunNow = sunAltAzNow(now, appLoc.lat, appLoc.lon).alt;
  const ref = sunNow < -12 ? now : (tw.evening.astronomis ? new Date(tw.evening.astronomis.getTime() + 30 * 60000) : now);
  const tanpaGelap = !tw.evening.astronomis && sunNow > -18;
  const seq = ++_obsScoreSeq;
  let d;
  try {
    d = await (await fetch(`/sky/score?t=${ref.getTime()}&tanpa_gelap=${tanpaGelap ? 1 : 0}`, {signal: AbortSignal.timeout(8000)})).json();
  } catch (_) { d = null; }
  if (seq !== _obsScoreSeq) return;              // jawaban basi (panggilan lebih baru sudah jalan)
  if (!d || d.status !== 'ok') {
    el.innerHTML = `<div class="status-row"><span class="k">Kelayakan observasi</span><span class="val">tidak tersedia</span></div>`;
    return;
  }
  const score = d.score, why = d.alasan || [];
  const label = score >= 75 ? 'Baik' : score >= 50 ? 'Cukup' : 'Kurang';
  const color = score >= 75 ? 'var(--grn)' : score >= 50 ? 'var(--gold)' : 'var(--red)';
  el.innerHTML = `<div class="status-row"><span class="k">Kelayakan observasi (${_skyFmtT(ref)})</span><span class="val" style="color:${color}">${score}/100 · ${label}</span></div>`
    + (why.length ? `<div class="text-sm" style="color:var(--txt2)">${why.join(' · ')}</div>` : '');
}

// Pemeriksa jam & versi (TD-23): hitungan Peta Langit (planet, terbit/terbenam, jejak)
// memakai jam & zona waktu BROWSER, sedangkan log pengamatan memakai jam Pi -- dua sumber
// yang bisa berbeda diam-diam. Dipanggil dari fetchSystemStatus() (tiap 30 dtk, tab terlihat).
// skew = jam Pi - jam browser (titik tengah request, mengabaikan latensi jaringan).
function skyCheckClock(d, t0, t1) {
  const el = document.getElementById('clockWarn');
  if (!el || d.server_time_ms == null) return;
  const skewSec = (d.server_time_ms - (t0 + t1) / 2) / 1000;
  const lon = (typeof appLoc !== 'undefined' && typeof appLoc.lon === 'number') ? appLoc.lon : null;
  const expOff = lon == null ? null : (lon < 115 ? 7 : lon < 129 ? 8 : 9);   // WIB/WITA/WIT dari bujur (Indonesia)
  const browserOff = -new Date().getTimezoneOffset() / 60;
  const msgs = [];
  if (Math.abs(skewSec) > 30) msgs.push(`Jam perangkat ini ${skewSec > 0 ? 'tertinggal' : 'mendahului'} jam Pi ${Math.abs(skewSec) >= 90 ? Math.round(Math.abs(skewSec) / 60) + ' menit' : Math.round(Math.abs(skewSec)) + ' detik'} — jadwal terbit/terbenam & posisi di halaman ini bisa bergeser.`);
  if (expOff != null && browserOff !== expOff) msgs.push(`Zona waktu perangkat UTC${browserOff >= 0 ? '+' : ''}${browserOff}, lokasi pengamatan UTC+${expOff} — jam pada jadwal mengikuti zona perangkat.`);
  el.style.display = msgs.length ? 'block' : 'none';
  el.innerHTML = msgs.map(m => '⚠ ' + m).join('<br>');
  const vEl = document.getElementById('codeVersion');
  if (vEl) vEl.textContent = d.code_version ? 'Kode di Pi: ' + d.code_version : 'Kode di Pi: versi belum tercatat (deploy.sh belum pernah push)';
}

// --- ISS (data dari backend /satellites/iss, SGP4 + TLE CelesTrak) ---
let _skyIss = null;
const _skyIssNotified = new Set();   // respons terakhir; posisi 'now' di-refresh tiap fetch (30 dtk)
async function updateIssCard() {
  const el = document.getElementById('issList');
  try {
    const r = await fetch('/satellites/iss', { signal: AbortSignal.timeout(10000) });
    const d = await r.json();
    if (d.status !== 'ok') throw new Error(d.message || 'gagal');
    _skyIss = d;
    // Pengingat: lintasan TERLIHAT mulai <=10 menit lagi (sekali per lintasan).
    d.passes.forEach(p => {
      const dt = (new Date(p.start) - Date.now()) / 60000;
      if (p.visible && dt > 0 && dt <= 10 && !_skyIssNotified.has(p.start)) {
        _skyIssNotified.add(p.start);
        _skyNotify('🛰 ISS segera terlihat', `Mulai ${new Date(p.start).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}, maks ${p.max_alt.toFixed(0)}°`);
      }
    });
    if (!el) return;
    const fmt = iso => new Date(iso).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    const dirs = ['U', 'TL', 'T', 'TG', 'S', 'BD', 'B', 'BL'], dir = a => dirs[Math.round(a / 45) % 8];
    const upcoming = d.passes.filter(p => new Date(p.end) > new Date());
    const vis = upcoming.filter(p => p.visible).slice(0, 3);
    const list = vis.length ? vis : upcoming.slice(0, 2);
    let html = list.map(p => `<div class="status-row" style="${p.visible ? '' : 'opacity:.55'}"><span class="k">${fmt(p.start)}–${fmt(p.end)} ${dir(p.start_az)}→${dir(p.end_az)}</span><span class="val">maks ${p.max_alt.toFixed(0)}°${p.visible ? ' · terlihat' : ' · tak terlihat'}</span></div>`).join('');
    if (!vis.length) html = '<div class="text-sm" style="color:var(--txt2)">Tidak ada lintasan terlihat 24 jam ke depan.</div>' + html;
    if (d.tle_stale) html += '<div class="text-sm" style="color:var(--gold)">TLE lama (internet tak terjangkau) — akurasi menurun.</div>';
    el.innerHTML = html;
  } catch (e) {
    _skyIss = null;
    if (el) el.innerHTML = `<div class="text-sm" style="color:var(--txt2)">Data ISS belum tersedia (${e.message || e})</div>`;
  }
}

// Panel info kanan (Fenomena Langit + Gerhana) -- terbuka default di layar lebar,
// terlipat default di HP (<700px) supaya tidak menutupi peta; tombol "Info" toggle.
function skyDomeToggleInfo(force) {
  const panel = document.getElementById('skyInfoPanel');
  if (!panel) return;
  const show = typeof force === 'boolean' ? force : panel.style.display === 'none';
  panel.style.display = show ? 'block' : 'none';
  try { localStorage.setItem('ml_sky_info_open', show ? '1' : '0'); } catch (e) { /* abaikan */ }
}
window.addEventListener('load', () => {
  let saved = null;
  try { saved = localStorage.getItem('ml_sky_info_open'); } catch (e) { /* abaikan */ }
  if (saved !== null) skyDomeToggleInfo(saved === '1');
  else if (window.innerWidth < 700) skyDomeToggleInfo(false);
});

let _skyDomeTimer = null;

// Layar penuh (di belakang drawer-nya sendiri) -- pola sama "Grid Rule-of-
// Thirds" yang overlay penuh di atas cam-hero, BUKAN widget kecil di dalam
// drawer. Dipanggil dari openTab()/closeDrawers() di blok <script> utama.
function setSkyDomeHero(show) {
  const hero = document.getElementById('skyDomeHero');
  if (!hero) return;
  hero.classList.toggle('show', show);
  if (_skyDomeTimer) { clearInterval(_skyDomeTimer); _skyDomeTimer = null; }
  if (show) {
    renderSkyDome();
    renderAttitudeGauge();
    // Refresh lebih sering saat sungguh tampil (posisi Matahari/Bulan/mount
    // terasa "hidup") -- timer periodik terpisah dari setInterval 5 detik di
    // blok <script> utama (yang tetap aman jalan walau hero tersembunyi,
    // cuma no-op lewat early-return di bawah).
    _skyDomeTimer = setInterval(() => { renderSkyDome(); renderAttitudeGauge(); }, 1000);
  }
}

window.addEventListener('resize', () => {
  const hero = document.getElementById('skyDomeHero');
  if (hero && hero.classList.contains('show')) { renderSkyDome(); renderAttitudeGauge(); }
});

function renderSkyDome() {
  const hero = document.getElementById('skyDomeHero');
  const canvas = document.getElementById('skyDomeCanvasFull');
  if (!hero || !canvas || !hero.classList.contains('show') || typeof appLoc === 'undefined') return;

  const dpr = window.devicePixelRatio || 1;
  const cssW = hero.clientWidth || window.innerWidth || 300;
  const cssH = hero.clientHeight || window.innerHeight || 300;
  canvas.width = cssW * dpr; canvas.height = cssH * dpr;
  const ctx = canvas.getContext('2d');
  ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  ctx.clearRect(0, 0, cssW, cssH);

  const night = document.documentElement.dataset.night === 'on';
  const col = _skyDomeColors(night);
  const baseR = Math.min(cssW, cssH) / 2 - 40;
  _skyDomeLastBaseR = baseR;
  _skyDomeClampPan();  // ukuran kanvas bisa berubah (resize) -- clamp ulang tiap render, bukan cuma saat zoom berubah
  const cx = cssW / 2 + _skyDomePanX, cy = cssH / 2 + _skyDomePanY;
  const R = baseR * _skyDomeZoom;  // zoom membesarkan radius proyeksi -- pusat (zenith) di cx,cy (bisa digeser via pan), tepi horizon "keluar" dari kanvas saat di-zoom (wajar, sedang melihat area sempit lebih detail)

  // Gradasi langit malam -- bukan cuma latar hitam polos, biar terasa
  // seperti kubah langit sungguhan (lebih gelap ke arah horizon, seperti
  // efek atmosfer sungguhan). Murni kosmetik, tidak memengaruhi data.
  // [DIUBAH <selaraskan dgn tema gelap dashboard>, 2026-09-24] Sebelumnya
  // biru navy (#0d1b3a dst) -- kontras jelas dgn kartu dashboard sekitarnya
  // (--bg:#1c1b22, abu-ungu gelap netral, BUKAN biru). Digeser ke tone abu
  // gelap netral senada --bg/--bg2 supaya kubah "menyatu" dgn browser,
  // bukan terlihat seperti widget terpisah.
  const skyGrad = ctx.createRadialGradient(cx, cy, 0, cx, cy, Math.max(cssW, cssH) * 0.75);
  if (night) {
    skyGrad.addColorStop(0, '#1a0000'); skyGrad.addColorStop(1, '#050000');
  } else {
    skyGrad.addColorStop(0, '#23222b'); skyGrad.addColorStop(0.6, '#17161c'); skyGrad.addColorStop(1, '#0e0d11');
  }
  ctx.fillStyle = skyGrad;
  ctx.fillRect(0, 0, cssW, cssH);

  const isPreview = _skyDomePreviewTime != null;
  const clockEl = document.getElementById('skyDomeHeroClock');
  const previewLabelEl = document.getElementById('skyDomePreviewLabel');
  const backToNowBtn = document.getElementById('skyDomeBackToNowBtn');
  const displayNow = isPreview ? _skyDomePreviewTime : new Date();
  if (clockEl) clockEl.textContent = displayNow.toLocaleString('id-ID', isPreview
    ? { day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' }
    : undefined);
  if (previewLabelEl) previewLabelEl.style.display = isPreview ? 'block' : 'none';
  if (backToNowBtn) backToNowBtn.style.display = isPreview ? 'block' : 'none';

  if (!appLoc || typeof appLoc.lat !== 'number' || typeof appLoc.lon !== 'number') {
    ctx.fillStyle = col.label;
    ctx.textAlign = 'center';
    ctx.fillText('Lokasi belum diketahui', cx, cy);
    return;
  }

  // Cincin ketinggian 0/30/60° + horizon (di-clip ke area kanvas -- saat
  // zoom>1, cincin ini "meluas" keluar kanvas, wajar/tidak perlu ditangani
  // khusus karena canvas otomatis tidak menggambar di luar batasnya).
  ctx.strokeStyle = col.ring;
  ctx.lineWidth = 1;
  [0, 30, 60].forEach(alt => {
    const rr = R * (90 - alt) / 90;
    ctx.beginPath(); ctx.arc(cx, cy, rr, 0, 2 * Math.PI); ctx.stroke();
  });
  ctx.strokeStyle = col.horizon;
  ctx.lineWidth = 1.5;
  ctx.beginPath(); ctx.arc(cx, cy, R, 0, 2 * Math.PI); ctx.stroke();

  // [DITAMBAHKAN <gaya peta langit antik>, 2026-09-24] Garis radial (meridian
  // azimuth) tiap 30 derajat dari zenith ke cincin horizon, plus skala takik
  // di cincin luar (minor tiap 10°, major/lebih panjang tiap 30°) -- meniru
  // gaya atlas bintang klasik (referensi gambar dari operator: lingkaran
  // luar bertakik + garis tipis emas). Murni dekoratif/referensi visual,
  // TIDAK dipakai perhitungan apa pun -- disabled di mode malam (night vision).
  if (!night) {
    ctx.save();
    ctx.strokeStyle = col.ring;
    ctx.lineWidth = 1;
    for (let az = 0; az < 360; az += 30) {
      const th = az * Math.PI / 180;
      ctx.beginPath();
      ctx.moveTo(cx, cy);
      ctx.lineTo(cx + R * Math.sin(th), cy - R * Math.cos(th));
      ctx.stroke();
    }
    ctx.strokeStyle = col.horizon;
    for (let az = 0; az < 360; az += 10) {
      const th = az * Math.PI / 180;
      const isMajor = az % 30 === 0;
      const tickLen = isMajor ? 10 : 5;
      ctx.lineWidth = isMajor ? 1.5 : 1;
      const sinT = Math.sin(th), cosT = Math.cos(th);
      ctx.beginPath();
      ctx.moveTo(cx + R * sinT, cy - R * cosT);
      ctx.lineTo(cx + (R + tickLen) * sinT, cy - (R + tickLen) * cosT);
      ctx.stroke();
    }
    ctx.restore();
  }

  // [DITAMBAHKAN <TD-18/riwayat insiden dekat-vertikal>, 2026-09-24; batas
  // diturunkan 80->60deg pasca tes pergerakan varian sudut pasca-flash
  // firmware] Cincin batas HATI-HATI "terlalu mendongak". Ini BUKAN limit
  // keras firmware (AXIS2_LIMIT_MAX di Config.h OnStepX masih 80deg, goto
  // baru ditolak firmware di atas itu) -- 60deg dipilih sbg batas OPERASIONAL
  // yg lebih konservatif, krn riwayat nyata insiden (mount macet dekat
  // vertikal, gagal diturunkan lagi, menggagalkan observasi -- lihat
  // 04_Dokumentasi/Tahap1_Baseline/Incident_Report_TEMPLATE.md Contoh #3)
  // menunjukkan risiko fisik (fokuser/tabung mendekati mentok, motor
  // berisiko slip/stall saat recovery) sudah relevan SEBELUM mentok limit
  // keras. Digambar sbg lingkaran KECIL dekat ZENIT (radius kecil = altitude
  // tinggi, sesuai proyeksi r=R*(90-alt)/90) -- murni visual/peringatan,
  // TIDAK memblokir klik "Goto ke Sini" di dalamnya (itu tetap tanggung
  // jawab operator + validasi firmware sendiri), cuma bikin area berisiko
  // kelihatan jelas SEBELUM diklik, bukan baru tahu setelah ditolak/insiden.
  const dangerAltDeg = 60;
  const dangerR = R * (90 - dangerAltDeg) / 90;
  ctx.save();
  ctx.strokeStyle = '#ff4d4d';
  ctx.lineWidth = 1.5;
  ctx.setLineDash([4, 3]);
  ctx.beginPath(); ctx.arc(cx, cy, dangerR, 0, 2 * Math.PI); ctx.stroke();
  ctx.setLineDash([]);
  ctx.restore();

  // Label mata angin -- SENGAJA pakai radius tetap dekat tepi kanvas
  // (bukan proyeksi lewat R yang ikut membesar saat zoom), supaya arah
  // U/T/S/B selalu kelihatan sebagai referensi walau sedang zoom in jauh
  // ke area dekat zenith (kalau ikut R, label ini akan "kabur" keluar
  // kanvas duluan sebelum konten lain, hilang justru saat paling dibutuhkan).
  const compassR = Math.min(cssW, cssH) / 2 - 16;
  ctx.fillStyle = col.label;
  ctx.font = '11px sans-serif';
  ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
  [["U", 0], ["T", 90], ["S", 180], ["B", 270]].forEach(([label, az]) => {
    const th = az * Math.PI / 180;
    ctx.fillText(label, cx + compassR * Math.sin(th), cy - compassR * Math.cos(th));
  });

  // Penanda Zenith -- tepat di tengah SELALU (tidak ikut zoom), menandakan
  // "tepat di atas kepala pengamat/mount sekarang". Proyeksi kubah ini
  // memang berpusat di posisi pengamat (lihat penjelasan ke user) -- ini
  // cuma bikin itu eksplisit terlihat, bukan mengubah cara proyeksi.
  ctx.strokeStyle = col.label;
  ctx.lineWidth = 1;
  ctx.beginPath();
  ctx.moveTo(cx - 6, cy); ctx.lineTo(cx + 6, cy);
  ctx.moveTo(cx, cy - 6); ctx.lineTo(cx, cy + 6);
  ctx.stroke();
  ctx.font = '9px sans-serif'; ctx.textAlign = 'left'; ctx.textBaseline = 'top';
  ctx.fillText('ZENIT', cx + 8, cy + 4);

  const now = displayNow;
  const lat = appLoc.lat, lon = appLoc.lon;
  const jd = jde(now);

  // Reset daftar objek yang bisa diklik -- diisi ulang tiap render supaya
  // posisi layar selalu sinkron dengan yang tergambar (objek terus bergerak).
  _skyDomeObjects = [];

  // Label teks dengan outline gelap tipis -- supaya kebaca di atas dot
  // terang MAUPUN di atas latar langit gelap, tanpa perlu kotak latar.
  function labelText(text, x, y, color) {
    ctx.font = '11px sans-serif';
    ctx.textAlign = 'left'; ctx.textBaseline = 'middle';
    ctx.lineWidth = 3; ctx.strokeStyle = 'rgba(0,0,0,.75)';
    ctx.strokeText(text, x, y);
    ctx.fillStyle = color;
    ctx.fillText(text, x, y);
  }

  // Posisi semua bintang katalog dihitung DULU (bukan langsung digambar) --
  // dibutuhkan sebagai lookup buat gambar garis rasi SEBELUM titik bintang,
  // supaya garisnya ada di belakang titik, bukan menimpa.
  const starPositions = {};  // name -> {x,y,alt,az,spec}
  SKY_STAR_CATALOG.forEach(([name, ra0, dec0, mag, spec]) => {
    const { ra, dec } = skyPrecess(ra0, dec0, jd);
    const aa = altAz(ra, dec, lat, lon, jd);
    if (aa.alt < 0) return;
    starPositions[name] = { ...( _skyProject(aa.alt, aa.az, cx, cy, R) ), alt: aa.alt, az: aa.az, spec };
  });

  // Garis + nama rasi bintang -- tiap rasi warna sendiri (SKY_CONSTELLATIONS),
  // cuma digambar kalau MINIMAL SATU garisnya punya kedua ujung di atas
  // horizon. Nama rasi dilabel di titik tengah (centroid) bintang-bintang
  // rasi itu yang sedang terlihat -- di mode malam semua rasi disamakan
  // warna redup (jaga night vision), warna-warni cuma aktif mode normal.
  SKY_CONSTELLATIONS.forEach(constellation => {
    const lineColor = night ? col.ring : constellation.color;
    ctx.globalAlpha = night ? 0.4 : 0.55;
    ctx.strokeStyle = lineColor;
    ctx.lineWidth = 1.2;
    let sumX = 0, sumY = 0, count = 0;
    const seen = new Set();
    constellation.lines.forEach(([a, b]) => {
      const pa = starPositions[a], pb = starPositions[b];
      if (!pa || !pb) return;
      ctx.beginPath(); ctx.moveTo(pa.x, pa.y); ctx.lineTo(pb.x, pb.y); ctx.stroke();
      if (!seen.has(a)) { seen.add(a); sumX += pa.x; sumY += pa.y; count++; }
      if (!seen.has(b)) { seen.add(b); sumX += pb.x; sumY += pb.y; count++; }
    });
    if (count > 0) {
      ctx.globalAlpha = night ? 0.5 : 0.8;
      ctx.font = 'italic 10px sans-serif';
      ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
      ctx.fillStyle = lineColor;
      ctx.fillText(constellation.name.toUpperCase(), sumX / count, sumY / count - 12);
    }
  });
  ctx.globalAlpha = 1;

  // Bintang -- cuma yang di atas horizon, opacity/ukuran dari magnitudo,
  // WARNA dari kelas spektral asli (biru=panas .. merah=sejuk, lihat
  // SKY_SPECTRAL_COLOR) -- edukasi visual, bukan cuma hiasan. Mode malam
  // tetap merah-saja (jaga night vision). Nama cuma dilabel untuk yang
  // cukup terang (mag<1.5) -- 72 nama sekaligus bikin kubah penuh sesak.
  SKY_STAR_CATALOG.forEach(([name, ra, dec, mag]) => {
    const p = starPositions[name];
    if (!p) return;
    const size = mag < 0.5 ? 2.6 : mag < 1.5 ? 2.0 : 1.3;
    const starColor = night ? col.star : (SKY_SPECTRAL_COLOR[p.spec] || SKY_SPECTRAL_COLOR.W);
    ctx.globalAlpha = Math.max(0.35, 1 - mag / 3);
    ctx.fillStyle = starColor;
    ctx.beginPath(); ctx.arc(p.x, p.y, size, 0, 2 * Math.PI); ctx.fill();
    if (mag < 1.5) {
      ctx.globalAlpha = 0.85;
      labelText(name, p.x + size + 3, p.y, starColor);
    }
    // Semua bintang dari katalog boleh diklik (bukan cuma yang berlabel) --
    // hit-test pakai jarak piksel jadi tetap gampang kena walau titiknya kecil.
    _skyDomeObjects.push({ name, alt: p.alt, az: p.az, x: p.x, y: p.y });
  });
  ctx.globalAlpha = 1;

  // Jejak lintasan 6 jam ke depan (titik tiap 30 mnt, garis putus-putus) utk
  // Matahari, Bulan, planet -- operator bisa lihat kapan objek akan melewati
  // cincin merah 60° (terlalu tinggi utk GoTo aman) SEBELUM memerintah mount.
  // Bagian jejak yg di dalam cincin bahaya digambar merah. Mode malam: redup.
  {
    const STEPS = 12, STEP_MS = 30 * 60000;
    const tracks = { Matahari: [], Bulan: [] };
    skyPlanetPositions(jd, lat, lon).forEach(pl => { tracks[pl.name] = []; });
    for (let k = 0; k <= STEPS; k++) {
      const t = new Date(now.getTime() + k * STEP_MS), tj = jde(t);
      tracks.Matahari.push(sunAltAzNow(t, lat, lon));
      tracks.Bulan.push(moonAltAzNow(t, lat, lon));
      skyPlanetPositions(tj, lat, lon).forEach(pl => tracks[pl.name].push({ alt: pl.alt, az: pl.az }));
    }
    const trackColor = n => night ? col.ring : (n === 'Matahari' ? col.sun : n === 'Bulan' ? col.moon : SKY_PLANET_COLOR[n]);
    ctx.save();
    ctx.setLineDash([2, 4]); ctx.lineWidth = 1.2;
    Object.entries(tracks).forEach(([n, pts]) => {
      for (let k = 1; k < pts.length; k++) {
        const a = pts[k - 1], b = pts[k];
        if (a.alt < 0 && b.alt < 0) continue;
        const pa = _skyProject(Math.max(a.alt, 0), a.az, cx, cy, R), pb = _skyProject(Math.max(b.alt, 0), b.az, cx, cy, R);
        if (Math.hypot(pa.x - pb.x, pa.y - pb.y) > R) continue;  // lompatan Az 359->1 lewat pusat, abaikan
        const danger = Math.max(a.alt, b.alt) >= 60;
        ctx.strokeStyle = danger ? '#ff4d4d' : trackColor(n);
        ctx.globalAlpha = danger ? 0.8 : 0.55;
        ctx.beginPath(); ctx.moveTo(pa.x, pa.y); ctx.lineTo(pb.x, pb.y); ctx.stroke();
      }
    });
    ctx.restore();
  }

  // Planet -- titik lebih besar + cincin tipis supaya beda dari bintang;
  // klik-able (GoTo) sama seperti bintang. Mode malam: merah polos.
  skyPlanetPositions(jd, lat, lon).forEach(pl => {
    if (pl.alt < 0) return;
    const p = _skyProject(pl.alt, pl.az, cx, cy, R);
    const color = night ? col.star : SKY_PLANET_COLOR[pl.name];
    const size = Math.max(2.4, Math.min(4.5, 3.6 - pl.mag * 0.3));
    ctx.fillStyle = color;
    ctx.beginPath(); ctx.arc(p.x, p.y, size, 0, 2 * Math.PI); ctx.fill();
    ctx.strokeStyle = color; ctx.lineWidth = 1; ctx.globalAlpha = 0.6;
    ctx.beginPath(); ctx.arc(p.x, p.y, size + 3, 0, 2 * Math.PI); ctx.stroke();
    ctx.globalAlpha = 1;
    labelText(`${pl.name} (${pl.mag.toFixed(1)})`, p.x + size + 6, p.y, color);
    _skyDomeObjects.push({ name: pl.name, alt: pl.alt, az: pl.az, x: p.x, y: p.y });
  });

  // ISS -- posisi dari backend (di-cache 60 dtk, bergerak ~4°/dtk jadi titik ini
  // cuma indikatif kasar saat render, bukan pelacakan presisi -- ISS terlalu
  // cepat utk di-GoTo lewat klik). Tidak dimasukkan ke _skyDomeObjects.
  if (_skyIss && _skyIss.now && _skyIss.now.alt > 0) {
    const p = _skyProject(_skyIss.now.alt, _skyIss.now.az, cx, cy, R);
    const color = night ? col.star : '#7fe0ff';
    ctx.fillStyle = color;
    ctx.fillRect(p.x - 3, p.y - 3, 6, 6);
    labelText(`ISS (Alt ${_skyIss.now.alt.toFixed(0)}°${_skyIss.now.sunlit ? '' : ', bayangan'})`, p.x + 8, p.y, color);
  }

  // Matahari -- label termasuk sudut Altitude sekarang (permintaan: orang
  // awam perlu tahu "kira-kira sudah berapa derajat", bukan cuma titik).
  const sunAA = sunAltAzNow(now, lat, lon);
  if (sunAA.alt > -6) {  // masih tampak sampai senja sipil, biar tetap kelihatan mendekati maghrib
    const p = _skyProject(Math.max(sunAA.alt, 0), sunAA.az, cx, cy, R);
    ctx.fillStyle = col.sun;
    ctx.beginPath(); ctx.arc(p.x, p.y, 6, 0, 2 * Math.PI); ctx.fill();
    labelText(`Matahari (Alt ${sunAA.alt.toFixed(1)}°)`, p.x + 9, p.y, col.sun);
    _skyDomeObjects.push({ name: 'Matahari', alt: sunAA.alt, az: sunAA.az, x: p.x, y: p.y, isSun: true });
  }

  // Bulan -- ukuran tetap, pola sederhana (bukan render bulan sabit
  // sungguhan). Label sertakan Alt + iluminasi (%) -- info paling relevan
  // buat operator rukyat, tanpa perlu buka drawer Hilal terpisah.
  const moonAA = moonAltAzNow(now, lat, lon);
  // Iluminasi -- PAKAI elongasi sungguhan (koreksi lintang ekliptika Bulan),
  // BUKAN cuma selisih longitude mentah dari moonPhaseAngle(). Rumus persis
  // sama seperti calcHilal() (index.html) supaya angka di kubah ini SELALU
  // konsisten dengan angka di drawer Hilal -- pakai moonPhaseAngle() saja
  // sempat jadi bug kecil (beda tipis dari elongasi asli, biasanya <0.5
  // poin persen, tapi tidak seharusnya beda sama sekali).
  const moonPosNow = moonPos(jd);
  const moonRawPhase = moonPhaseAngle(now);  // 0-360, 0=baru/180=purnama -- BUKAN dilipat ke 0-180 seperti elongasi, dipakai buat tentukan sabit menghadap kanan/kiri (waxing/waning)
  const moonElong = Math.acos(Math.cos(moonRawPhase * RAD) * Math.cos(moonPosNow.lat * RAD)) * DEG;
  const moonIlum = (1 - Math.cos(moonElong * RAD)) / 2 * 100;
  if (moonAA.alt > -2) {
    const p = _skyProject(Math.max(moonAA.alt, 0), moonAA.az, cx, cy, R);
    _skyDomeDrawMoonPhase(ctx, p.x, p.y, 6, moonIlum / 100, moonRawPhase < 180, col.moon, col.horizon);
    _skyDomeObjects.push({ name: 'Bulan', alt: moonAA.alt, az: moonAA.az, x: p.x, y: p.y });
    labelText(`Bulan (Alt ${moonAA.alt.toFixed(1)}°, ${moonIlum.toFixed(0)}% terang)`, p.x + 9, p.y, col.moon);
  }

  // Vektor mount: software (Az+Alt dari step-counter) vs IMU (Az SAMA,
  // cuma Alt terverifikasi sensor -- IMU tidak baca Az sama sekali, lihat
  // catatan roadmap kenapa magnetometer tidak dipakai).
  if (Number.isFinite(lastMountAlt) && Number.isFinite(lastMountAz)) {
    const p = _skyProject(Math.max(lastMountAlt, -5), lastMountAz, cx, cy, R);
    ctx.fillStyle = col.mountSw;
    ctx.beginPath();
    ctx.moveTo(p.x, p.y - 6); ctx.lineTo(p.x + 6, p.y); ctx.lineTo(p.x, p.y + 6); ctx.lineTo(p.x - 6, p.y);
    ctx.closePath(); ctx.fill();
    labelText(`Mount (${lastMountAlt.toFixed(1)}°)`, p.x + 9, p.y - 9, col.mountSw);

    if (typeof lastImuStatus !== 'undefined' && lastImuStatus.connected && lastImuStatus.tilt_alt_deg != null) {
      const pImu = _skyProject(Math.max(lastImuStatus.tilt_alt_deg, -5), lastMountAz, cx, cy, R);
      ctx.fillStyle = col.mountImu;
      ctx.beginPath();
      ctx.moveTo(pImu.x, pImu.y - 5); ctx.lineTo(pImu.x + 5, pImu.y); ctx.lineTo(pImu.x, pImu.y + 5); ctx.lineTo(pImu.x - 5, pImu.y);
      ctx.closePath(); ctx.fill();
      labelText(`IMU (${lastImuStatus.tilt_alt_deg.toFixed(1)}°)`, pImu.x + 8, pImu.y + 9, col.mountImu);
    }
  }
}

// --- Kontrol preview waktu ---
function skyDomeSetPreviewNow() {
  _skyDomePreviewTime = null;
  renderSkyDome();
}

function skyDomeShiftPreview(minutesDelta) {
  const base = _skyDomePreviewTime || new Date();
  _skyDomePreviewTime = new Date(base.getTime() + minutesDelta * 60000);
  renderSkyDome();
}

function skyDomeSetPreviewMaghrib() {
  if (typeof appLoc === 'undefined' || !appLoc || typeof appLoc.lat !== 'number') {
    toast('Lokasi belum diketahui, tidak bisa hitung maghrib', 'err');
    return;
  }
  const base = _skyDomePreviewTime || new Date();
  const mgJD = maghribJD(base, appLoc.lat, appLoc.lon);
  _skyDomePreviewTime = new Date((mgJD - 2440587.5) * 86400000);
  renderSkyDome();
}

// Gauge "artificial horizon" (gaya instrumen kokpit pesawat) -- dibuat
// SUPAYA orang awam bisa baca orientasi mount sekilas tanpa perlu paham
// angka Alt/Az mentah: cakrawala biru/cokelat yang miring mengikuti
// kemiringan (Altitude), pita arah mata angin di bawah utk Azimuth. Bukan
// pengganti kubah langit (yang tetap sumber kebenaran posisi objek), ini
// pelengkap visual sederhana khusus utk orientasi mount + posisi Bulan.
// [DITAMBAHKAN 2026-09-27, masukan operator: "gauge selalu bergerak beberapa detik SETELAH mount bergerak"]
// Dulu digambar ulang tiap 2 dtk dari posisi yang dipoll tiap 8 dtk (lag s.d. ~10 dtk). Sekarang: sampel
// posisi masuk lewat attitudeGaugeFeed() (1 Hz saat bergerak, lihat mountExpectMotion di index.html), lalu
// loop requestAnimationFrame menggerakkan tampilan MULUS ke posisi terbaru + prediksi singkat dari
// kecepatan dua sampel terakhir (maks _GAUGE_EXTRAP_MAX_S), supaya gauge bergerak BERSAMA mount, bukan
// melompat terlambat. Prediksi hanya tampilan -- tidak dipakai perhitungan apa pun.
const _GAUGE_EXTRAP_MAX_S = 0.7;   // < interval poll saat bergerak (1 dtk): saat mount berhenti, lewatnya paling v*0.7 sebelum sampel berikut mengoreksi
const _GAUGE_EASE_TAU_S = 0.12;
const _gauge = {alt: NaN, az: NaN, t: 0, vAlt: 0, vAz: 0, shownAlt: NaN, shownAz: NaN, drawnAlt: NaN, drawnAz: NaN, drawnAt: 0, frameAt: 0, started: false};
function _angDiff(a, b) { return ((a - b + 540) % 360) - 180; }   // a - b, jalur terpendek, -180..180

// Tujuan Goto/nudge terakhir -- ditampilkan kecil "→ xx.xx°" di bawah angka Alt/Az sampai mount tiba
// (selisih < 0.05°) atau kedaluwarsa, pengganti "→ target" di kartu MOUNT lama.
const _GAUGE_TARGET_MAX_MS = 120000;
let _gaugeTarget = null;
function attitudeGaugeTarget(alt, az) {
  _gaugeTarget = (Number.isFinite(alt) && Number.isFinite(az)) ? {alt, az, at: performance.now()} : null;
}

function attitudeGaugeFeed(alt, az) {
  if (!Number.isFinite(alt) || !Number.isFinite(az)) return;
  const now = performance.now();
  if (Number.isFinite(_gauge.alt) && _gauge.t) {
    const dt = (now - _gauge.t) / 1000;
    const dAlt = alt - _gauge.alt, dAz = _angDiff(az, _gauge.az);
    const moving = Math.abs(dAlt) > 0.02 || Math.abs(dAz) > 0.02;
    // Kecepatan hanya dari sampel berdekatan (poll cepat); jeda panjang / diam -> tanpa prediksi.
    if (moving && dt > 0.3 && dt < 3) { _gauge.vAlt = dAlt / dt; _gauge.vAz = dAz / dt; }
    else { _gauge.vAlt = 0; _gauge.vAz = 0; }
  }
  _gauge.alt = alt; _gauge.az = az; _gauge.t = now;
  if (_gaugeTarget && ((Math.abs(alt - _gaugeTarget.alt) < 0.05 && Math.abs(_angDiff(az, _gaugeTarget.az)) < 0.05) ||
                      now - _gaugeTarget.at > _GAUGE_TARGET_MAX_MS)) _gaugeTarget = null;
}

function _gaugeFrame(now) {
  requestAnimationFrame(_gaugeFrame);
  // Posisi bisa diubah jalur lain tanpa feed -- anggap sampel baru tanpa kecepatan.
  if (Number.isFinite(lastMountAlt) && Number.isFinite(lastMountAz) &&
      (Math.abs(lastMountAlt - _gauge.alt) > 1e-6 || Math.abs(_angDiff(lastMountAz, _gauge.az)) > 1e-6)) {
    _gauge.vAlt = 0; _gauge.vAz = 0; _gauge.alt = lastMountAlt; _gauge.az = lastMountAz; _gauge.t = now;
  }
  const frameDt = _gauge.frameAt ? Math.min((now - _gauge.frameAt) / 1000, 0.5) : 0;
  _gauge.frameAt = now;
  if (Number.isFinite(_gauge.alt)) {
    const ext = Math.min((now - _gauge.t) / 1000, _GAUGE_EXTRAP_MAX_S);
    const tgtAlt = _gauge.alt + _gauge.vAlt * ext;
    const tgtAz = ((_gauge.az + _gauge.vAz * ext) % 360 + 360) % 360;
    if (!Number.isFinite(_gauge.shownAlt)) { _gauge.shownAlt = tgtAlt; _gauge.shownAz = tgtAz; }
    else {
      const k = 1 - Math.exp(-frameDt / _GAUGE_EASE_TAU_S);
      _gauge.shownAlt += (tgtAlt - _gauge.shownAlt) * k;
      _gauge.shownAz = ((_gauge.shownAz + _angDiff(tgtAz, _gauge.shownAz) * k) % 360 + 360) % 360;
    }
  }
  // Gambar ulang hanya bila tampilan berubah (hemat CPU HP/tablet), atau tiap 2 dtk (mode malam, resize).
  const changed = !(Math.abs(_gauge.shownAlt - _gauge.drawnAlt) < 0.005 && Math.abs(_angDiff(_gauge.shownAz, _gauge.drawnAz)) < 0.005);
  if (changed || now - _gauge.drawnAt > 2000) renderAttitudeGauge();
}

function startAttitudeGauge() {
  if (_gauge.started) return;
  _gauge.started = true;
  renderAttitudeGauge();
  requestAnimationFrame(_gaugeFrame);
}

function renderAttitudeGauge() {
  const canvas = document.getElementById('attitudeGaugeCanvas');
  if (!canvas) return;
  _gauge.drawnAlt = _gauge.shownAlt; _gauge.drawnAz = _gauge.shownAz; _gauge.drawnAt = performance.now();
  const dpr = window.devicePixelRatio || 1;
  const cssW = canvas.clientWidth || 260, cssH = canvas.clientHeight || 220;
  canvas.width = cssW * dpr; canvas.height = cssH * dpr;
  const ctx = canvas.getContext('2d');
  ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  ctx.clearRect(0, 0, cssW, cssH);

  const night = document.documentElement.dataset.night === 'on';
  const hasMount = Number.isFinite(lastMountAlt) && Number.isFinite(lastMountAz);
  const smooth = Number.isFinite(_gauge.shownAlt) && Number.isFinite(_gauge.shownAz);
  const pitchDeg = hasMount ? (smooth ? _gauge.shownAlt : lastMountAlt) : 0;
  const headingDeg = hasMount ? (smooth ? _gauge.shownAz : lastMountAz) : 0;

  const tapeH = 30;
  const dialCx = cssW / 2, dialCy = (cssH - tapeH) / 2;
  const dialR = Math.min(cssW, cssH - tapeH) / 2 - 4;

  // --- Dial bundar: cakrawala miring sesuai pitch (Altitude) ---
  ctx.save();
  ctx.beginPath(); ctx.arc(dialCx, dialCy, dialR, 0, 2 * Math.PI); ctx.clip();

  const pxPerDeg = dialR / 45;  // rentang tampak ±45° pas di dalam lingkaran dial
  const horizonY = dialCy + pitchDeg * pxPerDeg;  // makin mendongak (Alt naik) -> horizon turun ke bawah dial

  ctx.fillStyle = night ? '#3a0000' : '#2a6fb0';
  ctx.fillRect(dialCx - dialR, dialCy - dialR, dialR * 2, dialR * 2);
  ctx.fillStyle = night ? '#210000' : '#8a5a2b';
  ctx.fillRect(dialCx - dialR, horizonY, dialR * 2, dialR * 2);
  ctx.strokeStyle = night ? '#f00' : '#ffe14d';
  ctx.lineWidth = 2;
  ctx.beginPath(); ctx.moveTo(dialCx - dialR, horizonY); ctx.lineTo(dialCx + dialR, horizonY); ctx.stroke();

  // Skala pitch tiap 10° (garis panjang tiap 20° + angka)
  ctx.strokeStyle = night ? '#f88' : '#fff';
  ctx.fillStyle = ctx.strokeStyle;
  ctx.font = '10px sans-serif'; ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
  for (let d = -40; d <= 40; d += 10) {
    if (d === 0) continue;
    const y = horizonY - d * pxPerDeg;
    if (y < dialCy - dialR || y > dialCy + dialR) continue;
    const halfW = d % 20 === 0 ? 26 : 14;
    ctx.lineWidth = 1.5;
    ctx.beginPath(); ctx.moveTo(dialCx - halfW, y); ctx.lineTo(dialCx + halfW, y); ctx.stroke();
    if (d % 20 === 0) {
      ctx.fillText(String(Math.abs(d)), dialCx - halfW - 10, y);
      ctx.fillText(String(Math.abs(d)), dialCx + halfW + 10, y);
    }
  }
  ctx.restore();

  // Bezel
  ctx.strokeStyle = night ? '#600' : '#888';
  ctx.lineWidth = 3;
  ctx.beginPath(); ctx.arc(dialCx, dialCy, dialR, 0, 2 * Math.PI); ctx.stroke();

  // [2026-09-27] Penanda BULAN di dial -- gauge jadi alat navigasi: arahkan mount (D-pad) sampai penanda
  // Bulan masuk ke chevron tengah. Skala sama dgn pitch (pxPerDeg) utk kedua sumbu. Di luar dial ->
  // panah di tepi bezel menunjuk arahnya + jarak sudut. Posisi Bulan: lastHilalNow (index.html, live).
  const moon = (hasMount && typeof lastHilalNow !== 'undefined' && lastHilalNow &&
                Number.isFinite(lastHilalNow.altApp) && Number.isFinite(lastHilalNow.az)) ? lastHilalNow : null;
  if (moon) {
    const mdAz = _angDiff(moon.az, headingDeg);
    const mx = dialCx + mdAz * pxPerDeg, my = horizonY - moon.altApp * pxPerDeg;
    const moonCol = night ? '#ff6060' : '#f4e7a1';
    const rr = Math.hypot(mx - dialCx, my - dialCy);
    if (rr <= dialR - 8) {
      ctx.save();
      ctx.shadowColor = moonCol; ctx.shadowBlur = 8;
      ctx.fillStyle = moonCol;
      ctx.beginPath(); ctx.arc(mx, my, 6, 0, 2 * Math.PI); ctx.fill();
      ctx.restore();
      ctx.fillStyle = night ? '#f88' : '#fff'; ctx.font = '600 9px sans-serif'; ctx.textAlign = 'left'; ctx.textBaseline = 'middle';
      ctx.fillText('Bulan', mx + 9, my);
    } else {
      const ang = Math.atan2(my - dialCy, mx - dialCx);
      const ex = dialCx + Math.cos(ang) * (dialR - 12), ey = dialCy + Math.sin(ang) * (dialR - 12);
      ctx.save();
      ctx.translate(ex, ey); ctx.rotate(ang);
      ctx.fillStyle = moonCol;
      ctx.beginPath(); ctx.moveTo(9, 0); ctx.lineTo(-5, -7); ctx.lineTo(-5, 7); ctx.closePath(); ctx.fill();
      ctx.restore();
      const sep = Math.hypot(mdAz, moon.altApp - pitchDeg);   // jarak sudut kasar (cukup utk navigasi)
      // Label di sisi dalam panah, rata ke arah panah supaya tidak menumpuk dengannya.
      const lx = dialCx + Math.cos(ang) * (dialR - 26), ly = dialCy + Math.sin(ang) * (dialR - 26);
      ctx.fillStyle = night ? '#f88' : '#fff'; ctx.font = '700 10px sans-serif'; ctx.textBaseline = 'middle';
      ctx.textAlign = Math.cos(ang) < -0.3 ? 'left' : Math.cos(ang) > 0.3 ? 'right' : 'center';
      ctx.shadowColor = 'rgba(0,0,0,.8)'; ctx.shadowBlur = 3;
      ctx.fillText('Bulan ' + sep.toFixed(0) + '°', lx, ly);
      ctx.shadowBlur = 0;
    }
  }

  // Chevron kuning tetap di tengah -- ini "arah teleskop sekarang" (fixed
  // reference), yang bergerak justru cakrawala di belakangnya.
  ctx.strokeStyle = night ? '#f00' : '#ffd700';
  ctx.lineWidth = 3; ctx.lineCap = 'round';
  ctx.beginPath();
  ctx.moveTo(dialCx - 22, dialCy); ctx.lineTo(dialCx - 5, dialCy);
  ctx.lineTo(dialCx, dialCy + 6); ctx.lineTo(dialCx + 5, dialCy);
  ctx.lineTo(dialCx + 22, dialCy);
  ctx.stroke();

  // --- Pita arah mata angin (Azimuth) di bawah dial ---
  const tapeY = cssH - tapeH;
  ctx.fillStyle = night ? '#200' : '#111';
  ctx.fillRect(0, tapeY, cssW, tapeH);
  ctx.save();
  ctx.beginPath(); ctx.rect(0, tapeY, cssW, tapeH); ctx.clip();
  const pxPerDegH = 4;
  ctx.strokeStyle = night ? '#a55' : '#ccc';
  ctx.fillStyle = ctx.strokeStyle;
  ctx.font = '10px sans-serif'; ctx.textAlign = 'center'; ctx.textBaseline = 'top';
  // Tick di kelipatan 10° ABSOLUT (dulu heading+rel: kosong total bila heading bukan kelipatan 10, mis. 97.1°).
  for (let tick = Math.floor((headingDeg - 200) / 10) * 10; tick <= headingDeg + 200; tick += 10) {
    const hd = ((tick % 360) + 360) % 360;
    const x = dialCx + (tick - headingDeg) * pxPerDegH;
    if (x < -20 || x > cssW + 20) continue;
    ctx.lineWidth = 1;
    ctx.beginPath(); ctx.moveTo(x, tapeY); ctx.lineTo(x, tapeY + 8); ctx.stroke();
    if (Math.round(hd) % 30 === 0) {
      const label = hd === 0 ? 'U' : hd === 90 ? 'T' : hd === 180 ? 'S' : hd === 270 ? 'B' : String(Math.round(hd));
      ctx.fillText(label, x, tapeY + 12);
    }
  }
  ctx.restore();
  // Penanda Bulan di pita azimuth (panah di ujung pita bila di luar jangkauan).
  if (moon) {
    const tx = dialCx + _angDiff(moon.az, headingDeg) * pxPerDegH;
    ctx.fillStyle = night ? '#ff6060' : '#f4e7a1';
    if (tx >= 6 && tx <= cssW - 6) {
      ctx.beginPath(); ctx.arc(tx, tapeY + tapeH - 6, 4, 0, 2 * Math.PI); ctx.fill();
    } else {
      const left = tx < 6, ax = left ? 4 : cssW - 4, ay = tapeY + tapeH - 7;
      ctx.beginPath(); ctx.moveTo(ax, ay); ctx.lineTo(ax + (left ? 8 : -8), ay - 5); ctx.lineTo(ax + (left ? 8 : -8), ay + 5); ctx.closePath(); ctx.fill();
    }
  }
  ctx.fillStyle = night ? '#f00' : '#ff5050';
  ctx.beginPath();
  ctx.moveTo(dialCx - 6, tapeY); ctx.lineTo(dialCx + 6, tapeY); ctx.lineTo(dialCx, tapeY + 7); ctx.closePath(); ctx.fill();

  // Angka Alt/Az di pojok atas (sisi kiri/kanan dial yang dulu kosong) -- nilai tampilan yang sama dgn gauge.
  if (hasMount) {
    ctx.textBaseline = 'top';
    ctx.font = '600 9px sans-serif'; ctx.fillStyle = night ? '#a55' : '#8a94a3';
    ctx.textAlign = 'left';  ctx.fillText('ALT', 2, 2);
    ctx.textAlign = 'right'; ctx.fillText('AZ', cssW - 2, 2);
    ctx.font = '700 14px sans-serif'; ctx.fillStyle = night ? '#f88' : '#e8ecf1';
    ctx.textAlign = 'left';  ctx.fillText(pitchDeg.toFixed(2) + '°', 2, 13);
    ctx.textAlign = 'right'; ctx.fillText(headingDeg.toFixed(2) + '°', cssW - 2, 13);
    if (_gaugeTarget) {
      ctx.font = '600 10px sans-serif'; ctx.fillStyle = night ? '#f55' : '#ffd76a';
      ctx.textAlign = 'left';  ctx.fillText('→ ' + _gaugeTarget.alt.toFixed(2) + '°', 2, 31);
      ctx.textAlign = 'right'; ctx.fillText('→ ' + (((_gaugeTarget.az % 360) + 360) % 360).toFixed(2) + '°', cssW - 2, 31);
    }
  }

  if (!hasMount) {
    ctx.fillStyle = night ? '#f88' : '#ddd';
    ctx.font = '11px sans-serif'; ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
    ctx.fillText('Posisi mount belum diketahui', dialCx, dialCy);
  }
}

// --- Klik objek di kubah langit -> pilih -> konfirmasi -> Goto ---
// Sengaja klik KIRI biasa (bukan klik kanan) supaya kompatibel dengan
// layar sentuh HP/tablet di lapangan (klik kanan tidak ada di touchscreen).
// Klik cuma MEMILIH objek (tampilkan info + tombol), TIDAK langsung
// menggerakkan mount -- gerak fisik mount tetap butuh konfirmasi eksplisit
// (pola sama semua aksi goto/sync lain di dashboard ini), supaya salah
// pencet di kubah yang padat titik-titik kecil tidak memicu gerakan motor
// tak disengaja (mount ini tidak punya slip-ring Azimuth).
// [DIPERBESAR 5 Sep 2026] 14px ternyata terlalu presisi -- popup nyaris
// tidak pernah muncul kecuali klik tepat di piksel tengah titik bintang,
// terverifikasi susah dikenai bahkan pakai mouse desktop, apalagi jari di
// HP/tablet lapangan. Standar target sentuh minimum (Apple/Google HIG)
// sekitar 44px -- dipilih 28px sebagai kompromi (cukup longgar buat
// jari/mouse kurang presisi, cukup ketat supaya tidak salah pilih bintang
// tetangga di area yang padat).
const SKY_DOME_CLICK_TOLERANCE_PX = 28;

function _skyDomeOnClick(ev) {
  const canvas = ev.currentTarget;
  const rect = canvas.getBoundingClientRect();
  const clickX = ev.clientX - rect.left, clickY = ev.clientY - rect.top;

  let nearest = null, nearestDist = Infinity;
  for (const obj of _skyDomeObjects) {
    const dist = Math.hypot(obj.x - clickX, obj.y - clickY);
    if (dist < nearestDist) { nearestDist = dist; nearest = obj; }
  }

  if (nearest && nearestDist <= SKY_DOME_CLICK_TOLERANCE_PX) {
    skyDomeSelect(nearest);
  } else {
    skyDomeDeselect();
  }
}

function skyDomeSelect(obj) {
  _skyDomeSelected = obj;
  const panel = document.getElementById('skyDomeSelectPanel');
  if (!panel) return;
  panel.style.display = 'block';
  document.getElementById('skyDomeSelectName').textContent = obj.name;
  document.getElementById('skyDomeSelectAlt').textContent = obj.alt.toFixed(2) + '°';
  document.getElementById('skyDomeSelectAz').textContent = obj.az.toFixed(2) + '°';
}

function skyDomeDeselect() {
  _skyDomeSelected = null;
  const panel = document.getElementById('skyDomeSelectPanel');
  if (panel) panel.style.display = 'none';
}

async function skyDomeGotoSelected() {
  if (!_skyDomeSelected) return;
  const obj = _skyDomeSelected;
  if (obj.alt < 0) {
    toast(`${obj.name} di bawah horizon sekarang -- goto dibatalkan`, 'err');
    return;
  }
  // Kalau lagi mode preview waktu, posisi obj.alt/az itu posisi PADA WAKTU
  // PREVIEW (bukan sekarang) -- valid dipakai (pre-aim mount sebelum waktu
  // itu tiba), tapi operator WAJIB sadar ini bukan posisi live saat ini,
  // makanya ditambahkan eksplisit ke pesan konfirmasi.
  const previewNote = _skyDomePreviewTime
    ? ` [PREVIEW ${_skyDomePreviewTime.toLocaleString('id-ID')} -- BUKAN posisi sekarang]`
    : '';
  // Matahari: peringatan filter ND WAJIB, teks identik tombol "Ke Matahari"
  // yang sudah ada (mountGotoSunNow di blok <script> utama) -- konsisten,
  // bukan peringatan baru yang beda kata-kata utk kasus yang sama.
  // Alt objek kubah = tinggi geometrik; kamera melihat tinggi TAMPAK (terangkat refraksi,
  // 0.5 deg di ufuk, 0.09 deg di Alt 10) -- target GoTo harus yang tampak.
  const altApp = obj.alt + refraction(obj.alt);
  const confirmMsg = obj.isSun
    ? `PENTING: pastikan filter ND/solar sudah terpasang di kamera sebelum mengarahkan ke Matahari.${previewNote} Sudah terpasang?`
    : `Arahkan mount ke ${obj.name} (Alt ${altApp.toFixed(1)}°, Az ${obj.az.toFixed(1)}°)?${previewNote} Mount akan bergerak fisik.`;
  if (!await uiConfirm(confirmMsg)) return;
  // [DITAMBAHKAN 2026-09-06] Gerbang Home Otomatis yang sama persis dengan
  // "Ke Bulan"/"Ke Matahari" (lihat ensureHomeBeforeObjectGoto() di
  // index.html) -- goto objek Peta Langit ini SAMA KELASNYA (goto absolut ke
  // Alt/Az objek langit), jadi harus dijaga sama, bukan cuma dua tombol itu.
  const home = await ensureHomeBeforeObjectGoto();
  if (!home.ok) { toast(`Goto ke ${obj.name} DIBATALKAN -- Home Otomatis gagal: ${home.message}`, 'err'); return; }
  // TD-32: Matahari/Bulan LIVE -> posisi dihitung server (fungsi yang sama dgn Sinkron); preview waktu & benda lain
  // (bintang/planet, sudah diuji setara backend di test_skydome_js.py) tetap pakai angka kubah.
  const objekServer = _skyDomePreviewTime ? null : (obj.isSun ? 'matahari' : obj.name === 'Bulan' ? 'bulan' : null);
  await mountGoto(altApp, obj.az, objekServer);
  skyDomeDeselect();
}

// --- Geser (pan) kubah langit saat di-zoom ---
// Pakai Pointer Events (satu API utk mouse & sentuh HP/tablet, bukan
// mousedown+touchstart terpisah). Klik biasa (tanpa geser) tetap memilih
// objek seperti sebelumnya -- dibedakan dari drag lewat jarak tempuh
// pointer: kalau < SKY_DOME_DRAG_THRESHOLD_PX dianggap klik murni, kalau
// lebih dianggap drag (pilih objek DIBATALKAN supaya geser peta tidak
// nyangkut memilih bintang yang kebetulan dilewati jari).
const SKY_DOME_DRAG_THRESHOLD_PX = 6;
let _skyDomeDragState = null;  // {startX, startY, startPanX, startPanY, moved} selama pointer ditekan, null kalau tidak sedang drag

function _skyDomeOnPointerDown(ev) {
  const canvas = ev.currentTarget;
  const rect = canvas.getBoundingClientRect();
  _skyDomeDragState = {
    startX: ev.clientX - rect.left, startY: ev.clientY - rect.top,
    startPanX: _skyDomePanX, startPanY: _skyDomePanY, moved: false,
  };
  canvas.setPointerCapture(ev.pointerId);
}

function _skyDomeOnPointerMove(ev) {
  if (!_skyDomeDragState || _skyDomeZoom <= 1) return;  // di zoom 1 tidak ada gunanya geser (seluruh horizon sudah pas)
  const canvas = ev.currentTarget;
  const rect = canvas.getBoundingClientRect();
  const x = ev.clientX - rect.left, y = ev.clientY - rect.top;
  const dx = x - _skyDomeDragState.startX, dy = y - _skyDomeDragState.startY;
  if (Math.hypot(dx, dy) > SKY_DOME_DRAG_THRESHOLD_PX) _skyDomeDragState.moved = true;
  if (_skyDomeDragState.moved) {
    _skyDomePanX = _skyDomeDragState.startPanX + dx;
    _skyDomePanY = _skyDomeDragState.startPanY + dy;
    _skyDomeClampPan();
    renderSkyDome();
  }
}

function _skyDomeOnPointerUp(ev) {
  const canvas = ev.currentTarget;
  try { canvas.releasePointerCapture(ev.pointerId); } catch (e) { /* abaikan -- kadang sudah lepas sendiri */ }
  const wasDrag = _skyDomeDragState && _skyDomeDragState.moved;
  _skyDomeDragState = null;
  if (!wasDrag) _skyDomeOnClick(ev);  // tanpa geser berarti (atau geser di bawah threshold) = klik pilih objek seperti sebelumnya
}

// Canvas-nya sudah ada di DOM saat baris ini jalan -- <script src="skydome.js">
// sengaja diletakkan SETELAH markup skyDomeCanvasFull di index.html, jadi
// tidak perlu nunggu DOMContentLoaded segala.
(function () {
  const canvas = document.getElementById('skyDomeCanvasFull');
  if (!canvas) return;
  canvas.addEventListener('pointerdown', _skyDomeOnPointerDown);
  canvas.addEventListener('pointermove', _skyDomeOnPointerMove);
  canvas.addEventListener('pointerup', _skyDomeOnPointerUp);
  canvas.addEventListener('pointercancel', () => { _skyDomeDragState = null; });
})();
