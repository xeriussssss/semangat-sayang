// ===================== SLIDESHOW =====================
const slides   = document.querySelectorAll('.slide');
const dots     = document.querySelectorAll('.dot');
const prevBtn  = document.getElementById('prevBtn');
const nextBtn  = document.getElementById('nextBtn');

let currentIndex = 0;
let autoSlideTimer = null;
const AUTO_DELAY = 5000; // ganti slide tiap 5 detik

function pauseAllVideos() {
    document.querySelectorAll('.slide-media').forEach(media => {
        if (media.tagName === 'VIDEO') {
            media.pause();
            media.currentTime = 0;
        }
    });
}

function goToSlide(index) {
    if (slides.length === 0) return;

    slides[currentIndex].classList.remove('active');
    dots[currentIndex] && dots[currentIndex].classList.remove('active');

    currentIndex = (index + slides.length) % slides.length;

    slides[currentIndex].classList.add('active');
    dots[currentIndex] && dots[currentIndex].classList.add('active');

    pauseAllVideos();

    const activeMedia = slides[currentIndex].querySelector('.slide-media');
    if (activeMedia && activeMedia.tagName === 'VIDEO') {
        const badge = slides[currentIndex].querySelector('.play-badge');
        activeMedia.play().then(() => {
            if (badge) badge.classList.add('hidden');
        }).catch(() => {
            if (badge) badge.classList.remove('hidden');
        });
    }
}

function nextSlide() { goToSlide(currentIndex + 1); }
function prevSlide() { goToSlide(currentIndex - 1); }

function startAutoSlide() {
    stopAutoSlide();
    autoSlideTimer = setInterval(nextSlide, AUTO_DELAY);
}

function stopAutoSlide() {
    if (autoSlideTimer) clearInterval(autoSlideTimer);
}

if (slides.length > 0) {
    nextBtn && nextBtn.addEventListener('click', () => { nextSlide(); startAutoSlide(); });
    prevBtn && prevBtn.addEventListener('click', () => { prevSlide(); startAutoSlide(); });

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            goToSlide(parseInt(dot.dataset.index, 10));
            startAutoSlide();
        });
    });

    // klik badge play buat play/pause manual video
    document.querySelectorAll('.play-badge').forEach(badge => {
        badge.addEventListener('click', () => {
            const video = badge.parentElement.querySelector('video');
            if (!video) return;
            if (video.paused) {
                video.play();
                badge.classList.add('hidden');
            } else {
                video.pause();
                badge.classList.remove('hidden');
            }
        });
    });

    startAutoSlide();
}

// ===================== ROTASI KATA MOTIVASI & MANIS =====================
function rotateText(elementId, list, interval) {
    const el = document.getElementById(elementId);
    if (!el || !list || list.length === 0) return;

    let idx = 0;

    function showText(i) {
        el.classList.remove('show');
        setTimeout(() => {
            el.textContent = list[i];
            el.classList.add('show');
        }, 350);
    }

    showText(idx);

    setInterval(() => {
        idx = (idx + 1) % list.length;
        showText(idx);
    }, interval);
}

// motivasiList & manisList dikirim dari index.php
rotateText('quoteText', motivasiList, 6000);
rotateText('manisText', manisList, 7000);
