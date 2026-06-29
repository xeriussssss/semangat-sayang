(function () {
    const audio     = document.getElementById('bgMusic');
    const btn       = document.getElementById('musicBtn');
    const icon      = document.getElementById('musicIcon');
    const vinyl     = document.getElementById('musicVinyl');
    const volSlider = document.getElementById('musicVol');

    audio.volume = parseFloat(volSlider.value);

    let playing = false;

    function setPlaying(state) {
        playing = state;
        icon.textContent = playing ? '⏸' : '▶';
        vinyl.style.animationPlayState = playing ? 'running' : 'paused';
    }

    // Autoplay langsung, fallback ke klik pertama jika browser blokir
    audio.play()
        .then(() => setPlaying(true))
        .catch(() => {
            function unlockAudio() {
                audio.play().then(() => setPlaying(true));
                document.removeEventListener('click', unlockAudio);
                document.removeEventListener('touchstart', unlockAudio);
            }
            document.addEventListener('click', unlockAudio);
            document.addEventListener('touchstart', unlockAudio);
        });

    // Tombol play/pause
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (playing) {
            audio.pause();
            setPlaying(false);
        } else {
            audio.play().then(() => setPlaying(true));
        }
    });

    // Slider volume
    volSlider.addEventListener('input', () => {
        audio.volume = parseFloat(volSlider.value);
    });
})();
