// Menambahkan script untuk tampilkan dan sembunyikan tombol kembali ke atas
const backToTopButton = document.getElementById('back-to-top');

window.addEventListener('scroll', () => {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        backToTopButton.style.display = 'block';
    } else {
        backToTopButton.style.display = 'none';
    }
});

backToTopButton.addEventListener('click', () => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});

// Menambahkan script untuk animasi tampilan elemen saat digulir ke bawah
const sections = document.querySelectorAll('section');

function checkAndShowSections() {
    sections.forEach(section => {
        const sectionTop = section.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;
        if (sectionTop < windowHeight - 100) {
            section.classList.add('show');
        }
    });
}

window.addEventListener('scroll', checkAndShowSections);
window.addEventListener('resize', checkAndShowSections);

// Memanggil fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', checkAndShowSections);

function startDragging(e) {
    isDragging = true;
    startPosition = e.clientX || e.touches[0].clientX;
    slider.classList.add('grabbing');
}

function stopDragging() {
    isDragging = false;
    const movedBy = currentTranslate - prevTranslate;

    if (movedBy < -100 && currentTranslate !== 0) {
        prevSlide();
    } else if (movedBy > 100 && currentTranslate !== -((3 - 1) * 100)) {
        nextSlide();
    }

    slider.classList.remove('grabbing');
    console.log('currentTranslate:', currentTranslate);
    console.log('prevTranslate:', prevTranslate);
}

// ... (tambahkan log di bagian-bagian lain yang mungkin relevan)

// Memanggil fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    checkAndShowSections();
    initializeSlider();
});

// Penambahan skrip untuk menginisialisasi slider
// script.js

const slider = document.querySelector('.slider');
let isDragging = false;
let startPosition = 0;
let currentTranslate = 0;
let prevTranslate = 0;

function startDragging(e) {
    isDragging = true;
    startPosition = e.clientX || e.touches[0].clientX;
    slider.classList.add('grabbing');
}

function stopDragging() {
    isDragging = false;
    const movedBy = currentTranslate - prevTranslate;

    if (movedBy < -100 && currentTranslate !== 0) {
        prevSlide();
    } else if (movedBy > 100 && currentTranslate !== -((3 - 1) * 100)) {
        nextSlide();
    }

    slider.classList.remove('grabbing');
}

function dragging(e) {
    if (isDragging) {
        const currentPosition = e.clientX || e.touches[0].clientX;
        currentTranslate = prevTranslate + currentPosition - startPosition;
    }
}

function updateSliderPosition() {
    slider.style.transform = `translateX(${currentTranslate}%)`;
}

function nextSlide() {
    if (currentTranslate === -((3 - 1) * 100)) return;
    prevTranslate = currentTranslate;
    currentTranslate -= 100;
    updateSliderPosition();
}

function prevSlide() {
    if (currentTranslate === 0) return;
    prevTranslate = currentTranslate;
    currentTranslate += 100;
    updateSliderPosition();
}



function initializeSlider() {
    const slides = document.querySelectorAll('.slide');
    slides.forEach((slide, index) => {
        slide.style.left = `${index * 100}%`;
    });
}


slider.addEventListener('mousedown', startDragging);
slider.addEventListener('touchstart', startDragging);
slider.addEventListener('mouseup', stopDragging);
slider.addEventListener('touchend', stopDragging);
slider.addEventListener('mousemove', dragging);
slider.addEventListener('touchmove', dragging);



// Memanggil fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    checkAndShowSections();
    initializeSlider();
});
