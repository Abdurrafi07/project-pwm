<?php $__env->startSection('title', 'PWM DIY'); ?>

<?php $__env->startPush('styles'); ?>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Nunito+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito Sans', sans-serif;
        }
        h1, h2, h3, .modal h2 {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative h-[500px] flex items-center justify-center bg-gradient-to-r from-blue-500 via-blue-700 to-blue-900 overflow-hidden">
        <!-- Carousel Foto -->
        <div class="relative w-[1000px] h-[450px] z-0">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="absolute w-4/6 h-full opacity-0 transition-all duration-700 ease-in-out carousel-slide">
                    <img src="https://www.mediamu.com/media/images/2025/01/116794d5656e954.jpeg?location=1&width=&height=&quality=90&fit=1" 
                         class="w-full h-full object-cover rounded-xl brightness-75 shadow-lg">
                </div>
                <div class="absolute w-4/6 h-full opacity-0 transition-all duration-700 ease-in-out carousel-slide">
                    <img src="https://www.umy.ac.id/wp-content/uploads/2025/01/Pelatihan-Sertifikasi-Halal-scaled-1-1024x576.jpg" 
                         class="w-full h-full object-cover rounded-xl brightness-75 shadow-lg">
                </div>
                <div class="absolute w-4/6 h-full opacity-0 transition-all duration-700 ease-in-out carousel-slide">
                    <img src="https://www.mediamu.com/media/images/2024/08/1166cdfa8f6a83b.jpeg?location=1&width=&height=&quality=90&fit=1" 
                         class="w-full h-full object-cover rounded-xl brightness-75 shadow-lg">
                </div>
            </div>
        </div>

        <!-- Overlay biru -->
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/50 via-transparent to-blue-900/30"></div>

        <!-- Teks -->
        <div class="absolute text-center text-white px-6 z-10 font-helvetica">
            <h1 class="text-5xl font-bold mb-2 drop-shadow-[0_3px_5px_rgba(0,0,0,0.9)] tracking-wide">
                SELAMAT DATANG DI WEBSITE
            </h1>
            <h2 class="text-3xl font-bold text-blue-200 mb-3 drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)] tracking-wide">
                LP UMKM PWM DIY
            </h2>
            <p class="text-xl opacity-95 drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)] leading-relaxed">
                Lembaga Pengembangan Usaha Mikro Kecil dan Menengah
            </p>
        </div>
    </section>

    <!-- Information Section -->
    <section class="bg-gradient-to-r from-blue-500 via-blue-700 to-blue-900 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center py-12">
                <!-- Left -->
                <div class="space-y-6 opacity-0 -translate-x-8 transition-all duration-700" data-animate="left">
                    <h2 class="text-3xl font-extrabold text-white flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-green-400 rounded"></span>
                        INFORMASI LP UMKM PWM DIY
                    </h2>
                    <p class="text-green-100 leading-relaxed text-lg text-justify">
                        <span class="font-semibold text-green-300">Winariyati, S.Si</span> menjabat sebagai Ketua Kelompok Tani 
                        Gemaih Ripah di RW 09 Kelurahan Bausasran, Yogyakarta. 
                        Sejak awal terbentuknya kampung sayur, beliau telah memimpin 
                        berbagai inisiatif pertanian organik di lahan sempit perkotaan. 
                        Di bawah kepemimpinannya, kelompok ini berhasil mengembangkan 
                        budidaya sayuran seperti <span class="font-semibold text-green-300">bayam Brasil</span>, 
                        yang kemudian diolah menjadi berbagai produk inovatif seperti mie, jus, dan keripik.
                    </p>
                </div>

                <!-- Right -->
                <div class="flex justify-center lg:justify-end opacity-0 translate-x-8 transition-all duration-700" data-animate="right">
                    <img src="https://www.mediamu.com/media/images/2025/01/116794d5656e954.jpeg?location=1&width=&height=&quality=90&fit=1"
                        alt="Kegiatan UMKM PWM DIY"
                        class="rounded-xl shadow-xl w-[400px] h-[250px] object-cover transform transition duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-green-600/30">
                </div>
            </div>

            
            <?php echo $__env->make('layouts.home-cards', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Carousel
    const slides = document.querySelectorAll('.carousel-slide');
    let current = 0;
    function updateSlides() {
        slides.forEach((slide, i) => {
            slide.style.opacity = "0";
            slide.style.transform = "scale(0.7)";
            slide.style.zIndex = "0";
        });
        slides[current].style.opacity = "1";
        slides[current].style.transform = "scale(1)";
        slides[current].style.zIndex = "2";
        let prev = (current - 1 + slides.length) % slides.length;
        slides[prev].style.opacity = "0.8";
        slides[prev].style.transform = "scale(0.8) translateX(-250px)";
        slides[prev].style.zIndex = "1";
        let next = (current + 1) % slides.length;
        slides[next].style.opacity = "0.8";
        slides[next].style.transform = "scale(0.8) translateX(250px)";
        slides[next].style.zIndex = "1";
    }
    function moveNext() { current = (current + 1) % slides.length; updateSlides(); }
    updateSlides();
    setInterval(moveNext, 3000);

    // Animasi scroll
    document.addEventListener("DOMContentLoaded", () => {
        const elements = document.querySelectorAll("[data-animate]");
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.dataset.animate === "left") {
                        entry.target.classList.remove("opacity-0", "-translate-x-8");
                    } else if (entry.target.dataset.animate === "right") {
                        entry.target.classList.remove("opacity-0", "translate-x-8");
                    }
                    entry.target.classList.add("opacity-100", "translate-x-0");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });
        elements.forEach(el => observer.observe(el));
    });

    // Modal
    function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
    document.querySelectorAll('[id^="modal"]').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal(modal.id);
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\welcome.blade.php ENDPATH**/ ?>