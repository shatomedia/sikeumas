"""
Bangun demo statis Fleet Control Room -> shatomedia.com/hilal-demo/

Sumber: index.html Control Room asli (Beelink /var/www/hilal-control-room/index.html,
salin dulu ke lokal; HANYA DIBACA). Situs aslinya (hilal.shatomedia.com) tetap ber-Basic Auth.
Skrip ini menyisipkan hilal-snapshot.js + demo-mock.js PALING AWAL di <head> dengan ?v=<hash>
(cache Cloudflare) dan menandai judul sebagai DEMO. demo-mock.js & hilal-snapshot.js dirawat
langsung di public/hilal-demo/.

  scp beelink:/var/www/hilal-control-room/index.html /tmp/cr.html
  python scripts/build_hilal_demo.py /tmp/cr.html
"""
import hashlib
import sys
from pathlib import Path

TUJUAN = Path(__file__).resolve().parent.parent / "public" / "hilal-demo"


def _v(nama: str) -> str:
    return hashlib.sha1((TUJUAN / nama).read_bytes()).hexdigest()[:8]


def main(sumber: Path):
    teks = sumber.read_text(encoding="utf-8")
    i = teks.lower().find("<head>")
    if i < 0:
        sys.exit("<head> tidak ditemukan")
    i += len("<head>")
    sisipan = ('<script src="hilal-snapshot.js?v={}"></script><script src="demo-mock.js?v={}"></script>'
               '<meta name="robots" content="noindex">'.format(_v("hilal-snapshot.js"), _v("demo-mock.js")))
    teks = teks[:i] + sisipan + teks[i:]
    teks = teks.replace("<title>MOONLIGHT", "<title>DEMO · MOONLIGHT", 1)
    teks = teks.replace("Pemantauan real-time unit observasi hilal · shatomedia.com",
                        "Versi demo — armada simulasi · shatomedia.com", 1)
    (TUJUAN / "index.html").write_text(teks, encoding="utf-8", newline="\n")
    print("Dibangun:", TUJUAN / "index.html")


if __name__ == "__main__":
    main(Path(sys.argv[1]))
