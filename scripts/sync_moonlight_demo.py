"""
Sinkron dashboard MOONLIGHT -> demo statis shatomedia.com/moonlight-demo/

Menyalin static/ dari repo MOONLIGHT (HANYA DIBACA), lalu:
  - mengubah rujukan absolut "/img/" menjadi relatif "img/" (demo tinggal di sub-folder),
  - menulis demo-rekaman.js dari scripts/moonlight_demo_rekaman.json,
  - menyisipkan demo-rekaman.js + demo-mock.js PALING AWAL di <head> (sebelum skrip dashboard),
    dengan ?v=<hash isi> agar perubahan tidak tertahan cache Cloudflare.
public/moonlight-demo/demo-mock.js TIDAK ditimpa (dirawat langsung di repo ini).

Jalankan setelah UI MOONLIGHT atau demo-mock.js berubah:
  python scripts/sync_moonlight_demo.py "Z:/03_Penelitian dan Hibah/03.9_Hilal/01_Proyek_Aktif/raspi_bridge/static"
"""
import hashlib
import json
import shutil
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
TUJUAN = ROOT / "public" / "moonlight-demo"
REKAMAN = ROOT / "scripts" / "moonlight_demo_rekaman.json"
DISALIN = ("index.html", "skydome.js", "moonatlas.js", "moonatlas_names.js")


def _versi(data: bytes) -> str:
    return hashlib.sha1(data).hexdigest()[:8]


def main(sumber: Path):
    if not (sumber / "index.html").exists():
        sys.exit(f"index.html tidak ada di {sumber}")
    TUJUAN.mkdir(parents=True, exist_ok=True)

    rekaman = json.loads(REKAMAN.read_text(encoding="utf-8"))
    isi_rekaman = ("/* Respons GET terekam dari backend MOONLIGHT tanpa hardware (bentuk data asli). */\n"
                   "window.__ML_DEMO_REKAMAN__ = " + json.dumps(rekaman, ensure_ascii=False) + ";\n")
    (TUJUAN / "demo-rekaman.js").write_text(isi_rekaman, encoding="utf-8", newline="\n")
    sisipan = ('<script src="demo-rekaman.js?v={}"></script><script src="demo-mock.js?v={}"></script>'
               .format(_versi(isi_rekaman.encode("utf-8")), _versi((TUJUAN / "demo-mock.js").read_bytes())))

    for nama in DISALIN:
        teks = (sumber / nama).read_text(encoding="utf-8")
        teks = teks.replace("'/img/", "'img/").replace('"/img/', '"img/')
        if nama == "index.html":
            i = teks.lower().find("<head>")
            if i < 0:
                sys.exit("<head> tidak ditemukan di index.html")
            i += len("<head>")
            teks = teks[:i] + sisipan + teks[i:]
            teks = teks.replace("<title>MOONLIGHT", "<title>DEMO · MOONLIGHT", 1)
        (TUJUAN / nama).write_text(teks, encoding="utf-8", newline="\n")
    if (sumber / "img").is_dir():
        shutil.copytree(sumber / "img", TUJUAN / "img", dirs_exist_ok=True)
    print(f"Disinkronkan ke {TUJUAN}")


if __name__ == "__main__":
    main(Path(sys.argv[1]))
