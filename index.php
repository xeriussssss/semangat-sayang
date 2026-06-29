<?php
// ===== Baca data dari JSON =====
$jsonPath = __DIR__ . '/data/content.json';
$data = json_decode(file_get_contents($jsonPath), true);

$judul       = $data['judul_web'] ?? 'Semangat Terus!';
$namaPanggil = $data['nama_panggilan'] ?? 'Sayang';
$namaKirim   = $data['nama_pengirim'] ?? 'Aku';
$media       = $data['media'] ?? [];
$motivasi    = $data['motivasi'] ?? [];
$kataManis   = $data['kata_manis'] ?? [];

// Generate posisi & durasi random buat efek floating hearts
$jumlahHeart = 18;
$hearts = [];
for ($i = 0; $i < $jumlahHeart; $i++) {
    $hearts[] = [
        'left'     => rand(0, 100),
        'duration' => rand(8, 18),
        'delay'    => rand(0, 10),
        'size'     => rand(14, 32),
        'opacity'  => rand(30, 80) / 100,
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($judul) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Background animasi gradient -->
<div class="bg-animated"></div>

<!-- Floating hearts -->
<div class="hearts-container">
<?php foreach ($hearts as $h): ?>
    <span class="heart" style="
        left: <?= $h['left'] ?>%;
        animation-duration: <?= $h['duration'] ?>s;
        animation-delay: <?= $h['delay'] ?>s;
        font-size: <?= $h['size'] ?>px;
        opacity: <?= $h['opacity'] ?>;
    ">❤</span>
<?php endforeach; ?>
</div>

<div class="container">

    <header class="header">
        <p class="subtitle">Untuk kamu yang sedang berjuang</p>
        <h1 class="title"><?= htmlspecialchars($namaPanggil) ?>, Semangat Ya! <span class="wave">🌸</span></h1>
    </header>

    <!-- ===== SLIDESHOW ===== -->
    <section class="slideshow-wrap glass">
        <div class="slideshow" id="slideshow">
            <?php foreach ($media as $i => $m): ?>
                <div class="slide <?= $i === 0 ? 'active' : '' ?>" data-index="<?= $i ?>">
                    <?php if ($m['type'] === 'video'): ?>
                        <video class="slide-media" muted loop playsinline preload="metadata">
                            <source src="<?= htmlspecialchars($m['src']) ?>" type="video/mp4">
                        </video>
                        <span class="play-badge">▶</span>
                    <?php else: ?>
                        <img class="slide-media" src="<?= htmlspecialchars($m['src']) ?>" alt="<?= htmlspecialchars($m['caption'] ?? '') ?>">
                    <?php endif; ?>
                    <div class="caption-box">
                        <p><?= htmlspecialchars($m['caption'] ?? '') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <button class="nav-btn prev" id="prevBtn">&#10094;</button>
            <button class="nav-btn next" id="nextBtn">&#10095;</button>
        </div>

        <div class="dots" id="dots">
            <?php foreach ($media as $i => $m): ?>
                <span class="dot <?= $i === 0 ? 'active' : '' ?>" data-index="<?= $i ?>"></span>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ===== KATA MOTIVASI ===== -->
    <section class="card glass motivasi-section">
        <h2 class="card-title">💪 Buat Kamu yang Sedang PL</h2>
        <div class="quote-box">
            <p id="quoteText" class="quote-text"></p>
        </div>
    </section>

    <!-- ===== KATA MANIS ===== -->
    <section class="card glass manis-section">
        <h2 class="card-title">💌 Sepucuk Rasa Dariku</h2>
        <div class="quote-box manis-box">
            <p id="manisText" class="quote-text manis-text"></p>
        </div>
        <p class="signature">— <?= htmlspecialchars($namaKirim) ?>, yang selalu nungguin kamu pulang</p>
    </section>

    <footer class="footer">
        <p>Sayang kamu sampai PL kamu kelar dan seterusnya 💗</p>
    </footer>
</div>

<script>
    // Kirim data dari PHP ke JavaScript
    const motivasiList = <?= json_encode($motivasi, JSON_UNESCAPED_UNICODE) ?>;
    const manisList    = <?= json_encode($kataManis, JSON_UNESCAPED_UNICODE) ?>;
</script>
<script src="assets/js/script.js"></script>

<!-- ===== MUSIC PLAYER ===== -->
<audio id="bgMusic" loop preload="auto">
    <source src="assets/music.mp3" type="audio/mpeg">
</audio>

<div class="music-player" id="musicPlayer">
    <div class="music-vinyl" id="musicVinyl">🎵</div>
    <div class="music-info">
        <span class="music-title">Everything U Are</span>
        <span class="music-artist">Hindia</span>
    </div>
    <button class="music-btn" id="musicBtn" title="Play/Pause">
        <span id="musicIcon">▶</span>
    </button>
    <input type="range" class="music-vol" id="musicVol" min="0" max="1" step="0.05" value="0.6" title="Volume">
</div>

<script src="assets/js/music.js"></script>
</body>
</html>
