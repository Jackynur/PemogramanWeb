document.addEventListener('DOMContentLoaded', function() {
    // Animasi scroll reveal
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    });

    // Terapkan ke elemen
    document.querySelectorAll('.feature, .profile-container, .footer-column').forEach((el) => {
        observer.observe(el);
    });

    // Animasi loading
    document.body.classList.add('loaded');
});

// Tambahkan efek parallax
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector('.image-section');
    parallax.style.transform = `translateY(${scrolled * 0.3}px)`;
});

// Animated counter untuk statistics
let count = 0;
const counter = setInterval(() => {
    count++;
    if (count === 100) {
        clearInterval(counter);
    }
}, 30);