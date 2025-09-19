<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="position-relative bg-gradient d-flex align-items-center justify-content-center" style="height:500px; overflow:hidden;">
    <!-- 3D Carousel Wrapper -->
    <div class="carousel-3d">
        <div class="carousel-3d-inner">
            <div class="carousel-3d-item">
                <img src="https://www.mediamu.com/media/images/2025/01/116794d5656e954.jpeg?location=1&width=&height=&quality=90&fit=1"
                     alt="slide1">
            </div>
            <div class="carousel-3d-item">
                <img src="https://www.umy.ac.id/wp-content/uploads/2025/01/Pelatihan-Sertifikasi-Halal-scaled-1-1024x576.jpg"
                     alt="slide2">
            </div>
            <div class="carousel-3d-item">
                <img src="https://www.mediamu.com/media/images/2024/08/1166cdfa8f6a83b.jpeg?location=1&width=&height=&quality=90&fit=1"
                     alt="slide3">
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-overlay"></div>

    <!-- Text -->
    <div class="position-absolute text-center text-white px-3 top-50 start-50 translate-middle">
        <h1 class="fw-bold display-4 mb-2 text-shadow">SELAMAT DATANG DI WEBSITE</h1>
        <h2 class="fw-bold h1 mb-3 text-info text-shadow">LP UMKM PWM DIY</h2>
        <p class="fs-4 text-shadow">Lembaga Pengembangan Usaha Mikro Kecil dan Menengah</p>
    </div>
</section>

<!-- Information Section -->
<section class="bg-gradient py-5 text-white">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-6 mb-4">
                <h2 class="fw-bold d-flex align-items-center mb-3">
                    <span class="bg-success me-2" style="width:6px; height:32px; border-radius:3px;"></span>
                    INFORMASI LP UMKM PWM DIY
                </h2>
                <p class="text-light fs-5 text-justify">
                    <span class="fw-semibold text-success">Winariyati, S.Si</span> menjabat sebagai Ketua Kelompok Tani 
                    Gemaih Ripah di RW 09 Kelurahan Bausasran, Yogyakarta. 
                    Sejak awal terbentuknya kampung sayur, beliau telah memimpin berbagai inisiatif pertanian organik di lahan sempit perkotaan. 
                    Di bawah kepemimpinannya, kelompok ini berhasil mengembangkan budidaya sayuran seperti 
                    <span class="fw-semibold text-success">bayam Brasil</span>, yang kemudian diolah menjadi produk inovatif seperti mie, jus, dan keripik.
                </p>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://www.mediamu.com/media/images/2025/01/116794d5656e954.jpeg?location=1&width=&height=&quality=90&fit=1"
                     class="rounded shadow-lg img-fluid hover-zoom" alt="Kegiatan UMKM">
            </div>
        </div>

        <!-- Cards -->
        <div class="row text-dark g-4 mt-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-lg text-center hover-up" data-bs-toggle="modal" data-bs-target="#modalDaftar">
                    <div class="card-body">
                        <div class="rounded-circle bg-success-subtle shadow-sm d-flex align-items-center justify-content-center mx-auto mb-3" style="width:64px;height:64px;">
                            <img src="<?php echo e(asset('images/voting_3160562.png')); ?>" class="w-50 h-50">
                        </div>
                        <h5 class="fw-bold">Daftar</h5>
                        <p>Daftarkan UMKM Anda untuk bergabung dengan komunitas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-lg text-center hover-up" data-bs-toggle="modal" data-bs-target="#modalTentang">
                    <div class="card-body">
                        <div class="rounded-circle bg-info-subtle shadow-sm d-flex align-items-center justify-content-center mx-auto mb-3" style="width:64px;height:64px;">
                            <img src="<?php echo e(asset('images/audience_1040005.png')); ?>" class="w-50 h-50">
                        </div>
                        <h5 class="fw-bold">Tentang Kami</h5>
                        <p>Pelajari lebih lanjut tentang kami</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-lg text-center hover-up" data-bs-toggle="modal" data-bs-target="#modalVisi">
                    <div class="card-body">
                        <div class="rounded-circle bg-purple-subtle shadow-sm d-flex align-items-center justify-content-center mx-auto mb-3" style="width:64px;height:64px;">
                            <img src="<?php echo e(asset('images/open-book_2280151.png')); ?>" class="w-50 h-50">
                        </div>
                        <h5 class="fw-bold">Visi dan Misi</h5>
                        <p>Mengetahui tujuan dan arah pengembangan UMKM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Daftar -->
<div class="modal fade" id="modalDaftar" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-gradient-green text-dark">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">Daftar UMKM</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <img src="<?php echo e(asset('images/voting_3160562.png')); ?>" class="mb-3" style="width:64px;">
        <p>Dengan mendaftar, UMKM Anda akan bergabung dalam komunitas yang mendukung:</p>
        <ul class="list-unstyled">
          <li>✅ Promosi usaha secara lebih luas</li>
          <li>✅ Kolaborasi antar UMKM</li>
          <li>✅ Akses pelatihan & pendampingan</li>
          <li>✅ Informasi program & bantuan</li>
        </ul>
        <div class="mt-3">
          <a href="https://wa.me/6284151689959?text=Halo%20saya%20ingin%20mendaftar%20UMKM" target="_blank" class="btn btn-success">Lanjut ke WhatsApp</a>
          <a href="#tentang" class="btn btn-outline-success">Pelajari Lebih Lanjut</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tentang -->
<div class="modal fade" id="modalTentang" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-gradient-blue text-dark">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">Tentang Kami</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <img src="<?php echo e(asset('images/audience_1040005.png')); ?>" class="d-block mx-auto mb-3" style="width:64px;">
        <p>Kami adalah komunitas UMKM yang mendukung perkembangan usaha kecil menengah. 
        Melalui program pelatihan, pendampingan, dan jaringan kolaborasi, kami membantu pelaku UMKM meningkatkan daya saing.</p>
        <ul>
          <li>🌱 Meningkatkan kapasitas pelaku UMKM</li>
          <li>🌱 Memperluas pasar melalui kolaborasi</li>
          <li>🌱 Mengedepankan inovasi dan keberlanjutan</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Modal Visi -->
<div class="modal fade" id="modalVisi" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-gradient-purple text-dark">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">Visi dan Misi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <img src="<?php echo e(asset('images/open-book_2280151.png')); ?>" class="d-block mx-auto mb-3" style="width:64px;">
        <p><strong>Visi:</strong><br> Menjadi komunitas UMKM yang mandiri, inovatif, dan berdaya saing tinggi di era global.</p>
        <p><strong>Misi:</strong></p>
        <ul>
          <li>🚀 Memberikan pelatihan dan pendampingan berkala</li>
          <li>🚀 Memfasilitasi jaringan kolaborasi antar UMKM</li>
          <li>🚀 Mendorong penggunaan teknologi digital</li>
          <li>🚀 Menjadi wadah advokasi kebijakan untuk UMKM</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* Backgrounds */
.bg-gradient { background: linear-gradient(to right, #0d6efd, #0a58ca, #052c65); }
.bg-gradient-overlay { background: linear-gradient(to top, rgba(13,37,72,.7), transparent, rgba(13,37,72,.5)); }
.text-shadow { text-shadow: 0 3px 5px rgba(0,0,0,.9); }
.brightness-75 { filter: brightness(75%); }
.hover-zoom:hover { transform: scale(1.05); transition:.4s; box-shadow:0 0 20px rgba(25,135,84,.5); }
.hover-up:hover { transform: translateY(-8px); transition:.4s; }
.bg-gradient-green { background: linear-gradient(135deg, #d1fae5, #a7f3d0); }
.bg-gradient-blue { background: linear-gradient(135deg, #e0f2fe, #bae6fd); }
.bg-gradient-purple { background: linear-gradient(135deg, #f3e8ff, #fbcfe8); }

/* ==== 3D Carousel ==== */
.carousel-3d {
  position: relative;
  width: 600px;
  height: 350px;
  perspective: 1200px;
}

.carousel-3d-inner {
  width: 100%;
  height: 100%;
  position: absolute;
  transform-style: preserve-3d;
  animation: rotateY 12s infinite linear;
}

.carousel-3d-item {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}

.carousel-3d-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 1rem;
  box-shadow: 0 15px 40px rgba(0,0,0,0.5);
}

/* Rotasi tiap sisi cube */
.carousel-3d-item:nth-child(1) { transform: rotateY(0deg) translateZ(500px); }
.carousel-3d-item:nth-child(2) { transform: rotateY(120deg) translateZ(500px); }
.carousel-3d-item:nth-child(3) { transform: rotateY(240deg) translateZ(500px); }

@keyframes rotateY {
  from { transform: rotateY(0deg); }
  to { transform: rotateY(-360deg); }
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\project-pwm\resources\views\welcome.blade.php ENDPATH**/ ?>