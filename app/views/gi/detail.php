<!-- Page Detail Layanan GoSirk Institute -->
<style>
    .detail-hero {
        padding: 60px 0 60px;
        background-color: #fff;
    }
    .service-category-tag {
        color: #FF8F56;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 15px;
        display: block;
    }
    .detail-title {
        font-weight: 800;
        font-size: 2.8rem;
        line-height: 1.2;
        margin-bottom: 20px;
    }
    .detail-desc {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 30px;
        max-width: 600px;
    }
    .hero-img-placeholder {
        background-color: #e9ecef;
        border-radius: 20px;
        height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
    }
    .btn-green-gi {
        background-color: #29b471;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
    }
    .btn-green-gi:hover {
        background-color: #1e8552;
        color: white;
    }
    
    .section-title {
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
    
    .materi-item {
        background-color: #f0f4f8;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 15px;
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }
    .materi-number {
        font-weight: 800;
        font-size: 1.2rem;
        color: #0d4a7c;
        margin-top: -2px;
    }
    .materi-content h6 {
        font-weight: 700;
        margin-bottom: 5px;
    }
    .materi-content p {
        font-size: 0.9rem;
        margin-bottom: 0;
        color: #666;
    }
    
    .sidebar-box {
        background-color: #0d385f;
        color: white;
        padding: 30px;
        border-radius: 20px;
        position: sticky;
        top: 100px;
    }
    .sidebar-info-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }
    .sidebar-info-item i {
        color: #FF8F56;
        font-size: 1.2rem;
    }
    .sidebar-info-text small {
        display: block;
        opacity: 0.7;
        font-size: 0.75rem;
    }
    .sidebar-info-text span {
        font-weight: 500;
        font-size: 0.9rem;
    }
    .btn-orange-sidebar {
        background-color: #FF8F56;
        color: white;
        border: none;
        width: 100%;
        padding: 12px;
        border-radius: 50px;
        font-weight: 700;
        margin-top: 20px;
    }
    
    /* Table Styles */
    .table-gi thead th {
        background-color: #0d4a7c;
        color: white;
        text-align: center;
        padding: 15px;
        font-size: 0.8rem;
        border: none;
    }
    .table-gi tbody td {
        padding: 15px;
        vertical-align: middle;
        font-size: 0.85rem;
        border-bottom: 1px solid #eee;
    }
    .status-check { color: #29b471; font-weight: bold; }
    .status-cross { color: #dc3545; font-weight: bold; }
    
    /* FAQ Accordion */
    .faq-item {
        border: 1px solid #eee;
        border-radius: 10px;
        margin-bottom: 10px;
        overflow: hidden;
    }
    .faq-button {
        width: 100%;
        padding: 15px 20px;
        background: none;
        border: none;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
    }
    
    /* Lead Form */
    .lead-form-section {
        background-color: #fff;
        padding: 80px 0;
    }
    .form-container {
        display: flex;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    .form-left {
        background-color: #0d385f;
        color: white;
        padding: 60px 40px;
        width: 40%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .form-right {
        background-color: #fff;
        padding: 60px 40px;
        width: 60%;
        border-top: 5px solid #29b471;
    }
    
    .testimonial-card {
        background-color: #0d4a7c;
        color: white;
        padding: 30px;
        border-radius: 15px;
        height: 100%;
    }
    .stars { color: #FF8F56; margin-bottom: 15px; }
</style>

<?php $s = $data['service']; ?>
<div class="gi-page">
<!-- HERO SECTION -->
<section class="detail-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>gi" class="text-decoration-none text-muted">GoSirk Institute</a></li>
                <li class="breadcrumb-item active text-primary fw-bold" aria-current="page" data-lang-id="<?= $s->title_id ?>" data-lang-en="<?= $s->title_en ?>"><?= $s->title_id ?></li>
            </ol>
        </nav>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="service-category-tag"><?= ucfirst(str_replace('-', ' ', $s->category)); ?></span>
                <h1 class="detail-title text-uppercase" data-lang-id="<?= $s->title_id ?>" data-lang-en="<?= $s->title_en ?>"><?= $s->title_id ?></h1>
                <p class="detail-desc" data-lang-id="<?= $s->description_id ?>" data-lang-en="<?= $s->description_en ?>">
                    <?= $s->description_id ?>
                </p>
                <div class="d-flex gap-3">
                    <a href="<?= BASE_URL ?>contact" class="btn btn-green-gi">Hubungi Kami</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-img-placeholder mt-4 mt-lg-0 overflow-hidden shadow-sm">
                    <?php if ($s->image) : ?>
                        <img src="<?= ASSETS_URL ?>img/gi/<?= $s->image ?>" class="w-100 h-100 object-fit-cover">
                    <?php else : ?>
                        <span class="material-symbols-outlined" style="font-size: 80px;">image</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CONTENT SECTION -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="rich-content-container" data-lang-id="<?= $s->detail_content_id ?>" data-lang-en="<?= $s->detail_content_en ?>">
                    <?= $s->detail_content_id ?>
                </div>

                <?php if ($s->outputs_id) : ?>
                <div class="mt-5 pt-4">
                    <h4 class="fw-bold mb-4">Outputs</h4>
                    <div class="d-flex flex-wrap gap-2">
                        <?php 
                        $outputs_id = explode(',', $s->outputs_id);
                        $outputs_en = explode(',', $s->outputs_en);
                        foreach ($outputs_id as $idx => $out) : 
                            $out_en = isset($outputs_en[$idx]) ? trim($outputs_en[$idx]) : trim($out);
                        ?>
                            <div class="badge bg-light text-dark p-3 rounded-pill border d-flex align-items-center gap-2" data-lang-id="<?= trim($out) ?>" data-lang-en="<?= $out_en ?>">
                                <i class="bi bi-check-circle text-success"></i> <?= trim($out) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="col-lg-4">
                <div class="sidebar-box shadow-lg border-0">
                    <h5 class="fw-bold mb-4">Detail Layanan</h5>
                    
                    <div class="sidebar-info-item">
                        <i class="fas fa-tag"></i>
                        <div class="sidebar-info-text">
                            <small>Kategori</small>
                            <span><?= ucfirst(str_replace('-', ' ', $s->category)); ?></span>
                        </div>
                    </div>
                    
                    <div class="sidebar-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="sidebar-info-text">
                            <small>Lokasi</small>
                            <span>Online / Offline (Disesuaikan)</span>
                        </div>
                    </div>
                    
                    <div class="sidebar-info-item">
                        <i class="fas fa-clock"></i>
                        <div class="sidebar-info-text">
                            <small>Sifat Layanan</small>
                            <span>Profesional & Adaptif</span>
                        </div>
                    </div>
                    
                    <a href="<?= BASE_URL ?>contact" class="btn btn-orange-sidebar text-decoration-none d-block text-center shadow-sm">
                        Hubungi Kami
                    </a>
                    <p class="text-center small opacity-75 mt-3 mb-0">Klik tombol di atas untuk tanya-tanya seputar layanan ini.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LEAD FORM -->
<section class="lead-form-section bg-light">
    <div class="container">
        <div class="form-container">
            <div class="form-left bg-gradient-dark">
                <h3 class="fw-bold mb-4">Diskusikan Kebutuhan Anda Sekarang.</h3>
                <ul class="list-unstyled d-flex flex-column gap-3 mb-5">
                    <li class="d-flex gap-3"><i class="fas fa-check-circle text-orange"></i> Konsultasi Strategis</li>
                    <li class="d-flex gap-3"><i class="fas fa-check-circle text-orange"></i> Penawaran Harga Khusus</li>
                    <li class="d-flex gap-3"><i class="fas fa-check-circle text-orange"></i> Penjadwalan Cepat</li>
                </ul>
            </div>
            <div class="form-right">
                <h5 class="fw-bold mb-4">Hubungi Kami</h5>
                <form action="<?= BASE_URL ?>contact/send" method="POST">
                    <div class="mb-4">
                        <label class="form-label small fw-bold">NAMA / INSTANSI*</label>
                        <input type="text" name="name" class="form-control border-0 bg-light py-3 border-bottom rounded-0 shadow-none" placeholder="Tuliskan nama Anda" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">EMAIL*</label>
                        <input type="email" name="email" class="form-control border-0 bg-light py-3 border-bottom rounded-0 shadow-none" placeholder="Tuliskan email aktif" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">NOMOR TELEPON*</label>
                        <input type="text" name="phone" class="form-control border-0 bg-light py-3 border-bottom rounded-0 shadow-none" placeholder="Contoh: 08123456789" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">PESAN / KEBUTUHAN</label>
                        <textarea name="message" class="form-control border-0 bg-light py-3 border-bottom rounded-0 shadow-none" rows="3" placeholder="Jelaskan kebutuhan Anda..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-green-gi w-100 py-3 mt-3 shadow-sm">Kirim Permintaan Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</section>
</div>

<script>
    document.querySelectorAll('.faq-button').forEach(button => {
        button.addEventListener('click', () => {
            const item = button.parentElement;
            const isOpen = item.classList.contains('active');
            
            if (!isOpen) {
                item.classList.add('active');
                button.querySelector('i').className = 'fas fa-chevron-up small';
            } else {
                item.classList.remove('active');
                button.querySelector('i').className = 'fas fa-chevron-down small';
            }
        });
    });
</script>
