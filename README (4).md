# Web Semangat Buat Pacar 💗

## Cara Jalankan
1. Pastikan udah install **Laragon / XAMPP** (PHP aktif).
2. Copy folder `semangat-web` ke folder `www` (Laragon) atau `htdocs` (XAMPP).
3. Buka browser, akses: `http://localhost/semangat-web/`

## Cara Ganti Foto / Video
1. Masukkan file foto/video kamu ke folder `assets/media/`.
2. Buka file `data/content.json`.
3. Di bagian `"media"`, edit/tambah seperti ini:

```json
{
  "type": "image",
  "src": "assets/media/nama-file-kamu.jpg",
  "caption": "Tulisan caption di sini"
}
```

Untuk video:
```json
{
  "type": "video",
  "src": "assets/media/nama-video-kamu.mp4",
  "caption": "Tulisan caption di sini"
}
```

> Catatan: 3 foto contoh di atas pakai gambar placeholder dari internet
> (placehold.co) cuma buat demo. Ganti `src` nya pakai foto kalian sendiri ya!

## Cara Ganti Kata Motivasi / Kata Manis
Masih di file `data/content.json`, edit bagian `"motivasi"` dan `"kata_manis"`.
Tambah atau kurangi kalimat sesuka kamu, formatnya array of string:

```json
"motivasi": [
  "Kalimat motivasi 1",
  "Kalimat motivasi 2"
]
```

## Ganti Nama Panggilan & Pengirim
Edit `"nama_panggilan"` dan `"nama_pengirim"` di `content.json`.

## Fitur
- Slideshow foto & video otomatis ganti tiap 5 detik (bisa klik manual juga)
- Floating hearts animasi di background
- Gradient background gerak halus
- Kartu motivasi & kata manis dengan efek fade rotasi otomatis
- Responsive, enak dibuka di HP juga

Semoga makin sayang-sayangan ya! 🌸
