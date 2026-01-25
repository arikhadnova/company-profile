<style>
    .portfolio-detail-hero {
        padding: 120px 0 60px;
        background-color: #fff;
    }
    .status-badge {
        background-color: #e8f0fe;
        color: #0d6efd;
        font-weight: 700;
        font-size: 0.75rem;
        padding: 6px 16px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        margin-bottom: 15px;
    }
    .portfolio-title {
        font-weight: 800;
        font-size: 2.5rem;
        margin-bottom: 15px;
    }
    .portfolio-meta {
        color: #666;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }
    .impact-metrics-row {
        display: flex;
        gap: 40px;
        margin-top: 20px;
    }
    .metric-item .metric-value {
        font-weight: 800;
        font-size: 1.5rem;
        color: #0d4a7c;
        display: block;
    }
    .metric-item .metric-label {
        font-size: 0.75rem;
        color: #777;
        line-height: 1.2;
        display: block;
    }
    .hero-image-container {
        border-radius: 20px;
        overflow: hidden;
        height: 400px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hero-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .section-header-sm {
        font-weight: 800;
        font-size: 1.2rem;
        text-transform: uppercase;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }
    
    .peran-box {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
        border-left: 5px solid #0d4a7c;
    }
    
    .target-container {
        background-color: #f8f9fa;
        padding: 40px;
        border-radius: 20px;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .impact-grid-item {
        text-align: center;
        padding: 20px;
    }
    .impact-value-blue {
        color: #0d6efd;
        font-weight: 800;
        font-size: 1.8rem;
        display: block;
    }
    .impact-label-gray {
        color: #666;
        font-size: 0.8rem;
    }
    
    .approach-box {
        background-color: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    
    .highlight-card {
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        height: 250px;
    }
    .highlight-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .highlight-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        display: flex;
        align-items: flex-end;
        padding: 20px;
        color: white;
    }
    
    .cta-partnership {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('<?= ASSETS_URL ?>img/partnership-bg.jpg') center/cover;
        padding: 80px 0;
        color: white;
        text-align: center;
    }
</style>

<section class="portfolio-detail-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>partnership" class="text-decoration-none text-muted">Partnership</a></li>
                <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">Detail Proyek</li>
            </ol>
        </nav>
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="hero-image-container mb-4 mb-lg-0">
                    <img src="https://placehold.co/600x400?text=Project+Image" alt="Project Cover">
                </div>
            </div>
            <div class="col-lg-7 ps-lg-5">
                <span class="status-badge">PROGRAM PARTNERSHIP - ON GOING</span>
                <h1 class="portfolio-title">
                    Judul Proyek Portofolio
                </h1>
                <div class="portfolio-meta">
                    <i class="fas fa-map-marker-alt text-primary"></i>
                    <span>Nama Klien | 2024 - Present</span>
                </div>
                
                <h6 class="fw-bold text-uppercase small mb-3">Impact Metrics</h6>
                <div class="impact-metrics-row">
                    <div class="metric-item">
                        <span class="metric-value">90%</span>
                        <span class="metric-label">waste reduced through<br>recycling & composting</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-value">120+</span>
                        <span class="metric-label">Established<br>partnerships</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-value">1000+</span>
                        <span class="metric-label">tons of waste<br>collected and treated</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <h4 class="section-header-sm">Tentang</h4>
                <div class="text-muted">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="peran-box">
                    <h5 class="fw-bold mb-3">SUB TITLE</h5>
                    <p class="small mb-0">
                        Deskripsi singkat tentang sub judul proyek ini yang memberikan konteks tambahan bagi pembaca.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <h4 class="text-center section-header-sm mb-4">Target</h4>
        <div class="target-container shadow-sm bg-white">
            <h5 class="fw-bold mb-4 text-center">TARGET PROYEK</h5>
            <ul class="list-unstyled d-flex flex-column gap-3">
                <li class="d-flex gap-3">
                    <i class="fas fa-circle text-primary" style="font-size: 8px; margin-top: 8px;"></i>
                    <span>Target 100% tingkat pengumpulan sampah (collection rate) di desa-desa percontohan secara bertahap.</span>
                </li>
                <li class="d-flex gap-3">
                    <i class="fas fa-circle text-primary" style="font-size: 8px; margin-top: 8px;"></i>
                    <span>Penurunan tingkat kebocoran sampah ke lingkungan (waste leakage rate).</span>
                </li>
                <li class="d-flex gap-3">
                    <i class="fas fa-circle text-primary" style="font-size: 8px; margin-top: 8px;"></i>
                    <span>Peningkatan daur ulang (recycling rate).</span>
                </li>
                <li class="d-flex gap-3">
                    <i class="fas fa-circle text-primary" style="font-size: 8px; margin-top: 8px;"></i>
                    <span>Penurunan timbulan sampah residu ke TPA yang secara jauhnya berimplikasi pada pencegahan kebocoran sampah plastik ke laut.</span>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h4 class="text-center section-header-sm mb-5">Dampak</h4>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-6">
                <div class="impact-grid-item">
                    <span class="impact-value-blue">90%</span>
                    <span class="impact-label-gray">waste reduced through recycling & composting</span>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="impact-grid-item">
                    <span class="impact-value-blue">120+</span>
                    <span class="impact-label-gray">Established partnerships</span>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="impact-grid-item">
                    <span class="impact-value-blue">1000+</span>
                    <span class="impact-label-gray">tons of waste collected and treated</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h4 class="section-header-sm">Pendekatan</h4>
                <p class="text-muted">
                    Pendekatan partisipatif yang melibatkan masyarakat secara aktif di seluruh tahapan proyek (perencanaan, pelaksanaan, evaluasi).
                </p>
            </div>
            <div class="col-lg-6">
                <div class="approach-box">
                    <h6 class="fw-bold mb-2">Pemberdayaan Local Champions</h6>
                    <p class="small text-muted mb-0">Memberdayakan warga lokal menjadi fasilitator yang berperan sebagai penggerak utama di dalam komunitas lokal dalam membangun rasa kepemilikan dan tanggung jawab bersama.</p>
                </div>
                <div class="approach-box">
                    <h6 class="fw-bold mb-2">Keberlanjutan Jangka Panjang</h6>
                    <p class="small text-muted mb-0">Pendekatan ini secara inheren memperkuat kapasitas komunitas untuk menjamin komitmen dan keberlangsungan program setelah pendampingan formal berakhir.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h4 class="text-center section-header-sm mb-5">Sorotan</h4>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="highlight-card shadow-sm">
                    <img src="https://placehold.co/400x300?text=Highlight+1" alt="Highlight 1">
                    <div class="highlight-overlay">
                        <p class="small mb-0">Cerita sukses pemberdayaan masyarakat di lapangan.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="highlight-card shadow-sm">
                    <img src="https://placehold.co/400x300?text=Highlight+2" alt="Highlight 2">
                    <div class="highlight-overlay">
                        <p class="small mb-0">Implementasi sistem pengelolaan sampah terpadu.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="highlight-card shadow-sm">
                    <img src="https://placehold.co/400x300?text=Highlight+3" alt="Highlight 3">
                    <div class="highlight-overlay">
                        <p class="small mb-0">Kolaborasi dengan mitra strategis lokal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-partnership">
    <div class="container">
        <h2 class="fw-bold mb-3">MARI BEKERJA SAMA UNTUK<br>SOLUSI PERSAMPAHAN BERKELANJUTAN</h2>
        <p class="mb-4 opacity-75">Untuk info lebih lanjut, hubungi kami sekarang!</p>
        <a href="<?= BASE_URL ?>contact" class="btn btn-success rounded-pill px-5 py-3 fw-bold">Hubungi Kami</a>
    </div>
</section>
